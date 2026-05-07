/* global stardanceEvents */
(function () {
  'use strict';

  var eventsGrid = document.querySelector('[data-events-grid]');
  if (!eventsGrid) return;

  var showMoreButton = document.querySelector('[data-events-show-more]');
  var state = {
    event_year: 'all',
    event_category: 'all',
    event_type: 'all',
    event_style: 'all',
    paged: 1,
    posts_per_page: 12,
  };

  async function fetchFilteredEvents(options) {
    options = options || {};
    if (typeof stardanceEvents === 'undefined') return false;

    var append = Boolean(options.append);
    var formData = new FormData();
    formData.append('action', 'stardance_filter_events');
    formData.append('nonce', stardanceEvents.nonce);
    formData.append('event_year', state.event_year);
    formData.append('event_category', state.event_category);
    formData.append('event_type', state.event_type);
    formData.append('event_style', state.event_style);
    formData.append('paged', state.paged);
    formData.append('posts_per_page', state.posts_per_page);

    eventsGrid.classList.add('is-loading');
    if (showMoreButton) showMoreButton.disabled = true;

    try {
      var response = await fetch(stardanceEvents.ajaxurl, { method: 'POST', body: formData });
      var payload = await response.json();

      if (!payload.success || !payload.data || typeof payload.data.markup !== 'string') {
        throw new Error('Invalid events response');
      }

      if (append) {
        if (payload.data.markup.trim()) {
          eventsGrid.insertAdjacentHTML('beforeend', payload.data.markup);
          if (showMoreButton) {
            showMoreButton.hidden = !payload.data.has_more;
          }
          return true;
        }
      } else {
        eventsGrid.innerHTML = payload.data.markup;
      }

      if (showMoreButton) {
        showMoreButton.hidden = !payload.data.has_more;
      }
      return !append;
    } catch (err) {
      console.error('Events filter request failed', err);
      return false;
    } finally {
      eventsGrid.classList.remove('is-loading');
      if (showMoreButton) showMoreButton.disabled = false;
    }
  }

  function updateActiveFilter(button) {
    var filterGroup = button.dataset.filterGroup;
    var filterValue = button.dataset.filterValue;
    if (!filterGroup || typeof filterValue === 'undefined') return;
    state[filterGroup] = filterValue;
    state.paged = 1;
    document.querySelectorAll('[data-filter-group="' + filterGroup + '"]').forEach(function (btn) {
      var isActive = btn === button;
      btn.classList.toggle('is-active', isActive);
      btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
    });
  }

  document.addEventListener('click', function (e) {
    var filterButton = e.target.closest('.sd-events-filter__btn');
    if (filterButton) {
      updateActiveFilter(filterButton);
      fetchFilteredEvents();
      return;
    }
    var showMore = e.target.closest('[data-events-show-more]');
    if (!showMore || showMore.hidden || showMore.disabled) return;
    state.paged += 1;
    fetchFilteredEvents({ append: true });
  });

})();

/* Filters mobile accordion */
(function () {
  var wrapper = document.querySelector('.sd-events-filter-mobile');
  if (!wrapper) return;
  var toggle = wrapper.querySelector('.sd-events-filter-mobile__toggle');
  var panel  = wrapper.querySelector('.sd-events-filter-mobile__panel');
  if (!toggle || !panel) return;

  var mq = window.matchMedia('(max-width: 767px)');

  function openPanel() {
    wrapper.classList.add('is-open');
    toggle.setAttribute('aria-expanded', 'true');
    panel.hidden = false;
    panel.style.height = '0px';
    panel.offsetHeight;
    panel.style.height = panel.scrollHeight + 'px';
  }

  function closePanel() {
    toggle.setAttribute('aria-expanded', 'false');
    panel.style.height = panel.scrollHeight + 'px';
    panel.offsetHeight;
    panel.style.height = '0px';
    wrapper.classList.remove('is-open');
  }

  panel.addEventListener('transitionend', function (e) {
    if (e.propertyName !== 'height') return;
    if (toggle.getAttribute('aria-expanded') === 'true') {
      panel.style.height = 'auto';
    } else {
      panel.hidden = true;
    }
  });

  toggle.addEventListener('click', function () {
    if (toggle.getAttribute('aria-expanded') === 'true') closePanel();
    else openPanel();
  });

  function syncToViewport() {
    if (mq.matches) {
      if (toggle.getAttribute('aria-expanded') !== 'true') {
        panel.hidden = true;
        panel.style.height = '0px';
      }
    } else {
      panel.hidden = false;
      panel.style.height = '';
    }
  }

  if (mq.addEventListener) mq.addEventListener('change', syncToViewport);
  else mq.addListener(syncToViewport);

  syncToViewport();
})();
