<?php

class Zentile_Customize {
    public static function register($wp_customize) {
        $wp_customize->selective_refresh->add_partial(
            'custom_logo',
            [
                'selector'        => '.site-header__logo',
                'render_callback' => 'zentile_cmp_logo',
            ]
        );

        $wp_customize->add_section(
            'options',
            [
                'title'      => __('Theme Options', 'zentile'),
                'priority'   => 40,
                'capability' => 'edit_theme_options',
            ]
        );

        self::checkbox($wp_customize, 'show_author_bio', true, __('Show author bio at the end of the post', 'zentile'));
        self::checkbox($wp_customize, 'show_featured_image', false, __('Show featured image at the top of the post', 'zentile'));
        self::checkbox($wp_customize, 'always_show_sidebar', false, __('Always show sidebar', 'zentile'));
        self::checkbox($wp_customize, 'show_post_nav', true, __('Show post navigation', 'zentile'));
        self::checkbox($wp_customize, 'show_post_list_views', true, __('Show views in the post list', 'zentile'));

        self::checkbox($wp_customize, 'show_related_posts_before_comments', true, __('Show related posts BEFORE comments', 'zentile'));
        self::number($wp_customize, 'related_posts_before_comments_num', 4, 0, 16, __('Number of related posts BEFORE comments', 'zentile'));

        self::checkbox($wp_customize, 'show_related_posts_after_comments', false, __('Show related posts AFTER comments', 'zentile'));
        self::number($wp_customize, 'related_posts_after_comments_num', 5, 0, 100,  __('Number of related posts AFTER comments', 'zentile'));
    }

    private static function checkbox($wp_customize, $setting_id, $default, $text) {
        $wp_customize->add_setting(
            $setting_id,
            [
                'capability'        => 'edit_theme_options',
                'default'           => $default,
                'sanitize_callback' => [ __CLASS__, 'sanitize_checkbox' ],
            ]
        );

        $wp_customize->add_control(
            $setting_id,
            [
                'type'     => 'checkbox',
                'section'  => 'options',
                'priority' => 10,
                'label'    => $text,
            ]
        );
    }

    private static function number($wp_customize, $setting_id, $default, $min, $max, $text) {
        $wp_customize->add_setting(
            $setting_id,
            [
                'capability'        => 'edit_theme_options',
                'default'           => $default,
                'sanitize_callback' => 'absint',
            ]
        );

        $wp_customize->add_control(
            $setting_id,
            [
                'type'     => 'number',
                'section'  => 'options',
                'priority' => 10,
                'label'    => $text,
                'input_attrs' => [
                    'min' => $min,
                    'max' => $max,
                    'step' => 1,
                ]
            ]
        );
    }

    public static function sanitize_checkbox($checked) {
        return isset($checked) && true === $checked;
    }
}

add_action('customize_register', [ 'Zentile_Customize', 'register' ]);