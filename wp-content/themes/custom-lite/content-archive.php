<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage Custom Lite
 * @since Custom Lite 1.0.0
 */
 
global $meditation_layout_content;

?>
<?php do_action ( "meditation_grid_start", $meditation_layout_content, $wp_query->current_post); ?>

<div class="content-container">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<a class="hover-link" href="<?php echo esc_url( get_permalink() ); ?>"></a>
		
			<?php if ( ( has_post_thumbnail() && ! post_password_required() ) ) : ?>
				<div class="image effect-1">
					
					<?php if ( '1' == meditation_get_theme_mod( 'is_defaults_post_thumbnail_background' ) && 'default' != $meditation_layout_content && 'flex-layout-1' != $meditation_layout_content ) : ?>

						<div class="entry-thumbnail coverback" style="background-image: url(<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>); ">
							
							<?php if ( 'post' == get_post_type() ) : ?>

								<span class="post-date">
									<?php meditation_posted_on(); ?>
								</span>
								
							<?php endif; ?>
							<?php edit_post_link( __( 'Edit', 'custom-lite' ), '<span title="'.esc_attr__( 'Edit', 'custom-lite' ).'" class="edit-link">', '</span>' ); ?>
										
							<?php if ( '1' == meditation_get_theme_mod( 'is_show_cat' ) ) : ?>

							<div class="category-list">
								<?php echo get_the_category_list(''); ?>
							</div><!-- .category-list -->	
							
							<?php endif; ?>
						
						</div><!-- .entry-thumbnail -->
						
					<?php else : ?>
					
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div><!-- .entry-thumbnail -->
															
					<?php endif; ?>
						
				</div><!-- .element -->
			<?php elseif ( meditation_get_theme_mod( 'is_thumbnail_empty_icon' ) ) : 
				 $customlite_position = ' center';
				 $customlite_effect = ' rotate-y';
				 $customlite_icons = customlite_get_icons();
				 $customlite_icon = array_rand( $customlite_icons );
				 $customlite_icon = $customlite_icons[ $customlite_icon ]['id'];
				 
				 if ( "custom" == $customlite_icon ) $customlite_icon = "fa-coffee";
				 if ( "" == $customlite_icon ) $customlite_icon = "fa-coffee";
			?>
			
				<div class="entry-thumbnail empty coverback" style="background-image: url(<?php echo esc_url( meditation_get_theme_mod( 'empty_image' ) );  ?>); ">
						<?php if ( 'post' == get_post_type() ) : ?>

							<span class="post-date">
								<?php meditation_posted_on(); ?>
							</span>
							
						<?php endif; ?>
						<?php edit_post_link( __( 'Edit', 'custom-lite' ), '<span title="'.esc_attr__( 'Edit', 'custom-lite' ).'" class="edit-link">', '</span>' ); ?>
									
						<?php if ( '1' == meditation_get_theme_mod( 'is_show_cat' ) ) : ?>

						<div class="category-list">
							<?php echo get_the_category_list(''); ?>
						</div><!-- .category-list -->	
						
						<?php endif; ?>
					<div class="widget-icon inside <?php echo esc_attr( $customlite_position . $customlite_effect ); ?>"><i class="icon fa fa-5x <?php echo esc_attr( $customlite_icon ); ?>"></i></div>
				</div><!-- .entry-thumbnail -->
					
			<?php endif; ?>

			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
			
		</header><!-- .entry-header -->
		
		<?php if( 'excerpt' == meditation_get_theme_mod('single_style') || ( 'content' == meditation_get_theme_mod('single_style') && is_search() )  ) : ?>
			
			<div class="entry-summary">
				<a class="ex" href="<?php echo esc_url( get_permalink() ); ?>">
					<?php the_excerpt(); ?>
				</a>
			</div><!-- .entry-summary -->
				
		<?php elseif( 'content' == meditation_get_theme_mod('single_style') ) : ?>
			
			<div class="entry-content">
				<?php the_content( __('<div class="meta-nav">Continue reading&hellip;&rarr;</div>', 'custom-lite' )); ?>
			</div><!-- .entry-content -->
			
		<?php endif; ?>
		<div class="clear"></div>
		
	</article><!-- #post -->
	
</div><!-- .content-container -->

<?php do_action ( "meditation_grid_end", $meditation_layout_content, $wp_query->current_post, $wp_query->post_count); ?>