/**
 * About page — coach slider (Swiper)
 */
(function () {
  'use strict';

  var el = document.querySelector('.js-sd-about-coaches');
  if (!el || typeof Swiper === 'undefined') return;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var initialIndex = 0;
  var slug = new URLSearchParams(window.location.search).get('coach');
  if (slug) {
    var slides = Array.from(el.querySelectorAll('.swiper-slide'));
    var match = slides.findIndex(function (s) { return s.dataset.coachSlug === slug; });
    if (match !== -1) initialIndex = match;
  }

  var swiper = new Swiper(el, {
    loop: true,
    speed: reduceMotion ? 0 : 500,
    autoHeight: true,
    slidesPerView: 1,
    navigation: {
      prevEl: '.sd-about-coach__arrow--prev',
      nextEl: '.sd-about-coach__arrow--next',
    },
  });

  if (initialIndex > 0) {
    swiper.slideToLoop(initialIndex, 0);
  }
}());
