<?php
global $wpdb;

$user_ID = get_current_user_id();
// var_dump($search_query);

$search_query = "SELECT * FROM {$wpdb->prefix}yith_wcaf_affiliates WHERE `user_id` = '$user_ID' ";
$results = $wpdb->get_results($wpdb->prepare($search_query));

// var_dump($results);
if (!empty($results) && !empty($results[0]->user_id) && (int)$results[0]->enabled === 1) {
?>
    <ul></ul>
    <nav>
        <ul></ul>
    </nav>
    </ul>
<?php
    echo do_shortcode('[yith_wcaf_affiliate_dashboard]');
    // echo do_shortcode('[yith_wcaf_registration_form]');
} else { ?>
    <form action="">
        <h1>Register to be affiliate</h1>
    </form>
    <?php echo do_shortcode('[yith_wcaf_registration_form]'); ?>
<?php
}
// echo 'test'
