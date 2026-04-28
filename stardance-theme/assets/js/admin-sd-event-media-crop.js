/**
 * sd_event admin modal cropper for media previews.
 */
(function ($) {
  'use strict';

  var SELECTOR_BUTTON = '.stardance-media-crop-open';
  var SELECTOR_MODAL = '.stardance-media-crop-modal';
  var SELECTOR_OVERLAY = '.stardance-media-crop-overlay';
  var SELECTOR_CARD = '.stardance-media-crop-card';
  var SELECTOR_CANVAS = '.stardance-media-crop-preview-canvas';
  var currentAttachment = null;

  function config() {
    if (typeof stardanceMediaCropAdmin !== 'object' || !stardanceMediaCropAdmin) {
      return null;
    }
    return stardanceMediaCropAdmin;
  }

  function escapeHtml(value) {
    return String(value || '')
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  function fileNameBase(url) {
    var clean = String(url || '').split('?')[0];
    var last = clean.substring(clean.lastIndexOf('/') + 1);
    if (!last) {
      return 'cropped-image';
    }
    var dot = last.lastIndexOf('.');
    return dot > 0 ? last.substring(0, dot) : last;
  }

  function activeAttachmentFromMediaModal() {
    var idRaw = $('.attachment-details').attr('data-id') || '';
    var id = parseInt(idRaw, 10);
    if (!id || typeof wp === 'undefined' || !wp.media || !wp.media.attachment) {
      return null;
    }
    return wp.media.attachment(id);
  }

  function ensureTriggerButton() {
    var cfg = config();
    if (!cfg) {
      return;
    }

    $('.attachment-details').each(function () {
      var $panel = $(this);
      if ($panel.find(SELECTOR_BUTTON).length) {
        return;
      }
      var hasImagePreview = $panel.find('.details-image img').length > 0;
      if (!hasImagePreview) {
        return;
      }
      var $btn = $('<button/>', {
        type: 'button',
        class: 'button button-secondary stardance-media-crop-open',
        text: cfg.i18n.openButton,
      });
      $panel.find('.attachment-actions').append($btn);
    });
  }

  function ratioCardsHtml(ratios, i18n) {
    return ratios
      .map(function (ratio) {
        return (
          '<section class="stardance-media-crop-card" data-ratio-key="' +
          escapeHtml(ratio.key) +
          '">' +
          '<h4>' +
          escapeHtml(ratio.label) +
          '</h4>' +
          '<div class="stardance-media-crop-inputs">' +
          '<label>W <input type="number" min="1" class="stardance-media-crop-width" value="' +
          escapeHtml(ratio.width) +
          '"></label>' +
          '<label>H <input type="number" min="1" class="stardance-media-crop-height" value="' +
          escapeHtml(ratio.height) +
          '"></label>' +
          '</div>' +
          '<canvas class="stardance-media-crop-preview-canvas" width="320" height="160"></canvas>' +
          '<div class="stardance-media-crop-actions">' +
          '<button type="button" class="button button-primary stardance-media-crop-save">' +
          escapeHtml(i18n.saveButton) +
          '</button>' +
          '<button type="button" class="button stardance-media-crop-insert" disabled>' +
          escapeHtml(i18n.insertButton) +
          '</button>' +
          '</div>' +
          '<div class="stardance-media-crop-status" aria-live="polite"></div>' +
          '</section>'
        );
      })
      .join('');
  }

  function buildModalMarkup() {
    var cfg = config();
    if (!cfg || $(SELECTOR_MODAL).length) {
      return;
    }

    var html =
      '<div class="stardance-media-crop-overlay" hidden>' +
      '<div class="stardance-media-crop-modal" role="dialog" aria-modal="true" aria-label="' +
      escapeHtml(cfg.i18n.modalTitle) +
      '">' +
      '<header class="stardance-media-crop-header">' +
      '<h3>' +
      escapeHtml(cfg.i18n.modalTitle) +
      '</h3>' +
      '<button type="button" class="button-link stardance-media-crop-close">' +
      escapeHtml(cfg.i18n.closeLabel) +
      '</button>' +
      '</header>' +
      '<div class="stardance-media-crop-grid">' +
      ratioCardsHtml(cfg.ratios, cfg.i18n) +
      '</div>' +
      '</div>' +
      '</div>';

    $('body').append(html);
  }

  function openModalForAttachment(attachment) {
    var cfg = config();
    if (!cfg || !attachment) {
      return;
    }
    currentAttachment = attachment;
    syncInsertVisibility();
    $(SELECTOR_OVERLAY).removeAttr('hidden');
    refreshAllPreviews();
  }

  function closeModal() {
    $(SELECTOR_OVERLAY).attr('hidden', 'hidden');
    currentAttachment = null;
  }

  function cropRect(imageWidth, imageHeight, targetRatio) {
    var srcRatio = imageWidth / imageHeight;
    var x = 0;
    var y = 0;
    var width = imageWidth;
    var height = imageHeight;

    if (srcRatio > targetRatio) {
      width = Math.round(imageHeight * targetRatio);
      x = Math.round((imageWidth - width) / 2);
    } else if (srcRatio < targetRatio) {
      height = Math.round(imageWidth / targetRatio);
      y = Math.round((imageHeight - height) / 2);
    }

    return { x: x, y: y, width: width, height: height };
  }

  function loadImage(url) {
    return new Promise(function (resolve, reject) {
      var img = new Image();
      img.crossOrigin = 'anonymous';
      img.onload = function () {
        resolve(img);
      };
      img.onerror = function () {
        reject(new Error('image-load-failed'));
      };
      img.src = url;
    });
  }

  function cardRatio($card) {
    var width = parseInt($card.find('.stardance-media-crop-width').val(), 10);
    var height = parseInt($card.find('.stardance-media-crop-height').val(), 10);
    if (!width || !height || width < 1 || height < 1) {
      return null;
    }
    return width / height;
  }

  function drawPreview($card, image) {
    var ratio = cardRatio($card);
    var cfg = config();
    var $status = $card.find('.stardance-media-crop-status');

    if (!ratio) {
      $status.text(cfg.i18n.invalidRatio);
      return;
    }

    var rect = cropRect(image.width, image.height, ratio);
    var canvas = $card.find(SELECTOR_CANVAS).get(0);
    var maxWidth = 320;
    var previewHeight = Math.max(100, Math.round(maxWidth / ratio));

    canvas.width = maxWidth;
    canvas.height = previewHeight;

    var ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(
      image,
      rect.x,
      rect.y,
      rect.width,
      rect.height,
      0,
      0,
      canvas.width,
      canvas.height
    );
    $status.text('');
  }

  function currentSourceUrl() {
    if (!currentAttachment) {
      return '';
    }
    var sizes = currentAttachment.get('sizes');
    if (sizes && sizes.full && sizes.full.url) {
      return sizes.full.url;
    }
    return currentAttachment.get('url') || '';
  }

  function refreshAllPreviews() {
    var cfg = config();
    var url = currentSourceUrl();
    if (!cfg || !url) {
      return;
    }

    loadImage(url)
      .then(function (image) {
        $(SELECTOR_CARD).each(function () {
          drawPreview($(this), image);
        });
      })
      .catch(function () {
        $(SELECTOR_CARD)
          .find('.stardance-media-crop-status')
          .text(cfg.i18n.invalidImage);
      });
  }

  function canvasDataUrlForCard($card) {
    var canvas = $card.find(SELECTOR_CANVAS).get(0);
    if (!canvas) {
      return '';
    }
    return canvas.toDataURL('image/jpeg', 0.92);
  }

  function uploadCardCrop($card) {
    var cfg = config();
    if (!cfg || !currentAttachment) {
      return;
    }

    var ratioKey = String($card.attr('data-ratio-key') || 'ratio');
    var dataUrl = canvasDataUrlForCard($card);
    var source = currentSourceUrl();
    var baseName = fileNameBase(source);
    var fileName = baseName + '-' + ratioKey + '.jpg';
    var title = (currentAttachment.get('title') || baseName) + ' (' + ratioKey + ')';
    var $status = $card.find('.stardance-media-crop-status');
    var $save = $card.find('.stardance-media-crop-save');

    if (!dataUrl) {
      $status.text(cfg.i18n.uploadError);
      return;
    }

    $save.prop('disabled', true).text(cfg.i18n.processingLabel);
    $status.text('');

    $.post(cfg.ajaxurl, {
      action: 'stardance_upload_cropped_image',
      nonce: cfg.nonce,
      dataUrl: dataUrl,
      filename: fileName,
      title: title,
      sourceAttachmentId: currentAttachment.id,
    })
      .done(function (response) {
        if (!response || !response.success || !response.data || !response.data.id) {
          $status.text(cfg.i18n.uploadError);
          return;
        }

        var uploadedId = parseInt(response.data.id, 10);
        $card.attr('data-uploaded-id', uploadedId);
        $card.find('.stardance-media-crop-insert').prop('disabled', false);
        $status.html(
          '<span>' +
            escapeHtml(cfg.i18n.uploadedLabel) +
            ': #' +
            uploadedId +
            '</span>' +
            (response.data.thumb
              ? '<img src="' + escapeHtml(response.data.thumb) + '" alt="" />'
              : '')
        );
      })
      .fail(function () {
        $status.text(cfg.i18n.uploadError);
      })
      .always(function () {
        $save.prop('disabled', false).text(cfg.i18n.saveButton);
      });
  }

  function insertUploadedToGallery($card) {
    if (!hasEventGalleryField()) {
      return;
    }
    var uploadedId = parseInt($card.attr('data-uploaded-id'), 10);
    if (!uploadedId) {
      return;
    }
    $(document).trigger('stardance:event-gallery:append', [[uploadedId]]);
  }

  function hasEventGalleryField() {
    return $('#stardance_event_gallery_ids').length > 0;
  }

  function syncInsertVisibility() {
    var canInsert = hasEventGalleryField();
    var $buttons = $(SELECTOR_CARD).find('.stardance-media-crop-insert');
    if (canInsert) {
      $buttons.removeClass('is-hidden');
    } else {
      $buttons.addClass('is-hidden').prop('disabled', true);
    }
  }

  function bindEvents() {
    $(document).on('click', SELECTOR_BUTTON, function (e) {
      e.preventDefault();
      var attachment = activeAttachmentFromMediaModal();
      if (!attachment) {
        return;
      }
      attachment.fetch().then(function () {
        openModalForAttachment(attachment);
      });
    });

    $(document).on('click', '.stardance-media-crop-close', function (e) {
      e.preventDefault();
      closeModal();
    });

    $(document).on('click', SELECTOR_OVERLAY, function (e) {
      if ($(e.target).is(SELECTOR_OVERLAY)) {
        closeModal();
      }
    });

    $(document).on(
      'input',
      '.stardance-media-crop-width, .stardance-media-crop-height',
      function () {
        refreshAllPreviews();
      }
    );

    $(document).on('click', '.stardance-media-crop-save', function (e) {
      e.preventDefault();
      uploadCardCrop($(this).closest(SELECTOR_CARD));
    });

    $(document).on('click', '.stardance-media-crop-insert', function (e) {
      e.preventDefault();
      insertUploadedToGallery($(this).closest(SELECTOR_CARD));
    });

    $(document).on('DOMNodeInserted', '.attachment-details', function () {
      ensureTriggerButton();
    });
  }

  $(function () {
    buildModalMarkup();
    ensureTriggerButton();
    bindEvents();
  });
})(jQuery);
