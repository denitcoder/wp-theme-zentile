<?php

class Zentile_Widget_Recent_Comments extends WP_Widget {
    public function __construct() {
        $widget_name = wp_get_theme() . ': ' . __('Recent Comments', 'zentile');
        $widget_ops = [
            'classname' => 'zentile_widget_recent_comments',
            'description' => __('Your site&#8217;s most recent comments.', 'zentile'),
            'customize_selective_refresh' => true,
        ];

        parent::__construct('zentile-recent-comments', $widget_name, $widget_ops);
    }

    public function widget($args, $instance) {
        $output = '';
        $title = (! empty($instance['title'])) ? $instance['title'] : __('Recent Comments', 'zentile');
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);
        $number = (! empty($instance['number'])) ? absint($instance['number']) : 5;
        $number = $number ? $number : 5;

        $comments = get_comments(
            apply_filters(
                'widget_comments_args',
                [
                    'number'      => $number,
                    'status'      => 'approve',
                    'post_status' => 'publish',
                ],
                $instance
            )
        );

        $output .= $args['before_widget'];

        if ($title) {
            $output .= $args['before_title'] . $title . $args['after_title'];
        }

        $output .= '<ul id="recentcomments" class="has-dark-link">';

        if (is_array($comments) && $comments) {
            // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
            $post_ids = array_unique(wp_list_pluck($comments, 'comment_post_ID'));
            _prime_post_caches($post_ids, strpos(get_option('permalink_structure'), '%category%'), false);

            foreach ((array) $comments as $comment) {
                $comment_content = strip_tags(str_replace([ "\n", "\r" ], ' ', $comment->comment_content));
                $comment_excerpt = wp_trim_words($comment_content, 10, '&hellip;');

                $output .= '<li class="recentcomments">';

                $output .= '<div class="zentile_recentcomments__header">';
                $output .= get_avatar($comment, 25);
                $output .= '<div class="zentile_recentcomments__user h-truncate">' . get_comment_author($comment) . '</div>';
                $output .= zentile_human_time_diff_html(date('U', strtotime($comment->comment_date)));
                $output .= '</div>';

                $output .= '<div class="zentile_recentcomments__content h-truncate">' . $comment_excerpt . '</div>';
                $output .= '<a href="' . esc_url(get_comment_link($comment)) . '" class="zentile_recentcomments__title h-break-word">' . esc_html(get_the_title($comment->comment_post_ID)) . ' (' . get_comments_number($comment->comment_post_ID) . ')</a>';
                
                $output .= '</li>';
            }
        }
        
        $output .= '</ul>';
        $output .= $args['after_widget'];

        echo $output;
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number'] = absint($new_instance['number']);

        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $number = isset($instance['number']) ? absint($instance['number']) : 5;
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'zentile'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show', 'zentile'); ?></label>
        <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
        <?php
    }
}
