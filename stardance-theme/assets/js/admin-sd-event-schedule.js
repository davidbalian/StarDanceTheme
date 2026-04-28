/**
 * Event schedule repeater (sd_event admin).
 */
(function ($) {
  'use strict';

  function nextIndex($wrap) {
    var max = -1;
    $wrap.find('input[name^="stardance_schedule_entries["]').each(function () {
      var m = /^stardance_schedule_entries\[(\d+)\]/.exec(this.name || '');
      if (m) {
        var n = parseInt(m[1], 10);
        if (!isNaN(n) && n > max) {
          max = n;
        }
      }
    });
    return max + 1;
  }

  function appendRow($wrap, $tpl, labels) {
    var idx = nextIndex($wrap);
    var node = $tpl[0].content.cloneNode(true);
    var $row = $(node).children('.stardance-schedule-row');
    $row.find('.stardance-schedule-js-label-day').text(labels.day);
    $row.find('.stardance-schedule-js-label-title').text(labels.title);
    $row.find('.stardance-schedule-js-label-time').text(labels.time);
    $row.find('.stardance-schedule-js-label-location').text(labels.location);
    $row.find('.stardance-schedule-js-day').attr(
      'name',
      'stardance_schedule_entries[' + idx + '][day]'
    );
    $row.find('.stardance-schedule-js-title').attr(
      'name',
      'stardance_schedule_entries[' + idx + '][title]'
    );
    $row.find('.stardance-schedule-js-time').attr(
      'name',
      'stardance_schedule_entries[' + idx + '][time]'
    );
    $row.find('.stardance-schedule-js-location').attr(
      'name',
      'stardance_schedule_entries[' + idx + '][location]'
    );
    $wrap.append($row);
  }

  $(function () {
    var $wrap = $('#stardance-schedule-rows');
    var $tpl = $('#stardance-schedule-row-template');
    var $add = $('#stardance-schedule-add-row');
    if (!$wrap.length || !$tpl.length || !$add.length) {
      return;
    }

    var labels =
      typeof stardanceEventScheduleAdmin !== 'undefined'
        ? stardanceEventScheduleAdmin.labels
        : { day: 'Day', title: 'Session title', time: 'Time', location: 'Location' };

    $add.on('click', function (e) {
      e.preventDefault();
      appendRow($wrap, $tpl, labels);
    });

    $wrap.on('click', '.stardance-schedule-remove', function (e) {
      e.preventDefault();
      var $rows = $wrap.find('.stardance-schedule-row');
      if ($rows.length <= 1) {
        $rows.find('input').val('');
        return;
      }
      $(this).closest('.stardance-schedule-row').remove();
    });
  });
})(jQuery);
