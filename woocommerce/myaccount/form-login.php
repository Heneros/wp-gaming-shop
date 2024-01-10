<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>
<?php
// do_action('woocommerce_before_customer_login_form');

get_template_part('/template-parts/header');
?>

<div class="container">
	<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>

	<?php endif; ?>
	<div class="row  d-flex align-items-center justify-content-between">
		<div class="col-md-6 col-sm-12   log-parent__information">
			<div class="log__text-info">
				<div class="image">
					<a href="#!">
						<img src="<?php echo get_template_directory_uri() ?>/assets/images/logo.png" alt="">

					</a>
				</div>
				<h4 class="log-title">Register or log in to purchase games</h4>
			</div>
		</div>

		<div class="col-md-6 col-sm-12  log-parent__form">

			<form class="woocommerce-form woocommerce-form-login login mt-4" id="validate-form" method="post" novalidate <?php do_action('woocommerce_register_form_tag'); ?>>
				<?php do_action('woocommerce_login_form_start'); ?>

				<div class="form-group log-field">
					<input type="text" maxlength="25" name="username" id="username" autocomplete="username" placeholder="Email or username" class="woocommerce-Input woocommerce-Input--text input-text form-control" required value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>">
					<div class="error__info"></div>
				</div>
				<div class="form-group log-field">
					<input type="password" name="password" id="password" autocomplete="current-password" maxlength="45" class="form-control" placeholder="Password...">
					<?php do_action('woocommerce_login_form'); ?>
					<div class="error__info"></div>
				</div>

				<div class="bottom-form mt-4">
					<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
					<button type="submit" class="btn btn-primary  " name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
					<a href="#!" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">
						<?php esc_html_e('Forget Password?', 'woocommerce') ?>
					</a>
					<hr>
					<a data-bs-toggle="modal" data-bs-target="#myAccountModal" class="btn btn-success"> Create New Account</a>
				</div>
				<?php do_action('woocommerce_login_form_end'); ?>
			</form>

		</div>
	</div>


</div>
<?php do_action('woocommerce_after_customer_login_form'); ?>