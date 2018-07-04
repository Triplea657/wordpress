<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package buzmag
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'buzmag' ); ?></a>
	<header id="masthead" class="site-header">
        <?php $buzmag_top_header_enable_disable = get_theme_mod('buzmag_top_header_enable_disable');
        if($buzmag_top_header_enable_disable == 'enable'){ ?>
        <div class="bm-top-header">
            <div class="bm-container clearfix">
                <nav id="top-site-navigation" class="top-main-navigation">
                    <div id="top-toggle" class="top-toggle">
        	            <span class="one"> </span>
        	            <span class="two"> </span>
        	            <span class="three"> </span>
        	        </div>
                    
                    <div class="menu-main-wrap">
            			<?php
            				wp_nav_menu( array(
            					'theme_location' => 'buzmag-top-menu',
            					'menu_id'        => 'top-menu',
            				) );
            			?>
                    </div>
                    
        		</nav><!-- #site-navigation -->
                <?php
                    $buzmag_facebook_link = get_theme_mod('buzmag_facebook_link');
                    $buzmag_twitter_link = get_theme_mod('buzmag_twitter_link');
                    $buzmag_youtube_link = get_theme_mod('buzmag_youtube_link');
                    $buzmag_google_link = get_theme_mod('buzmag_google_link');
                    $buzmag_linkedin_link = get_theme_mod('buzmag_linkedin_link');
                    $buzmag_pinterest_link = get_theme_mod('buzmag_pinterest_link');
                    if($buzmag_facebook_link || $buzmag_twitter_link || $buzmag_youtube_link || 
                    $buzmag_google_link || $buzmag_linkedin_link || $buzmag_pinterest_link){ ?>
                        <div class="social-links">
                            <?php if($buzmag_facebook_link){?><a href="<?php echo esc_url($buzmag_facebook_link); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a><?php }
                            if($buzmag_twitter_link){?><a href="<?php echo esc_url($buzmag_twitter_link); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a><?php }
                            if($buzmag_youtube_link){?><a href="<?php echo esc_url($buzmag_youtube_link); ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a><?php }
                            if($buzmag_google_link){?><a href="<?php echo esc_url($buzmag_google_link); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a><?php }
                            if($buzmag_linkedin_link){?><a href="<?php echo esc_url($buzmag_linkedin_link); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a><?php }
                            if($buzmag_pinterest_link){?><a href="<?php echo esc_url($buzmag_pinterest_link); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a><?php } ?>
                        </div>
                    <?php } ?>
            </div>
        </div>
        <?php } ?>
        
        <div class="mb-mid-header">
            <div class="bm-container">
            
                    <div class="site-branding">
                        <?php if ( function_exists( 'the_custom_logo' ) ){?>
                        
                            <?php if ( has_custom_logo() ) { ?>
                                <div class="site-logo">
                                    <?php the_custom_logo(); ?>
                                </div>
                            <?php }else{?>
                                <div class="site-text">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                        <h1 class="site-title"><?php esc_html(bloginfo( 'name' )); ?></h1>
                                        <p class="site-description"><?php esc_html(bloginfo( 'description' )); ?></p>
                                    </a>
                                </div>
                            <?php }
                            
                        } ?>
                    </div><!-- .site-branding -->
                
                <?php $buzmag_header_image_enable_disable = get_theme_mod('buzmag_header_image_enable_disable');
                    if($buzmag_header_image_enable_disable == 'enable'){
                    if(get_header_image()){ 
                        $buzmag_header_image_link = get_theme_mod('buzmag_header_image_link');?>
                        <div class="bm-header-ad">
                            <a target="_blank" href="<?php echo esc_url($buzmag_header_image_link); ?>"><img src="<?php esc_url(header_image()); ?>" alt="<?php esc_attr_e('Header Logo','buzmag'); ?>" title="<?php esc_attr_e('Header Logo','buzmag'); ?>" /></a>
                        </div>
              		<?php }
                }?>
                
            </div>
        </div>
		<nav id="site-navigation" class="main-navigation">
            <div class="bm-container clearfix">
    			<div id="toggle" class="toggle">
    	            <span class="one"> </span>
    	            <span class="two"> </span>
    	            <span class="three"> </span>
    	        </div>
                
                <div class="menu-main-wrap">
        			<?php
        				wp_nav_menu( array(
        					'theme_location' => 'buzmag-primary-menu',
        					'menu_id'        => 'primary-menu',
        				) );
        			?>
                </div>
                <?php $buzmag_header_search_enable = get_theme_mod('buzmag_search_enable');
                 if($buzmag_header_search_enable == 'enable'){ ?>
                 <div class="search-toggle">
                    <a href="javascript:void(0)" class="search-icon"><i class="fa fa-search"></i></a>
    				<div class="bm-search">
    				    <?php get_search_form(); ?>
    				</div>
                </div>
                <?php } ?>
            </div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
    <?php
    if(!is_home() || !is_front_page()){
        do_action('buzmag_header_banner');
    }
    if(is_home() || is_front_page()){
            do_action('buzmag_home_banner');
    }