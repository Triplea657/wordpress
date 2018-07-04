<?php
/**
 * Theme Customizer general setting.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function olesya_lite_customize_general_register( $wp_customize ) {

	// Mandor Setting Panel
	$wp_customize->add_panel( 'theme_settings', array(
		'title' 		=> __( 'Theme Settings', 'olesya-lite' ),
		'priority' 		=> 199,
	) );

	$wp_customize->get_setting( 'blogname' )->transport         		= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  		= 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport 		= 'postMessage';
	$wp_customize->get_setting( 'header_image' )->transport 			= 'postMessage';
	$wp_customize->get_setting( 'header_image_data'  )->transport 		= 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport 		= 'postMessage';
	$wp_customize->get_setting( 'background_image' )->transport 		= 'postMessage';
	$wp_customize->get_setting( 'background_repeat' )->transport 		= 'postMessage';
	$wp_customize->get_setting( 'background_position_x' )->transport 	= 'postMessage';
	$wp_customize->get_setting( 'background_attachment' )->transport 	= 'postMessage';

	/** WP */
	$wp_customize->get_section( 'header_image' )->panel 				= 'theme_settings';
	$wp_customize->get_section( 'background_image' )->panel 			= 'theme_settings';
	$wp_customize->get_section( 'colors' )->panel 						= 'theme_settings';

}
add_action( 'customize_register', 'olesya_lite_customize_general_register' );
