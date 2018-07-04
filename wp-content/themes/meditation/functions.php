<?php
/**
 * Functions and definitions
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
*/

/**
 * Set up the content width value.
 *
 * @since Meditation 1.0.0
 */
      
if ( ! isset( $content_width ) ) {
	$content_width = 1280;
}

if ( ! isset( $meditation_sidebars ) ) {
	$meditation_sidebars = array();
}

define ( 'MEDITATION_VERSION', '1.1.0' );

if ( ! function_exists( 'meditation_setup' ) ) :

/**
 * meditation setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * @since Meditation 1.0.0
 */

function meditation_setup() {

	load_theme_textdomain( 'meditation', get_template_directory() . '/languages' );
	
	$defaults = meditation_get_defaults();
	
	global $meditation_sidebar_slug;
	$meditation_sidebar_slug = null;
	
	/* new */
	global $meditation_widget_sidebars;
	$meditation_widget_sidebars = array();

	/* default values */
	global $meditation_defaults;
	$meditation_defaults = null;

	/* custom layouts */
	global $meditation_layout_class;
	$meditation_layout_class = new meditation_Layout_Class();	
	
	/* custom colors */
	global $meditation_colors_class;

	if ( class_exists ( 'meditation_Colors_Class' ) && '1' == meditation_get_theme_mod( 'is_custom_colors' ) ) {
		$meditation_colors_class = new meditation_Colors_Class();	
	}		

	if ( '1' == meditation_get_theme_mod( 'is_show_top_menu' ) )
		register_nav_menu( 'top1', __( 'Top Menu', 'meditation' ));
	
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'custom-background', array(
		'default-color' => 'cccccc',
	) );

	add_theme_support( 'post-thumbnails' );
	
	set_post_thumbnail_size( meditation_get_theme_mod( 'post_thumbnail_size' ) , 9999 ); 
	
	$args = array(
		'default-image'          => esc_url( get_template_directory_uri() ) . '/img/header.jpg',
		'header-text'            => true,
		'default-text-color'     => meditation_text_color(get_theme_mod('color_scheme'), $defaults ['color_scheme']),
		'width'                  => absint( meditation_get_theme_mod('size_image') ),
		'height'                 => absint( meditation_get_theme_mod('size_image_height') ),
		'flex-height'            => true,
		'flex-width'             => true,
	);
	add_theme_support( 'custom-header', $args );
	
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'caption'
	) );
	
	add_theme_support( 'title-tag' );
	
	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 100,
		'height'      => 48,
		'flex-width'  => true,
	) );
	
	// Add theme support for Starter Content
	$starter_content = array(
		'widgets' => array(
			// Header Sidebar
			'sidebar-header' => array(
				'search',
			),

			// Column 1
			'column-1-default' => array(
				'text_business_info',
				'text_about',
				'recent-posts',
				'categories',
			),			
			// Footer 1
			'sidebar-footer-1' => array(
				'text_business_info',
			),

			// Footer 2
			'sidebar-footer-2' => array(
				'text_about',
				'search',
			),			
			// Footer 3
			'sidebar-footer-3' => array(
				'pages',
			),
		),
		'theme_mods' => array(
			'fixed_1_widget_num' => '1',
		),

		// Set up nav menu
		'nav_menus' => array(
			'top1' => array(
				'name' => __( 'Top Menu', 'meditation' ),
				'items' => array(
					'link_home', 
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),
	);

	add_theme_support( 'starter-content', $starter_content );
	
	/*
	 * Enable support for WooCommerce plugin.
	 */
	 
	add_theme_support( 'woocommerce' );

}
add_action( 'after_setup_theme', 'meditation_setup' );
endif;

/**
 * Return the Google font stylesheet URL if available.
 *
 * @since Meditation 1.0.0
 */
function meditation_get_font_url() {

	$font_url = '';
	$font = str_replace( ' ', '+', meditation_get_theme_mod( 'font_1' ) );
	$font_2 = str_replace( ' ', '+', meditation_get_theme_mod( 'font_2' ) );
	$font_3 = str_replace( ' ', '+', meditation_get_theme_mod( 'font_3' ) );

	if ( '' == $font && '' == $font_2 && '' == $font_3 ) 
		return $font_url;
	if ( '' != $font && '' != $font_2 )
		$font .= '%7C';
		
	$font .= $font_2;	
	
	if ( '' != $font && '' != $font_3 )
		$font .= '%7C';

	$font .= $font_3;
	
	$subsets = 'latin,latin-ext';
	$family = $font . ':300,400';
						
	if (  meditation_get_theme_mod( 'subset_cyrillic' ) == '1' ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	}
	if (  meditation_get_theme_mod( 'subset_greek' ) == '1' ) {
		$subsets .= ',greek,greek-ext';
	}
	if (  meditation_get_theme_mod( 'subset_vietnamese' ) == '1' ) {
		$subsets .= ',vietnamese';
	}

	$query_args = array(
		'family' => $family,
		'subset' => $subsets,
	);
	$font_url = "//fonts.googleapis.com/css?family=" . $family . '&' . $subsets;

	return $font_url;
}
/**
 * Enqueue scripts and styles for front-end.
 *
 * @since Meditation 1.0.0
 */
function meditation_scripts_styles() {

	$defaults = meditation_get_defaults();
	
	// Add Genericons font.
	wp_enqueue_style( 'meditation-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), MEDITATION_VERSION );
	
	$font_url = meditation_get_font_url();
	if ( ! empty( $font_url ) )
		wp_enqueue_style( 'meditation-fonts', esc_url_raw( $font_url ), array(), MEDITATION_VERSION );
		
	// Loads our main stylesheet.
	wp_enqueue_style( 'meditation-style', get_stylesheet_uri(), array(), MEDITATION_VERSION );

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		
	// Adds JavaScript for handing the navigation menu hide-and-show behavior.
	wp_enqueue_script( 'meditation-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), MEDITATION_VERSION, true );
	
	// color scheme css
	wp_enqueue_style( 'meditation-colors', get_template_directory_uri() . '/css/scheme-' . esc_attr( meditation_get_theme_mod( 'color_scheme' ) ) . '.css', array(), MEDITATION_VERSION );
	
	// css3 transitions
	wp_enqueue_style( 'meditation-animate', get_template_directory_uri() . '/css/animate.css', array(), MEDITATION_VERSION );
	
	//header animation js
	if ( meditation_get_theme_mod( 'header_effect_class' ) != 0 ) {
		wp_enqueue_script( 'meditation-header', get_template_directory_uri() . '/js/header.js', array( 'jquery' ), MEDITATION_VERSION, true );
	}	
	
	// blog animation js
	if ( meditation_get_theme_mod( 'blog_effect_class' ) != 0 ) {
		wp_enqueue_script( 'meditation-blog', get_template_directory_uri() . '/js/blog.js', array( 'jquery' ), MEDITATION_VERSION, true );
	}
	
	// sidebar animation js
	if ( meditation_get_theme_mod( 'sidebar_effect_class' ) != 0 ) {
		wp_enqueue_script( 'meditation-sidebar', get_template_directory_uri() . '/js/sidebar.js', array( 'jquery' ), MEDITATION_VERSION, true );
	}	
	// fixed widget js
	if ( meditation_get_theme_mod( 'fixed_1_widget' ) != '0' || meditation_get_theme_mod( 'fixed_2_widget' ) != '0'  ) {
		wp_enqueue_script( 'meditation-widget', get_template_directory_uri() . '/js/fixed-widget.js', array( 'jquery' ), MEDITATION_VERSION, true );
	}

}
add_action( 'wp_enqueue_scripts', 'meditation_scripts_styles' );
 
/**
 * Add Editor styles and fonts to Tiny MCE
 *
 * @since Meditation 1.0.0
 */
function meditation_add_editor_styles() {
	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', 'css/scheme-' . esc_attr( meditation_get_theme_mod( 'color_scheme' ) ) . '.css' ) );
	
	$font_url = meditation_get_font_url();
	if ( ! empty( $font_url ) )
		 add_editor_style( $font_url );
}
//add_action( 'after_setup_theme', 'meditation_add_editor_styles' );

/**
 * Extend the default WordPress body classes.
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 *
 * @since Meditation 1.0.0
 */

function meditation_body_class( $classes ) {

	$background_color = get_background_color();
	$background_image = get_background_image();
	
	$defaults = meditation_get_defaults();
		
	if(meditation_get_theme_mod('content_style') == 'boxed'){
		$classes[] = 'boxed-content';
	}	
	if(meditation_get_theme_mod('site_style') == 'boxed'){
		$classes[] = 'boxed-site';
	}
	
	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background';
		elseif ( in_array( $background_color, array( 'd1d1d1', 'd1d1d1' ) ) )
			$classes[] = 'custom-background';
	}
	
	// Enable custom class only if the header text enabled.
	if ( display_header_text() && ( meditation_get_theme_mod( 'is_text_on_front_page_only' ) != '1' || is_front_page() ) ) {
		$classes[] = 'header-text-is-on';
	}
	
	if( is_front_page() && '' == meditation_get_theme_mod('front_page_style') && ! is_home() ) {
		$classes[] = 'no-content';
	}
	
	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'meditation-fonts', 'queue' ) )
		$classes[] = 'google-fonts-on';

	// Animate header text on window load.
	if ( meditation_get_theme_mod( 'header_effect_class' ) != 0 ) {
		$classes[] = 'animate-on-load';		
	
		// Restart header text animation on window scrolling.
		if ( meditation_get_theme_mod( 'is_restart_header' ) == '1' ) 
			$classes[] = 'restart-header';
	}
	
	// Header animation class
	$classes[] = 'header-effect-' . meditation_get_theme_mod( 'header_effect_class' );
	
	// Sticky Menu
	if ( meditation_get_theme_mod( 'is_sticky_first_menu' ) == '1' ) 
		$classes[] = 'sticky-menu';
	
	// Sticky Menu animation class
	$classes[] = 'menu-effect-' . meditation_get_theme_mod( 'menu_effect_class' );
	
	// Animate blog on window scroll.
	if ( meditation_get_theme_mod( 'blog_effect_class' ) != 0 ) {
		$classes[] = 'animate-blog';	
		// Restart blog animation on window scrolling.
		if ( meditation_get_theme_mod( 'is_restart_blog' ) == '1' ) 
			$classes[] = 'restart-blog';	
	}
	// Blog animation class
	$classes[] = 'blog-effect-' . meditation_get_theme_mod( 'blog_effect_class' );	
	
	// Animate sidebar on window scroll.
	if ( meditation_get_theme_mod( 'sidebar_effect_class' ) != 0 ) {
		$classes[] = 'animate-sidebar';	
		// Restart sidebar animation on window scrolling.
		if ( meditation_get_theme_mod( 'is_restart_sidebar' ) == '1' ) 
			$classes[] = 'restart-sidebar';	
	}
	
	// Sidebar animation class
	$classes[] = 'sidebar-effect-' . meditation_get_theme_mod( 'sidebar_effect_class' );

	// Fixed widget classes
	if ( meditation_get_theme_mod( 'fixed_1_widget' ) == '1' ) {
		$classes[] = 'widget-1-fixed';
		$classes[] = 'widget-1-num-' . meditation_get_theme_mod( 'fixed_1_widget_num' );
	}
	if ( meditation_get_theme_mod( 'fixed_2_widget' ) == '1' ) {
		$classes[] = 'widget-2-fixed';
		$classes[] = 'widget-2-num-' . meditation_get_theme_mod( 'fixed_2_widget_num' );
	}
	
	return $classes;
}
add_filter( 'body_class', 'meditation_body_class' );

