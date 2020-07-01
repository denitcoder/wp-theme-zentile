<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(zentile_show_sidebar() ? 'layout--show-sidebar' : 'layout--hide-sidebar'); ?>>
        <?php wp_body_open(); ?>

        <a class="skip-link screen-reader-text h-shadow-focus" href="#site-content">
            <?php _e('Skip to the content', 'zentile') ?>
        </a>

        <div id="site-container">
            <header id="site-header">
                <?php zentile_cmp_logo(); ?>

                <div class="site-header__search-nav">
                    <?php get_search_form(); ?>

                    <?php if (zentile_show_primary_nav()) { ?>
                        <nav id="site-nav" role="navigation">
                            <ul class="primary-menu has-dark-link">
                                <?php zentile_primary_nav(); ?>
                            </ul>
                        </nav>
                    <?php } ?>

                    <button class="mobile-nav-toggle js-mobile-nav-show" aria-label="<?php esc_attr_e('Open navigation menu', 'zentile') ?>" aria-expanded="false">
                        <?php zentile_the_theme_svg('nav'); ?>
                    </button>
                </div>
            </header>

            <div id="site-wrapper">
                <main id="site-content" role="main">