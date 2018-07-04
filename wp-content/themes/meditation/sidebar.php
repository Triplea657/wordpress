<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
 */
 
$meditation_curr_slug = meditation_get_sidebar_slug();
$hook_name_1 = 'meditation_empty_column_1-'.$meditation_curr_slug;
$hook_name_2 = 'meditation_empty_column_2-'.$meditation_curr_slug;
?>

<div class="sidebar-1">
	<div class="column small">		
		<div class="widget-area">
			<?php 
			if ( is_active_sidebar( 'column-1'.'-'.$meditation_curr_slug  ) ) :
			
				dynamic_sidebar( 'column-1'.'-'.$meditation_curr_slug  );
				
			else :
				
				do_action( $hook_name_1 );

			endif;
			?>
		</div><!-- .widget-area -->
	</div><!-- .column -->
</div><!-- .sidebar-1 -->
	
<div class="sidebar-2">
	<div class="column small">
		<div class="widget-area">
			<?php if ( is_active_sidebar( 'column-2'.'-'.$meditation_curr_slug  ) ) :

				dynamic_sidebar( 'column-2'.'-'.$meditation_curr_slug  );
				
			else :
				
				do_action( $hook_name_2 );

			endif;
			?>	
		</div><!-- .widget-area -->
	</div><!-- .column -->
</div><!-- .sidebar-2 -->