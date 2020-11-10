<?php

get_header();

// Post
zentile_cmp_post();

// Post navigation (prev/next)
if (is_singular('post') && get_theme_mod('show_post_nav', true)) {
    zentile_cmp_post_nav();
}

// Related posts (small grid)
if (is_singular('post') && !post_password_required() && get_theme_mod('show_related_posts_before_comments', true)) {
    zentile_cmp_post_related(get_post(), get_theme_mod('related_posts_before_comments_num', 5), '', 'post-list-small', 'post-card--small');
}

// Comments
comments_template();

// Related posts (default grid)
if (is_singular('post') && !post_password_required() && get_theme_mod('show_related_posts_after_comments', false)) {
    zentile_cmp_post_related(get_post(), get_theme_mod('related_posts_after_comments_num', 5), 'related-posts--default', 'post-list');
}

get_footer();