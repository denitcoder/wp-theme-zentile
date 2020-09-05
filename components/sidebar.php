<?php

function zentile_cmp_sidebar() { ?>
    <aside id="site-sidebar" role="complementary" <?php if (!zentile_show_sidebar()) echo 'class="--hidden"' ?>>
        <div class="sidebar__widgets h-hide-scrollbar">
            <button class="sidebar__close js-mobile-nav-close" aria-label="<?php esc_attr_e('Close navigation menu', 'zentile') ?>">
                <?php zentile_the_theme_svg('cross'); ?>
            </button>

            <?php if (zentile_show_primary_nav()) { ?>
                <div class="widget zentile-widget-mobile-nav">
                    <div class="widget-content">
                        <h2 class="widget-title"><?php _e('Primary Menu', 'zentile'); ?></h2>

                        <ul class="menu menu--primary">
                            <?php zentile_primary_nav(); ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>

            <?php dynamic_sidebar('sidebar'); ?>
        </div>
    </aside>
    <?php
}