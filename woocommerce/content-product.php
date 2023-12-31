<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}
?>
<div <?php wc_product_class('col-xl-3 col-lg-4 col-md-6 align-self-center mb-30 trending-items', $product); ?>>
	<div class="item">
		<a href="<?= get_permalink() ?>">
			<?php
			do_action('woocommerce_before_shop_loop_item_title');
			?>
		</a>
		<div class="down-content">
			<?php
			$categories  =  get_the_terms($product->get_id(), 'product_cat');
			if ($categories && !is_wp_error($categories)) {
				foreach ($categories as $category) {
					echo '<span class="category">' . $category->name . '</span>';
				}
			}
			?>
			<?php
			do_action('woocommerce_after_shop_loop_item_title');
			do_action('woocommerce_shop_loop_item_title');
			do_action('woocommerce_after_shop_loop_item');
			?>
		</div>
	</div>
</div>