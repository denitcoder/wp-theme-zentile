<?php

function zentile_cmp_post_nav_item($post, $classes) {
    if (!$post) return;

    $post_bg_color = zentile_get_post_bg_color($post);
    $background_color = "--post-nav-color: {$post_bg_color['color']}; ";
    $background_image = "--post-nav-image: url('" . esc_url(get_the_post_thumbnail_url($post)) . "')";

    if ($post_bg_color['is_bright']) {
        $classes .= ' post__nav-item--bright';
    }

    echo '<a href="' . esc_url(get_permalink($post)) . '" class="post__nav-item ' . $classes . '" style="' . $background_color . $background_image . '">';
    echo '<span>' . wp_trim_words(get_the_title($post), 15, '&hellip;') . '</span>';
    echo zentile_the_theme_svg('arrow-up');
    echo '</a>';
}

function zentile_cmp_post_nav() {
    $prev_post = get_previous_post();
    $next_post = get_next_post();

    if ($prev_post || $next_post) {
        echo '<div class="post__nav ' . (!$prev_post || !$next_post ? 'post__nav--first-last' : '') . '">';
            zentile_cmp_post_nav_item($next_post, 'post__nav-item--newer');
            zentile_cmp_post_nav_item($prev_post, 'post__nav-item--older');
        echo '</div>';
    }
}