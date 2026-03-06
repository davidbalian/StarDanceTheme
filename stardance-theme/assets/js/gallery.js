/**
 * Star Dance Studio - Gallery
 * PhotoSwipe lightbox initialization
 */
(function () {
  if (typeof PhotoSwipeLightbox === 'undefined') return;

  // Portrait gallery
  const portraitGallery = new PhotoSwipeLightbox({
    gallery: '#gallery-portrait',
    children: 'a',
    pswpModule: PhotoSwipe,
    bgOpacity: 0.9,
    padding: { top: 20, bottom: 20, left: 20, right: 20 },
  });
  portraitGallery.init();

  // Landscape gallery
  const landscapeGallery = new PhotoSwipeLightbox({
    gallery: '#gallery-landscape',
    children: 'a',
    pswpModule: PhotoSwipe,
    bgOpacity: 0.9,
    padding: { top: 20, bottom: 20, left: 20, right: 20 },
  });
  landscapeGallery.init();
})();
