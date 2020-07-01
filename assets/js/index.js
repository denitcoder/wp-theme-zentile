import mediumZoom from "medium-zoom";
import { OffCanvas } from "./off-canvas";
import { domReady } from "./utils";

domReady(() => {
    mediumZoom('.wp-block-image > img');

    // Let the document know when the keyboard is being used
    document.body.addEventListener('mousedown', _ => {
        document.body.classList.remove('focus-keyboard');
    });
    document.body.addEventListener('keydown', event => {
        if (event.key === 'Tab') {
            document.body.classList.add('focus-keyboard');
        }
    });

    // Mobile navigation
    const sidebar = document.querySelector('#site-sidebar');

    if (sidebar) {
        new OffCanvas(sidebar);
    }
});