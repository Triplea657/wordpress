<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
 */
 
$meditation_curr_slug = meditation_get_sidebar_slug();
$hook_name = 'meditation_empty_column_1-'.$meditation_curr_slug;
?>

<div class="sidebar-1">
	<div class="column small">		
		<div class="widget-area">
		<?php if ( is_active_sidebar( 'column-1'.'-'.$meditation_curr_slug ) ) : ?>
		
				<?php dynamic_sidebar( 'column-1'.'-'.$meditation_curr_slug ); ?>

		<?php else : ?>

				<?php do_action( $hook_name ); ?>
		
		<?php endif; ?>
		</div><!-- .widget-area -->
	</div><!-- .column -->
</div><!-- .sidebar-1 -->