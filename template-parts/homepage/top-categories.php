<div class="section categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-heading">
                    <h6>Categories</h6>
                    <h2>Top Genres</h2>
                </div>
            </div>

            <?php
            $terms = get_terms(array(
                'taxonomy' => 'product_cat',
                'fields' => 'all',
            ));
            foreach ($terms as $term) {
                $image = get_term_meta($term->term_id, 'thumbnail_id', true);
            ?>
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4><?php echo $term->name ?></h4>
                        <div class="thumb">
                            <a href="#!"><img src="<?php echo wp_get_attachment_image_url($image, 'thumbnail') ?>" alt=""></a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>