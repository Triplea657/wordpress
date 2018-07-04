<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Olesya_Lite
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<?php echo olesya_lite_do_preloader();?>

	<a class="skip-link screen-reader-text" href="#site-navigation"><?php esc_html_e( 'Skip to primary navigation', 'olesya-lite' ); ?></a>
	<?php if( has_nav_menu( 'primary' ) ) :?>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'olesya-lite' ); ?></a>
	<?php endif;?>
	<?php if( is_active_sidebar( 'sidebar-1' ) && olesya_lite_is_custom_template() ) :?>
		<a class="skip-link screen-reader-text" href="#secondary"><?php esc_html_e( 'Skip to sidebar', 'olesya-lite' ); ?></a>
	<?php endif;?>
	<?php if( is_active_sidebar( 'sidebar-2' ) ) :?>
		<a class="skip-link screen-reader-text" href="#tertiary"><?php esc_html_e( 'Skip to footer', 'olesya-lite' ); ?></a>
	<?php endif;?>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			olesya_lite_custom_logo();
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

	</header><!-- #masthead -->

	<?php if ( has_nav_menu( 'primary' ) ) :?>
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Navigation', 'olesya-lite' ); ?></button>
		<?php wp_nav_menu( array(
			'theme_location' 	=> 'primary',
			'menu_id' 			=> 'primary-menu',
			'container_class' 	=> 'wrap'
		) ); ?>
	</nav><!-- #site-navigation -->
	<?php endif;?>

	<div id="content" class="site-content">
