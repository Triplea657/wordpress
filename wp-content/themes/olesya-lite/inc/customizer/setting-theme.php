<?php
/**
 * Theme Customizer slider setting.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function olesya_lite_customize_theme_register( $wp_customize ) {

	/** Theme Colors */
	$wp_customize->add_setting(
		'primary_text_color',
		array(
			'default'           => "#455a64",
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'primary_text_color',
		array(
			'label'       	=> __( 'Primary Text Color', 'olesya-lite' ),
			'description'	=> __( 'Used for text, block.', 'olesya-lite' ),
			'section'     	=> 'colors',
			'setting'		=> 'primary_text_color',
			'priority'		=> 99
	) ) );

	$wp_customize->add_setting(
		'secondary_text_color',
		array(
			'default'           => "#90a4ae",
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'secondary_text_color',
		array(
			'label'       	=> __( 'Secondary Text Color', 'olesya-lite' ),
			'description'	=> __( 'Used for text, block.', 'olesya-lite' ),
			'section'     	=> 'colors',
			'setting'		=> 'secondary_text_color',
			'priority'		=> 99
	) ) );

	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => "#f06292",
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'primary_color',
		array(
			'label'       	=> __( 'Primary Color', 'olesya-lite' ),
			'description'	=> __( 'Used for link, button ', 'olesya-lite' ),
			'section'     	=> 'colors',
			'setting'		=> 'primary_color',
			'priority'		=> 99
	) ) );

	$wp_customize->add_setting(
		'secondary_color',
		array(
			'default'           => "#f7a8c2",
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'secondary_color',
		array(
			'label'       	=> __( 'Hover Color', 'olesya-lite' ),
			'description'	=> __( 'Used for link:hover, button:hover, selection.', 'olesya-lite' ),
			'section'     	=> 'colors',
			'setting'		=> 'secondary_color',
			'priority'		=> 99
	) ) );


	// Preloader
	$wp_customize->add_section(
		'preloader' ,
		array(
			'title' 			=> __( 'Preloader', 'olesya-lite' ),
			'priority' 			=> 200,
			'panel'				=> 'theme_settings'
	) );

	$wp_customize->add_setting(
		'enable_preloader' ,
		 array(
		    'default' 			=> false,
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'olesya_lite_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'enable_preloader',
		array(
			'label'    => __( 'Enable Preloader', 'olesya-lite' ),
			'section'  => 'preloader',
			'settings' => 'enable_preloader',
			'type'     => 'checkbox'
		)
	);

	$wp_customize->add_setting(
		'preloader_bg_color',
		array(
			'default'           => "#ffffff",
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'preloader_bg_color',
		array(
			'label'       	=> __( 'Preloader background color', 'olesya-lite' ),
			'section'     	=> 'preloader',
			'setting'		=> 'preloader_bg_color',
	) ) );

	$wp_customize->add_setting(
		'preloader_color',
		array(
			'default'           => "#f06292",
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
		'preloader_color',
		array(
			'label'       	=> __( 'Preloader color', 'olesya-lite' ),
			'section'     	=> 'preloader',
			'setting'		=> 'preloader_color',
	) ) );

	$wp_customize->add_setting(
		'show_preloader' ,
		 array(
		    'default' 			=> false,
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'olesya_lite_sanitize_checkbox',
	) );

	$wp_customize->add_control(
		'show_preloader',
		array(
			'label'    		=> __( 'Show/Hide Preloader', 'olesya-lite' ),
			'description'   => __( 'Check/Uncheck to preview preloader to get a better view if want to change the color.', 'olesya-lite' ),
			'section'  		=> 'preloader',
			'settings' 		=> 'show_preloader',
			'type'     		=> 'checkbox'
		)
	);


	// Content Layout
	$wp_customize->add_section(
		'content_layout' ,
		array(
			'title' 			=> __( 'Content Layout', 'olesya-lite' ),
			'priority' 			=> 200,
			'panel'				=> 'theme_settings'
	) );

	$wp_customize->add_setting(
		'content_layout',
		array(
			'default'           => 'content-sidebar',
			'sanitize_callback' => 'olesya_lite_sanitize_select',
			'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control(
		'content_layout',
		array(
			'label'    => __( 'Content Layout', 'olesya-lite' ),
			'section'  => 'content_layout',
			'setting'  => 'content_layout',
			'type'     => 'select',
			'choices'  => array(
				'content-sidebar' 		=> esc_attr__( 'Content - Sidebar', 'olesya-lite' ),
				'sidebar-content' 		=> esc_attr__( 'Sidebar - Content', 'olesya-lite' ),
				'full-width-content'	=> esc_attr__( 'Full Width Content', 'olesya-lite' ),
			),
	) );


	// Blog Posts
	$wp_customize->add_section(
		'blog_post' ,
		array(
			'title' 			=> __( 'Blog Posts', 'olesya-lite' ),
			'priority' 			=> 200,
			'panel'				=> 'theme_settings'
	) );

	$wp_customize->add_setting(
		'sticky_label' ,
		array(
		    'default' 			=> esc_attr__( 'Sticky', 'olesya-lite' ),
		    'transport'			=> 'postMessage',
		    'sanitize_callback' => 'olesya_lite_sanitize_nohtml',
	) );

	$wp_customize->add_control(
		'sticky_label',
		array(
			'label'    		=> __( 'Sticky Label', 'olesya-lite' ),
			'section'  		=> 'blog_post',
			'settings' 		=> 'sticky_label',
			'type'     		=> 'text'
		)
	);

	$wp_customize->add_setting(
		'content_display',
		array(
			'default'           => 'the_excerpt',
			'sanitize_callback' => 'olesya_lite_sanitize_select',
	) );

	$wp_customize->add_control(
		'content_display',
		array(
			'label'    => __( 'Content Display', 'olesya-lite' ),
			'section'  => 'blog_post',
			'setting'  => 'content_display',
			'type'     => 'select',
			'choices'  => array(
				'the_content' 	=> esc_attr__( 'Content Full', 'olesya-lite' ),
				'the_excerpt' 	=> esc_attr__( 'Excerpt', 'olesya-lite' ),
			),
	) );

	$wp_customize->add_setting(
		'excerpt_length' ,
		 array(
		    'default' 			=> 40,
		    'sanitize_callback' => 'olesya_lite_sanitize_number_absint',
	) );

	$wp_customize->add_control(
		'excerpt_length',
		array(
			'label'    => __( 'Excerpt length', 'olesya-lite' ),
			'section'  => 'blog_post',
			'settings' => 'excerpt_length',
			'type'     => 'number',
		    'input_attrs' => array(
		        'min'   => 1,
		        'max'   => 9999,
		    )
		)
	);

	$wp_customize->add_setting(
		'posts_navigation',
		array(
			'default'           => 'posts_navigation',
			'sanitize_callback' => 'olesya_lite_sanitize_select'
	) );

	$wp_customize->add_control(
		'posts_navigation',
		array(
			'label'    => __( 'Post Pagination', 'olesya-lite' ),
			'section'  => 'blog_post',
			'setting'  => 'posts_navigation',
			'type'     => 'select',
			'choices'  => array(
				'posts_navigation' 	=> esc_attr__( 'Prev / Next', 'olesya-lite' ),
				'posts_pagination' 	=> esc_attr__( 'Numeric', 'olesya-lite' ),
			),
	) );

	// Instagram
	if ( function_exists( 'wpiw_init' ) ) {
		$wp_customize->add_section(
			'instragram_setting' ,
			array(
				'title' 			=> __( 'Instagram Footer', 'olesya-lite' ),
				'priority' 			=> 200,
				'panel'				=> 'theme_settings'
		) );

		$wp_customize->add_setting(
			'instagram_username' ,
			array(
			    'default' 			=> '',
			    'transport'			=> 'postMessage',
			    'sanitize_callback' => 'olesya_lite_sanitize_nohtml',
		) );

		$wp_customize->add_control(
			'instagram_username',
			array(
				'label'    		=> __( 'Instagram username', 'olesya-lite' ),
				'section'  		=> 'instragram_setting',
				'settings' 		=> 'instagram_username',
				'type'     		=> 'text'
			)
		);

		$wp_customize->add_setting(
			'instagram_number' ,
			 array(
			    'default' 			=> 8,
			    'transport'			=> 'postMessage',
			    'sanitize_callback' => 'olesya_lite_sanitize_number_absint',
		) );

		$wp_customize->add_control(
			'instagram_number',
			array(
				'label'    		=> __( 'Number of photos', 'olesya-lite' ),
				'description'  	=> __( 'This setting will set maximum number of the last Instagram photos. To set Instagram photo into carousel, please set the number of photos above 8.', 'olesya-lite' ),
				'section'  		=> 'instragram_setting',
				'settings' 		=> 'instagram_number',
				'type'     		=> 'number',
			    'input_attrs' 	=> array(
			        'min'   => 1,
			        'max'   => 99,
			    )
			)
		);

		$wp_customize->add_setting(
			'instagram_target',
			array(
				'default'           => '_blank',
				'sanitize_callback' => 'olesya_lite_sanitize_select',
				'transport'			=> 'postMessage',
		) );

		$wp_customize->add_control(
			'instagram_target',
			array(
				'label'    =>  __( 'Open Link In', 'olesya-lite' ),
				'section'  => 'instragram_setting',
				'setting'  => 'instagram_target',
				'type'     => 'select',
				'choices'  => array(
					'_self' 	=> esc_attr__( 'Current Window (_self)', 'olesya-lite' ),
					'_blank' 	=> esc_attr__( 'New Window (_blank)', 'olesya-lite' ),
				),
		) );

		$wp_customize->add_setting(
			'instagram_text_link' ,
			array(
			    'default' 			=> esc_attr__( 'Follow Me', 'olesya-lite' ),
			    'transport'			=> 'postMessage',
			    'sanitize_callback' => 'olesya_lite_sanitize_nohtml',
		) );

		$wp_customize->add_control(
			'instagram_text_link',
			array(
				'label'    		=> __( 'Text link to Instagram profile', 'olesya-lite' ),
				'section'  		=> 'instragram_setting',
				'settings' 		=> 'instagram_text_link',
				'type'     		=> 'text'
			)
		);

	}

    if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial(
			'enable_preloader',
			array(
				'selector' 				=> '.pre-preloader',
				'settings' 				=> array( 'enable_preloader' ),
				'render_callback' 		=> 'olesya_lite_do_preloader',
				'container_inclusive'	=> true,
		) );

		$instagram_settings = array (
			'instagram_username',
			'instagram_number',
			'instagram_target',
			'instagram_text_link'
		);

		foreach ( $instagram_settings as $instagram_setting ) {
			$wp_customize->selective_refresh->add_partial(
				$instagram_setting,
				array(
					'selector' 				=> '.instagram-footer',
					'settings' 				=> array( $instagram_setting ),
					'render_callback' 		=> 'olesya_lite_do_instagram_footer',
					'container_inclusive'	=> true,
			) );
		}

    }

}
add_action( 'customize_register', 'olesya_lite_customize_theme_register' );
