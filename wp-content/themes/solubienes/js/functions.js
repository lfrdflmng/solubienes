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

	function bringAttentionToField($field) {
		$field.addClass('animated shake');
		setTimeout(function() {
			$field.removeClass('animated shake');
		}, 1000);
	}

	function validEmail(email) {
	    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    return re.test(email);
	}

	$(document).ready(function() {

		$('.gallery').hide();

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
		$('.login-btn').find('.icon-key').click(function() {
			var $a = $(this);//$(this).find('i').eq(0);
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

		$('#hover_view_more').click(function(e) {
			var $link = $('.hover-menu').find('li.active');
			window.location.href = $(this).attr('href') + '/?tipo=' + $link.attr('id');
			e.preventDefault();
			return false;
		});

		//highlights height matching
		$('.box.highlight').find('.desc').matchHeight();

		//blog thumbs height matching
		$('.blog-thumb').find('.content').matchHeight();

		//home highlights
		$('.box.same-height').matchHeight();


	    //star spin
	    $('.star').click(function(e) {
	    	var $star = $(this);
	    	$star.addClass('animated flip');
	    	setTimeout(function() {
	    		$star.removeClass('animated flip');
	    	}, 1000);

	    	//bookmarking (!) outdated. not working
	    	/*if (window.sidebar) { // Mozilla Firefox Bookmark
	    		if (typeof window.sidebar.addPanel != 'undefined') { //not supported by newer Firefox
					window.sidebar.addPanel(location.href,document.title,"");
				}
			}
			else if (window.external) { // IE Favorite
				window.external.AddFavorite(location.href,document.title);
			}
			else if (window.opera && window.print) { // Opera Hotlist
				this.title=document.title;
			}*/

			if (parseInt($star.attr('data-id')) > 0) {
				$('#property_id').val( parseInt($star.attr('data-id')) );
				if (typeof bookmarkPage == 'function') {
					bookmarkPage($star);
				}
			}

			e.preventDefault();
			return false;
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
			var url = $frm.attr('action');

			//required fields
			var $input_name = $frm.find('input[name=nombre]');
			var $input_tel = $frm.find('input[name=telefono]');
			var $input_email = $frm.find('input[name=correo]');

			//check name
			if ($input_name.val().trim().length == 0) {
				bringAttentionToField($input_name);
				return false;
			}
			//check phone / email
			if ($input_tel.val().trim().length == 0 && $input_email.val().trim().length == 0) {
				bringAttentionToField($input_email);
				return false;
			}
			if ($input_email.val().trim().length > 0 && !validEmail($input_email.val())) {
				bringAttentionToField($input_email);
				return false;
			}

			//resets defaults
			var $sending = $card.find('.sending');
			$sending.removeClass('animated flash').find('.letter').removeClass('magictime puffOut');
			$sending.find('h1').removeClass('magictime puffOut');
			$card.find('.letter-cover').removeClass('active');
			$card.find('.sent').addClass('hidden').find('.icon-ok').removeClass('magictime puffIn').find('h1').addClass('magictime puffIn');
			$card.find('.not-sent').addClass('hidden');

			$card.addClass('flipped');

			setTimeout(function() {
				$card.find('.sending').addClass('animated flash');
			}, 500);

			$.ajax({
				method: 'POST',
				url: url,
				data: $frm.serialize(),
				dataType: 'json'
			})
			.done(function( data ) {
				if (data['ok'] == 1) {
					setTimeout(function() {
						$card.find('.letter-cover').addClass('active');
						$sending.removeClass('animated flash').find('.letter').addClass('magictime puffOut');
						$sending.find('h1').addClass('magictime puffOut');
						if (data['sent'] == 1) {
							setTimeout(function() {
								var $sent = $card.find('.sent');
								$sent.removeClass('hidden');
								$sent.find('.icon-ok').addClass('magictime puffIn');
								$sent.find('h1').addClass('magictime puffIn');
							}, 700);
						}
						else {
							setTimeout(function() {
								var $sent = $card.find('.not-sent');
								$sent.removeClass('hidden');
								//$sent.find('.icon-bad').addClass('magictime tinDownIn');
								//$sent.find('h1').addClass('magictime puffIn');
							}, 500);
							setTimeout(function() {
								$card.removeClass('flipped');
							},5000);
						}
					},500);
				}
			});

			e.preventDefault();
			return false;
		});

		$('.contact-form-alt').find('button[type=submit]').click(function(e) {
			var $card = $(this).closest('.contact-form-alt');
			var $frm = $(this).closest('form');
			var url = $frm.attr('action');

			//required fields
			var $input_name = $frm.find('input[name=nombre]');
			var $input_tel = $frm.find('input[name=telefono]');
			//var $input_email = $frm.find('input[name=correo]');

			//check name
			if ($input_name.val().trim().length == 0) {
				bringAttentionToField($input_name);
				return false;
			}
			//check phone / email
			if ($input_tel.val().trim().length == 0 /*&& $input_email.val().trim().length == 0*/) {
				bringAttentionToField($input_tel);
				return false;
			}
			/*if ($input_email.val().trim().length > 0 && !validEmail($input_email.val())) {
				bringAttentionToField($input_email);
				return false;
			}*/

			//resets defaults
			var $sending = $card.find('.sending');
			$sending.removeClass('hidden animated flash').find('.letter').removeClass('magictime puffOut');
			$sending.find('h1').removeClass('magictime puffOut');
			$card.find('.letter-cover').removeClass('active');
			$card.find('.sent').addClass('hidden').find('.icon-ok').removeClass('magictime puffIn').find('h1').addClass('magictime puffIn');
			$card.find('.not-sent').addClass('hidden');

			$card.find('.form-holder').addClass('hidden');

			setTimeout(function() {
				$card.find('.sending').removeClass('hidden').addClass('animated flash');
			}, 100);

			$.ajax({
				method: 'POST',
				url: url,
				data: $frm.serialize(),
				dataType: 'json'
			})
			.done(function( data ) {
				if (data['ok'] == 1) {
					setTimeout(function() {
						$card.find('.letter-cover').addClass('active');
						$sending.removeClass('animated flash').find('.letter').addClass('magictime puffOut');
						$sending.find('h1').addClass('magictime puffOut');
						if (data['sent'] == 1) {
							setTimeout(function() {
								var $sent = $card.find('.sent');
								$sent.removeClass('hidden');
								$sent.find('.icon-ok').addClass('magictime puffIn');
								$sent.find('h1').addClass('magictime puffIn');
							}, 700);
						}
						else {
							setTimeout(function() {
								var $sent = $card.find('.not-sent');
								$sent.removeClass('hidden');
								//$sent.find('.icon-bad').addClass('magictime tinDownIn');
								//$sent.find('h1').addClass('magictime puffIn');
							}, 500);
							setTimeout(function() {
								$card.removeClass('flipped');
							},5000);
						}
					},500);
				}
			});

			e.preventDefault();
			return false;
		});

		//for the consultants page. Repeating same values across forms
		$('input.repeat-value').change(function() {
			var $o = $(this);
			var field = $o.attr('name');
			console.log('input[name=' + field + ']');
			$('input[name=' + field + ']').val( $o.val() );
		});


		//gallery
		$('.gallery').slideDown();


		//login form
		$('.tab-changer').click(function(e) {
			$('.tab_content_login').hide();
			$( $(this).attr('href') ).fadeIn();
			e.preventDefault();
			return false;
		});
	});

} )( jQuery );


//for typeahead
var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substrRegex;
 
    // an array that will be populated with substring matches
    matches = [];
 
    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');
 
    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    jQuery.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        // the typeahead jQuery plugin expects suggestions to a
        // JavaScript object, refer to typeahead docs for more info
        matches.push({ value: str });
      }
    });
 
    cb(matches);
  };
};