/**
 * Star Dance Studio - Gallery filters and lightbox.
 */
(function () {

  // ── Lightbox ──────────────────────────────────────────────────────────────

  var activeLightbox = null;

  function getSlides(links) {
    return Array.from(links).map(function (link) {
      var img = link.querySelector('img');
      return {
        src: link.getAttribute('href'),
        alt: img ? img.getAttribute('alt') || '' : '',
      };
    });
  }

  function openLightbox(slides, startIndex, loadMore, hasMore) {
    if (activeLightbox) {
      activeLightbox.close();
    }

    var current = startIndex;
    var isAnimating = false;
    var isLoadingMore = false;

    // Build overlay
    var overlay = document.createElement('div');
    overlay.className = 'sd-lightbox';
    overlay.setAttribute('role', 'dialog');
    overlay.setAttribute('aria-modal', 'true');
    overlay.setAttribute('aria-label', 'Image gallery');

    var closeBtn = document.createElement('button');
    closeBtn.className = 'sd-lightbox__close';
    closeBtn.setAttribute('aria-label', 'Close');
    closeBtn.innerHTML = '&times;';

    var counter = document.createElement('div');
    counter.className = 'sd-lightbox__counter';

    var arrowSrc =
      typeof stardanceGallery !== 'undefined' && stardanceGallery.lightboxArrowUrl
        ? stardanceGallery.lightboxArrowUrl
        : '';

    var prevBtn = document.createElement('button');
    prevBtn.className = 'sd-lightbox__arrow sd-lightbox__arrow--prev';
    prevBtn.setAttribute('aria-label', 'Previous image');
    if (arrowSrc) {
      var prevImg = document.createElement('img');
      prevImg.src = arrowSrc;
      prevImg.alt = '';
      prevImg.setAttribute('aria-hidden', 'true');
      prevBtn.appendChild(prevImg);
    } else {
      prevBtn.textContent = '\u2039';
    }

    var nextBtn = document.createElement('button');
    nextBtn.className = 'sd-lightbox__arrow sd-lightbox__arrow--next';
    nextBtn.setAttribute('aria-label', 'Next image');
    if (arrowSrc) {
      var nextImg = document.createElement('img');
      nextImg.src = arrowSrc;
      nextImg.alt = '';
      nextImg.setAttribute('aria-hidden', 'true');
      nextBtn.appendChild(nextImg);
    } else {
      nextBtn.textContent = '\u203a';
    }

    var sliderDiv = document.createElement('div');
    sliderDiv.className = 'sd-lightbox__slider';

    var track = document.createElement('div');
    track.className = 'sd-lightbox__track';

    slides.forEach(function (s) { track.appendChild(makeSlide(s)); });

    sliderDiv.appendChild(track);
    overlay.appendChild(closeBtn);
    overlay.appendChild(counter);
    overlay.appendChild(prevBtn);
    overlay.appendChild(sliderDiv);
    overlay.appendChild(nextBtn);
    document.body.appendChild(overlay);
    document.body.style.overflow = 'hidden';

    function makeSlide(s) {
      var div = document.createElement('div');
      div.className = 'sd-lightbox__slide';
      var frame = document.createElement('div');
      frame.className = 'sd-lightbox__frame';
      var img = document.createElement('img');
      img.src = s.src;
      img.alt = s.alt;
      img.loading = 'lazy';
      frame.appendChild(img);
      div.appendChild(frame);
      return div;
    }

    function updateUI() {
      counter.textContent = (current + 1) + ' / ' + slides.length;
      prevBtn.disabled = current === 0;
      var moreAvailable = loadMore && (!hasMore || hasMore());
      nextBtn.disabled = current >= slides.length - 1 && !moreAvailable;
    }

    function goTo(index, animate) {
      current = index;
      track.style.transition = animate ? 'transform 400ms ease' : 'none';
      track.style.transform = 'translateX(-' + (current * 100) + '%)';
      updateUI();
    }

    goTo(startIndex, false);

    track.addEventListener('transitionend', function (e) {
      if (e.propertyName === 'transform') isAnimating = false;
    });

    prevBtn.addEventListener('click', function () {
      if (isAnimating || current === 0) return;
      isAnimating = true;
      goTo(current - 1, true);
    });

    nextBtn.addEventListener('click', function () {
      if (isAnimating) return;

      if (current >= slides.length - 1) {
        if (!loadMore || isLoadingMore) return;
        isLoadingMore = true;
        nextBtn.disabled = true;

        loadMore().then(function (newSlides) {
          isLoadingMore = false;
          if (!newSlides || !newSlides.length) {
            nextBtn.disabled = true;
            return;
          }
          newSlides.forEach(function (s) {
            slides.push(s);
            track.appendChild(makeSlide(s));
          });
          nextBtn.disabled = false;
          isAnimating = true;
          goTo(current + 1, true);
        }).catch(function () {
          isLoadingMore = false;
          nextBtn.disabled = false;
        });
        return;
      }

      isAnimating = true;
      goTo(current + 1, true);
    });

    // Swipe
    var touchStartX = 0;
    overlay.addEventListener('touchstart', function (e) {
      touchStartX = e.touches[0].clientX;
    }, { passive: true });
    overlay.addEventListener('touchend', function (e) {
      var dx = e.changedTouches[0].clientX - touchStartX;
      if (Math.abs(dx) < 50) return;
      if (dx > 0) prevBtn.click();
      else nextBtn.click();
    }, { passive: true });

    // Keyboard
    function onKeyDown(e) {
      if (e.key === 'Escape') close();
      if (e.key === 'ArrowLeft') prevBtn.click();
      if (e.key === 'ArrowRight') nextBtn.click();
    }
    document.addEventListener('keydown', onKeyDown);

    // Close triggers
    closeBtn.addEventListener('click', close);
    overlay.addEventListener('click', function (e) {
      if (e.target === overlay || e.target === sliderDiv) close();
    });

    function close() {
      document.removeEventListener('keydown', onKeyDown);
      overlay.remove();
      document.body.style.overflow = '';
      activeLightbox = null;
    }

    activeLightbox = { close: close };
  }

  // ── Static gallery sections (homepage, single class page) ─────────────────

  document.querySelectorAll('[data-gallery-lightbox]').forEach(function (container) {
    container.addEventListener('click', function (e) {
      var link = e.target.closest('a[href]');
      if (!link || !link.querySelector('img')) return;
      e.preventDefault();
      var links = Array.from(container.querySelectorAll('a[href]')).filter(function (a) {
        return a.querySelector('img');
      });
      var index = links.indexOf(link);
      openLightbox(getSlides(links), Math.max(0, index), null);
    });
  });

  // ── Gallery page (filters + AJAX + lightbox with load-more) ───────────────

  var galleryGrid = document.querySelector('[data-gallery-grid]');
  if (!galleryGrid) return;

  var showMoreButton = document.querySelector('[data-gallery-show-more]');
  var state = {
    gallery_year: 'all',
    gallery_type: 'all',
    paged: 1,
    posts_per_page: 12,
  };

  function getGalleryLinks() {
    return Array.from(galleryGrid.querySelectorAll('.sd-gallery-page__item'));
  }

  function loadMoreGallery() {
    if (!showMoreButton || showMoreButton.hidden) return Promise.resolve(null);
    var countBefore = getGalleryLinks().length;
    state.paged += 1;
    return fetchFilteredGallery({ append: true }).then(function (appended) {
      if (!appended) {
        state.paged -= 1;
        return null;
      }
      return getSlides(getGalleryLinks().slice(countBefore));
    });
  }

  galleryGrid.addEventListener('click', function (e) {
    var link = e.target.closest('.sd-gallery-page__item');
    if (!link) return;
    e.preventDefault();
    var links = getGalleryLinks();
    var index = links.indexOf(link);
    openLightbox(getSlides(links), Math.max(0, index), loadMoreGallery, function () {
      return showMoreButton && !showMoreButton.hidden;
    });
  });

  async function fetchFilteredGallery(options) {
    options = options || {};
    if (typeof stardanceGallery === 'undefined') return false;

    var append = Boolean(options.append);
    var formData = new FormData();
    formData.append('action', 'stardance_filter_gallery');
    formData.append('nonce', stardanceGallery.nonce);
    formData.append('gallery_year', state.gallery_year);
    formData.append('gallery_type', state.gallery_type);
    formData.append('paged', state.paged);
    formData.append('posts_per_page', state.posts_per_page);

    galleryGrid.classList.add('is-loading');
    if (showMoreButton) showMoreButton.disabled = true;

    try {
      var response = await fetch(stardanceGallery.ajaxurl, { method: 'POST', body: formData });
      var payload = await response.json();

      if (!payload.success || !payload.data || typeof payload.data.markup !== 'string') {
        throw new Error('Invalid gallery response');
      }

      if (append) {
        if (payload.data.markup.trim()) {
          galleryGrid.insertAdjacentHTML('beforeend', payload.data.markup);
          if (showMoreButton) {
            showMoreButton.hidden = !payload.data.has_more;
          }
          return true;
        }
      } else {
        galleryGrid.innerHTML = payload.data.markup;
      }

      if (showMoreButton) {
        showMoreButton.hidden = !payload.data.has_more;
      }
      return !append;
    } catch (err) {
      console.error('Gallery filter request failed', err);
      return false;
    } finally {
      galleryGrid.classList.remove('is-loading');
      if (showMoreButton) showMoreButton.disabled = false;
    }
  }

  function updateActiveTab(button) {
    var filterGroup = button.dataset.filterGroup;
    var filterValue = button.dataset.filterValue;
    if (!filterGroup || typeof filterValue === 'undefined') return;
    state[filterGroup] = filterValue;
    state.paged = 1;
    document.querySelectorAll('[data-filter-group="' + filterGroup + '"]').forEach(function (tab) {
      var isActive = tab === button;
      tab.classList.toggle('is-active', isActive);
      tab.setAttribute('aria-pressed', isActive ? 'true' : 'false');
    });
  }

  document.addEventListener('click', function (e) {
    var filterButton = e.target.closest('.sd-gallery-page__tab');
    if (filterButton) {
      updateActiveTab(filterButton);
      fetchFilteredGallery();
      return;
    }
    var showMore = e.target.closest('[data-gallery-show-more]');
    if (!showMore || showMore.hidden || showMore.disabled) return;
    state.paged += 1;
    fetchFilteredGallery({ append: true });
  });

})();
