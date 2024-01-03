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

add_action('pre_get_posts', 'custom_shop_posts_per_page', 20);
function custom_shop_posts_per_page($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (is_shop()) {
        $query->set('posts_per_page', 6);
    }
}

add_filter('woocommerce_pagination_args', 'custom_woocommerce_pagination');
function custom_woocommerce_pagination($args)
{
    $args['prev_text'] = '<';
    $args['next_text'] = '>';
    $args['mid_size'] = 1;
    $args['end_size'] = 1;
    $args['type'] = 'list';
    $args['show_all'] = false;
    $args['add_args'] = false;
    $args['current'] = max(1, get_query_var('paged'));


    return $args;
}

