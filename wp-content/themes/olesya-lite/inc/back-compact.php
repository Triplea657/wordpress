<?php
/**
 * Olesya back compat functionality
 *
 * Prevents Olesya from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package Olesya_lite
 */

/**
 * Prevent switching to Olesya on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Olesya 1.0
 */
function olesya_lite_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'olesya_lite_upgrade_notice' );
}
add_action( 'after_switch_theme', 'olesya_lite_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Olesya on WordPress versions prior to 4.4.
 *
 * @since Olesya 1.0
 *
 * @global string $wp_version WordPress version.
 */
function olesya_lite_upgrade_notice() {
	$message = sprintf( __( 'Olesya Lite requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'olesya-lite' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @since Olesya 1.0
 *
 * @global string $wp_version WordPress version.
 */
function olesya_lite_customize() {
	wp_die( sprintf( __( 'Olesya Lite requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'olesya-lite' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'olesya_lite_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @since Olesya 1.0
 *
 * @global string $wp_version WordPress version.
 */
function olesya_lite_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Olesya Lite requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'olesya-lite' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'olesya_lite_preview' );
