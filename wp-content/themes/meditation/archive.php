<?php
/**
 * The template for displaying Archive pages
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
 */

get_header();
$meditation_layout = meditation_get_theme_mod( 'layout_archive' );
$meditation_layout_content = meditation_get_theme_mod( 'layout_archive_content' );

?>
<div class="main-wrapper <?php echo esc_attr( meditation_content_class( $meditation_layout_content ) ); ?> <?php echo esc_attr( $meditation_layout ); ?> ">
	
	<div class="site-content">
			<?php
				if ( have_posts() ) : 
				?>
					<header class="archive-header">
					<?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'meditation' ), get_the_date() );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'meditation' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'meditation' ) ) );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'meditation' ), get_the_date( _x( 'Y', 'yearly archives date format', 'meditation' ) ) );

						else :
							_e( 'Archives', 'meditation' );

						endif; ?>
					
					</header><!-- .archive-header -->
					
					<div class="content"> 

				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'content', meditation_get_content_prefix() );
						
					endwhile; ?>
						<div class="content-footer">
						<?php do_action( 'meditation_after_content' ); ?>
						</div><!-- .content-footer -->
					</div><!-- .content -->		
				<?php

					meditation_paging_nav();
					
				else :  
				?>
					<div class="content"> 
					<?php 
						get_template_part( 'content', 'none' );
					?>
					
					</div><!-- .content -->
				<?php 
				endif;
?>
	</div><!-- .site-content -->
	<?php meditation_get_sidebar( meditation_get_theme_mod( 'layout_archive' ) ); ?>
</div> <!-- .main-wrapper -->

<?php
get_footer();