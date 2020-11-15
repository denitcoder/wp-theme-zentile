<?php

// Classes
require get_template_directory() . '/inc/utils.php';
require get_template_directory() . '/inc/svg-icons.php';
require get_template_directory() . '/inc/class-zentile-customize.php';
require get_template_directory() . '/inc/class-zentile-walker-comment.php';
require get_template_directory() . '/inc/class-zentile-walker-category.php';

// Widgets
require get_template_directory() . '/widgets/class-zentile-widget-categories.php';
require get_template_directory() . '/widgets/class-zentile-widget-recent-comments.php';
require get_template_directory() . '/widgets/class-zentile-widget-recent-posts.php';

// Components
require get_template_directory() . '/components/archive-header.php';
require get_template_directory() . '/components/alert.php';
require get_template_directory() . '/components/post.php';
require get_template_directory() . '/components/post-card.php';
require get_template_directory() . '/components/post-list.php';
require get_template_directory() . '/components/post-nav.php';
require get_template_directory() . '/components/related-posts.php';
require get_template_directory() . '/components/password-form.php';
require get_template_directory() . '/components/logo.php';
require get_template_directory() . '/components/sidebar.php';

/**
 * Theme support
 */
function zentile_theme_support() {
    global $content_width;

	if (!isset($content_width)) {
		$content_width = 800;
    }

    add_theme_support('custom-logo', [
        'width'       => 150,
        'height'      => 40,
        'flex-height' => false,
        'flex-width'  => true,
    ]);
    add_theme_support('automatic-feed-links');
    add_theme_support('custom-background');
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ]);

    set_post_thumbnail_size(620, 9999);
    add_image_size('zentile-thumbnail-post', $content_width, 9999);
    add_image_size('zentile-thumbnail-post-small', 50, 9999);

    load_theme_textdomain('zentile');
}

add_action('after_setup_theme', 'zentile_theme_support');

/**
 * Register and Enqueue Assets.
 */
function zentile_register_assets() {
    $theme_version = wp_get_theme()->get('Version');
    $font = has_custom_logo()
        ? 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap'
        : 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto+Condensed&display=swap';

    wp_enqueue_style('zentile-google-fonts', $font, null, null);
    wp_enqueue_style('zentile-css-bundle', get_template_directory_uri() . '/dist/bundle.min.css', null, $theme_version);
    wp_enqueue_script('zentile-js-bundle', get_template_directory_uri() . '/dist/bundle.min.js', null, $theme_version);

    if ((! is_admin()) && is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'zentile_register_assets');

/**
 * Enqueue supplemental block editor styles.
 */
function zentile_block_editor_styles() {
    $theme_version = wp_get_theme()->get('Version');

    wp_enqueue_style('zentile-block-editor-styles', get_theme_file_uri('/dist/bundle-editor-block.min.css'), [], $theme_version, 'all');
}

add_action('enqueue_block_editor_assets', 'zentile_block_editor_styles', 1, 1);

/**
 * Register navigation menus.
 */
function zentile_menus() {
    register_nav_menus([
        'primary' => __('Primary Menu', 'zentile'),
    ]);
}

add_action('init', 'zentile_menus');

/**
 * Register widget areas.
 */
function zentile_sidebar_registration() {
    register_widget('Zentile_Widget_Categories');
    register_widget('Zentile_Widget_Recent_Comments');
    register_widget('Zentile_Widget_Recent_Posts');

    register_sidebar([
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
        'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'id'            => 'sidebar',
        'name'          => __('Sidebar', 'zentile'),
        'description'   => __('Widgets in this area will be displayed in the left sidebar.', 'zentile'),
    ]);

    register_sidebar([
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
        'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'id'            => 'footer',
        'name'          => __('Footer', 'zentile'),
        'description'   => __('Widgets in this area will be displayed in the footer.', 'zentile'),
    ]);
}

add_action('widgets_init', 'zentile_sidebar_registration');