<?php

/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

global $product;

$game_id = get_post_field('_custom_field_game');

?>
<ul class="product_meta">

	<?php do_action('woocommerce_product_meta_start'); ?>

	<li>
		<span>Game ID:</span>
		<?php echo $game_id; ?>
	</li>

	<?php
	$genre_list = wc_get_product_category_list($product->get_id(), ', ', '<li class="posted_in">', '', '</li>');
	$tag_list = wc_get_product_tag_list($product->get_id(), ', ', '<li class="tagged_as">', '', '</li>');

	$genre_text = wp_strip_all_tags($genre_list);
	$tag_text = wp_strip_all_tags($tag_list);

	echo '<li><span class="genre-wrapper"> Genre</span>' . 	$genre_text .  '</li>';
	if ($tag_list) {
		echo '<li><span class="tag-wrapper">Tags</span>' . $tag_text .   '</li>';
	}
	?>


	<?php do_action('woocommerce_product_meta_end'); ?>

</ul>