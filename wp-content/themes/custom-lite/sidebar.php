<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Custom Lite
 * @since Custom Lite 1.0.0
 */
 
$meditation_curr_slug = meditation_get_sidebar_slug();
$hook_name_1 = 'meditation_empty_column_1-'.$meditation_curr_slug;
$hook_name_2 = 'meditation_empty_column_2-'.$meditation_curr_slug;
if( '1' == meditation_get_theme_mod('is_custom_icons') ) {
	$s_1_icon = '<div class="sidebar-icon zoom widget-icon"><i class="icon-top fa ' . esc_attr( meditation_get_theme_mod('icon_1') ) . '"></i></div>';
	$s_2_icon = '<div class="sidebar-icon zoom widget-icon"><i class="icon-top fa ' . esc_attr( meditation_get_theme_mod('icon_2') ) . '"></i></div>';
}
else {
	$s_1_icon = '';
	$s_2_icon = '';	
}
?>

<div class="sidebar-1">		
	<div class="column small">
		<?php echo $s_1_icon; ?>
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
		<?php echo $s_2_icon; ?>
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