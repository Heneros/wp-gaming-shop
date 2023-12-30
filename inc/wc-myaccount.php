<?php

function remove_account_menu_item($items)
{
    unset($items['dashboard']);


    $items['affiliate'] = __('Affiliate Programs', 'wp-gaming-shop');
    $affiliate = $items['affiliate'];
    unset($items['affiliate']);

    $items = array_merge(array('affiliate' => $affiliate), $items);
    return $items;
}
add_filter('woocommerce_account_menu_items', 'remove_account_menu_item');




add_action("init", function () {
    add_rewrite_endpoint('affiliate', EP_ROOT || EP_PAGES);
});


add_action("woocommerce_account_affiliate_endpoint", function () {
    wc_get_template("myaccount/affiliate-programs.php", []);
});
