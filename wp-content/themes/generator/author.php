<?php 
/**
 * Author Page template file
**/
get_header(); ?>
<div class="generator-single-blog section-main">
  <div class=" container-generator container">
    
    <h1><?php _e('Author : All posts by ','generator'); echo " : ". get_the_date('M-Y'); ?></h1>
    <div class="header-breadcrumb">
      <ol>
        <?php if (function_exists('generator_custom_breadcrumbs')) generator_custom_breadcrumbs(); ?>
      </ol>
    </div>
  </div>
</div>
<div class="container container-generator">
  <div class="col-md-12 generator-post no-padding">
    <div class="col-md-8 no-padding-left"> 
      <?php while ( have_posts() ) : the_post(); ?>
      <?php $generator_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>
        <div class="blog-post-list">
        <div class="col-md-12 no-padding">
          <div class="col-md-10 no-padding">
            <h2 class="generator-head-title"><a href="<?php echo get_permalink(); ?>" class="generator-link"><?php the_title(); ?></a></h2>
          </div>
          <div class="col-md-2 comments-icon"> <i class="fa fa-comments"></i> <?php comments_number( '0', '1', '%' ); ?> </div>
        </div>
        <div class="col-md-12 breadcrumb">
       		<?php generator_entry_meta(); ?>
          <ol>
            <?php the_tags('<li>', '</li><li>', '</li>'); ?>
          </ol>
        </div>
        
        <div class="col-md-12 generator-post-content no-padding">
	     <?php $generator_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
         if($generator_image != "") { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $generator_image; ?>" class="img-responsive generator-featured-image" /></a><?php }
          the_excerpt(); ?>
          <a href="<?php echo get_permalink(); ?>" class="generator-readmore"><button class="blog-readmore-button"><?php _e('READ MORE','generator') ?></button></a>
        </div>
      </div>
      <?php endwhile; ?> 
     
		<!--Pagination Start-->
        <?php   if (function_exists('faster_pagination') ) {
          faster_pagination();
        }else {
        if(get_option('posts_per_page ') < $wp_query->found_posts) { ?>
        <div class="col-md-12 generator-default-pagination">
            <span class="generator-previous-link"><?php previous_posts_link(); ?></span>
            <span class="generator-next-link"><?php next_posts_link(); ?></span>
        </div>
        <?php }
          }//is plugin active ?>
		<!--Pagination End-->

    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>