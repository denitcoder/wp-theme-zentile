<?php

function zentile_human_time_diff($date) {
    // translators: %s mins/hours/days ago
    return sprintf(__('%s ago', 'zentile'), human_time_diff($date, current_time('timestamp')));
}

function zentile_human_time_diff_html($date) {
    return '<time datetime="' . esc_attr(date('c', $date)) . '" title="' . esc_attr(date('r', $date)) . '">' . zentile_human_time_diff($date) . '</time>';
}

function zentile_show_comments_list() {
    return comments_open() || (!comments_open() && absint(get_comments_number()));
}

function zentile_show_sidebar() {
    return (bool) get_theme_mod('always_show_sidebar', false) || !(is_single() || is_page() || is_404());
}

function zentile_show_primary_nav() {
    return has_nav_menu('primary') || get_pages();
}

function zentile_get_post_bg_color($post = null) {
    $dominant = get_the_terms(get_post_thumbnail_id($post), 'cpg_dominant_color');
    $color = is_array($dominant) ? $dominant[0]->name : '#151515';
    list($r, $g, $b) = sscanf($color, '#%02x%02x%02x');

    // Calculates perceived lightness using the sRGB Luma method
    // Luma = (red * 0.2126 + green * 0.7152 + blue * 0.0722) / 255
    $perceived_lightness = ($r * 0.2126 + $g * 0.7152 + $b * 0.0722) / 255;

    return [
        'color' => $color,
        'is_bright' => $perceived_lightness > 0.5
    ];
}

function zentile_primary_nav() {
    if (has_nav_menu('primary')) {
        wp_nav_menu([
            'depth' => 0,
            'container' => '',
            'items_wrap' => '%3$s',
            'theme_location' => 'primary',
        ]);
    } else {
        wp_list_pages([
            'depth' => 0,
            'title_li' => false,
        ]);
    }
}