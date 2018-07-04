<?php 
/**
 * The main template file
**/
get_header(); 
$generator_options = get_option( 'faster_theme_options' );
?>
<div class="generator-single-blog section-main ">
  <div class=" container-generator container homepage-theme-title">
    <h2> <?php if(!empty($generator_options['home-title'])) { echo $generator_options['home-title']; } ?> </h2>
    <h3><?php if(!empty($generator_options['home-content'])) { echo $generator_options['home-content']; } ?></h3>
  </div>
</div>
<div class="container container-generator">
  <div class="col-md-12 generator-post no-padding">
    <div class="col-md-8 no-padding-left">
      <?php 
	  $generator_args = array( 
						'orderby'      => 'post_date', 
						'order'        => 'DESC',
						'post_type'    => 'post',
						'paged' => $paged,
						'post_status'    => 'publish'	
					  );
	$generator_query = new WP_Query($generator_args); ?>
      <?php if ($generator_query->have_posts() ) : while ($generator_query->have_posts()) : $generator_query->the_post(); ?>
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
         if($generator_image != "") { ?><img src="<?php echo $generator_image; ?>" class="img-responsive generator-featured-image" /><?php }
          the_excerpt(); ?>
          <a href="<?php echo get_permalink(); ?>" class="generator-readmore"><button class="blog-readmore-button"><?php _e('READ MORE','generator') ?></button></a>
        </div>
      </div>
     <?php endwhile; endif; // end of the loop. ?>
		  <!--Pagination Start-->
        <?php if (function_exists('faster_pagination') ) {
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