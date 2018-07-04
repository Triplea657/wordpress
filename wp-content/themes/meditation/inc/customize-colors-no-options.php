<?php
/**
 * Add new fields to customizer, color schemes.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Meditation 1.0.0
 */
 
function meditation_customize_register_colors( $wp_customize ) {

	$defaults = meditation_get_defaults();
	
	$wp_customize->add_panel( 'custom_colors', array(
		'priority'       => 103,
		'title'          => __( 'Colors', 'meditation' ),
		'description'    => __( 'In this section you can choose color scheme.', 'meditation' ),
	) );
	
	$wp_customize->add_section( 'color_scheme', array(
		'title'          => __( 'Color Scheme', 'meditation' ),
		'description'    => __( 'Select color scheme.', 'meditation' ),
		'priority'       => 1,
		'panel'  => 'custom_colors',
	) );

	$wp_customize->add_setting( 'color_scheme', array(
		'default'        => meditation_get_theme_mod( 'color_scheme' ),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'      => __( 'Color Scheme', 'meditation' ),
		'section'    => 'color_scheme',
		'settings'   => 'color_scheme',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => array(
								0 => __('Red and White', 'meditation'),
								1 => __('Blue and White', 'meditation'),
								2 => __('Orange and Green', 'meditation'),
								3 => __('Orange and Blue', 'meditation'),
								4 => __('Black and Red', 'meditation'),
								5 => __('Black and Green', 'meditation'),
								6 => __('Red and Yellow', 'meditation'),
								7 => __('Red and Dark Content', 'meditation'),
								8 => __('Black Content', 'meditation'),
								9 => __('Orange Content', 'meditation'),
								10 => __('Brown and Orange', 'meditation'),
								11 => __('Gray and White', 'meditation'),
								12 => __('Gray Content', 'meditation'),
								13 => __('Blue and Magenta', 'meditation'),
								14 => __('Dark Blue and White', 'meditation'),
								),
	) );
	
}
add_action( 'customize_register', 'meditation_customize_register_colors' );