import $ from 'axios';
import Swipe from 'swipejs';
import Confetti from 'canvas-confetti';
import { Howl } from 'howler';
import AudioSpriteConfig from '../../public/audio/audiosprites.json';

const PushManagerOptions = {
    userVisibleOnly: true,
    applicationServerKey: urlBase64ToUint8Array(window._vapidPublicKey)
};

var sounds = new Howl(Object.assign({}, AudioSpriteConfig, {
    volume: window._audioVolume || 0.2
}));

if ('serviceWorker' in navigator) {
    // Register our service worker if compatible
    navigator.serviceWorker.register('/service-worker.js')
        .then(() => navigator.serviceWorker.ready)
        .then(reg => {
            reg.pushManager.getSubscription()
                .then(sub => {
                    if (sub != null) return updateSubscription(sub);

                    return reg.pushManager.subscribe(PushManagerOptions).then(updateSubscription);
                });
        });
}

document.addEventListener('DOMContentLoaded', function(event) {
    // Update any styles according
    document.body.classList.add('js-loaded');

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
         * @function quickEventCallback
         *
         * Called by the quickEventTimeout timer, once applicable time has passed
         */
        let quickEventCallback = (button) => {
            button.classList.add('js-quick-event-submitting');
            sounds.play('quick-event-submit');
            form.submit();
        }

        /*
         * @function quickEventHandler
         *
         * Handles clicks upon our quick event buttons.
         */
        let quickEventHandler = e => {
            // Clear our "inactivity timer"
            clearTimeout(quickEventTimeout);

            // Play the click sound
            sounds.play('quick-event-click');

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

            // Setup a new "inactivity timer"
            quickEventTimeout = setTimeout(quickEventCallback.bind(this, button), (window._quickEventTimeout || 2000));
        }

        // Attach Event Handlers
        buttons.forEach(button => button.addEventListener('click', quickEventHandler));
    });

    // "Closers"
    window._closers = [...document.querySelectorAll('[data-closer]')].map(element => {
        let selector = element.dataset.closer;
        let target = document.querySelectorAll(selector);
        if (target.length < 1) return console.log('Closer element target does not exists', selector, element);

        return element.addEventListener('click', (e) => {
            e.preventDefault();
            target.forEach(el => el.classList.add('hidden'));
        });
    });

    // Confetti
    window._confetti = [...document.querySelectorAll('[data-confetti]')].map(element => {
        Confetti();
    });
});

function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
        .replace(/-/g, '+')
        .replace(/_/g, '/');

    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);

    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }

    return outputArray;
}

function updateSubscription(subscription) {
    let { endpoint } = subscription;
    let key = subscription.getKey('p256dh')
    let token = subscription.getKey('auth')
    let contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0]

    return $.post(
        '/user/subscription',
        {
            endpoint,
            contentEncoding,
            key: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
            token: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
        },
        {
            withCredentials: true
        });
}
