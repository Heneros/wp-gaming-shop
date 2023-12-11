<div class="section trending">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h6>Trending</h6>
                    <h2>Trending Games</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="main-button">
                    <a href="<?php echo site_url('/shop'); ?>">View All</a>
                </div>
            </div>

            <?php
            $args = [
                'post_type' => 'product',
                'posts_per_page' => 4,
                'orderby' => 'comment_count'
            ];

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $product = wc_get_product(get_the_ID());

                    $image_url = wp_get_attachment_url(get_post_thumbnail_id());
                    $product_permalink = esc_url(get_permalink(get_the_ID()));

                    $price = $product->get_price_html();
                    $product_name = $product->get_name();

                    $product_category =   wc_get_product_category_list(get_the_ID());


                    $regular_price = $product->get_regular_price();
                    $sale_price = $product->get_sale_price();

                    $discount_percentage = ($regular_price && $sale_price) ? round(($regular_price - $sale_price) / $regular_price * 100) : 0;
                    $discount_text = $discount_percentage ? '-' . $discount_percentage . '%' : '';


            ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <a href="<?php echo  $product_permalink; ?>"><img src="<?php echo esc_url($image_url); ?>" alt=""></a>
                                <span class="price"><em>$<?php echo $sale_price ?></em>$<?= $regular_price ?> </span>
                            </div>
                            <div class="down-content">
                                <?php
                                $product_categories = get_the_terms(get_the_ID(), 'product_cat');
                                if ($product_categories && !is_wp_error($product_categories)) {
                                    $category_names = array();
                                    foreach ($product_categories as $category) {
                                        $category_names[] = $category->name;
                                    }
                                    echo '<span class="category">' . implode(', ', $category_names) . '</span>';
                                }
                                ?>
                                <h4><?php echo $product_name; ?></h4>
                                <a class="add-to-cart" href="<?php echo site_url('/cart/?add-to-cart=') . absint($product->get_id()); ?>"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>


        </div>
    </div>
</div>