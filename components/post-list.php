<?php

function zentile_cmp_post_list() {
    if (have_posts()) {
        echo '<div class="post-list">';

        while (have_posts()) {
            the_post();
            zentile_cmp_post_card();
        }

        echo '</div>';
    } else {
        echo '<div class="no-content">' . __('No posts yet', 'zentile') . '</div>';
    }
    
    the_posts_pagination();
}