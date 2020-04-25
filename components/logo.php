<?php

function zentile_cmp_logo() {
    $logo_body = get_bloginfo('name', 'display');

    if (has_custom_logo()) {
        $logo = wp_get_attachment_image_src(get_theme_mod('custom_logo') , 'full');
        $logo_body = '<img src="' . esc_url($logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
    }

    echo '<h1 class="site-header__logo h-truncate"><a href="' . esc_url(home_url()) . '" class="dark-link">'. $logo_body .'</a></h1>';
}