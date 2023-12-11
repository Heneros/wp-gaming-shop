<?php


?>
<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="caption header-text">
                    <h6>Welcome to <?php echo bloginfo('name'); ?></h6>
                    <h2>BEST GAMING SITE EVER!</h2>
                    <p>
                        <?php
                        the_content();
                        ?>
                    </p>

                    <div class="search-input">
                        <form id="search" method="GET" action="<?php echo site_url('/shop'); ?>">
                            <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" />
                            <button role="button" type="submit">Search Now</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 offset-lg-2">
                <div class="right-image">
                    <?php
                    $args = [
                        'post_type' => 'product',
                        'p' => 62,
                    ];

                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            $product = wc_get_product(get_the_ID());

                            $image_url = wp_get_attachment_url(get_post_thumbnail_id());
                            $price = $product->get_price_html();

                            $regular_price = $product->get_regular_price();
                            $sale_price = $product->get_sale_price();

                            $discount_percentage = ($regular_price && $sale_price) ? round(($regular_price - $sale_price) / $regular_price * 100) : 0;
                            $discount_text = $discount_percentage ? '-' . $discount_percentage . '%' : '';


                    ?>
                            <img src="<?php echo esc_url($image_url); ?>" class="thumbnail-image" alt="">
                            <span class="price"><?php echo $price; ?></span>
                            <span class="offer"><?php echo esc_html($discount_text); ?></span>
                    <?php
                        }
                    }
                    wp_reset_postdata();

                    ?>

                </div>
            </div>
        </div>
    </div>
</div>