/**
 * Create not empty title
 *
 * @since Meditation 1.0.0
 *
 * @param string $title Default title text.
 * @param int $id.
 * @return string The filtered title.
 */
function meditation_title( $title, $id = null ) {

    if ( trim($title) == '' && (is_archive() || is_home() || is_search() ) ) {
        return ( esc_html( get_the_date() ) );
    }
	
    return $title;
}
add_filter( 'the_title', 'meditation_title', 10, 2 );

if ( ! function_exists( 'meditation_text_color' ) ) :

/**
 * Return default header text color
 *
 * @since Meditation 1.0.0
 *
 * @param string color_scheme color scheme.
 * @return string header url.
 */
function meditation_text_color( $color_scheme ) {

	switch ($color_scheme) {		
		case '1':
			$text_color = '1e73be';
		break;
		case '3':
			$text_color = 'dd9933';
		break;
		case '4':
		case '9':
			$text_color = '000000';
		break;		
		case '8':
			$text_color = '#dd3333';
		break;		
		case '10':
			$text_color = '4c1903';
		break;		
		case '11':
		case '12':
			$text_color = '6b6b6b';
		break;		
		case '13':
			$text_color = '25bae8';
		break;		
		case '14':
			$text_color = '1e73be';
		break;
		default:
			$text_color = 'ffffff';
		break;
	}

    return $text_color;
}

