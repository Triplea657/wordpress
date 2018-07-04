// JavaScript Document
jQuery(document).ready(function(e) {
	jQuery(window).scroll(function(){
	var e=jQuery(window).width();
		if(jQuery(this).scrollTop()>50)
		{	
			jQuery('header .margin-top-bottom-2').css({'margin':'0px 0px'});
		}
		if(jQuery(this).scrollTop()<50)
		{
			jQuery('header .margin-top-bottom-2').css({'margin':'41px 0px 0px 0px'});
		}
		
		if(jQuery(this).scrollTop()>50)
		{	
			jQuery('header .margin-top-bottom-3').css({'margin':'32px 0px'});
		}
		if(jQuery(this).scrollTop()<50)
		{
			jQuery('header .margin-top-bottom-3').css({'margin':'73px 0px 0px 0px'});
		}
	
	});

	 jQuery('#hover-cap-4col .thumbnail').hover(
        function(){
            jQuery(this).find('.caption').slideDown(20); //.fadeIn(250)
        },
        function(){
            jQuery(this).find('.caption').slideUp(20); //.fadeOut(205)
        }
    );    	
 
	var owl = jQuery("#owl-demo");
	 
	owl.owlCarousel({
			itemsCustom : [
			  [0, 1],
			  [450, 2],
			  [600, 2],
			  [700, 2],
			  [1000, 4],
			  [1200, 4],
			  [1400, 4],
			  [1600, 4]
			],
			itemsMobile : true,
			navigation : false,
			autoHeight : false,
	});	
	
	jQuery(function () {

      // Slideshow 4
      jQuery("#slider4").responsiveSlides({
        auto: true,
        pager: false,
        nav: true,
        speed: 500,
        namespace: "callbacks",
      });

    });
});