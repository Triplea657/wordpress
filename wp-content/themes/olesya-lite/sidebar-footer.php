<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Olesya_lite
 */

if ( ! is_active_sidebar( 'sidebar-2' ) && ! is_active_sidebar( 'sidebar-3' ) && ! is_active_sidebar( 'sidebar-4' ) ) {
	return;
}
?>

<aside id="tertiary" class="widget-area" role="complementary">
	<div class="wrap">

		<?php if( is_active_sidebar( 'sidebar-2' ) ) :?>
			<div id="footer-widget-1" class="footer-widget">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
		<?php endif;?>

		<?php if( is_active_sidebar( 'sidebar-3' ) ) :?>
			<div id="footer-widget-2" class="footer-widget">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div>
		<?php endif;?>

		<?php if( is_active_sidebar( 'sidebar-4' ) ) :?>
			<div id="footer-widget-3" class="footer-widget">
				<?php dynamic_sidebar( 'sidebar-4' ); ?>
			</div>
		<?php endif;?>

	</div>
</aside><!-- #tertiary -->
