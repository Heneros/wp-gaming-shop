
document.addEventListener('DOMContentLoaded', function () {
	jQuery(document).ready(function ($) {
		$('.add-to-cart-btn').on('click', function (e) {
			e.preventDefault();

			let addToCartUrl = this.href;
			let getIdFromUrl = addToCartUrl.split('=');

			let productID = parseInt(getIdFromUrl[1]);

			$.ajax({
				type: "POST",
				url: my_ajax_object.ajax_url,
				cache: false,
				data: {
					product_id: productID,
					action: 'check_if_product_exist_in_cart'
				},
				success: function (response) {
					$.ajax({
						type: 'POST',
						url: my_ajax_object.ajax_url,
						cache: false,
						data: {
							product_id: productID,
							action: 'check_if_product_in_stock'
						},
						success: function (response_s) {
							if (response_s.stock_status == true) {
								// alert('added');
							} else {
								alert("Error happened add-to-cart");
							}
						}
					})
				}
			})
		})

	});
});



(function ($) {

	"use strict";

	// Page loading animation
	$(window).on('load', function () {

		$('#js-preloader').addClass('loaded');

	});


	$(window).scroll(function () {
		var scroll = $(window).scrollTop();
		var box = $('.header-text').height();
		var header = $('header').height();

		if (scroll >= box - header) {
			$("header").addClass("background-header");
		} else {
			$("header").removeClass("background-header");
		}
	})

	var width = $(window).width();
	$(window).resize(function () {
		if (width > 767 && $(window).width() < 767) {
			location.reload();
		}
		else if (width < 767 && $(window).width() > 767) {
			location.reload();
		}
	})

	const elem = document.querySelector('.trending-box');
	const filtersElem = document.querySelector('.trending-filter');
	if (elem) {
		const rdn_events_list = new Isotope(elem, {
			itemSelector: '.trending-items',
			layoutMode: 'masonry'
		});
		if (filtersElem) {
			filtersElem.addEventListener('click', function (event) {
				if (!matchesSelector(event.target, 'a')) {
					return;
				}
				const filterValue = event.target.getAttribute('data-filter');
				rdn_events_list.arrange({
					filter: filterValue
				});
				filtersElem.querySelector('.is_active').classList.remove('is_active');
				event.target.classList.add('is_active');
				event.preventDefault();
			});
		}
	}


	// Menu Dropdown Toggle
	if ($('.menu-trigger').length) {
		$(".menu-trigger").on('click', function () {
			$(this).toggleClass('active');
			$('.header-area .nav').slideToggle(200);
		});
	}


	// Menu elevator animation
	$('.scroll-to-section a[href*=\\#]:not([href=\\#])').on('click', function () {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				var width = $(window).width();
				if (width < 991) {
					$('.menu-trigger').removeClass('active');
					$('.header-area .nav').slideUp(200);
				}
				$('html,body').animate({
					scrollTop: (target.offset().top) - 80
				}, 700);
				return false;
			}
		}
	});


	// Page loading animation
	$(window).on('load', function () {
		if ($('.cover').length) {
			$('.cover').parallax({
				imageSrc: $('.cover').data('image'),
				zIndex: '1'
			});
		}

		$("#preloader").animate({
			'opacity': '0'
		}, 600, function () {
			setTimeout(function () {
				$("#preloader").css("visibility", "hidden").fadeOut();
			}, 300);
		});
	});



	///custom code for wp

	setTimeout(function () {
		$(".wpfFilterVerScroll").addClass("trending-filter");
		$(".wpfFilterVerScroll").each(function () {
			var input = $(this).find(".wpfLiLabel input:checked");
			if (input.length > 0) {
				input.closest('.wpfLiLabel').addClass("activeWrapper");
			} else {
				console.log('Not Found');
			}
		});

		$('.woocommerce-pagination .page-numbers').addClass('pagination');





		$('.woocommerce-pagination').removeClass('woocommerce-pagination');
		$('.woocommerce-pagination').wrap('<div class="row"><div class="col-lg-12"></div></div>');

		var currentURL = window.location.href;
		var cleanURL = currentURL.split('?')[0];
		var hasCategories = currentURL.includes('?');

		var categoryList = document.querySelector('.wpfFilterVerScroll');
		var allCategoriesItem = document.createElement('li');
		var label = document.createElement('label');
		label.classList.add('wpfLiLabel', 'activeWrapper');
		label.innerHTML = '<a href="' + cleanURL + '">Show All</a>';

		allCategoriesItem.appendChild(label);
		categoryList.insertBefore(allCategoriesItem, categoryList.firstChild);

		categoryList.addEventListener('click', function (event) {
			if (event.target.tagName === 'A' && event.target.parentElement.classList.contains('wpfLiLabel')) {
				event.preventDefault();
				window.location.href = event.target.getAttribute('href');
			}
		});

		if (!hasCategories) {
			label.classList.add('activeWrapper');
		}else{
			label.classList.remove('activeWrapper');
		}


	}, 700)





})(window.jQuery);
