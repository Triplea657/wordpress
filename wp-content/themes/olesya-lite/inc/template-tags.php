<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Olesya_Lite
 */

if ( ! function_exists( 'olesya_lite_posted_on_above' ) ) :
/**
 * [olesya_lite_posted_on_above description]
 * @return [type] [description]
 */
function olesya_lite_posted_on_above(){
	if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && olesya_lite_categorized_blog() && !olesya_lite_is_sticky() ) {
		echo '<div class="cat-links">';
		echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'olesya-lite' ) );
		echo '</div>';
	}
}
endif;

if ( ! function_exists( 'olesya_lite_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function olesya_lite_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'olesya-lite' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'olesya-lite' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'olesya-lite' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'olesya-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'olesya_lite_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function olesya_lite_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'olesya-lite' ) );
		if ( $tags_list ) {
			printf( '<footer class="entry-footer"><span class="tags-links">%1$s</span></footer>', $tags_list ); // WPCS: XSS OK.
		}

	}

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function olesya_lite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'olesya_lite_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'olesya_lite_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so olesya_lite_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so olesya_lite_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in olesya_lite_categorized_blog.
 */
function olesya_lite_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'olesya_lite_categories' );
}
add_action( 'edit_category', 'olesya_lite_category_transient_flusher' );
add_action( 'save_post',     'olesya_lite_category_transient_flusher' );

if ( ! function_exists( 'olesya_lite_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 */
function olesya_lite_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

if ( ! function_exists( 'olesya_lite_breadcrumb' ) ) :
/**
 * Display breadcrumb compatibility
 * @return void
 */
function olesya_lite_breadcrumb(){

	$breadcrumb_markup_open = '<div id="breadcrumb" typeof="BreadcrumbList" vocab="http://schema.org/"><div class="wrap">';
	$breadcrumb_markup_close = '</div></div>';

	if ( function_exists( 'bcn_display' ) ) {
		echo $breadcrumb_markup_open;
		bcn_display();
		echo $breadcrumb_markup_close;
	}
	elseif ( function_exists( 'breadcrumbs' ) ) {
		breadcrumbs();
	}
	elseif ( function_exists( 'crumbs' ) ) {
		crumbs();
	}
	elseif ( class_exists( 'WPSEO_Breadcrumbs' ) ) {
		yoast_breadcrumb( $breadcrumb_markup_open, $breadcrumb_markup_close );
	}
	elseif( function_exists( 'yoast_breadcrumb' ) && ! class_exists( 'WPSEO_Breadcrumbs' ) ) {
		yoast_breadcrumb( $breadcrumb_markup_open, $breadcrumb_markup_close );
	}

}
endif;

if ( ! function_exists( 'olesya_lite_standard_loop' ) ) :
/**
 * [olesya_lite_standard_loop description]
 * @return [type] [description]
 */
function olesya_lite_standard_loop(){
	if ( have_posts() ) :

		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

		endwhile;

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
}
endif;

if ( ! function_exists( 'olesya_lite_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 */
function olesya_lite_post_thumbnail( $size = 'post-thumbnail') {

	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) {
		echo '<div class="post-thumbnail">';
		the_post_thumbnail( $size );
		echo '</div>';
	} else {
		echo '<div class="post-thumbnail">';
			echo '<a href="'. get_permalink( get_the_id() ) .'">';
				the_post_thumbnail( $size );
			echo '</a>';
		echo '</div>';
	}

}
endif;

if ( !function_exists( 'olesya_lite_posts_navigation' ) ) :
/**
 * [olesya_lite_posts_navigation description]
 * @return [type] [description]
 */
function olesya_lite_posts_navigation(){

	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
		return;
	}

	if ( get_theme_mod( 'posts_navigation', 'posts_navigation' ) == 'posts_navigation' ) {
		the_posts_navigation( array(
            'prev_text'          => __( '&larr; Older posts', 'olesya-lite' ),
            'next_text'          => __( 'Newer posts &rarr;', 'olesya-lite' ),
		) );
	} else {
		the_posts_pagination( array(
			'prev_text'          => __( '&larr;<span class="screen-reader-text">Previous Page</span>', 'olesya-lite' ),
			'next_text'          => __( '&rarr;<span class="screen-reader-text">Next Page</span>', 'olesya-lite' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'olesya-lite' ) . ' </span>',
		) );
	}

}
endif;

if ( ! function_exists( 'olesya_lite_do_footer_copyright' ) ) :
/**
 * Render footer copyright
 *
 * @return string
 */
function olesya_lite_do_footer_copyright(){

	$footer_copyright =	sprintf( __( 'Copyright &copy; %1$s %2$s. Proudly powered by %3$s.', 'olesya-lite' ),
			date_i18n( __('Y', 'olesya-lite' ) ),
			'<a href="'. esc_url( home_url() ) .'">'. esc_attr( get_bloginfo( 'name' ) ) .'</a>',
			'<a href="'. esc_url( 'https://wordpress.org/' ) .'">WordPress</a>' );

	echo apply_filters( 'olesya_lite_footer_copyright', $footer_copyright );

}
endif;

if ( ! function_exists( 'olesya_lite_do_preloader' ) ) :
/**
 * [olesya_lite_do_preloader description]
 * @return [type] [description]
 */
function olesya_lite_do_preloader(){

	if ( is_customize_preview() ) {
		echo '<div class="pre-preloader">';
	}

	if ( get_theme_mod( 'enable_preloader' ) == true ) : ?>

		<div class="site-preloader">
			<div class="spinner">
				<div class="sk-wave">
					<div class="sk-rect sk-rect1"></div>
					<div class="sk-rect sk-rect2"></div>
					<div class="sk-rect sk-rect3"></div>
					<div class="sk-rect sk-rect4"></div>
					<div class="sk-rect sk-rect5"></div>
				</div>
			</div>
		</div>
	<?php endif;

	if ( is_customize_preview() ) {
		echo '</div>';
	}

}
endif;
