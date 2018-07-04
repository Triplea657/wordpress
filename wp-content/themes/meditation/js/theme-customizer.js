( function( $ ) {
	
	var api = parent.wp.customize;

//range
	wp.customize( 'width_site_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_site', to);
		} );
	} );

//max site width
	wp.customize( 'width_site', function( value ) {
		value.bind( function( to ) {
			$( '.site' ).css('maxWidth', to + 'px');
		} );
	} );
	
//range
	wp.customize( 'width_main_wrapper_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_main_wrapper', to);
		} );
	} );
//max content wrapper width
	wp.customize( 'width_main_wrapper', function( value ) {
		value.bind( function( to ) {
			$( '.main-wrapper, .horisontal-navigation, .sidebar-footer-wrap .sidebar-footer-content, .image-text-wrap' ).css('maxWidth', to + 'px');
		} );
	} );
	
//range
	wp.customize( 'width_image_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_image', to);
		} );
	} );
//max content wrapper width
	wp.customize( 'width_image', function( value ) {
		value.bind( function( to ) {
			$( '.header-wrap' ).css('maxWidth', to + 'px');
		} );
	} );
	
//range
	wp.customize( 'size_image_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('size_image', to);
		} );
	} );
//max content wrapper width
	wp.customize( 'size_image', function( value ) {
		value.bind( function( to ) {
			$( '.image-wrapper' ).css('maxWidth', to + 'px');
		} );
	} );
	
//range
	wp.customize( 'width_top_widget_area_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_top_widget_area', to);
		} );
	} );
//max top, footer wrapper width
	wp.customize( 'width_top_widget_area', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-before-footer .widget > div' ).css('maxWidth', to + 'px');
			$( '.sidebar-before-footer .widget-area .widget > ul' ).css('maxWidth', to + 'px');
			$( '.sidebar-top-full .widget-area .widget > div' ).css('maxWidth', to + 'px');
			$( '.sidebar-top-full .widget-area .widget > ul' ).css('maxWidth', to + 'px');
		} );
	} );
	
//range
	wp.customize( 'width_top_title_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_top_title', to);
		} );
	} );
//max top and footer sidebars widget title width
	wp.customize( 'width_top_title', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-top-full .widgettitle' ).css('maxWidth', to + 'px');
			$( '.sidebar-top-full .widget-title' ).css('maxWidth', to + 'px');
			$( '.sidebar-before-footer .widgettitle' ).css('maxWidth', to + 'px');
			$( '.sidebar-before-footer .widget-title' ).css('maxWidth', to + 'px');
		} );
	} );
	
//range
	wp.customize( 'width_column_1_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_column_1', to);
		} );
	} );
//first column width
	wp.customize( 'width_column_1', function( value ) {
		value.bind( function( to ) {
			$( '.two-sidebars .sidebar-1' ).css('flex-basis', to + 'px');
		} );
	} );
	
//range %
	wp.customize( 'width_column_1_range_rate', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_column_1_rate', to);
		} );
	} );
//first column width %
	wp.customize( 'width_column_1_rate', function( value ) {
		value.bind( function( to ) {
			$( '.two-sidebars .sidebar-1' ).css('width', to + '%');
			$( '.two-sidebars .site-content' ).css('width', ( 100 - to - GetControlVal('width_column_2_rate') ) + '%');
		} );
	} );
	
//range px
	wp.customize( 'width_column_2_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_column_2', to);
		} );
	} );
//second column width px
	wp.customize( 'width_column_2', function( value ) {
		value.bind( function( to ) {
			$( '.two-sidebars .sidebar-2' ).css('flex-basis', to + 'px');
		} );
	} );
	
//range %
	wp.customize( 'width_column_2_range_rate', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_column_2_rate', to);
		} );
	} );
//second column width %
	wp.customize( 'width_column_2_rate', function( value ) {
		value.bind( function( to ) {
			$( '.two-sidebars .sidebar-2' ).css('width', to + '%');
			$( '.two-sidebars .site-content' ).css('width', ( 100 - to - GetControlVal('width_column_1_rate') ) + '%');
		} );
	} );
	
//right column range px
	wp.customize( 'width_column_1_right_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_column_1_right', to);
		} );
	} );
