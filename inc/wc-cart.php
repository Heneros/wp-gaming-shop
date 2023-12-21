<?php
add_action('woocommerce_before_cart_contents', 'remove_empty_cart_message');

function remove_empty_cart_message()
{
    remove_action('woocommerce_before_cart_contents', 'wc_empty_cart_message');
}


add_filter('woocommerce_empty_cart_message', 'custom_empty_cart_message');
function custom_empty_cart_message()
{
    return '';
}


remove_action('woocommerce_cart_is_empty', 'wc_empty_cart_message', 10);
