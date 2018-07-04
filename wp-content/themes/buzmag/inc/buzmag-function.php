<?php
/** Breadcrumb Function **/
function buzmag_header_banner_x() {
	if(is_home() || is_front_page()) :
	else :
    $buzmag_breadcrumb_image = get_theme_mod('buzmag_breadcrumb_image') 
		?>
			<div class="header-banner-container" <?php if($buzmag_breadcrumb_image){ ?>style="background-image: url(<?php echo esc_url($buzmag_breadcrumb_image); ?>);" <?php } ?> >
                <div class="bm-container">
    				<div class="page-title-wrap">
    					<?php buzmag_breadcrumbs(); ?>
    				</div>
                </div>
			</div>
		<?php
	endif;
}
add_action('buzmag_header_banner', 'buzmag_header_banner_x');

/** Breadcrumb Sanitize **/
function buzmag_sanitize_bradcrumb($input){
    $all_tags = array(
        'a'=>array(
            'href'=>array()
        )
     );
    return wp_kses($input,$all_tags);
    
}

/** Breadcrumb Titles **/
function buzmag_breadcrumbs() {
    global $post;
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

    $delimiter = '&#10142;';

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $homeLink = esc_url( home_url() );

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1)
            echo '<div id="buzmag-breadcrumb"><a href="' . $homeLink . '">' . esc_html__('Home', 'buzmag') . '</a></div></div>';
    } else {

        echo '<div id="buzmag-breadcrumb"><a href="' . $homeLink . '">' . esc_html__('Home', 'buzmag') . '</a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> ';

        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0)

                echo esc_html(get_category_parents(esc_attr($thisCat->parent), TRUE, ' ' . esc_html($delimiter) . ' '));
            echo '<span class="current">' . esc_html__('Archive By Category','buzmag').' "' . esc_attr(single_cat_title('', false)) . '"</span>';
        } elseif (is_search()) {
            echo '<span class="current">' . esc_html__('Search results for','buzmag'). '"' . get_search_query() . '"' . '</span>';
        } elseif (is_day()) {
            echo '<a href="' . esc_url(get_year_link(esc_attr(get_the_time('Y')))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . esc_html($delimiter) . ' ';
            echo '<a href="' . esc_url(get_month_link(esc_attr(get_the_time('Y')), esc_attr(get_the_time('m')))) . '">' . esc_html(get_the_time('F')) . '</a> ' . esc_html($delimiter) . ' ';
            echo '<span class="current">' . esc_attr(get_the_time('d')) . '</span>';
        } elseif (is_month()) {
            echo '<a href="' . esc_url(get_year_link(esc_attr(get_the_time('Y')))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . esc_html($delimiter) . ' ';
            echo '<span class="current">' . esc_html(get_the_time('F')) . '</span>';
        } elseif (is_year()) {
            echo '<span class="current">' . esc_html(get_the_time('Y')) . '</span>';
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . esc_url($homeLink) . '/' . esc_attr($slug['slug']) . '/">' . esc_html($post_type->labels->singular_name) . '</a>';
                if ($showCurrent == 1)
                    echo ' ' . esc_html($delimiter) . ' ' . '<span class="current">' . esc_html(get_the_title()) . '</span>';
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                if ($showCurrent == 0)
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                echo buzmag_sanitize_bradcrumb($cats);
                if ($showCurrent == 1)
                    echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            if($post_type){
            echo '<span class="current">' . esc_html($post_type->labels->singular_name) . '</span>';
            }
        } elseif (is_attachment()) {
            if ($showCurrent == 1) echo ' ' . '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1)
                echo '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo buzmag_sanitize_bradcrumb($breadcrumbs[$i]);
                if ($i != count($breadcrumbs) - 1)
                    echo ' ' . esc_html($delimiter). ' ';
            }
            if ($showCurrent == 1)
                echo ' ' . esc_html($delimiter) . ' ' . '<span class="current">' . esc_html(get_the_title()) . '</span>';
        } elseif (is_tag()) {
            echo '<span class="current">' . esc_html__('Posts tagged','buzmag').' "' . esc_html(single_tag_title('', false)) . '"' . '</span>';
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo '<span class="current">' . esc_html__('Articles posted by ','buzmag'). esc_html($userdata->display_name) . '</span>';
        } elseif (is_404()) {
            echo '<span class="current">' . esc_html__('Error 404','buzmag') . '</span>';
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo esc_html__('Page', 'buzmag') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</div>';
    }
}

