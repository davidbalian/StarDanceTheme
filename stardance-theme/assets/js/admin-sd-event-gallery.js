/**
 * Event gallery: multi-select in admin (sd_event).
 */
(function ($) {
  'use strict';

  function parseIds(str) {
    if (!str || typeof str !== 'string') {
      return [];
    }
    return str
      .split(',')
      .map(function (s) {
        return parseInt(s, 10);
      })
      .filter(function (n) {
        return n > 0;
      });
  }

  function uniqueIds(ids) {
    return ids.filter(function (x, i, a) {
      return a.indexOf(x) === i;
    });
  }

  function refreshPreview($hidden, $preview) {
    var ids = parseIds($hidden.val());
    $preview.empty();
    if (!ids.length || typeof wp === 'undefined' || !wp.media) {
      return;
    }
    ids.forEach(function (id) {
      var att = wp.media.attachment(id);
      att.fetch().then(function () {
        var sizes = att.get('sizes');
        var url =
          sizes && sizes.thumbnail
            ? sizes.thumbnail.url
            : att.get('url');
        if (!url) {
          return;
        }
        var $wrap = $('<span class="stardance-event-gallery-thumb"/>');
        $wrap.append(
          $('<img/>', {
            src: url,
            alt: '',
            width: 72,
            height: 72,
            css: { objectFit: 'cover', display: 'block', borderRadius: '4px' },
          })
        );
        $preview.append($wrap);
      });
    });
  }

  $(function () {
    var $hidden = $('#stardance_event_gallery_ids');
    var $preview = $('#stardance-event-gallery-preview');
    var $add = $('#stardance-event-gallery-add');
    var $clear = $('#stardance-event-gallery-clear');

    if (!$hidden.length || !$add.length) {
      return;
    }

    var frame = null;

    $add.on('click', function (e) {
      e.preventDefault();
      if (typeof wp === 'undefined' || !wp.media) {
        return;
      }
      if (frame) {
        frame.open();
        return;
      }
      frame = wp.media({
        title: stardanceEventAdmin.galleryTitle,
        button: { text: stardanceEventAdmin.galleryButton },
        multiple: true,
        library: { type: 'image' },
      });
      frame.on('select', function () {
        var existing = parseIds($hidden.val());
        frame.state().get('selection').each(function (att) {
          existing.push(att.id);
        });
        $hidden.val(uniqueIds(existing).join(','));
        refreshPreview($hidden, $preview);
      });
      frame.open();
    });

    $clear.on('click', function (e) {
      e.preventDefault();
      $hidden.val('');
      $preview.empty();
    });
  });
})(jQuery);
