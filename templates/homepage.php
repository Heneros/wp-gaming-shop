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


<div class="section categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-heading">
                    <h6>Categories</h6>
                    <h2>Top Categories</h2>
                </div>
            </div>
            <div class="col-lg col-sm-6 col-xs-12">
                <div class="item">
                    <h4>Action</h4>
                    <div class="thumb">
                        <a href="product-details.html"><img src="assets/images/categories-01.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg col-sm-6 col-xs-12">
                <div class="item">
                    <h4>Action</h4>
                    <div class="thumb">
                        <a href="product-details.html"><img src="assets/images/categories-05.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg col-sm-6 col-xs-12">
                <div class="item">
                    <h4>Action</h4>
                    <div class="thumb">
                        <a href="product-details.html"><img src="assets/images/categories-03.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg col-sm-6 col-xs-12">
                <div class="item">
                    <h4>Action</h4>
                    <div class="thumb">
                        <a href="product-details.html"><img src="assets/images/categories-04.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg col-sm-6 col-xs-12">
                <div class="item">
                    <h4>Action</h4>
                    <div class="thumb">
                        <a href="product-details.html"><img src="assets/images/categories-05.jpg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section cta">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="shop">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-heading">
                                <h6>Our Shop</h6>
                                <h2>Go Pre-Order Buy & Get Best <em>Prices</em> For You!</h2>
                            </div>
                            <p>Lorem ipsum dolor consectetur adipiscing, sed do eiusmod tempor incididunt.</p>
                            <div class="main-button">
                                <a href="shop.html">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-2 align-self-end">
                <div class="subscribe">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-heading">
                                <h6>NEWSLETTER</h6>
                                <h2>Get Up To $100 Off Just Buy <em>Subscribe</em> Newsletter!</h2>
                            </div>
                            <div class="search-input">
                                <form id="subscribe" action="#">
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your email...">
                                    <button type="submit">Subscribe Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

get_footer();
?>