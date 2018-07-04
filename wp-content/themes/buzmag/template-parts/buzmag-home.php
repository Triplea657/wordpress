<?php
/**
 * Template Name: Home Page
 */
get_header(); 
if(is_active_sidebar('buzmag-home-with-sidebar')){?>
    <div class="bm-home-sidebar clearfix">
        <div class="bm-container">
        	<div id="primary" class="content-area">
        		<main id="main" class="site-main">
        
        			<?php dynamic_sidebar('buzmag-home-with-sidebar'); ?>
        
        		</main><!-- #main -->
        	</div><!-- #primary -->
        
            <?php get_sidebar(); ?>
        
        </div>
    </div><?php
}
if(is_active_sidebar('buzmag-home-full-width')){?>
    <div class="bm-home-full-width clearfix">
        <div class="bm-container">
        	<div id="primary" class="content-area">
        		<main id="main" class="site-main">
        
        			<?php dynamic_sidebar('buzmag-home-full-width'); ?>
        
        		</main><!-- #main -->
        	</div><!-- #primary -->
        
        </div>
    </div><?php
}
get_footer();