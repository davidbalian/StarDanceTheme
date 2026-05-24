/**
 * Star Dance Studio - Contact Form
 * AJAX form submission handler
 */
(function () {
  function openInterest(dropdown, toggle, panel) {
    dropdown.classList.add('is-open');
    toggle.setAttribute('aria-expanded', 'true');
    panel.hidden = false;
    panel.style.height = '0px';
    panel.offsetHeight;
    panel.style.height = panel.scrollHeight + 'px';
  }

  function closeInterest(dropdown, toggle, panel) {
    toggle.setAttribute('aria-expanded', 'false');
    panel.style.height = panel.scrollHeight + 'px';
    panel.offsetHeight;
    panel.style.height = '0px';
    dropdown.classList.remove('is-open');
  }

  function initInterestDropdown() {
    var dropdowns = document.querySelectorAll('.sd-contact-page__interest-dropdown');
    if (!dropdowns.length) return;

    dropdowns.forEach(function (dropdown) {
      var toggle = dropdown.querySelector('.sd-contact-page__interest-toggle');
      var panel = dropdown.querySelector('.sd-contact-page__interest-options');
      if (!toggle || !panel) return;

      panel.hidden = true;
      panel.style.height = '0px';

      panel.addEventListener('transitionend', function (event) {
        if (event.propertyName !== 'height') return;
        if (toggle.getAttribute('aria-expanded') === 'true') {
          panel.style.height = 'auto';
          return;
        }
        panel.hidden = true;
      });

      toggle.addEventListener('click', function () {
        var isExpanded = toggle.getAttribute('aria-expanded') === 'true';
        if (isExpanded) {
          closeInterest(dropdown, toggle, panel);
          return;
        }
        openInterest(dropdown, toggle, panel);
      });
    });
  }

  initInterestDropdown();

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
    var i18n = (typeof sdContactI18n !== 'undefined') ? sdContactI18n : {};
    submitBtn.textContent = i18n.sending || 'Sending...';
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
          status.textContent = response.data.message || i18n.errorGeneric || 'An error occurred. Please try again.';
          status.className = 'sd-contact__status error';
        }
      } catch (err) {
        status.textContent = i18n.errorGeneric || 'An error occurred. Please try again.';
        status.className = 'sd-contact__status error';
      }
    };

    xhr.onerror = function () {
      submitBtn.textContent = originalText;
      submitBtn.disabled = false;
      status.textContent = i18n.errorNetwork || 'Network error. Please check your connection and try again.';
      status.className = 'sd-contact__status error';
    };

    xhr.send(formData);
  });
})();