endif;

if ( ! function_exists( 'meditation_post_nav' ) ) :
/**
 * Display navigation to next/previous post.
 *
 * @since Meditation 1.0.0
 */
function meditation_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'meditation' ); ?></h1>
		<div class="nav-link">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'meditation' ) );
			else :
				$next = next_post_link( '%link ', __( '<span class="nav-next">%title &rarr;</span>', 'meditation' ) );
				if ( $next ) :
					previous_post_link( '%link', __( '<span class="nav-previous">&larr; %title</span>', 'meditation' ) );
					$next;
				else :
					previous_post_link( '%link', __( '<span class="nav-previous-one">&larr; %title</span>', 'meditation' ) );
				endif;
				
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<div class="clear"></div>
	<?php
}
endif;

if ( ! function_exists( 'meditation_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Meditation 1.0.0
 */
function meditation_paging_nav() {

	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'meditation' ),
		'next_text' => __( 'Next &rarr;', 'meditation' ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'meditation' ); ?></h1>
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
	
}
endif;

if ( ! function_exists( 'meditation_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Meditation 1.0.0
 */
function meditation_the_attached_image() {
	$post                = get_post();

	$attachment_size     = apply_filters( 'meditation_attachment_size', array( 987, 9999 ) );
	$next_attachment_url = esc_url( wp_get_attachment_url() );

	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}

		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'meditation_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since Meditation 1.0.0
 */
function meditation_posted_on() {
	
	$is_author = ( is_singular() ? ( '1' == meditation_get_theme_mod( 'is_author' ) ? true : false ) : 
									( '1' == meditation_get_theme_mod( 'blog_is_author' ) ? true : false ) );
									
	$is_date = ( is_singular() ? ( '1' == meditation_get_theme_mod( 'is_date' ) ? true : false ) : 
									( '1' == meditation_get_theme_mod( 'blog_is_date' ) ? true : false ) );
									
	$is_comments = ( is_singular() ? ( '1' == meditation_get_theme_mod( 'is_comments' ) ? true : false ) : 
									( '1' == meditation_get_theme_mod( 'blog_is_comments' ) ? true : false ) );
									
	$is_views = ( is_singular() ? ( '1' == meditation_get_theme_mod( 'is_views' ) ? true : false ) : 
									( '1' == meditation_get_theme_mod( 'blog_is_views' ) ? true : false ) );
	$rez = '';
	// Set up and print post meta information.
	if ( $is_date ) {
	
		echo '<span class="entry-date">
					<a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( get_the_date( '' ) ) . '" rel="bookmark">
						<span class="entry-date" datetime="' . esc_attr( get_the_date( '' ) ) . '">' . esc_html( get_the_date() ) .  '</span>
					</a>
			 </span>';
	}
	
	if ( $is_author ) {
	
		echo '<span class="byline">
				<span title="' . esc_attr( get_the_author() ) . '" class="author vcard">
					<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">' . get_the_author() . '</a>
				</span>
			</span>';
	}
	
	if ( $is_views ) {
	
		if( class_exists('Jetpack') && Jetpack::is_module_active('stats') && function_exists ( 'stats_get_csv' ) ) {
			$result = $result = stats_get_csv( 'postviews', 'post_id=' . get_the_ID() . '&days=-1&limit=-1&summarize');
			
			echo '<span class="post-views" title="' . esc_attr( number_format_i18n( $result[0]['views'] ) ) . '">' 
					. esc_attr( number_format_i18n( $result[0]['views'] ) ) .
			 '</span>';
			
		}
	}
	
	if ( $is_comments ) {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( __( 'Leave a comment', 'meditation' ), __( '1 Comment', 'meditation' ), __( '% Comments', 'meditation' ) );
			echo '</span>';
		}

	}

}
endif;


if ( ! function_exists( 'meditation_content_width' ) ) :
/**
 * Adjust content width in certain contexts.
 *
 * @since Meditation 1.0.0
 */
function meditation_content_width() {
	
	global $meditation_layout_class;
	global $content_width;
	
	$curr_layout = $meditation_layout_class->get_layout();
	$curr_content_layout = $meditation_layout_class->get_content_layout();
	$content_columns = preg_replace('/[^0-9]/','',$curr_content_layout);	
	$content_area_width = meditation_calc_content_width( $curr_layout );
	$content_width = meditation_calc_content_column_width ($content_area_width, $content_columns); 
}
add_action( 'template_redirect', 'meditation_content_width' );

endif;

if ( ! function_exists( 'meditation_calc_content_column_width' ) ) :
/**
 * Calculate width of the content area
 *
 * @param int width of content area.
 * @param int columns count.
 * @return int width of column.
 * @since Meditation 1.0.0
 */
function meditation_calc_content_column_width( $width, $columns ) {
	
	switch( $columns ) {
		case 1:
		break;	
		case 2:
			$width = $width/100*48;
		break;	
		case 3:
			$width = $width/100*30;
		break;	
		case 4:
			$width = $width/100*22;
		break;
	}
	$width = absint($width - 2); 
	
	return $width;
}
endif;

if ( ! function_exists( 'meditation_calc_content_width' ) ) :
/**
 * Calculate width of the content area
 *
 * @param string current layout.
 * @return int width of the content area.
 * @since Meditation 1.0.0
 */
function meditation_calc_content_width( $curr_layout ) {

	$content_width = (meditation_get_theme_mod( 'width_main_wrapper' ) > meditation_get_theme_mod( 'width_site' ) ? meditation_get_theme_mod( 'width_site' ) : meditation_get_theme_mod( 'width_main_wrapper' ) );
	$unit = meditation_get_theme_mod('unit');

	if( 'left-sidebar' == $curr_layout) {
		$content_width = $content_width - $content_width/100*meditation_get_theme_mod('width_column_1_left_rate') - 40;
	} 
	elseif( 'right-sidebar' == $curr_layout) {
		$content_width = $content_width - $content_width/100*meditation_get_theme_mod('width_column_1_right_rate') - 40;
	}
	elseif( 'two-sidebars' == $curr_layout) {
		$content_width = $content_width - $content_width/100*meditation_get_theme_mod('width_column_1_rate') - $content_width/100*meditation_get_theme_mod('width_column_2_rate') - 40;
	}
	else {
		$content_width -= 40;
	}

	$content_width = absint($content_width);
	return $content_width;
}
endif;
 /**
 * Return array: default theme options
 *
 * @since Meditation 1.0.0
 */
 
function meditation_get_defaults() {

	global $meditation_defaults;
	
	if(isset($meditation_defaults)) {
		return $meditation_defaults;
	}
	
	$defaults = array(  'is_thumbnail_empty_icon' => '',
					    'is_cat' => '1',
						'is_author' => '1',
						'is_date' => '1',
						'is_views' => '',
						'is_comments' => '1',
						'blog_is_cat' => '1',
						'blog_is_author' => '1',
						'blog_is_date' => '1',
						'blog_is_views' => '',
						'blog_is_comments' => '1',
						'blog_is_entry_meta' => '1',
						'blog_is_cat' => '1',
						'is_sticky_first_menu' => '1',
						'site_style' => 'full',
						'is_defaults_post_thumbnail_background' => '1',
						'logotype_url' =>  esc_url( get_template_directory_uri() ) . '/img/logo.png',
						'is_show_top_menu' => '1',
						'post_thumbnail_size' => '400',
						'scroll_button' => 'none',
						'scroll_animate' => 'none',
						'is_header_on_front_page_only' => '',
						'font_scheme' => 2,
						'font_1' => 'Open Sans',
						'font_2' => 'Pangolin',
						'font_3' => 'Tangerine',
						'site_font' => 1,
						'header_font' => 2,
						'description_font' => 3,
						'menu_font' => 2,
						'submenu_font' => 1,
						'title_font' => 2,
						'link_font' => 2,
						'cat_font' => 2,
						'meta_font' => 1,
						'w_font' => 1,
						'w_title_font' => 2,
						'w_link_font' => 1,
						'color_scheme' => 0,
						'subset_cyrillic' => '1',
						'subset_greek' => '',
						'subset_latin' => '1',
						'subset_vietnamese' => '',
						'subset_thai' => '',
						'subset_arabic' => '',
						'is_text_on_front_page_only' => '',
						'front_page_style' => '1',	
						'is_home_footer' => '1',
						'unit' => 1,
						'width_site' => '1680',
						'width_main_wrapper' => '1680',
						'width_top_widget_area' => '1680',
						/* Header Image size */
						'size_image' => '1680',
						'size_image_height' => '400',
						/* Header Image and top sidebar wrapper */
						'width_image' => '1680',
						'width_content' => '1680',
						'header_style' => 'full',
						'content_style' => 'boxed',
						'width_column_1_rate' => '25',
						'width_column_1_left_rate' => '33',
						'width_column_1_right_rate' => '33',
						'width_column_2_rate' => '25',
						/* post: excerpt/content */
						'single_style' => 'excerpt',
						'is_display_post_image' => '1',
						'is_display_post_tags' => '1',
						'is_display_post_cat' => '1',
						/* page: excerpt/content */
						'page_style' => 'excerpt',
						'is_display_page_image' => '1',
						'empty_image' => esc_url( get_template_directory_uri() ) . '/img/empty.png',
						'footer_text' => '<a href="' . esc_url( __( 'http://wordpress.org/', 'meditation' ) ) . '">' . __( 'Powered by WordPress', 'meditation' ). '</a> | ' . __( 'theme ', 'meditation' ) . '<a href="' .  esc_url( __( 'https://visualpharm.com/wpblogs/themes/theme/meditation/', 'meditation') ) . '">Meditation</a>',
						'is_show_cat' => '1',
						/* customiser panels */
						'is_custom_colors' => '1',
						/* animation */
						'is_animate_header' => '1',
						'header_effect_class' => '10',
						'menu_effect_class' => '14',
						'blog_effect_class' => '5',
						'sidebar_effect_class' => '13',
						'is_restart_blog' => '',
						'is_restart_header' => '1',
						'is_restart_sidebar' => '',
						'fixed_1_widget' => '1',
						'fixed_2_widget' => '1',
						'fixed_1_widget_num' => '10',
						'fixed_2_widget_num' => '1',
						'is_display_read_more' => '1',
						'read_more_text' => __( 'See More', 'meditation' ),
						'width_mobile_switch' => 960,
						'is_custom_widgets' => '1',
						'is_display_donate' => '1',
				);

/* declare theme sidebars */

	$defaults['theme_sidebars']['column-1']  = array (
													'title' => __( 'First column', 'meditation' ), 
													'is_checked' => '', 
													'is_constant' => '');
	$defaults['theme_sidebars']['column-2']  = array (
													'title' => __( 'Second column', 'meditation' ), 
													'is_checked' => '', 
													'is_constant' => '');
	$defaults['theme_sidebars']['sidebar-header']  = array (
													'title' => __( 'Header Sidebar', 'meditation' ), 
													'is_checked' => '', 
													'is_constant' => '1');													
	$defaults['theme_sidebars']['sidebar-footer-1']  = array (
													'title' => __( 'Footer Sidebar 1', 'meditation' ), 
													'is_checked' => '', 
													'is_constant' => '1');	
	$defaults['theme_sidebars']['sidebar-footer-2']  = array (
													'title' => __( 'Footer Sidebar 2', 'meditation' ), 
													'is_checked' => '', 
													'is_constant' => '1');	
	$defaults['theme_sidebars']['sidebar-footer-3']  = array (
													'title' => __( 'Footer Sidebar 3', 'meditation' ), 
													'is_checked' => '', 
													'is_constant' => '1');

	/* order is important */
	$defaults['defined_sidebars']['static'] = array(
											'use' => '1',
											'callback' => '',
											'param' => '', 
											'title' => __( 'Static', 'meditation' ), 
											'sidebar-footer-1' => '1',
											);//Sidebars, visible on all posts and pages

	$defaults['defined_sidebars']['default'] = array(
											'use' => '1', 
											'callback' => '', 
											'param' => '', 
											'title' => __( 'Default', 'meditation' ),
											'column-1' => '1', 
											'column-2' => '1',
											);
	
	$defaults['defined_sidebars']['page'] = array(
											'use' => '', 
											'callback' => 'is_page', 
											'param' => '', 
											'title' => __( 'Pages', 'meditation' ),
											'column-1' => '1',
											'column-2' => '1', 
											);
	$defaults['defined_sidebars']['archive'] = array(
											'use' => '', 
											'callback' => 'is_archive', 
											'param' => '', 
											'title' => __( 'Archive', 'meditation' ),
											'column-1' => '1',
											'column-2' => '1', 
											);
											
	if ( class_exists( 'WooCommerce' ) ) {
		$defaults['defined_sidebars']['shop-page'] = array(
												'use' => '', 
												'callback' => 'meditation_is_shop_page', 
												'param' => '', 
												'title' => __( 'Shop (Page)', 'meditation' ),
												'column-1' => '1',
												'column-2' => '1', 
												);	
		$defaults['defined_sidebars']['shop'] = array(
												'use' => '', 
												'callback' => 'meditation_is_shop', 
												'param' => '', 
												'title' => __( 'Shop (Archive)', 'meditation' ),
												'column-1' => '1',
												'column-2' => '1', 
												);
	}
	$defaults['defined_sidebars']['blog'] = array(
											'use' => '', 
											'callback' => 'is_home', 
											'param' => '', 
											'title' => __( 'Blog', 'meditation' ),
											'column-1' => '1',
											'column-2' => '1', 
											);
	$defaults['defined_sidebars']['search'] = array(
											'use' => '', 
											'callback' => 'is_search', 
											'param' => '',
											'title' => __( 'Search', 'meditation' ),
											'column-1' => '1',
											'column-2' => '1', 
											);
	$defaults['defined_sidebars']['home'] = array(
											'use' => '', 
											'callback' => 'is_front_page', 
											'param' => '', 
											'title' => __( 'Home', 'meditation' ),
											'column-1' => '1',
											'column-2' => '1', 
											);
	$defaults['defined_sidebars']['page404'] = array(
											'use' => '',
											'callback' => 'is_404',
											'param' => '',
											'title' => __( 'Page 404', 'meditation' ),
											'column-1' => '1',
											'column-2' => '1',
											);

	$defaults['per_page_sidebars'] = array();

	
	return apply_filters( 'meditation_option_defaults', $defaults );
}

 /**
 * Return theme mod
 *
 * @since Meditation 1.0.0
*/
function meditation_get_theme_mod( $name ) {
	$defaults = meditation_get_defaults();
	return apply_filters ( 'meditation_theme_mod', get_theme_mod( $name, $defaults[$name] ), $name );
}

/**
 * Convert given sidebar id to id from $defaults array
 *
 * @param string $sidebar_id sidebar id with page slug.
 * @return string slug of current sidebar.
 * @since Meditation 1.0.0
 */
function meditation_san_sidebar_id( $sidebar_id ) {
	$defaults = meditation_get_defaults();

	foreach( $defaults['theme_sidebars'] as $id => $value ) {

		if( '' != trim( $id ) && false !== strrpos($sidebar_id, $id)) {
			return $id;
		}

	}
	 return false;
}

/**
 * Return width of sidebar
 *
 * @param string $sidebar_id slug of current sidebar with page prefix.
 * @return int max width of sidebar.
 * @since Meditation 1.0.0
 */
function meditation_get_sidebar_width( $sidebar_id ) {
	$defaults = meditation_get_defaults();
	$width = 1366;
	$sidebar_id = meditation_san_sidebar_id( $sidebar_id );
	if( false == $sidebar_id)
		return $width;
				
	switch ( $sidebar_id ) {
		case 'sidebar-footer':
			$width = meditation_get_theme_mod('width_main_wrapper')/3;
		break;
		case 'column-1':
			$width = 300;
		break;		
		case 'column-2':
			$width = 300;
		break;		
	}
		
	return $width;
}

/**
 * Return prefix for content-xxx.php file
 *
 * @since Meditation 1.0.0
 */
function meditation_get_content_prefix() {

	$post_type = get_post_type();
	$post_prefix = '';
	if( 'post' == $post_type) {
		$post_prefix = get_post_format();
	} else {
		$post_prefix = $post_type.'-'; 
	}
	if( is_search() || is_archive() || is_home() ) {
		$name = $post_prefix . ( '' == $post_prefix ? '' : '-') . 'archive';
		
		$located = locate_template( $name . '.php' );
		
		if ( ! empty( $located ) ) {
			return $name;
		} else {
			return 'archive';
		}
	}
	return get_post_format();

}

/**
 * Check for 'flex' prefix 
 *
 * @layout string content layout
 *
 * @since Meditation 1.0.0
 */
function meditation_content_class( $layout_content ) {
	$is_flex = strrpos($layout_content, 'flex');
	$layout_content = ( false === $is_flex ? $layout_content : 'flex '.$layout_content );
	return $layout_content;
}

 /**
 * Print credit links and scroll to top button
 *
 * @since Meditation 1.0.0
 */
function meditation_site_info() {
	$text = meditation_get_theme_mod( 'footer_text' );
	if ( '' != $text ) :
?>
	<div class="site-info">
		<?php echo wp_kses( $text, array(
								'a' => array(
									'href' => array(),
									'title' => array()
								),
								'br' => array(),
								'em' => array(),
								'strong' => array(),
							)
							); ?>
	</div><!-- .site-info -->
	
	<?php endif; 
	
	if ( 'none' != meditation_get_theme_mod( 'scroll_button' ) ) : ?>
		<a href="#" class="scrollup <?php echo esc_attr( meditation_get_theme_mod( 'scroll_button' )).
			esc_attr( 'none' == meditation_get_theme_mod( 'scroll_animate' ) ? '' : ' ' . meditation_get_theme_mod( 'scroll_animate' ) ); ?>"></a>
	<?php endif;
}
add_action( 'meditation_site_info', 'meditation_site_info' );

 /**
 * Retrieve the array of ids of all terms for the current archive page 
 *
 * @param string $tax, taxonomy name
 * @since Meditation 1.0.0
 */
function meditation_get_tax_ids( $tax ) {
	$tax_names = array();
	
	while ( have_posts() ) : the_post(); 
			
		$terms = get_the_terms( get_the_ID(), $tax );
								
		if ( $terms && ! is_wp_error( $terms ) ) : 

			foreach ( $terms as $id => $term ) {
				$tax_names[ $term->term_id ] = $term->name;
			}

		endif;
		
	endwhile; 
	
	rewind_posts();

	return array_unique( $tax_names );
}

 /**
 * Retrieve the array of ids of terms from the current page
 *
 * @param string $tax, taxonomy name
 * @since Meditation 1.0.0
 */
function meditation_get_curr_tax_ids( $tax ) {
	$tax_names = array();
		
	$terms = get_the_terms( get_the_ID(), $tax );
							
	if ( $terms && ! is_wp_error( $terms ) ) : 

		foreach ( $terms as $term ) {
			$tax_names[] = $term->term_id;
		}

	endif;
			
	return array_unique( $tax_names );
}

 /**
 * Retrieve the array of names of terms from the current page
 *
 * @param string $tax, taxonomy name
 * @since Meditation 1.0.0
 */
function meditation_get_curr_tax_names( $tax ) {
	$tax_names = array();
		
	$terms = get_the_terms( get_the_ID(), $tax );
							
	if ( $terms && ! is_wp_error( $terms ) ) : 

		foreach ( $terms as $term ) {
			$tax_names[] = $term->name;
		}

	endif;
			
	return array_unique( $tax_names );
}

/**
 * Add new wrapper for woocommerce pages.
 *
 * @since Meditation 1.0.0
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'meditation_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'meditation_wrapper_end', 10);

function meditation_wrapper_start() {
  echo '<div id="woocommerce-wrapper">';
}

function meditation_wrapper_end() {
  echo '</div>';
}

/**
 * Change related products number
 *
 * @since Meditation 1.0.0
 */
add_filter( 'woocommerce_output_related_products_args', 'meditation_related_products_args' );
function meditation_related_products_args( $args ) {

	$args['posts_per_page'] = 3;
	$args['columns'] = 3;
	return $args;
}

/**
 * Echo column sidebars
 *
 * @param string $layout current layout
 *
 * @since Meditation 1.0.0
 */
function meditation_get_sidebar( $layout ) {

	if ( 'two-sidebars' == $layout ) {
		get_sidebar();
	} elseif ( 'right-sidebar' == $layout ) {
		get_sidebar( '2' );
	} elseif ( 'left-sidebar' == $layout ) {
		get_sidebar( '1' );
	}
}

/**
 * Set excerpt length to 30 words
 *
 * @param string $length current length 
 *
 * @since Meditation 1.0.0
 */
function meditation_custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'meditation_custom_excerpt_length', 99999 );

/**
 * Return Trimmed excerpts
 *
 * @param int $charlength length of output
 *
 * @since Meditation 1.0.0
 */
function meditation_the_excerpt( $charlength = 200 ) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[&hellip;]';
	} else {
		echo $excerpt;
	}
}
/**
 * Top menu and site name
 *
 * @since Meditation 1.0.0
 */
