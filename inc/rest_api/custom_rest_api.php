<?php

add_action('rest_api_init', function () {
    register_rest_route('my/v1', '/projects', [
        'methods' => 'GET',
        'callback' => 'get_projects',
        'permission_callback' => '__return_true',
    ]);
});


function get_projects($params){
    $projects =  get_posts( [
        'post_type' => 'post',
        'posts_per_page' => 10
      ] );
}