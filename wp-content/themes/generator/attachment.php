<?php 
/**
 * Attechment template file
**/
get_header(); ?>
<div class="generator-single-blog section-main">
  <div class=" container-generator container">
    <h1><?php the_title(); ?></h1>
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
      <div class="col-md-12 no-padding">
        <div class="col-md-10 no-padding">
          <h2 class="generator-head-title"><?php the_title(); ?></h2>
        </div>
        <div class="col-md-2 comments-icon"> 
          <!--<img src="images/comment-icon.png" />--> 
          <i class="fa fa-comments"></i><?php comments_number( '0', '1', '%' ); ?></div>
      </div>
      <div class="col-md-12 breadcrumb">
      	  <?php generator_entry_meta(); ?>
        <ol>
          <?php the_tags('<li>', '</li><li>', '</li>'); ?>
        </ol>
      </div>
      <div class="col-md-12 generator-post-content no-padding">
        <a href="<?php echo wp_get_attachment_url($post->ID); ?>">
							      							      
							      <?php $generator_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); 
								      if ($generator_image) : ?>
								        <img src="<?php echo $generator_image[0]; ?>" alt="" />
								      <?php endif; ?>
							      
							      </a>
      </div>
      <?php endwhile; ?> 
      <div class="col-md-12 generator-post-comment no-padding">
     	 <?php comments_template( '', true ); ?>
      </div>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>