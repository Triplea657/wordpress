<?php
/**
 * Template Name: Full Width Narrow
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

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div><!-- .content-sidebar-wrap -->

<?php
get_footer();
