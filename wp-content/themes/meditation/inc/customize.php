<?php
/**
 * Register postMessage support for site title and description for the Customizer ans add new panels.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Meditation 1.0.0
 */
 
function meditation_customize_register( $wp_customize ) {
	
	$defaults = meditation_get_defaults();
	
//Theme options
	$wp_customize->add_section( 'meditation_options', array(
		'priority'       => 200,
		'title'          => __( 'Options', 'meditation' ),
		'description'    => __( 'Theme options.', 'meditation' ),
	) );
	
//New setting: Display custom colors controls in the customizer
	$wp_customize->add_setting( 'is_custom_colors', array(
		'default'        => $defaults['is_custom_colors'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_custom_colors', array(
		'label'      => __( 'Display Custom Colors Panel', 'meditation' ),
		'section'    => 'meditation_options',
		'settings'   => 'is_custom_colors',
		'type'       => 'checkbox',
		'priority'   => 10,
	) );
	
//New setting: Display custom widgets
	$wp_customize->add_setting( 'is_custom_widgets', array(
		'default'        => $defaults['is_custom_widgets'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_custom_widgets', array(
		'label'      => __( 'Display Theme Default Widgets', 'meditation' ),
		'section'    => 'meditation_options',
		'settings'   => 'is_custom_widgets',
		'type'       => 'checkbox',
		'priority'   => 20,
	) );
	
//New setting: Display donate section
	$wp_customize->add_setting( 'is_display_donate', array(
		'default'        => $defaults['is_display_donate'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_display_donate', array(
		'label'      => __( 'Display "Donate" Section', 'meditation' ),
		'section'    => 'meditation_options',
		'settings'   => 'is_display_donate',
		'type'       => 'checkbox',
		'priority'   => 21,
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_textcolor', array(
		'label'   => __( 'Header Color', 'meditation' ),
		'section' => 'main_colors',
		'settings'   => 'header_textcolor',
		'priority' =>  2,
	) ) );	
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
		'label'   => __( 'Background Color', 'meditation' ),
		'section' => 'main_colors',
		'settings'   => 'background_color',
		'priority' =>  1,
	) ) );
	
