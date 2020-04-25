<?php

function zentile_cmp_archive_header($title, $desc, $avatar = null) { ?>
    <header class="archive-header">
        <?php
        global $wp_query;

        $count = $wp_query->found_posts ? $wp_query->found_posts : 0;

        if ($avatar) {
            echo $avatar;
        }
        ?>

        <div class="archive-header__body">
            <?php if ($title) { ?>
                <h1 class="archive-header__title h-break-word">
                    <?php echo esc_html($title); ?>
                </h1>

                <div class="archive-header__count">
                    <?php
                        // translators: %s number of posts
                        printf(_n('%s post', '%s posts', $count, 'zentile'), number_format_i18n($count));
                    ?>
                </div>
            <?php } ?>

            <?php if ($desc) { ?>
                <div class="archive-header__desc typeset"><?php echo wp_kses_post(wpautop($desc)); ?></div>
            <?php } ?>
        </div>
    </header>
	<?php
}