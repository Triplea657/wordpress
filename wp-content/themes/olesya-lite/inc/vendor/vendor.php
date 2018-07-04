<?php
/**
 * Olesya vendor configuration.
 *
 * @package Olesya
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/vendor/class-tgm-plugin-activation.php';

/**
 * Register the required plugins for this theme.
 */
function olesya_lite_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			/* Recommended plugin name */
			'name'      => __( 'Genesis eNews Extended', 'olesya-lite' ),
			'slug'      => 'genesis-enews-extended',
			'required'  => false,
		),

		array(
			/* Recommended plugin name */
			'name'      => __( 'WP Instagram Widget', 'olesya-lite' ),
			'slug'      => 'wp-instagram-widget',
			'required'  => false,
		)

	);

	/*
	 * Array of configuration settings.
	 */
	$config = array(
		'id'           => 'olesya-lite',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'olesya_lite_register_required_plugins' );

/**
 * Once click demo import config
 *
 * @return array mixed
 */
function olesya_lite_import_files() {
    return array(
        array(
        	/* Theme demo data name */
            'import_file_name'           => __( 'Olesya - Default', 'olesya-lite' ),
            'import_file_url'            => esc_url( 'https://olesya-lite.ayothemes.com/olesya-lite-data.xml' ),
            'import_widget_file_url'     => esc_url( 'https://olesya-lite.ayothemes.com/olesya-lite-widget.wie' ),
            'import_customizer_file_url' => esc_url( 'https://olesya-lite.ayothemes.com/olesya-lite-customizer.dat' ),
        )
    );
}
add_filter( 'pt-ocdi/import_files', 'olesya_lite_import_files' );

/**
 * [olesya_lite_after_import_setup description]
 * @return [type] [description]
 */
function olesya_lite_after_import_setup() {

    $primary_menu 	= get_term_by( 'name', 'Primary', 'nav_menu' );
    $social_menu 	= get_term_by( 'name', 'Social', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations',
    	array(
            'primary' 	=> $primary_menu->term_id,
            'social'	=> $social_menu->term_id
        )
    );

    $featured_content = get_term_by( 'name', 'Featured', 'category' );
    set_theme_mod( 'slider_cat', $featured_content->term_id );

}
add_action( 'pt-ocdi/after_import', 'olesya_lite_after_import_setup' );
