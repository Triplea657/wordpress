<?php
/**
 * The template for displaying Comments
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
	
	<h2 class="comments-title">
		<?php
			$comments_number = get_comments_number();
			if ( 1 === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'meditation' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'meditation'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
		?>
	</h2>

	<ol class="comment-list">
		<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'=> 34,
			) );
		?>
	</ol><!-- .comment-list -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'meditation' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'meditation' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'meditation' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'meditation' ); ?></p>
	<?php endif; ?>

	<?php endif; ?>


	<?php comment_form(); ?>

</div><!-- #comments -->
