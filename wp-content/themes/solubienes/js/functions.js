var _scroll_top_time;
var _scroll_top_time_delay = 0;
var _coverflow_init = true;
//hover menu
var _hover_menu_timer = false;
var _active_elem;
var _animate_menu = true;
var _animate_menu_timer = false;


( function( $ ) {

	function numberFormat(str) {
	    str += '';
	    var x = str.split(',');
	    var x1 = x[0];
	    var x2 = x.length > 1 ? ',' + x[1] : '';
	    var rgx = /(\d+)(\d{3})/;
	    while (rgx.test(x1)) {
	        x1 = x1.replace(rgx, '$1' + '.' + '$2');
	    }
	    return x1 + x2;
	}

	function updateSliderValue(val) {
		var $lbl = $('#max_amount_lbl');
		$lbl.text( numberFormat(val) );
		if (val > 0) {
			$lbl.parent().css('visibility', '').siblings('h3').removeClass('low');
		}
		else {
			$lbl.parent().css('visibility', 'hidden').siblings('h3').addClass('low');
		}
	}

	function showHoverMenu($elem) {
		if ($(window).width() < 992) return;
		if (_hover_menu_timer) {
			clearTimeout(_hover_menu_timer);
		}
		if (typeof $elem != 'undefined') {
			var $menu = $('#hover_menu');
			$menu.show()
			if (_animate_menu) $menu.addClass('animated zoomInDown');
			if (!$elem.hasClass('active')) {
				filterMenuByCategory();
				setTimeout(function() {
					$elem.addClass('active');
				},1000);
			}
			_active_elem = $elem;
			_animate_menu = false;
		}
	}

	function hideHoverMenu() {
		_hover_menu_timer = setTimeout(function() {
			$('#hover_menu').fadeOut('fast').removeClass('zoomInDown');
			if (typeof _active_elem != 'undefined') {
				_active_elem.removeClass('active');
			}
			_hover_menu_timer = false;
			if (_animate_menu_timer !== false) clearTimeout(_animate_menu_timer);
			_animate_menu_timer = setTimeout(function() {
				_animate_menu = true;
				_animate_menu_timer = false;
			}, 10000);
		}, 1000);
	}

	function filterMenuByCategory() {
		var $menu = $('#hover_menu');
		var cat = $menu.find('.categories').find('li.active').attr('id');
		$menu.find('.thumb').hide();
		$menu.find('.thumb.' + cat).show();
	}

	$(document).ready(function() {

		//mobile menu
		$('.mobile-menu-btn').click(function() {
			var $m = $('.mobile-menu').eq(0);
			if ($m.hasClass('hidden')) {
				$m.show().removeClass('hidden spaceOutUp').addClass('magictime boingInUp');
			}
			else {
				$m.addClass('perspectiveUp').fadeOut(400).removeClass('boingInUp');
				setTimeout(function() {
					$m.addClass('hidden');
				}, 400);
			}
			return false;
		});

		//login button
		$('.login-btn').mouseenter(function() {
			var $a = $(this).find('i').eq(0);
			$a.addClass('animated bounce');
			setTimeout(function() {
				$a.removeClass('animated bounce');
			}, 5000);
		});

		//header resizing
		$(document).scroll(function() {
			if (_scroll_top_time) return;
			_scroll_top_time = setTimeout(function() {
				var top = $(this).scrollTop();

				var $header = $('header');
				if (top > 0) {
					//make small
					$header.addClass('smaller');
					_scroll_top_time_delay = 1000;
				}
				else {
					//restore to normal
					$header.removeClass('smaller');
					_scroll_top_time_delay = 0;
				}
				_scroll_top_time = 0;
			}, _scroll_top_time_delay);
		});

		
		//3d carousel
		if ($(window).width() > 767) { // for desktop
			new Swiper('.swiper-container', {
		        /*pagination: '.swiper-pagination',*/
		        spaceBetween: 20,
		        nextButton: '.arrow.right',
	        	prevButton: '.arrow.left',
		        effect: 'coverflow',
		        grabCursor: true,
		        centeredSlides: true,
		        slidesPerView: 3, /*'auto'*/
		        coverflow: {
		            rotate: 60,
		            stretch: -40,
		            depth: 100,
		            modifier: 1,
		            slideShadows : true
		        },
		        onReachBeginning: function(swiper) {
		    		setTimeout(function() {
		    			$('.arrow.left').hide();
		    		},400);
		    	},
		    	onReachEnd: function(swiper) {
					setTimeout(function() {
						$('.arrow.right').hide();
					},400);
				},
				onTransitionEnd: function(swiper) {
					if (!_coverflow_init) {
						$('.arrow').show();
					}
					_coverflow_init = false;
				}
		    });
		}
		else { // for mobile
			$('.swiper-container').removeClass('swiper-container')
				.find('.swiper-wrapper').removeClass('swiper-wrapper');
		}

		//hover menu matching heights
		var $hover_menu = $('.hover-menu');
		$hover_menu.find('.row').find('>div').matchHeight();
		$hover_menu.find('.categories').find('li').mouseenter(function() {
			$hover_menu.find('.categories').find('li').removeClass('active');
			$(this).addClass('active');
			filterMenuByCategory();

		});
		$hover_menu.mouseenter(function() {
			showHoverMenu();
		}).mouseleave(function() {
			hideHoverMenu();
		});
		$('.submenu-flotante').mouseleave(function() {
			hideHoverMenu();
		}).hoverIntent(function() {
			showHoverMenu( $(this) );
		});


	    //star spin
	    $('.star').click(function() {
	    	var $star = $(this);
	    	$star.addClass('animated flip');
	    	setTimeout(function() {
	    		$star.removeClass('animated flip');
	    	}, 1000);
	    });


	    //isotope (elements arranging)
	    var $container = $('.box-container');
	    $container.find('.box').css('width', '300px');
	    $container.isotope({
			itemSelector: '.box',
			//layoutMode: 'fitRows'
			masonry: { 
				columnWidth: 350,
				isFitWidth: true
			}
		});


		//slider
		var $slider = $('#budget_slider');
		if ($slider.length) {
			$slider.slider({
				tooltip: 'hide'
			})/*.on('slide', function(slide_e) {
				console.log('sliding');
				updateSliderValue(slide_e.value);
			})*/.on('change', function(slider) {
				updateSliderValue(slider.value.newValue);
			});
		}


		//tooltips
		$('[data-toggle="tooltip"]').tooltip({'placement': 'bottom'});


		//form submiting
		$('.contact-form').find('button[type=submit]').click(function(e) {
			var $frm = $(this).closest('form');
			var $card = $frm.closest('.card');
			$card.addClass('flipped');
			setTimeout(function() {
				$card.find('.sending').addClass('animated flash');
			}, 500);
			setTimeout(function() {
				$card.find('.letter-cover').addClass('active');
				var $sending = $card.find('.sending');
				$sending.removeClass('animated flash').find('.letter').addClass('magictime puffOut');
				$sending.find('h1').addClass('magictime puffOut');
				setTimeout(function() {
					var $sent = $card.find('.sent');
					$sent.removeClass('hidden');
					$sent.find('.icon-ok').addClass('magictime puffIn');
					$sent.find('h1').addClass('magictime puffIn');
				}, 700);
			},3000);
			e.preventDefault();
			return false;
		});
	});

} )( jQuery );