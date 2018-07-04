<?php
/**
 * Template Name: Canvas
 *
 * @package Olesya_lite
 */

get_header(); ?>

<div class="content-sidebar-wrap">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				the_content();

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

</div><!-- .content-sidebar-wrap -->

<?php
get_footer();
