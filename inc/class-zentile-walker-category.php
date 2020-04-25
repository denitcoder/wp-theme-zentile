<?php

class Zentile_Walker_Category extends Walker {
    public $tree_type = 'category';
    public $db_fields = [
        'parent' => 'parent',
        'id' => 'term_id',
    ];

    public function start_lvl(&$output, $depth = 0, $args = []) {
        $output .= '<ul class="children">';
    }

    public function end_lvl(&$output, $depth = 0, $args = []) {
        $output .= '</ul>';
    }

    public function start_el(&$output, $category, $depth = 0, $args = [], $id = 0) {
        $cat_name = apply_filters('list_cats', esc_attr($category->name), $category);

        if ('' === $cat_name) return;

        $atts = [];
        $atts['href'] = get_term_link($category);
        $atts = apply_filters('category_list_link_attributes', $atts, $category, $depth, $args, $id);
        $attributes = '';

        foreach ($atts as $attr => $value) {
            if (is_scalar($value) && '' !== $value && false !== $value) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $link = '<a' . $attributes . '><span class="category__name h-truncate">' . $cat_name . '</span>';

        if (! empty($args['show_count'])) {
            $link .= '<span class="category__count">' . number_format_i18n($category->count) . '</span>';
        }

        $link .= '</a>';

        $output .= "\t<li";
        $css_classes = [ 'menu-item', 'cat-item', 'cat-item-' . $category->term_id ];

        if (!empty($args['current_category'])) {
            // 'current_category' can be an array, so we use `get_terms()`.
            $_current_terms = get_terms([
                'taxonomy'   => $category->taxonomy,
                'include'    => $args['current_category'],
                'hide_empty' => false,
            ]);

            foreach ($_current_terms as $_current_term) {
                if ($category->term_id == $_current_term->term_id) {
                    $css_classes[] = 'current-menu-item';
                    $link = str_replace('<a', '<a aria-current="page"', $link);
                } elseif ($category->term_id == $_current_term->parent) {
                    $css_classes[] = 'current-cat-parent';
                }

                while ($_current_term->parent) {
                    if ($category->term_id == $_current_term->parent) {
                        $css_classes[] = 'current-cat-ancestor';
                        break;
                    }

                    $_current_term = get_term($_current_term->parent, $category->taxonomy);
                }
            }
        }

        $css_classes = implode(' ', apply_filters('category_css_class', $css_classes, $category, $depth, $args));
        $css_classes = $css_classes ? ' class="' . esc_attr($css_classes) . '"' : '';

        $output .= $css_classes;
        $output .= ">$link\n";
    }

    public function end_el(&$output, $page, $depth = 0, $args = []) {
        $output .= "</li>\n";
    }
}