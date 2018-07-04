<?php
/**
 * Olesya Lite Theme Customizer.
 *
 * @package Olesya_Lite
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function olesya_lite_customize_preview_js() {
	wp_enqueue_script( 'olesya_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'customize-selective-refresh' ), '20151215', true );
}
add_action( 'customize_preview_init', 'olesya_lite_customize_preview_js' );

/**
 * Load Customizer Setting.
 */
require get_template_directory() . '/inc/customizer/sanitization-callbacks.php';
require get_template_directory() . '/inc/customizer/setting-general.php';
require get_template_directory() . '/inc/customizer/setting-slider.php';
require get_template_directory() . '/inc/customizer/setting-theme.php';

/** Output */
require get_template_directory() . '/inc/customizer/output.php';
