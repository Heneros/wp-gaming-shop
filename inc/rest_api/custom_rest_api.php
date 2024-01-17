<?php
// function custom_read_user_callback(){
//     return rest_ensure_response('hello world!');
// }
// function custom_create_user_callback(){
//     return rest_ensure_response('create world!');
// }curl -X POST -d "username=testuser&password=testpassword&email=testuser@example.com" http://localhost/wp-gaming-shop/wp-json/custom-api/v1/



function my_read_post_endpoint( $data ) {
//    
    return 'hello world!';
   }
   


//    function my_create_post_endpoint( WP_REST_Request $request  ) {
//     // return rest_ensure_response('Create world!');
//     // return 'Create world!';
//     $user_id = wp_insert_user(array(
//         'user_login' => $request->get_param('username'),
//         'user_password' => $request->get_param('password'),
//         'user_email' => $request->get_param('email'),
//         'first_name' => $request->get_param('first_name'),
//         'last_name' => $request->get_param('last_name'),
//         'role' => $request->get_param('role'),
//     ));

//     $user = get_user_by('id', $user_id);
//     return $user;
//    }

// add_action('rest_api_init', function () {
//     register_rest_route('custom-api/v1', 'post_endpoint',
//      [
//         'methods' =>   WP_REST_Server::READABLE ,
//         'callback' => 'my_read_post_endpoint',
//      ], 
//      [
//         'methods' => WP_REST_Server::CREATABLE,
//         'callback' => 'my_create_post_endpoint',
//      ], 
// );
// });

function register_our_custom_api_routes() {
    register_rest_route( 'custom-api/v1', '/endpointtest',
     array(
            'methods'  => 'POST',
            'callback' => 'our_custom_callback_function',
        )
    );
}



function our_custom_callback_function( WP_REST_Request $request ) {
    $params = $request->get_params();

    $required_params = array( 'username', 'password', 'email' );
    foreach ( $required_params as $param ) {
        if ( empty( $params[ $param ] ) ) {
            return new WP_Error( 'missing_param', 'Missing required parameter: ' . $param, array( 'status' => 400 ) );
        }
    }

    $user_id = wp_insert_user( array(
        'user_login'   => $params['username'],
        'user_pass'    => $params['password'],
        'user_email'   => $params['email'],
        'first_name'   => isset( $params['first_name'] ) ? $params['first_name'] : '',
        'last_name'    => isset( $params['last_name'] ) ? $params['last_name'] : '',
        'role'         => isset( $params['role'] ) ? $params['role'] : 'subscriber',
    ) );

    if ( is_wp_error( $user_id ) ) {
        return new WP_Error( 'user_creation_failed', 'Failed to create user', array( 'status' => 500 ) );
    } else {
        $user = get_user_by( 'id', $user_id );
        return rest_ensure_response( $user );
    }
}
add_action( 'rest_api_init', 'register_our_custom_api_routes' );