/** Header Banner Function **/
function buzmag_home_banner_x(){
    ?>
        <div class="main-banner-wrap">
            <?php $buzmag_news_slide_enable_disable = get_theme_mod('buzmag_news_slide_enable_disable');
            if($buzmag_news_slide_enable_disable == 'enable'){ 
                $buzmag_news_title_slide_cat = get_theme_mod('buzmag_news_title_slide_cat');
                if($buzmag_news_title_slide_cat){
                        $buzmag_news_title_args = array(
                            'poat_type' => 'post',
                            'order' => 'DESC',
                            'post_status' => 'publish',
                            'category_name' => $buzmag_news_title_slide_cat
                        ); 
                        $buzmag_news_title_query = new WP_Query($buzmag_news_title_args);
                        if($buzmag_news_title_query->have_posts()){
                            $buzmag_news_slide_news_title = get_theme_mod('buzmag_news_slide_news_title');?>
                            <div class="bm-container">
                                <div class="main-news-slide clearfix">
                                <?php if($buzmag_news_slide_news_title){ ?>
                                    <div class="title-slide">
                                        <span><?php echo esc_html($buzmag_news_slide_news_title); ?></span>
                                    </div>
                                <?php } ?>
                                    <div class="owl-carousel news-slide-wrap">
                                        <?php while($buzmag_news_title_query->have_posts()){ 
                                            $buzmag_news_title_query->the_post(); 
                                            if(get_the_title()){?>
                                                <div class="content-news"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                    <?php wp_reset_postdata();}
                }
            } ?>
            
            <?php
            $buzmag_banner_enable_disable = get_theme_mod('buzmag_banner_enable_disable');
            if($buzmag_banner_enable_disable == 'enable'){
                $buzmag_slider_cat = get_theme_mod('buzmag_slider_cat');
                if($buzmag_slider_cat){
                    $buzmag_slider_args = array(
                        'poat_type' => 'post',
                        'order' => 'DESC',
                        'post_status' => 'publish',
                        'category_name' => $buzmag_slider_cat
                    );
                    $buzmag_slider_query = new WP_Query($buzmag_slider_args);
                    $buzmag_header_banner_layout = get_theme_mod('buzmag_header_banner_layout');
                    if($buzmag_header_banner_layout == ''){
                        $buzmag_header_banner_layout = 'layout-1';
                    }
                    if($buzmag_slider_query->have_posts()){?>
                        <div class="main-slider-wrap clearfix <?php echo esc_attr($buzmag_header_banner_layout); ?>">
                            <div class="bm-container">
                                <div class="secondary-slider-wrap">
                                
                                    <?php if($buzmag_header_banner_layout == 'layout-3'){
                                            $buzmag_feature_post_1 = get_theme_mod('buzmag_feature_post_1'); 
                                            $buzmag_feature_post_2 = get_theme_mod('buzmag_feature_post_2');
                                            $buzmag_feature_post_3 = get_theme_mod('buzmag_feature_post_3');?>
                                        
                                            <div class="owl-carousel slider-all-contents">
                                                <?php while($buzmag_slider_query->have_posts()){
                                                    $buzmag_slider_query->the_post();
                                                    $buzmag_slider_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'buzmag-slider-img-2');
                                                    if($buzmag_slider_image[0]){ ?>
                                                    <div class="loop-slider-conents">
                                                        
                                                            <div class="img-titl-contents">
                                                                <div class="slider-image">
                                                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo  esc_url($buzmag_slider_image[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/></a>
                                                                </div>
                                                                <div class="title-cat-date">
                                                                
                                                                    <?php $buzmag_slider_cats = get_the_category(get_the_ID());
                                                                          $buzmag_cat_count = 1;
                                                                       if($buzmag_slider_cats){ ?>
                                                                           <div class="slider-cat"><?php
                                                                                foreach($buzmag_slider_cats as $buzmag_slider_cat){ ?>
                                                                                    <a class="<?php echo 'bg_cat_'.absint($buzmag_cat_count).' cat_'.esc_attr($buzmag_slider_cat->slug); ?>" href="<?php echo esc_url(get_category_link(absint($buzmag_slider_cat->cat_ID))); ?>">
                                                                                        <?php echo esc_html($buzmag_slider_cat->name);?>
                                                                                    </a><?php
                                                                                $buzmag_cat_count++;
                                                                                } ?>
                                                                           </div>
                                                                    <?php } ?>
                                                                    
                                                                    <?php if(get_the_title()){ ?>
                                                                        <span class="slider-title">
                                                                            <a href="<?php the_permalink(); ?>">
                                                                                <?php the_title(); ?>
                                                                            </a>
                                                                        </span>
                                                                    <?php } ?>
                                                                    
                                                                    <div class="slider-entry-meta">
                                                                        <span class="post-author"><a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )), esc_attr(get_the_author_meta( 'user_nicename' )) )); ?>"><i class="fa fa-user-o" aria-hidden="true"></i><?php the_author(); ?></a></span>
                                                                        <span class="post-date"><a href="<?php echo esc_url(get_day_link( absint(get_the_date('Y')), absint(get_the_date('m')), absint(get_the_date('d')))); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo esc_html(get_the_date(get_option('date_format'))); ?></a></span>
                                                            		</div><!-- .entry-meta -->
                                                                    
                                                                </div>
                                                            </div>
                                                        
                                                    </div>
                                                    <?php } ?>
                                                    
                                                <?php } ?>
                                            </div>
                                            
                                            <?php if($buzmag_feature_post_1 || $buzmag_feature_post_2 || $buzmag_feature_post_3){
                                            
                                                $buzmag_slider_feature_args = array(
                                                    'poat_type' => 'post',
                                                    'order' => 'DESC',
                                                    'post_status' => 'publish',
                                                    'post__in' => array($buzmag_feature_post_1,$buzmag_feature_post_2,$buzmag_feature_post_3),
                                                );
                                                
                                                $buzmag_slider_feature_query = new WP_Query($buzmag_slider_feature_args);
                                                
                                                if($buzmag_slider_feature_query->have_posts()){
                                                    ?><div class="layout-3-slider-wrap"><?php
                                                        $buzmag_slider_feature_count = 1;
                                                        while($buzmag_slider_feature_query->have_posts()){
                                                            
                                                            $buzmag_slider_feature_query->the_post();
                                                            if($buzmag_slider_feature_count == '1'){
                                                                $buzmag_feature_image = 'buzmag-slider-feature-2';
                                                            }else{
                                                                $buzmag_feature_image = 'buzmag-slider-feature-3';
                                                            }
                                                            $buzmag_slider_feature_image = wp_get_attachment_image_src(get_post_thumbnail_id(),$buzmag_feature_image);?>
                                                            <div class="feature-post-2 <?php echo 'count_feature_'.absint($buzmag_slider_feature_count); ?>">
                                                                <div class="img-titl-contents">
                                                                    <div class="slider-image">
                                                                        <a href="<?php the_permalink(); ?>">
                                                                            <img src="<?php echo  esc_url($buzmag_slider_feature_image[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/>
                                                                        </a>
                                                                    </div>
                                                                    <div class="title-cat-date">
                                                                    
                                                                        <?php 
                                                                        if($buzmag_slider_feature_count == '1'){
                                                                            $buzmag_slider_cats = get_the_category(get_the_ID());
                                                                              $buzmag_cat_count = 1;
                                                                            if($buzmag_slider_cats){ ?>
                                                                               <div class="slider-cat"><?php
                                                                                    foreach($buzmag_slider_cats as $buzmag_slider_cat){ ?>
                                                                                        <a class="<?php echo 'bg_cat_'.absint($buzmag_cat_count).' cat_'.esc_attr($buzmag_slider_cat->slug); ?>" href="<?php echo esc_url(get_category_link(absint($buzmag_slider_cat->cat_ID))); ?>">
                                                                                            <?php echo esc_html($buzmag_slider_cat->name);?>
                                                                                        </a><?php
                                                                                    $buzmag_cat_count++;
                                                                                    } ?>
                                                                               </div>
                                                                            <?php } 
                                                                        }?>
                                                                        
                                                                        <?php if(get_the_title()){ ?>
                                                                            <span class="slider-title">
                                                                                <a href="<?php the_permalink(); ?>">
                                                                                    <?php the_title(); ?>
                                                                                </a>
                                                                            </span>
                                                                        <?php } ?>
                                                                        
                                                                        <div class="slider-entry-meta">
                                                                            <span class="post-author"><a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )), esc_attr(get_the_author_meta( 'user_nicename' )) )); ?>"><i class="fa fa-user-o" aria-hidden="true"></i><?php the_author(); ?></a></span>
                                                                            <span class="post-date"><a href="<?php echo esc_url(get_day_link( absint(get_the_date('Y')), absint(get_the_date('m')), absint(get_the_date('d')))); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo esc_html(get_the_date(get_option('date_format'))); ?></a></span>
                                                                		</div><!-- .entry-meta -->
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        <?php $buzmag_slider_feature_count++; }
                                                    ?></div><?php
                                                    wp_reset_postdata();}
                                            }
                                    }elseif($buzmag_header_banner_layout == 'layout-2'){
                                        
                                        $buzmag_feature_post_1 = get_theme_mod('buzmag_feature_post_1'); 
                                        $buzmag_feature_post_2 = get_theme_mod('buzmag_feature_post_2');
                                     
                                        if($buzmag_feature_post_1){
                                            
                                        $buzmag_slider_feature_1_args = array(
                                            'poat_type' => 'post',
                                            'order' => 'DESC',
                                            'post_status' => 'publish',
                                            'post__in' => array($buzmag_feature_post_1),
                                        );
                                        
                                        $buzmag_slider_feature_1_query = new WP_Query($buzmag_slider_feature_1_args);
                                        
                                        if($buzmag_slider_feature_1_query->have_posts()){
                                            while($buzmag_slider_feature_1_query->have_posts()){
                                                
                                                $buzmag_slider_feature_1_query->the_post();
                                                $buzmag_slider_feature_1_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'buzmag-slider-feature-1');?>
                                                <div class="feature-post-1">
                                                    <div class="img-titl-contents">
                                                        <div class="slider-image">
                                                            <a href="<?php the_permalink(); ?>"><img src="<?php echo  esc_url($buzmag_slider_feature_1_image[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/></a>
                                                        </div>
                                                        <div class="title-cat-date">
                                                        
                                                            <?php $buzmag_slider_cats = get_the_category(get_the_ID());
                                                                  $buzmag_cat_count = 1;
                                                               if($buzmag_slider_cats){ ?>
                                                                   <div class="slider-cat"><?php
                                                                        foreach($buzmag_slider_cats as $buzmag_slider_cat){ ?>
                                                                            <a class="<?php echo 'bg_cat_'.absint($buzmag_cat_count).' cat_'.esc_attr($buzmag_slider_cat->slug); ?>" href="<?php echo esc_url(get_category_link(absint($buzmag_slider_cat->cat_ID))); ?>">
                                                                                <?php echo esc_html($buzmag_slider_cat->name);?>
                                                                            </a><?php
                                                                        $buzmag_cat_count++;
                                                                        } ?>
                                                                   </div>
                                                            <?php } ?>
                                                            
                                                            <?php if(get_the_title()){ ?>
                                                                <span class="slider-title">
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <?php the_title(); ?>
                                                                    </a>
                                                                </span>
                                                            <?php } ?>
                                                            
                                                            <div class="slider-entry-meta">
                                                                <span class="post-author"><a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )), esc_attr(get_the_author_meta( 'user_nicename' )) )); ?>"><i class="fa fa-user-o" aria-hidden="true"></i><?php the_author(); ?></a></span>
                                                                <span class="post-date"><a href="<?php echo esc_url(get_day_link( absint(get_the_date('Y')), absint(get_the_date('m')), absint(get_the_date('d')))); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo esc_html(get_the_date(get_option('date_format'))); ?></a></span>
                                                    		</div><!-- .entry-meta -->
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            <?php }
                                            wp_reset_postdata();}
                                        }?>
                                    
                                        <div class="owl-carousel slider-all-contents">
                                            <?php while($buzmag_slider_query->have_posts()){
                                                $buzmag_slider_query->the_post();
                                                $buzmag_slider_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'buzmag-slider-img-2');
                                                if($buzmag_slider_image[0]){ ?>
                                                <div class="loop-slider-conents">
                                                    
                                                        <div class="img-titl-contents">
                                                            <div class="slider-image">
                                                                <a href="<?php the_permalink(); ?>"><img src="<?php echo  esc_url($buzmag_slider_image[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/></a>
                                                            </div>
                                                            <div class="title-cat-date">
                                                            
                                                                <?php $buzmag_slider_cats = get_the_category(get_the_ID());
                                                                      $buzmag_cat_count = 1;
                                                                   if($buzmag_slider_cats){ ?>
                                                                       <div class="slider-cat"><?php
                                                                            foreach($buzmag_slider_cats as $buzmag_slider_cat){ ?>
                                                                                <a class="<?php echo 'bg_cat_'.absint($buzmag_cat_count).' cat_'.esc_attr($buzmag_slider_cat->slug); ?>" href="<?php echo esc_url(get_category_link(absint($buzmag_slider_cat->cat_ID))); ?>">
                                                                                    <?php echo esc_html($buzmag_slider_cat->name);?>
                                                                                </a><?php
                                                                            $buzmag_cat_count++;
                                                                            } ?>
                                                                       </div>
                                                                <?php } ?>
                                                                
                                                                <?php if(get_the_title()){ ?>
                                                                    <span class="slider-title">
                                                                        <a href="<?php the_permalink(); ?>">
                                                                            <?php the_title(); ?>
                                                                        </a>
                                                                    </span>
                                                                <?php } ?>
                                                                
                                                                <div class="slider-entry-meta">
                                                                    <span class="post-author"><a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )), esc_attr(get_the_author_meta( 'user_nicename' )) )); ?>"><i class="fa fa-user-o" aria-hidden="true"></i><?php the_author(); ?></a></span>
                                                                    <span class="post-date"><a href="<?php echo esc_url(get_day_link( absint(get_the_date('Y')), absint(get_the_date('m')), absint(get_the_date('d')))); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo esc_html(get_the_date(get_option('date_format'))); ?></a></span>
                                                        		</div><!-- .entry-meta -->
                                                                
                                                            </div>
                                                        </div>
                                                    
                                                </div>
                                                <?php } ?>
                                                
                                            <?php } ?>
                                        </div>
                                        
                                        <?php if($buzmag_feature_post_2){
                                        
                                            $buzmag_slider_feature_2_args = array(
                                                'poat_type' => 'post',
                                                'order' => 'DESC',
                                                'post_status' => 'publish',
                                                'post__in' => array($buzmag_feature_post_2),
                                            );
                                            
                                            $buzmag_slider_feature_2_query = new WP_Query($buzmag_slider_feature_2_args);
                                            
                                            if($buzmag_slider_feature_2_query->have_posts()){
                                                while($buzmag_slider_feature_2_query->have_posts()){
                                                    
                                                    $buzmag_slider_feature_2_query->the_post();
                                                    $buzmag_slider_feature_2_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'buzmag-slider-feature-1');?>
                                                    <div class="feature-post-2">
                                                        <div class="img-titl-contents">
                                                            <div class="slider-image">
                                                                <a href="<?php the_permalink(); ?>"><img src="<?php echo  esc_url($buzmag_slider_feature_2_image[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/></a>
                                                            </div>
                                                            <div class="title-cat-date">
                                                            
                                                                <?php $buzmag_slider_cats = get_the_category(get_the_ID());
                                                                      $buzmag_cat_count = 1;
                                                                   if($buzmag_slider_cats){ ?>
                                                                       <div class="slider-cat"><?php
                                                                            foreach($buzmag_slider_cats as $buzmag_slider_cat){ ?>
                                                                                <a class="<?php echo 'bg_cat_'.absint($buzmag_cat_count).' cat_'.esc_attr($buzmag_slider_cat->slug); ?>" href="<?php echo esc_url(get_category_link(absint($buzmag_slider_cat->cat_ID))); ?>">
                                                                                    <?php echo esc_html($buzmag_slider_cat->name);?>
                                                                                </a><?php
                                                                            $buzmag_cat_count++;
                                                                            } ?>
                                                                       </div>
                                                                <?php } ?>
                                                                
                                                                <?php if(get_the_title()){ ?>
                                                                    <span class="slider-title">
                                                                        <a href="<?php the_permalink(); ?>">
                                                                            <?php the_title(); ?>
                                                                        </a>
                                                                    </span>
                                                                <?php } ?>
                                                                
                                                                <div class="slider-entry-meta">
                                                                    <span class="post-author"><a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )), esc_attr(get_the_author_meta( 'user_nicename' )) )); ?>"><i class="fa fa-user-o" aria-hidden="true"></i><?php the_author(); ?></a></span>
                                                                    <span class="post-date"><a href="<?php echo esc_url(get_day_link( absint(get_the_date('Y')), absint(get_the_date('m')), absint(get_the_date('d')))); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo esc_html(get_the_date(get_option('date_format'))); ?></a></span>
                                                        		</div><!-- .entry-meta -->
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                <?php }
                                                wp_reset_postdata();}
                                            }
                                        }else{ ?>
                                            <div class="owl-carousel slider-all-contents">
                                                <?php while($buzmag_slider_query->have_posts()){
                                                    $buzmag_slider_query->the_post();
                                                    $buzmag_slider_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'buzmag-slider-img-1');?>
                                                    <?php if($buzmag_slider_image[0]){ ?>
                                                    <div class="loop-slider-conents">
                                                        
                                                            <div class="img-titl-contents">
                                                                <div class="slider-image">
                                                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo  esc_url($buzmag_slider_image[0]); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/></a>
                                                                </div>
                                                                <div class="title-cat-date">
                                                                
                                                                    <?php $buzmag_slider_cats = get_the_category(get_the_ID());
                                                                          $buzmag_cat_count = 1;
                                                                       if($buzmag_slider_cats){ ?>
                                                                           <div class="slider-cat"><?php
                                                                                foreach($buzmag_slider_cats as $buzmag_slider_cat){ ?>
                                                                                    <a class="<?php echo 'bg_cat_'.absint($buzmag_cat_count).' cat_'.esc_attr($buzmag_slider_cat->slug); ?>" href="<?php echo esc_url(get_category_link(absint($buzmag_slider_cat->cat_ID))); ?>">
                                                                                        <?php echo esc_html($buzmag_slider_cat->name);?>
                                                                                    </a><?php
                                                                                $buzmag_cat_count++;
                                                                                } ?>
                                                                           </div>
                                                                    <?php } ?>
                                                                    
                                                                    <?php if(get_the_title()){ ?>
                                                                        <span class="slider-title">
                                                                            <a href="<?php the_permalink(); ?>">
                                                                                <?php echo esc_html(wp_trim_words(get_the_title(),10,'...')); ?>
                                                                            </a>
                                                                        </span>
                                                                    <?php } ?>
                                                                    
                                                                    <div class="slider-entry-meta">
                                                                        <span class="post-author"><a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )), esc_attr(get_the_author_meta( 'user_nicename' )) )); ?>"><i class="fa fa-user-o" aria-hidden="true"></i><?php the_author(); ?></a></span>
                                                                        <span class="post-date"><a href="<?php echo esc_url(get_day_link( absint(get_the_date('Y')), absint(get_the_date('m')), absint(get_the_date('d')))); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo esc_html(get_the_date(get_option('date_format'))); ?></a></span>
                                                            		</div><!-- .entry-meta -->
                                                                    
                                                                </div>
                                                            </div>
                                                        
                                                    </div>
                                                    <?php } ?>
                                                    
                                                <?php } ?>
                                            </div>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </div>
                <?php wp_reset_postdata();}
                }
            } ?>
            
        </div>
    <?php
}
add_action('buzmag_home_banner','buzmag_home_banner_x');

