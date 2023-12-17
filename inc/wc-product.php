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






add_action("wp_ajax_check_if_product_exist_in_cart", "check_if_product_exist_in_cart");
add_action("wp_ajax_nopriv_check_if_product_exist_in_cart", "check_if_product_exist_in_cart");

function check_if_product_exist_in_cart()
{
    $product_id = (int)$_POST['product_id'];
    $in_cart = [];
    if (count(WC()->cart->get_cart()) !== 0) {
        foreach (WC()->cart->get_cart() as $cart_item) {
            $product_in_cart = $cart_item['product_id'];
            if ($product_in_cart === $product_id) {
                $in_cart = [
                    'in_cart' => true
                ];
                wp_send_json($in_cart);
            } else {
                $in_cart = [
                    'in_cart' => false
                ];
                wp_send_json($in_cart);
            }
        }
    } else {
        $in_cart = [
            'in_cart' => false
        ];
        wp_send_json($in_cart);
    }
    wp_die();
}


function check_if_product_in_stock()
{
    $p_id = (int)$_POST['product_id'];
    $p = wc_get_product($p_id);
    if ($p->get_stock_status() == 'instock') {
        $s_status = true;
    } else {
        $s_status = false;
    }
    wp_send_json([
        'stock_status' => $s_status
    ]);
    wp_die();
}
add_action("wp_ajax_check_if_product_in_stock", "check_if_product_in_stock");
add_action("wp_ajax_nopriv_check_if_product_in_stock", "check_if_product_in_stock");




add_action('wp_ajax_add_to_cart', 'add_to_cart');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart');
function add_to_cart()
{

    $error = '';
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $attributes = isset($_POST['attributes']) ? $_POST['attributes'] : [];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

    if (empty($product_id)) {
        $error = 'Product was not send';
    }

    if (empty($error)) {
        $variation_id = (new \WC_Product_Data_Store_CPT())->find_matching_product_variation(
            new \WC_Product($product_id),
            $attributes
        );

        WC()->cart->add_to_cart($product_id, $quantity, $variation_id);

        wp_send_json_success([
            'message' => 'Product was added'
        ]);
    } else {
        wp_send_json_error([
            'message' => $error
        ]);
    }
}

function wps_change_products_title()
{

    echo '<h4 class="woocommerce-loop-product__title"><a href="' . get_permalink() . '" class="link">' . get_the_title() . '</a></h4>';
}
add_action('woocommerce_shop_loop_item_title', 'wps_change_products_title', 10);


remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);



remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 30);


add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 5);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
// add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 20);
