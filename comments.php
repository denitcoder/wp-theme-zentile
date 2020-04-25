<?php

if (post_password_required() || (!zentile_show_comments_list() && is_page())) return;

$comments_open = comments_open() || pings_open();
$comments_number = absint(get_comments_number());

echo '<div class="comments-wrapper">';

if (zentile_show_comments_list()) {
?>
    <div class="comments" id="comments">
        <div class="comments__header">
            <h2 class="comments__title"><?php comments_number(); ?></h2>
        </div>

        <?php if (have_comments()) {
            wp_list_comments([
                'walker' => new Zentile_Walker_Comment(get_the_ID()),
                'avatar_size' => 50,
                'style' => 'div'
            ]);

            the_comments_pagination([
                'prev_text' => __('Previous'),
                'next_text' => __('Next'),
            ]);
        } else if ($comments_open) {
            echo '<div class="no-content">' . __('No comments yet', 'zentile') . '</div>';
        } ?>
    </div>
<?php
}

if ($comments_open) {
    comment_form([
        'class_form'  => 'comments__form',
        'title_reply_before' => '<h2 class="comments__title">',
        'title_reply_after' => '</h2>',
        'class_submit' => 'button --primary'
    ]);
} else {
    zentile_cmp_alert(__('Comments are closed.', 'zentile'), 'comments__closed --warning');
}

echo '</div>';