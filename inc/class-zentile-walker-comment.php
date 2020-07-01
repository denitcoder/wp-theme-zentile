<?php

class Zentile_Walker_Comment extends Walker_Comment {
    protected function html5_comment($comment, $depth, $args) {
        $tag = ('div' === $args['style']) ? 'div' : 'li';
    
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class($this->has_children ? 'parent' : '', $comment); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <?php
                if (0 != $args['avatar_size']) {
                    echo get_avatar($comment, $args['avatar_size']);
                }
                ?>

                <div class="comment__section">
                    <div class="comment__meta">
                        <?php echo '<span class="comment__user has-dark-link">' . get_comment_author_link($comment) . '</span>'; ?>

                        <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>" class="comment__date-url">
                            <?php echo zentile_human_time_diff_html(get_comment_time('U')); ?>
                        </a>
                    </div>

                    <?php 
                    if ('0' == $comment->comment_approved) {
                        echo zentile_cmp_alert(__('Your comment is awaiting moderation.', 'zentile'), 'comment__awaiting-moderation --warning');
                    }
                    ?>

                    <div class="comment__content typeset">
                        <?php comment_text(); ?>
                    </div>
 
                    <div class="comment__footer">
                    <?php
                        comment_reply_link(array_merge($args, [
                            'add_below' => 'div-comment',
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth'],
                        ]));

                        edit_comment_link(__('Edit', 'zentile'));
                    ?>
                    </div>
                </div>
            </article>
        <?php
    }
}
