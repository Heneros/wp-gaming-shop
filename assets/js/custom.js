
document.addEventListener('DOMContentLoaded', function () {
	jQuery(document).ready(function ($) {

		$('.add-to-cart-btn').on('click', function (e) {
			e.preventDefault();

			let addToCartUrl = this.href;
			let getIdFromUrl = addToCartUrl.split('=');
			let productID = parseInt(getIdFromUrl[1]);

			$.ajax({
				type: "POST",
				url: ajax_object.ajax_url,
				cache: false,
				data: {
					product_id: productID,
					action: 'check_if_product_exist_in_cart'
				},
				success: function (response) {
					$.ajax({
						type: 'POST',
						url: ajax_object.ajax_url,
						cache: false,
						data: {
							product_id: productID,
							action: 'check_if_product_in_stock'
						},
						success: function (response_s) {
							if (response_s.stock_status == true) {
								// alert('added');
								addToCartQuantity(addToCartUrl)
							} else {
								alert("Error happened add-to-cart");
							}
						}
					})
				}
			})
		})


		$(".add-to-cart-with-quantity-btn").on("click", function (e) {
			e.preventDefault();
			let addToCartUrlWithQuantity = $(this).attr('href');
			let productID = parseInt(addToCartUrlWithQuantity.split('=')[1]);
			let quantity = parseInt($(this).closest('form').find("input[name=quantity]").val());

			if (!isNaN(quantity) && quantity !== 0) {
				$.ajax({
					method: "POST",
					url: ajax_object.ajax_url,
					cache: false,
					data: {
						product_id: productID,
						action: 'check_if_product_exist_in_cart'
					},
					success: function (response_s) {
						addToCartUrlWithQuantity += '&quantity=' + quantity;
						$.ajax({
							method: 'POST',
							url: woocommerce_params.ajax_url,
							cache: false,
							data: {
								product_id: productID,
								action: 'check_if_product_in_stock'
							},
							success: function (response_s) {
								if (response_s.stock_status == true) {
									addToCartQuantity(addToCartUrlWithQuantity);
								} else {
									console.log("Not added to cart with quantity. Simple product.");
								}
							}
						})
					}
				});
			}
		});


		function addToCartQuantity(url) {
			$.ajax({
				url: url,
				method: 'POST',
				error: function (response) {
					console.log(response);
				}, success: function (response) {
					console.log('Added single cart')
				}
			})
		}

		///phone number mask. contact us. 
		function maskTelPhone(phone) {
			return `(${phone.slice(0, 3)})-${phone.slice(3, 6)}-${phone.slice(6, 10)}`;
		}
		$('.num-phone').each(function () {
			const phoneNumber = $(this).text().trim();
			$(this).text(maskTelPhone(phoneNumber));
		})

		function getFormData($form) {
			var unindexed_array = $form.serializeArray();
			var indexed_array = {};

			$.map(unindexed_array, function (n, i) {
				indexed_array[n['name']] = n['value'];
			})
			return indexed_array;
		}

		///affiliate page registration
		$("#registration_affiliate_btn").click(function (e) {
			e.preventDefault();
			let formData = $("#affiliate_reg");
			let dataFormArray = getFormData(formData);
			if (dataFormArray.blog_url.length == 0 && dataFormArray.are_you_influencer.length == 0 && dataFormArray.visitors_number.length == 0) {
				console.log(false)
			} else {
				$.ajax({
					method: 'POST',
					url: ajax_object.ajax_url,
					cache: false,
					data: {
						dataFormArray: dataFormArray,
						action: 'registration_affiliate'
					},
					success: function () {
						// consoe.log("Success");
						$("#affiliate_reg_button form button").trigger("click");
					},
					error: function (error) {
						console.log(error);
					}
				});
			}
		});

		///form my-account. login page 
		$(".js-form-validate").submit(function (e) {
			e.preventDefault();

			var $form = $(this);

			var reg_username = $form.find('#reg_username').val();
			var reg_password = $form.find('#reg_password').val();
			var reg_email = $form.find("#reg_email").val();
			var reg_confirm_password = $form.find("#reg_confirm_password").val();
			$form.find('.error__info').text('');
			if (!reg_username) {
				$form.find('#reg_username').siblings('.error__info').text('Please enter your username');
				return;
			} else if (reg_username.length < 5) {
				$form.find('#reg_username').siblings('.error__info').text('Username must be at least 5 characters long')
			}
			if (!reg_password) {
				$form.find('#reg_password').siblings('.error__info').text('Please enter your password');
				return;
			} else if (reg_password.length < 5) {
				$form.find('#reg_password').siblings('.error__info').text('Password must be at least 5 characters long');
			} else if (reg_confirm_password !== reg_password) {
				$form.find('#reg_confirm_password').siblings('.error__info').text('Passwords don\'t match. ');
			}
			if ($form.find('.error__info').text() === '') {
				$.ajax({
					url: ajax_object.ajax_url,
					cache: false,
					type: 'POST',
					data: {
						action: 'reg_form',
						reg_username: reg_username,
						reg_password: reg_password,
						reg_email: reg_email
					},
					error: function (error) {
						console.log(error)
					},
					success: function (response) {
						response = JSON.parse(response);
						if (response.error) {
							$form.find('#reg_username').siblings('.error__info').text(response.error);
							$form.find('#reg_email').siblings('.error__info').text(response.error);
						} else if (response.redirect) {

							window.location.href = response.redirect;
						}
					}
				})
			}
		});


		///form my-account. login page
		$(".validate-form").submit(function (e) {
			e.preventDefault();
			var $form = $(this);

			var login_username = $form.find('#login_username').val();
			var login_password = $form.find('#login_password').val();
			$form.find('.error__info').text('');


			if (!login_username) {
				$form.find('#login_username').siblings('.error__info').text('Please enter your username');
				return;
			} else if (login_username.length < 5) {
				$form.find('#login_username').siblings('.error__info').text('Username must be at least 5 characters long')
			}
			if (!login_password) {
				$form.find('#login_password').siblings('.error__info').text('Please enter your password');
				return;
			} else if (login_password.length < 5) {
				$form.find('#login_password').siblings('.error__info').text('Password must be at least 5 characters long');
			}
			if ($form.find('.error__info').text() === '') {
				$.ajax({
					url: ajax_object.ajax_url,
					cache: false,
					type: 'POST',
					data: {
						action: 'check_user_exists',
						username: login_username
					},
					error: function (error) {
						console.log(error)
					},
					success: function (response) {
						response = JSON.parse(response);
						console.log(response);
						if (response.success) {

							$.ajax({
								url: ajax_object.ajax_url,
								cache: false,
								type: 'POST',
								data: {
									action: 'check_user_credentials',
									username: login_username,
									password: login_password,
								},
								error: function (error) {
									console.log(error)
								},
								success: function (response) {
									response = JSON.parse(response);

									if (response.success) {
										window.location.href = response.redirect;
									} else if (response.error) {
										$form.find('.error__info').text(response.message);
									}
								}
							});
						} else {
							$form.find('.error__info').text(response.message);
						}
					}
				});
			}
		});


		///form my-account
		function checkIfUserExistInSystem(email) {
			const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			if (emailRegex.test(email)) {
				// alert('Success email');
				$.ajax({
					method: 'POST',
					url: ajax_object.ajax_url,
					cache: false,
					data: {
						email: email,
						action: 'check_if_user_exist_in_system'
					},
					success: function (html) {
						if (html == false) {
							alert("Error Email form")
						} else {
							$.ajax({
								method: 'POST',
								url: ajax_object.ajax_url,
								cache: false,
								data: {
									email: email,
									action: 'send_email_for_password_reset'
								},
								success: function () {
									alert("Email Successfully send to you")
								}
							})
						}
					}
				})
			} else {
				alert('Invalid email');
			}
		}

		///form my-account
		$(document).on("click", "#send-lost-password-link", function (e) {
			e.preventDefault();

			let email = document.getElementById('lost-pass-email').value;
			checkIfUserExistInSystem(email);
		});




		$("#enter_new_password_btn").click(function (e) {
			e.preventDefault();
			let formData = $("#enter_new_password_form");

			let dataFormArray = getFormData(formData);
			// console.log(dataFormArray);
			if (dataFormArray.password.length == 0 || dataFormArray.password.length == 0) {
				alert("Empty field")
			} else if (dataFormArray.password.length < 6 || dataFormArray.password.length < 6) {
				alert("The password must be no less than 6 characters");
			} else if (dataFormArray.password != dataFormArray.password) {
				alert("The passwords must be the same");
			} else {
				$.ajax({
					method: 'POST',
					url: ajax_object.ajax_url,
					cache: false,
					data: {
						dataFormArray: dataFormArray,
						action: 'save_new_password'
					},
					error: function (error) {
						console.log(error);
					},
					success: function (success) {
						window.location.href = 'http://localhost/wp-gaming-shop/my-account/edit-account'
					}
				})
			}
		})



		$("#portfolio-posts-btn").on("click", function (e) {
			e.preventDefault();
			var container = ("#portfolio-container").val();
			console.log(container)
			console.log(e.target)
		})


	}) ///custom code jquery ends
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
		if ($('.menu-trigger').length) {
			console.log('menu-trigger');
			$(".menu-trigger").on('click', function () {
				$(this).toggleClass('active');
				$('.header-area .nav').slideToggle(200);
			});
		}
		$(".custom-logo-link").addClass("logo");


		$(".wpfFilterVerScroll").addClass("trending-filter");
		$(".wpfFilterVerScroll").each(function () {
			var input = $(this).find(".wpfLiLabel input:checked");
			if (input.length > 0) {
				input.closest('.wpfLiLabel').addClass("activeWrapper");
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
		// console.log(categoryList);
		categoryList.addEventListener('click', function (event) {
			if (event.target.tagName === 'A' && event.target.parentElement.classList.contains('wpfLiLabel')) {
				event.preventDefault();
				window.location.href = event.target.getAttribute('href');
			}
		});

		if (!hasCategories) {
			label.classList.add('activeWrapper');
		} else {
			label.classList.remove('activeWrapper');
		}


	}, 900)





})(window.jQuery);
