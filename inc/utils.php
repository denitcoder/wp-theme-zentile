<?php

function zentile_human_time_diff($date) {
    // translators: %s mins/hours/days ago
    return sprintf(__('%s ago', 'zentile'), human_time_diff($date, current_time('timestamp')));
}

function zentile_human_time_diff_html($date) {
    return '<time datetime="' . date('c', $date) . '" title="' . date('r', $date) . '">' . zentile_human_time_diff($date) . '</time>';
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

function zentile_primary_nav() {
    if (has_nav_menu('primary')) {
        wp_nav_menu([
            'depth' => 1,
            'container' => '',
            'items_wrap' => '%3$s',
            'theme_location' => 'primary',
        ]);
    } else {
        wp_list_pages([
            'depth' => 1,
            'title_li' => false,
        ]);
    }
}