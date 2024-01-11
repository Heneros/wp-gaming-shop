<div class="modal fade " id="myAccountModal" tabindex="-1" aria-labelledby="myAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h1 class="modal-title fs-5" id="cartModalLabel">Modal title</h1> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
                    <form method="post" class="woocommerce-form woocommerce-form-register register js-form-validate">
                        <?php do_action('woocommerce_register_form_start'); ?>
                        <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
                            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="username"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="reg_username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
                                <div class="error__info"></div>
                            </div>
                        <?php endif; ?>
                        <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="reg_email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" />
                            <div class="error__info"></div>
                        </div>
                        <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="reg_password" id="reg_password" autocomplete="new-password" />
                                <div class="error__info"></div>
                            </div>
                            <div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="reg_confirm_password"><?php esc_html_e('Confirm Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="reg_confirm_password" id="reg_confirm_password" autocomplete="new-password" />
                                <div class="error__info"></div>
                            </div>
                        <?php else : ?>
                            <p><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>
                        <?php endif; ?>
                        <?php do_action('woocommerce_register_form'); ?>
                        <p class="woocommerce-form-row form-row">
                            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                            <button type="submit" class="btn btn-primary" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
                        </p>
                        <?php do_action('woocommerce_register_form_end'); ?>
                        <?php
                        echo do_shortcode('[nextend_social_login provider="google"]');
                        ?>
                    </form>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>