function meditation_header() {

?>
	<div id="sg-site-header" class="sg-site-header">
		<!-- First Top Menu -->		
		<div class="menu-top top-1-navigation">						
			<?php if ( meditation_get_theme_mod( 'is_show_top_menu' ) == '1' ) : ?>
				<nav class="horisontal-navigation menu-1" role="navigation">
					<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) :
						the_custom_logo();
						elseif ( '' != meditation_get_theme_mod( 'logotype_url' ) ) : ?>
						<a class="small-logo" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
							<img src='<?php echo esc_url( meditation_get_theme_mod( 'logotype_url' ) ); ?>' class="menu-logo" alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
						</a><!-- .logo-section -->
					<?php endif; ?>
					<span class="toggle"><span class="menu-toggle"></span></span>
					<?php wp_nav_menu( array( 'theme_location' => 'top1', 'menu_class' => 'nav-horizontal', 'fallback_cb' => 'meditation_empty_menu' ) ); ?>
				</nav><!-- .menu-1 .horisontal-navigation -->
			<?php endif; ?>
			<div class="clear"></div>
		</div><!-- .menu-top  -->
	</div><!-- .sg-site-header -->
<?php
}
add_action( 'meditation_header_top', 'meditation_header', 20 );

/**
 * Fallback Menu
 *
 * @since Meditation 1.0.3
 */
