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


        /*
         * @var int quickEventTimeout A timeout attached to quickEventCallback
         */
        let quickEventTimeout;

        /*
         * @function audioSubmitComplete
         *
         * Called once the submit sound has played completely
         */
        let audioSubmitComplete = () => {
            form.submit();
        }

        /*
         * @function quickEventCallback
         *
         * Called by the quickEventTimeout timer, once applicable time has passed
         */
        let quickEventCallback = () => {
            audioSubmit.currentTime = 0;
            audioSubmit.play();
        }

        /*
         * @function quickEventHandler
         *
         * Handles clicks upon our quick event buttons.
         */
        let quickEventHandler = e => {
            // Clear our "inactivity timer"
            clearTimeout(quickEventTimeout);

            // Extract values from the quick event target
            let button = e.target;
            if (button.value !== inputTag.value) {
                // Clicked on a new Quick Event tag, so reset input values
                inputTag.value = button.value;
                inputValue.value = 1;
            } else {
                // Clicked on a Quick Event tag for the second(+) time, increment the value input
                inputValue.value = parseInt(inputValue.value, 10) + 1;
            }

            // Iterate across all quick event buttons, and update them to reflect current state
            buttons.forEach(button => {
                // Do this button match the current state?
                let isMatch = (button.value === inputTag.value);

                // Grab the button's value label
                let value = button.querySelector('.quick-event-button-value');

                // Update this button to match state
                button.classList.toggle('js-quick-event-selecting', isMatch);
                if (isMatch) {
                    value.innerText = inputValue.value;
                } else {
                    value.innerText = "";
                }
            });

            // Play the click sound
            audioClick.currentTime = 0;
            audioClick.play();

            // Setup a new "inactivity timer"
            quickEventTimeout = setTimeout(quickEventCallback, (window._quickEventTimeout || 2000));
        }

        // Set audio Volumes
        audioClick.volume = window._audioVolume || 0.4;
        audioSubmit.volume = window._audioVolume || 0.4;

        // Attach Event Handlers
        audioSubmit.addEventListener('ended', audioSubmitComplete)
        buttons.forEach(button => button.addEventListener('click', quickEventHandler));
    });
});
