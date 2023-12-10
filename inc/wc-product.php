<?php


add_action('woocommerce_product_options_general_product_data', 'custom_field_game');

function custom_field_game()
{
    global $post;

    echo '<div class="options_group">';
    woocommerce_wp_text_input(
        array(
            'id' => '_custom_field_game',
            'label' => __('Game Series', 'woocommerce'),
            'placeholder' => '',
            'desc_tip' => 'true',
            'description' => __('Enter the custom text here.', 'woocommerce')
        )
    );

    echo '</div>';
}

add_action('woocommerce_process_product_meta', 'save_custom_field_game');

function save_custom_field_game($post_id)
{
    $custom_text = isset($_POST['_custom_field_game']) ? sanitize_text_field($_POST['_custom_field_game']) : '';
    update_post_meta($post_id, '_custom_field_game', $custom_text);
}
