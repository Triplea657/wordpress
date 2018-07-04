<?php
/**
 * Olesya Lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Olesya_Lite
 */

/**
 * Olesya Lite only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'olesya_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function olesya_lite_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Olesya Lite, use a find and replace
	 * to change 'olesya-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'olesya-lite', trailingslashit( WP_LANG_DIR ) . 'themes/' );
	load_theme_textdomain( 'olesya-lite', get_stylesheet_directory() . '/languages' );
	load_theme_textdomain( 'olesya-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/** Set post thumbnail size */
	set_post_thumbnail_size( 810, 466, array( 'center', 'top' ) );

	add_image_size( 'olesya-lite-featured-image', 1140, 565, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 714;

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		/** Primary Link menu location */
		'primary' => esc_html__( 'Primary', 'olesya-lite' ),
		/** Social Link menu location */
		'social' => esc_html__( 'Social Link', 'olesya-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.min.css' ) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

}
endif;
add_action( 'after_setup_theme', 'olesya_lite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function olesya_lite_content_width() {

	$content_width = $GLOBALS['content_width'];

	if ( is_page_template( 'page-templates/full-width.php' ) ) {
		$content_width = 1044;
	}

	$GLOBALS['content_width'] = apply_filters( 'olesya_lite_content_width', $content_width );

}
add_action( 'template_redirect', 'olesya_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function olesya_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'olesya-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'olesya-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Footer 1', 'olesya-lite' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'olesya-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Footer 2', 'olesya-lite' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'olesya-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Footer 3', 'olesya-lite' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here.', 'olesya-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Slider', 'olesya-lite' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'This widget area will replace built-in content slider with 3rd party slider plugins.', 'olesya-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'olesya_lite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function olesya_lite_scripts() {

	wp_dequeue_style( 'contact-form-7' );

	if ( wp_style_is( 'font-awesome', 'registered' ) ) {
		wp_enqueue_style( 'font-awesome' );
	} else {
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
	}

	wp_enqueue_style( 'olesya-lite-style', get_stylesheet_uri() );
	wp_enqueue_style( 'olesya-lite-modules-style', get_template_directory_uri() . "/css/modules.min.css", array( 'olesya-lite-style' ), '1.0.0' );

	/** Scripts */

	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/fitvids/FitVids.js', array( "jquery" ), '1.1', true );
	wp_enqueue_script( 'jquery-smooth-scroll', get_template_directory_uri() . '/js/jquery-smooth-scroll/jquery.smooth-scroll.min.js', array( "jquery" ), '2.0.0', true );
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/js/slick/slick.min.js', array( "jquery" ), '1.6.0', true );
	wp_enqueue_script( 'jquery-sticky-kit', get_template_directory_uri() . '/js/stickit/jquery.stickit.min.js', array( "jquery" ), '0.2.13', true );
	wp_enqueue_script( 'olesya-lite', get_template_directory_uri() . '/js/olesya-lite.js', array(  "jquery"  ), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'olesya_lite_scripts' );

/**
 * Vendor scripts.
 */
require get_template_directory() . '/inc/vendor/vendor.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions helper.
 */
require get_template_directory() . '/inc/utility.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
