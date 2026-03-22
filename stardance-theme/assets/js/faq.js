/* Star Dance — FAQ Accordion */
(function () {
    'use strict';

    function initFaq() {
        var questions = document.querySelectorAll('.sd-faq__question');
        if ( ! questions.length ) return;

        questions.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var expanded = this.getAttribute('aria-expanded') === 'true';
                var answer   = this.nextElementSibling;
                this.setAttribute('aria-expanded', String( ! expanded));
                answer.hidden = expanded;
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFaq);
    } else {
        initFaq();
    }
}());
