import Swipe from 'swipejs';

document.addEventListener('DOMContentLoaded', function(event) {
    setTimeout(function() {
        document.body.classList.add('js-loaded');
    });

    // Enable any Swipe-able areas
    window._swipeables = [...document.querySelectorAll('.swipe-container')].map(container => {
        let el = container.querySelector('.swipe');
        let navHead = container.querySelector('.swipe-heading-text');
        let navNext = container.querySelector('.swipe-next');
        let navPrev = container.querySelector('.swipe-prev');
        let items = el.querySelectorAll('.swipe-wrap > li');

        let callback = function(index, el) {
            navHead.innerText = el.dataset.heading;
            container.classList.toggle('js-swipe-next-active', index !== (items.length - 1));
            container.classList.toggle('js-swipe-prev-active', index !== 0);
        }

        let swipe = new Swipe(el, {
            startSlide: items.length - 1,
            continuous: false,
            callback: callback
        });

        navNext.addEventListener('click', swipe.next);
        navPrev.addEventListener('click', swipe.prev);

        // Initialise, by firing callback
        callback(items.length - 1, items[items.length - 1]);

        return swipe;
    });

    // Enable any Quick-Event buttons
    window._quickEvents = [...document.querySelectorAll('.quick-events')].map(form => {
        let inputTag = form.querySelector('.quick-event-tag');
        let inputValue = form.querySelector('.quick-event-value');
        let audioClick = form.querySelector('.quick-event-audio-click');
        let audioSubmit = form.querySelector('.quick-event-audio-submit');
        let buttons = [...form.querySelectorAll('.quick-event-button')];

        // Set audio Volumes
        audioClick.volume = window._audioVolume || 0.4;
        audioSubmit.volume = window._audioVolume || 0.4;

        let quickEventTimeout;
        let quickEventCallback = () => {
            audioSubmit.currentTime = 0;
            audioSubmit.play();
            form.submit();
        }

        let quickEventHandler = e => {
            clearTimeout(quickEventTimeout);

            let button = e.target;
            if (button.value !== inputTag.value) {
                // Clicked on a new Quick Event tag
                inputTag.value = button.value;
                inputValue.value = 1;
            } else {
                inputValue.value = parseInt(inputValue.value, 10) + 1;
            }

            buttons.forEach(button => {
                button.classList.toggle('js-quick-event-selecting', button.value === inputTag.value);

                let inner = button.querySelector('.quick-event-button-inner');
                let value = button.querySelector('.quick-event-button-value');
                if (button.value === inputTag.value) {
                    value.innerText = inputValue.value;
                } else {
                    value.innerText = "";
                }
            });

            audioClick.currentTime = 0;
            audioClick.play();
            quickEventTimeout = setTimeout(quickEventCallback, 2000);
        }

        buttons.forEach(button => button.addEventListener('click', quickEventHandler));
    });
});
