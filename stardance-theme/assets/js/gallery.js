/**
 * Star Dance Studio - Gallery filters and PhotoSwipe initialization.
 */
(function () {
  const galleryGrid = document.querySelector('[data-gallery-grid]');
  if (!galleryGrid) return;

  const showMoreButton = document.querySelector('[data-gallery-show-more]');
  let activeLightbox = null;
  let isFetchingMoreInLightbox = false;
  const state = {
    photo_year: 'all',
    gallery_type: 'all',
    gallery_occasion: 'all',
    paged: 1,
    posts_per_page: 12,
  };

  function getGalleryLinks() {
    return Array.from(galleryGrid.querySelectorAll('.sd-gallery-page__item'));
  }

  function getGalleryItems() {
    return getGalleryLinks().map((link) => {
      const image = link.querySelector('img');

      return {
        src: link.getAttribute('href'),
        width: parseInt(link.dataset.pswpWidth || '0', 10),
        height: parseInt(link.dataset.pswpHeight || '0', 10),
        alt: image ? image.getAttribute('alt') || '' : '',
      };
    });
  }

  function openLightbox(index) {
    if (typeof window.PhotoSwipeLightbox === 'undefined' || typeof window.PhotoSwipe5 === 'undefined') {
      return;
    }

    const items = getGalleryItems();
    if (!items.length) {
      return;
    }

    if (activeLightbox) {
      activeLightbox.destroy();
      activeLightbox = null;
    }

    const lightbox = new window.PhotoSwipeLightbox({
      dataSource: items,
      index,
      pswpModule: window.PhotoSwipe5,
      bgOpacity: 1,
      showHideAnimationType: 'zoom',
      paddingFn: () => ({ top: 24, bottom: 24, left: 24, right: 24 }),
      returnFocus: false,
      trapFocus: true,
    });

    lightbox.on('change', function () {
      const pswp = lightbox.pswp;
      if (!pswp) {
        return;
      }

      const currentIndex = pswp.currIndex ?? 0;
      const atLastLoadedItem = currentIndex >= getGalleryItems().length - 1;

      if (!atLastLoadedItem || !showMoreButton || showMoreButton.hidden || isFetchingMoreInLightbox) {
        return;
      }

      isFetchingMoreInLightbox = true;
      state.paged += 1;

      fetchFilteredGallery({ append: true }).then((appended) => {
        if (!appended) {
          state.paged -= 1;
          return;
        }

        if (lightbox.pswp) {
          lightbox.pswp.options.dataSource = getGalleryItems();

          if (typeof lightbox.pswp.refreshSlideContent === 'function') {
            lightbox.pswp.refreshSlideContent(currentIndex);
            if (currentIndex + 1 < lightbox.pswp.getNumItems()) {
              lightbox.pswp.refreshSlideContent(currentIndex + 1);
            }
          }
        }
      }).finally(() => {
        isFetchingMoreInLightbox = false;
      });
    });

    lightbox.on('destroy', function () {
      isFetchingMoreInLightbox = false;
    });

    activeLightbox = lightbox;
    lightbox.init();
    lightbox.loadAndOpen(index, { gallery: galleryGrid });
  }

  async function fetchFilteredGallery(options = {}) {
    if (typeof stardanceGallery === 'undefined') {
      return false;
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
          return true;
        }
      } else {
        galleryGrid.innerHTML = payload.data.markup;
      }

      if (showMoreButton) {
        showMoreButton.hidden = !payload.data.has_more;
      }
      return !append;
    } catch (error) {
      console.error('Gallery filter request failed', error);
      return false;
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

  galleryGrid.addEventListener('click', function (event) {
    const link = event.target.closest('.sd-gallery-page__item');
    if (!link) {
      return;
    }

    const links = getGalleryLinks();
    const index = links.indexOf(link);

    if (index < 0) {
      return;
    }

    event.preventDefault();
    openLightbox(index);
  });

  document.addEventListener('click', function (event) {
    const filterButton = event.target.closest('.sd-gallery-page__tab');
    if (filterButton) {
      updateActiveTab(filterButton);
      fetchFilteredGallery();
      return;
    }

    const showMore = event.target.closest('[data-gallery-show-more]');
    if (!showMore || showMore.hidden || showMore.disabled) {
      return;
    }

    state.paged += 1;
    fetchFilteredGallery({ append: true });
  });
})();
