<?php
global $product;
$product_categories = $product->get_category_ids();
$args = [
    'post_type' => 'product',
    'exclude' => array($product->get_id()),
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $product_categories,
            'operator' => 'IN'
        )
    )
];

$related_products = wc_get_products($args);
if (!empty($related_products)) :
    $categoryName =   wc_get_product_category_list($product->get_id());
    $newCat = strip_tags($categoryName);
?>

    <div class="section categories related-games">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6><?php echo $newCat ?></h6>
                        <h2>Related Games</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="<?= site_url('/shop'); ?>">View All</a>
                    </div>
                </div>
                <?php foreach ($related_products as $related_product) :
                    $featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($related_product->get_id()), '');
                    $image_url = $featured_img[0];
                ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="item">
                            <h4><?php echo  $newCat;  ?></h4>
                            <?php
                            ?>
                            <div class="thumb">
                                <a href=" <?php echo $related_product->get_permalink()  ?>"><img src="<?php echo $image_url; ?>" alt="Preview image">
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
<?php endif; ?>