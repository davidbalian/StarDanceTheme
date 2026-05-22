(function () {
  'use strict';

  var el = document.querySelector('.js-sd-home-coaches');
  if (!el || typeof Swiper === 'undefined') return;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var mq = window.matchMedia('(min-width: 1025px)');
  var swiper = null;

  function initSwiper() {
    if (swiper) return;
    swiper = new Swiper(el, {
      loop: true,
      speed: reduceMotion ? 0 : 700,
      grabCursor: true,
      slidesPerView: 1.2,
      spaceBetween: 24,
      breakpoints: {
        768: { slidesPerView: 2.5 },
      },
      autoplay: reduceMotion ? false : {
        delay: 5000,
        disableOnInteraction: true,
        pauseOnMouseEnter: true,
      },
      pagination: {
        el: '.sd-coaches__pagination',
        clickable: true,
        bulletClass: 'sd-coaches__dot',
        bulletActiveClass: 'sd-coaches__dot--active',
        renderBullet: function (i, cls) {
          // Only show 3 bullets (one per real coach); hide the duplicate-set bullets
          if (i >= 3) return '<span class="' + cls + ' sd-coaches__dot--hidden"></span>';
          return '<button type="button" class="' + cls + '" aria-label="Coach ' + (i + 1) + '"></button>';
        },
      },
    });
  }

  function destroySwiper() {
    if (!swiper) return;
    swiper.destroy(true, true);
    swiper = null;
  }

  function update(isDesktop) {
    if (isDesktop) {
      destroySwiper();
    } else {
      initSwiper();
    }
  }

  mq.addEventListener('change', function (e) {
    update(e.matches);
  });

  update(mq.matches);
}());
