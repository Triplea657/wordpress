<?php 
/**
 * 404 page template file
**/
get_header(); ?>
<div class="container container-generator">
    <div class="col-md-12 generator-post no-padding">
            <div class="jumbotron">
			    <h1><?php _e('Epic 404 - Article Not Found','generator'); ?></h1>
				<p><?php _e('This is embarrassing. We could not find what you were looking for.','generator'); ?></p>
            <section class="post_content">
              	<p><?php _e('Whatever you were looking for was not found, but maybe try looking again or search using the form below.','generator'); ?></p>
                <div class="row">
                    <div class="col-sm-12">
                    <form action="<?php echo home_url(); ?>/" class="search-form" method="get" role="search">
                    <?php get_search_form(); ?>
                    </form>								
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php get_footer(); ?>