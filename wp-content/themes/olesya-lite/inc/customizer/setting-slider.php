<?php
/**
 * Theme Customizer slider setting.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function olesya_lite_customize_slider_register( $wp_customize ) {

	$wp_customize->add_section(
		'content_slider' ,
		array(
			'title' 			=> __( 'Content Slider', 'olesya-lite' ),
			'priority' 			=> 200,
			'panel'				=> 'theme_settings'
	) );

	$wp_customize->add_setting(
		'enable_slider' ,
		 array(
		    'default' 			=> false,
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'olesya_lite_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'enable_slider',
		array(
			'label'    => __( 'Enable Content Slider', 'olesya-lite' ),
			'section'  => 'content_slider',
			'settings' => 'enable_slider',
			'type'     => 'checkbox'
		)
	);

	$wp_customize->add_setting(
		'slider_cat',
		array(
			'default'           => '1',
			'sanitize_callback' => 'olesya_lite_sanitize_select',
			'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control(
		'slider_cat',
		array(
			'label'    => __( 'Select Category', 'olesya-lite' ),
			'section'  => 'content_slider',
			'setting'  => 'slider_cat',
			'type'     => 'select',
			'choices'  => olesya_lite_get_terms( 'category' )
	) );

	$wp_customize->add_setting(
		'slides_num' ,
		 array(
		    'default' 			=> 5,
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'olesya_lite_sanitize_number_absint',
	) );

	$wp_customize->add_control(
		'slides_num',
		array(
			'label'    => __( 'Number of posts to display', 'olesya-lite' ),
			'section'  => 'content_slider',
			'settings' => 'slides_num',
			'type'     => 'number',
		    'input_attrs' => array(
		        'min'   => 1,
		        'max'   => 99,
		    )
		)
	);

	$wp_customize->add_setting(
		'slider_orderby',
		array(
			'default'           => 'date',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control(
		'slider_orderby',
		array(
			'label'    => __( 'Orderby', 'olesya-lite' ),
			'section'  => 'content_slider',
			'setting'  => 'slider_orderby',
			'type'     => 'select',
			'choices'  => array(
				'ID'  			=> esc_attr__( 'Post ID', 'olesya-lite' ),
				'author' 		=> esc_attr__( 'Author', 'olesya-lite' ),
				'date'			=> esc_attr__( 'Date', 'olesya-lite' ),
				'title' 		=> esc_attr__( 'Title', 'olesya-lite' ),
				'comment_count'	=> esc_attr__( 'Comment count', 'olesya-lite' ),
				'modified'		=> esc_attr__( 'Last Modified Date', 'olesya-lite' ),
				'rand'			=> esc_attr__( 'Random', 'olesya-lite' ),
			),
	) );

	$wp_customize->add_setting(
		'slider_order',
		array(
			'default'           => 'DESC',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control(
		'slider_order',
		array(
			'label'    => __( 'Orderby', 'olesya-lite' ),
			'section'  => 'content_slider',
			'setting'  => 'slider_order',
			'type'     => 'select',
			'choices'  => array(
				'ASC'  	=> esc_attr__( 'Lowest to highest values', 'olesya-lite' ),
				'DESC' 	=> esc_attr__( 'Highest to lowest values', 'olesya-lite' ),
			),
	) );

	$sliders = array(
		'enable_slider',
		'slides_num',
		'slider_cat',
		'slider_orderby',
		'slider_order'
	);

    if ( isset( $wp_customize->selective_refresh ) ) {

    	foreach ( $sliders as $slider ) {
			$wp_customize->selective_refresh->add_partial(
				$slider,
				array(
					'selector' 				=> '.featured-content',
					'settings' 				=> array( $slider ),
					'render_callback' 		=> 'olesya_lite_do_slider_content',
					'container_inclusive'	=> true,
			) );
    	}

    }

}
add_action( 'customize_register', 'olesya_lite_customize_slider_register' );
