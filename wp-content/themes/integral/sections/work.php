<?php
/**
 * Work Section for our theme
 *
 * @package WordPress
 * @subpackage Integral
 * @since Integral 1.0
 */
?>
<?php global $integral; ?>
<?php if($integral['work-section-toggle']==1) { ?>
<section id="work" class="work lite <?php echo $integral['work-custom-class']; ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-12 heading">
				<?php if ($integral['work-title-icon']) { ?><i class="fa <?php echo $integral['work-title-icon']; ?>"></i><?php } ?>
                <?php if ($integral['work-title']) { ?><h2 class="bigtitle"><span><?php echo $integral['work-title']; ?></span></h2><?php } ?>
                <?php if ($integral['work-subtitle']) { ?><p class="subtitle"><?php echo $integral['work-subtitle']; ?></p><?php } ?>
			</div>
			<div class="col-md-12">
                <?php
                    $my_id = $integral['work-text'];
                    $post_id = get_post($my_id);
                    $content = $post_id->post_content;
                    $content = apply_filters('the_content', $content);
                    $content = str_replace(']]>', ']]>', $content);
                    echo $content;
                ?>
			</div><!--feature-->
		</div>
	</div>
</section><!--work-->
<?php } ?>