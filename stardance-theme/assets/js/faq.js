/* Star Dance — FAQ Accordion */
(function () {
    'use strict';

    function openAnswer(item, button, answer) {
        item.classList.add('is-open');
        button.setAttribute('aria-expanded', 'true');
        answer.hidden = false;
        answer.style.height = '0px';
        answer.offsetHeight;
        answer.style.height = answer.scrollHeight + 'px';
    }

    function closeAnswer(item, button, answer) {
        button.setAttribute('aria-expanded', 'false');
        answer.style.height = answer.scrollHeight + 'px';
        answer.offsetHeight;
        answer.style.height = '0px';
        item.classList.remove('is-open');
    }

    function initFaq() {
        var questions = document.querySelectorAll('.sd-faq__question');
        if ( ! questions.length ) return;

        questions.forEach(function (btn) {
            var item = btn.closest('.sd-faq__item');
            var answer = btn.nextElementSibling;
            var expanded = btn.getAttribute('aria-expanded') === 'true';

            if ( ! item || ! answer ) return;

            if ( expanded ) {
                item.classList.add('is-open');
                answer.hidden = false;
                answer.style.height = 'auto';
            } else {
                item.classList.remove('is-open');
                answer.hidden = true;
                answer.style.height = '0px';
            }

            answer.addEventListener('transitionend', function (event) {
                if ( event.propertyName !== 'height' ) return;

                if ( btn.getAttribute('aria-expanded') === 'true' ) {
                    answer.style.height = 'auto';
                    return;
                }

                answer.hidden = true;
            });

            btn.addEventListener('click', function () {
                var isExpanded = this.getAttribute('aria-expanded') === 'true';
                var list = item.parentElement;

                if ( isExpanded ) {
                    closeAnswer(item, this, answer);
                    return;
                }

                if ( list ) {
                    list.querySelectorAll('.sd-faq__item.is-open').forEach(function (openItem) {
                        var openButton;
                        var openAnswer;

                        if ( openItem === item ) return;

                        openButton = openItem.querySelector('.sd-faq__question');
                        openAnswer = openItem.querySelector('.sd-faq__answer');

                        if ( ! openButton || ! openAnswer ) return;

                        closeAnswer(openItem, openButton, openAnswer);
                    });
                }

                openAnswer(item, this, answer);
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFaq);
    } else {
        initFaq();
    }
}());
