<?php
/**
 * buzmag functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package buzmag
 */

if ( ! function_exists( 'buzmag_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function buzmag_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on buzmag, use a find and replace
		 * to change 'buzmag' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'buzmag', get_template_directory() . '/languages' );

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
        add_image_size('buzmag-single-page',1245,600,true);
        add_image_size('buzmag-slider-img-1',390,500,true);
        add_image_size('buzmag-slider-img-2',585,380,true);
        add_image_size('buzmag-slider-feature-1',280,380,true);
        add_image_size('buzmag-slider-feature-2',470,230,true);
        add_image_size('buzmag-slider-feature-3',230,227,true);
        add_image_size('buzmag-slider-blog-list-image-1',750,560,true);
        add_image_size('buzmag-portfolio-image',600,600,true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'buzmag-primary-menu' => esc_html__( 'Primary Menu', 'buzmag' ),
		) );
        register_nav_menus( array(
			'buzmag-top-menu' => esc_html__( 'Top Menu', 'buzmag' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'buzmag_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 80,
    		'width'       => 262,
    		'flex-width'  => false,
    		'flex-height' => false,
		) );
	}
endif;
add_action( 'after_setup_theme', 'buzmag_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function buzmag_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'buzmag_content_width', 640 );
}
add_action( 'after_setup_theme', 'buzmag_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function buzmag_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'buzmag' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'buzmag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'buzmag' ),
		'id'            => 'buzmag-left-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'buzmag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Home With Right Sidebar', 'buzmag' ),
		'id'            => 'buzmag-home-with-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'buzmag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Home Full Width', 'buzmag' ),
		'id'            => 'buzmag-home-full-width',
		'description'   => esc_html__( 'Add widgets here.', 'buzmag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'buzmag_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function buzmag_scripts() {
    $buzmag_font_query_args = array('family' => 'Roboto:100,200,300,400,500,600,700,800|Dancing+Script:400,700');
    wp_enqueue_style('buzmag-google-fonts', add_query_arg($buzmag_font_query_args, "//fonts.googleapis.com/css"));
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_style('jquery-fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css' );
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/js/OwlCarousel/owl.carousel.css' );
	wp_enqueue_style('buzmag-style', get_stylesheet_uri());
    wp_enqueue_style('buzmag-responsive', get_template_directory_uri() . '/css/responsive.css' );
    
    wp_enqueue_script('theia-sticky-sidebar',get_template_directory_uri().'/js/theia-sticky-sidebar/theia-sticky-sidebar.js',array('jquery'));
    wp_enqueue_script('jquery-fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.js',array('jquery') );
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/OwlCarousel/owl.carousel.js',array('jquery') );
	wp_enqueue_script('buzmag-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script('buzmag-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    wp_enqueue_script('buzmag-custom', get_template_directory_uri() . '/js/buzmag-custom.js', array('jquery'));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'buzmag_scripts' );

function buzmag_customizer_enqueue(){
    wp_enqueue_script( 'jquery-ui-button' );
    wp_enqueue_style( 'buzmag-customizer-style', get_template_directory_uri() . '/inc/customizer/css/customizer-style.css' );
    wp_enqueue_script( 'buzmag-customizer-script', get_template_directory_uri() . '/inc/customizer/js/customizer-script.js', array( 'jquery', 'customize-controls' ), '20160714', true );
}
add_action('customize_controls_enqueue_scripts','buzmag_customizer_enqueue');
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer Option.
 */
require get_template_directory() . '/inc/customizer/customizer-options.php';

/**
 * Buzmag Functions.
 */
require get_template_directory() . '/inc/buzmag-function.php';

/**
 * Widget Fields
 **/
require get_template_directory() . '/inc/widget/widgets-field.php';

/**
 * Simple Blog List
 **/
require get_template_directory() . '/inc/widget/buzmag-simple-blog-list.php';

/**
 * Category Blog List
 **/
require get_template_directory() . '/inc/widget/buzmag-category-blog.php';

/**
 * Post Slide
 **/
require get_template_directory() . '/inc/widget/buzmag-post-slide.php';

/**
 * Masonry Post
 **/
require get_template_directory() . '/inc/widget/buzmag-masonry-post.php';

/**
 * Dynamic Style
 **/
require get_template_directory() . '/css/buzmag-dynamic-style.php';

/**
 * Sidebar Recent Post
 **/
require get_template_directory() . '/inc/widget/buzmag-sidebar-recent-post.php';