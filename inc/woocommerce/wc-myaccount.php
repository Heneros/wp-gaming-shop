<?php

function remove_account_menu_item($items)
{
    unset($items['dashboard']);
    // unset($items['affiliate-dashboard']);

    $items['affiliates'] = __('Affiliates  Programs', 'wp-gaming-shop');
    $affiliates = $items['affiliates'];
    // unset($items['affiliates']);

    $items = array_merge(array('affiliates' => $affiliates), $items);
    return $items;
}
add_filter('woocommerce_account_menu_items', 'remove_account_menu_item');


add_action("init", function () {
    add_rewrite_endpoint('affiliates', EP_ROOT || EP_PAGES);
});


add_action("woocommerce_account_affiliates_endpoint", function () {
    wc_get_template("myaccount/affiliate_registration.php", []);
});


add_action('woocommerce_registration_redirect', 'custom_registration_redirect', 30);
// add_filter('woocommerce_login_redirect', 'custom_registration_redirect');

function custom_registration_redirect($redirect_to)
{
    $redirect_to = home_url('/thank-you-for-registration/');
    return $redirect_to;
}


//check if user exists
add_action('wp_ajax_nopriv_check_user_exists', 'check_user_exists');
add_action('wp_ajax_check_user_exists', 'check_user_exists');

function check_user_exists()
{
    $username = $_POST['username'];
    if (username_exists($username) || email_exists($username)) {
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }

    wp_die();
}


//check credentials
add_action('wp_ajax_nopriv_check_user_credentials', 'check_user_credentials');
add_action('wp_ajax_check_user_credentials', 'check_user_credentials');

function check_user_credentials()
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = wp_signon(array(
        'user_login'    => $username,
        'user_password' => $password,
        'remember'      => true,
    ), false);

    if (is_wp_error($user)) {
        echo json_encode(array('error' => false, 'message' => 'Invalid credentials'));
    } else {
        echo json_encode(array('success' => true, 'message' => '', 'redirect' => home_url('/')));
    }

    wp_die();
}