/** Post Category List **/
function buzmag_Category_list(){
    $buzmag_cat_lists = get_categories(
        array(
            'hide_empty' => '0',
            'exclude' => '1',
        )
    );
    $buzmag_cat_array = array();
    $buzmag_cat_array[] = esc_html__('--Choose--','buzmag');
    foreach($buzmag_cat_lists as $buzmag_cat_list){
        $buzmag_cat_array[$buzmag_cat_list->slug] = $buzmag_cat_list->name;
    }
    return $buzmag_cat_array;
}

/** Post Category List **/
function buzmag_Category_list_2(){
    $buzmag_cat_lists = get_categories(
        array(
            'hide_empty' => '0',
            'exclude' => '1',
        )
    );
    $buzmag_cat_array = array();
    foreach($buzmag_cat_lists as $buzmag_cat_list){
        $buzmag_cat_array[$buzmag_cat_list->term_id] = $buzmag_cat_list->name;
    }
    return $buzmag_cat_array;
}

/** Post Category List **/
function buzmag_post_lists(){
    $posts = get_posts(array('posts_per_page'   => -1));
    $post_lists = array();
    $post_lists[''] = esc_html__('Select post', 'buzmag'); 
    foreach($posts as $post) :
        $post_lists[$post->ID] = $post->post_title;
    endforeach;
    return $post_lists;
}