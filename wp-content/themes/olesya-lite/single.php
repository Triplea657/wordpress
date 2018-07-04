<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Olesya_Lite
 */

get_header(); ?>

<div class="content-sidebar-wrap">

	<div id="primary" class="content-area">
		<?php olesya_lite_breadcrumb();?>
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			if ( in_array( 'biography', get_theme_mod( 'post_meta', array( 'biography' ) ) ) ) {
				get_template_part( 'template-parts/biography' );
			}

			the_post_navigation( array(
			    'prev_text'                  => __( '<span>&larr; previous post</span> %title', 'olesya-lite' ),
			    'next_text'                  => __( '<span>next post &rarr;</span> %title', 'olesya-lite' ),
			    'screen_reader_text'		 => __( 'Continue Reading', 'olesya-lite' ),
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar();?>

</div><!-- .content-sidebar-wrap -->

<?php
get_footer();
