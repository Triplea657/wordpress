<?php
/**
 * @package buzmag
 */

add_action('widgets_init', 'buzmag_masonry_post_register');

function buzmag_masonry_post_register() {
    register_widget('buzmag_masonry_post_Widget');
}

class buzmag_masonry_post_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'buzmag_masonry_post_Widget', esc_html__('Buzmag : Home Masonry Post', 'buzmag'), array(
                'description' => esc_html__('This Widget show masonry_post', 'buzmag')
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
            'bm_masonry_post_title' => array(
                'buzmag_widgets_name' => 'bm_masonry_post_title',
                'buzmag_widgets_title' => esc_html__('Masonory Secction Title', 'buzmag'),
                'buzmag_widgets_field_type' => 'text',
            ),
            'bm_masonry_post_category' => array(
                  'buzmag_widgets_name' => 'bm_masonry_post_category',
                  'buzmag_widgets_title' => esc_html__('Select Products Categorys', 'buzmag'),
                  'buzmag_widgets_field_type' => 'multicheckboxes',
                  'buzmag_widgets_field_options' => $buzmag_cat_list
            ),
            'bm_masonry_post_posts' => array(
                'buzmag_widgets_name' => 'bm_masonry_post_posts',
                'buzmag_widgets_title' => esc_html__('Masonry Posts Number', 'buzmag'),
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
               
        $bm_masonry_post_category_list = isset( $instance['bm_masonry_post_category'] ) ? $instance['bm_masonry_post_category'] : '' ;
        $bm_masonry_post_title = apply_filters( 'widget_title', empty( $instance['bm_masonry_post_title'] ) ? '' : $instance['bm_masonry_post_title'], $instance, $this->id_base );
        $bm_masonry_post_posts = isset( $instance['bm_masonry_post_posts'] ) ? $instance['bm_masonry_post_posts'] : '' ;
        if($bm_masonry_post_posts == ''){
            $bm_masonry_post_posts = -1;
        }
        
        echo $before_widget;?>
            <div class="bm-masonry-container">
                <?php if (!empty($bm_masonry_post_title)): ?>
                    <div class="home-widget-title"><?php echo $args['before_title'] . esc_html($bm_masonry_post_title) . $args['after_title']; ?></div>
                <?php endif; ?>
                <?php if($bm_masonry_post_category_list){ ?>
                
                    <div class="titles-port clearfix">
                        <div class="filter active" data-filter="*"><?php esc_html_e('All', 'buzmag'); ?></div>
                        <?php $bm_masonry_post_cat_slug_array = array(); 
                        foreach($bm_masonry_post_category_list as $bm_masonry_post_cat_id => $bm_masonry_post_category){
                            $bm_term_get_name = get_cat_name($bm_masonry_post_cat_id);
                            $bm_masonry_post_cat_slug_array[$bm_masonry_post_cat_id] = $bm_masonry_post_cat_id;?>
                            <div class="filter" data-filter=".category-<?php echo esc_attr($bm_masonry_post_cat_id); ?>"><?php echo esc_html($bm_term_get_name); ?></div>
                        <?php } ?>
                    </div>
                    
                    <?php $buzmag_mas_post_args = array(
                            'poat_type' => 'post',
                            'order' => 'DESC',
                            'posts_per_page' => $bm_masonry_post_posts,
                            'post_status' => 'publish',
                            'tax_query' => array(
                        		array(
                        			'taxonomy' => 'category',
                        			'field'    => 'term_id',
                        			'terms'    => $bm_masonry_post_cat_slug_array,
                        		),
                        	),
                          );
                    $buzmag_mas_post_query = new WP_Query($buzmag_mas_post_args);
                    if($buzmag_mas_post_query->have_posts()){?>
                    <div class="bm-posts-grid-list clearfix">
                        <?php while($buzmag_mas_post_query->have_posts()){
                              $buzmag_mas_post_query->the_post();
                              $buzmag_cats = get_the_category();
                              $buzmag_cat_list = '';
                              foreach ($buzmag_cats as $buzmag_cat) :
                                    $buzmag_cat_list .= 'category-' . $buzmag_cat->term_id . ' ';
                              endforeach;
                              $buzmag_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'buzmag-portfolio-image');
                              ?>
                              <div class="loop-grid-posts <?php echo esc_attr($buzmag_cat_list); ?>">
                                <div class="overflow">
                                    
                                        
                                            <?php if (has_post_thumbnail()) : ?>
                                                <figure>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <img src="<?php echo esc_url($buzmag_img[0]); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
                                                    </a>
                                                </figure>
                                            <?php endif; ?>
                                        
                                        <div class="bm-port-excerpt">
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
                                            <a href="<?php the_permalink(); ?>"><h4 class="bm-port-title" ><?php the_title(); ?></h4></a>
                                        </div>
                                    
                                </div>
                              </div>
                              <?php
                        }?>
                    </div>
                <?php wp_reset_postdata();}
                } ?>
            </div>
        <?php echo $after_widget;
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
