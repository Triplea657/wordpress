<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage meditation
 * @since meditation
 */

get_header(); ?>
	
<div class="content-container">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'meditation' ); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
		
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'meditation' ); ?></p>

					<?php get_search_form(); ?>
					
		</div><!-- .entry-content -->

	</article><!-- #post -->
</div><!-- .content-container -->

<?php
get_footer();