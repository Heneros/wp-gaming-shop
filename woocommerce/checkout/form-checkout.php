<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
	exit;
}
get_template_part('/template-parts/header');
?>
<div class="container">
	<?php
	do_action('woocommerce_before_checkout_form', $checkout);

	// If checkout registration is disabled and not logged in, the user cannot checkout.
	if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
		echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
		return;
	}
	?>
	<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
		<div class="parent-row">
			<div class="col-lg-8 checkout-form ">
				<?php do_action('woocommerce_checkout_billing'); ?>
				<?php do_action('woocommerce_checkout_shipping'); ?>

			</div>
			<div class="col-lg-4 checkout-form " id="order_review">
				<?php do_action('woocommerce_checkout_order_review'); ?>
			</div>
		</div>
	</form>
</div>
<?php do_action('woocommerce_after_checkout_form', $checkout); ?>