(function() {
  document.querySelectorAll('[data-video-player]').forEach(function(container) {
    var video = container.querySelector('video');
    var playBtn = container.querySelector('.sd-video__play-btn');
    var overlay = container.querySelector('[data-video-overlay]');

    if (!video || !playBtn) return;

    playBtn.addEventListener('click', function() {
      video.play();
      playBtn.classList.add('is-hidden');
      if (overlay) overlay.classList.add('is-hidden');
      video.setAttribute('controls', '');
    });

    video.addEventListener('pause', function() {
      playBtn.classList.remove('is-hidden');
      if (overlay) overlay.classList.remove('is-hidden');
      video.removeAttribute('controls');
    });

    video.addEventListener('ended', function() {
      playBtn.classList.remove('is-hidden');
      if (overlay) overlay.classList.remove('is-hidden');
      video.removeAttribute('controls');
    });
  });
})();
