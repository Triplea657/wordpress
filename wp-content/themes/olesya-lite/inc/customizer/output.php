<?php
/**
 * Customizer Output
 *
 * @package  Olesya_lite
 */

/**
 * Olesya Pro custom logo, header and background
 */
function olesya_lite_custom_logo_header_and_background(){

	/** Enable support for custom logo */
	add_theme_support( 'custom-logo', array(
		'width'       => 400,
		'height'      => 100,
		'flex-width'  => true,
		'flex-height' => false,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/** Custom Header */
	add_theme_support( 'custom-header', apply_filters( 'olesya_lite_custom_header_args', array(
		'width'       			=> 1600,
		'height'      			=> 1600,
		'default-image'          => '',
		'default-text-color'     => '455a64',
		'flex-width'             => true,
		'flex-height'            => true,
	) ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'olesya_lite_custom_background_args', array(
		'default-color' 		=> 'eceff1',
		'default-repeat'        => 'no-repeat',
		'default-attachment'    => 'scroll',
	) ) );

}
add_action( 'after_setup_theme', 'olesya_lite_custom_logo_header_and_background' );


/**
 * Print inline style
 * @uses olesya_lite_cssmin( $css );
 * @return string
 */
function olesya_lite_add_inline_style(){

	$primary_color_background_color = '
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.button,
		.sticky-label,
		.entry-footer a:hover,
		.entry-footer a:focus,
		.comment-navigation a:hover,
		.comment-navigation a:focus,
		.posts-navigation a:hover,
		.posts-navigation a:focus,
		.post-navigation a:hover,
		.post-navigation a:focus,
		.comment-body > .reply a,
		.widget-more-link a:hover,
		.widget-more-link a:focus,
		.page-numbers.current
	';

	$primary_color_text_color = '
		a, .entry-title a:hover,
		.entry-title a:focus,
		.cat-links a:hover,
		.cat-links a:focus,
		.entry-meta a:hover,
		.entry-meta a:focus,
		a.more-link,
		.comment-meta a:hover,
		.comment-meta a:focus,
		.social-links ul a:hover,
		.social-links ul a:focus,
		.widget a:hover,
		.widget a:focus,
		.widget-menu-toggle:hover,
		.widget-menu-toggle:focus,
		.footer-credits a:hover,
		.footer-credits a:focus,
		a.back-to-top:hover,
		a.back-to-top:focus,
		.main-navigation a:hover,
		.main-navigation a:focus,
		.main-navigation ul > :hover > a,
		.main-navigation ul > .focus > a,
		.main-navigation li.current_page_item > a,
		.main-navigation li.current-menu-item > a,
		.main-navigation li.current_page_ancestor > a,
		.main-navigation li.current-menu-ancestor > a,
		.sub-menu-toggle:hover,
		.sub-menu-toggle:focus
	';

	$primary_color_border_color = '
		.entry-footer a:hover,
		.entry-footer a:focus,
		.widget-more-link a:hover,
		.widget-more-link a:focus,
		.widget_tag_cloud a:hover,
		.widget_tag_cloud a:focus
	';

	$secondary_color_background_color = '
		button:hover,
		button:active,
		button:focus,
		input[type="button"]:hover,
		input[type="button"]:active,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:active,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:active,
		input[type="submit"]:focus,
		.button:hover,
		.button:active,
		.button:focus,
		.featured-content a.more-link:hover,
		.featured-content a.more-link:focus,
		.comment-body > .reply a:hover,
		.comment-body > .reply a:focus,
		.page-numbers:hover:not(.current),
		.page-numbers:focus:not(.current)
	';

	$secondary_color_text_color = '
		a:hover,
		a:focus,
		.featured-content .cat-links a:hover,
		.featured-content .cat-links a:focus,
		.featured-content .entry-title a:hover,
		.featured-content .entry-title a:focus,
		.featured-content .entry-meta a:hover,
		.featured-content .entry-meta a:focus,
		a.more-link:hover,
		a.more-link:focus
	';

	$secondary_color_border_color = '
		.featured-content a.more-link:hover,
		.featured-content a.more-link:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="range"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="week"]:focus,
		input[type="time"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="color"]:focus,
		input[type="file"]:focus,
		textarea:focus
	';

	$secondary_color_box_shadow = '
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="range"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="week"]:focus,
		input[type="time"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="color"]:focus,
		input[type="file"]:focus,
		textarea:focus
	';

	$css= '';

	if ( get_header_image() ) {
		$css .= '.site-header {background-image:url("'. esc_url( get_header_image() ) .'")}';
	}

    $primary_text_color = get_theme_mod( 'primary_text_color' );
    if ( get_theme_mod( 'primary_text_color' ) ) {
    	$css .= ' body,.widget a {color:'. esc_attr( $primary_text_color ) .'}';
    }

    $secondary_text_color = get_theme_mod( 'secondary_text_color' );
    if ( $secondary_text_color ) {
    	$css .= '.cat-links a, .entry-meta a, .entry-footer a, .widget, .site-footer{color:'. esc_attr( $secondary_text_color ) .'}';
    }

    $primary_color = get_theme_mod( 'primary_color' );
    if ( $primary_color ) {
    	$css .= sprintf( '%s{ background-color: %s }', $primary_color_background_color, esc_attr( $primary_color ) );
    	$css .= sprintf( '%s{ color: %s }', $primary_color_text_color, esc_attr( $primary_color ) );
    	$css .= sprintf( '%s{ border-color: %s }', $primary_color_border_color, esc_attr( $primary_color ) );
    	$css .= '@media(min-width: 782px){.main-navigation ul.menu .sub-menu a:hover, .main-navigation ul.menu .sub-menu a:focus{background-color:'. esc_attr( $primary_color ) .'}}';
    }

    $secondary_color = get_theme_mod( 'secondary_color' );
    if ( $secondary_color ) {
    	$css .= sprintf( '%s{ background-color: %s }', $secondary_color_background_color, esc_attr( $secondary_color ) );
    	$css .= sprintf( '%s{ color: %s }', $secondary_color_text_color, esc_attr( $secondary_color ) );
    	$css .= sprintf( '%s{ border-color: %s }', $secondary_color_border_color, esc_attr( $secondary_color ) );
    	$css .= sprintf( '%s{ box-shadow: 0 0 3px %s }', $secondary_color_border_color, esc_attr( $secondary_color ) );
    	$css .= sprintf( '::selection{background-color:%1$s}::-moz-selection{background-color:%1$s}', esc_attr( $secondary_color ) );
    }

    $css = str_replace( array( "\n", "\t", "\r" ), '', $css );

	if ( ! empty( $css ) ) {
		wp_add_inline_style( 'olesya-lite-modules-style', apply_filters( 'olesya_lite_inline_style', trim( $css ) ) );
	}

}
add_action( 'wp_enqueue_scripts', 'olesya_lite_add_inline_style' );

