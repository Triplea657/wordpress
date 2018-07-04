<?php
/**
 * Add new fields to customizer to choose a font
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Meditation 1.0.0
 */
add_action( 'customize_register', 'meditation_customize_register_fonts' );
function meditation_customize_register_fonts( $wp_customize ) {

	$defaults = meditation_get_defaults();
	
	$wp_customize->add_panel( 'fonts', array(
		'priority'       => 105,
		'title'          => __( 'Fonts', 'meditation' ),
		'description'    => __( 'Choosing google fonts.', 'meditation' ),
	) );

	$section_priority = 10;
	
//New section in customizer: Fonts
	$wp_customize->add_section( 'fonts', array(
		'title'          => __( 'Google Fonts', 'meditation' ),
		'description'    => __( 'Copy and paste any Font Name from fonts.google.com', 'meditation' ),
		'priority'       => $section_priority++,
		'panel'  => 'fonts',
	) );

//Font 1
	$wp_customize->add_setting( 'font_1', array(
		'default'        => $defaults['font_1'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	
	$wp_customize->add_control( 'font_1', array(
		'label'      => __( 'Font-1 Name', 'meditation' ),
		'section'    => 'fonts',
		'settings'   => 'font_1',
		'type'       => 'text',
		'priority'       => 10,
	) );
	
	$wp_customize->add_setting( 'font_1_select', array(
		'type'			 => 'empty',
		'default'        => meditation_get_theme_mod('font_1'),
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'font_1_select', array(
		'label'   => '',
		'section' => 'fonts',
		'settings'   => 'font_1_select',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_choices(),
	) );
	
//Font 2
	$wp_customize->add_setting( 'font_2', array(
		'default'        => $defaults['font_2'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	
	$wp_customize->add_control( 'font_2', array(
		'label'   => __( 'Font-2 Name', 'meditation' ),
		'section' => 'fonts',
		'settings'   => 'font_2',
		'priority'   => 20,
		'choices'	 => meditation_get_font_choices(),
	) );
	
	$wp_customize->add_setting( 'font_2_select', array(
		'type'			 => 'empty',
		'default'        => meditation_get_theme_mod('font_2'),
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'font_2_select', array(
		'label'   => '',
		'section' => 'fonts',
		'settings'   => 'font_2_select',
		'type'       => 'select',
		'priority'   => 21,
		'choices'	 => meditation_get_font_choices(),
	) );	
	
//Font 3
	$wp_customize->add_setting( 'font_3', array(
		'default'        => $defaults['font_3'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'font_3', array(
		'label'   => __( 'Font-3 Name', 'meditation' ),
		'section' => 'fonts',
		'settings'   => 'font_3',
		'priority'   => 30,
		'choices'	 => meditation_get_font_choices(),
	) );
	
	$wp_customize->add_setting( 'font_3_select', array(
		'type'			 => 'empty',
		'default'        => meditation_get_theme_mod('font_3'),
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'font_3_select', array(
		'label'   => '',
		'section' => 'fonts',
		'settings'   => 'font_3_select',
		'type'       => 'select',
		'priority'   => 31,
		'choices'	 => meditation_get_font_choices(),
	) );
//Subsets for fonts
	$wp_customize->add_setting( 'subset_cyrillic', array(
		'default'        => $defaults['subset_cyrillic'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'subset_cyrillic', array(
		'label'      => __( 'Add cyrillic subset', 'meditation' ),
		'section'    => 'fonts',
		'settings'   => 'subset_cyrillic',
		'type'       => 'checkbox',
		'priority'   => 42,
	) );
	$wp_customize->add_setting( 'subset_greek', array(
		'default'        => $defaults['subset_greek'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'subset_greek', array(
		'label'      => __( 'Add greek subset', 'meditation' ),
		'section'    => 'fonts',
		'settings'   => 'subset_greek',
		'type'       => 'checkbox',
		'priority'   => 43,
	) );	
	$wp_customize->add_setting( 'subset_vietnamese', array(
		'default'        => $defaults['subset_vietnamese'],
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'meditation_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'subset_vietnamese', array(
		'label'      => __( 'Add vietnamese subset', 'meditation' ),
		'section'    => 'fonts',
		'settings'   => 'subset_vietnamese',
		'type'       => 'checkbox',
		'priority'   => 44,
	) );
	
//New section in customizer: Fonts
	$wp_customize->add_section( 'fonts_theme', array(
		'title'          => __( 'Google Fonts in Theme', 'meditation' ),
		'description'    => __( 'Apply Google Fonts to the theme', 'meditation' ),
		'priority'       => $section_priority++,
		'panel'  => 'fonts',
	) );
	
//site_font
	$wp_customize->add_setting( 'site_font', array(
		'default'        => $defaults['site_font'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'site_font', array(
		'label'   => __( 'Main Font', 'meditation' ),
		'section' => 'fonts_theme',
		'settings'   => 'site_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_variants(),
	) );
	
//header_font
	$wp_customize->add_setting( 'header_font', array(
		'default'        => $defaults['header_font'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'header_font', array(
		'label'   => __( 'Header', 'meditation' ),
		'section' => 'fonts_theme',
		'settings'   => 'header_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_variants(),
	) );
	
//description_font
	$wp_customize->add_setting( 'description_font', array(
		'default'        => $defaults['description_font'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'description_font', array(
		'label'   => __( 'Description', 'meditation' ),
		'section' => 'fonts_theme',
		'settings'   => 'description_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_variants(),
	) );
	
//menu_font
	$wp_customize->add_setting( 'menu_font', array(
		'default'        => $defaults['menu_font'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'menu_font', array(
		'label'   => __( 'Menu', 'meditation' ),
		'section' => 'fonts_theme',
		'settings'   => 'menu_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_variants(),
	) );
	
//submenu_font
	$wp_customize->add_setting( 'submenu_font', array(
		'default'        => $defaults['submenu_font'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'submenu_font', array(
		'label'   => __( 'Sub Menu', 'meditation' ),
		'section' => 'fonts_theme',
		'settings'   => 'submenu_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_variants(),
	) );
	
//title_font
	$wp_customize->add_setting( 'title_font', array(
		'default'        => $defaults['title_font'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'title_font', array(
		'label'   => __( 'H1-H6 Headings', 'meditation' ),
		'section' => 'fonts_theme',
		'settings'   => 'title_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_variants(),
	) );
	
//link_font
	$wp_customize->add_setting( 'link_font', array(
		'default'        => $defaults['link_font'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'link_font', array(
		'label'   => __( 'Link', 'meditation' ),
		'section' => 'fonts_theme',
		'settings'   => 'link_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_variants(),
	) );
	
//cat_font
	$wp_customize->add_setting( 'cat_font', array(
		'default'        => $defaults['cat_font'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'cat_font', array(
		'label'   => __( 'Category and Tags', 'meditation' ),
		'section' => 'fonts_theme',
		'settings'   => 'cat_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_variants(),
	) );
	
//meta_font
	$wp_customize->add_setting( 'meta_font', array(
		'default'        => $defaults['meta_font'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'meta_font', array(
		'label'   => __( 'Meta Data', 'meditation' ),
		'section' => 'fonts_theme',
		'settings'   => 'meta_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_variants(),
	) );
	
//widget_font
	$wp_customize->add_setting( 'w_font', array(
		'default'        => $defaults['w_font'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'w_font', array(
		'label'   => __( 'Widget', 'meditation' ),
		'section' => 'fonts_theme',
		'settings'   => 'w_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_variants(),
	) );
	
//widget_title_font
	$wp_customize->add_setting( 'w_title_font', array(
		'default'        => $defaults['w_title_font'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'w_title_font', array(
		'label'   => __( 'Widget Title', 'meditation' ),
		'section' => 'fonts_theme',
		'settings'   => 'w_title_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_variants(),
	) );
	
//widget_link_font
	$wp_customize->add_setting( 'w_link_font', array(
		'default'        => $defaults['w_link_font'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'w_link_font', array(
		'label'   => __( 'Widget Link', 'meditation' ),
		'section' => 'fonts_theme',
		'settings'   => 'w_link_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => meditation_get_font_variants(),
	) );
	
//New section in customizer: Reset
	$wp_customize->add_section( 'reset', array(
		'title'          => __( 'Font Schemes', 'meditation' ),
		'description'          => __( 'Default Font Scheme', 'meditation' ),
		'priority'       => 1,
		'panel'  => 'fonts',
	) );
	
//description_font
	$wp_customize->add_setting( 'reset_font', array(
		'default'        => $defaults['font_scheme'],
		'capability'     => 'edit_theme_options',
		'transport'		 => 'postMessage',
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'reset_font', array(
		'label'   => __( 'Fonts', 'meditation' ),
		'section' => 'reset',
		'settings'   => 'reset_font',
		'type'       => 'select',
		'priority'   => 11,
		'choices'	 => array(0 => __('Hand Type', 'meditation' ),
							1 => __('Lato', 'meditation' ), 
							2 => __('Main', 'meditation' ), 
							3 => __('Narrow 1', 'meditation' ), 
							4 => __('Thin', 'meditation' ), 
							5 => __('Wider', 'meditation' ), 
							6 => __('Narrow 2', 'meditation' ), 
							7 => __('Spectral', 'meditation' )),
	) );
}

/**
 * Sanitize a font choice.
 *
 * @param string $value The font choice.
 * @return string Google Fonts.
 *
 * @since Meditation 1.0.0
 */
function meditation_sanitize_font_choice( $value ) {
	if ( '0' == $value ) {
		return '0';
	} else if ( array_key_exists( $value, meditation_get_font_choices() ) ) {
		return $value;
	} else {
		return 'Open Sans';
	}
}

/**
 * Return choices of Google Fonts for customizer.
 *
 * @return array Google Fonts.
 *
 * @since Meditation 1.0.0
 */
function meditation_get_font_choices() {
	$fonts = meditation_get_google_fonts();
	$out = array();
	foreach ( $fonts as $id => $font ) {
		$out[ $id ]= $font['label'];
	}
	return $out;
}
if ( ! function_exists( 'meditation_get_google_fonts' ) ) :
/**
 * Return an array of all available Google Fonts.
 *
 * @return array Google Fonts.
 *
 * @since Meditation 1.0.0
 */
function meditation_get_google_fonts() {
	return array(
		0 => array(
			'label'    => __( 'None', 'meditation' ), 
		),		
		'Pangolin' => array(
			'label'    => 'Pangolin',
			'variants' => array(
				'regular',
			),
			'subsets' => array(
				'latin',
			),
		),
		'Spectral' => array(
			'label'    => 'Spectral',
			'variants' => array(
				'regular',
			),
			'subsets' => array(
				'latin',
			),
		),
		'Lato' => array(
			'label'    => 'Lato',
			'variants' => array(
				'100',
				'100italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'700',
				'700italic',
				'900',
				'900italic',
			),
			'subsets' => array(
				'latin',
			),
		),
		'Open Sans' => array(
			'label'    => 'Open Sans',
			'variants' => array(
				'300',
				'300italic',
				'regular',
				'italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'800',
				'800italic',
			),
			'subsets' => array(
				'latin',
				'greek-ext',
				'cyrillic',
				'greek',
				'vietnamese',
				'latin-ext',
				'devanagari',
				'cyrillic-ext',
			),
		),
		
		'Slabo' => array(
			'label'    => 'Slabo',
			'variants' => array(
				'regular',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
		
		'Oswald' => array(
			'label'    => 'Oswald',
			'variants' => array(
				'300',
				'regular',
				'700',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
		
		'Overpass' => array(
			'label'    => 'Overpass',
			'variants' => array(
				'regular',
			),
			'subsets' => array(
				'latin',
			),
		),
		
		'Source Sans Pro' => array(
			'label'    => 'Source Sans Pro',
			'variants' => array(
				'200',
				'200italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'600',
				'600italic',
				'700',
				'700italic',
				'900',
				'900italic',
			),
			'subsets' => array(
				'latin',
				'vietnamese',
				'latin-ext',
			),
		),
		
	'Roboto' => array(
			'label'    => 'Roboto',
			'variants' => array(
				'100',
				'100italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
				'900',
				'900italic',
			),
			'subsets' => array(
				'latin',
				'greek-ext',
				'cyrillic',
				'greek',
				'vietnamese',
				'latin-ext',
				'cyrillic-ext',
			),
		),
		'Roboto Condensed' => array(
			'label'    => 'Roboto Condensed',
			'variants' => array(
				'300',
				'300italic',
				'regular',
				'italic',
				'700',
				'700italic',
			),
			'subsets' => array(
				'latin',
				'greek-ext',
				'cyrillic',
				'greek',
				'vietnamese',
				'latin-ext',
				'cyrillic-ext',
			),
		),
		
		'Droid Serif' => array(
			'label'    => 'Droid Serif',
			'variants' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
			'subsets' => array(
				'latin',
			),
		),
		'Montserrat' => array(
			'label'    => 'Montserrat',
			'variants' => array(
				'regular',
				'700',
			),
			'subsets' => array(
				'latin',
			),
		),
		
		'Bubbler One' => array(
			'label'    => 'Bubbler One',
			'variants' => array(
				'regular',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
		
		'Inconsolata' => array(
			'label'    => 'Inconsolata',
			'variants' => array(
				'regular',
				'700',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
		'Indie Flower' => array(
			'label'    => 'Indie Flower',
			'variants' => array(
				'regular',
			),
			'subsets' => array(
				'latin',
			),
		),
		'PT Sans Narrow' => array(
			'label'    => 'PT Sans Narrow',
			'variants' => array(
				'regular',
				'700',
			),
			'subsets' => array(
				'latin',
				'cyrillic',
				'latin-ext',
				'cyrillic-ext',
			),
		),
		'Lobster' => array(
			'label'    => 'Lobster',
			'variants' => array(
				'regular',
			),
			'subsets' => array(
				'latin',
				'cyrillic',
				'latin-ext',
				'cyrillic-ext',
			),
		),
		'Arvo' => array(
			'label'    => 'Arvo',
			'variants' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
			'subsets' => array(
				'latin',
			),
		),
		'Tangerine' => array(
			'label'    => 'Tangerine',
			'variants' => array(
				'regular',
				'700',
			),
			'subsets' => array(
				'latin',
			),
		),
		'Josefin Sans' => array(
			'label'    => 'Josefin Sans',
			'variants' => array(
				'100',
				'100italic',
				'300',
				'300italic',
				'regular',
				'italic',
				'600',
				'600italic',
				'700',
				'700italic',
			),
			'subsets' => array(
				'latin',
			),
		),
	);
}
endif;

 /**
 * Font schemes
 *
 * @since Meditation 1.0.0
*/
function meditation_get_font( $scheme_id ) {
		
	switch ( $scheme_id ) {
		
	case 0: return array ('font_1' => 'Open Sans',
						  'font_1_select' => 'Open Sans',
				'font_2' => 'Indie Flower',
				'font_2_select' => 'Indie Flower',
				'font_3' => 'Tangerine',
				'font_3_select' => 'Tangerine',
				'site_font' => 1,
				'header_font' => 2,
				'description_font' => 3,
				'menu_font' => 1,
				'submenu_font' => 1,
				'title_font' => 2,
				'link_font' => 1,
				'cat_font' => 1,
				'meta_font' => 1,
				'w_font' => 1,
				'w_title_font' => 2,
				'w_link_font' => 1);
	case 1: return array ('font_1' => 'Lato',
				'font_1_select' => 'Lato',
				'font_2' => '',
				'font_2_select' => '0',
				'font_3' => '',	
				'font_3_select' => '0',
				'site_font' => 1,
				'header_font' => 1,
				'description_font' => 1,
				'menu_font' => 1,
				'submenu_font' => 1,
				'title_font' => 1,
				'link_font' => 1,
				'cat_font' => 1,
				'meta_font' => 1,
				'w_font' => 1,
				'w_title_font' => 1,
				'w_link_font' => 1 );
	case 2: return array ('font_1' => 'Open Sans',
				'font_1_select' => 'Open Sans',
				'font_2' => 'Pangolin',
				'font_2_select' => 'Pangolin',
				'font_3' => 'Tangerine',	
				'font_3_select' => 'Tangerine',
				'site_font' => 1,
				'header_font' => 2,
				'description_font' => 3,
				'menu_font' => 2,
				'submenu_font' => 1,
				'title_font' => 2,
				'link_font' => 2,
				'cat_font' => 2,
				'meta_font' => 1,
				'w_font' => 1,
				'w_title_font' => 2,
				'w_link_font' => 1);
	case 3: return array ('font_1' => 'Lato',
				'font_1_select' => 'Lato',
				'font_2' => 'PT Sans Narrow',
				'font_2_select' => 'PT Sans Narrow',
				'font_3' => 'Tangerine',	
				'font_3_select' => 'Tangerine',
				'site_font' => 1,
				'header_font' => 2,
				'description_font' => 3,
				'menu_font' => 2,
				'submenu_font' => 1,
				'title_font' => 2,
				'link_font' => 2,
				'cat_font' => 2,
				'meta_font' => 1,
				'w_font' => 1,
				'w_title_font' => 2,
				'w_link_font' => 1);
	case 4: return array ('font_1' => 'Open Sans',
				'font_1_select' => 'Open Sans',
				'font_2' => 'Bubbler One',
				'font_2_select' => 'Bubbler One',
				'font_3' => 'Tangerine',	
				'font_3_select' => 'Tangerine',
				'site_font' => 1,
				'header_font' => 2,
				'description_font' => 3,
				'menu_font' => 2,
				'submenu_font' => 1,
				'title_font' => 2,
				'link_font' => 2,
				'cat_font' => 2,
				'meta_font' => 1,
				'w_font' => 1,
				'w_title_font' => 2,
				'w_link_font' => 1);	
	case 5: return array ('font_1' => 'Open Sans',
				'font_1_select' => 'Open Sans',
				'font_2' => 'Montserrat',
				'font_2_select' => 'Montserrat',
				'font_3' => 'Tangerine',	
				'font_3_select' => 'Tangerine',
				'site_font' => 1,
				'header_font' => 2,
				'description_font' => 3,
				'menu_font' => 2,
				'submenu_font' => 1,
				'title_font' => 2,
				'link_font' => 2,
				'cat_font' => 2,
				'meta_font' => 1,
				'w_font' => 1,
				'w_title_font' => 2,
				'w_link_font' => 1);	
	case 6: return array ('font_1' => 'Open Sans',
				'font_1_select' => 'Open Sans',
				'font_2' => 'Roboto Condensed',
				'font_2_select' => 'Roboto Condensed',
				'font_3' => 'Tangerine',	
				'font_3_select' => 'Tangerine',
				'site_font' => 1,
				'header_font' => 2,
				'description_font' => 3,
				'menu_font' => 2,
				'submenu_font' => 1,
				'title_font' => 2,
				'link_font' => 2,
				'cat_font' => 2,
				'meta_font' => 1,
				'w_font' => 1,
				'w_title_font' => 2,
				'w_link_font' => 1);
	case 7: return array ('font_1' => 'Spectral',
				'font_1_select' => 'Spectral',
				'font_2' => '',
				'font_2_select' => '0',
				'font_3' => 'Tangerine',	
				'font_3_select' => 'Tangerine',
				'site_font' => 1,
				'header_font' => 1,
				'description_font' => 3,
				'menu_font' => 1,
				'submenu_font' => 1,
				'title_font' => 1,
				'link_font' => 1,
				'cat_font' => 1,
				'meta_font' => 1,
				'w_font' => 1,
				'w_title_font' => 1,
				'w_link_font' => 1);
	}
}

/* return array */

function meditation_get_font_variants() {

	return array(0 => __( 'none', 'meditation' ), 1 => __( 'Font 1', 'meditation' ), 2 => __( 'Font 2', 'meditation' ), 3 => __( 'Font 3', 'meditation' ));
}

/* Add values to defaults array */

function meditation_add_defaults( $defaults ) {

	$fonts = meditation_get_font( $defaults['font_scheme'] );

	foreach( $fonts as $id => $value ) {
		$defaults[ $id ] = $value;
	}
	return $defaults;
}
add_action( 'meditation_option_defaults', 'meditation_add_defaults' );
 
 /**
 * Add custom styles to the header.
 *
 * @since Meditation 1.0.0
*/
function meditation_hook_font_css() {

	$font[0] = 0;
	$font[1] = meditation_get_theme_mod( 'font_1' );
	$font[2] = meditation_get_theme_mod( 'font_2' );		
	$font[3] = meditation_get_theme_mod( 'font_3' );
		
?>
	<style type="text/css"> 

	.font-1 {
		font-family: '<?php echo esc_attr( $font[1] ); ?>', sans-serif !important;
	}	
	.font-2 {
		font-family: '<?php echo esc_attr( $font[2] ); ?>', sans-serif !important;
	}	
	.font-3 {
		font-family: '<?php echo esc_attr( $font[3] ); ?>', sans-serif !important;
	}
	
	<?php 
	$curr_font = absint( meditation_get_theme_mod( 'site_font' ) );
	if ( '0' != $font[ $curr_font ] ) :
	?>
	.site {
		font-family: '<?php echo esc_attr( $font[ $curr_font ] ); ?>', sans-serif;
	}
	<?php endif; 
	
	$curr_font = absint( meditation_get_theme_mod( 'header_font' ) );
	if ( '0' != $font[ $curr_font ] ) :
	?>
	.site-title h1 a {
		font-family: '<?php echo esc_attr( $font[ $curr_font ] ); ?>', sans-serif;
	}
	<?php endif;
	
	$curr_font = absint( meditation_get_theme_mod( 'description_font' ) );
	if ( '0' != $font[ $curr_font ] ) :
	?>
	.site-description h2 {
		font-family: '<?php echo esc_attr( $font[ $curr_font ] ); ?>', sans-serif;
	}
	<?php endif; 
	
	$curr_font = absint( meditation_get_theme_mod( 'title_font' ) );
	if ( '0' != $font[ $curr_font ] ) :
	?>
	.entry-header h1 a, .entry-content h1 a, .entry-content h2 a, .entry-content h3 a, .entry-content h4 a, .entry-content h5 a, .entry-content h6 a,
	.entry-header h1, .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6 {
		font-family: '<?php echo esc_attr( $font[ $curr_font ] ); ?>', sans-serif;
	}
	<?php endif;
	
	$curr_font = absint( meditation_get_theme_mod( 'link_font' ) );
	if ( '0' != $font[ $curr_font ] ) :
	?>
	.entry-content a {
		font-family: '<?php echo esc_attr( $font[ $curr_font ] ); ?>', sans-serif;
	}
	<?php endif;
	
	$curr_font = absint( meditation_get_theme_mod( 'cat_font' ) );
	if ( '0' != $font[ $curr_font ] ) :
	?>
	.content .post-categories a, .content .tags a {
		font-family: '<?php echo esc_attr( $font[ $curr_font ] ); ?>', sans-serif;
	}
	<?php endif;
	
	$curr_font = absint( meditation_get_theme_mod( 'meta_font' ) );
	if ( '0' != $font[ $curr_font ] ) :
	?>
	.content .entry-meta a {
		font-family: '<?php echo esc_attr( $font[ $curr_font ] ); ?>', sans-serif;
	}
	<?php endif;

	$curr_font = absint( meditation_get_theme_mod( 'menu_font' ) );
	if ( '0' != $font[ $curr_font ] ) :
	?>
	.menu-1 > div > ul > li, .menu-1 > div > ul > li > a {
		font-family: '<?php echo esc_attr( $font[ $curr_font ] ); ?>', sans-serif;
	}
	<?php endif;
	
	$curr_font = absint( meditation_get_theme_mod( 'submenu_font' ) );
	if ( '0' != $font[ $curr_font ] ) :
	?>
	.menu-top ul li ul, .menu-top ul li ul a {
		font-family: '<?php echo esc_attr( $font[ $curr_font ] ); ?>', sans-serif;
	}
	<?php endif;
	
	$curr_font = absint( meditation_get_theme_mod( 'w_font' ) );
	if ( '0' != $font[ $curr_font ] ) :
	?>
	.widget-area .widget {
		font-family: '<?php echo esc_attr( $font[ $curr_font ] ); ?>', sans-serif;
	}
	<?php endif;

	$curr_font = absint( meditation_get_theme_mod( 'w_title_font' ) );
	if ( '0' != $font[ $curr_font ] ) :
	?>
	.widget-area .widget .widget-title, .widget-area .widget .widgettitle {
		font-family: '<?php echo esc_attr( $font[ $curr_font ] ); ?>', sans-serif;
	}
	<?php endif;
	
	$curr_font = absint( meditation_get_theme_mod( 'w_link_font' ) );
	if ( '0' != $font[ $curr_font ] ) :
	?>
	.widget-area .widget a {
		font-family: '<?php echo esc_attr( $font[ $curr_font ] ); ?>', sans-serif;
	}
	<?php endif; ?>
	
	</style>
	<?php
	
}
add_action( 'wp_head', 'meditation_hook_font_css' );

 /**
 * Print js for reset fonts in the customizer.
 *
 *
 * @since Meditation 1.0.0
*/
function meditation_print_reset() {

?>
<script type="text/javascript">
	jQuery( document ).ready(function( $ ) {
		function meditation_set_val(name, newVal) {
			var control = wp.customize.control(name); 
			if( control ){
				control.setting.set( newVal );
			}
			return;
		}
		
		wp.customize( 'reset_font', function( value ) {
			value.bind( function( to ) {
				meditation_refresh( to );
			});
		});
		
		function meditation_refresh( scheme ) { 
		<?php 
		for( $scheme_id = 0; $scheme_id < 8; $scheme_id++ ) {
			$fields = meditation_get_font( $scheme_id );
			?>
			if ( '<?php echo esc_js($scheme_id); ?>' == scheme) {
			<?php
			foreach( $fields as $id => $value ) {
				?>
				meditation_set_val( '<?php echo esc_js( $id ); ?>', '<?php echo esc_js( $value ); ?>' );
				<?php
			}?>
			}
			<?php	
		}
		?>
		}
	});

</script>
<?php
}
add_action( 'customize_controls_print_scripts', 'meditation_print_reset' );