<?php

get_header();

global $wp_query;

/* translators: Search results */
$archive_title = __('Search', 'zentile') . ': <span>&ldquo;' . get_search_query() . '&rdquo;</span>';
$archive_subtitle = sprintf(
    /* translators: %s: Number of search results */
    _n(
        'We found %s result for your search.',
        'We found %s results for your search.',
        $wp_query->found_posts,
        'zentile'
    ),
    number_format_i18n($wp_query->found_posts)
);

zentile_cmp_archive_header($archive_title, $archive_subtitle);
zentile_cmp_post_list();
get_footer();