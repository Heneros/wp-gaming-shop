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
} else { ?>
    <form class="mt-5" id="affiliate_reg" action="post">
        <h1>Register to be affiliate member</h1>
        <div class="form-group log-bar mt-4">
            <label for="blog_url">Blog url</label>
            <input type="text" id="blog_url" id="blog_url" class="form-control" name="blog_url" placeholder="Blog url">
        </div>
        <div class="form-group log-bar mt-3">
            <input type="hidden" name="u_id" class="form-control" value="<?php echo $user_ID; ?>">
        </div>
        <div class="form-group log-bar mt-3">
            <label for="social_link">Social Link</label>
            <input type="text" name="social_link" id="social_link" class="form-control" placeholder="Social link">
        </div>
        <div class="form-group log-bar mt-3">
            <label for="visitors_number">Visitors Number</label>
            <input type="text" name="visitors_number" id="visitors_number" class="form-control" placeholder="visitors number">
        </div>
        <div class="form-group log-bar mt-3">
            <label for="are_you_influencer"> Are you Influencer Artist</label>
            <input type="text" id="are_you_influencer" name="are_you_influencer" class="form-control" placeholder="are you influencer artist">
        </div>
        <button type="submit" class="btn btn-primary" id="registration_affiliate_btn">Submit</button>
    </form>
    <div id="affiliate_reg_button" class="affiliate_reg_button">
        <?php
        echo do_shortcode('[yith_wcaf_registration_form]');
        ?>
    </div>
<?php
}
