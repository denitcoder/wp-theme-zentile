<?php

function zentile_human_time_diff($date) {
    // translators: %s mins/hours/days ago
    return sprintf(__('%s ago', 'zentile'), human_time_diff($date, current_time('timestamp')));
}

function zentile_human_time_diff_html($date) {
    return '<time datetime="' . esc_attr(date('c', $date)) . '" title="' . esc_attr(date('r', $date)) . '">' . zentile_human_time_diff($date) . '</time>';
}

function zentile_show_comments_list($post_id = null) {
    return comments_open($post_id) || (!comments_open($post_id) && absint(get_comments_number($post_id)));
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

function zentile_get_related_posts($post, $count) {
    $categories = get_the_category($post->ID);
    $ids = wp_list_pluck($categories, 'term_id');
    $related_args = [
        'post_type' => 'post',
        'posts_per_page' => $count,
        'post_status' => 'publish',
        'post__not_in' => [ $post->ID ],
        'category__in' => $ids,
        'orderby' => 'rand'
    ];

    return (new WP_Query($related_args))->posts;
}

function zentile_get_reading_time($text) {
    $word_count = str_word_count(strip_tags($text));
    $reading_time = round($word_count / 200);
    $reading_time = $reading_time == 0 ? 1 : $reading_time;

    return sprintf(_n('%s min read', '%s mins read', $reading_time, 'zentile'), number_format_i18n($reading_time));
}

function zentile_short_number($num) {
    if ($num < 1e3) {
        return $num;
    } else if ($num < 1e6) {
        return number_format_i18n($num / 1e3, 1) . 'k';
    } else {
        return number_format_i18n($num / 1e6, 1) . 'm';
    }
}

function zentile_views_enabled() {
    return function_exists('pvc_get_post_views');
}

function zentile_get_post_views($post_id = 0) {
    return pvc_get_post_views($post_id);
}