<?php

function zentile_cmp_sidebar_right() {
    if (!zentile_show_sidebar() || !is_active_sidebar('sidebar-right')) return;

    echo '<aside id="site-sidebar-right" role="complementary" class="widget-area--vertical">';
    dynamic_sidebar('sidebar-right');
    echo '</aside>';
}