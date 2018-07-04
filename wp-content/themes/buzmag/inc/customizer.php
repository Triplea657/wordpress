<?php
/**
 * buzmag Theme Customizer
 *
 * @package buzmag
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function buzmag_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_section( 'background_image' )->panel = 'buzmag_general_panel';
    $wp_customize->get_section( 'header_image' )->panel = 'buzmag_general_panel';  
    $wp_customize->get_section( 'colors' )->panel = 'buzmag_general_panel';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'buzmag_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'buzmag_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'buzmag_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function buzmag_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function buzmag_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function buzmag_customize_preview_js() {
	wp_enqueue_script( 'buzmag-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'buzmag_customize_preview_js' );
