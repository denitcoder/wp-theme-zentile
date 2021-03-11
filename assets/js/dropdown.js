export class Dropdown {
    constructor(element) {
        this.element = element;
        this.toggle = this.element.querySelector(':scope > a');
        this.menu = this.element.querySelector(':scope > ul');

        if (!this.menu) return;

        this.isRoot = this.element.parentElement.classList.contains('primary-menu');
        this.onWindowClickBinded = this.onWindowClick.bind(this);
        this.classOpen = 'menu--open';

        this.toggle.addEventListener('touchstart', this.onToggleTouch.bind(this));
        this.toggle.addEventListener('mouseenter', this.positionMenu.bind(this));
    }

    onToggleTouch(event) {
        if (!this.element.classList.contains(this.classOpen)) {
            event.preventDefault();
        }

        this.show();
    }

    onWindowClick(event) {
        if (this.element !== event.target && !this.element.contains(event.target)) {
            this.close();
        }
    }

    show() {
        this.positionMenu();
        this.element.classList.add(this.classOpen);
        window.addEventListener('click', this.onWindowClickBinded);
    }

    close() {
        this.element.classList.remove(this.classOpen);
        window.removeEventListener('click', this.onWindowClickBinded);
    }

    positionMenu() {
        const rightOffset = window.innerWidth - this.element.getBoundingClientRect().right;

        if (this.isRoot) {
            this.menu.style.right = 0;
            this.menu.style.left = 'auto';
        } else if (rightOffset < this.menu.offsetWidth) {
            this.menu.style.right = '100%';
            this.menu.style.left = 'auto';
        } else {
            this.menu.style.right = 'auto';
            this.menu.style.left = '100%';
        }
    }
}