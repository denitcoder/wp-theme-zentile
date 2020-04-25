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
                'title'      => __('Theme Options'),
                'priority'   => 40,
                'capability' => 'edit_theme_options',
            ]
        );

        /* Show author bio ---------------------------------------------------- */

        $wp_customize->add_setting(
            'show_author_bio',
            [
                'capability'        => 'edit_theme_options',
                'default'           => true,
                'sanitize_callback' => [ __CLASS__, 'sanitize_checkbox' ],
            ]
        );

        $wp_customize->add_control(
            'show_author_bio',
            [
                'type'     => 'checkbox',
                'section'  => 'options',
                'priority' => 10,
                'label'    => __('Show author bio at the end of the post', 'zentile'),
            ]
        );

        /* Always show sidebar ---------------------------------------------------- */

        $wp_customize->add_setting(
            'always_show_sidebar',
            [
                'capability'        => 'edit_theme_options',
                'default'           => false,
                'sanitize_callback' => [ __CLASS__, 'sanitize_checkbox' ],
            ]
        );

        $wp_customize->add_control(
            'always_show_sidebar',
            [
                'type'     => 'checkbox',
                'section'  => 'options',
                'priority' => 10,
                'label'    => __('Always show sidebar', 'zentile'),
            ]
        );
    }

    public static function sanitize_checkbox($checked) {
        return isset($checked) && true === $checked;
    }
}

add_action('customize_register', [ 'Zentile_Customize', 'register' ]);