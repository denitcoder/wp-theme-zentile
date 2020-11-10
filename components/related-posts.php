<?php

function zentile_cmp_post_related($post, $count, $classes, $list_classes, $card_class = '') {
    $related_posts = zentile_get_related_posts($post, $count);

    if (count($related_posts) == 0) return;

    echo '<div class="related-posts ' . $classes . '">';
    echo '<h2 class="related-posts__title"><span>' . __('You might like', 'zentile') . '</span></h2>';
    echo '<div class="' . $list_classes . '">';

    foreach ($related_posts as $post) {
        zentile_cmp_post_card($post, [ $card_class ]);
    }

    echo '</div></div>';
}