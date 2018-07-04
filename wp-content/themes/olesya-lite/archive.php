<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Olesya_Lite
 */

get_header(); ?>

<div class="content-sidebar-wrap">

	<div id="primary" class="content-area">
		<?php olesya_lite_breadcrumb();?>
		<header class="archive-header">
			<?php
				the_archive_title( '<h1 class="archive-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				if ( is_author() && get_the_author_meta( 'description' ) ) {
					echo sprintf( '<div class="archive-description">%s</div>', wpautop( get_the_author_meta( 'description' ) ) );
				}
			?>
		</header><!-- .page-header -->

		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<?php
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

		endif; ?>

		</main><!-- #main -->

		<?php olesya_lite_posts_navigation(); ?>

	</div><!-- #primary -->

	<?php get_sidebar();?>

</div><!-- .content-sidebar-wrap -->

<?php
get_footer();
