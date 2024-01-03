<?php
add_action('init',  'custom_affiliate_function');

function custom_affiliate_function()
{
    register_post_type('affiliate_members', array(
        'labels'       => array(
            'name'          => __('Affiliate Members', 'wp-gaming'),
            'singular_name' => __('Affiliate Members', 'wp-gaming'),
            'add_new'       => __('Add new Affiliate Member', 'wp-gaming'),
            'add_new_item'  => __('New Affiliate Member', 'wp-gaming'),
            'edit_item'     => __('Edit', 'wp-gaming'),
            'new_item'      => __('New Affiliate Member', 'wp-gaming'),
            'view_item'     => __('View', 'wp-gaming'),
            'menu_name'     => __('Affiliate Members', 'wp-gaming'),
            'all_items'     => __('All Affiliate Members', 'wp-gaming'),
        ),
        'public'       => true,
        'supports'     => array('title', 'editor', 'excerpt'),
        'menu_icon'    => 'dashicons-admin-post',
        'show_in_rest' => true,
    ));
}




