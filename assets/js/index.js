import mediumZoom from "medium-zoom";
import { Dropdown } from "./dropdown";
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

    // Responsive iframes
    document.querySelectorAll('iframe').forEach(iframe => {
        if (!iframe.height || !iframe.width) return;
        
        const container = iframe.parentNode;

        if (!container.classList.contains('wp-block-embed__wrapper')) return;
    
        container.classList.add('responsive-iframe');
        container.style.paddingTop = `${iframe.height / iframe.width * 100}%`;
    });

    // Mobile navigation
    const sidebar = document.querySelector('#site-sidebar');

    if (sidebar) {
        new OffCanvas(sidebar);
    }

    // Dropdown menu
    document.querySelectorAll('.primary-menu li').forEach(element => new Dropdown(element));
});