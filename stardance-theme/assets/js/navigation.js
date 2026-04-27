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

  function parseRgbColor(color) {
    if (!color) return null;
    var match = color.match(/rgba?\(([^)]+)\)/i);
    if (!match) return null;
    var parts = match[1].split(',').map(function (part) {
      return parseFloat(part.trim());
    });
    if (parts.length < 3 || parts.some(isNaN)) return null;
    return {
      r: parts[0],
      g: parts[1],
      b: parts[2],
      a: typeof parts[3] === 'number' && !isNaN(parts[3]) ? parts[3] : 1
    };
  }

  function isLightBackground(color) {
    var parsed = parseRgbColor(color);
    if (!parsed || parsed.a < 0.9) return false;
    var brightness = (parsed.r * 299 + parsed.g * 587 + parsed.b * 114) / 1000;
    return brightness >= 235;
  }

  function syncHeaderToneState() {
    var headerBg = window.getComputedStyle(header).backgroundColor;
    header.classList.toggle('has-light-bg', isLightBackground(headerBg));
  }

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
        syncHeaderToneState();

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
  window.addEventListener('resize', syncHeaderToneState);
  syncHeaderToneState();

  // Mobile menu toggle
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      const expanded = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!expanded));
      nav.classList.toggle('is-open');
      toggle.classList.toggle('is-active');
      document.body.classList.toggle('menu-open');
      syncHeaderToneState();
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
