/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
    
    wp.customize( 'buzmag_news_slide_news_title', function( value ) {
		value.bind( function( to ) {
			$( '.title-slide span' ).text( to );
		} );
	} );
    
    wp.customize( 'buzmag_theme_color', function( value ) {
		value.bind( function( theme_color ) {
			if(theme_color){
    		  var borderColor = '<style>' +
                  '#bm-go-top, .tnp-widget-minimal input.tnp-submit, .tnp-widget input.tnp-submit, .main-news-slide .title-slide, nav.pagination a:hover, nav.pagination a, .pagination .nav-links span, .widget input.search-submit, nav.navigation a, .main-navigation, .bm-top-header{background:'+theme_color+';}'+
                  'a.read-more, h1.entry-title a:hover, h2.entry-title a:hover, .footer-copyright a:hover, .widget ul li a:hover, .widget ul li:before, body.search .no-results input.search-submit, .error404 .not-found input.search-submit, span.page-numbers.current, nav.pagination a:hover, div#buzmag-breadcrumb a, div#buzmag-breadcrumb span, .news-slide-wrap .owl-nav .owl-prev:hover i, .news-slide-wrap .owl-nav .owl-next:hover i, .news-slide-wrap .content-news a, .main-slider-wrap.layout-1 .secondary-slider-wrap .owl-prev:hover, .main-slider-wrap.layout-1 .secondary-slider-wrap .owl-next:hover, .main-slider-wrap.layout-2 .owl-dots .owl-dot.active, .main-slider-wrap.layout-3 .owl-dots .owl-dot.active, .main-slider-wrap.layout-2 .owl-dots .owl-dot.active, .main-slider-wrap.layout-3 .owl-dots .owl-dot.active, .main-slider-wrap.layout-2 .owl-dots .owl-dot:hover, .main-slider-wrap.layout-3 .owl-dots .owl-dot:hover, .bm-home-sidebar .widget_buzmag_blog_category_widget .owl-prev, .bm-home-sidebar .widget_buzmag_blog_category_widget .owl-next, .widget_buzmag_post_slide_widget .owl-prev, .widget_buzmag_post_slide_widget .owl-next, .titles-port div:hover, .filter.active, .loop-posts-blog-recent .wrap-meta-title h4:hover, .entry-meta span:hover, .entry-meta a:hover, .bm-search input.search-submit, .error-404.not-found h1.page-title, .no-results.not-found h1.page-title, .widget_buzmag_blog_widget .blog-content-title a:hover, .blog-content-title a h3, .widget_buzmag_blog_category_widget .bm-main-cat-post .bm-cat-count-1 .blog-content-title a h3:hover, .widget_buzmag_blog_category_widget .bm-main-cat-post .layout-2 .blog-content-title a h3:hover{color:'+theme_color+';}'+
                  'nav.navigation a, h2.widget-title, .widget input.search-field:focus, .bm-search input.search-field:focus, .bm-search input.search-submit:focus, .widget input.search-submit:focus, body.search .no-results input.search-field:focus, body.search .no-results input.search-submit:focus, .error404 .not-found input.search-submit:focus, .error404 .not-found input.search-field:focus, nav.pagination a, .pagination .nav-links span, nav.pagination a:hover, .news-slide-wrap .owl-nav .owl-prev:hover, .news-slide-wrap .owl-nav .owl-next:hover, .main-slider-wrap.layout-1 .secondary-slider-wrap .owl-prev:hover, .main-slider-wrap.layout-1 .secondary-slider-wrap .owl-next:hover, .widget_buzmag_blog_widget h2.widget-title, .widget_buzmag_post_slide_widget h2.widget-title, .widget_buzmag_masonry_post_widget h2.widget-title, .widget_buzmag_blog_category_widget .bm-second-wrap-cat .title-cat-main h2, .main-news-slide{border-color:'+theme_color+';}'+
                  '.tnp-widget-minimal input.tnp-submit{background:'+theme_color+' !important;}'+
                  '</style>';
                  $('#dynamic-css').html(borderColor);
              }
		} );
	} );
    

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );
