<?php

function zentile_cmp_alert($text, $classes) {
    echo "<div class=\"alert $classes\">";
    echo esc_html($text);
    echo '</div>';
}