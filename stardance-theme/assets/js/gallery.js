/**
 * Star Dance Studio - Gallery filters and PhotoSwipe initialization.
 */
(function () {
  const galleryGrid = document.querySelector('[data-gallery-grid]');
  if (!galleryGrid) return;

  let lightbox = null;
  const state = {
    photo_year: 'all',
    gallery_type: 'all',
    gallery_occasion: 'all',
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

  async function fetchFilteredGallery() {
    if (typeof stardanceGallery === 'undefined') {
      return;
    }

    const formData = new FormData();
    formData.append('action', 'stardance_filter_gallery');
    formData.append('nonce', stardanceGallery.nonce);
    formData.append('photo_year', state.photo_year);
    formData.append('gallery_type', state.gallery_type);
    formData.append('gallery_occasion', state.gallery_occasion);

    galleryGrid.classList.add('is-loading');

    try {
      const response = await fetch(stardanceGallery.ajaxurl, {
        method: 'POST',
        body: formData,
      });

      const payload = await response.json();
      if (!payload.success || !payload.data || typeof payload.data.markup !== 'string') {
        throw new Error('Invalid gallery response');
      }

      galleryGrid.innerHTML = payload.data.markup;
      initLightbox();
    } catch (error) {
      console.error('Gallery filter request failed', error);
    } finally {
      galleryGrid.classList.remove('is-loading');
    }
  }

  function updateActiveTab(button) {
    const filterGroup = button.dataset.filterGroup;
    const filterValue = button.dataset.filterValue;

    if (!filterGroup || typeof filterValue === 'undefined') {
      return;
    }

    state[filterGroup] = filterValue;

    document.querySelectorAll(`[data-filter-group="${filterGroup}"]`).forEach((tab) => {
      const isActive = tab === button;
      tab.classList.toggle('is-active', isActive);
      tab.setAttribute('aria-pressed', isActive ? 'true' : 'false');
    });
  }

  document.addEventListener('click', (event) => {
    const button = event.target.closest('.sd-gallery-page__tab');
    if (!button) return;

    updateActiveTab(button);
    fetchFilteredGallery();
  });

  initLightbox();
})();
