<?php $generator_options = get_option( 'faster_theme_options' ); ?>
<div class="col-md-12 generator-post no-padding">
<?php for($generator_section_i=1; $generator_section_i <=4 ;$generator_section_i++ ): 
	if(empty($generator_options['home-icon-'.$generator_section_i]) && empty($generator_options['section-title-'.$generator_section_i]) && empty($generator_options['section-content-'.$generator_section_i])) { continue; }	?>
<div class="col-md-3 generator-sidebar">
<aside class="sidebar-widget widget widget_generator_widget" id="generator_widget-3">
<?php if(!empty($generator_options['home-icon-'.$generator_section_i])) { ?>
<div class="font-icon-size ">
        <img class="fa icon-center" src="<?php echo $generator_options['home-icon-'.$generator_section_i]; ?>"> 
</div>
<?php } ?>
    <h3 class="theme-title-14"><?php if(!empty($generator_options['section-title-'.$generator_section_i])) { echo $generator_options['section-title-'.$generator_section_i]; } ?></h3>       
    <p class="theme-text"><?php if(!empty($generator_options['section-content-'.$generator_section_i])) { echo $generator_options['section-content-'.$generator_section_i]; } ?></p>      
</aside>
<div class="clearfix"></div>
</div>
<?php endfor; ?>
</div>