<?php

remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);

add_filter('woocommerce_breadcrumb_defaults', function () {
    return array(
        'delimiter'   => '&nbsp;>&nbsp;',
        'wrap_before' => '<span class="breadcrumb">',
        'wrap_after'  => '</span>',
        'before'      => '',
        'after'       => '',
        'home'        => __('Home', 'gamong-shop'),
    );
});


