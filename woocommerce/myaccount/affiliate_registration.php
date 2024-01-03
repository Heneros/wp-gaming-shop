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
    <form id="affiliate_reg" action="post">
        <h1>Register to be affiliate</h1>
        <div class="form-group">
            <input type="text" id="blog_url" class="form-control" name="blog_url" placeholder="Blog url">
        </div>
        <div class="form-group">
            <input type="hidden" name="u_id" class="form-control" value="<?php echo $user_ID; ?>" placeholder="">
        </div>
        <div class="form-group">
            <input type="text" name="social_link" class="form-control" placeholder="Social link">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="visitor_number" placeholder="visitors number">
        </div>
        <div class="form-group">
            <input type="text" name="are_you_influencer" class="form-control" placeholder="are you influencer artist">
        </div>

        <button type="submit" class="btn btn-primary" id="registration_affiliate_btn">Submit</button>
    </form>

    <?php
    echo do_shortcode('[yith_wcaf_registration_form]');
    ?>
<?php
}
// echo 'test'
