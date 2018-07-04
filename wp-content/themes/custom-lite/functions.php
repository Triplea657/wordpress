<?php
/**
 * Functions and definitions
 *
 * @package WordPress
 * @subpackage Custom Lite
 * @since Custom Lite 1.0
*/

/**
 * Custom Lite setup.
 *
 * @since Custom Lite 1.0
 */
 
 if ( ! isset( $content_width ) ) {
	$content_width = 864;
}
define ( 'CUSTOMLITE_VERSION', '1.0.2' );
  
function customlite_setup() {

	load_child_theme_textdomain( 'custom-lite' );
	
	$args = array(
		'default-image'          => get_stylesheet_directory_uri() . '/img/header.jpg',
		'header-text'            => true,
		'default-text-color'     => 'ffffff',
		'width'                  => absint( meditation_get_theme_mod( 'size_image' ) ),
		'height'                 => absint( meditation_get_theme_mod( 'size_image_height' ) ),
		'flex-height'            => true,
		'flex-width'             => true,
	);
	add_theme_support( 'custom-header', $args );
	
	$defaults = array(
		'default-image' => get_stylesheet_directory_uri() . '/img/background.jpg',
		'default-attachment' => 'fixed',
	);
	add_theme_support( 'custom-background', $defaults );
	
	remove_action( 'meditation_empty_sidebar-header', 'meditation_header_sidebar', 20 );
	remove_action( 'meditation_empty_sidebar_footer-1', 'meditation_home_footer_1', 20 );
	remove_action( 'meditation_empty_sidebar_footer-2', 'meditation_home_footer_2', 20 );
	remove_action( 'meditation_empty_sidebar_footer-3', 'meditation_home_footer_3', 20 );
	remove_action( 'meditation_empty_column_1-default', 'meditation_left_sidebar_default', 20 );
	remove_action( 'meditation_empty_column_2-default', 'meditation_right_sidebar_default', 20 );

}
add_action( 'after_setup_theme', 'customlite_setup' );

/**
 * Remove setions
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Custom Lite 1.0.0
 */
 
