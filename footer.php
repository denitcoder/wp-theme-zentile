                </main>
                
                <?php zentile_cmp_sidebar(); ?>
            </div><?php // #site-wrapper ?>

            <footer id="site-footer" role="contentinfo">
                <div class="site-footer__copy">
                    <?php echo '&copy; ' . date_i18n(__('Y', 'zentile')) . ' ' . esc_html(get_bloginfo('name')); ?>
                </div>

                <a href="#site-header" class="site-footer__scroll-top h-shadow-focus">
                    <?php
                        zentile_the_theme_svg('arrow-up');
                        _e('To the top', 'zentile');
                    ?>
                </a>

                <div class="site-footer__credits">
                    <?php
                    $my_theme = wp_get_theme();

                    printf(
                        /* translators: 1: Theme name, 2: Theme author. */
                        esc_html__('Theme %1$s by %2$s', 'zentile'),
                        '<b>' . esc_html($my_theme->get('Name')) . '</b>',
                        '<a href="' . esc_url($my_theme->get('AuthorURI')) . '">' . esc_html($my_theme->get('Author')) . '</a>'
                    );
                    ?>
                </div>
            </footer>
        </div><?php // #site-container ?>

        <?php wp_footer(); ?>
    </body>
</html>
