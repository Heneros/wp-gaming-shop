<?php

/*
 *
 * Template Name: page 404
 *
 */

get_header();
?>
<?php get_template_part('/template-parts/header'); ?>
<div class="container">
    <div class="text-align">
        <h1> 404</h1>
        <h5>Page not found</h5>
        <p >Return to <a href="<?php echo site_url('/shop') ?>"><strong>Shop </strong></a></p>
    </div>
</div>
<?php
get_footer();
?>