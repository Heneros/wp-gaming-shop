<?php

/**
 * 
 * Template Name: Homepage
 * 
 */
get_header();
?>

<!-- section main-banner -->
<?php get_template_part('/template-parts/homepage/main-banner'); ?>

<!--section  features -->
<?php get_template_part('/template-parts/homepage/features'); ?>

<!--section  trending -->
<?php get_template_part('/template-parts/homepage/trending'); ?>

<!--section  most-played -->
<?php get_template_part('/template-parts/homepage/most-played'); ?>

<!--section top-categories -->
<?php get_template_part('/template-parts/homepage/top-categories'); ?>

<!--section bottom-section -->
<?php get_template_part('/template-parts/homepage/bottom-section'); ?>
<?php
get_footer();
?>