//right column width px
	wp.customize( 'width_column_1_right', function( value ) {
		value.bind( function( to ) {
			$( '.right-sidebar .sidebar-2' ).css('flex-basis', to + 'px');
		} );
	} );
	
//range %
	wp.customize( 'width_column_1_right_range_rate', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_column_1_right_rate', to);
		} );
	} );
//right column width %
	wp.customize( 'width_column_1_right_rate', function( value ) {
		value.bind( function( to ) {
			$( '.right-sidebar .sidebar-2' ).css('width', to + '%');
			$( '.right-sidebar .site-content' ).css('width', ( 100 - to ) + '%');
		} );
	} );
	
//left column range px
	wp.customize( 'width_column_1_left_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_column_1_left', to);
		} );
	} );
//left column width px
	wp.customize( 'width_column_1_left', function( value ) {
		value.bind( function( to ) {
			$( '.left-sidebar .sidebar-1' ).css('flex-basis', to + 'px');
		} );
	} );
	
//range %
	wp.customize( 'width_column_1_left_range_rate', function( value ) {
		value.bind( function( to ) {
			SetControlVal('width_column_1_left_rate', to);
		} );
	} );
//left column width %
	wp.customize( 'width_column_1_left_rate', function( value ) {
		value.bind( function( to ) {
			$( '.left-sidebar .sidebar-1' ).css('width', to + '%');
			$( '.left-sidebar .site-content' ).css('width', ( 100 - to ) + '%');
		} );
	} );

// Site title and description.	
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
			$( '.wide .column-1 .element.effect-17 .entry-title' ).text( to );
			$( '.wide .column-1 .element.effect-18 .entry-title' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description h2' ).text( to );
			$( '.wide .column-1 .element.effect-17 p' ).text( to );
			$( '.wide .column-1 .element.effect-18 p' ).text( to );
		} );
	} );

//Animation Header
	wp.customize( 'header_effect_class', function( value ) {
		value.bind( function( to ) {
			for( i = 0; i <= 15; i++ )
				$( 'body' ).removeClass( 'header-effect-' + i);
			$('body').addClass('header-effect-' + to).addClass('animate-on-load');
			setTimeout( function() {
				$('body').removeClass( 'animate-on-load' );
			}, 10 );
		} );
	} );
	wp.customize( 'is_restart_blog', function( value ) {
		value.bind( function( to ) {
			if ( to == 1 )
				$('body').addClass('restart-blog');
			else
				$('body').removeClass('restart-blog');
		} );
	} );
//Animation Blog
	wp.customize( 'blog_effect_class', function( value ) {
		value.bind( function( to ) {
			for( i = 0; i <= 15; i++ )
				$( 'body' ).removeClass( 'blog-effect-' + i);
			$('body').addClass('blog-effect-' + to);
			$( '.flex-container' ).addClass( 'animate-block' ).removeClass( 'start-animation' );
			setTimeout( function() {
				$( '.flex-container' ).removeClass( 'animate-block' ).addClass( 'start-animation' );
			}, 10 );
		} );
	} );
	wp.customize( 'is_restart_header', function( value ) {
		value.bind( function( to ) {
			if ( to == 1 )
				$('body').addClass('restart-header');
			else
				$('body').removeClass('restart-header');
		} );
	} );
//Animation Sidebar
	wp.customize( 'sidebar_effect_class', function( value ) {
		value.bind( function( to ) {
			for( i = 0; i <= 15; i++ )
				$( 'body' ).removeClass( 'sidebar-effect-' + i);
			$('body').addClass('sidebar-effect-' + to);
			$( '.widget' ).addClass( 'animate-widget' ).removeClass( 'start-widget' );
			setTimeout( function() {
				$( '.widget' ).removeClass( 'animate-widget' ).addClass( 'start-widget' );
			}, 10 );
		} );
	} );
	wp.customize( 'is_restart_sidebar', function( value ) {
		value.bind( function( to ) {
			if ( to == 1 )
				$('body').addClass('restart-sidebar');
			else
				$('body').removeClass('restart-sidebar');
		} );
	} );
	
