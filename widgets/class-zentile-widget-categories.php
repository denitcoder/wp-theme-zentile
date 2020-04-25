<?php

class Zentile_Widget_Categories extends WP_Widget {
    public function __construct() {
        $widget_name = wp_get_theme() . ': ' . __('Categories');
        $widget_ops = [
            'classname' => 'zentile_widget_categories',
            'description' => __('A list or dropdown of categories.'),
            'customize_selective_refresh' => true,
        ];

        parent::__construct('zentile_categories', $widget_name, $widget_ops);
    }

    public function widget($args, $instance) {
        $output = '';
        $title = ! empty($instance['title']) ? $instance['title'] : __('Categories');
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);
        $show_count = ! empty($instance['count']);
        $depth = ! empty($instance['hierarchical']) ? 0 : -1;
        $walker = new Zentile_Walker_Category;
        $walker_args = [ 'show_count' => $show_count ];

        if (is_category() && get_queried_object()) {
            $walker_args['current_category'] = get_queried_object_id();
        }

        // Output
        $output .= $args['before_widget'];

        if ($title) {
            $output .= $args['before_title'] . $title . $args['after_title'];
        }

        $output .= '<ul class="menu">';

        $output .= '<li class="menu-item ' . (is_home() ? 'current-menu-item' : '') . '">';
        $output .= '<a href="' . home_url('/') . '">';
        $output .= '<span class="category__name h-truncate">' . /* translators: All categories */ __('All', 'zentile') . '</span>';

        if ($show_count) {
            $output .= '<span class="category__count">' . wp_count_posts()->publish . '</span>';
        }

        $output .= '</a></li>';

        $output .= $walker->walk(get_categories(), $depth, $walker_args);
        $output .= '</ul>' . $args['after_widget'];

        echo $output;
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['count'] = ! empty($new_instance['count']) ? 1 : 0;
        $instance['hierarchical'] = ! empty($new_instance['hierarchical']) ? 1 : 0;

        return $instance;
    }

    public function form($instance) {
        $instance     = wp_parse_args((array) $instance, [ 'title' => '' ]);
        $count        = isset($instance['count']) ? (bool) $instance['count'] : false;
        $hierarchical = isset($instance['hierarchical']) ? (bool) $instance['hierarchical'] : false;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" /></p>

        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked($count); ?> />
        <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show post counts'); ?></label><br />

        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked($hierarchical); ?> />
        <label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e('Show hierarchy'); ?></label></p>
        <?php
    }
}