function meditation_empty_menu() {
	return wp_page_menu( 'menu_class=nav-horizontal');
}
/**
 * Header image
 *
 * @since Meditation 1.0.0
 */
function meditation_header_image() {

	if ( get_header_image() && ( meditation_get_theme_mod( 'is_header_on_front_page_only' ) != '1' || is_front_page() ) ) : ?>	
		
			<!-- Banner -->
			<div class="image-container">
				<div class="image-wrapper">
				
					<div class="image-text-wrap">
						<div class="image-text">
							
							<div class="site-title">
								<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							</div><!-- .site-title -->
							<!-- Dscription -->
							<div class="site-description">
								<h2><?php echo bloginfo( 'description' ); ?></h2>
							</div><!-- .site-description -->
							
							<?php get_sidebar( 'header' ); ?>
							
						</div><!-- .image-text -->
					</div><!-- .image-text-wrap -->
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php header_image(); ?>" class="header-image" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="" />
					</a>
				</div><!-- .image-wrapper -->
			</div><!-- .image-container -->
		
	<?php else : ?>
	
		<div class="sg-site-header-1 no-image">
			<div class="image-text-wrap">
				<div class="image-text">
					<div class="site-title">
						<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					</div><!-- .site-title -->
					<!-- Dscription -->
					<div class="site-description">
						<h2><?php bloginfo( 'description' ); ?></h2>
					</div><!-- .site-description -->
					<?php get_sidebar( 'header' ); ?>
				</div><!-- .image-text -->
			</div><!-- .image-text-wrap -->
		</div><!-- .sg-site-header-1 -->
		
	<?php endif;
}
add_action( 'meditation_header_image', 'meditation_header_image', 20 );
/**
 * Add button to excerpt
 *
 * @since Meditation 1.0.0
 */
