<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Olesya_Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if( olesya_lite_is_sticky() ) :?>
		<span class="sticky-label"><?php echo esc_attr( get_theme_mod( 'sticky_label', __( 'Sticky', 'olesya-lite' ) ) );?></span>
	<?php endif;?>

	<?php olesya_lite_post_thumbnail();?>

	<header class="entry-header">
		<?php
		olesya_lite_posted_on_above();

		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() && !olesya_lite_is_sticky() ) : ?>
		<div class="entry-meta">
			<?php olesya_lite_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if( is_single() || post_password_required() || get_theme_mod( 'content_display' ) == 'the_content' ) : ?>
		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'olesya-lite' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'olesya-lite' ),
					'after'  => '</div>',
				) );

			?>
		</div><!-- .entry-content -->
	<?php else: ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php endif;?>

	<?php if( ! olesya_lite_is_sticky() && get_the_tag_list() !== '' ) :?>
		<?php olesya_lite_entry_footer(); ?>
	<?php endif;?>

</article><!-- #post-## -->
