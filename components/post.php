<?php function zentile_cmp_post() {
    the_post(); ?>

    <article <?php post_class([ get_comments_number() > 0 ? '--has-comments': null, 'post' ]); ?>>
        <header class="post__header">
            <?php
            if (is_singular()) {
                the_title('<h1 class="post__title">', '</h1>');
            } else {
                the_title('<h2 class="post__title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
            }
            ?>

            <div class="post__meta">
                <?php

                /**
                 * Only show the dates and categories on posts, not pages.
                 */
                if (is_singular('post')) {
                    // Date
                    echo '<span class="post__date">' . the_time(get_option('date_format')) . '</span>';

                    // Category
                    if (has_category()) {
                        echo '<span class="post__category">' . get_the_category_list(', ') . '</span>';
                    }
                }

                // Edit link
                edit_post_link();
                ?>
            </div>
        </header>

        <?php
        if (post_password_required()) {
            zentile_cmp_password_form();
        } else { ?>
            <?php if (get_theme_mod('show_featured_image', false) && has_post_thumbnail()) { ?>
                <img src="<?php the_post_thumbnail_url('zentile-thumbnail-post') ?>" alt="<?php echo esc_attr(get_the_title()) ?>" class="post__featured-image">
            <?php } ?>

            <div class="post__content typeset">
                <?php the_content() ?>
            </div>

            <?php
            // Tags
            if (has_tag()) {
                the_tags('<div class="post__tags">' . zentile_get_theme_svg('tag'), ', ', '</div>');
            }

            // Pagination
            wp_link_pages([
                'before' => '<nav class="pagination"><div class="nav-links">',
                'after' => '</div></nav>'
            ]);

            // Author
            $author_desc = get_the_author_meta('description');

            if (is_single() && (bool) get_theme_mod('show_author_bio', true)) { ?>
                <div class="post__author">
                    <div class="post__author__header">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>

                        <div class="post__author__info">
                            <div class="post__author__by">
                                <?php _e('Published by', 'zentile') ?>
                            </div>

                            <h2 class="post__author__title h-truncate has-dark-link">
                                <a class="author-link" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
                                    <?php echo esc_html(get_the_author()) ?>
                                </a>
                            </h2>
                        </div>
                    </div>

                    <?php if ($author_desc) { ?>
                        <div class="post__author__content typeset">
                            <?php echo wp_kses_post(wpautop($author_desc)); ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php } ?>

        <?php
        // Post navigation
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

        if (get_theme_mod('show_post_nav', true) && is_singular('post')) {
            $prev_post = get_previous_post();
            $next_post = get_next_post();

            if ($prev_post || $next_post) {
                echo '<div class="post__nav ' . (!$prev_post || !$next_post ? 'post__nav--first-last' : '') . '">';
                    zentile_cmp_post_nav_item($next_post, 'post__nav-item--newer');
                    zentile_cmp_post_nav_item($prev_post, 'post__nav-item--older');
                echo '</div>';
            }
        }

        // Link to comments
        if (zentile_show_comments_list() && ! post_password_required()) {
            echo '<a href="#comments" class="post__comments-count" tabindex="-1">' . absint(get_comments_number()) . '</a>';
        } ?>
    </article>
<?php }