<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header();
global $product;
$product = wc_get_product(get_the_ID());
$product_id = get_the_ID();


$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), '');
$product_image = $image_url[0];

$regular_price = $product->get_regular_price();
$sale_price = $product->get_sale_price();
$product_short_desc = $product->get_short_description();
$product_description = $product->get_description();
?>
<?php get_template_part('/template-parts/header'); ?>

<div class="single-product section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<?php if (!empty($product_image)) : ?>
					<div class="left-image">
						<img src="<?php echo $product_image; ?>" alt="">
					</div>
				<?php endif; ?>
			</div>
			<div class="col-lg-6 align-self-center">
				<h4> <?= the_title() ?> </h4>
				<span class="price">
					<?php
					if (!empty($sale_price)) {
						echo '<em>$' . $regular_price .  '</em>';
						echo '$' . $sale_price;
					} else {
						echo '$' . $regular_price;
					}
					?>
				</span>
				<p>
					<?=
					$product_short_desc ?>
				</p>
				<style>

				</style>
				<?php
				do_action('woocommerce_single_product_summary');
				?>
			</div>
			<div class="col-lg-12">
				<div class="sep"></div>
			</div>
			<?php
			/**
			 * woocommerce_before_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action('woocommerce_before_main_content');
			?>


			<?php
			/**
			 * woocommerce_after_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action('woocommerce_after_main_content');
			?>
		</div>
	</div>
</div>
<!-- More Info. Tabs. Review section  -->
<?php get_template_part('/template-parts/single-product/tabs'); ?>
<!-- Related Games -->
<?php get_template_part('/template-parts/single-product/related-games'); ?>
<?php
get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
