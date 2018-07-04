<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Olesya_Lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function olesya_lite_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}


	if ( get_theme_mod( 'enable_preloader' ) ) {
		$classes[] = 'preloader-enabled';
	}

	if ( get_theme_mod( 'content_layout' ) && !olesya_lite_is_custom_template() ) {
		$classes[] = sanitize_title_with_dashes( get_theme_mod( 'content_layout', 'content-sidebar' ) );
	}

	return $classes;
}
add_filter( 'body_class', 'olesya_lite_body_classes' );

/**
 * Removes hentry class from the array of post classes.
 * Currently, having the class on pages is not correct use of hentry.
 * hentry requires more properties than pages typically have.
 * Core is not likely to remove class because of backward compatibility.
 * See: https://core.trac.wordpress.org/ticket/28482
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function olesya_lite_post_classes( $classes ) {
	if ( 'page' === get_post_type() ) {
		$classes = array_diff( $classes, array( 'hentry' ) );
	}
	$classes[] = 'entry';
	return $classes;
}
add_filter( 'post_class', 'olesya_lite_post_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function olesya_lite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'olesya_lite_pingback_header' );

if ( ! function_exists( 'olesya_lite_hook_more_filters' ) ) :
/**
 * Hook filters to the front-end only.
 */
function olesya_lite_hook_more_filters() {
	if ( is_page_template( 'page-templates/front-page.php' ) || is_home() || is_category() || is_tag() || is_author() || is_date() || is_search() ) {
		add_filter( 'excerpt_length', 'olesya_lite_excerpt_length', 999 );
		add_filter( 'excerpt_more', 'olesya_lite_excerpt_more' );
		add_filter( 'the_content_more_link', 'olesya_lite_excerpt_more', 10, 2 );
		add_filter( 'embed_defaults', 'olesya_lite_default_embed_size' );
		add_filter( 'embed_oembed_html', 'olesya_lite_mixcloud_oembed_parameter', 10, 3 );
	}
	if ( is_singular() ) {
		add_filter( 'embed_defaults', 'olesya_lite_default_embed_size' );
		add_filter( 'embed_oembed_html', 'olesya_lite_mixcloud_oembed_parameter', 10, 3 );
	}
}
endif;
add_action( 'wp', 'olesya_lite_hook_more_filters' );

/**
 * Fix embed height
 * @return [type] [description]
 */
function olesya_lite_default_embed_size(){
	return array( 'width' => 810, 'height' => 180 );
}

/**
 * [olesya_mixcloud_oembed_parameter description]
 * @param  [type] $html [description]
 * @param  [type] $url  [description]
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
function olesya_lite_mixcloud_oembed_parameter( $html, $url, $args ) {
	return str_replace( 'hide_cover=1', 'hide_cover=1&hide_tracklist=1', $html );
}

/**
 * Add (Untitled) for post who doesn't have title
 * @param  string  $title
 * @return string
 */
function olesya_lite_untitled_post( $title ) {

	// Translators: Used as a placeholder for untitled posts on non-singular views.
	if ( ! $title && ! is_singular() && in_the_loop() && ! is_admin() )
		$title = esc_html__( '(Untitled)', 'olesya-lite' );

	return $title;
}
add_filter( 'the_title', 'olesya_lite_untitled_post' );

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function olesya_lite_excerpt_length( $length ) {
	if ( get_theme_mod( 'excerpt_length', 40 ) !== '' ) {
		return (int)get_theme_mod( 'excerpt_length', 40 );
	} else {
		return 40;
	}
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function olesya_lite_excerpt_more() {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span> &rarr;', 'olesya-lite' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}

/**
 * Olesya Menu Arrow
 * @param  [type] $item_output [description]
 * @param  [type] $item        [description]
 * @param  [type] $depth       [description]
 * @param  [type] $args        [description]
 * @return [type]              [description]
 */
function olesya_lite_menu_arrow( $item_output, $item, $depth, $args ) {

	if( in_array( 'menu-item-has-children', $item->classes ) && $args->theme_location == 'primary' ) {
		$arrow = 0 == $depth ? '<span class="fa fa-chevron-down" aria-hidden="true"></span>' : '<span class="fa fa-chevron-right" aria-hidden="true"></span>';
		$item_output = str_replace( '</a>', $arrow . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'olesya_lite_menu_arrow', 10, 4 );
