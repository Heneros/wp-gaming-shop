<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="site-container">
        <!-- product-added -->
        <?php
        get_template_part('template-parts/modals/product-added');
        ?>
        <!-- ends product-added -->
        <!--Form Register Modal -->
        <?php if (is_page('my-account')) : ?>
            <?php
            get_template_part('template-parts/modals/form-register');
            get_template_part('template-parts/modals/lost-password');
            ?>
            <!--End Form Register -->
        <?php endif; ?>

        <!-- ***** Preloader Start ***** -->
        <!-- <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div> -->
        <!-- ***** Preloader End ***** -->
        <!-- ***** Header Area Start ***** -->
        <header class="header-area header-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-nav">
                            <!-- ***** Logo Start ***** -->
                            <?php
                            the_custom_logo();
                            ?>
                            <?php
                            if (is_user_logged_in()) {
                                wp_nav_menu([
                                    'theme_location' => 'menu-header',
                                    'menu_class' => 'nav',
                                    'container' => 'ul'
                                ]);
                            } else {
                                wp_nav_menu([
                                    'theme_location' => 'menu-not-logged',
                                    'menu_class' => 'nav',
                                    'container' => 'ul'
                                ]);
                            }
                            ?>
                            <a class='menu-trigger'>
                                <span>Menu</span>
                            </a>
                            <!-- ***** Menu End ***** -->
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <?php
        ///var_dump(WC()->cart->get_cart());
        ?>
        <!-- ***** Header Area End ***** -->