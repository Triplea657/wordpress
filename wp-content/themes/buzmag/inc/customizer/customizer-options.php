<?php
/** Customizer Options
 */
 add_action('customize_register','buzmag_customizer_options');
 function buzmag_customizer_options($wp_customize){
    $buzmag_Category_list = buzmag_Category_list();
    $buzmag_post_lists = buzmag_post_lists();
    
    $wp_customize->get_section( 'title_tagline' )->panel = 'buzmag_header_panel';
    $wp_customize->get_section( 'header_image' )->panel = 'buzmag_header_panel';
    
    $wp_customize->add_setting(
        'buzmag_header_image_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'buzmag_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new buzmag_Customize_Switch_Control(
        $wp_customize, 
        'buzmag_header_image_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Header Image', 'buzmag' ),
            'section' 	=> 'header_image',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'buzmag' ),
                'disable' 	=> esc_html__( 'Disable', 'buzmag' )
                ),
            'priority'  => 1,
        )
        )
    );
    /** Header Image Link **/
    $wp_customize->add_setting(
        'buzmag_header_image_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
    'buzmag_header_image_link',
        array(
            'label' => esc_html__('Header Image Link','buzmag'),
            'priority' => 20,
            'type' => 'text',
            'section' => 'header_image'
        )
    );
    
    /** Header Pannel */
	$wp_customize->add_panel(
        'buzmag_header_panel', 
    	array(
    		'priority'       => 4,
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
        	'title'          => esc_html__( 'Header Settings', 'buzmag' ),
        ) 
    );
    
    /** Home Pannel */
	$wp_customize->add_panel(
        'buzmag_general_panel', 
    	array(
    		'priority'       => 5,
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
        	'title'          => esc_html__( 'General Settings', 'buzmag' ),
        ) 
    );
    
    /** Home Pannel */
	$wp_customize->add_panel(
        'buzmag_home_panel', 
    	array(
    		'priority'       => 5,
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
        	'title'          => esc_html__( 'Satic Home Settings', 'buzmag' ),
        ) 
    );
    
    /** Footer Pannel */
	$wp_customize->add_panel(
        'buzmag_footer_panel', 
    	array(
    		'priority'       => 6,
        	'capability'     => 'edit_theme_options',
        	'theme_supports' => '',
        	'title'          => esc_html__( 'Footer Settings', 'buzmag' ),
        ) 
    );
    
    /** Banner Section **/
    $wp_customize->add_section(
        'buzmag_home_banner_section',
        array(
            'title'		=> esc_html__( 'Banner Settings', 'buzmag' ),
            'panel'     => 'buzmag_home_panel',
            'priority'  => 15,
        )
    );

    $wp_customize->add_setting(
        'buzmag_news_slide_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'buzmag_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new buzmag_Customize_Switch_Control(
        $wp_customize, 
        'buzmag_news_slide_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable News Topic', 'buzmag' ),
            'description' 	=> esc_html__( 'Home Page Header News Title Slider', 'buzmag' ),
            'section' 	=> 'buzmag_home_banner_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'buzmag' ),
                'disable' 	=> esc_html__( 'Disable', 'buzmag' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** Slide News Title **/
    $wp_customize->add_setting(
        'buzmag_news_slide_news_title',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        )
    );
    $wp_customize->add_control(
    'buzmag_news_slide_news_title',
        array(
            'label' => esc_html__('Title Slite News','buzmag'),
            'priority' => 1,
            'type' => 'text',
            'section' => 'buzmag_home_banner_section'
        )
    );
    
    $wp_customize->add_setting(
        'buzmag_news_title_slide_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'buzmag_sanitize_post_cat_list',
        )
    );
    $wp_customize->add_control(
        'buzmag_news_title_slide_cat',
        array(
            'label' => esc_html__('Title Slide Category','buzmag'),
            'priority' => 2,
            'type' => 'select',
            'choices' => $buzmag_Category_list,
            'section' => 'buzmag_home_banner_section'
        )
    );
    
    $wp_customize->add_setting(
        'buzmag_banner_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'buzmag_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new buzmag_Customize_Switch_Control(
        $wp_customize, 
        'buzmag_banner_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Banner', 'buzmag' ),
            'description' 	=> esc_html__( 'Home Page Header Banner', 'buzmag' ),
            'section' 	=> 'buzmag_home_banner_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'buzmag' ),
                'disable' 	=> esc_html__( 'Disable', 'buzmag' )
                ),
            'priority'  => 4,
        )
        )
    );
    
    $wp_customize->add_setting(
        'buzmag_header_banner_layout',
        array(
            'default' => 'layout-1',
            'sanitize_callback' => 'buzmag_sanitize_radio_image'
        )
    );
   	$wp_customize->add_control(
		new buzmag_Custom_Radio_Image_Control( 
			$wp_customize,
			'buzmag_header_banner_layout',
			array(
				'settings'		=> 'buzmag_header_banner_layout',
				'section'		=> 'buzmag_home_banner_section',
				'label'			=> esc_html__( 'Header Banner Layout', 'buzmag' ),
                'priority'  => 5,
				'choices'		=> array(
					'layout-1' 	=> get_template_directory_uri() . '/images/header-1.png',
					'layout-2' 	=> get_template_directory_uri() . '/images/header-2.png',
                    'layout-3' 	=> get_template_directory_uri() . '/images/header-3.png',
				)
			)
		)
	);
    
    $wp_customize->add_setting(
        'buzmag_slider_cat',
        array(
            'default' => '',
            'sanitize_callback' => 'buzmag_sanitize_post_cat_list',
        )
    );
    $wp_customize->add_control(
        'buzmag_slider_cat',
        array(
            'label' => esc_html__('Slider Category','buzmag'),
            'priority' => 6,
            'type' => 'select',
            'choices' => $buzmag_Category_list,
            'section' => 'buzmag_home_banner_section'
        )
    );
    
    $wp_customize->add_setting(
        'buzmag_feature_post_1',
        array(
            'default' => '',
            'sanitize_callback' => 'buzmag_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'buzmag_feature_post_1',
        array(
            'label' => esc_html__('Slider Feature Post One','buzmag'),
            'priority' => 7,
            'type' => 'select',
            'choices' => $buzmag_post_lists,
            'section' => 'buzmag_home_banner_section',
            'active_callback' => 'buzmag_slider_feature_post_active'
        )
    );
    $wp_customize->add_setting(
        'buzmag_feature_post_2',
        array(
            'default' => '',
            'sanitize_callback' => 'buzmag_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'buzmag_feature_post_2',
        array(
            'label' => esc_html__('Slider Feature Post Two','buzmag'),
            'priority' => 8,
            'type' => 'select',
            'choices' => $buzmag_post_lists,
            'section' => 'buzmag_home_banner_section',
            'active_callback' => 'buzmag_slider_feature_post_active'
        )
    );
    $wp_customize->add_setting(
        'buzmag_feature_post_3',
        array(
            'default' => '',
            'sanitize_callback' => 'buzmag_sanitize_post_list',
        )
    );
    $wp_customize->add_control(
        'buzmag_feature_post_3',
        array(
            'label' => esc_html__('Slider Feature Post Three','buzmag'),
            'priority' => 9,
            'type' => 'select',
            'choices' => $buzmag_post_lists,
            'section' => 'buzmag_home_banner_section',
            'active_callback' => 'buzmag_slider_feature_post_active_3'
        )
    );
    
    /** Header Layout Section **/
    $wp_customize->add_section(
        'buzmag_top_header_section',
        array(
            'title'		=> esc_html__( 'Top Header', 'buzmag' ),
            'panel'     => 'buzmag_header_panel',
            'priority'  => 1,
        )
    );
    
    /** Top Header Setting **/
    $wp_customize->add_setting(
        'buzmag_top_header_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'buzmag_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new buzmag_Customize_Switch_Control(
        $wp_customize, 
        'buzmag_top_header_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Top Header', 'buzmag' ),
            'section' 	=> 'buzmag_top_header_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'buzmag' ),
                'disable' 	=> esc_html__( 'Disable', 'buzmag' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** Top Header Social Icon **/
    $wp_customize->add_setting(
    'buzmag_facebook_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
    'buzmag_facebook_link',
        array(
            'label' => esc_html__('Facebook Link','buzmag'),
            'priority' => 4,
            'type' => 'text',
            'section' => 'buzmag_top_header_section'
        )
    );
    $wp_customize->add_setting(
        'buzmag_twitter_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'buzmag_twitter_link',
        array(
            'label' => esc_html__('Twitter Link','buzmag'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'buzmag_top_header_section'
        )
    );
     
    $wp_customize->add_setting(
        'buzmag_youtube_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'buzmag_youtube_link',
        array(
            'label' => esc_html__('Youtube Link','buzmag'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'buzmag_top_header_section'
        )
    );
     
    $wp_customize->add_setting(
        'buzmag_google_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'buzmag_google_link',
        array(
            'label' => esc_html__('Google Link','buzmag'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'buzmag_top_header_section'
        )
    );
     
    $wp_customize->add_setting(
        'buzmag_linkedin_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
     );
    $wp_customize->add_control(
        'buzmag_linkedin_link',
        array(
            'label' => esc_html__('LinkedIn Link','buzmag'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'buzmag_top_header_section'
        )
    );
 
    $wp_customize->add_setting(
        'buzmag_pinterest_link',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        'buzmag_pinterest_link',
        array(
            'label' => esc_html__('Pinterest Link','buzmag'),
            'priority' => 5,
            'type' => 'text',
            'section' => 'buzmag_top_header_section'
        )
    );
    
    /** Menu Section **/
    $wp_customize->add_section(
        'buzmag_menu_section',
        array(
            'title'		=> esc_html__( 'Menu Section', 'buzmag' ),
            'panel'     => 'buzmag_header_panel',
            'priority'  => 6,
        )
    );
    /** Menu Search Enable Disable **/
    $wp_customize->add_setting(
        'buzmag_search_enable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'buzmag_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new buzmag_Customize_Switch_Control(
        $wp_customize, 
        'buzmag_search_enable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Header Search', 'buzmag' ),
            'section' 	=> 'buzmag_menu_section',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'buzmag' ),
                'disable' 	=> esc_html__( 'Disable', 'buzmag' )
                ),
            'priority'  => 1,
        )
        )
    );
    
    /** Category Color Section **/
    $wp_customize->add_section(
        'buzmag_category_setting_setion',
        array(
            'title'		=> esc_html__( 'Category Settings', 'buzmag' ),
            'priority'  => 5,
        )
    );
    $buzmag_Category_list = buzmag_Category_list();
    if($buzmag_Category_list){
        $buzmag_Category_count = 1;
        foreach($buzmag_Category_list as $buzmag_Category){
            
            $wp_customize->add_setting(
                'buzmag_cat_label_'.absint($buzmag_Category_count),
                array(
                    'default' => 'disable',
                    'sanitize_callback' => 'buzmag_sanitize_enable_disable',
                    )
            );
            $wp_customize->add_control( new buzmag_Custom_Category_Color(
                $wp_customize, 
                'buzmag_cat_label_'.absint($buzmag_Category_count), 
                    array(
                        'type' 		=> 'cat-color',
                        'label' 	=> esc_html( $buzmag_Category),
                        'section' 	=> 'buzmag_category_setting_setion',
                    )
                )
            );
            
            $wp_customize->add_setting(
        		'buzmag_cat_color_'.absint($buzmag_Category_count),
        		array(
        			'default'			=> '',
        			'sanitize_callback' => 'sanitize_hex_color',
        			'priority' => 1
        		)
        	);
        
        	$wp_customize->add_control(
        		new WP_Customize_Color_Control(
        			$wp_customize,
        			'buzmag_cat_color_'.absint($buzmag_Category_count),
        			array(
        				'settings'		=> 'buzmag_cat_color_'.absint($buzmag_Category_count),
        				'section'		=> 'buzmag_category_setting_setion',
        				'label'			=> esc_html( $buzmag_Category).esc_html__(' Color ', 'buzmag' ),
        			)
        		)
        	);
        $buzmag_Category_count++;}
    }
    /** Footer Section **/
    $wp_customize->add_section(
        'buzmag_copyright_text',
        array(
            'title'		=> esc_html__( 'Footer Setting', 'buzmag' ),
            'panel'     => 'buzmag_footer_panel',
            'priority'  => 1,
        )
    );
    
    /** Footer Copyright Text **/
    $wp_customize->add_setting(
    'buzmag_footer_copyright_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
    'buzmag_footer_copyright_text',
        array(
            'label' => esc_html__('Footer Copyright Text','buzmag'),
            'priority' => 1,
            'type' => 'text',
            'section' => 'buzmag_copyright_text'
        )
    );
    
    $wp_customize->add_setting(
        'buzmag_go_top_enable_disable',
        array(
            'default' => 'disable',
            'sanitize_callback' => 'buzmag_sanitize_enable_disable',
            )
    );
    $wp_customize->add_control( new buzmag_Customize_Switch_Control(
        $wp_customize, 
        'buzmag_go_top_enable_disable', 
        array(
            'type' 		=> 'switch',
            'label' 	=> esc_html__( 'Enable / Disable Footer Go Up Button', 'buzmag' ),
            'section' 	=> 'buzmag_copyright_text',
            'choices'   => array(
                'enable' 	=> esc_html__( 'Enable', 'buzmag' ),
                'disable' 	=> esc_html__( 'Disable', 'buzmag' )
                ),
            'priority'  => 1,
        )
        )
    );
    /** Footer Section **/
    $wp_customize->add_section(
        'buzmag_theme_color_section',
        array(
            'title'		=> esc_html__( 'Theme Color', 'buzmag' ),
            'panel'     => 'buzmag_general_panel',
            'priority'  => 1,
        )
    );
    $wp_customize->add_setting(
		'buzmag_theme_color',
		array(
			'default'			=> '',
			'sanitize_callback' => 'sanitize_hex_color',
			'priority' => 1,
            'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'buzmag_theme_color',
			array(
				'settings'		=> 'buzmag_theme_color',
				'section'		=> 'buzmag_theme_color_section',
				'label'			=> esc_html__('Theme Color', 'buzmag' ),
			)
		)
	);
 }
 
 
 /** Customizer Class **/
 if ( class_exists( 'WP_Customize_Control' ) ) {
    
    /** Switch Button **/
    class buzmag_Customize_Switch_Control extends WP_Customize_Control {

		public $type = 'switch';

		public function render_content() {
	?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
		        <div class="switch_button">
		        	<?php 
		        		$show_choices = $this->choices;
		        		foreach ( $show_choices as $key => $value ) {
		        			echo '<span class="switch_part '.esc_attr($key).'" data-switch="'.esc_attr($key).'">'. esc_html($value).'</span>';
		        		}
		        	?>
                  	<input type="hidden" id="switch_button" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" />
                </div>
            </label>
	<?php
		}
	}
    
    
    /** Radio Image Control Class **/
    class buzmag_Custom_Radio_Image_Control extends WP_Customize_Control {

    	public $type = 'radio-image';
    
    	public function render_content() {
    		if ( empty( $this->choices ) ) {
    			return;
    		}			
    		
    		$name = '_customize-radio-' . $this->id;
    		?>
    		<span class="customize-control-title">
    			<?php echo esc_attr( $this->label ); ?>
    			<?php if ( ! empty( $this->description ) ) : ?>
    				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    			<?php endif; ?>
    		</span>
    		<div id="input_<?php echo esc_attr($this->id); ?>" class="image">
    			<?php foreach ( $this->choices as $value => $label ) : ?>
    				<input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo esc_attr($this->id) . esc_attr($value); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
    					<label for="<?php echo esc_attr($this->id) . esc_attr($value); ?>">
    						<img src="<?php echo esc_html( $label ); ?>" alt="<?php echo esc_attr( $value ); ?>" title="<?php echo esc_attr( $value ); ?>">
    					</label>
    				</input>
    			<?php endforeach; ?>
    		</div>
    		<?php
    	}
    }
    
    /** Radio Image Control Class **/
    class buzmag_Custom_Category_Color extends WP_Customize_Control {

    	public $type = 'cat-color';
    
    	public function render_content() { ?>
    		<label id="cat-name" class="customize-control-title">
    			<?php echo esc_html( $this->label ); ?>
    		</label>
    		<?php
    	}
    }
    
}
 
 
 
/** Sanitize Function **/
function buzmag_sanitize_enable_disable( $input ) {
    $valid_keys = array(
            'enable'  => esc_html__( 'Enable', 'buzmag' ),
            'disable'  => esc_html__( 'Disable', 'buzmag' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

function buzmag_sanitize_radio_image( $input ) {
    $valid_keys = array(
            'layout-1'  => esc_html__( 'Layout 1', 'buzmag' ),
            'layout-2'  => esc_html__( 'Layout 2', 'buzmag' ),
            'layout-3'  => esc_html__( 'Layout 3', 'buzmag' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/** Customizer Category List Sanitize **/
function buzmag_sanitize_post_cat_list($input){
    $buzmag_Category_list = buzmag_Category_list();
    if(array_key_exists($input,$buzmag_Category_list)){
        return $input;
    }
    else{
        return '';
    }
}

/** Customizer Category List Sanitize **/
function buzmag_sanitize_post_list($input){
    $buzmag_post_lists = buzmag_post_lists();
    if(array_key_exists($input,$buzmag_post_lists)){
        return $input;
    }
    else{
        return '';
    }
}

/** Header Banner Layout Two **/
function buzmag_slider_feature_post_active( $control ) {
    if($control->manager->get_setting('buzmag_header_banner_layout')->value() == 'layout-2' || $control->manager->get_setting('buzmag_header_banner_layout')->value() == 'layout-3'){
        return true;
    }else{
        return false;
    }
}

/** Header Banner Layout Three **/
function buzmag_slider_feature_post_active_3( $control ) {
    if($control->manager->get_setting('buzmag_header_banner_layout')->value() == 'layout-3'){
        return true;
    }else{
        return false;
    }
}