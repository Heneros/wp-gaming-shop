<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header();
// do_action('woocommerce_before_main_content');

?>

<div class="page-heading header-text">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h3><?= woocommerce_page_title(); ?></h3>

				<?php
				if (function_exists('woocommerce_breadcrumb')) {
					woocommerce_breadcrumb();
				}
				?>
			</div>
		</div>
	</div>
</div>
<div class="section trending">
	<div class="container">
		<?php echo do_shortcode('[wpf-filters id=1]'); ?>
		<div class="row trending-box">
			<?php
			if (woocommerce_product_loop()) {
				do_action('woocommerce_before_shop_loop');
				woocommerce_product_loop_start();
				if (isset($_GET['searchKeyword'])) {
					$keyword = sanitize_text_field($_GET['searchKeyword']);
					$args = array(
						'post_type' => 'product',
						's' => $keyword
					);
					$query = new WP_Query($args);
					if ($query->have_posts()) {
						while ($query->have_posts()) {
							$query->the_post();

							wc_get_template_part('content', 'product');
						}
					} else {
						echo 'No results';
					}
					wp_reset_postdata();
				} else {
					if (wc_get_loop_prop('total')) {
						while (have_posts()) {
							the_post();
							do_action('woocommerce_shop_loop');
							wc_get_template_part('content', 'product');
						}
					}
				}

				woocommerce_product_loop_end();
				wp_reset_postdata();
				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action('woocommerce_after_shop_loop');
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action('woocommerce_no_products_found');
			}

			/**
			 * Hook: woocommerce_after_main_content.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action('woocommerce_after_main_content');

			/**
			 * Hook: woocommerce_sidebar.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			?>
		</div>
	</div>



</div>
<?php
get_footer('shop');
