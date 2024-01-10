<?php

function reg_form()
{

    $username = sanitize_user($_POST['reg_username']);
    $email = sanitize_email($_POST['reg_email']);
    $password = $_POST['reg_password'];
    $response = array();

    if (!username_exists($username) && !email_exists($email)) {
        $user_id = wp_create_user($username, $password, $email);
        if (!is_wp_error($user_id)) {
            $user = new WP_User($user_id);
            $user->set_role('subscriber');
            wp_redirect(home_url('/shop'));
            exit;
        }
    } else {
        $response['error'] = 'Email or username already available';
    }
    echo json_encode($response);
    wp_die();
}

add_action("wp_ajax_reg_form", "reg_form");
add_action("wp_ajax_nopriv_reg_form", "reg_form");
