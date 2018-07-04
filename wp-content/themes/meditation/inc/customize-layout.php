<?php
/**
 * Add new fields to customizer for the theme layout.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Meditation 1.0.0
 */
 
add_action( 'customize_register', 'meditation_create_section_layout', 20 );

function meditation_create_section_layout( $wp_customize ) {
	$defaults = meditation_get_defaults();
		
	$wp_customize->add_panel( 'layout', array(
		'priority'       => 102,
		'title'          => __( 'Layout', 'meditation' ),
		'description'    => __( 'In this section you can change theme layout.', 'meditation' ),
	) );

	$section_priority = 10;
	$priority = 1;
	
	$wp_customize->add_section( 'size', array(
		'priority'       => $section_priority++,
		'title'          => __( 'Site size', 'meditation' ),
		'description'    => __( 'The width of the site.', 'meditation' ),
		'panel'  => 'layout',
	) );
	
//site width range + text	

	
	$wp_customize->add_setting( 'width_site', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['width_site'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'meditation_sanitize_range_width'
	) );

	$wp_customize->add_control( 'width_site', array(
		'label'      => __( 'Width of the site', 'meditation' ),
		'section'    => 'size',
		'settings'   => 'width_site',
		'type'       => 'text',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'width_site_range', array(
		'type'			 => 'empty',
		'default'        => meditation_get_theme_mod('width_site'),
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'width_site_range', array(
		'label'      => __( '(px)', 'meditation' ),
		'section'    => 'size',
		'settings'   => 'width_site_range',
		'type'       => 'range',
		'input_attrs' => array(
			'min'   => 960,
			'max'   => 2200,
			'step'  => 1,),
		'priority' => $priority++,
	));
	
//content area width range + text
	
	$wp_customize->add_setting( 'width_main_wrapper', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['width_main_wrapper'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'meditation_sanitize_range_content'
	) );

	$wp_customize->add_control( 'width_main_wrapper', array(
		'label'      => __( 'Width of the content area', 'meditation' ),
		'section'    => 'size',
		'settings'   => 'width_main_wrapper',
		'type'       => 'text',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'width_main_wrapper_range', array(
		'type'			 => 'empty',
		'default'        => meditation_get_theme_mod('width_main_wrapper'),
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'width_main_wrapper_range', array(
		'label'      => __( '(px)', 'meditation' ),
		'section'    => 'size',
		'settings'   => 'width_main_wrapper_range',
		'type'       => 'range',
		'priority' => $priority++,
		'input_attrs' => array(
			'min'   => 600,
			'max'   => 2200,
			'step'  => 1,
	) ));
	
	$wp_customize->add_setting( 'content_style', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['content_style'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_header_style'
	) );

	$wp_customize->add_control( 'content_style', array(
		'label'   => __( 'Content style', 'meditation' ),
		'section' => 'size',
		'settings'   => 'content_style',
		'type'       => 'select',
		'priority'   => $priority++,
		'choices'	 => array ('boxed' => __('Boxed', 'meditation'),
								'full' => __('Full Width', 'meditation'))
	) );	
	
	$wp_customize->add_setting( 'site_style', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['site_style'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_header_style'
	) );

	$wp_customize->add_control( 'site_style', array(
		'label'   => __( 'Website style', 'meditation' ),
		'section' => 'size',
		'settings'   => 'site_style',
		'type'       => 'select',
		'priority'   => $priority++,
		'choices'	 => array ('boxed' => __('Boxed', 'meditation'),
								'full' => __('Full Width', 'meditation'))
	) );
	
//Featured Image

	$wp_customize->add_section( 'post_thumbnail_size', array(
		'priority'       => $section_priority++,
		'title'          => __( 'Featured Image', 'meditation' ),
		'description'    => __( 'Image Size', 'meditation' ),
		'panel'  => 'layout',
	) );	
	
	$wp_customize->add_setting( 'post_thumbnail_size', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['post_thumbnail_size'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'post_thumbnail_size', array(
		'label'      => __( 'Width of the Featured Image (Images should be updated with Regenerate Thumbnails plugin).', 'meditation' ),
		'section'    => 'post_thumbnail_size',
		'settings'   => 'post_thumbnail_size',
		'type'       => 'number',
		'priority'       => $priority++,
	) );

	
//Columns width

	$wp_customize->add_section( 'columns', array(
		'priority'       => $section_priority++,
		'title'          => __( 'Columns', 'meditation' ),
		'description'    => __( 'Size of columns', 'meditation' ),
		'panel'  => 'layout',
	) );	
	
//in %
	
	$wp_customize->add_setting( 'width_column_1_rate', array(
		'type'			 => 'theme_mod',
		'default'        => meditation_get_theme_mod('width_column_1_rate'),
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'meditation_sanitize_range_column_rate'
	) );
	
	$wp_customize->add_control( 'width_column_1_rate', array(
		'label'      => __( 'Width of the first column (in case of two sidebars)', 'meditation' ),
		'section'    => 'columns',
		'settings'   => 'width_column_1_rate',
		'type'       => 'text',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'width_column_1_range_rate', array(
		'type'			 => 'empty',
		'default'        => meditation_get_theme_mod('width_column_1_rate'),
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'width_column_1_range_rate', array(
		'label'      => __( '(%)', 'meditation' ),
		'section'    => 'columns',
		'settings'   => 'width_column_1_range_rate',
		'type'       => 'range',
		'priority' => $priority++,
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 50,
			'step'  => 1,
	) ));
	
//column 2	
	$wp_customize->add_setting( 'width_column_2_rate', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['width_column_2_rate'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'meditation_sanitize_range_column_rate'
	) );
	
	$wp_customize->add_control( 'width_column_2_rate', array(
		'label'      => __( 'Width of the second column (two sidebars layout)', 'meditation' ),
		'section'    => 'columns',
		'settings'   => 'width_column_2_rate',
		'type'       => 'text',
		'priority'       => $priority++,
	) );
	$wp_customize->add_setting( 'width_column_2_range_rate', array(
		'type'			 => 'empty',
		'default'        => meditation_get_theme_mod('width_column_2_rate'),
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'width_column_2_range_rate', array(
		'label'      => __( '(%)', 'meditation' ),
		'section'    => 'columns',
		'settings'   => 'width_column_2_range_rate',
		'type'       => 'range',
		'priority' => $priority++,
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 50,
			'step'  => 1,
	) ));
	
	$wp_customize->add_setting( 'width_column_1_left_rate', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['width_column_1_left_rate'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'meditation_sanitize_range_column_rate'
	) );
	
	$wp_customize->add_control( 'width_column_1_left_rate', array(
		'label'      => __( 'Width of the left column (1 sidebar layout)', 'meditation' ),
		'section'    => 'columns',
		'settings'   => 'width_column_1_left_rate',
		'type'       => 'text',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'width_column_1_left_range_rate', array(
		'type'			 => 'empty',
		'default'        => meditation_get_theme_mod('width_column_1_left_rate'),
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'width_column_1_left_range_rate', array(
		'label'      => __( '(%)', 'meditation' ),
		'section'    => 'columns',
		'settings'   => 'width_column_1_left_range_rate',
		'type'       => 'range',
		'priority' => $priority++,
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 50,
			'step'  => 1,
	) ));
	
	$wp_customize->add_setting( 'width_column_1_right_rate', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['width_column_1_right_rate'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'meditation_sanitize_range_column_rate'
	) );
	
	$wp_customize->add_control( 'width_column_1_right_rate', array(
		'label'      => __( 'Width of the right column (1 sidebar layout)', 'meditation' ),
		'section'    => 'columns',
		'settings'   => 'width_column_1_right_rate',
		'type'       => 'text',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'width_column_1_right_range_rate', array(
		'type'			 => 'empty',
		'default'        => meditation_get_theme_mod('width_column_1_right_rate'),
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'width_column_1_right_range_rate', array(
		'label'      => __( '(%)', 'meditation' ),
		'section'    => 'columns',
		'settings'   => 'width_column_1_right_range_rate',
		'type'       => 'range',
		'priority' => $priority++,
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 50,
			'step'  => 1,
	) ));
	
/* Home */
	$wp_customize->add_setting( 'front_page_style', array(
		'default'        => $defaults['front_page_style'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );
	
	$wp_customize->add_setting( 'is_home_footer', array(
		'default'        => $defaults['is_home_footer'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'is_home_footer', array(
		'label'      => __( 'Display the footer on the front page', 'meditation' ),
		'section'    => 'layout_home',
		'settings'   => 'is_home_footer',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );

/* layout_post */

	$wp_customize->add_section( 'layout_post', array(
		'priority'       => $section_priority++,
		'title'          => __( 'Post', 'meditation' ),
		'description'    => __( 'Post settings.', 'meditation' ),
		'panel'  => 'layout',
	) );	
	
	$wp_customize->add_setting( 'single_style', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['single_style'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_display_choices'
	) );

	$wp_customize->add_control( 'single_style', array(
		'label'   => __( 'Post style', 'meditation' ),
		'section' => 'layout_blog',
		'settings'   => 'single_style',
		'type'       => 'select',
		'priority'   => $priority++,
		'choices'	 => meditation_display_choices(),
	) );

	
	/* blog */
	$wp_customize->add_setting( 'read_more_text', array(
		'default'        => $defaults['read_more_text'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_kses'
	) );

	$wp_customize->add_control( 'read_more_text', array(
		'label'      => __( 'Button "Read More" Text', 'meditation' ),
		'section'    => 'layout_blog',
		'settings'   => 'read_more_text',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'is_thumbnail_empty_icon', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['is_thumbnail_empty_icon'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_thumbnail_empty_icon', array(
		'label'      => __( 'Display an empty icon', 'meditation' ),
		'section'    => 'layout_blog',
		'settings'   => 'is_thumbnail_empty_icon',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'blog_is_author', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['blog_is_author'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'blog_is_author', array(
		'label'      => __( 'Display the post author', 'meditation' ),
		'section'    => 'layout_blog',
		'settings'   => 'blog_is_author',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'blog_is_date', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['blog_is_date'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'blog_is_date', array(
		'label'      => __( 'Display the post date', 'meditation' ),
		'section'    => 'layout_blog',
		'settings'   => 'blog_is_date',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'blog_is_views', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['blog_is_views'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'blog_is_views', array(
		'label'      => __( 'Display the post views (from Jatpack plugin)', 'meditation' ),
		'section'    => 'layout_blog',
		'settings'   => 'blog_is_views',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'blog_is_comments', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['blog_is_comments'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'blog_is_comments', array(
		'label'      => __( 'Display the link to post comments', 'meditation' ),
		'section'    => 'layout_blog',
		'settings'   => 'blog_is_comments',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'blog_is_entry_meta', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['blog_is_entry_meta'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'blog_is_entry_meta', array(
		'label'      => __( 'Display meta text', 'meditation' ),
		'section'    => 'layout_blog',
		'settings'   => 'blog_is_entry_meta',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'is_display_post_image', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['is_display_post_image'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_display_post_image', array(
		'label'      => __( 'Display Featured Image', 'meditation' ),
		'section'    => 'layout_post',
		'settings'   => 'is_display_post_image',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'is_display_post_cat', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['is_display_post_cat'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_display_post_cat', array(
		'label'      => __( 'Display Category List', 'meditation' ),
		'section'    => 'layout_post',
		'settings'   => 'is_display_post_cat',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'is_display_post_tags', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['is_display_post_tags'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_display_post_tags', array(
		'label'      => __( 'Display Tag List', 'meditation' ),
		'section'    => 'layout_post',
		'settings'   => 'is_display_post_tags',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'is_author', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['is_author'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_author', array(
		'label'      => __( 'Display the author', 'meditation' ),
		'section'    => 'layout_post',
		'settings'   => 'is_author',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'is_date', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['is_date'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_date', array(
		'label'      => __( 'Display the post date', 'meditation' ),
		'section'    => 'layout_post',
		'settings'   => 'is_date',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'is_views', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['is_views'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_views', array(
		'label'      => __( 'Display views (from Jatpack plugin)', 'meditation' ),
		'section'    => 'layout_post',
		'settings'   => 'is_views',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
	
	$wp_customize->add_setting( 'is_comments', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['is_comments'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'is_comments', array(
		'label'      => __( 'Display link to comments', 'meditation' ),
		'section'    => 'layout_post',
		'settings'   => 'is_comments',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );

/* layout_page */
	
	$wp_customize->add_setting( 'page_style', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['page_style'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_display_choices'
	) );

	$wp_customize->add_control( 'page_style', array(
		'label'   => __( 'Page style', 'meditation' ),
		'section' => 'layout_search',
		'settings'   => 'page_style',
		'type'       => 'select',
		'priority'   => $priority++,
		'choices'	 => meditation_display_choices(),
	) );
	
	$wp_customize->add_setting( 'is_display_page_image', array(
		'type'			 => 'theme_mod',
		'default'        => $defaults['is_display_page_image'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );
	
	$wp_customize->add_control( 'is_display_page_image', array(
		'label'      => __( 'Display Featured Image', 'meditation' ),
		'section'    => 'layout_page',
		'settings'   => 'is_display_page_image',
		'type'       => 'checkbox',
		'priority'       => $priority++,
	) );
}

/**
 * Return how to display content in archive
 *
 * @return array choices.
 * @since Meditation 1.0.0
 */
function meditation_display_choices() {
	return array ('excerpt' => __('Excerpt', 'meditation'),
			'content' => __('Content', 'meditation'),
			'none' => __('No Content', 'meditation'),
			);
}
/**
 * Sanitize display layouts
 *
 * @return array choices.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_display_choices( $value) {
	return ( array_key_exists( $value, meditation_display_choices() ) ? $value : 'none' );
}

/**
 * Return all possible layouts
 *
 * @return array choices.
 * @since Meditation 1.0.0
 */
function meditation_layout_choices() {
	$choices = array ('no-sidebar' => __('Full Width', 'meditation'),
			'left-sidebar' => __('Left Column', 'meditation'),
			'right-sidebar' => __('Right Column', 'meditation'),
			'two-sidebars' => __('Two Columns', 'meditation'));
			
	return apply_filters( 'meditation_layouts', $choices);
}

/**
 * Return all possible layouts
 *
 * @return array choices.
 * @since Meditation 1.0.0
 */
function meditation_layout_choices_content() {
	$choices = array ('flex-layout-1' => __('1 column', 'meditation'),
			'flex-layout-2' => __('2 columns', 'meditation'),
			'flex-layout-3' => __('3 columns', 'meditation'),
			'flex-layout-4' => __('4 columns', 'meditation'));
			
	return apply_filters( 'meditation_layouts', $choices);
}
/**
 * Sanitize sidebar layouts
 *
 * @return array choices.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_layout_choices( $value) {
	return ( array_key_exists( $value, meditation_layout_choices() ) ? $value : 'no-columns' );
}

/**
 * Sanitize content layouts 
 *
 * @return array choices.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_layout_choices_content( $value) {
	return ( array_key_exists( $value, meditation_layout_choices_content() ) ? $value : 'no-columns' );
}
/**
 * Sanitize range.
 *
 * @param string $value Value to sanitize. 
 * @return int sanitized value.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_range_content( $value ) {
	$defaults = meditation_get_defaults();
	return meditation_sanitize_range($value, 600, 2200, $defaults['width_image']);
} 

/**
 * Sanitize range.
 *
 * @param string $value Value to sanitize. 
 * @return int sanitized value.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_range_image( $value ) {
	$defaults = meditation_get_defaults();
	return meditation_sanitize_range($value, 50, 2200, $defaults['width_image']);
} 
/**
 * Sanitize range.
 *
 * @param string $value Value to sanitize. 
 * @return int sanitized value.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_range_column( $value ) {
	$defaults = meditation_get_defaults();
	return meditation_sanitize_range($value, 90, 600, $defaults['width_column_1']);
}

/**
 * Sanitize range.
 *
 * @param string $value Value to sanitize. 
 * @return int sanitized value.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_range_column_rate( $value ) {
	$defaults = meditation_get_defaults();
	return meditation_sanitize_range($value, 10, 50, $defaults['width_column_1_rate']);
} 
/**
 * Sanitize range.
 *
 * @param string $value Value to sanitize. 
 * @return int sanitized value.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_range_width( $value ) {
	$defaults = meditation_get_defaults();
	return meditation_sanitize_range($value, 960, 2200, $defaults['width_site']);
} 
/**
 * Sanitize range.
 *
 * @param string $value Value to sanitize. 
 * @param int $min minimal value. 
 * @param int $max maximal value. 
 * @param int $def default value. 
 * @return int sanitized value.
 * @since Meditation 1.0.0
 */
function meditation_sanitize_range( $value, $min, $max, $def ) {
	$x = absint( $value );
	return ( $x >= $min && $x <= $max ? $x : $def );
} 
/**
 * Return string Sanitized header style
 *
 * @since Meditation 1.0.0
 */
function meditation_sanitize_header_style( $value ) {
	$defaults = meditation_get_defaults();
	$possible_values = array( 'boxed', 'full');
	return ( in_array( $value, $possible_values ) ? $value : $defaults['header_style'] );
}

/**
 * Class to store and create layouts for different types of pages
 *
 * @since Meditation 1.0.0
 */

class meditation_Layout_Class {

	private $layout = array();
	private $curr_layout = null;
	private $curr_content_layout = null;
	
	function __construct() {
		$i = 0;
	
		$this->layout[$i]['name'] = 'layout_home';
		$this->layout[$i]['callback'] = 'is_front_page';
		$this->layout[$i]['val'] = 'left-sidebar';
		$this->layout[$i]['is_has_content_section'] = false;
		$this->layout[$i]['content_val'] = 'flex-layout-2';
		$this->layout[$i]['text'] = __('Home', 'meditation');
		
		$i++;
		$this->layout[$i]['name'] = 'layout_blog';
		$this->layout[$i]['callback'] = 'is_home';
		$this->layout[$i]['val'] = 'left-sidebar';
		$this->layout[$i]['is_has_content_section'] = true;
		$this->layout[$i]['content_val'] = 'flex-layout-2';
		$this->layout[$i]['text'] = __('Blog', 'meditation');
		
		$i++;
		$this->layout[$i]['name'] = 'layout_search';
		$this->layout[$i]['callback'] = 'is_search';
		$this->layout[$i]['val'] = 'no-sidebar';
		$this->layout[$i]['is_has_content_section'] = true;
		$this->layout[$i]['content_val'] = 'flex-layout-3';
		$this->layout[$i]['text'] = __('Search', 'meditation');
		
		if ( class_exists( 'WooCommerce' ) ) {
			$i++;
			$this->layout[$i]['name'] = 'layout_shop';
			$this->layout[$i]['callback'] = 'meditation_is_shop';
			$this->layout[$i]['val'] = 'no-sidebar';
			$this->layout[$i]['is_has_content_section'] = false;
			$this->layout[$i]['content_val'] = 'flex-layout-3';
			$this->layout[$i]['text'] = __('Shop', 'meditation');
			
			$i++;
			$this->layout[$i]['name'] = 'layout_shop-page';
			$this->layout[$i]['callback'] = 'meditation_is_shop_page';
			$this->layout[$i]['val'] = 'left-sidebar';
			$this->layout[$i]['is_has_content_section'] = false;
			$this->layout[$i]['content_val'] = '';
			$this->layout[$i]['text'] = __('Shop Page', 'meditation');	
		}
		
		$i++;
		$this->layout[$i]['name'] = 'layout_page';
		$this->layout[$i]['callback'] = 'is_page';
		$this->layout[$i]['val'] = 'left-sidebar';
		$this->layout[$i]['is_has_content_section'] = false;
		$this->layout[$i]['content_val'] = 'flex-layout-1';
		$this->layout[$i]['text'] = __('Page', 'meditation');
		
		$i++;
		$this->layout[$i]['name'] = 'layout_archive';
		$this->layout[$i]['callback'] = 'is_archive';
		$this->layout[$i]['val'] = 'no-sidebar';
		$this->layout[$i]['is_has_content_section'] = true;
		$this->layout[$i]['content_val'] = 'flex-layout-3';
		$this->layout[$i]['text'] = __('Archive', 'meditation');
		
		$i++;
		$this->layout[$i]['name'] = 'layout_default';
		$this->layout[$i]['callback'] = '';
		$this->layout[$i]['val'] = 'left-sidebar';
		$this->layout[$i]['is_has_content_section'] = false;
		$this->layout[$i]['content_val'] = 'flex-layout-1';
		$this->layout[$i]['text'] = __('Post (Default)', 'meditation');
		
		$this->layout = apply_filters_ref_array( 'meditation_layout', array( &$this->layout ) );
			
		add_action( 'customize_register', array( $this, 'meditation_create_layout_controls' ), 21 );
		add_action( 'meditation_option_defaults', array( $this, 'meditation_add_defaults' ) );

	}
	
	/* Set current layouts into variables */
	
	function find_layout() {
		foreach( $this->layout as $id => $values ) {

		if( '' == $values['callback']) {
				$this->curr_layout = apply_filters( 'sgwinow_layout', get_theme_mod( $values['name'], $values['val'] ) );
				$this->curr_content_layout = apply_filters( 'sgwinow_layout_content', get_theme_mod( $values['name'].'_content', $values['content_val'] ) );
				break;
			}
			else if( call_user_func( $values['callback'] ) ) {
				$this->curr_layout = apply_filters( 'sgwinow_layout', get_theme_mod( $values['name'], $values['val'] ) );
				$this->curr_content_layout = apply_filters( 'sgwinow_layout_content', get_theme_mod( $values['name'].'_content', $values['content_val'] ) );
				break;
			}
			
		}
	}
	
	/* Return current layout */
	
	public function get_layout( ) {
		
		if( isset($this->curr_layout) )
			return $this->curr_layout;
	
		$this->find_layout();

		return $this->curr_layout;
	}
	
	/* Return current content layout */
	
	public function get_content_layout( ) {
		
		if( isset($this->curr_content_layout) )
			return $this->curr_content_layout;
		
		$this->find_layout();

		return $this->curr_layout;
	}
	
	/* Add values to defaults array */
	
	function meditation_add_defaults( $defaults ) {
	
		foreach( $this->layout as $id => $values ) {

			$defaults[ $values['name'] ] = $values['val'];
			$defaults[ $values['name'].'_content' ] = $values['content_val'];
			
		}

		return $defaults;
	}
	
	/* Create all sections and controls in the Customizer for layouts */
	
	function meditation_create_layout_controls( $wp_customize ) {
	
		$section_priority = 99; //add to the end of the layout panel
		
		foreach( $this->layout as $id => $values ) {
			$priority = 1;
			$section_priority++;
		
			$wp_customize->add_section( $values['name'], array(
				'priority'       => $section_priority,
				'title'          => $values['text'],
				'description'    => __( 'Layout settings for ', 'meditation' ) . ' ' . $values['text'],
				'panel'  => 'layout',
			) );	

			$wp_customize->add_setting( $values['name'], array(
				'type'			 => 'theme_mod',
				'default'        => $values['val'],
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'meditation_sanitize_layout_choices'
			) );

			$wp_customize->add_control( $values['name'], array(
				'label'   => $values['text'] . ' ' . __( ' layout', 'meditation' ),
				'section' => $values['name'],
				'settings'   => $values['name'],
				'type'       => 'select',
				'priority'   => $priority++,
				'choices'	 => meditation_layout_choices(),
			) );
			
			if( $values['is_has_content_section'] ) {
			
				$wp_customize->add_setting( $values['name'].'_content', array(
					'type'			 => 'theme_mod',
					'default'        => $values['content_val'],
					'capability'     => 'edit_theme_options',
					'sanitize_callback' => 'meditation_sanitize_layout_choices_content'
				) );

				$wp_customize->add_control( $values['name'].'_content', array(
					'label'   =>  $values['text'] . ' ' . __( ' layout (content)', 'meditation' ),
					'section' => $values['name'],
					'settings'   => $values['name'].'_content',
					'type'       => 'select',
					'priority'   => $priority++,
					'choices'	 => meditation_layout_choices_content(),
				) );
			}
		}
	}
}