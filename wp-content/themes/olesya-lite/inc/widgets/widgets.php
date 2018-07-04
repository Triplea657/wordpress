<?php
/**
 * This file handle widget appearance behavior.
 *
 * @package Olesya_lite
 */

require get_template_directory() . '/inc/widgets/widget-author.php';
/**
 * Register widgets for use in the Genesis theme.
 *
 * @since 1.7.0
 */
function olesya_lite_load_widgets() {
	register_widget( 'Olesya_Lite_User_Profile_Widget' );
}
add_action( 'widgets_init', 'olesya_lite_load_widgets' );

/**
 * [olesya_lite_after_setup_widget description]
 * @return [type] [description]
 */
function olesya_lite_after_setup_widget(){

	add_filter( 'widget_tag_cloud_args', 'olesya_lite_widget_tag_cloud_args' );

	add_filter( 'wpiw_link_class', 'olesya_lite_instagram_text_link' );

	add_filter( 'get_archives_link', 'olesya_lite_span_count_archive_widget', 10, 2 );
	add_filter( 'wp_list_categories', 'olesya_lite_span_count_category_widget', 10, 2 );

}
add_action( 'after_setup_theme', 'olesya_lite_after_setup_widget' );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function olesya_lite_widget_tag_cloud_args( $args ) {
	$args['largest'] = 0.875;
	$args['smallest'] = 0.875;
	$args['unit'] = 'em';
	return $args;
}

/**
 * [olesya_lite_instagram_text_link description]
 * @param  [type] $class [description]
 * @return [type]        [description]
 */
function olesya_lite_instagram_text_link( $class ){

	$class = 'widget-more-link';
	return $class;

}

/**
 * [olesya_lite_span_count_archive_widget description]
 * @param  [type] $output [description]
 * @return [type]         [description]
 */
function olesya_lite_span_count_archive_widget( $output ) {
	$output = preg_replace_callback( '#(<li>.*?<a.*?>.*?</a>.*)&nbsp;(\(.*?\))(.*?</li>)#', 'olesya_lite_add_span_count_on_archive_widget', $output );

	return $output;
}

/**
 * [olesya_lite_add_span_count_on_archive_widget description]
 * @param  [type] $matches [description]
 * @return [type]          [description]
 */
function olesya_lite_add_span_count_on_archive_widget( $matches ) {
	return sprintf( '%s<span>%s</span>%s',
		$matches[1],
		$matches[2],
		$matches[3]
	);
}

/**
 * [olesya_lite_span_count_category_widget description]
 * @param  [type] $output [description]
 * @param  [type] $args   [description]
 * @return [type]         [description]
 */
function olesya_lite_span_count_category_widget( $output, $args ) {
	if ( ! isset( $args['show_count'] ) || $args['show_count'] == 0 ) {
		return $output;
	}
	$output = preg_replace_callback( '#(<a.*?>\s*)(\(.*?\))#', 'olesya_lite_add_span_count_on_category_widget', $output );

	return $output;
}
/**
 * [olesya_lite_add_span_count_on_category_widget description]
 * @param  [type] $matches [description]
 * @return [type]          [description]
 */
function olesya_lite_add_span_count_on_category_widget( $matches ) {
	return sprintf( '%s<span>%s</span>',
		$matches[1],
		$matches[2]
	);
}
