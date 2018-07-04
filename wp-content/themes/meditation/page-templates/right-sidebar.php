<?php
/**
 * Template Name: Right Sidebar
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
 */
 __( 'Right Sidebar', 'meditation' );

get_header(); 

?>
<div class="main-wrapper right-sidebar">

	<div class="site-content"> 
			<?php
				if ( have_posts() ) : ?>
				
					<div class="content"> 

				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'content', 'page' );
						
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
						
					endwhile; ?>
					
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
		get_sidebar( '2' );
	?>
</div> <!-- .main-wrapper -->

<?php
get_footer();
