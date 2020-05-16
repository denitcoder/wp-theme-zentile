<?php

class Zentile_Widget_Recent_Posts extends WP_Widget {
    public function __construct() {
        $widget_name = wp_get_theme() . ': ' . __('Recent Posts');
        $widget_ops = [
            'classname' => 'zentile_widget_recent_entries',
            'description' => __('Your site&#8217;s most recent Posts.'),
            'customize_selective_refresh' => true,
        ];

        parent::__construct('zentile-recent-posts', $widget_name, $widget_ops);
    }

    public function widget($args, $instance) {
        if (! isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        $title = (! empty($instance['title'])) ? $instance['title'] : __('Recent Posts');
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);
        $number = (! empty($instance['number'])) ? absint($instance['number']) : 5;
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : true;
        $show_image = isset($instance['show_image']) ? $instance['show_image'] : true;

        if (! $number) {
            $number = 5;
        }

        $result = new WP_Query(
            apply_filters(
                'widget_posts_args',
                [
                    'posts_per_page'      => $number,
                    'no_found_rows'       => true,
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => true,
                ],
                $instance
            )
        );

        if (! $result->have_posts()) {
            return;
        }

        echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        ?>

        <ul class="zentile-widget-recent-posts__list">
            <?php foreach ($result->posts as $recent_post) { ?>
                <?php
                $post_title   = get_the_title($recent_post->ID);
                $title        = (! empty($post_title)) ? $post_title : __('(no title)');
                $aria_current = '';

                if (get_queried_object_id() === $recent_post->ID) {
                    $aria_current = ' aria-current="page"';
                }
                ?>
                <li class="zentile-widget-recent-posts__item has-dark-link">
                    <?php if ($show_image) { ?>
                        <a href="<?php the_permalink($recent_post->ID); ?>"
                            class="zentile-widget-recent-posts__image"
                            style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($recent_post->ID, 'zentile-thumbnail-post-small')) ?>')"></a>
                    <?php } ?>

                    <div class="zentile-widget-recent-posts__content">
                        <a href="<?php the_permalink($recent_post->ID); ?>"<?php echo $aria_current; ?> class="h-break-word"><?php echo $title; ?></a>
                        <?php if ($show_date) { ?>
                            <?php echo zentile_human_time_diff_html(get_the_date('U', $recent_post->ID)) ?>
                        <?php } ?>
                    </div>
                </li>
            <?php } ?>
        </ul>

        <?php
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = isset($new_instance['show_date']) ? (bool) $new_instance['show_date'] : false;
        $instance['show_image'] = isset($new_instance['show_image']) ? (bool) $new_instance['show_image'] : false;

        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        $show_date = isset($instance['show_date']) ? (bool) $instance['show_date'] : true;
        $show_image = isset($instance['show_image']) ? (bool) $instance['show_image'] : true;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
        <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox"<?php checked($show_date); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" />
        <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Show post date', 'zentile'); ?></label></p>

        <p><input class="checkbox" type="checkbox"<?php checked($show_image); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" />
        <label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e('Show featured image', 'zentile'); ?></label></p>
        <?php
    }
}
