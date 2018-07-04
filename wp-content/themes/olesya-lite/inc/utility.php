<?php
/**
 * Helper functions that act independently of the theme templates.
 *
 * @package Olesya
 */

if ( ! function_exists( 'olesya_lite_get_terms' ) ) :
/**
 * Helper function display list of product categories in an array.
 *
 * @return array
 */
function olesya_lite_get_terms( $term_name ){

	if ( ! taxonomy_exists( $term_name ) )
		return array();

	$term_item = array();

	$terms = get_terms( array(
		'taxonomy'		=> $term_name,
		'hide_empty' 	=> true
	) );

	foreach ( $terms as $term ) :
		$term_item[$term->term_id] = $term->name;
	endforeach;

	return $term_item;

}
endif;

/**
 * Retun an array of featured post ID
 * @return string
 */
function olesya_lite_featured_post_id(){

	$featured_id = array();

 	$features = get_posts( array(
		'category'     		=> absint( get_theme_mod( 'slider_cat', 1 ) ),
		'posts_per_page' 	=> absint( get_theme_mod( 'slides_num', 5 ) ),
		'orderby'        	=> get_theme_mod( 'slider_orderby', 'date' ),
		'order'          	=> get_theme_mod( 'slider_order', 'DESC' ),
		'post__not_in' 		=> get_option( 'sticky_posts' ),
 	) );

 	foreach ( $features as $feature ) {
 		$featured_id[] = $feature->ID;
 	}

 	return $featured_id;

}

/**
 * [olesya_lite_do_slider_content description]
 * @return [type] [description]
 */
function olesya_lite_do_slider_content(){
	if ( is_active_sidebar( 'sidebar-5' ) ) {
		echo '<div class="homepage-slider-widget">';
		dynamic_sidebar( 'sidebar-5' );
		echo '</div>';
	} else {
		get_template_part( 'template-parts/content', 'slider' );
	}
}

/** Get content instagram */
function olesya_lite_do_instagram_footer(){
	get_template_part( 'template-parts/instagram', 'footer' );
}

/**
 * [olesya_lite_is_sticky description]
 * @return bool
 */
function olesya_lite_is_sticky(){
	return (bool) is_sticky() && !is_paged() && !is_singular() && !is_archive();
}

/**
 * [olesya_lite_is_custom_template description]
 * @return bool
 */
function olesya_lite_is_custom_template(){
	return (bool) is_page_template( 'page-templates/canvas.php' ) || is_page_template( 'page-templates/full-width-narrow.php' ) || is_page_template( 'page-templates/full-width.php' );
}
