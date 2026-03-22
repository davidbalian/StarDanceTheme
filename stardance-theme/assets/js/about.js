/**
 * About page — coach slider
 */
document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.sd-about-coach__track');
    if (!track) return;

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

    function updatePosition(useTransition) {
        track.style.transition = useTransition ? transitionValue : 'none';
        track.style.transform = 'translateX(-' + (current * 100) + '%)';
    }

    function goTo(index) {
        if (isAnimating) return;

        current = index;
        isAnimating = true;
        updatePosition(true);
    }

    updatePosition(false);

    track.addEventListener('transitionend', function (event) {
        if (event.propertyName !== 'transform') return;

        if (current === 0) {
            current = total;
            updatePosition(false);
        } else if (current === total + 1) {
            current = 1;
            updatePosition(false);
        }

        isAnimating = false;
    });

    prevBtn.addEventListener('click', function () {
        goTo(current - 1);
    });

    nextBtn.addEventListener('click', function () {
        goTo(current + 1);
    });
});
