<?php
/**
 * Add new fields to customizer, create panel 'Animation'
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Meditation 1.0.0
 */
 
function meditation_customize_register_animate( $wp_customize ) {

	$defaults = meditation_get_defaults();
	
	$wp_customize->add_panel( 'animate', array(
		'priority'       =>101,
		'title'          => __( 'Animation', 'meditation' ),
		'description'    => __( 'Animation settings.', 'meditation' ),
	) );
	
//New section in customizer: Header
	$wp_customize->add_section( 'meditation_header_anim', array(
		'title'          => __( 'Header', 'meditation' ),
		'priority'       => 10,
		'panel'  => 'animate',
	) );
	
//New setting in Header section: Header Effect
	$wp_customize->add_setting( 'header_effect_class', array(
		'default'        => $defaults['header_effect_class'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'header_effect_class', array(
		'label'   => __( 'Header Effect', 'meditation' ),
		'section' => 'meditation_header_anim',
		'settings'   => 'header_effect_class',
		'type'       => 'select',
		'priority'   => 10,
		'choices'	 => array ('0' => __('None', 'meditation'),
								'1' => __('1. Top Move', 'meditation'), 
								'2' => __('2. 3d Center Cascade', 'meditation'),
								'3' => __('3. Hidden Image', 'meditation'),
								'4' => __('4. Hidden Image and Move', 'meditation'),
								'5' => __('5. Hidden Image and Zoom', 'meditation'),
								'6' => __('6. Type Text', 'meditation'),
								'7' => __('7. 3d Y Move', 'meditation'),
								'8' => __('8. 3d X Move', 'meditation'),
								'9' => __('9. 3d XY Move', 'meditation'),
								'10' => __('10. 3d Cascade Move', 'meditation'),
								'11' => __('11. 3d Cascade Bottom Move', 'meditation'),
								'12' => __('12. 3d Carusel', 'meditation'),
								'13' => __('13. Left and Right Move', 'meditation'),
								'14' => __('14. Corner Move', 'meditation'),
								'15' => __('15. 3d Move', 'meditation'),)
	) );	
	
//Restart header animation
	$wp_customize->add_setting( 'is_restart_header', array(
		'default'        => $defaults['is_restart_header'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_restart_header', array(
		'label'      => __( 'Restart Animation', 'meditation' ),
		'section'    => 'meditation_header_anim',
		'settings'   => 'is_restart_header',
		'type'       => 'checkbox',
		'priority'   => 11,
		'panel'  => 'animate',
	) );
	
	$wp_customize->add_panel( 'menu', array(
		'priority'       =>110,
		'title'          => __( 'Menu', 'meditation' ),
		'description'    => __( 'Sticky Menu.', 'meditation' ),
	) );
//New section in customizer: Sticky menu
	$wp_customize->add_section( 'sticky_menu', array(
		'title'          => __( 'Sticky Menu', 'meditation' ),
		'priority'       => 100,
		'panel'  => 'animate',
	) );
	$wp_customize->add_setting( 'is_sticky_first_menu', array(
		'default'        => $defaults['is_sticky_first_menu'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_sticky_first_menu', array(
		'label'      => __( 'Sticky Menu', 'meditation' ),
		'section'    => 'sticky_menu',
		'settings'   => 'is_sticky_first_menu',
		'type'       => 'checkbox',
		'priority'   => 21,
	) );
//New setting in Menu section: Menu Effect
	$wp_customize->add_setting( 'menu_effect_class', array(
		'default'        => $defaults['menu_effect_class'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'menu_effect_class', array(
		'label'   => __( 'Menu Effect', 'meditation' ),
		'section' => 'sticky_menu',
		'settings'   => 'menu_effect_class',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => array ( '1' => __('1. Simple', 'meditation'), 
								'2' => __('2. Type Text', 'meditation'),
								'3' => __('3. Top Move', 'meditation'),
								'4' => __('4. Appear', 'meditation'),
								'5' => __('5. Side Move', 'meditation'),
								'6' => __('6. Corner Move', 'meditation'),
								'7' => __('7. Appear and Move', 'meditation'),
								'8' => __('8. 2 Horisontal Pieces', 'meditation'),
								'9' => __('9. Appear and Scale', 'meditation'),
								'10' => __('10. Appear and Right Move', 'meditation'),
								'11' => __('11. Appear and Rotate', 'meditation'),
								'12' => __('12. Rotate and Type Text', 'meditation'),
								'13' => __('13. 2 Pieces', 'meditation'),
								'14' => __('14. 2 Pieces Move', 'meditation'),
								'15' => __('15. Appear from Center', 'meditation'),)
	) );
//New section in customizer: Blog
	$wp_customize->add_section( 'meditation_blog_anim', array(
		'title'          => __( 'Blog', 'meditation' ),
		'priority'       => 30,
		'panel'  => 'animate',
	) );
	
//New setting in Header section: Blog Effect
	$wp_customize->add_setting( 'blog_effect_class', array(
		'default'        => $defaults['blog_effect_class'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'Blog_effect_class', array(
		'label'   => __( 'Blog Effect', 'meditation' ),
		'section' => 'meditation_blog_anim',
		'settings'   => 'blog_effect_class',
		'type'       => 'select',
		'priority'   => 10,
		'choices'	 => array ('0' => __('None', 'meditation'),
								'1' => __('1. Appear from Right', 'meditation'), 
								'2' => __('2. Appear from the Bottom', 'meditation'),
								'3' => __('3. Step', 'meditation'),
								'4' => __('4. Open', 'meditation'),
								'5' => __('5. Border and Bottom Move', 'meditation'),
								'6' => __('6. Border and 3D Move', 'meditation'),
								'7' => __('7. A Fall', 'meditation'),
								'8' => __('8. Border and Top Move (Fast)', 'meditation'),
								'9' => __('9. Left Move', 'meditation'),
								'10' => __('10. Step Appear 1', 'meditation'),
								'11' => __('11. Step Appear 2', 'meditation'),
								'12' => __('12. Rotate Border', 'meditation'),
								'13' => __('13. Border and Corner Move', 'meditation'),
								'14' => __('14. Border and Rotate', 'meditation'),
								'15' => __('15. Border and Step', 'meditation'),)
	) );	
	
//Restart blog animation
	$wp_customize->add_setting( 'is_restart_blog', array(
		'default'        => $defaults['is_restart_blog'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_restart_blog', array(
		'label'      => __( 'Restart Animation', 'meditation' ),
		'section'    => 'meditation_blog_anim',
		'settings'   => 'is_restart_blog',
		'type'       => 'checkbox',
		'priority'   => 11,
		'panel'  => 'animate',
	) );
	
//New section in customizer: Blog
	$wp_customize->add_section( 'meditation_sidebar_anim', array(
		'title'          => __( 'Sidebar', 'meditation' ),
		'priority'       => 31,
		'panel'  => 'animate',
	) );
	
//New setting in Header section: Sidebar Effect
	$wp_customize->add_setting( 'sidebar_effect_class', array(
		'default'        => $defaults['sidebar_effect_class'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'sidebar_effect_class', array(
		'label'   => __( 'Sidebar Effect', 'meditation' ),
		'section' => 'meditation_sidebar_anim',
		'settings'   => 'sidebar_effect_class',
		'type'       => 'select',
		'priority'   => 10,
		'choices'	 => array ('0' => __('None', 'meditation'),
								'1' => __('1. Simple', 'meditation'), 
								'2' => __('2. Bottom Move', 'meditation'),
								'3' => __('3. Corner Move', 'meditation'),
								'4' => __('4. Right Side Move', 'meditation'),
								'5' => __('5. Left Side Move', 'meditation'),
								'6' => __('6. Left and Right Move', 'meditation'),
								'7' => __('7. Title Bottom Move', 'meditation'),
								'8' => __('8. Title and Content Bottom Move', 'meditation'),
								'9' => __('9. Top and Bottom Move', 'meditation'),
								'10' => __('10. Top Title and Content Move', 'meditation'),
								'11' => __('11. Bottom and Left Move', 'meditation'),
								'12' => __('12. Left and Top Move', 'meditation'),
								'13' => __('13. Rotate and Move', 'meditation'),
								'14' => __('14. From Center', 'meditation'),
								'15' => __('15. Move and Rotate', 'meditation'),)
	) );	
	
//Restart blog animation
	$wp_customize->add_setting( 'is_restart_sidebar', array(
		'default'        => $defaults['is_restart_sidebar'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_restart_sidebar', array(
		'label'      => __( 'Restart Animation', 'meditation' ),
		'section'    => 'meditation_sidebar_anim',
		'settings'   => 'is_restart_sidebar',
		'type'       => 'checkbox',
		'priority'   => 11,
		'panel'  => 'animate',
	) );
//New section in customizer: Fixed Widget
	$wp_customize->add_section( 'fixed_widget', array(
		'title'          => __( 'Fixed Widget', 'meditation' ),
		'description'          => __( 'Fixed widget will appear on the screen after last widget in the sidebar. In this section you can set number of the widget to be fixed on the screen.', 'meditation' ),
		'priority'       => 40,
		'panel'  => 'animate',
	) );

//Fixed Widget in the first column
	$wp_customize->add_setting( 'fixed_1_widget', array(
		'default'        => $defaults['fixed_1_widget'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'fixed_1_widget', array(
		'label'      => __( 'Stick widget in the left sidebar', 'meditation' ),
		'section'    => 'fixed_widget',
		'settings'   => 'fixed_1_widget',
		'type'       => 'checkbox',
		'priority'   => 1,
	) );
//Fixed Widegat num in the first column
	$wp_customize->add_setting( 'fixed_1_widget_num', array(
		'default'        => $defaults['fixed_1_widget_num'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'fixed_1_widget_num', array(
		'label'      => __( 'Widget position in the first column (any number from 1 to n)', 'meditation' ),
		'section'    => 'fixed_widget',
		'settings'   => 'fixed_1_widget_num',
		'type'       => 'number',
		'priority'   => 2,
	) );
//Fixed Widget in the second column
	$wp_customize->add_setting( 'fixed_2_widget', array(
		'default'        => $defaults['fixed_2_widget'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'fixed_2_widget', array(
		'label'      => __( 'Stick widget in the right sidebar', 'meditation' ),
		'section'    => 'fixed_widget',
		'settings'   => 'fixed_2_widget',
		'type'       => 'checkbox',
		'priority'   => 11,
	) );
//Fixed Widegat num in the first column
	$wp_customize->add_setting( 'fixed_2_widget_num', array(
		'default'        => $defaults['fixed_2_widget_num'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );
	$wp_customize->add_control( 'fixed_2_widget_num', array(
		'label'      => __( 'Widget position in the second column (any number from 1 to n)', 'meditation' ),
		'section'    => 'fixed_widget',
		'settings'   => 'fixed_2_widget_num',
		'type'       => 'number',
		'priority'   => 12,
	) );
}
add_action( 'customize_register', 'meditation_customize_register_animate' );