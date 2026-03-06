/**
 * Star Dance Studio - Contact Form
 * AJAX form submission handler
 */
(function () {
  var form = document.getElementById('stardance-contact-form');
  var status = document.getElementById('form-status');

  if (!form || typeof stardanceAjax === 'undefined') return;

  // Set nonce value
  var nonceField = form.querySelector('input[name="nonce"]');
  if (nonceField) {
    nonceField.value = stardanceAjax.nonce;
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    var submitBtn = form.querySelector('button[type="submit"]');
    var originalText = submitBtn.textContent;
    submitBtn.textContent = 'Sending...';
    submitBtn.disabled = true;

    status.textContent = '';
    status.className = 'sd-contact__status';

    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', stardanceAjax.ajaxurl, true);

    xhr.onload = function () {
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;

      try {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          status.textContent = response.data.message;
          status.className = 'sd-contact__status success';
          form.reset();
        } else {
          status.textContent = response.data.message || 'An error occurred. Please try again.';
          status.className = 'sd-contact__status error';
        }
      } catch (err) {
        status.textContent = 'An error occurred. Please try again.';
        status.className = 'sd-contact__status error';
      }
    };

    xhr.onerror = function () {
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
      status.textContent = 'Network error. Please check your connection and try again.';
      status.className = 'sd-contact__status error';
    };

    xhr.send(formData);
  });
})();
