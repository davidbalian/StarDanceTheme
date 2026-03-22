/**
 * About page — coach slider
 */
document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.sd-about-coach__track');
    if (!track) return;

    const slides = track.querySelectorAll('.sd-about-coach__slide');
    const prevBtn = document.querySelector('.sd-about-coach__arrow--prev');
    const nextBtn = document.querySelector('.sd-about-coach__arrow--next');
    const total = slides.length;
    let current = 0;

    function goTo(index) {
        current = (index + total) % total;
        track.style.transform = 'translateX(-' + (current * 100) + '%)';
    }

    prevBtn.addEventListener('click', function () { goTo(current - 1); });
    nextBtn.addEventListener('click', function () { goTo(current + 1); });
});
