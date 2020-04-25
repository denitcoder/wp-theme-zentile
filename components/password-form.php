<?php

function zentile_cmp_password_form() {
    $output = '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" class="post__password-form" method="post">
    <p>' . __('This content is password protected. To view it please enter your password below:') . '</p>
    <p><label>' . __('Password:') . ' <input name="post_password" type="password"></label></p>
    <button name="Submit" class="button --primary">' . esc_attr_x('Enter', 'post password form') . '</button>
    </form>';
 
    echo apply_filters('the_password_form', $output);
}