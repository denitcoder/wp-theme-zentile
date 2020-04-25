<?php 

get_header();

$archive_title = get_the_archive_title();
$archive_subtitle = get_the_archive_description();
$avatar = null;

if (is_category()) {
    $archive_title = single_term_title('', false);
} elseif (is_author()) {
    $archive_title = get_the_author();
    $avatar = get_avatar(get_the_author_meta('ID'), 100);
}

zentile_cmp_archive_header($archive_title, $archive_subtitle, $avatar);
zentile_cmp_post_list();
get_footer();