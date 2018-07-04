<?php
/**
 * @package buzmag
 */

add_action('widgets_init', 'buzmag_blog_register');

function buzmag_blog_register() {
    register_widget('buzmag_blog_Widget');
}

class buzmag_blog_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzmag_blog_Widget', esc_html__('Buzmag : Home Blog List', 'buzmag'), array(
                'description' => esc_html__('This Widget show Blogs', 'buzmag')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $buzmag_cat_list = buzmag_Category_list();
        $fields = array(
            'bm_blog_title' => array(
                'buzmag_widgets_name' => 'bm_blog_title',
                'buzmag_widgets_title' => esc_html__('Title', 'buzmag'),
                'buzmag_widgets_field_type' => 'text',
            ),
            'bm_blog_category' => array(
                'buzmag_widgets_name' => 'bm_blog_category',
                'buzmag_widgets_title' => esc_html__('Blog Category', 'buzmag'),
                'buzmag_widgets_field_type' => 'select',
                'buzmag_widgets_field_options' => $buzmag_cat_list,
            ),
            'bm_blog_layout' => array(
                'buzmag_widgets_name' => 'bm_blog_layout',
                'buzmag_widgets_title' => esc_html__('Blog Layout ( Layout One Is Defult )', 'buzmag'),
                'buzmag_widgets_field_type' => 'radio',
                'buzmag_widgets_field_options' => array(
                    'layout-1' => esc_html__('List Layout','buzmag'),
                    'layout-2' => esc_html__('Grid Layout','buzmag'),
                    'layout-3' => esc_html__('Highlight Blog','buzmag'),
                ),
            ),
            'bm_blog_posts' => array(
                'buzmag_widgets_name' => 'bm_blog_posts',
                'buzmag_widgets_title' => esc_html__('Blog Posts Number', 'buzmag'),
                'buzmag_widgets_field_type' => 'number',
            ),
            'bm_blog_content_text_count' => array(
                'buzmag_widgets_name' => 'bm_blog_content_text_count',
                'buzmag_widgets_title' => esc_html__('Blog Text Number', 'buzmag'),
                'buzmag_widgets_field_type' => 'number',
            ),
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);
        
        $bm_title_widget = apply_filters( 'widget_title', empty( $instance['bm_blog_title'] ) ? '' : $instance['bm_blog_title'], $instance, $this->id_base );        
        $bm_blog_category = isset( $instance['bm_blog_category'] ) ? $instance['bm_blog_category'] : '' ;
        $bm_blog_posts = isset( $instance['bm_blog_posts'] ) ? $instance['bm_blog_posts'] : '' ;
        $bm_blog_layout = isset( $instance['bm_blog_layout'] ) ? $instance['bm_blog_layout'] : '' ;
        if($bm_blog_layout == ''){
            $bm_blog_layout = 'layout-1';
        }
        $bm_blog_content_text_count = isset( $instance['bm_blog_content_text_count'] ) ? $instance['bm_blog_content_text_count'] : '' ;
        
        echo $before_widget;
        ?>
            <div class="blog-wrap <?php echo esc_attr($bm_blog_layout); ?>">
                <div class="blog-contents">
                    <?php
                    $bm_blog_args = array(
                        'poat_type' => 'post',
                        'order' => 'DESC',
                        'posts_per_page' => $bm_blog_posts,
                        'post_status' => 'publish',
                        'category_name' => $bm_blog_category
                    ); 
                    $bm_blog_query = new WP_Query($bm_blog_args);
                    if (!empty($bm_title_widget)): ?>
                        <div class="home-widget-title"><?php echo $args['before_title'] . esc_html($bm_title_widget) . $args['after_title']; ?></div>
                    <?php endif;
                    
                    if($bm_blog_query->have_posts()): ?>
                        <div class="blog-main-wrap clearfix">
                            <div class="blog-loop-wrap">
                                <?php $bm_count_post = 1;
                                
                                while($bm_blog_query->have_posts()){
                                        $bm_blog_query->the_post();
                                        $bm_blog_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'buzmag-slider-blog-list-image-1');?>
                                            <div class="bm-loop-blog <?php if($bm_blog_layout == 'layout-3' && $bm_count_post > '1'){ echo 'bm-cont-post-all';}?> clearfix <?php echo 'bm-cont-post-'.absint($bm_count_post); ?>">
                                            
                                                <?php if($bm_blog_image[0]){ ?>
                                                    <div class="image-blog">
                                                    
                                                        <a class="img-blog-list" href="<?php the_permalink(); ?>">
                                                            <img alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" src="<?php echo esc_url($bm_blog_image[0]); ?>" />
                                                        </a>
                                                        <?php if($bm_blog_layout == 'layout-2'){ ?>
                                                            <div class="wrap-title-meta">
                                                            
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
                                                                    <a class="title-post" href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                                                <?php } ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                                
                                                <?php if(get_the_content() || get_the_title()){ ?>
                                                        <div class="blog-content-title">
                                                        
                                                            <?php if($bm_blog_layout == 'layout-1' || $bm_blog_layout == ''  || $bm_blog_layout == 'layout-3'){ ?>
                                                                <?php if(get_the_title()){ ?>
                                                                    <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                            
                                                            <?php if($bm_blog_layout == 'layout-1' || $bm_blog_layout == ''  || $bm_blog_layout == 'layout-3'){ ?>
                                                                <div class="entry-meta">
                                                        			<div class="comment-author-date">
                                                                        <span class="post-author"><a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )), esc_attr(get_the_author_meta( 'user_nicename' )) )); ?>"><i class="fa fa-user-o" aria-hidden="true"></i><?php the_author(); ?></a></span>
                                                                        
                                                                        <span class="post-date"><a href="<?php echo esc_url(get_day_link( absint(get_the_date('Y')), absint(get_the_date('m')), absint(get_the_date('d')))); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo esc_html(get_the_date(get_option('date_format'))); ?></a></span>
                                                                        
                                                                        <span class="post-comment"><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o" aria-hidden="true"></i><?php echo absint(get_comments_number()).esc_html__(' comment','buzmag'); ?></a></span>
                                                                    </div>
                                                        		</div><!-- .entry-meta -->
                                                            <?php } ?>
                                                            
                                                            <?php if(get_the_content()){
                                                                if($bm_blog_content_text_count == ''){
                                                                    $bm_blog_content_text_count = '25';
                                                                } ?>
                                                                <p><?php echo esc_html(wp_trim_words(get_the_content(),$bm_blog_content_text_count,'...')); ?></p>
                                                            <?php } ?>
                                                            
                                                            <?php if($bm_blog_layout == 'layout-1' || $bm_blog_layout == ''  || $bm_blog_layout == 'layout-3'){
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
                                                            
                                                            <?php if($bm_blog_layout == 'layout-2'){ ?>
                                                                <div class="entry-meta">
                                                        			<div class="comment-author-date">
                                                                        <span class="post-author"><a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )), esc_attr(get_the_author_meta( 'user_nicename' )) )); ?>"><i class="fa fa-user-o" aria-hidden="true"></i><?php the_author(); ?></a></span>
                                                                        
                                                                        <span class="post-date"><a href="<?php echo esc_url(get_day_link( absint(get_the_date('Y')), absint(get_the_date('m')), absint(get_the_date('d')))); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo esc_html(get_the_date(get_option('date_format'))); ?></a></span>
                                                                        
                                                                        <span class="post-comment"><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o" aria-hidden="true"></i><?php echo absint(get_comments_number()); esc_html_e(' comment','buzmag'); ?></a></span>
                                                                    </div>
                                                        		</div><!-- .entry-meta -->
                                                            <?php } ?>
                                                            
                                                        </div>
                                                <?php } ?>
                                                
                                            </div>
                                        <?php
                                $bm_count_post ++; } ?>
                            </div>
                        </div>
                    <?php wp_reset_postdata();endif; ?>
                </div>
            </div>
        <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	buzmag_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$buzmag_widgets_name] = buzmag_widgets_updated_field_value($widget_field, $new_instance[$buzmag_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	buzmag_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $buzmag_widgets_field_value = !empty($instance[$buzmag_widgets_name]) ? esc_attr($instance[$buzmag_widgets_name]) : '';
            buzmag_widgets_show_widget_field($this, $widget_field, $buzmag_widgets_field_value);
        }
    }

}