function customlite_customize_register( $wp_customize ) {
		
	$wp_customize->remove_section( 'meditation_scroll' );			
	$wp_customize->remove_section( 'columns' );			
	$wp_customize->remove_section( 'size' );			
	$wp_customize->remove_section( 'content_colors' );	
	
	$defaults = meditation_get_defaults();	

//New setting: Display Sidebar Icon
	$wp_customize->add_setting( 'is_custom_icons', array(
		'default'        => '1',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_custom_icons', array(
		'label'      => __( 'Display Top Big Icons', 'custom-lite'),
		'section'    => 'meditation_options',
		'settings'   => 'is_custom_icons',
		'type'       => 'checkbox',
		'priority'   => 40,
	) );
//New section in the customizer: Scroll To Top Button
	$wp_customize->add_section( 'icons', array(
		'title'          => __( 'Big Top Icons', 'custom-lite'),
		'priority'       => $section_priority++,
		'panel'  => 'other',
	) );
	
	$wp_customize->add_setting( 'icon_1', array(
		'default'        => $defaults['icon_1'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'refresh',
		'sanitize_callback' => 'esc_html'
	) );
	
	$wp_customize->add_control( 'icon_1', array(
		'label'      => __( 'Left Icon Class', 'custom-lite'),
		'section'    => 'icons',
		'settings'   => 'icon_1',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => customlite_get_icons_customizer(),
	) );
	$wp_customize->add_setting( 'icon_2', array(
		'default'        => $defaults['icon_2'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'refresh',
		'sanitize_callback' => 'esc_html'
	) );
	
	$wp_customize->add_control( 'icon_2', array(
		'label'      => __( 'Left Icon Class', 'custom-lite'),
		'section'    => 'icons',
		'settings'   => 'icon_2',
		'type'       => 'select',
		'priority'   => 1,
		'choices'	 => customlite_get_icons_customizer(),
	) );	
}
add_action( 'customize_register', 'customlite_customize_register', 99 );

/**
 * Enqueue parent and child scripts
 *
 * @package WordPress
 * @subpackage Custom Lite
 * @since Custom Lite 1.0
*/
 
function customlite_styles() {
    wp_enqueue_style( 'meditation-style', get_template_directory_uri() . '/style.css', array(), CUSTOMLITE_VERSION );
    wp_enqueue_style( 'customlite-style', get_stylesheet_uri(), array( 'meditation-style', 'meditation-animate' ), CUSTOMLITE_VERSION );
	
	// Adds JavaScript for handing the navigation menu hide-and-show behavior.
	wp_enqueue_script( 'customlite-nav', get_stylesheet_directory_uri() . '/js/scroll.js', array( 'jquery' ), CUSTOMLITE_VERSION, true );
	
	// font awesome
	wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/font-awesome/css/fontawesome-all.min.css', array(), CUSTOMLITE_VERSION );
	
	
}
add_action( 'wp_enqueue_scripts', 'customlite_styles' );

/* Scripts and styles for the Customizer */
function customlite_admin_enqueue_scripts( $hook_suffix ) {
	if ( 'widgets.php' !== $hook_suffix ) {
		return;
	}
	// Open Media Library
	wp_enqueue_script( 'customlite-navigation', get_stylesheet_directory_uri() . '/js/meta-box-image.js', array( 'jquery' ), CUSTOMLITE_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'customlite_admin_enqueue_scripts' );

/**
 * Set defaults
 *
 * @package WordPress
 * @subpackage Custom Lite
 * @since Custom Lite 1.0
*/

function customlite_defaults( $defaults ) {
	
	$defaults['is_cat'] = '1';
	$defaults['is_author'] = '1';
	$defaults['is_date'] = '1';
	$defaults['is_views'] = '';
	$defaults['is_comments'] = '';
	$defaults['blog_is_cat'] = '1';
	$defaults['blog_is_author'] = '';
	$defaults['blog_is_date'] = '1';
	$defaults['blog_is_views'] = '';
	$defaults['blog_is_comments'] = '';
	$defaults['blog_is_entry_meta'] = '';
	$defaults['is_restart_header'] = '';
	$defaults['font_scheme'] = '3';
	$defaults['color_scheme'] = '4';
	$defaults['menu_effect_class'] = '3';
	$defaults['blog_effect_class'] = '2';
	$defaults['sidebar_effect_class'] = '7';
	$defaults['header_effect_class'] = '6';

	$defaults['site_style'] = 'full';
	$defaults['content_style'] = 'full';
	
	$defaults['width_site'] = '2500';
	$defaults['width_top_widget_area'] = '2500';
	$defaults['width_content_no_sidebar'] = '2500';	
	$defaults['width_content'] = '2500';
	$defaults['width_main_wrapper'] = '2500';
	
	/* Header Image size */
	$defaults['size_image'] = '900';
	$defaults['size_image_height'] = '300';
	/* Header Image and top sidebar wrapper */
	$defaults['width_image'] = '900';
	$defaults['width_mobile_switch'] = '1080';
	
	$defaults['scroll_button'] = 'none';
	
	$defaults['single_style'] = 'excerpt';
	$defaults['is_custom_icons'] = '1';
	$defaults['icon_1'] = 'fa-gem';
	$defaults['icon_2'] = 'fa-arrow-alt-circle-down';
	
	$defaults['is_thumbnail_empty_icon'] = '1';
	$defaults['empty_image'] = esc_url( get_stylesheet_directory_uri() ) . '/img/empty2.jpg';

	$defaults['footer_text'] = '<a href="' . esc_url( __( 'http://wordpress.org/', 'custom-lite' ) ) . '">' . __( 'Powered by WordPress', 'custom-lite' ). '</a> | ' . __( 'theme ', 'custom-lite' ) . '<a href="' .  esc_attr( __( 'https://visualpharm.com/wpblogs/themes/', 'custom-lite') ) . '">Custom Lite</a>';
	
	return $defaults;

}
add_filter( 'meditation_option_defaults', 'customlite_defaults' );

/**
 * Set excerpt length to 10 words
 *
 * @param string $length current length 
 *
 * @since Custom Lite 1.0.0
 */
function customlite_custom_excerpt_length( $length ) {
	return 10;
}
add_filter( 'excerpt_length', 'customlite_custom_excerpt_length', 99999 );

/** Set theme layout
 *
 * @since Custom Lite 1.0
 */
function customlite_layout( $layout ) {
	
	foreach( $layout as $id => $layouts ) {
		if ( 'layout_home' == $layouts['name'] ) {

			$layout[ $id ]['val'] = 'two-sidebars';
			
		}
		if ( 'layout_home' == $layouts['name'] || 'layout_blog' == $layouts['name'] || 'layout_archive' == $layouts['name'] ) {

			$layout[ $id ]['content_val'] = 'flex-layout-3';
			
		}	
		if (  'layout_archive' == $layouts['name'] ) {

			$layout[ $id ]['content_val'] = 'flex-layout-3';
			
		}
		if (  'layout_default' == $layouts['name'] ) {

			$layout[ $id ]['val'] = 'right-sidebar';
			
		}
	}
	return $layout;
}
add_filter( 'meditation_layout', 'customlite_layout' );

 /**
 * Print credit links and scroll to top button
 *
 * @since Custom Lite 1.0.0
 */
function customlite_site_info() {	
?>
	<div class="scrollup-cont"><i class="scrollup-icon fa fa-arrow-circle-up"></i></div>
<?php
}
add_action( 'meditation_site_info', 'customlite_site_info', 19 );

/**
 * Extend the default WordPress body classes.
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 *
 * @since Custom Lite 1.0.0
 */
function customlite_body_class( $classes ) {

	global $meditation_colors_class;
	$colors = $meditation_colors_class;
	$classes[] = 'color-' . esc_attr( $colors->get_color_scheme() );
	
	return $classes;
}
add_filter( 'body_class', 'customlite_body_class' );
	
/**
 * Add custom styles to the header.
 *
 * @since Custom Lite 1.0.0
*/
function customlite_hook_css() {
	
	?>
	<style type="text/css">
		.sg-site-header-1.no-image,
		.site-content,
		.image-container {
			max-width: <?php echo esc_attr(meditation_get_theme_mod('width_main_wrapper')); ?>px;
			min-width: <?php echo esc_attr(meditation_get_theme_mod('width_main_wrapper')); ?>px;
		}
	</style>
	<?php
}
add_action('wp_head', 'customlite_hook_css');

/**
 * Icons
 *
 */
function customlite_get_icons() {
	return array ( '0' => array(
							'id' => 'custom', 
							'title' => __( 'Custom (Copy and Paste class)', 'custom-lite' ), 
						),
			'1' => array(
							'id' => 'fa-arrow-circle-left', 
							'title' => __( 'Arrow Left', 'custom-lite' ), 
						),						
			'2' => array(
							'id' => 'fa-arrow-circle-right', 
							'title' => __( 'Arrow Right', 'custom-lite' ), 
						),						
			'3' => array(
							'id' => 'fa-arrow-circle-down', 
							'title' => __( 'Arrow Bottom', 'custom-lite' ), 
						),							
			'4' => array(
							'id' => 'fa-arrow-circle-up', 
							'title' => __( 'Arrow Up', 'custom-lite' ), 
						),							
			'5' => array(
							'id' => 'fa-phone-square', 
							'title' => __( 'Phone', 'custom-lite' ), 
						),							
			'6' => array(
							'id' => 'fa-pencil-alt', 
							'title' => __( 'Pencil', 'custom-lite' ), 
						),							
			'7' => array(
							'id' => 'fa-music', 
							'title' => __( 'Music', 'custom-lite' ), 
						),							
			'8' => array(
							'id' => 'fa-magic', 
							'title' => __( 'Magic', 'custom-lite' ), 
						),							
			'9' => array(
							'id' => 'fa-image', 
							'title' => __( 'Photo', 'custom-lite' ), 
						),							
			'10' => array(
							'id' => 'fa-heart', 
							'title' => __( 'Heart', 'custom-lite' ), 
						),														
			'12' => array(
							'id' => 'fa-gift', 
							'title' => __( 'Gift', 'custom-lite' ), 
						),							
			'13' => array(
							'id' => 'fa-home', 
							'title' => __( 'Home', 'custom-lite' ), 
						),													
			'15' => array(
							'id' => 'fa-map-marker-alt', 
							'title' => __( 'Map Marker', 'custom-lite' ), 
						),							
						
			'16' => array(
							'id' => 'fa-question-circle', 
							'title' => __( 'Question', 'custom-lite' ), 
						),							
			'17' => array(
							'id' => 'fa-glass-martini', 
							'title' => __( 'Glass', 'custom-lite' ), 
						),							
			'18' => array(
							'id' => 'fa-male', 
							'title' => __( 'Male', 'custom-lite' ), 
						),							
			'19' => array(
							'id' => 'fa-quote-right', 
							'title' => __( 'Quote', 'custom-lite' ), 
						),							
			'20' => array(
							'id' => 'fa-spinner', 
							'title' => __( 'Spinner', 'custom-lite' ), 
						),							
			'21' => array(
							'id' => 'fa-star', 
							'title' => __( 'Star', 'custom-lite' ), 
						),							
			'22' => array(
							'id' => 'fa-taxi', 
							'title' => __( 'Taxi', 'custom-lite' ), 
						),							
			'23' => array(
							'id' => 'fa-exclamation-triangle', 
							'title' => __( 'Warning', 'custom-lite' ), 
						),							
			'24' => array(
							'id' => 'fa-trophy', 
							'title' => __( 'Trophy', 'custom-lite' ), 
						),							
			'25' => array(
							'id' => 'fa-female', 
							'title' => __( 'Female', 'custom-lite' ), 
						),							
			'26' => array(
							'id' => 'fa-check-square', 
							'title' => __( 'Check', 'custom-lite' ), 
						),							
			'27' => array(
							'id' => 'fa-coffee', 
							'title' => __( 'Coffee', 'custom-lite' ), 
						),							
			'28' => array(
							'id' => 'fa-download', 
							'title' => __( 'Download', 'custom-lite' ), 
						),							
			'29' => array(
							'id' => 'fa-gem', 
							'title' => __( 'Diamond', 'custom-lite' ), 
						),							
			'30' => array(
							'id' => 'fa-envelope', 
							'title' => __( 'Envelope', 'custom-lite' ), 
						),							
			'31' => array(
							'id' => 'fa-cog', 
							'title' => __( 'Cog', 'custom-lite' ), 
						),							
			'32' => array(
							'id' => 'fa-circle-notch', 
							'title' => __( 'Circle', 'custom-lite' ), 
						),							
			'33' => array(
							'id' => 'fa-cubes', 
							'title' => __( 'Cubes', 'custom-lite' ), 
						),							
			'34' => array(
							'id' => 'fa-copyright', 
							'title' => __( 'Copyright', 'custom-lite' ), 
						),							
			'35' => array(
							'id' => 'fa-sync', 
							'title' => __( 'Refresh', 'custom-lite' ), 
						),											
			'id' => array(
							'fa-snowflake', 
							'title' => __( 'Snowflake', 'custom-lite' ), 
						),							
			'id' => array(
							'fa-search', 
							'title' => __( 'Search', 'custom-lite' ), 
						),
		);
}
/**
 * Icon choices fo the customizer
 *
 */
function customlite_get_icons_customizer() {
	$icons = customlite_get_icons();
	$all_icons = array();
	$all_icons[ 'none' ] =  __( 'None', 'custom-lite' );
	foreach ( $icons as $id => $icon ) {
		if ( 'custom' == $id ) continue;
		$all_icons[ $icon['id'] ] =  $icon['title'];
	}
	return $all_icons;
}

/**
 * Add new field to the widget's form.
 *
 * @param array $instance widget params.
 * @param array $widget widget.
 */
function customlite_widget_form_extend( $instance, $widget ) {
	
	if ( ! isset( $instance['customlite_icon'] ) )
		$instance['customlite_icon'] = null;		
	if ( ! isset( $instance['customlite_color'] ) )
		$instance['customlite_color'] = '#ffffff';
	if ( ! isset( $instance['customlite_position'] ) )
		$instance['customlite_position'] = 'center';
	if ( ! isset( $instance['customlite_effect'] ) )
		$instance['customlite_effect'] = null;	
	if ( ! isset( $instance['customlite_how'] ) )
		$instance['customlite_how'] = 'inside';
	
	meditation_echo_section_start( __( 'Widget Icons', 'custom-lite' ), $widget->get_field_id( 'customlite_icon' ) . '_custom' );

		meditation_echo_input_text( $widget, 'customlite_icon', $instance, __( 'Icon Class (see all icons here https://fontawesome.com/icons?d=gallery&m=free)' , 'custom-lite' ) ) ;
		$position = customlite_get_icons();
	
		esc_html_e('Icons:', 'custom-lite'); ?>
		<select id="<?php echo esc_attr( $widget->get_field_id('customlite_icon_select') ); ?>" name="<?php echo esc_attr( $widget->get_field_name('customlite_icon_select') ); ?>" style="width:100%;">
		<?php 

			foreach ( $position as $el ) :
				echo '<option value="'. esc_attr( $el['id'] ).'" ';
				selected( $instance['customlite_icon_select'], $el['id']  );
				echo '>'.esc_html( $el['title'] ).'</option>';
			endforeach;
		?>
		</select>
		<?php 
		meditation_echo_input_text( $widget, 'customlite_color', $instance, __( 'Color', 'custom-lite' ) );

		$position = array ( '0' => array(
											'id' => 'center', 
											'title' => __( 'Center', 'custom-lite' ), 
										),
							'1' => array(
											'id' => 'right-top', 
											'title' => __( 'Right Top', 'custom-lite' ), 
										),						
							'2' => array(
											'id' => 'right-center', 
											'title' => __( 'Right Center', 'custom-lite' ), 
										),						
							'3' => array(
											'id' => 'right-bottom', 
											'title' => __( 'Right Bottom', 'custom-lite' ), 
										),
						);
	
		esc_html_e('Position:', 'custom-lite'); ?>
		<select id="<?php echo esc_attr( $widget->get_field_id('customlite_position') ); ?>" name="<?php echo esc_attr( $widget->get_field_name('customlite_position') ); ?>" style="width:100%;">
		<?php 

			foreach ( $position as $el ) :
				echo '<option value="'. esc_attr( $el['id'] ).'" ';
				selected( $instance['customlite_position'], $el['id']  );
				echo '>'.esc_html( $el['title'] ).'</option>';
			endforeach;
		?>
		</select>
		<?php 
			$position = array ( '0' => array(
											'id' => 'none', 
											'title' => __( 'None', 'custom-lite' ), 
										),
							'1' => array(
											'id' => 'rotate-y', 
											'title' => __( 'Rotate Y', 'custom-lite' ), 
										),
							'2' => array(
											'id' => 'rotate-x', 
											'title' => __( 'Rotate X', 'custom-lite' ), 
										),						
							'3' => array(
											'id' => 'rotate-z', 
											'title' => __( 'Rotate Z', 'custom-lite' ), 
										),						
							'4' => array(
											'id' => 'jump', 
											'title' => __( 'Jump', 'custom-lite' ), 
										),					
							'5' => array(
											'id' => 'side-move', 
											'title' => __( 'Side Move', 'custom-lite' ), 
										),					
							'6' => array(
											'id' => 'zoom', 
											'title' => __( 'Zoom', 'custom-lite' ), 
										),
						);
	
		esc_html_e('Effect:', 'custom-lite'); ?>
		<select id="<?php echo esc_attr( $widget->get_field_id('customlite_effect') ); ?>" name="<?php echo esc_attr( $widget->get_field_name('customlite_effect') ); ?>" style="width:100%;">
		<?php 

			foreach ( $position as $el ) : 
				echo '<option value="'. esc_attr( $el['id'] ).'" ';
				selected( $instance['customlite_effect'], $el['id']  );
				echo '>'.esc_html( $el['title'] ).'</option>';
			endforeach;
		?>
		</select>
			<?php 
			$position = array ( '0' => array(
											'id' => 'outside', 
											'title' => __( 'Outside', 'custom-lite' ), 
										),
							'1' => array(
											'id' => 'inside', 
											'title' => __( 'Inside', 'custom-lite' ), 
										),
						);
	
		esc_html_e('How To Display:', 'custom-lite'); ?>
		<select id="<?php echo esc_attr( $widget->get_field_id('customlite_how') ); ?>" name="<?php echo esc_attr( $widget->get_field_name('customlite_how') ); ?>" style="width:100%;">
		<?php 

			foreach ( $position as $el ) : 
				echo '<option value="'. esc_attr( $el['id'] ).'" ';
				selected( $instance['customlite_how'], $el['id']  );
				echo '>'.esc_html( $el['title'] ).'</option>';
			endforeach;
		?>
		</select>
		
<?php
	meditation_echo_section_end();

	return $instance;
}
add_filter( 'widget_form_callback', 'customlite_widget_form_extend', 10, 2 );

/**
 * Update and sanitize widget params.
 *
 * @param array $instance old params.
 * @param array $new_instance new params.
 * @return array $instance sanitized new params.
 */
function customlite_widget_update_form( $instance, $new_instance, $old_instance, $widget ) {
	
	/* save color */
	if ( isset( $new_instance['customlite_color'] ) ) {	
		$instance['customlite_color'] = esc_html( $new_instance['customlite_color'] );
	}
	
	/* save icon */
	if ( isset( $new_instance['customlite_icon'] ) ) {	
		$instance['customlite_icon'] = esc_html( $new_instance['customlite_icon'] );
	}
	
	/* save position class */
	if ( isset( $new_instance['customlite_position'] ) ) {	
		$instance['customlite_position'] = esc_html( $new_instance['customlite_position'] );
	}	
	
	/* save effect class */
	if ( isset( $new_instance['customlite_effect'] ) ) {	
		$instance['customlite_effect'] = esc_html( $new_instance['customlite_effect'] );
	}	
	
	/* save how class */
	if ( isset( $new_instance['customlite_how'] ) ) {	
		$instance['customlite_how'] = esc_html( $new_instance['customlite_how'] );
	}	
	
	/* save icon list class */
	if ( isset( $new_instance['customlite_icon_select'] ) ) {	
		$instance['customlite_icon_select'] = esc_html( $new_instance['customlite_icon_select'] );
		if ( 'custom' != $instance['customlite_icon_select'] ) {
			$instance['customlite_icon'] = $instance['customlite_icon_select'];
		}
	}
	
	return $instance;
}
add_filter( 'widget_update_callback', 'customlite_widget_update_form', 10, 2 );


/**
 * Add Custom Icon for Widgts
 *
 * @param array $params sidebar params.
 */
function customlite_dynamic_sidebar_params( $params ) {
	
		global $wp_registered_widgets;
		
		$widget_id	= $params[0]['widget_id'];
		$widget_obj	= $wp_registered_widgets[ $widget_id ];
		$widget_opt	= get_option( $widget_obj['callback'][0]->option_name );
		$widget_num	= $widget_obj['params'][0]['number'];
	
		$icon_top = '';
		$icon_inside = '';
		$after = '';
		$effect = '';
		$position = 'center';
		$color = '#ffffff';
		
		if ( isset( $widget_opt[ $widget_num ]['customlite_icon'] ) && ! empty( $widget_opt[ $widget_num]['customlite_icon'] ) ) {
			
			if ( isset( $widget_opt[ $widget_num ]['customlite_color'] ) && ! empty( $widget_opt[ $widget_num]['customlite_color'] ) ) $color = $widget_opt[ $widget_num]['customlite_color'];
			
			if ( isset( $widget_opt[ $widget_num ]['customlite_how'] ) && ! empty( $widget_opt[ $widget_num]['customlite_how'] ) && 'outside' ==  $widget_opt[ $widget_num]['customlite_how'] ) {
				
			
				if ( isset( $widget_opt[ $widget_num ]['customlite_position'] ) && ! empty( $widget_opt[ $widget_num]['customlite_position'] ) )
					$position = ' ' . $widget_opt[ $widget_num ]['customlite_position'];			
				if ( isset( $widget_opt[ $widget_num ]['customlite_effect'] ) && ! empty( $widget_opt[ $widget_num]['customlite_effect'] ) )
					$effect = ' ' . $widget_opt[ $widget_num ]['customlite_effect'];
					
				$icon_top = '<div class=widget-wrap"><div class="widget-icon outside' . esc_attr( $position ) . esc_attr( $effect ) . '"><i class="icon fa fa-5x ' . esc_attr( $widget_opt[ $widget_num ]['customlite_icon'] ) . '" style="color:' . esc_attr( $color ) . ';"></i></div>';
				$after = '</div>';
				
			} elseif ( isset( $widget_opt[ $widget_num ]['customlite_how'] ) && ! empty( $widget_opt[ $widget_num]['customlite_how'] ) && 'inside' ==  $widget_opt[ $widget_num]['customlite_how'] ) {

				if ( isset( $widget_opt[ $widget_num ]['customlite_position'] ) && ! empty( $widget_opt[ $widget_num]['customlite_position'] ) )
					$position = ' ' . $widget_opt[ $widget_num ]['customlite_position'];			
				if ( isset( $widget_opt[ $widget_num ]['customlite_effect'] ) && ! empty( $widget_opt[ $widget_num]['customlite_effect'] ) )
					$effect = ' ' . $widget_opt[ $widget_num ]['customlite_effect'];
			
				$icon_inside  = '<div class="widget-icon inside' . esc_attr( $position ) . esc_attr( $effect ) . '"><i class="icon fa fa-5x fa-fw ' . esc_attr( $widget_opt[ $widget_num ]['customlite_icon'] ) . '" style="color:' . esc_attr( $color ) . ';"></i></div>';
			} 
		}else return $params;
		
		/* Add Icon To The Widget */
		$params[0]['before_widget'] = $icon_top . $params[0]['before_widget'] . $icon_inside;
		$params[0]['after_widget'] = $params[0]['after_widget'] . $after;

	return $params;  
}
add_filter( 'dynamic_sidebar_params', 'customlite_dynamic_sidebar_params' );

/**
 * Add widgets to the left sidebar on all pages
 *
 * @since Custom Lite 1.0.0
 */
function customlite_left_sidebar_default() {

	if ( '1' == meditation_get_theme_mod('is_custom_widgets') ) {
		the_widget( 'WP_Widget_Recent_Posts', 'title=' );
		the_widget( 'WP_Widget_Tag_Cloud', 'title=' );
	}
}
add_action('meditation_empty_column_1-default', 'customlite_left_sidebar_default', 20);

/**
 * Add widgets to the right sidebar on all pages
 *
 * @since Custom Lite 1.0.0
 */
function customlite_right_sidebar_default() {

	if ( '1' == meditation_get_theme_mod('is_custom_widgets') ) {
		the_widget( 'WP_Widget_Categories', 'title=' );
	}
}
add_action('meditation_empty_column_2-default', 'customlite_right_sidebar_default', 20);