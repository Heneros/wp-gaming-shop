<?php

use random\random_int;

function generateRandomString($length = 40)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

add_action('wp_ajax_send_email_for_password_reset', 'send_email_for_password_reset');
add_action('wp_ajax_nopriv_send_email_for_password_reset', 'send_email_for_password_reset');




function save_new_password()
{
    global $wpdb;
    $password = $_POST['dataFormArray']['password'];
    $Uid = (int)$_POST['dataFormArray']['Uid'];
    $newPassword = wp_hash_password($password);
    $updatePassword = $wpdb->query("UPDATE  `wpsg_users` SET `user_pass` = '$newPassword'  WHERE `ID` = '$Uid';");

    return wc_logout_url('/login');
}

add_action('wp_ajax_save_new_password', 'save_new_password');
add_action('wp_ajax_nopriv_save_new_password', 'save_new_password');


function send_email_for_password_reset()
{
    global $wpdb;
    $token = generateRandomString();
    $email = $_POST['email'];
    $user  = get_user_by('email', $email);
    if (!empty($user)) {
        $userId = $user->ID;
        $resetUrl = site_url() . '/reset-password?token=' . $token . '&id=' . $userId;
        $to = $email;
        $subject = 'Restore Password';
        $message = 'Reset link: ' . $resetUrl;
        $headers = 'Lost Password';
        wp_mail($to, $subject, $message, $headers);
    } else {
        echo 'Invalid email';
    }
    wp_die();
}

add_action("wp_ajax_send_email_for_password_reset", "send_email_for_password_reset");
add_action("wp_ajax_nopriv_send_email_for_password_reset", "send_email_for_password_reset");


function check_if_user_exist_in_system()
{
    $exists = email_exists($_POST['email']);
    echo $exists;
    wp_die();
}

add_action('wp_ajax_check_if_user_exist_in_system', 'check_if_user_exist_in_system');
add_action('wp_ajax_nopriv_check_if_user_exist_in_system', 'check_if_user_exist_in_system');
