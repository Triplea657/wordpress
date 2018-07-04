<?php
/**
 * The sidebar containing the header widget area
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
 */

$hook_name = 'meditation_empty_sidebar-header';
global $wp_filter;
if( ! isset( $wp_filter[$hook_name] )  && ! is_active_sidebar( 'sidebar-header')  )
	return;
?>

<div class="sidebar-header">
	<div class="widget-area">
		<?php if ( is_active_sidebar( 'sidebar-header' ) ) : ?>
		
				<?php dynamic_sidebar( 'sidebar-header' ); ?>

		<?php else : ?>

				<?php do_action( $hook_name ); ?>
		
		<?php endif; ?>
	</div><!-- .widget-area -->
</div><!-- .sidebar-header -->