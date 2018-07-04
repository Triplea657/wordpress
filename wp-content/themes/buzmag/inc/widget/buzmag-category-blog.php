<?php
/**
 * @package buzmag
 */

add_action('widgets_init', 'buzmag_blog_category_register');

function buzmag_blog_category_register() {
    register_widget('buzmag_blog_category_Widget');
}

class buzmag_blog_category_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzmag_blog_category_Widget', esc_html__('Buzmag : Home Category Blog', 'buzmag'), array(
                'description' => esc_html__('This Widget show Category Blogs', 'buzmag')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $buzmag_cat_list = buzmag_Category_list_2();
        $fields = array(
            'bm_blog_cat_category' => array(
                  'buzmag_widgets_name' => 'bm_blog_cat_category',
                  'buzmag_widgets_title' => esc_html__('Select Products Categorys', 'buzmag'),
                  'buzmag_widgets_field_type' => 'multicheckboxes',
                  'buzmag_widgets_field_options' => $buzmag_cat_list
              ),
            'bm_blog_category_layout' => array(
                'buzmag_widgets_name' => 'bm_blog_category_layout',
                'buzmag_widgets_title' => esc_html__('Category Blog Layout ( Layout One Is Defult )', 'buzmag'),
                'buzmag_widgets_field_type' => 'radio',
                'buzmag_widgets_field_options' => array(
                    'layout-1' => esc_html__('List Layout','buzmag'),
                    'layout-2' => esc_html__('Slide Layout','buzmag'),
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
               
        $bm_blog_cat_categories = isset( $instance['bm_blog_cat_category'] ) ? $instance['bm_blog_cat_category'] : '' ;
        $bm_blog_category_layout = isset( $instance['bm_blog_category_layout'] ) ? $instance['bm_blog_category_layout'] : '' ;
        $bm_blog_posts = isset( $instance['bm_blog_posts'] ) ? $instance['bm_blog_posts'] : '' ;
        if($bm_blog_posts == ''){ $bm_blog_posts = '5'; }
        if($bm_blog_category_layout == ''){ $bm_blog_category_layout = 'layout-1'; }
        $bm_blog_content_text_count = isset( $instance['bm_blog_content_text_count'] ) ? $instance['bm_blog_content_text_count'] : '' ;
        
        echo $before_widget;
        if($bm_blog_cat_categories){ ?>
            <div class="bm-main-cat-post clearfix <?php echo esc_attr($bm_blog_category_layout); ?>">
                    <?php foreach($bm_blog_cat_categories as $bm_blog_cat_category_id => $bm_blog_cat_category){
                    $bm_term_get_name = get_cat_name($bm_blog_cat_category_id);?>
                
                    <div class="bm-second-wrap-cat">
                        <?php if($bm_term_get_name){ ?>
                            <div class="title-cat-main">
                                <span class="title-cat"><h2><?php echo esc_html($bm_term_get_name); ?></h2></span>
                            </div><?php
                        }
                        
                        $buzmag_cat_args = array(
                            'poat_type' => 'post',
                            'order' => 'DESC',
                            'posts_per_page' => $bm_blog_posts,
                            'post_status' => 'publish',
                            'cat' => $bm_blog_cat_category_id
                        );
                        $buzmag_cat_query = new WP_Query($buzmag_cat_args);
                        if($buzmag_cat_query->have_posts()){ ?>
                        
                            <div class="bm-loop-cat-post <?php if($bm_blog_category_layout == 'layout-2'){ echo 'owl-carousel'; } ?>">
                                <?php $bm_blog_cat_category_count = 1;
                                while($buzmag_cat_query->have_posts()){
                                    
                                    $buzmag_cat_query->the_post(); ?>
                                    <div class="bm-cat-all-content <?php if($bm_blog_cat_category_count != '1'){echo "bm-small-thumb-content ";} echo 'bm-cat-count-'.absint($bm_blog_cat_category_count); ?> ">
                                        <?php $bm_blog_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'buzmag-slider-blog-list-image-1');?>
                                        <div class="bm-loop-blog clearfix">
                                        
                                            <?php if($bm_blog_image[0]){ ?>
                                                <div class="image-blog">
                                                
                                                    <a class="img-blog-list" href="<?php the_permalink(); ?>">
                                                        <img alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" src="<?php echo esc_url($bm_blog_image[0]); ?>" />
                                                    </a>
                                                    
                                                </div>
                                            <?php } ?>
                                            
                                            <?php if(get_the_content() || get_the_title()){ ?>
                                                <div class="blog-content-title">
                                                
                                                    <?php if(get_the_title()){ ?>
                                                        <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                                    <?php } ?>
                                                    
                                                    <?php if(get_the_content()){
                                                        if($bm_blog_content_text_count == ''){
                                                            $bm_blog_content_text_count = '25';
                                                        } ?>
                                                        <p><?php echo esc_html(wp_trim_words(get_the_content(),$bm_blog_content_text_count,'...')); ?></p>
                                                    <?php } ?>
                                                    
                                                    <div class="entry-meta">
                                            			<div class="comment-author-date">
                                                            <span class="post-author"><a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )), esc_attr(get_the_author_meta( 'user_nicename' )) )); ?>"><i class="fa fa-user-o" aria-hidden="true"></i><?php the_author(); ?></a></span>
                                                            
                                                            <span class="post-date"><a href="<?php echo esc_url(get_day_link( absint(get_the_date('Y')), absint(get_the_date('m')), absint(get_the_date('d')))); ?>"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo esc_html(get_the_date(get_option('date_format'))); ?></a></span>
                                                            
                                                            <span class="post-comment"><a href="<?php comments_link(); ?>"><i class="fa fa-comment-o" aria-hidden="true"></i><?php echo absint(get_comments_number()); esc_html_e(' comment','buzmag'); ?></a></span>
                                                        </div>
                                            		</div><!-- .entry-meta -->
                                                    
                                                </div>
                                            <?php } ?>
                                            
                                        </div>
                                    </div>
                                <?php $bm_blog_cat_category_count++; } ?>
                            </div>
                            
                        <?php wp_reset_postdata();}?>
                    </div>
                    
                <?php } ?>
            </div><?php
        }
        echo $after_widget;
    }
    
    
    public function update($new_instance, $old_instance) {
          $instance = $old_instance;
          $widget_fields = $this->widget_fields();
          foreach ($widget_fields as $widget_field) {
              extract($widget_field);
              $instance[$buzmag_widgets_name] = buzmag_widgets_updated_field_value($widget_field, $new_instance[$buzmag_widgets_name]);
          }
          return $instance;
      }

      public function form($instance) {
          $widget_fields = $this->widget_fields();
          foreach ($widget_fields as $widget_field) {
              extract($widget_field);
              $buzmag_widgets_field_value = !empty($instance[$buzmag_widgets_name]) ? $instance[$buzmag_widgets_name] : '';
              buzmag_widgets_show_widget_field($this, $widget_field, $buzmag_widgets_field_value);
          }
      }

}
