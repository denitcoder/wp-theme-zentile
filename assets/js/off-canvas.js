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
    }

    show() {
        this.backdrop.classList.add(this.options.classes.open);
    }

    close() {
        this.backdrop.classList.remove(this.options.classes.open);
    }
}