(function () {
  'use strict';

  var el = document.querySelector('.js-sd-home-coaches');
  if (!el || typeof Swiper === 'undefined') return;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  new Swiper(el, {
    loop: true,
    loopAdditionalSlides: 2,
    speed: reduceMotion ? 0 : 950,
    grabCursor: true,
    slidesPerView: 1.2,
    spaceBetween: 24,
    breakpoints: {
      768: { slidesPerView: 2.2 },
      992: { slidesPerView: 2.5 },
    },
    autoplay: reduceMotion ? false : {
      delay: 4000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.sd-coaches__pagination',
      clickable: true,
      bulletClass: 'sd-coaches__dot',
      bulletActiveClass: 'sd-coaches__dot--active',
      renderBullet: function (i, cls) {
        return '<button type="button" class="' + cls + '" aria-label="' + (i + 1) + ' of ' + this.slides.length + '"></button>';
      },
    },
  });
}());
