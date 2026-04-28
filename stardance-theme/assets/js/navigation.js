/**
 * Star Dance Studio - Navigation
 * Sticky header scroll behavior + mobile menu toggle
 */
(function () {
  const header = document.getElementById('site-header');
  const toggle = document.getElementById('menu-toggle');
  const nav = document.getElementById('site-nav');
  const SCROLL_THRESHOLD = 100;

  if (!header) return;

  // Sticky header - add .scrolling class on scroll + hide/show on direction
  const HIDE_THRESHOLD = 400;
  let lastScrollY = 0;
  let ticking = false;

  function onScroll() {
    if (!ticking) {
      window.requestAnimationFrame(function () {
        var currentScrollY = window.scrollY;

        if (currentScrollY > SCROLL_THRESHOLD) {
          header.classList.add('scrolling');
        } else {
          header.classList.remove('scrolling');
        }

        if (currentScrollY > HIDE_THRESHOLD) {
          if (currentScrollY > lastScrollY) {
            header.classList.add('header-hidden');
          } else {
            header.classList.remove('header-hidden');
          }
        } else {
          header.classList.remove('header-hidden');
        }

        lastScrollY = currentScrollY;
        ticking = false;
      });
      ticking = true;
    }
  }
  window.addEventListener('scroll', onScroll, { passive: true });

  // Mobile menu toggle
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      const expanded = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!expanded));
      nav.classList.toggle('is-open');
      toggle.classList.toggle('is-active');
      document.body.classList.toggle('menu-open');
    });

    // Close menu on anchor link click
    nav.querySelectorAll('a[href*="#"]').forEach(function (link) {
      link.addEventListener('click', function () {
        nav.classList.remove('is-open');
        toggle.classList.remove('is-active');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('menu-open');
      });
    });
  }

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(function (link) {
    link.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      const target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        const headerHeight = header.offsetHeight;
        const targetPos = target.getBoundingClientRect().top + window.scrollY - headerHeight;
        window.scrollTo({ top: targetPos, behavior: 'smooth' });
      }
    });
  });
})();
