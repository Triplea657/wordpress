<?php
/**
 * The Header template for our theme
 */
 $generator_options = get_option( 'faster_theme_options' );
# print_r($generator_options); ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php if(!empty($generator_options['favicon'])) { ?>
    <link rel="shortcut icon" href="<?php echo esc_url($generator_options['favicon']);?>">
    <?php } ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
	<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
  <div class="container container-generator ">
    <div class="col-md-12 margin-top-8 font-color no-padding">
      <div class="col-md-6  margin-top-8 no-padding header-icon">
        <div class="col-md-5 no-padding header-icon"><?php if(!empty($generator_options['email'])) { ?> <i class="fa fa-envelope"></i> <span class="icon-email-phone"> <?php echo esc_attr($generator_options['email']);?> </span> <?php } ?> </div>
        <div class="col-md-7 no-padding header-icon"><?php if(!empty($generator_options['phone'])) { ?> <i class="fa fa-phone"></i> <span class="icon-email-phone"><?php echo esc_attr($generator_options['phone']);?></span> <?php } ?> </div>
      </div>
      <div class="col-md-6 text-right no-padding">
        <div class="col-md-8 icon-menu  margin-top-8 no-padding  ">
          <ul class="list-inline padding-right-10 no-padding-right" >
          <?php if(!empty($generator_options['twitter'])){ ?><li><a href="<?php echo esc_url($generator_options['twitter']);?>"><i class="fa fa-twitter-square"></i></a></li> <?php } ?>
          <?php if(!empty($generator_options['fburl'])){ ?><li><a href="<?php echo esc_url($generator_options['fburl']);?>"><i class="fa fa-facebook-square"></i></a></li> <?php } ?>
          <?php if(!empty($generator_options['dribbble'])){ ?><li><a href="<?php echo esc_url($generator_options['dribbble']);?>"><i class="fa fa-dribbble"></i></a></li> <?php } ?>
          <?php if(!empty($generator_options['linkedin'])){ ?><li><a href="<?php echo esc_url($generator_options['linkedin']);?>" ><i class="fa fa-linkedin"></i></a></li> <?php } ?>
          <?php if(!empty($generator_options['rss'])){ ?><li><a href="<?php echo esc_url($generator_options['rss']);?>" ><i class="fa fa-rss"></i></a></li> <?php }?>
          </ul>
        </div>
        <div class="col-md-4 no-padding center-search ">
           <form method="get" id="searchform" action="<?php  echo home_url(); ?>/">
                <input type="text" value="<?php the_search_query(); ?>" class="search-box" name="s" id="s"  placeholder="<?php _e('Search the site','generator'); ?>" />
                <input type="submit" id="searchsubmit" value="" class="search-button" />
            </form>
           </div>
      </div>
    </div>
    <div class="separator no-padding navbar-fixed-top header-bg-color <?php generator_header_scroll(); ?>">
	 
      <div class="container-generator container">
        <div class="col-md-3 no-padding menu-left">
        	<?php if(empty($generator_options['logo'])) { ?>
        		<h1 class="generator-site-name"><a href="<?php echo get_site_url(); ?>"><?php echo get_bloginfo('name'); ?></a></h1>
            <?php } else { ?>
        		<a href="<?php echo get_site_url(); ?>"><img src="<?php echo esc_url($generator_options['logo']); ?>" alt="" class="logo-center" /></a>
            <?php } ?> 
        </div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle navbar-toggle-top sort-menu-icon" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only"><?php _e('Toggle navigation','generator') ?></span> <span class="icon-bar icon-color"></span> <span class="icon-bar icon-color"></span> <span class="icon-bar icon-color"></span> </button>
        </div>
         <?php $generator_defaults = array(
							'theme_location'  => 'primary',
							'container'       => 'div',
							'container_class' => 'navbar-collapse collapse no-padding pull-right',
							'container_id'    => 'bs-example-navbar-collapse-1',
							'menu_class'      => 'navbar-collapse no-padding pull-right collapse',
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul class="nav navbar-nav generator-menu">%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''
						);
			wp_nav_menu($generator_defaults); ?>
      </div>
      <div class="clearfix"></div>
    </div>
    
  </div><?php if(get_header_image()){ ?>
        <div class="custom-header-img">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        	<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
        </a>
        </div>
    <?php } ?>   
</header>