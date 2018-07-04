<?php
/**
 * Add new fields to customizer, create panel 'Other'
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Meditation 1.0.0
 */
 
function meditation_customize_register_other( $wp_customize ) {

	$defaults = meditation_get_defaults();
	
	$wp_customize->add_panel( 'other', array(
		'priority'       =>106,
		'title'          => __( 'Other', 'meditation' ),
		'description'    => __( 'All other settings.', 'meditation' ),
	) );

	$section_priority = 10;
	
//New section in the customizer: Scroll To Top Button
	$wp_customize->add_section( 'meditation_scroll', array(
		'title'          => __( 'Scroll To Top Button', 'meditation' ),
		'priority'       => $section_priority++,
		'panel'  => 'other',
	) );
	
	$wp_customize->add_setting( 'scroll_button', array(
		'default'        => $defaults['scroll_button'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'refresh',
		'sanitize_callback' => 'meditation_sanitize_scroll_button'
	) );
	
	$wp_customize->add_control( 'scroll_button', array(
		'label'      => __( 'How to display the scroll to top button', 'meditation' ),
		'section'    => 'meditation_scroll',
		'settings'   => 'scroll_button',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => array ('none' => __('None', 'meditation'),
								'right' => __('Right', 'meditation'), 
								'left' => __('Left', 'meditation'),
								'center' => __('Center', 'meditation'))
	) );
	
	$wp_customize->add_setting( 'scroll_animate', array(
		'default'        => $defaults['scroll_animate'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_scroll_effect'
	) );
	
	$wp_customize->add_control( 'scroll_animate', array(
		'label'      => __( 'How to animate the scroll to top button', 'meditation' ),
		'section'    => 'meditation_scroll',
		'settings'   => 'scroll_animate',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => array ('none' => __('None', 'meditation'),
								'move' => __('Jump', 'meditation')), 
	) );
	
	$wp_customize->add_setting( 'is_header_on_front_page_only', array(
		'default'        => $defaults['is_header_on_front_page_only'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_header_on_front_page_only', array(
		'label'      => __( 'Display Header Image on the Front Page only', 'meditation' ),
		'section'    => 'header_image',
		'settings'   => 'is_header_on_front_page_only',
		'type'       => 'checkbox',
		'priority'       => 40,
	) );	
	
	$wp_customize->add_setting( 'is_text_on_front_page_only', array(
		'default'        => $defaults['is_text_on_front_page_only'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_text_on_front_page_only', array(
		'label'      => __( 'Display Header Text on the Front Page only', 'meditation' ),
		'section'    => 'header_image',
		'settings'   => 'is_text_on_front_page_only',
		'type'       => 'checkbox',
		'priority'       => 41,
	) );
	
//New section in customizer: Footer
	$wp_customize->add_section( 'footer_text', array(
		'title'          => __( 'Footer text', 'meditation' ),
		'priority'       => $section_priority++,
		'panel'  => 'other',
	) );
	
//Footer Text
	$wp_customize->add_setting( 'footer_text', array(
		'default'        => $defaults['footer_text'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_kses'
	) );
	$wp_customize->add_control( 'footer_text', array(
		'label'      => __('Text', 'meditation'),
		'section'    => 'footer_text',
		'settings'   => 'footer_text',
		'priority'   => '1',
	));
}
add_action( 'customize_register', 'meditation_customize_register_other' );