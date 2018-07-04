jQuery(document).ready(function($){

    /** Header Search Toggl **/
    $('.search-icon').click(function(){
        $('.bm-search').slideToggle();
    });

    /** Menu Toggle **/
    $('div#top-toggle').click(function(){
       $('div#top-toggle').toggleClass('on');
       $('#top-site-navigation .menu-main-wrap').slideToggle('slow');
    });

    $('#toggle').click(function(){
       $('#toggle').toggleClass('on');
       $('#site-navigation .menu-main-wrap').slideToggle('slow');
    });
    //Sickey Sidebar
    $('#secondary, #primary').theiaStickySidebar();

    /** Gallery Icon **/
    $('.widget .gallery-icon a').each(function(){
        var imglink  = $(this).children('img').attr('src'); 
        var result = imglink.split('-');
        var count = result.length-1;
        var exclude = result[count].split('.');
        var result_1 = imglink.split('-'+result[count]);
        result_1 = result_1[0]+'.'+exclude[1];
        $(this).attr("href", result_1);
    });
    $(".widget .gallery-icon a").fancybox();

    /** News Slide **/
    $('.owl-carousel.news-slide-wrap').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        autoplay:true,
        items:1,
        navText:['<i class="fa fa-chevron-down" aria-hidden="true"></i>','<i class="fa fa-chevron-up" aria-hidden="true"></i>'],
    });

    /** Main Slider Layout 1 **/
    $('.layout-1 .owl-carousel.slider-all-contents').owlCarousel({
        loop:true,
        margin:5,
        nav:true,
        autoplay:true,
        items:4,
        responsive : {
            320 : {
               items:1,
            },
            480 : {
                items:2,
            },
            676 : {
               items:2,
            },
            768 : {
                items:3,
            },
            1224 : {
                items:4,
            }
        },
        navText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    });

    $('.layout-2 .slider-all-contents, .layout-3 .slider-all-contents').owlCarousel({
        loop:true,
        margin:0,
        nav:false,
        autoplay:false,
        items:1,
        navText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    });

    /** Post Slide **/
    $('.bm-home-sidebar .post-slider-contents').owlCarousel({
        loop:true,
        margin:5,
        nav:true,
        autoplay:true,
        items:3,
        responsive : {
            320 : {
               items:1,
            },
            480 : {
                items:2,
            },
            676 : {
               items:2,
            },
            768 : {
                items:3,
            }
        },
        navText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    });

    /** Post Slide **/
    $('.bm-home-full-width .post-slider-contents').owlCarousel({
        loop:true,
        margin:5,
        nav:true,
        autoplay:true,
        items:4,
        responsive : {
            320 : {
               items:1,
            },
            480 : {
                items:2,
            },
            768 : {
                items:3,
            },
            1024 : {
                items:4,
            }
        },
        navText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    });

    /** Home Category Slide **/
    $('.bm-main-cat-post.layout-2 .bm-loop-cat-post').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        autoplay:false,
        items:1,
        navText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    });

    // Blog Grid
    $('.titles-port').on( 'click', '.filter', function() {
        $('.titles-port .filter').removeClass('active');
        $(this).addClass('active');
        var filterValue = $(this).attr('data-filter');
        $('.loop-grid-posts').hide();
        $('.loop-grid-posts'+filterValue).fadeIn('slow');
    });

    /** Bact To Top **/
    $(window).scroll(function(){
      if($(window).scrollTop() > 300){
          $('#bm-go-top').removeClass('bm-on');
      }else{
          $('#bm-go-top').addClass('bm-on');
      }
    });

    $('#bm-go-top').click(function(){
      $('html,body').animate({scrollTop:0},800);
    });
});
