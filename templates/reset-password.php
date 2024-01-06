<?php

/*
 *
 * Template Name: Reset Password
 * 
 * 
 */
get_header();

get_template_part('template-parts/header');
global $post;
global $wpdb;
$uId = (int)$_GET['id'];

$getUser = $wpdb->get_results("SELECT * FROM `wp_users` WHERE `ID` = '$uId' ");
var_dump($getUser);
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="text-align">
                <h3>Reset Password</h3>
                <form class="mt-4" id="enter_new_password_form">
                    <input type="hidden" name="Uid" value="<?= $getUser[0]->ID ?>">
                    <div class="form-group ">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password" class="form-control">
                    </div>
                    <div class="form-group ">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" class="form-control">
                    </div>
                    <button type="submit" id="enter_new_password_btn" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php

get_footer();
