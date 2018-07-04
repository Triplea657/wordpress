<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
 */
 
global $meditation_layout_content;

?>

<?php do_action ( "meditation_grid_start", $meditation_layout_content, $wp_query->current_post); ?>

<div class="content-container">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">

			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

			<?php if ( '1' == meditation_get_theme_mod( 'is_show_cat' ) ) : ?>

			<div class="category-list">
				<?php echo get_the_category_list(''); ?>
			</div><!-- .category-list -->	
			
			<?php endif; ?>
			
			<?php if ( ( has_post_thumbnail() && ! post_password_required() ) ) : ?>
				<div class="image effect-1">
					
					<?php if ( '1' == meditation_get_theme_mod( 'is_defaults_post_thumbnail_background' ) && 'default' != $meditation_layout_content && 'flex-layout-1' != $meditation_layout_content ) : ?>

						<div class="entry-thumbnail coverback" style="background-image: url(<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>); ">
						</div><!-- .entry-thumbnail -->
						
					<?php else : ?>
					
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div><!-- .entry-thumbnail -->
															
					<?php endif; ?>
						
				</div><!-- .element -->
			<?php elseif ( meditation_get_theme_mod( 'is_thumbnail_empty_icon' ) ) : ?>
			
					<div class="entry-thumbnail coverback" style="background-image: url(<?php echo esc_url( get_template_directory_uri() . '/img/empty.png');  ?>); ">
					</div><!-- .entry-thumbnail -->
					
			<?php endif; ?>
			
		</header><!-- .entry-header -->
		
		<?php if( 'excerpt' == meditation_get_theme_mod('single_style') || ( 'content' == meditation_get_theme_mod('single_style') && is_search() )  ) : ?>
			
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
				
		<?php elseif( 'content' == meditation_get_theme_mod('single_style') ) : ?>
			
			<div class="entry-content">
				<?php the_content( __('<div class="meta-nav">Continue reading&hellip;&rarr;</div>', 'meditation' )); ?>
			</div><!-- .entry-content -->
			
		<?php endif; ?>
		<div class="clear"></div>
		<footer class="entry-meta">
			<?php if ( 'post' == get_post_type() ) : ?>

				<span class="post-date">
					<?php meditation_posted_on(); ?>
				</span>
				
			<?php endif; ?>
			<?php edit_post_link( __( 'Edit', 'meditation' ), '<span title="'.esc_attr__( 'Edit', 'meditation' ).'" class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
		
	</article><!-- #post -->
	
</div><!-- .content-container -->

<?php do_action ( "meditation_grid_end", $meditation_layout_content, $wp_query->current_post, $wp_query->post_count); ?>