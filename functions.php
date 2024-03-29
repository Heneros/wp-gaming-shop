<?php

require get_template_directory() . '/inc/woocommerce/wc-product.php';
require get_template_directory() . '/inc/woocommerce/wc-shop.php';
require get_template_directory() . '/inc/woocommerce/wc-cart.php';
require get_template_directory() . '/inc/woocommerce/wc-checkout.php';
require get_template_directory() . '/inc/woocommerce/wc-myaccount.php';
require get_template_directory() . '/inc/woocommerce/wc-affiliate.php';
require get_template_directory() . '/inc/cpt.php';
require get_template_directory() . '/inc/custom_functions.php';
require get_template_directory() . '/inc/reset-password.php';
require get_template_directory() . '/inc/login-registration.php';
require get_template_directory() . '/inc/rest_api/custom_rest_api.php';



function _assets_paths($path)
{
    return get_template_directory_uri() . '/assets/' . $path;
}


function gaming_scripts()
{


    wp_enqueue_script("bootstrap-js",  _assets_paths("vendor/bootstrap/js/bootstrap.min.js"), ['jquery'], true);
    wp_enqueue_script("isotope-js",  _assets_paths("js/isotope.min.js"), ['jquery'], true);
    wp_enqueue_script("owl-js",  _assets_paths("js/owl-carousel.js"), ['jquery'], true);
    wp_enqueue_script("validate-js",  _assets_paths("vendor/jquery/jquery.validate.min.js"), ['jquery'], true);

    // wp_enqueue_script("slick-js",  _assets_paths("js/slick.js"), ['jquery'], true);
    wp_enqueue_script("accordions-js",  _assets_paths("js/counter.js"), ['jquery'], true);
    wp_enqueue_script("ajax-script", get_template_directory_uri() . '/assets/js/custom.js', array("jquery"));

    wp_localize_script("ajax-script", 'ajax_object', array(
        'ajax_url' =>  admin_url('admin-ajax.php'),
        // 'nonce' => wp_create_nonce('my-ajax-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'gaming_scripts');



function gaming_styles()
{
    wp_enqueue_style("custom-fonts", 'https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap', [], null);
    wp_enqueue_style("css-vendor-bootstrap", _assets_paths("vendor/bootstrap/css/bootstrap.min.css"), [], "1.1", 'all');
    wp_enqueue_style("css-font-awesome", _assets_paths("css/fontawesome.css"), [], "1.1", 'all');
    wp_enqueue_style("css-custom-main", _assets_paths("css/templatemo-lugx-gaming.css"), [], "1.1", 'all');
    wp_enqueue_style("css-owl", _assets_paths("css/owl.css"), [], "1.1", 'all');

    wp_enqueue_style("css-animate", _assets_paths("css/animate.css"), [], "1.1", 'all');


    wp_enqueue_style("css-swiper-bundle", 'https://unpkg.com/swiper@7/swiper-bundle.min.cs', [], "1.1", 'all');
    wp_enqueue_style("css-custom-user", _assets_paths("css/custom.css"), [], "1.1", 'all');
}

add_action("wp_enqueue_scripts", "gaming_styles");


add_action("after_setup_theme", "gaming_setup");


function gaming_setup()
{

    register_nav_menu('menu-header', 'Header Menu');
    register_nav_menu('menu-not-logged', 'Menu  Not Logged');


    add_theme_support('title-tag');

    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_theme_support('automatic-feed-links');

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );
}