//Sets postMessage support
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize->get_section( 'colors' )->panel = 'custom_colors';	
	$wp_customize->get_section( 'colors' )->priority = '1';			
}
add_action( 'customize_register', 'meditation_customize_register' );
 
 /**
 * Add custom styles to the header.
 *
 * @since Meditation 1.0.0
*/
function meditation_hook_css() {
	$defaults = meditation_get_defaults();
?>
	<style type="text/css"> 	
		<?php if ( ! display_header_text() ) : ?>
			.site-title,
			.site-description {
				clip: rect(1px 1px 1px 1px); /* IE7 */
				clip: rect(1px, 1px, 1px, 1px);
				position: absolute;
			}
		<?php endif; ?>
		
		<?php if ( '1' == meditation_get_theme_mod( 'blog_is_entry_meta' ) ) : ?>
			@media screen and (min-width: 680px) {
				.flex .entry-meta {
					display: block;
				}
			}
		<?php endif; ?>
		
		<?php if ( '1' == meditation_get_theme_mod( 'blog_is_cat' ) ) : ?>
			@media screen and (min-width: 680px) {
				.flex .category-list {
					display: block;
				}
			}
		<?php endif; ?>
		
		.site-title h1,
		.site-title a {
			color: #<?php echo esc_attr( get_header_textcolor() ); ?>;
		}

		.header-wrap,
		.site {		
			max-width: <?php echo esc_attr(get_theme_mod('width_site', $defaults['width_site'])); ?>px;
		}

		.sidebar-footer-content,
		.image-text-wrap,
		.horisontal-navigation,
		.text-container,
		.main-wrapper {
			max-width: <?php echo esc_attr(meditation_get_theme_mod('width_main_wrapper')); ?>px;
		}
		
		/* set width of column in px */
		@media screen and (min-width: <?php echo esc_attr(meditation_get_theme_mod('width_mobile_switch')); ?>px) {
		
			.main-wrapper {
				-webkit-flex-flow: nowrap;
				-ms-flex-flow: nowrap;
				flex-flow: nowrap;
			}
			
			.sidebar-1,
			.sidebar-2 {
				display: block;
			}
				
			.site-content {
				-ms-flex-order: 2;     
				-webkit-order: 2;  
				order: 2;
			}
	
			.sidebar-1 {
				-ms-flex-order: 1;     
				-webkit-order: 1;  
				order: 1;
			}

			.sidebar-2 {
				-ms-flex-order: 3;     
				-webkit-order: 3;  
				order: 3;
			}
			
			.two-sidebars .sidebar-1 {
				width: <?php echo esc_attr(meditation_get_theme_mod('width_column_1_rate')); ?>%;
			}

			.two-sidebars .sidebar-2 {
				width: <?php echo esc_attr(meditation_get_theme_mod('width_column_2_rate')); ?>%;
			}
			.two-sidebars .site-content {
				width: <?php echo esc_attr(100 - meditation_get_theme_mod('width_column_2_rate') - meditation_get_theme_mod('width_column_1_rate')); ?>%;
			}
			
			.left-sidebar .sidebar-1 {
				width: <?php echo esc_attr(meditation_get_theme_mod('width_column_1_left_rate')); ?>%;
			}
			.left-sidebar .site-content {
				width: <?php echo esc_attr(100 - meditation_get_theme_mod('width_column_1_left_rate')); ?>%;
			}
			
			.right-sidebar .sidebar-2 {
				width: <?php echo esc_attr(meditation_get_theme_mod('width_column_1_right_rate')); ?>%;
			}	
			.right-sidebar .site-content {
				width: <?php echo esc_attr(100 - meditation_get_theme_mod('width_column_1_right_rate')); ?>%;
			}
		}
		
	 }

	</style>
	<?php
}
add_action('wp_head', 'meditation_hook_css');

 /**
 * Add custom css styles for the Customizer screen.
 *
 * @since Meditation 1.0.0
*/
function meditation_customize_controls_enqueue_scripts() {
	wp_enqueue_style( 'meditation-customize-css', get_template_directory_uri() . '/inc/css/customize.css', array(), MEDITATION_VERSION );
	wp_enqueue_script( 'meditation-customize-control-js', get_template_directory_uri() . '/inc/js/customize.js', array( 'jquery' ), MEDITATION_VERSION, true );
	wp_enqueue_style( 'meditation-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), MEDITATION_VERSION );
}
add_action('customize_controls_enqueue_scripts', 'meditation_customize_controls_enqueue_scripts');

/**
 * Transform hex color to rgba
 *
 * @param string $color hex color. 
 * @param int $opacity opacity. 
 * @return string rgba color.
 * @since Meditation 1.0.0
 */
function meditation_hex_to_rgba( $color, $opacity ) {

	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	$hex = array('ffffff');
	
	if ( 6 == strlen($color) ) {
			$hex = array( $color[0].$color[1], $color[2].$color[3], $color[4].$color[5] );
	} elseif ( 3 == strlen( $color ) ) {
			$hex = array( $color[0].$color[0], $color[1].$color[1], $color[2].$color[2] );
	}

	$rgb =  array_map('hexdec', $hex);

	return 'rgba('.implode(",",$rgb).','.$opacity.')';
}

/**
 * Return string Sanitized post thumbnail type
 *
 * @since Meditation 1.0.0
 */
function meditation_sanitize_post_thumbnail( $value ) {
	$possible_values = array( 'large', 'big', 'small');
	return ( in_array( $value, $possible_values ) ? $value : 'big' );
}

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Meditation 1.0.0
 */
function meditation_customize_preview_js() {
	wp_enqueue_script( 'meditation-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), MEDITATION_VERSION, true );
	
	if ( '1' == meditation_get_theme_mod( 'is_custom_colors' ) ) {
		wp_enqueue_script( 'meditation-customizer-colors', get_template_directory_uri() . '/js/theme-customizer-colors.js', array( 'customize-preview' ), MEDITATION_VERSION, true );
	}
}
add_action( 'customize_preview_init', 'meditation_customize_preview_js', 99 );

 /**
 * Sanitize bool value.
 *
 * @param string $value Value to sanitize. 
 * @return int 1 or 0.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_checkbox( $value ) {	
	return ( $value == '1' ? '1' : '' );
} 
 /**
 * Sanitize url value.
 *
 * @param string $value Value to sanitize. 
 * @return string sanitizes url.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_url( $value ) {	
	return esc_url( $value );
}
 /**
 * Sanitize url value.
 *
 * @param string $value Value to sanitize. 
 * @return string sanitizes url.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_background_url( $value ) {	
	$value = esc_url( $value );
	return ( $value == '' ? 'none' : $value );
}
/**
 * Sanitize integer.
 *
 * @param string $value Value to sanitize. 
 * @return int sanitized value.
 * @uses absint()
 * @since Meditation 1.0.0
 */
function meditation_sanitize_int( $value ) {
	return absint( $value );
} 
/**
 * Sanitize text field.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @uses sanitize_text_field()
 * @since Meditation 1.0.0
 */
function meditation_sanitize_text( $value ) {
	return sanitize_text_field( $value );
}
/**
 * Sanitize hex color.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @uses sanitize_hex_color()
 * @since Meditation 1.0.0
 */
function meditation_sanitize_hex_color( $value ) {
	return sanitize_hex_color( $value );
}
/**
 * Sanitize text.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_kses( $value ) {
	return wp_kses( $value, array(
				'a' => array(
					'href' => array(),
					'title' => array()
				),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
			)
			);
}
/**
 * Sanitize hex color.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_content_width( $value ) {
	$value = absint($value);
	$value = ($value > 1349 ? 1349 : ($value < 500 ? 500 : $value));
	return $value;
}
/**
 * Sanitize scroll button.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_scroll_button( $value ) {
	$possible_values = array( 'none', 'right', 'left', 'center');
	return ( in_array( $value, $possible_values ) ? $value : 'right' );
}

/**
 * Sanitize scroll css3 effect.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_scroll_effect( $value ) {
	$possible_values = array( 'none', 'move');
	return ( in_array( $value, $possible_values ) ? $value : 'move' );
}
/**
 * Sanitize opacity.
 *
 * @param string $value Value to sanitize. 
 * @return sanitized value.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_opacity( $value ) {
	$possible_values = array ( '0',
							   '0.1', 
							   '0.2', 
							   '0.3', 
							   '0.4', 
							   '0.5',
							   '0.6', 
							   '0.7',
							   '0.8',
							   '0.9',
							   '1');
	return ( in_array( $value, $possible_values ) ? $value : '0.3' );
}
/**
 * Return string Sanitized background position
 *
 * @since Meditation 1.0.0
 */
function meditation_sanitize_background_position( $value ) {
	$possible_values = array( 'top', 'center', 'bottom');
	return ( in_array( $value, $possible_values ) ? $value : 'top' );
}