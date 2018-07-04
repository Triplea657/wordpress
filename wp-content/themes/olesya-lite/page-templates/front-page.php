<?php
/**
 * Template Name: Homepage
 *
 * @package Olesya_Lite
 */

get_header(); ?>

<?php olesya_lite_do_slider_content();?>

<?php
global $wp_query;
$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
$wp_query = new WP_Query( array(
	'post_type' 		=> 'post',
	'posts_per_page' 	=> absint( get_option( 'posts_per_page' ) ),
	'post__not_in'		=> olesya_lite_featured_post_id(),
	'paged'				=> $paged
) );

?>

<div class="content-sidebar-wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;?>

		</main><!-- #main -->
		<?php olesya_lite_posts_navigation();?>
	</div><!-- #primary -->
	<?php wp_reset_postdata();?>
	<?php get_sidebar();?>
</div>
<?php
get_footer();
