<?php

remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 40);
remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 40);
add_filter('woocommerce_show_messages', '__return_false');


// remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 40);
// remove_action('woocommerce_checkout_shipping', 'woocommerce_checkout_coupon_form', 40);


add_filter('woocommerce_checkout_fields', 'print_all_fields');

function print_all_fields($fields)
{
    unset($fields['billing']['billing_phone']);
    unset($fields['billing']['postcode']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);

    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);

    return $fields;
}
