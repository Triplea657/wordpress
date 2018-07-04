<?php
/**
 * @package buzmag
 */

add_action('widgets_init', 'buzmag_post_slide_register');

function buzmag_post_slide_register() {
    register_widget('buzmag_post_slide_Widget');
}

class buzmag_post_slide_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzmag_post_slide_Widget', esc_html__('Buzmag : Home Post Slide', 'buzmag'), array(
                'description' => esc_html__('This Widget show Post Slide', 'buzmag')
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
            'bm_post_slide_title' => array(
                'buzmag_widgets_name' => 'bm_post_slide_title',
                'buzmag_widgets_title' => esc_html__('Title', 'buzmag'),
                'buzmag_widgets_field_type' => 'text',
            ),
            'bm_post_slide_category' => array(
                'buzmag_widgets_name' => 'bm_post_slide_category',
                'buzmag_widgets_title' => esc_html__('Post Slide Category', 'buzmag'),
                'buzmag_widgets_field_type' => 'select',
                'buzmag_widgets_field_options' => $buzmag_cat_list,
            ),
            'bm_blog_posts' => array(
                'buzmag_widgets_name' => 'bm_blog_posts',
                'buzmag_widgets_title' => esc_html__('Blog Posts Number', 'buzmag'),
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
        
        $bm_post_slide_title = apply_filters( 'widget_title', empty( $instance['bm_post_slide_title'] ) ? '' : $instance['bm_post_slide_title'], $instance, $this->id_base );        
        $bm_post_slide_category = isset( $instance['bm_post_slide_category'] ) ? $instance['bm_post_slide_category'] : '' ;
        $bm_blog_posts = isset( $instance['bm_blog_posts'] ) ? $instance['bm_blog_posts'] : '' ;
        if($bm_blog_posts == ''){
            $bm_blog_layout = '-1';
        }
        
        echo $before_widget;
        ?>
            <div class="slide-post-wrap">
                <div class="slide-post-contents">
                    <?php
                    $bm_post_slider_args = array(
                        'poat_type' => 'post',
                        'order' => 'DESC',
                        'posts_per_page' => $bm_blog_posts,
                        'post_status' => 'publish',
                        'category_name' => $bm_post_slide_category
                    ); 
                    $bm_post_slide_query = new WP_Query($bm_post_slider_args);
                    if (!empty($bm_post_slide_title)): ?>
                        <div class="home-widget-title"><?php echo $args['before_title'] . esc_html($bm_post_slide_title) . $args['after_title']; ?></div>
                    <?php endif;
                    
                    if($bm_post_slide_query->have_posts()): ?>
                        <div class="owl-carousel post-slider-contents">
                            <?php while($bm_post_slide_query->have_posts()){
                                $bm_post_slide_query->the_post();
                                $buzmag_slider_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'buzmag-slider-img-1');?>
                                <?php if($buzmag_slider_image[0]){ ?>
                                <div class="loop-post-slide-conents">
                                    
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
                    <?php wp_reset_postdata(); endif; ?>
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