/**
 * [olesya_lite_editor_style description]
 * @param  [type] $mceInit [description]
 * @return [type]          [description]
 */
function olesya_lite_editor_style( $mceInit ) {

	$primary_text_color 	= get_theme_mod( 'primary_text_color', '#455a64' );
	$secondary_text_color 	= get_theme_mod( 'secondary_text_color', '#90a4ae' );
	$primary_color 			= get_theme_mod( 'primary_color', '#f06292' );
	$secondary_color 		= get_theme_mod( 'secondary_color', '#f7a8c2' );

	$styles = '';
	$styles .= '.mce-content-body{ color: ' . esc_attr( $primary_text_color ) . '; }';
	$styles .= '.mce-content-body a{ color: ' . esc_attr( $primary_color ) . '; }';
	$styles .= '.mce-content-body a:hover, .mce-content-body a:focus{ color: ' . esc_attr( $secondary_color ) . '; }';
	$styles .= '.mce-content-body ::selection{ background-color: ' . esc_attr( $secondary_color ) . '; }';
	$styles .= '.mce-content-body ::-mozselection{ background-color: ' . esc_attr( $secondary_color ) . '; }';

	if ( !isset( $mceInit['content_style'] ) ) {
		$mceInit['content_style'] = trim( $styles ) . ' ';
	} else {
		$mceInit['content_style'] .= ' ' . trim( $styles ) . ' ';
	}

	return $mceInit;

}
add_filter( 'tiny_mce_before_init', 'olesya_lite_editor_style' );

/**
 * [olesya_lite_pro_localize_script description]
 * @return [type] [description]
 */
function olesya_lite_localize_script(){

	$output = array(
		'slick'	=> array (
			'slides_to_show' 		=> (int)get_theme_mod( 'slides_to_show', 3 ),
			'autoplay'				=> (bool)get_theme_mod( 'autoplay', true ),
			'autoplay_speed'		=> (int)get_theme_mod( 'autoplay_speed', 5000 ),
			'arrow'					=> (bool)get_theme_mod( 'arrow', true ),
			'dots'					=> (bool)get_theme_mod( 'dots', true ),
			'pause_on_hover'		=> (bool)get_theme_mod( 'pause_on_hover', true ),
			'pause_on_dots_hover'	=> (bool)get_theme_mod( 'pause_on_dots_hover', true ),
			'prev_arrow'			=> __( 'Previous', 'olesya-lite' ),
			'next_arrow'			=> __( 'Next', 'olesya-lite' ),
		)
	);
	wp_localize_script( 'olesya-lite', 'Olesyal10n', apply_filters( 'olesya_lite_slider_args', $output ) );

}
add_action( 'wp_enqueue_scripts', 'olesya_lite_localize_script' );

/**
 * [olesya_customizer_style_placeholder description]
 * @return [type] [description]
 */
function olesya_customizer_style_placeholder(){
	if ( is_customize_preview() ) {
		echo '<style id="primary-text-color"></style>';
		echo '<style id="secondary-text-color"></style>';
		echo '<style id="primary-color"></style>';
		echo '<style id="secondary-color"></style>';
	}
}
add_action( 'wp_head', 'olesya_customizer_style_placeholder', 15 );
