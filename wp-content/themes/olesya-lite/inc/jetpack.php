<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Olesya_Lite
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function olesya_lite_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'      		=> 'click',
		'container' 		=> 'main',
		'render'    		=> 'olesya_lite_infinite_scroll_render',
		'footer_widgets'	=> array( 'sidebar-2', 'sidebar-3', 'sidebar-4', ),
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'olesya_lite_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function olesya_lite_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}


/** Remove Jetpack Infinity Scroll CSS */
function olesya_lite_deregister_jetpack_styles(){

	 wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll

}
add_action( 'wp_print_styles', 'olesya_lite_deregister_jetpack_styles' );
