/**
 * Star Dance Studio - Gallery filters and PhotoSwipe initialization.
 */
(function () {
  const galleryGrid = document.querySelector('[data-gallery-grid]');
  if (!galleryGrid) return;
  const showMoreButton = document.querySelector('[data-gallery-show-more]');

  let lightbox = null;
  const state = {
    photo_year: 'all',
    gallery_type: 'all',
    gallery_occasion: 'all',
    paged: 1,
    posts_per_page: 12,
  };

  function initLightbox() {
    if (typeof PhotoSwipeLightbox === 'undefined' || typeof PhotoSwipe === 'undefined') {
      return;
    }

    if (lightbox) {
      lightbox.destroy();
    }

    lightbox = new PhotoSwipeLightbox({
      gallery: '[data-photoswipe-gallery]',
      children: 'a',
      pswpModule: PhotoSwipe,
      bgOpacity: 0.92,
      padding: { top: 24, bottom: 24, left: 24, right: 24 },
    });

    lightbox.init();
  }

  async function fetchFilteredGallery(options = {}) {
    if (typeof stardanceGallery === 'undefined') {
      return;
    }

    const append = Boolean(options.append);

    const formData = new FormData();
    formData.append('action', 'stardance_filter_gallery');
    formData.append('nonce', stardanceGallery.nonce);
    formData.append('photo_year', state.photo_year);
    formData.append('gallery_type', state.gallery_type);
    formData.append('gallery_occasion', state.gallery_occasion);
    formData.append('paged', state.paged);
    formData.append('posts_per_page', state.posts_per_page);

    galleryGrid.classList.add('is-loading');
    if (showMoreButton) {
      showMoreButton.disabled = true;
    }

    try {
      const response = await fetch(stardanceGallery.ajaxurl, {
        method: 'POST',
        body: formData,
      });

      const payload = await response.json();
      if (!payload.success || !payload.data || typeof payload.data.markup !== 'string') {
        throw new Error('Invalid gallery response');
      }

      if (append) {
        if (payload.data.markup.trim()) {
          galleryGrid.insertAdjacentHTML('beforeend', payload.data.markup);
        }
      } else {
        galleryGrid.innerHTML = payload.data.markup;
      }

      if (showMoreButton) {
        showMoreButton.hidden = !payload.data.has_more;
      }

      initLightbox();
    } catch (error) {
      console.error('Gallery filter request failed', error);
    } finally {
      galleryGrid.classList.remove('is-loading');
      if (showMoreButton) {
        showMoreButton.disabled = false;
      }
    }
  }

  function updateActiveTab(button) {
    const filterGroup = button.dataset.filterGroup;
    const filterValue = button.dataset.filterValue;

    if (!filterGroup || typeof filterValue === 'undefined') {
      return;
    }

    state[filterGroup] = filterValue;
    state.paged = 1;

    document.querySelectorAll(`[data-filter-group="${filterGroup}"]`).forEach((tab) => {
      const isActive = tab === button;
      tab.classList.toggle('is-active', isActive);
      tab.setAttribute('aria-pressed', isActive ? 'true' : 'false');
    });
  }

  document.addEventListener('click', (event) => {
    const button = event.target.closest('.sd-gallery-page__tab');
    if (button) {
      updateActiveTab(button);
      fetchFilteredGallery();
      return;
    }

    const showMore = event.target.closest('[data-gallery-show-more]');
    if (!showMore) return;
    if (showMore.hidden || showMore.disabled) return;

    state.paged += 1;
    fetchFilteredGallery({ append: true });
  });

  initLightbox();
})();
