<?php
/**
 * Featured Content
 *
 * @package Olesya_Pro
 */

if ( get_theme_mod( 'enable_slider' ) == false ) {
	if ( is_customize_preview() ) {
		echo '<div id="featured-content" class="featured-content not-visible"></div>';
	}
	return;
}

$olesya_lite_featured = new WP_Query( array(
	'cat'     			=> absint( get_theme_mod( 'slider_cat', 1 ) ),
	'posts_per_page' 	=> absint( get_theme_mod( 'slides_num', 5 ) ),
	'orderby'        	=> get_theme_mod( 'slider_orderby', 'date' ),
	'order'          	=> get_theme_mod( 'slider_order', 'DESC' ),
	'post__not_in' 		=> get_option( 'sticky_posts' ),
	'no_found_rows'  	=> true,
) );

if ( $olesya_lite_featured->have_posts() ) : ?>

	<div id="featured-content" class="featured-content">

		<?php while ( $olesya_lite_featured->have_posts() ) : $olesya_lite_featured->the_post(); ?>

		<?php

		$featured_image 	= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'large' ) ;
		$background_image 	= ( !empty( $featured_image[0] ) ) ? 'style="background-image:url(' . esc_url( $featured_image[0] ) . ');"' : '' ;
		?>

		<article id="featured-post-<?php the_ID(); ?>" <?php post_class(); ?><?php echo $background_image;?>>

			<div class="slider-content">

				<header class="entry-header">

					<?php olesya_lite_posted_on_above();?>

					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

					<div class="entry-meta">
						<?php olesya_lite_posted_on(); ?>
					</div><!-- .entry-meta -->

				</header>

				<a href="<?php the_permalink();?>" class="more-link"><?php echo sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'olesya-lite' ), get_the_title( get_the_ID() ) );?></a>

			</div>

		</article>

		<?php endwhile; ?>

	</div><!-- #featured-content -->

<?php endif; wp_reset_postdata();?>
