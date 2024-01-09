<?php


get_header();
get_template_part('template-parts/header');
if (have_posts()) :
    while (have_posts()) :
        the_post();

    endwhile;




endif;



get_footer();
