<?php

function zentile_cmp_post_card() {
    $is_sticky = is_home() && is_sticky();
    $has_comments = get_comments_number() > 0; ?>

    <article class="post-card <?php if ($is_sticky) echo '--sticky' ?> <?php if ($has_comments) echo '--has-comments' ?>">
        <a href="<?php echo esc_url(get_permalink()) ?>" class="post-card__link" tabindex="-1"><?php the_title() ?></a>

        <?php if ($is_sticky) {
            echo '<div class="post-card__sticky post-card__ribbon">' . zentile_get_theme_svg('bookmark') . '</div>';
        } ?>

        <?php if (post_password_required()) {
            echo '<div class="post-card__protected post-card__ribbon">' . zentile_get_theme_svg('lock') . '</div>';
        } ?>

        <div class="post-card__body">
            <?php
            the_title('<h2 class="post-card__title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');

            if (has_category()) {
                echo '<div class="post-card__categories h-truncate">' . get_the_category_list(', ') . '</div>';
            }

            echo '<div class="post-card__meta">';

            // Date
            echo zentile_human_time_diff_html(get_the_time('U'));

            // Comments
            if (zentile_show_comments_list()) {
                echo '<div class="post-card__comments">' . get_comments_number() . '</div>';
            }

            echo '</div>'; // post-card__meta
            ?>
        </div>

        <div class="post-card__bg" style="background-image: url('<?php the_post_thumbnail_url() ?>')"></div>
    </article>
<?php }