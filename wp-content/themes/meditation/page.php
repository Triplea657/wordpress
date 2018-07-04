<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
 */

get_header();
?>
<div class="main-wrapper <?php echo esc_attr( meditation_get_theme_mod('layout_page') ); ?> ">

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
		
		<?php get_template_part( 'content', 'none' ); ?>
	
		</div><!-- .content -->
	<?php 
	endif;
?>
	</div><!-- .site-content -->
	<?php meditation_get_sidebar( meditation_get_theme_mod('layout_page') ); ?>
</div> <!-- .main-wrapper -->

<?php
get_footer();
