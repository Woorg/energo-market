$(function() {


    // --------------------------------------------------------------------------
	// Svg Polyfill
	// --------------------------------------------------------------------------

	svg4everybody();

	// --------------------------------------------------------------------------
	// Header Sticky
	// --------------------------------------------------------------------------

	function stickyHeader() {

		var scrolling = $(window).scrollTop() || window.pageYOffset;

		if (scrolling > 0 ) {
			$('html').addClass('is-sticky');
		}
		else {
			$('html').removeClass('is-sticky');
		}

	}

	stickyHeader();

	$(window).on('scroll', function(event) {
		stickyHeader();
	});


	// --------------------------------------------------------------------------
	// Header Navigation
	// --------------------------------------------------------------------------

	$(document).on('click', '.header__nav-toggle', function(event) {
		event.preventDefault();

		if ( $('html').is('.is-nav-open') ) {
			$('html').removeClass('is-nav-open');
		} else {
			$('html').addClass('is-nav-open');
		}

	});



	$(document).on('mouseenter', '.header__nav-menu > li:has(.header__nav-dropdown)', function(event) {
		if (matchMedia('only screen and (min-width: 1200px)').matches ) {
			$(this).addClass('is-open');
		}
	}).on('mouseleave', '.header__nav-menu > li', function(event) {
		if (matchMedia('only screen and (min-width: 1200px)').matches ) {
			$(this).removeClass('is-open');
		}
	});

	$(document).on('click', '.header__nav-group-title', function(event) {
		if (matchMedia('only screen and (max-width: 1199px)').matches ) {
			event.preventDefault();

			if ( $(this).closest('.header__nav-group').is('.is-open') ) {
				$(this).closest('.header__nav-group').removeClass('is-open').find('.header__nav-group-menu').slideUp('fast');
			} else {
				$(this).closest('.header__nav-group').addClass('is-open').find('.header__nav-group-menu').slideDown('fast');
			}

		}
	});

	$(window).on('resize', function(){
		if (matchMedia('only screen and (min-width: 1200px)').matches ) {
			$('.header__nav-group').removeClass('is-open').find('.header__nav-group-menu').removeAttr('style');
		}
	});





	// --------------------------------------------------------------------------
	// Swiper
	// --------------------------------------------------------------------------

	var swiperIntro = new Swiper('.js-swiper-intro', {
		slidesPerView: 1,
		spaceBetween: 40,
		watchSlidesVisibility: true,
		watchSlidesProgress: true,
		watchOverflow: true,
		parallax: true,
		pagination: {
	        el: '.js-swiper-intro-pagination',
	        type: 'bullets',
	        clickable: true
	    },
	    navigation: {
			nextEl: '.js-swiper-intro-next',
			prevEl: '.js-swiper-intro-prev',
		}
	});


	$('.js-swiper-reviews').each(function (index, value) {

		var slides = $(this).find('.js-swiper-reviews-slides');
		var thumbs = $(this).find('.js-swiper-reviews-thumbs');

		var prev = $(this).find('.js-swiper-reviews-prev');
		var next = $(this).find('.js-swiper-reviews-next');

		var pagination = $(this).find('.js-swiper-reviews-pagination');

		var reviewsThumbs = new Swiper(thumbs, {
			spaceBetween: 10,
			slidesPerView: 5,
			loop: false,
			freeMode: false,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
		});

		var reviewsSlides = new Swiper(slides, {
			spaceBetween: 40,
			loop: false,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			navigation: {
				nextEl: next,
				prevEl: prev,
			},
			pagination: {
				el: pagination,
				type: 'bullets',
				clickable: true
			},
			thumbs: {
				swiper: reviewsThumbs,
			},
		});


	});



	$('.js-swiper-interests').each(function (index, value) {

		var slides = $(this);

		var prev = $(this).find('.js-swiper-interests-prev');
		var next = $(this).find('.js-swiper-interests-next');
		var pagination = $(this).find('.js-swiper-interests-pagination');


		var interestsSlides = new Swiper(slides, {
			spaceBetween: 20,
			loop: false,
			watchSlidesVisibility: true,
			watchSlidesProgress: true,
			updateOnWindowResize: true,
			observer: true,
	        observeParents: true,
			navigation: {
				nextEl: next,
				prevEl: prev,
			},
			pagination: {
				el: pagination,
				type: 'bullets',
				clickable: true
			}
		});


	});



	var swiperGallery = new Swiper('.js-swiper-gallery', {
		slidesPerView: 1,
		spaceBetween: 30,
		watchSlidesVisibility: true,
		watchSlidesProgress: true,
		watchOverflow: true,
		loop: false,
		parallax: true,
		pagination: {
	        el: '.js-swiper-gallery-pagination',
	        type: 'bullets',
	        clickable: true
	    },
	    navigation: {
			nextEl: '.js-swiper-gallery-next',
			prevEl: '.js-swiper-gallery-prev',
		},
		breakpoints: {
			768: {
				slidesPerView: 3,
			}
		}
	});


	// --------------------------------------------------------------------------
	// Fancybox
	// --------------------------------------------------------------------------


	var fancyboxOptions = {
		infobar : true,
		toolbar : true,
		clickOutside: true,
		touch: false,
		transitionEffect : 'slide',
		lang: 'ru',
		smallBtn: false,
		closeExisting: true,
		hideScrollbar: true,
		preventCaptionOverlap: true,
		autoFocus: false,
		backFocus: false,
		buttons: [
			'close',
		],
		btnTpl: {
			close: '<button data-fancybox-close class="fancybox-btn fancybox-btn-close" title="{{CLOSE}}">' +
					'<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.1875 2.32446L17.3369 0.444458L10 7.89779L2.66313 0.444458L0.8125 2.32446L8.14937 9.77779L0.8125 17.2311L2.66313 19.1111L10 11.6578L17.3369 19.1111L19.1875 17.2311L11.8506 9.77779L19.1875 2.32446Z" fill="currentColor"/></svg>' +
					'</button>',
			arrowLeft:
					'<button data-fancybox-prev class="fancybox-btn fancybox-btn-prev" title="{{PREV}}">' +
					'<svg width="15" height="25" viewBox="0 0 15 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.439 0.609217L0.971521 11.0767C0.159233 11.8932 0.159233 13.212 0.971521 14.0285L11.439 24.496C12.2219 25.168 13.3797 25.168 14.1626 24.496C15.0398 23.7444 15.1423 22.4214 14.3907 21.5442L5.40976 12.5631L14.3908 3.56107C15.2031 2.74456 15.2031 1.42573 14.3908 0.609217C13.5743 -0.203072 12.2554 -0.203072 11.439 0.609217Z" fill="currentColor"/></svg>' +
					'</button>',
		    arrowRight:
					'<button data-fancybox-next class="fancybox-btn fancybox-btn-next" title="{{NEXT}}">' +
					'<svg width="15" height="25" viewBox="0 0 15 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.56101 24.3908L14.0285 13.9233C14.8408 13.1068 14.8408 11.788 14.0285 10.9715L3.56101 0.503985C2.77807 -0.167995 1.62034 -0.167995 0.837403 0.503985C-0.039813 1.25557 -0.142325 2.57862 0.609258 3.45584L9.59024 12.4369L0.609152 21.4389C-0.203136 22.2554 -0.203136 23.5743 0.609152 24.3908C1.42566 25.2031 2.7446 25.2031 3.56101 24.3908Z" fill="currentColor"/></svg>' +
					'</button>',
		},
		i18n: {
			ru: {
				CLOSE: "Закрыть",
				NEXT: "Вперед",
				PREV: "Назад",
				ERROR: "Запрашиваемый контент не может быть загружен. <br/> Пожалуйста, попробуйте позже.",
			}
		},
		beforeShow: function( instance, current ) {

			var compensateCSS = $('.compensate-for-scrollbar').css('margin-right');

	        $('.header').css({
	            'margin-right': compensateCSS
	        });

	        $('body').removeClass('fancybox-type-inline fancybox-type-image fancybox-type-iframe');

	        if ( current.type === "inline" ) {
				$('body').addClass('fancybox-type-inline');
	        }
	        if ( current.type === "image" ) {
				$('body').addClass('fancybox-type-image');
			}
			if ( current.type === "iframe" ) {
				$('body').addClass('fancybox-type-iframe');
			}


		},
	    afterClose: function( instance, current ) {

	    	$('.header').css({
	            'margin-right': 0
			});

	    }
	}

    $('[data-fancybox]').fancybox(fancyboxOptions);

	// --------------------------------------------------------------------------
	// Tabs
	// --------------------------------------------------------------------------

	$(document).on('click', '[data-tabs-btn]', function(event) {

		event.preventDefault();

		var tab = $(this),
			tab_id = $(this).attr('data-tabs-btn');

		$(this).closest('[data-tabs]').find('[data-tabs-btn], [data-tabs-content]').removeClass('is-active');
		$(this).closest('[data-tabs]').find('[data-tabs-btn=' + tab_id + '], [data-tabs-content=' + tab_id + ']').addClass('is-active');

	});


	// --------------------------------------------------------------------------
	// buy
	// --------------------------------------------------------------------------

	$(document).on('click', '.buy__item-title', function(event) {

		event.preventDefault();

		if ( $(this).closest('.buy__item').is('.is-open') ) {
			$(this).closest('.buy__item').removeClass('is-open').find('.buy__item-content').slideUp('fast');

		} else {
			$('.buy__item').removeClass('is-open').find('.buy__item-content').slideUp('fast');
			$(this).closest('.buy__item').addClass('is-open').find('.buy__item-content').slideDown('fast');
		}

	});

	$(document).on('click', function (event) {
		if ( $(event.target).closest('.buy__item').length === 0) {
			$('.buy__item').removeClass('is-active').find('.buy__item-content').slideUp('fast');
		}
	});



	// --------------------------------------------------------------------------
	// Mask
	// --------------------------------------------------------------------------


	$('input[type="tel"]').mask('+7 (000) 000-00-00');

	$('input[type="tel"]').on('focus', function(){
		if ( $(this).val() === '' ) {
			$(this).val('+7 (');
		}
	});


	// --------------------------------------------------------------------------
	// Validate
	// --------------------------------------------------------------------------

	$.validator.addMethod("regexpTel", function (value, element) {
	    return this.optional(element) || /^\+\d \(\d{3}\) \d{3}-\d{2}-\d{2}$/.test(value);
	});

	var validateErrorPlacement = function(error, element) {
		error.addClass('ui-validate');
		error.appendTo(element.parent());
	}

	var validateHighlight = function(element) {
		$(element)
			.parent().addClass("is-error").removeClass('is-success').find('.ui-validate').remove();
	}
	var validateUnhighlight = function(element) {
		$(element)
			.parent().addClass('is-success').removeClass("is-error").find('.ui-validate').remove();
	}

	$('.js-validate').each(function (index, value) {

		$(this).validate({
			errorElement: "span",
			ignore: ":disabled,:hidden",
			highlight: validateHighlight,
    		unhighlight: validateUnhighlight,
			rules: {
				firstname: {
	                required: true
				},
				tel: {
	                required: true,
	                regexpTel: true
				},
				email: {
					required: true,
      				email: true
				},
				message: {
	                required: true
				},
				agree: {
	                required: true
				},

			},
			messages: {
				firstname: 'Вы не ввели имя',
				tel: 'Вы не ввели номер телефона',
				email: 'Вы не ввели email',
				message: 'Вы не ввели сообщение',
				agree: 'Обязательное поле',
			},
			errorPlacement: validateErrorPlacement,
			submitHandler: function(form) {



			}
		});

	});





	// --------------------------------------------------------------------------
	// Loaded
	// --------------------------------------------------------------------------

	$('html').addClass('is-loaded');

	// --------------------------------------------------------------------------
	// Animation
	// --------------------------------------------------------------------------


	ScrollReveal({
	    delay: 0,
	    distance: '0px',
	    duration: 1000,
	    easing: 'ease',
	    interval: 0,
	    opacity: 0,
	    origin: 'bottom',
	    rotate: {
	        x: 0,
	        y: 0,
	        z: 0,
	    },
	    scale: 1,
	    cleanup: false,
	    container: 'html, body',
	    desktop: true,
	    mobile: false,
	    reset: false,
	    useDelay: 'always',
	    // viewFactor: 0.5,
	    viewFactor: 0.3,
	    viewOffset: {
	        top: 0,
	        right: 0,
	        bottom: 0,
	        left: 0,
	    },
	    afterReset: function (el) {},
	    afterReveal: function (el) {},
	    beforeReset: function (el) {},
	    beforeReveal: function (el) {},
	});


	// ----- Intro

	ScrollReveal().reveal('.swiper-slide-active .intro__item-desc > *, .intro > .container-fluid > .intro__item .intro__item-desc', {
		distance: '100px',
		opacity: 0,
		interval: 100
	});
	ScrollReveal().reveal('.swiper-slide-active .intro__item-image, .intro > .container-fluid > .intro__item .intro__item-image', {
		distance: '100px',
		opacity: 0,
		delay: 300
	});

	// ----- Reviews, Interests, Advices, Buy, Works, Save, Need, Cost, For, offer, Benefits, relevant, Activity, Profit, Create, Why, Partners, Request

	ScrollReveal().reveal('.services__title, .services__control, .services__section, .request__title, .request__section, .partners__title, .partners__section, .why__title, .why__section, .create__title, .create__section, .profit__title, .profit__section, .activity__title, .activity__section, .relevant__title, .relevant__section, .benefits__title, .benefits__section, .offer__title, .offer__section, .for__title, .for__section, .reviews__title, .reviews__section, .interests__title, .interests__section, .advices__title, .advices__section, .buy__title, .buy__section, .works__title, .works__section, .save__title, .save__section, .need__title, .need__section, .cost__title, .cost__section', {
		distance: '100px',
		opacity: 0,
		interval: 200
	});

	ScrollReveal().reveal('.services__item, .partners__grid > li, .why .ui-card, .create .ui-variant, .profit .ui-card, .activity .ui-card, .interests__caption > li, .interests__grid > li, .advices__grid > li, .buy__grid > li > .buy__item', {
		distance: '100px',
		opacity: 0,
		interval: 200,
		delay: 300
	});

	// --------------------------------------------------------------------------
	// Numbers
	// --------------------------------------------------------------------------

	if ( $('.geo').length > 0 ) {


		var numbersInit = true;

		function NumberAnimation() {

			var scrolling = $(window).scrollTop() || window.pageYOffset;

			if (numbersInit) {

				if (scrolling > $('.geo').offset().top - $(window).height() / 3 ) {
					$('[data-number]').each(function (index, value) {
						var data = parseInt($(this).data('number'));
						$(this).animateNumber({ number: data },{
								duration: 1000
						});
					});
					numbersInit = false;
				}
			}

		}

		NumberAnimation();

		$(window).on('scroll', function(event) {
			NumberAnimation();
		});

	}



});