function meditation_excerpt_more( $excerpt_more ) {

	if ( '1' == meditation_get_theme_mod('is_display_read_more') ) {
		return sprintf( '&hellip;<div class="read-more"><a href="%1$s" class="read-more-link">' . esc_attr( meditation_get_theme_mod('read_more_text') ) . '</a></div>',
          esc_url( get_permalink( get_the_ID() ) ) );
	}
	return $excerpt_more;
}
add_action('excerpt_more', 'meditation_excerpt_more', 10, 2);

/**
 * Add wrapper to archive grid
 *
 * @since Meditation 1.0.0
 */
function meditation_grid_start( $layout, $num ) {

	if ( 'flex-layout-4' == $layout && 0 == $num % 4
		|| 'flex-layout-3' == $layout && 0 == $num % 3
		|| 'flex-layout-2' == $layout && 0 == $num % 2) :
	?>

	<div class="flex-container <?php echo ( 0 != meditation_get_theme_mod( 'blog_effect_class' ) ? esc_attr( 'animate-block' ) : '');?>">

	<?php endif;
}
add_action('meditation_grid_start', 'meditation_grid_start', 10, 2);

/**
 * Add wrapper to archive grid
 *
 * @since Meditation 1.0.0
 */
function meditation_grid_end( $layout, $num, $total ) {
	
	$curr_layout = intval( substr( $layout, -1 ) );

	if ( $curr_layout > 1 && $num == $total - 1 && 0 != ( $total % $curr_layout ) ) {
		$empty_blocks = $curr_layout - ( $total % $curr_layout );
		for ( $i = 0; $i < $empty_blocks; $i++ ) : ?>
		<div class="content-container empty-content">
		</div><!-- .content-container -->
		<?php endfor;
	}
	
	if ( $curr_layout > 1 && ( $curr_layout - 1 == $num % $curr_layout || $num == $total - 1 ) ) :
	?>

	</div><!-- .flex-container -->

	<?php endif;

}
add_action('meditation_grid_end', 'meditation_grid_end', 10, 3);

