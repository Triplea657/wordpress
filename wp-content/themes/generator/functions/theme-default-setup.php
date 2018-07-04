<?php 
/*
 * thumbnail list
*/ 
function generator_thumbnail_image($content) {

    if( has_post_thumbnail() )
         return the_post_thumbnail( 'thumbnail' ); 
}
/*
 * generator Title
*/
function generator_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$generator_site_description = get_bloginfo( 'description', 'display' );
	if ( $generator_site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $generator_site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'generator' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'generator_wp_title', 10, 2 );

/**
 * Add default menu style if menu is not set from the backend.
 */
function generator_add_menuid ($page_markup) {
preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $generator_matches);
$generator_divclass = '';
if(!empty($generator_matches)) { $generator_divclass = $generator_matches[1]; }
$generator_toreplace = array('<div class="'.$generator_divclass.' pull-right-res">', '</div>');
$generator_replace = array('<div class="nav navbar-nav menu">', '</div>');
$generator_new_markup = str_replace($generator_toreplace,$generator_replace, $page_markup);
$generator_new_markup= preg_replace('/<ul/', '<ul class="nav navbar-nav generator-menu"', $generator_new_markup);
return $generator_new_markup; }
add_filter('wp_page_menu', 'generator_add_menuid');

/*
 * generator Main Sidebar
*/
function generator_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'generator' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'generator' ),
		'before_widget' => '<aside id="%1$s" class="sidebar-widget widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="sidebar-title"><h1 class="sidebar-title">',
		'after_title'   => '</h1></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Area One', 'generator' ),
		'id'            => 'footer-1',
		'description'   => __( 'Footer Area One that appears on the left.', 'generator' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="footer-menu-title">',
		'after_title'   => '</h2><h1 class="footer-menu-line"></h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Area Two', 'generator' ),
		'id'            => 'footer-2',
		'description'   => __( 'Footer Area Two that appears on the left.', 'generator' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="footer-menu-title">',
		'after_title'   => '</h2><h1 class="footer-menu-line"></h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Area Three', 'generator' ),
		'id'            => 'footer-3',
		'description'   => __( 'Footer Area Three that appears on the left.', 'generator' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget no-padding %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="footer-menu-title">',
		'after_title'   => '</h2><h1 class="footer-menu-line"></h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Area Four', 'generator' ),
		'id'            => 'footer-4',
		'description'   => __( 'Footer Area Four that appears on the left.', 'generator' ),
		'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="footer-menu-title">',
		'after_title'   => '</h2><h1 class="footer-menu-line"></h1>',
	) );
}
add_action( 'widgets_init', 'generator_widgets_init' );

/*
 * generator Set up post entry meta.
 *
 * Meta information for current post: categories, tags, permalink, author, and date.
 */
function generator_entry_meta() {

	$generator_category_list = get_the_category_list( ', ', 'generator' );

	$generator_tag_list = get_the_tag_list( ', ', 'generator');

	$generator_date = sprintf( '<time datetime="%3$s">%4$s</time>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$generator_author = sprintf( '<span><a href="%1$s" title="%2$s" >%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'generator' ), get_the_author() ) ),
		get_the_author()
	);


	if ( $generator_tag_list ) {
		$generator_utility_text = __( 'Posted in : %1$s  on %3$s by : %4$s ', 'generator' );
	} elseif ( $generator_category_list ) {
		$generator_utility_text = __( 'Posted in : %1$s  on %3$s by : %4$s ', 'generator' );
	} else {
		$generator_utility_text = __( 'Posted on : %3$s by : %4$s', 'generator' );		
	}

	printf(
		'<div class="generator-entry-meta">'. $generator_utility_text . '</div>',
		$generator_category_list,
		$generator_tag_list,
		$generator_date,
		$generator_author
	);
}

if ( ! function_exists( 'generator_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own generator_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function generator_comment( $comment, $generator_args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
  <p>
    <?php _e( 'Pingback:', 'generator' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __( 'Edit', 'generator' ), '<span class="edit-link">', '</span>' ); ?>
  </p>
</li>
<?php
			break;
		default :
		// Proceed with normal comments.
		if($comment->comment_approved==1)
		{
		global $post;
	?>
	<div <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" class="comment-list">
  		<div id="comment-<?php comment_ID(); ?>" class="comment col-md-12 generator-blog-comment no-padding">
    		<div class="comment-img"> <a href="#"><?php echo get_avatar( get_the_author_meta('ID'), '80'); ?></a> </div>
                <div class="comment-message-section">
                    <div class="comm-title">
                            <?php
                                printf( '<h2>%1$s</h2>',
                                    get_comment_author_link(),
                                    ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author ', 'generator' ) . '</span>' : ''
                                );
                            ?>
                            <?php
                                
                                echo '<span>'.get_comment_date().'</span>';
							    echo '<a href="#">'.comment_reply_link( array_merge( $generator_args, array( 'reply_text' => __( 'Reply', 'generator' ), 'after' => '', 'depth' => $depth, 'max_depth' => $generator_args['max_depth'] ) ) ).'</a>';
                                                         
                            ?>
                         <div class="blog-post-comment-text comment">
                              <?php comment_text(); ?>
                         </div>
          <!-- .comment-content --> 
        </div>
            </div>
            <div class="comment-line-post"></div>
    <!-- .txt-holder --> 
  </article>
  <!-- #comment-## -->
  <?php
		}
		break;
	endswitch; // end comment_type check
}
endif;
function generator_header_scroll() {
	if(!is_user_logged_in()): 
		echo 'margin-top-bottom-2'; 
	else : 
		echo' margin-top-bottom-3'; 
	endif;
}