//Fonts
	wp.customize( 'font_1_select', function( value ) {
		value.bind( function( to ) {
			if('0'==to) to = '';
			SetControlVal('font_1', to);
		} );
	} );
	
	wp.customize( 'font_2_select', function( value ) {
		value.bind( function( to ) {
			if('0'==to) to = '';
			SetControlVal('font_2', to);
		} );
	} );
	
	wp.customize( 'font_3_select', function( value ) {
		value.bind( function( to ) {
			if('0'==to) to = '';
			SetControlVal('font_3', to);
		} );
	} );
	
	wp.customize( 'site_font', function( value ) {
		value.bind( function( to ) {
			switchFont( '.site', to );
		} );
	} );
	
	wp.customize( 'header_font', function( value ) {
		value.bind( function( to ) {
			switchFont( '.site-title h1 a', to );
		} );
	} );
	
	wp.customize( 'description_font', function( value ) {
		value.bind( function( to ) {
			switchFont( '.site-description h2', to );
		} );
	} );
	
	wp.customize( 'menu_font', function( value ) {
		value.bind( function( to ) {
			switchFont( '.menu-1 > div > ul > li, .menu-1 > div > ul > li > a', to );
		} );
	} );	
	
	wp.customize( 'submenu_font', function( value ) {
		value.bind( function( to ) {
			switchFont( '.menu-1 ul li ul, .menu-1 ul li ul a', to );
		} );
	} );
	
	wp.customize( 'title_font', function( value ) {
		value.bind( function( to ) {
			switchFont( '.entry-header h1, .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6', to );
			switchFont( '.entry-header h1 a, .entry-content h1 a, .entry-content h2 a, .entry-content h3 a, .entry-content h4 a, .entry-content h5 a, .entry-content h6 a', to );
		} );
	} );
	
	wp.customize( 'link_font', function( value ) {
		value.bind( function( to ) {
			switchFont( '.entry-content a', to );
		} );
	} );
	
	wp.customize( 'cat_font', function( value ) {
		value.bind( function( to ) {
			switchFont( '.content .post-categories a, .content .post-tags a', to );
		} );
	} );
	
	wp.customize( 'meta_font', function( value ) {
		value.bind( function( to ) {
			switchFont( '.content .entry-meta a', to );
		} );
	} );
	
	wp.customize( 'w_font', function( value ) {
		value.bind( function( to ) {
			switchFont( '.widget-area .widget', to );
		} );
	} );
	
	wp.customize( 'w_title_font', function( value ) {
		value.bind( function( to ) {
			switchFont( '.widget-area .widget .widget-title, .widget-area .widget .widgettitle', to );
		} );
	} );
	
	wp.customize( 'w_link_font', function( value ) {
		value.bind( function( to ) {
			switchFont( '.widget-area .widget a', to );
		} );
	} );
	
	function switchFont( css, to ) {
		for( i = 1; i <= 3; i++ ) 
			$( css ).removeClass( 'font-' + i);
		if( 0 == to ) return;
		$( css ).addClass( 'font-' + to);
	}
	
	function SetControlVal(name, newVal) {
	    var control = api.control(name); 
		if( control ){
			control.setting.set( newVal );
		}
		return;
	}	
	function GetControlVal(name) {
	    var control = api.control(name); 
		var rez = '';
		if( control ){
			rez = control.setting.get();
		}
		return rez;
	}	
	function hideControl(cname) {
	    var control = api.control(cname); 
		if(control){
			control.container.toggle( 0 );
		}
	}
	function showControl(cname) {
	    var control = api.control(cname); 
		if(control){
			control.container.toggle( 1 );
		}
	}
	function removeHeader(name) {
		var control = api.control(name);
		if( control ) {
			control.removeImage();
		}
	}
	function SetHeader(name, newImage, height, width) {
		var control = api.control(name);
		if( control ) {
			var choice, data = {};
			data.url = newImage;
			data.attachment_id = 0;
			data.thumbnail_url = newImage;
			data.timestamp = _.now();
			if (width) {
				data.width = width;
			}
			if (height) {
				data.height = height;
			}
			choice = new api.HeaderTool.ImageModel({
				header: data,
				choice: newImage.split('/').pop()
			});
			api.HeaderTool.currentHeader.set(choice.toJSON());
			choice.save();
		}
		return;
	}
	
} )( jQuery );