/**
 * Add wrapper to archive/shop grid
 *
 * @since Meditation 1.0.1
 */
function meditation_grid_start_woo() {
	if( ! is_archive() )
		return;

	global $meditation_layout_class;
	$layout = $meditation_layout_class->get_content_layout();
	global $wp_query;
	$num = $wp_query->current_post;
	if ( 'flex-layout-4' == $layout && 0 == $num % 4
		|| 'flex-layout-3' == $layout && 0 == $num % 3
		|| 'flex-layout-2' == $layout && 0 == $num % 2 ) :
	?>

	<ul class="flex flex-container <?php echo ( 0 != meditation_get_theme_mod( 'blog_effect_class' ) ? esc_attr( 'animate-block' ) : '');?>">
	<?php endif;
}
add_action('meditation_shop_grid_start', 'meditation_grid_start_woo');

/**
 * Add wrapper to archive grid
 *
 * @since Meditation 1.0.1
 */
function meditation_grid_end_woo() {
	if( ! is_archive() )
		return;
	
	global $meditation_layout_class;
	$layout = $meditation_layout_class->get_content_layout();
	global $wp_query;
	$num = $wp_query->current_post;
	$total = $wp_query->post_count;

	$curr_layout = intval( substr( $layout, -1 ) );

	if ( $curr_layout > 1 && $num == $total - 1 && 0 != ( $total % $curr_layout ) ) {
		$empty_blocks = $curr_layout - ( $total % $curr_layout );
		for ( $i = 0; $i < $empty_blocks; $i++ ) : ?>
		<div class="content-container empty-content">
		</div><!-- .content-container -->
		<?php endfor;
	}
	
	if ( $curr_layout > 1 && ( $curr_layout - 1 == $num % $curr_layout || $num == $total - 1 ) ) :
	?>

	</ul><!-- .flex-container -->
	<?php endif;

}
add_action('meditation_shop_grid_end', 'meditation_grid_end_woo', 10);

