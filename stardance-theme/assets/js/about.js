/**
 * About page — coach slider
 */
document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.sd-about-coach__track');
    if (!track) return;

    const slider = track.closest('.sd-about-coach__slider');
    const prevBtn = document.querySelector('.sd-about-coach__arrow--prev');
    const nextBtn = document.querySelector('.sd-about-coach__arrow--next');
    const slides = Array.from(track.querySelectorAll('.sd-about-coach__slide'));
    const total = slides.length;
    const transitionValue = 'transform 500ms ease';
    let current = 1;
    let isAnimating = false;

    if (!prevBtn || !nextBtn || total <= 1) return;

    const firstClone = slides[0].cloneNode(true);
    const lastClone = slides[total - 1].cloneNode(true);

    firstClone.setAttribute('aria-hidden', 'true');
    lastClone.setAttribute('aria-hidden', 'true');

    track.insertBefore(lastClone, slides[0]);
    track.appendChild(firstClone);

    const targetSlug = new URLSearchParams(window.location.search).get('coach');
    if (targetSlug) {
        const matchIndex = slides.findIndex(function (s) { return s.dataset.coachSlug === targetSlug; });
        if (matchIndex !== -1) current = matchIndex + 1;
    }

    function syncHeight(animate) {
        if (window.innerWidth > 767) {
            slider.style.height = '';
            return;
        }
        slider.style.transition = animate ? 'height 500ms ease' : 'none';
        slider.style.height = track.children[current].offsetHeight + 'px';
    }

    function updatePosition(useTransition) {
        track.style.transition = useTransition ? transitionValue : 'none';
        track.style.transform = 'translateX(-' + (current * 100) + '%)';
    }

    function goTo(index) {
        if (isAnimating) return;

        current = index;
        isAnimating = true;
        updatePosition(true);
        syncHeight(true);
    }

    updatePosition(false);
    syncHeight(false);

    track.addEventListener('transitionend', function (event) {
        if (event.propertyName !== 'transform') return;

        if (current === 0 || current === total + 1) {
            current = current === 0 ? total : 1;
            track.style.transition = 'none';
            track.style.transform = 'translateX(-' + (current * 100) + '%)';
            syncHeight(false);
            requestAnimationFrame(function () {
                track.style.transition = transitionValue;
            });
        }

        isAnimating = false;
    });

    window.addEventListener('resize', function () { syncHeight(false); });

    prevBtn.addEventListener('click', function () {
        goTo(current - 1);
    });

    nextBtn.addEventListener('click', function () {
        goTo(current + 1);
    });
});
