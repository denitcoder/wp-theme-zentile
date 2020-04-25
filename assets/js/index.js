import mediumZoom from "medium-zoom";
import { OffCanvas } from "./off-canvas";
import { domReady } from "./utils";

domReady(() => {
    mediumZoom('.wp-block-image > img');

    // Mobile navigation
    const sidebar = document.querySelector('#site-sidebar');

    if (sidebar) {
        new OffCanvas(sidebar);
    }
});