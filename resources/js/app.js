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
            transitionEnd: callback
        });

        navNext.addEventListener('click', swipe.next);
        navPrev.addEventListener('click', swipe.prev);

        // Initialise, by firing callback
        callback(items.length - 1, items[items.length - 1]);

        return swipe;
    });
});
