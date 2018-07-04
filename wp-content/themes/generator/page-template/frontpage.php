<?php
/*
* Template Name: Home Page
*/
get_header(); 
$generator_options = get_option( 'faster_theme_options' ); ?>
<div class="callbacks_container">
  <ul class="rslides" id="slider4">
    <?php for($generator_loop=1 ; $generator_loop <5 ; $generator_loop++):
    if(!empty($generator_options['slider-img-'.$generator_loop])){ ?>
    <li>
      <?php if(!empty($generator_options['slidelink-'.$generator_loop])) { ?>
      <a href="<?php echo esc_url($generator_options['slidelink-'.$generator_loop]);?>" target="_blank"><img src="<?php echo $generator_options['slider-img-'.$generator_loop]; ?>" alt="" /></a>
      <?php }else{?>
      <img src="<?php echo esc_url($generator_options['slider-img-'.$generator_loop]); ?>" alt="" />
      <?php } ?>
    </li>
    <?php } 
    endfor;?>
  </ul>
</div>
<div class="generator-single-blog section-main front-main">
  <div class=" container-generator container homepage-theme-title">
    <h2>
      <?php if(!empty($generator_options['home-title'])) { echo esc_attr($generator_options['home-title']); } ?>
    </h2>
    <h3>
      <?php if(!empty($generator_options['home-content'])) { echo esc_attr($generator_options['home-content']); } ?>
    </h3>
  </div>
</div>
<div class="container container-generator">
  <div class="col-md-12 generator-post no-padding">
    <?php get_template_part('front-content','generator'); ?>
  </div>
  <div class="clearfix"></div>
  <?php  if(!empty($generator_options['post-category'])){ ?>
  <div class="container container-generator generator-home-content no-padding">
    <div class="col-md-12 no-padding next-prev">
      <div class="back-radius"> <i class="fa fa-pencil project-icon-size"></i> </div>
      <span class="project-tag">
      <?php  if(!empty($generator_options['post-title'])) { echo esc_attr($generator_options['post-title']); }
	  else{  
		_e('Recent Posts','generator');
		}
	  ?>
      </span> 
    </div>
    <div class="project1-line"></div>
    <div class="row margin-top-8 text-center no-padding">
      <?php
	$generator_args = array(
	   'cat'  => $generator_options['post-category'],
		'meta_query' => array(
			array(
			 'key' => '_thumbnail_id',
			 'compare' => 'EXISTS'
			),
		)
	);	
$generator_query=new $wp_query($generator_args); ?>
      <?php if ( $generator_query->have_posts() ) { ?>
      <div class="owl-carousel" id="owl-demo" >
        <?php while($generator_query->have_posts()) {  $generator_query->the_post(); ?>
        <div id="hover-cap-4col" class="col-md-3 item">
          <div class="back-box">
            <div class="thumbnail">
              <div class="caption " style="display: none;"><a href="<?php echo get_permalink(get_the_ID()) ?>"> <span class="back-radius-img-hover"> <i class="fa fa-plus back-plus-center "></i> </span> </a> </div>
              <?php $generator_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );?>
              <?php if($generator_image != "") { ?> <img src="<?php echo $generator_image; ?>" /> <?php } ?>
            </div>
            <h2 class="project-title"><a href="<?php echo get_permalink(get_the_ID()) ?>"><?php echo get_the_title(); ?></a></h2>
            <span class="project-contan"><?php echo get_the_excerpt(); ?></span>
            <div class="img-box-border-boottom"></div>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php } else { ?>
	  <p><?php _e('No posts found','generator'); ?></p> 
	  <?php } ?>
    </div>
  </div>
   <?php  } ?>	
</div>
<?php  get_footer(); ?>