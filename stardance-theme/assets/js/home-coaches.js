(function () {
  'use strict';

  var viewport = document.querySelector('[data-sd-coach-carousel]');
  if (!viewport) return;

  var track = viewport.querySelector('.sd-coaches__track');
  if (!track) return;

  var slides = Array.prototype.slice.call(track.querySelectorAll('.sd-coaches__slide'));
  var total = slides.length;
  if (total < 2) return;

  var dotsContainer = document.querySelector('.sd-coaches__dots');
  var dots = dotsContainer ? Array.prototype.slice.call(dotsContainer.querySelectorAll('.sd-coaches__dot')) : [];

  var AUTOPLAY_MS = 4000;
  var PAD = Math.ceil(2.5); // 3 clones at each end
  var current = PAD;
  var isAnimating = false;
  var autoplayTimer = null;
  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Drag state
  var isDragging = false;
  var dragMoved = false;
  var dragStartX = 0;
  var dragStartIndex = 0;
  var dragDeltaX = 0;
  var CLICK_THRESHOLD = 5;     // px — below this, treat as a click
  var SMALL_FLICK_RATIO = 0.2; // 20% of slide width triggers a snap

  // Clone slides for infinite loop: prepend last PAD slides, append first PAD slides
  for (var p = 0; p < PAD; p++) {
    var headClone = slides[total - 1 - p].cloneNode(true);
    headClone.setAttribute('aria-hidden', 'true');
    track.insertBefore(headClone, track.firstChild);

    var tailClone = slides[p].cloneNode(true);
    tailClone.setAttribute('aria-hidden', 'true');
    track.appendChild(tailClone);
  }

  function getStep() {
    var firstSlide = track.querySelector('.sd-coaches__slide');
    var gap = parseFloat(getComputedStyle(track).columnGap) || 0;
    return firstSlide.offsetWidth + gap;
  }

  function setTransform(index, animate) {
    track.style.transition = animate ? '' : 'none';
    track.style.transform = 'translateX(' + (-index * getStep()) + 'px)';
  }

  function updateDots(index) {
    var dotIndex = ((index - PAD) % total + total) % total;
    dots.forEach(function (dot, i) {
      var active = i === dotIndex;
      dot.classList.toggle('sd-coaches__dot--active', active);
      dot.setAttribute('aria-selected', active ? 'true' : 'false');
    });
  }

  function goTo(index, animate) {
    setTransform(index, animate);
    current = index;
    updateDots(index);
  }

  // Init
  goTo(PAD, false);

  // Infinite loop reset on transition end
  track.addEventListener('transitionend', function (e) {
    if (e.target !== track || e.propertyName !== 'transform') return;
    isAnimating = false;

    if (current >= total + PAD) {
      track.style.transition = 'none';
      current = current - total;
      track.style.transform = 'translateX(' + (-current * getStep()) + 'px)';
      updateDots(current);
      requestAnimationFrame(function () { track.style.transition = ''; });
    } else if (current <= PAD - 1) {
      track.style.transition = 'none';
      current = current + total;
      track.style.transform = 'translateX(' + (-current * getStep()) + 'px)';
      updateDots(current);
      requestAnimationFrame(function () { track.style.transition = ''; });
    }
  });

  function advance() {
    if (isAnimating) return;
    isAnimating = true;
    goTo(current + 1, true);
  }

  function retreat() {
    if (isAnimating) return;
    isAnimating = true;
    goTo(current - 1, true);
  }

  // Dot clicks
  dots.forEach(function (dot, i) {
    dot.addEventListener('click', function () {
      if (isAnimating) return;
      isAnimating = true;
      goTo(PAD + i, true);
    });
  });

  // Autoplay
  function startAutoplay() {
    if (reducedMotion || autoplayTimer) return;
    autoplayTimer = setInterval(advance, AUTOPLAY_MS);
  }

  function stopAutoplay() {
    clearInterval(autoplayTimer);
    autoplayTimer = null;
  }

  startAutoplay();

  viewport.addEventListener('mouseenter', stopAutoplay);
  viewport.addEventListener('mouseleave', startAutoplay);

  document.addEventListener('visibilitychange', function () {
    if (document.hidden) stopAutoplay();
    else startAutoplay();
  });

  // Drag via Pointer Events (mouse, touch, pen — unified)
  function onPointerDown(e) {
    if (e.button !== undefined && e.button !== 0) return;      // ignore right/middle click
    if (e.target.closest('.sd-coaches__dot')) return;          // let dots click normally
    isDragging = true;
    dragMoved = false;
    dragStartX = e.clientX;
    dragDeltaX = 0;
    dragStartIndex = current;
    stopAutoplay();
    track.style.transition = 'none';
    viewport.classList.add('is-dragging');
    try { viewport.setPointerCapture(e.pointerId); } catch (_) {}
  }

  function onPointerMove(e) {
    if (!isDragging) return;
    dragDeltaX = e.clientX - dragStartX;
    if (Math.abs(dragDeltaX) > CLICK_THRESHOLD) dragMoved = true;
    track.style.transform = 'translateX(' + (-dragStartIndex * getStep() + dragDeltaX) + 'px)';
  }

  function onPointerUp(e) {
    if (!isDragging) return;
    isDragging = false;
    viewport.classList.remove('is-dragging');

    var step = getStep();
    var floatSteps = -dragDeltaX / step;
    var rounded = Math.round(floatSteps);
    // Small-flick override: short drag with clear directional intent still commits
    if (rounded === 0 && Math.abs(floatSteps) >= SMALL_FLICK_RATIO) {
      rounded = floatSteps > 0 ? 1 : -1;
    }

    isAnimating = true;
    goTo(dragStartIndex + rounded, true);
    startAutoplay();
  }

  viewport.addEventListener('pointerdown', onPointerDown);
  viewport.addEventListener('pointermove', onPointerMove);
  viewport.addEventListener('pointerup', onPointerUp);
  viewport.addEventListener('pointercancel', onPointerUp);

  // Suppress link navigation when a drag occurred
  viewport.addEventListener('click', function (e) {
    if (dragMoved) {
      e.preventDefault();
      e.stopPropagation();
      dragMoved = false;
    }
  }, true);

  // Re-anchor transform on resize (CSS variable drives slide width automatically)
  var resizePending = false;
  window.addEventListener('resize', function () {
    if (resizePending) return;
    resizePending = true;
    requestAnimationFrame(function () {
      resizePending = false;
      track.style.transition = 'none';
      track.style.transform = 'translateX(' + (-current * getStep()) + 'px)';
    });
  });

}());
