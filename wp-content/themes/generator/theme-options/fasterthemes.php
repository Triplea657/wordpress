<?php
function fasterthemes_options_init(){
 register_setting( 'ft_options', 'faster_theme_options','ft_options_validate');
} 
add_action( 'admin_init', 'fasterthemes_options_init' );
function ft_options_validate($input)
{
	 $input['logo'] = esc_url( $input['logo'] );
	 $input['favicon'] = esc_url( $input['favicon'] );
	 $input['footertext'] = wp_filter_nohtml_kses( $input['footertext'] );
	 $input['email'] = wp_filter_nohtml_kses( $input['email'] );
	 $input['phone'] = wp_filter_nohtml_kses( $input['phone'] );
	 $input['home-title'] = wp_filter_nohtml_kses( $input['home-title'] );
	 $input['home-content'] = wp_filter_nohtml_kses( $input['home-content'] );
	 $input['post-title'] = wp_filter_nohtml_kses( $input['post-title'] );
	 
	 $input['twitter'] = esc_url( $input['twitter'] );
	 $input['fburl'] = esc_url( $input['fburl'] );
	 $input['dribbble'] = esc_url( $input['dribbble'] );
	 $input['linkedin'] = esc_url( $input['linkedin'] );
	 $input['rss'] = esc_url( $input['rss'] );
	 
	 for($generator_i=1; $generator_i <=5 ;$generator_i++ ):
	 $input['slider-img-'.$generator_i] = esc_url( $input['slider-img-'.$generator_i] );
	 $input['slidelink-'.$generator_i] = esc_url( $input['slidelink-'.$generator_i]);
	 endfor;
	 
	 for($generator_section_i=1; $generator_section_i <=4 ;$generator_section_i++ ):
	 $input['home-icon-'.$generator_section_i] = esc_url( $input['home-icon-'.$generator_section_i]);
	 $input['section-title-'.$generator_section_i] = wp_filter_nohtml_kses($input['section-title-'.$generator_section_i]);
	 $input['section-content-'.$generator_section_i] = wp_filter_nohtml_kses($input['section-content-'.$generator_section_i]);
	 endfor;
    return $input;
}
function fasterthemes_framework_load_scripts(){
	wp_enqueue_media();
	wp_enqueue_style( 'fasterthemes_framework', get_template_directory_uri(). '/theme-options/css/fasterthemes_framework.css' ,false, '1.0.0');
	wp_enqueue_style( 'fasterthemes_framework' );	
	// Enqueue custom option panel JS
	wp_enqueue_script( 'options-custom', get_template_directory_uri(). '/theme-options/js/fasterthemes-custom.js', array( 'jquery' ) );
	wp_enqueue_script( 'media-uploader', get_template_directory_uri(). '/theme-options/js/media-uploader.js', array( 'jquery') );		
	wp_enqueue_script('media-uploader');
}
add_action( 'admin_enqueue_scripts', 'fasterthemes_framework_load_scripts' );
function fasterthemes_framework_menu_settings() {
	$generator_menu = array(
				'page_title' => __( 'FasterThemes Options', 'generator'),
				'menu_title' => __('Theme Options', 'generator'),
				'capability' => 'edit_theme_options',
				'menu_slug' => 'fasterthemes_framework',
				'callback' => 'fastertheme_framework_page'
				);
	return apply_filters( 'fasterthemes_framework_menu', $generator_menu );
}
add_action( 'admin_menu', 'theme_options_add_page' ); 
function theme_options_add_page() {
	$generator_menu = fasterthemes_framework_menu_settings();
   	add_theme_page($generator_menu['page_title'],$generator_menu['menu_title'],$generator_menu['capability'],$generator_menu['menu_slug'],$generator_menu['callback']);
} 
function fastertheme_framework_page(){ 
		global $select_options; 
		if ( ! isset( $_REQUEST['settings-updated'] ) ) 
		$_REQUEST['settings-updated'] = false; ?>
<div class="fasterthemes-themes">
	<form method="post" action="options.php" id="form-option" class="theme_option_ft">
  <div class="fasterthemes-header">
    <div class="logo">
      <?php
		$generator_image=get_template_directory_uri().'/theme-options/images/logo.png';
		echo "<a href='http://fasterthemes.com' target='_blank'><img src='".$generator_image."' alt='FasterThemes' /></a>"; ?>
    </div>
    <div class="header-right">
      <h1><?php _e('Theme Options','generator'); ?></h1>
    	<div class='btn-save'><input type='submit' class='button-primary' value='<?php _e('Save Options','generator'); ?>' />
		</div>
    </div>
  </div>
  <div class="fasterthemes-details">
    <div class="fasterthemes-options">
      <div class="right-box">
        <div class="nav-tab-wrapper">
          <ul>
            <li><a id="options-group-1-tab" class="nav-tab basicsettings-tab" title="Basic Settings" href="#options-group-1"><?php _e('Basic Settings','generator'); ?></a></li>
            <li><a id="options-group-2-tab" class="nav-tab homepagesettings-tab" title="Home Page Settings" href="#options-group-2"><?php _e('Home Page Settings','generator'); ?></a></li>
            <li><a id="options-group-3-tab" class="nav-tab socialsettings-tab" title="Social Settings" href="#options-group-3"><?php _e('Social Settings','generator'); ?></a></li>
            <li><a id="options-group-4-tab" class="nav-tab profeatures-tab" title="Pro Settings" href="#options-group-4"><?php _e('PRO Theme Features','generator'); ?></a></li>
  		  </ul>
        </div>
      </div>
      <div class="right-box-bg"></div>
      <div class="postbox left-box"> 
        <!-- F I N A L - - T H E M E - - O P T I O N -->
          <?php settings_fields( 'ft_options' );
          $generator_options = get_option( 'faster_theme_options' ); ?>
            <!-- Header group -->
          <div id="options-group-1" class="group faster-inner-tabs">   
                 
          	<div class="section theme-tabs theme-logo">
            <a class="heading faster-inner-tab active" href="javascript:void(0)"><?php _e('Site Logo','generator'); ?></a>
            <div class="faster-inner-tab-group active">
              	<div class="ft-control">
                <input id="logo-img" class="upload" type="text" name="faster_theme_options[logo]" 
                            value="<?php if(!empty($generator_options['logo'])) { echo esc_url($generator_options['logo']); } ?>" placeholder="<?php _e('No file chosen','generator') ?>" />
                <input id="upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload','generator') ?>" />
                <div class="screenshot" id="logo-image">
                  <?php if(!empty($generator_options['logo']))  { ?>
				     <img src="<?php esc_url($generator_options['logo']); ?>"/>
					 <a class='remove-image'><?php _e('Remove','generator'); ?></a>
					<?php } ?>
                </div>
              </div>
              
            </div>
          </div>
            <div class="section theme-tabs theme-favicon">
              <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Favicon','generator'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="explain"><?php _e('Size of favicon should be exactly 32x32px for best results.','generator') ?></div>
                <div class="ft-control">
                  <input id="favicon-img" class="upload" type="text" name="faster_theme_options[favicon]" 
                            value="<?php if(!empty($generator_options['favicon'])) { echo esc_url($generator_options['favicon']); } ?>" placeholder="<?php _e('No file chosen','generator') ?>" />
                  <input id="upload_image_button1" class="upload-button button" type="button" value="<?php _e('Upload','generator') ?>" />
                  <div class="screenshot" id="favicon-image">
                    <?php  if(!empty($generator_options['favicon'])) { ?>
					 <img src="<?php esc_url($generator_options['favicon']) ?>"/>
					 <a class='remove-image'><?php _e('Remove','generator'); ?></a>
					 <?php } ?>
                  </div>
                </div>
              </div>
            </div>     
            <div id="section-footertext" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Copyright Text','generator'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Some text regarding copyright of your site, you would like to display in the footer.','generator'); ?></div>
                  	<input type="text" id="footertext" class="of-input" name="faster_theme_options[footertext]" size="32"  value="<?php if(!empty($generator_options['footertext'])) { echo esc_attr($generator_options['footertext']); } ?>">
                </div>                
              </div>
            </div>

            <div id="section-email" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Email','generator'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Enter e-mail id for your site , you would like to display in the Top Header.','generator'); ?></div>                
                  	<input type="text" id="email" class="of-input" name="faster_theme_options[email]" size="32"  value="<?php if(!empty($generator_options['email'])) { echo esc_attr($generator_options['email']); } ?>">
                </div>                
              </div>
            </div>

            <div id="section-phone" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Phone','generator') ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Enter phone number for your site , you would like to display in the Top Header.','generator'); ?></div>                
                  	<input type="text" id="phone" class="of-input" name="faster_theme_options[phone]" size="32"  value="<?php if(!empty($generator_options['phone'])) { echo esc_attr($generator_options['phone']); } ?>">
                </div>                
              </div>
            </div>
                        
          </div>          
          <!-- Home Page group -->
          <div id="options-group-2" class="group faster-inner-tabs">
          <h3><?php _e('Banner Slider','generator'); ?></h3>
			<?php for($generator_i=1; $generator_i <= 5 ;$generator_i++ ):?> 
            <div class="section theme-tabs theme-slider-img">
            <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Slider','generator') ?> <?php echo $generator_i;?></a>
            <div class="faster-inner-tab-group">
                <div class="ft-control">
                <input id="slider-img-<?php echo $generator_i;?>" class="upload" type="text" name="faster_theme_options[slider-img-<?php echo $generator_i;?>]" 
                            value="<?php if(!empty($generator_options['slider-img-'.$generator_i])) { echo esc_url($generator_options['slider-img-'.$generator_i]); } ?>" placeholder="<?php _e('No file chosen','generator') ?>" />
                <input id="1upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload','generator') ?>" />
                <div class="screenshot" id="slider-img-<?php echo $generator_i;?>">
                  <?php if(!empty($generator_options['slider-img-'.$generator_i])) { ?>
				   <img src="<?php esc_url($generator_options['slider-img-'.$generator_i])?>" />
				   <a class='remove-image'><?php _e('Remove','generator'); ?></a> 
				   <?php } ?>
                </div>
              </div>
            
                <div class="ft-control">
                    <input type="text" placeholder="Slide<?php echo $generator_i; ?> Link" id="slidelink-<?php echo $generator_i; ?>" class="of-input" name="faster_theme_options[slidelink-<?php echo $generator_i;?>]" size="32"  value="<?php if(!empty($generator_options['slidelink-'.$generator_i])) { echo esc_attr($generator_options['slidelink-'.$generator_i]); } ?>">
              </div>
                              
            </div>
            
            </div>
            <?php endfor; ?>
            <h3><?php _e('Title Bar','generator'); ?></h3>
            <div id="section-title" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Title','generator'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Enter home page title for your site , you would like to display in the Home Page.','generator'); ?></div>                
                  	<input id="title" class="of-input" name="faster_theme_options[home-title]" type="text" size="50" value="<?php if(!empty($generator_options['home-title'])) { echo esc_attr($generator_options['home-title']); } ?>" />
                </div>                
              </div>
            </div>
            <div class="section theme-tabs theme-short_description">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Short Description','generator'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
                <div class="explain"><?php _e('Enter home content for your site , you would like to display in the Home Page.','generator'); ?></div>
              <textarea name="faster_theme_options[home-content]" rows="6" id="home-content1" class="of-input"><?php if(!empty($generator_options['home-content'])) { echo $generator_options['home-content']; } ?></textarea>
                </div>                
              </div>
            </div>
			<h3><?php _e('First Section','generator'); ?></h3>
          <?php for($generator_section_i=1; $generator_section_i <=4 ;$generator_section_i++ ): ?>
            <div class="section theme-tabs theme-slider-img">
            <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Tab','generator'); ?> <?php echo $generator_section_i; ?></a>
            <div class="faster-inner-tab-group">
                <div class="ft-control">
                <input id="first-image-<?php echo $generator_section_i;?>" class="upload" type="text" name="faster_theme_options[home-icon-<?php echo $generator_section_i; ?>]" 
                            value="<?php if(!empty($generator_options['home-icon-'.$generator_section_i])) { echo esc_url($generator_options['home-icon-'.$generator_section_i]); } ?>" placeholder="<?php _e('No file chosen','generator'); ?>" />
                <input id="upload_image_button" class="upload-button button" type="button" value="<?php _e('Upload','generator'); ?>" />
                <div class="screenshot" id="first-img-<?php echo $generator_section_i; ?>">
                  <?php if(!empty($generator_options['home-icon-'.$generator_section_i])) { ?>
				  <img src="<?php esc_url($generator_options['home-icon-'.$generator_section_i]) ?>"/>
				  <a class='remove-image'><?php _e('Remove','generator'); ?></a>
				  <?php } ?>
                </div>
              </div>
            
                <div class="ft-control">
                <div class="explain"><?php _e('Enter section title for your home template , you would like to display in the Home Page.','generator'); ?></div>
                    <input type="text" placeholder="<?php _e('Enter title here','generator') ?>" id="title-<?php echo $generator_section_i;?>" class="of-input" name="faster_theme_options[section-title-<?php echo $generator_section_i;?>]" size="32"  value="<?php if(!empty($generator_options['section-title-'.$generator_section_i])) { echo esc_attr($generator_options['section-title-'.$generator_section_i]); } ?>">
              </div>
				      <div class="ft-control">
                 <div class="explain"><?php _e('Enter section content for home template , you would like to display in the Home Page.','generator'); ?></div>
              <textarea name="faster_theme_options[section-content-<?php echo $generator_section_i; ?>]" rows="6" id="content-<?php echo $generator_section_i; ?>" placeholder="<?php _e('Enter Content here','generator') ?>" class="of-input"><?php if(!empty($generator_options['section-content-'.$generator_section_i])) { echo $generator_options['section-content-'.$generator_section_i]; } ?></textarea>
              </div>                              
            </div>            
            </div>
            <?php endfor; ?>
            <h3><?php _e('Second Section','generator'); ?></h3>
            <div id="section-recent-title" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Recent Post Title','generator'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Enter recent post title for your site , you would like to display in the Home Page.','generator'); ?></div>                
                  	<input id="post" class="of-input" name="faster_theme_options[post-title]" type="text" size="50" value="<?php if(!empty($generator_options['post-title'])) { echo esc_attr($generator_options['post-title']); } ?>" />
                </div>                
              </div>
            </div>
            <div class="section theme-tabs theme-short_description">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Category','generator'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
                <select name="faster_theme_options[post-category]" id="category">
                  <option value=""><?php echo esc_attr(__('Select Category','generator')); ?></option>
                  <?php 
				$generator_args = array(
				'meta_query' => array(
									array(
									'key' => '_thumbnail_id',
									'compare' => 'EXISTS'
										),
									)
								);  
				$generator_post = new WP_Query( $generator_args );
				$generator_cat_id=array();
				while($generator_post->have_posts()){
				$generator_post->the_post();
				$generator_post_categories = wp_get_post_categories( get_the_id());   
				$generator_cat_id[]=$generator_post_categories[0];
				}
				$generator_cat_id=array_unique($generator_cat_id);
				$generator_args = array(
				'orderby' => 'name',
				'parent' => 0,
				'include'=>$generator_cat_id
				);
				$generator_categories = get_categories($generator_args); 
                  foreach ($generator_categories as $generator_category) {
					  if($generator_category->term_id == $generator_options['post-category'])
					  	$generator_selected="selected=selected";
					  else
					  	$generator_selected='';
                    $generator_option = '<option value="'.$generator_category->term_id .'" '.$generator_selected.'>';
                    $generator_option .= $generator_category->cat_name;
                    $generator_option .= '</option>';
                    echo $generator_option;
                  } ?>
                </select>
                </div>                
              </div>
            </div>
          </div>    
          <!-- Social group -->
          <div id="options-group-3" class="group faster-inner-tabs">            
            <div id="section-facebook" class="section theme-tabs">
            	<a class="heading faster-inner-tab active" href="javascript:void(0)"><?php _e('Facebook','generator'); ?></a>
              <div class="faster-inner-tab-group active">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Facebook profile or page URL ','generator'); ?>i.e. http://facebook.com/username/ </div>                
                  	<input id="facebook" class="of-input" name="faster_theme_options[fburl]" size="30" type="text" value="<?php if(!empty($generator_options['fburl'])) { echo esc_url($generator_options['fburl']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-twitter" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Twitter','generator'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Twitter profile or page URL i.e. ','generator') ?>http://www.twitter.com/username/</div>                
                  	<input id="twitter" class="of-input" name="faster_theme_options[twitter]" type="text" size="30" value="<?php if(!empty($generator_options['twitter'])) { echo esc_url($generator_options['twitter']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-dribbble" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Dribbble','generator'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Dribbble profile or page URL i.e.','generator'); ?> https://dribbble.com/username/</div>                
                  	 <input id="dribbble" class="of-input" name="faster_theme_options[dribbble]" type="text" size="30" value="<?php if(!empty($generator_options['dribbble'])) { echo esc_url($generator_options['dribbble']); } ?>" />
                </div>                
              </div>
            </div>
			<div id="section-linkedin" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Linkedin','generator'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Linkedin profile or page URL i.e. ','generator'); ?> https://linkedin.com/username/</div>                
                  	 <input id="linkedin" class="of-input" name="faster_theme_options[linkedin]" type="text" size="30" value="<?php if(!empty($generator_options['linkedin'])) { echo esc_url($generator_options['linkedin']); } ?>" />
                </div>                
              </div>
            </div>
            <div id="section-rss" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('RSS','generator'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('RSS profile or page URL i.e. ','generator'); ?> https://www.rss.com/username/</div>                
                  	<input id="rss" class="of-input" name="faster_theme_options[rss]" type="text" size="30" value="<?php if(!empty($generator_options['rss'])) { echo esc_url($generator_options['rss']); } ?>" />
                </div>                
              </div>
            </div>
          </div>
          <!-- Social group -->          
          <div id="options-group-4" class="group faster-inner-tabs fasterthemes-pro-image">
          	<div class="fasterthemes-pro-header">
              <img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/theme-logo.png" class="fasterthemes-pro-logo" />
              <a href="http://fasterthemes.com/wordpress-themes/generator" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/buy-now.png" class="fasterthemes-pro-buynow" /></a>
              </div>
          	<img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/pro_features.png" style="width:100%;" />
          </div>   
        <!-- F I N A L - - T H E M E - - O P T I O N S --> 
      </div>
     </div>
	</div>
	<div class="fasterthemes-footer">
      	<ul>
        	<li>&copy; <a href="http://fasterthemes.com" target="_blank"><?php _e('fasterthemes.com','generator') ?></a></li>
            <li><a href="https://www.facebook.com/faster.themes" target="_blank"> <img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/fb.png"/> </a></li>
            <li><a href="https://twitter.com/FasterThemes" target="_blank"> <img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/tw.png"/> </a></li>
            <li class="btn-save"><input type="submit" class="button-primary" value="<?php _e('Save Options','generator'); ?>" /></li>
        </ul>
    </div>
    </form>    
</div>
<div class="save-options"><h2><?php _e('Options saved successfully','generator'); ?>.</h2></div>
<?php } ?>