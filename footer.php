                </main>
                
                <?php zentile_cmp_sidebar(); ?>
            </div><?php // #site-wrapper ?>

            <footer id="site-footer" role="contentinfo">
                <div class="site-footer__copy">
                    <?php echo '&copy; ' . date('Y') . ' ' . get_bloginfo('name', 'display'); ?>
                </div>

                <a href="#site-header" class="site-footer__scroll-top">
                    <?php
                        zentile_the_theme_svg('arrow-up');
                        _e('To the top', 'zentile')
                    ?>
                </a>

                <div class="site-footer__credits">
                    <?php
                    $my_theme = wp_get_theme();

                    echo 'Theme <b>' . $my_theme->get('Name') . '</b> by ' . '<a href="' . $my_theme->get('AuthorURI') . '">' . $my_theme->get('Author') . '</a>';
                    ?>
                </div>
            </footer>
        </div><?php // #site-container ?>

        <?php wp_footer(); ?>
    </body>
</html>
