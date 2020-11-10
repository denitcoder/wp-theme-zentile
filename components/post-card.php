<?php

function zentile_cmp_post_card($post = null, $classes = []) {
    $post_id = $post ? $post->ID : null;
    $is_sticky = is_home() && is_sticky($post_id);
    $has_comments = get_comments_number($post) > 0;
    $post_bg_color = zentile_get_post_bg_color($post);

    if ($is_sticky) $classes[] = '--sticky';
    if ($has_comments) $classes[] = '--has-comments';
    if ($post_bg_color['is_bright']) $classes[] = '--bright';
    ?>

    <article class="post-card <?php echo implode(' ', $classes) ?>" style="--post-color: <?php echo $post_bg_color['color'] ?>">
        <a href="<?php echo esc_url(get_permalink($post_id)) ?>" class="post-card__link" tabindex="-1"><?php the_title($post_id) ?></a>

        <?php if ($is_sticky) {
            echo '<div class="post-card__sticky post-card__ribbon">' . zentile_get_theme_svg('bookmark') . '</div>';
        } ?>

        <?php if (post_password_required($post_id)) {
            echo '<div class="post-card__protected post-card__ribbon">' . zentile_get_theme_svg('lock') . '</div>';
        } ?>

        <div class="post-card__body">
            <?php
            the_title('<h2 class="post-card__title"><a href="' . esc_url(get_permalink($post_id)) . '">', '</a></h2>');

            if (has_category('', $post_id)) {
                echo '<div class="post-card__categories h-truncate">' . get_the_category_list(', ', '', $post_id) . '</div>';
            }

            echo '<div class="post-card__meta">';

            // Date
            echo zentile_human_time_diff_html(get_the_time('U', $post_id));

            // Comments
            if (zentile_show_comments_list($post_id)) {
                echo '<div class="post-card__comments">' . get_comments_number($post_id) . '</div>';
            }

            echo '</div>'; // post-card__meta
            ?>
        </div>

        <div class="post-card__bg" style="background-color: <?php echo $post_bg_color['color'] ?>; background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id)) ?>')"></div>
    </article>
<?php }