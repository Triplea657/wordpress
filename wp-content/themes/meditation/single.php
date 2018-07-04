<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
 */
get_header(); 
$meditation_layout = meditation_get_theme_mod('layout_default');
?>
<div class="main-wrapper <?php echo esc_attr( $meditation_layout ); ?> ">
	
	<div class="site-content"> 
			<?php
				if ( have_posts() ) : ?>
				
					<div class="content"> 

				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'content', get_post_format() );
						
					endwhile; ?>
					
					</div><!-- .content -->
				
				<?php

					meditation_post_nav();

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;	
				
				else :  
				?>
					<div class="content"> 
					<?php get_template_part( 'content', 'none' ); ?>
					</div><!-- .content -->
				<?php 
				endif;
?>
	</div><!-- .site-content -->
	<?php
	meditation_get_sidebar( meditation_get_theme_mod('layout_default') );
	?>
</div> <!-- .main-wrapper -->
<?php
get_footer();
