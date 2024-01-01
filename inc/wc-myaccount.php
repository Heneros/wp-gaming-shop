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
