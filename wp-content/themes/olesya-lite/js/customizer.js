/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $, api ) {

	// Site title and description.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	api( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

    // Style > Background > Background Image
    api( 'header_image', function( value ) {
        value.bind( function( to ) {
            $('.site-header').css( 'background-image', 'url(' + to +')' );
        } );
    } );

	api( 'background_size', function( value ){
		value.bind( function( to ) {
			$( 'body' ).css( {
					'background-size': to
			} );
		} );
	} );

	api( 'sticky_label', function( value ) {
		value.bind( function( to ) {
			$( '.sticky-label' ).text( to );
		} );
	} );

	api( 'content_layout', function( value ) {
		value.bind( function( to ) {

			var bodyEl 		= $( 'body' ),
				secondaryEl = $( '#secondary' );

			if ( to == 'content-sidebar' ){
				bodyEl.removeClass( 'sidebar-content' );
				bodyEl.removeClass( 'full-width-content' );
				bodyEl.addClass( 'content-sidebar' );
				secondaryEl.css( 'display', 'block' );
			}
			else if ( to == 'sidebar-content' ){
				bodyEl.removeClass( 'content-sidebar' );
				bodyEl.removeClass( 'full-width-content' );
				bodyEl.addClass( 'sidebar-content' );
				secondaryEl.css( 'display', 'block' );
			}
			else if ( to == 'full-width-content' ){
				bodyEl.removeClass( 'content-sidebar' );
				bodyEl.removeClass( 'sidebar-content' );
				bodyEl.addClass( 'full-width-content' );
				secondaryEl.css( 'display', 'none' );
			}

		} );
	} );

	api( 'primary_text_color', function( value ) {
		value.bind( function( to ) {
			$( '#primary-text-color' ).text( 'body,.widget a{color:'+ to +'}' );
		} );
	} );

	api( 'secondary_text_color', function( value ) {
		value.bind( function( to ) {
			$( '#secondary-text-color' ).text( '.cat-links a, .entry-meta a, .entry-footer a, .widget, .site-footer{color:'+ to +'}' );
		} );
	} );

	api( 'primary_color', function( value ){
		value.bind( function( to ) {
			var primaryColorBgColor 	= 'button,input[type="button"],input[type="reset"],input[type="submit"],.button,.sticky-label,.entry-footer a:hover,.entry-footer a:focus,.comment-navigation a:hover,.comment-navigation a:focus,.posts-navigation a:hover,.posts-navigation a:focus,.post-navigation a:hover,.post-navigation a:focus,.comment-body > .reply a,.widget-more-link a:hover,.widget-more-link a:focus,.page-numbers.current',
				primaryColorTextColor 	= 'a, .entry-title a:hover, .entry-title a:focus, .cat-links a:hover, .cat-links a:focus, .entry-meta a:hover, .entry-meta a:focus, a.more-link, .comment-meta a:hover, .comment-meta a:focus, .social-links ul a:hover, .social-links ul a:focus, .widget a:hover, .widget a:focus, .widget-menu-toggle:hover, .widget-menu-toggle:focus, .footer-credits a:hover, .footer-credits a:focus, a.back-to-top:hover, a.back-to-top:focus, .main-navigation a:hover, .main-navigation a:focus, .main-navigation ul > :hover > a, .main-navigation ul > .focus > a, .main-navigation li.current_page_item > a, .main-navigation li.current-menu-item > a, .main-navigation li.current_page_ancestor > a, .main-navigation li.current-menu-ancestor > a, .sub-menu-toggle:hover, .sub-menu-toggle:focus',
				primaryColorBorderColor = '.entry-footer a:hover, .entry-footer a:focus, .widget-more-link a:hover, .widget-more-link a:focus, .widget_tag_cloud a:hover, .widget_tag_cloud a:focus';

			$( '#primary-color' ).text( primaryColorBgColor + '{background-color:'+ to +'}' + primaryColorTextColor + '{color:'+ to +'}' + primaryColorBorderColor + '{border-color:'+ to +'}' );
		} );
	} );

	api( 'secondary_color', function( value ){
		value.bind( function( to ) {
			var secondaryColorBgColor 		= 'button:hover, button:active, button:focus, input[type="button"]:hover, input[type="button"]:active, input[type="button"]:focus, input[type="reset"]:hover, input[type="reset"]:active, input[type="reset"]:focus, input[type="submit"]:hover, input[type="submit"]:active, input[type="submit"]:focus, .button:hover, .button:active, .button:focus, .featured-content a.more-link:hover, .featured-content a.more-link:focus, .comment-body > .reply a:hover, .comment-body > .reply a:focus',
				secondaryColorTextColor 	= 'a:hover, a:focus, .featured-content .cat-links a:hover, .featured-content .cat-links a:focus, .featured-content .entry-title a:hover, .featured-content .entry-title a:focus, .featured-content .entry-meta a:hover, .featured-content .entry-meta a:focus, a.more-link:hover, a.more-link:focus',
				secondaryColorBorderColor 	= '.featured-content a.more-link:hover, .featured-content a.more-link:focus, input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, input[type="file"]:focus, textarea:focus',
				secondaryColorBoxShadow 	= 'input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, input[type="file"]:focus, textarea:focus';
			$( '#secondary-color' ).text( secondaryColorBgColor + '{background-color:'+ to +'}' + secondaryColorTextColor + '{color:'+ to +'}' + secondaryColorBorderColor + '{border-color:'+ to +'}' + secondaryColorBoxShadow + '{box-shadow: 0 0 3px' + to + '}::selection{background-color:'+ to +'}::-moz-selection{background-color:'+ to +'}' );
		} );
	} );

    api( 'preloader_bg_color', function( value ) {
        value.bind( function( to ) {
            $('.site-preloader').css( 'background-color', to );
        } );
    } );

    api( 'preloader_color', function( value ) {
        value.bind( function( to ) {
            $('.sk-wave .sk-rect').css( 'background-color', to );
        } );
    } );

	api( 'show_preloader', function( value ) {
		value.bind( function( to ) {
			if ( to == true ){
				$( '.site-preloader' ).css({ 'display': 'block' });
			} else {
				$( '.site-preloader' ).css({ 'display': 'none' });
			}
		} );
	} );

	api.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {

		// Preloader
		$('.site-preloader').fadeOut(500);
		$('.preloader-enabled').delay(500).css({ 'overflow':'visible' });

		if ( jQuery().slick ) {

			var prev__btn = '<button type="button" data-role="none" class="olesya-slick-prev" aria-label="Previous" tabindex="0" role="button">' + Olesyal10n.slick.prev_arrow + '</button>',
				next__btn = '<button type="button" data-role="none" class="olesya-slick-next" aria-label="Next" tabindex="0" role="button">' + Olesyal10n.slick.next_arrow + '</button>';

			$('.featured-content').not('.slick-initialized').slick({
				infinite: true,
				dots: true,
				adaptiveHeight: true,
				slidesToScroll: 1,
				slidesToShow: Olesyal10n.slick.slides_to_show,
				autoplay: Olesyal10n.slick.autoplay,
				autoplaySpeed: Olesyal10n.slick.autoplay_speed,
				arrows: Olesyal10n.slick.arrow,
	            dots: Olesyal10n.slick.dots,
	            pauseOnHover: Olesyal10n.slick.pause_on_hover,
	            pauseOnDotsHover: Olesyal10n.slick.pause_on_dots_hover,
	            dotsClass: 'olesya-slick-dots',
	            prevArrow: prev__btn,
	            nextArrow: next__btn,
				responsive: [
					{
						breakpoint: 768,
						settings: {
							fade: true,
							slidesToShow: 1
						}
					}
				]
			});

			$( '.instagram-footer ul' ).not('.slick-initialized').slick({
				infinite: true,
				dots: false,
				adaptiveHeight: false,
				slidesToShow: 8,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 5000,
				arrows: false,
				dots: false,
				responsive: [
					{
						breakpoint: 960,
						settings: {
							slidesToShow: 6
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 4
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 2
						}
					}
				]
			});

		}

		$( window ).resize();

		var container, button, menu, links, subMenus, i, len;

		container = document.getElementById( 'site-navigation' );
		if ( ! container ) {
			return;
		}

		button = container.getElementsByTagName( 'button' )[0];
		if ( 'undefined' === typeof button ) {
			return;
		}

		menu = container.getElementsByTagName( 'ul' )[0];

		// Hide menu toggle button if menu is empty and return early.
		if ( 'undefined' === typeof menu ) {
			button.style.display = 'none';
			return;
		}

		menu.setAttribute( 'aria-expanded', 'false' );
		if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
			menu.className += ' nav-menu';
		}

		button.onclick = function() {
			if ( -1 !== container.className.indexOf( 'toggled' ) ) {
				container.className = container.className.replace( ' toggled', '' );
				button.setAttribute( 'aria-expanded', 'false' );
				menu.setAttribute( 'aria-expanded', 'false' );
			} else {
				container.className += ' toggled';
				button.setAttribute( 'aria-expanded', 'true' );
				menu.setAttribute( 'aria-expanded', 'true' );
			}
		};

		// Get all the link elements within the menu.
		links    = menu.getElementsByTagName( 'a' );
		subMenus = menu.getElementsByTagName( 'ul' );

		// Set menu items with submenus to aria-haspopup="true".
		for ( i = 0, len = subMenus.length; i < len; i++ ) {
			subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
		}

		// Each time a menu link is focused or blurred, toggle focus.
		for ( i = 0, len = links.length; i < len; i++ ) {
			links[i].addEventListener( 'focus', toggleFocus, true );
			links[i].addEventListener( 'blur', toggleFocus, true );
		}

		/**
		 * Sets or removes .focus class on an element.
		 */
		function toggleFocus() {
			var self = this;

			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					if ( -1 !== self.className.indexOf( 'focus' ) ) {
						self.className = self.className.replace( ' focus', '' );
					} else {
						self.className += ' focus';
					}
				}

				self = self.parentElement;
			}
		}

		/**
		 * Toggles `focus` class to allow submenu access on tablets.
		 */
		( function( container ) {
			var touchStartFn, i,
				parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

			if ( 'ontouchstart' in window ) {
				touchStartFn = function( e ) {
					var menuItem = this.parentNode, i;

					if ( ! menuItem.classList.contains( 'focus' ) ) {
						e.preventDefault();
						for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
							if ( menuItem === menuItem.parentNode.children[i] ) {
								continue;
							}
							menuItem.parentNode.children[i].classList.remove( 'focus' );
						}
						menuItem.classList.add( 'focus' );
					} else {
						menuItem.classList.remove( 'focus' );
					}
				};

				for ( i = 0; i < parentLink.length; ++i ) {
					parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
				}
			}
		}( container ) );

	});

} )( jQuery, wp.customize );
