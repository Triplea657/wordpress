<?php
add_action('wp_enqueue_scripts','buzmag_dynamic_style');
function buzmag_dynamic_style(){


    $buzmag_dynamic_style = '';
    
    $buzmag_Category_list = buzmag_Category_list();
    if($buzmag_Category_list){
        $buzmag_Category_count = 1;
            foreach($buzmag_Category_list as $buzmag_Category_slug => $buzmag_Category){
            $buzmag_cat_color = esc_attr(get_theme_mod('buzmag_cat_color_'.absint($buzmag_Category_count)));
            if($buzmag_cat_color){

                $buzmag_dynamic_style .= ".cat_$buzmag_Category_slug{background:$buzmag_cat_color !important}";
                $buzmag_dynamic_style .= ".cat_$buzmag_Category_slug{border-color:$buzmag_cat_color !important}";
            }
        $buzmag_Category_count++;}
    }
    
    $buzmag_theme_color = esc_attr(get_theme_mod('buzmag_theme_color'));
    if($buzmag_theme_color){
        $buzmag_dynamic_style .= "a.read-more, h1.entry-title a:hover, h2.entry-title a:hover, .footer-copyright a:hover, .widget ul li a:hover, .widget ul li:before, body.search .no-results input.search-submit, .error404 .not-found input.search-submit, span.page-numbers.current, nav.pagination a:hover, div#buzmag-breadcrumb a, div#buzmag-breadcrumb span, .news-slide-wrap .owl-nav .owl-prev:hover i, .news-slide-wrap .owl-nav .owl-next:hover i, .news-slide-wrap .content-news a, .main-slider-wrap.layout-1 .secondary-slider-wrap .owl-prev:hover, .main-slider-wrap.layout-1 .secondary-slider-wrap .owl-next:hover, .main-slider-wrap.layout-2 .owl-dots .owl-dot.active, .main-slider-wrap.layout-3 .owl-dots .owl-dot.active, .main-slider-wrap.layout-2 .owl-dots .owl-dot.active, .main-slider-wrap.layout-3 .owl-dots .owl-dot.active, .main-slider-wrap.layout-2 .owl-dots .owl-dot:hover, .main-slider-wrap.layout-3 .owl-dots .owl-dot:hover, .bm-home-sidebar .widget_buzmag_blog_category_widget .owl-prev, .bm-home-sidebar .widget_buzmag_blog_category_widget .owl-next, .widget_buzmag_post_slide_widget .owl-prev, .widget_buzmag_post_slide_widget .owl-next, .titles-port div:hover, .filter.active, .loop-posts-blog-recent .wrap-meta-title h4:hover, .entry-meta span:hover, .entry-meta a:hover, h1.site-title, p.site-description, .error-404.not-found h1.page-title, .no-results.not-found h1.page-title, .widget_buzmag_blog_widget .blog-content-title a:hover, .widget_buzmag_blog_category_widget .bm-main-cat-post .bm-cat-count-1 .blog-content-title a h3:hover, .widget_buzmag_blog_category_widget .bm-main-cat-post .layout-2 .blog-content-title a h3:hover{color: $buzmag_theme_color;}";
        $buzmag_dynamic_style .= "#bm-go-top, .tnp-widget input.tnp-submit, .main-news-slide .title-slide, nav.pagination a:hover, nav.pagination a, .pagination .nav-links span, .widget input.search-submit, nav.navigation a, .main-navigation, .bm-top-header{background: $buzmag_theme_color;}";
        $buzmag_dynamic_style .= "nav.navigation a, h2.widget-title, .widget input.search-field:focus, .bm-search input.search-field:focus, .bm-search input.search-submit:focus, .widget input.search-submit:focus, body.search .no-results input.search-field:focus, body.search .no-results input.search-submit:focus, .error404 .not-found input.search-submit:focus, .error404 .not-found input.search-field:focus, nav.pagination a, .pagination .nav-links span, nav.pagination a:hover, .news-slide-wrap .owl-nav .owl-prev:hover, .news-slide-wrap .owl-nav .owl-next:hover, .main-slider-wrap.layout-1 .secondary-slider-wrap .owl-prev:hover, .main-slider-wrap.layout-1 .secondary-slider-wrap .owl-next:hover, .widget_buzmag_blog_widget h2.widget-title, .widget_buzmag_post_slide_widget h2.widget-title, .widget_buzmag_masonry_post_widget h2.widget-title, .widget_buzmag_blog_category_widget .bm-second-wrap-cat .title-cat-main h2, .main-news-slide{border-color: $buzmag_theme_color;}";
        $buzmag_dynamic_style .= ".tnp-widget-minimal input.tnp-submit{background:$buzmag_theme_color !important;}";
    }
    
    wp_add_inline_style( 'buzmag-style', $buzmag_dynamic_style );
}