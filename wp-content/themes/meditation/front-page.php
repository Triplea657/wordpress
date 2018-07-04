<?php
/**
 * The template for displaying front page
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
 */

get_header(); 
if( ! ( '' == meditation_get_theme_mod('front_page_style') && ! is_home()) ) :
	$meditation_layout = meditation_get_theme_mod('layout_home');
	if( is_home() )
		$meditation_layout_content = meditation_get_theme_mod('layout_blog_content');
	else 
		$meditation_layout_content = 'front_page';
	?>
	<div class="main-wrapper <?php echo esc_attr(meditation_content_class($meditation_layout_content)); ?> <?php echo esc_attr($meditation_layout); ?> ">

		<div class="site-content"> 
		<?php
			if ( have_posts() ) : ?>
			
				<div class="content"> 

			<?php
				while ( have_posts() ) : the_post();

					if( is_page() ) :
						get_template_part( 'content', 'page' );
					else :
						get_template_part( 'content', meditation_get_content_prefix() );
					endif;
					
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
	<?php
	meditation_get_sidebar( meditation_get_theme_mod( 'layout_home' ) );
	?>
	</div> <!-- .main-wrapper -->

	<?php
endif;
get_footer();