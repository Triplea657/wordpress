/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    isIe     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();


/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
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
} )();


/**
 * Sub Menu toggle
 */
( function( $ ) {

	$(document).ready(function(){

		$( '.main-navigation .sub-menu' ).before( '<button class="sub-menu-toggle" aria-controls="sub-menu" role="button" aria-expanded="false"></button>' );

		// Show/hide the navigation
		$( '.sub-menu-toggle' ).on( 'click', function( e ) {

			e.preventDefault();

			var $this = $( this );
			$this.attr( 'aria-expanded', function( index, value ) {
				return 'false' === value ? 'true' : 'false';
			});

			// Add class to toggled menu
			$this.toggleClass( 'toggled' );
			$this.next( '.sub-menu' ).slideToggle( 0 );

		});

		$( '.widget_nav_menu .sub-menu' ).before( '<button class="widget-menu-toggle" aria-controls="sub-menu" role="button" aria-expanded="false"></button>' );

		// Show/hide the navigation
		$( '.widget-menu-toggle' ).on( 'click', function( e ) {

			e.preventDefault();

			var $this = $( this );
			$this.attr( 'aria-expanded', function( index, value ) {
				return 'false' === value ? 'true' : 'false';
			});

			// Add class to toggled menu
			$this.toggleClass( 'toggled' );
			$this.next( '.sub-menu' ).slideToggle( 0 );

		});

	});

})( jQuery );

/**
 * Jquery plugins configuration
 */
( function( $ ){


	function slick__featured_contents(){

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
					breakpoint: 788,
					settings: {
						fade: true,
						slidesToShow: 1
					}
				}
			]
		});

	}

	function slick__instagram_footer() {

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

	function run_fitVids(){
		var vidElement = $( '#page' );
		vidElement.fitVids({
			customSelector: "iframe[src^='https://videopress.com']"
		});
	}

    function do__equalHeight( parentEl, childEl ) {

		$( parentEl ).each(function(){

	        var highestBox = 0;

	        $(this).find( childEl ).each(function(){
	            $(this).css('height','auto');
	            if($(this).height() > highestBox){
	                highestBox = $(this).height();
	            }
	        });

	        $(this).find( childEl ).height(highestBox);

	    });

    }

	$(document).ready(function(){

		// Preloader
		$(window).on( 'load', function() {
			$('.site-preloader').fadeOut(500);
			$('.preloader-enabled').delay(500).css({ 'overflow':'visible' });
		});

		// Wrap table with div
		$( 'table' ).wrap( '<div class="table-responsive"></div>' );

		// Slick slider option
		if ( jQuery().slick ) {
			slick__featured_contents();
			slick__instagram_footer();
		}

		// Run stickit
		$( '.main-navigation' ).stickit({
			screenMinWidth: 782,
			scope: StickScope.Document,
			zIndex: 5
		});

		//  Smooth scroll
		$( 'a.back-to-top' ).smoothScroll({
			afterScroll: function(options) {
			    var $tgt = $(options.scrollTarget);
			    $tgt.attr('tabIndex', '-1');
			    $tgt[0].focus();
			}
		});

		run_fitVids();

	});

	$( document.body ).on( 'post-load', function () {
		run_fitVids();
		slick__entry_gallery();
	});

    $( window ).load(function() {
		do__equalHeight( '.nav-links', 'div a' );
		do__equalHeight( '.featured-content', '.entry' );
	});

    $( window ).resize(function() {
		do__equalHeight( '.nav-links', 'div a' );
		do__equalHeight( '.featured-content', '.entry' );
	});

})( jQuery );
