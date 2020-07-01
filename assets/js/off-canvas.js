import { merge } from "./utils";

const defaults = {
    selectors: {
        panel: '.sidebar__widgets',
        showButton: '.js-mobile-nav-show',
        closeButton: '.js-mobile-nav-close'
    },
    classes: {
        open: '--open'
    }
}

export class OffCanvas {
    constructor(element, options = {}) {
        this.options = merge(defaults, options);

        this.backdrop = element;
        this.panel = element.querySelector(this.options.selectors.panel);
        this.closeButton = element.querySelector(this.options.selectors.closeButton);
        this.showButton = document.querySelector(this.options.selectors.showButton);

        this.showButton.addEventListener('click', this.show.bind(this));
        this.closeButton.addEventListener('click', this.close.bind(this));
        this.backdrop.addEventListener('click', event => {
            if (event.target === this.backdrop) {
                this.close();
            }
        });

        this.onKeyDownBinded = this.onKeyDown.bind(this);

        const focusableElements = [ ...element.querySelectorAll('a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])') ]
            .filter(el => !el.hasAttribute('disabled'))

        if (focusableElements.length) {
            this.firstFocusableElement = focusableElements[0];
            this.lastFocusableElement = focusableElements[focusableElements.length - 1];
        }
    }

    show() {
        document.body.style.paddingRight = `${window.innerWidth - document.body.scrollWidth}px`;
        document.body.style.overflow = 'hidden';

        this.backdrop.classList.add(this.options.classes.open);
        this.showButton.setAttribute('aria-expanded', true);
        this.closeButton.focus();

        document.addEventListener('keydown', this.onKeyDownBinded);
    }

    close() {
        document.body.style.paddingRight = '0';
        document.body.style.overflow = 'auto';

        this.backdrop.classList.remove(this.options.classes.open);
        this.showButton.setAttribute('aria-expanded', false);
        this.showButton.focus();

        document.removeEventListener('keydown', this.onKeyDownBinded);
    }

    onKeyDown(event) {
        if (event.key === 'Escape') {
            this.close();
            return;
        }

        // Trap focus inside the modal
        if (event.key === 'Tab') {
            if (!event.shiftKey && document.activeElement === this.lastFocusableElement) {
                event.preventDefault();
                this.firstFocusableElement.focus();
            }
    
            if (event.shiftKey && document.activeElement === this.firstFocusableElement) {
                event.preventDefault();
                this.lastFocusableElement.focus();
            }
        }
    }
}