<?php

function registration_affiliate()
{
    $blog_url = $_POST['dataFormArray']['blog_url'];
    $social_link = $_POST['dataFormArray']['social_link'];
    $are_you_influencer = $_POST['dataFormArray']['are_you_influencer'];
    $visitors_number = $_POST['dataFormArray']['visitors_number'];
    $u_id = (int)($_POST['dataFormArray']['u_id']);

    $user_displayname = get_user_by('id', $u_id)->display_name;
    $post_title = 'Registration affiliate by user ' . ' ' . $user_displayname;

    $post_id = wp_insert_post(wp_slash(array(
        'post_status' => 'publish',
        'post_title' => $post_title,
        'post_type' => 'affiliate_members',
        'post_author' => $u_id,
    )));

    update_field("blog_url", $blog_url, $post_id);
    update_field("social_link", $social_link, $post_id);
    update_field("visitors_number", $visitors_number, $post_id);
    update_field("are_you_influencer", $are_you_influencer, $post_id);
}


add_action("wp_ajax_registration_affiliate", "registration_affiliate");
add_action("wp_ajax_nopriv_registration_affiliate", "registration_affiliate");



$current_url = $_SERVER['REQUEST_URI'];

if ($current_url === '/wp-gaming-shop/wp-gaming-shop/my-account/affiliates/') {
    header('Location: /wp-gaming-shop');
    exit();
}