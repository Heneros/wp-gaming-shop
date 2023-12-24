<?php

function remove_account_menu_item($items)
{
    unset($items['dashboard']);
    // unset($items['downloads']);
    // unset($items['orders']);
    // unset($items['edit-address']);

    return $items;
}
add_filter('woocommerce_account_menu_items', 'remove_account_menu_item');