/**
 * Add widgets to the left sidebar on all pages
 *
 * @since Meditation 1.0.0
 */
function meditation_left_sidebar_default() {

	if ( '1' == meditation_get_theme_mod('is_custom_widgets') ) {
		the_widget( 'WP_Widget_Recent_Posts', 'title=' );
		the_widget( 'WP_Widget_Tag_Cloud', 'title=' );
		the_widget( 'WP_Widget_Categories', 'title=' );
	}
}
add_action('meditation_empty_column_1-default', 'meditation_left_sidebar_default', 20);

/**
 * Add widgets to the header sidebar
 *
 * @since Meditation 1.0.0
 */
function meditation_header_sidebar() {
	if ( '1' == meditation_get_theme_mod('is_custom_widgets') ) {
		the_widget( 'WP_Widget_Search', 'title=' );
	}
}
add_action('meditation_empty_sidebar-header', 'meditation_header_sidebar', 20);

/**
 * Hook widgets
 *
 * @package WordPress
 * @subpackage cats456
 * @since Meditation 1.0.0
*/

function meditation_home_footer_1() {
	if ( '1' == meditation_get_theme_mod('is_custom_widgets') ) {
		the_widget( 'WP_Widget_Search', 'title=' . esc_attr__( 'Search', 'meditation' ) );
	}

}
add_action('meditation_empty_sidebar_footer-1', 'meditation_home_footer_1', 20);

/**
 * Hook widgets
 *
 * @package WordPress
 * @subpackage cats456
 * @since Meditation 1.0.0
*/

function meditation_home_footer_2() {

	if ( '1' == meditation_get_theme_mod('is_custom_widgets') ) {
		the_widget( 'WP_Widget_Categories' );
	}

}
add_action('meditation_empty_sidebar_footer-2', 'meditation_home_footer_2', 20);

/**
 * Hook widgets
 *
 * @package WordPress
 * @subpackage cats456
 * @since Meditation 1.0.0
*/

function meditation_home_footer_3() {

	if ( '1' == meditation_get_theme_mod('is_custom_widgets') ) {
		the_widget( 'WP_Widget_Recent_Posts' );
	}
}
add_action('meditation_empty_sidebar_footer-3', 'meditation_home_footer_3', 20);


require get_template_directory() . '/inc/widget-functions.php';

// Add custom social media icons widget.
require get_template_directory() . '/inc/social-media-widget.php';
// Add customize options.
require get_template_directory() . '/inc/customize.php';
// Add sidebar options.
require get_template_directory() . '/inc/customize-sidebars.php';

if ( ! class_exists ( 'meditation_Layout_Class' ) ) :
	require get_template_directory() . '/inc/customize-layout.php';
endif;

if ( ! class_exists ( 'meditation_Colors_Class' ) && '1' == meditation_get_theme_mod( 'is_custom_colors' ) ) :
	require get_template_directory() . '/inc/customize-colors.php';
else :
	require get_template_directory() . '/inc/customize-colors-no-options.php';
endif;

require get_template_directory() . '/inc/customize-fonts.php';
require get_template_directory() . '/inc/customize-other.php';
require get_template_directory() . '/inc/customize-animate.php';

if ( '1' == meditation_get_theme_mod('is_display_donate') ) {
	require get_template_directory() . '/inc/customize-info.php';
}