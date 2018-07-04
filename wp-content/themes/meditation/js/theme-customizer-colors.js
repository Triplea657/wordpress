( function( $ ) {
	
	var api = parent.wp.customize;
	
//description
	wp.customize( 'description_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-description h2' ).css( 'color', to);	
		} );
	} );
	
//desctiption background
	wp.customize( 'site_description_back', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).css( 'background-color', to_rgba(to,  GetControlVal('site_description_back_opacity') ));
		} );
	} );
	
	wp.customize( 'site_description_back_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).css( 'background-color', to_rgba(GetControlVal('site_description_back'), to));
		} );
	} );
	
	wp.customize( 'site_description_back_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('site_description_back_opacity', parseInt(to)/10);
		} );
	} );

//header text background
	wp.customize( 'site_name_back', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).css( 'background-color', to_rgba(to,  GetControlVal('site_name_back_opacity') ));
		} );
	} );
	
	wp.customize( 'site_name_back_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).css( 'background-color', to_rgba(GetControlVal('site_name_back'), to));
		} );
	} );
	
	wp.customize( 'site_name_back_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('site_name_back_opacity', parseInt(to)/10);
		} );
	} );
	
	// Header text color
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );	
				$( '.site-title, .site-title a' ).css( {
					'color': to,
				} );
			}
		} );
	} );
	
//link
	wp.customize( 'link_color', function( value ) {
		value.bind( function( to ) {
			$( '.entry-content a, .comments-link a, .featured-post, .logged-in-as a, .post-date a, .edit-link a' ).css( 'color', to);	
			$( '.tags a, .post-date, .flex .content-container' ).css( 'border-color', to );
		} );
	} );
	
//heading link
	wp.customize( 'heading_link', function( value ) {
		value.bind( function( to ) {
			$( '.entry-header .entry-title a' ).css( 'color', to);
		} );
	} );
	
//headers
	wp.customize( 'heading_color', function( value ) {
		value.bind( function( to ) {
			$( '.widget h1, .content h1, .content h2, .content h3, .content h4, .content h5, .content h6' ).css( 'color', to);
			$( '.category-list a, .pagination .page-numbers.current, .nav-link a' ).css( 'background', to);
			$( '.site' ).addClass( 'hideSelectors' );
		} );
	} );

//box shadow
	wp.customize( 'box_shadow', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-toggle,.menu-toggle,.flex .content-container,.comment-list .comment-meta,.widgettitle,.widget-title,.menu-top,.menu-top ul ul' ).css( 'box-shadow', '5px 1px 10px ' + to_rgba(to, GetControlVal('box_shadow_opacity') ));
		} );
	} );
	
	wp.customize( 'box_shadow_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-toggle,.menu-toggle,.flex .content-container,.comment-list .comment-meta,.widgettitle,.widget-title,.menu-top,.menu-top ul ul' ).css( 'box-shadow', '5px 1px 10px ' + to_rgba(GetControlVal('box_shadow'), to));
		} );
	} );
	
	wp.customize( 'box_shadow_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('box_shadow_opacity', parseInt(to)/10);
		} );
	} );	

//widget buttons 

//background
	wp.customize( 'buttons_color', function( value ) {
		value.bind( function( to ) {
			$( '.widget.meditation_widget_button' ).css( 'background-color', to_rgba(to, GetControlVal('buttons_color_opacity') ));
		} );
	} );

	wp.customize( 'buttons_color_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.widget.meditation_widget_button' ).css( 'background-color', to_rgba(GetControlVal('buttons_color'), to));
		} );
	} );
	
	wp.customize( 'buttons_color_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('buttons_color_opacity', parseInt(to)/10);
		} );
	} );		
//button
	wp.customize( 'buttons_button', function( value ) {
		value.bind( function( to ) {
			$( '.widget.meditation_widget_button .meditation-link' ).css( 'background-color', to_rgba(to, GetControlVal('buttons_button_opacity') ));
		} );
	} );

	wp.customize( 'buttons_button_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.widget.meditation_widget_button .meditation-link' ).css( 'background-color', to_rgba(GetControlVal('buttons_button'), to));
		} );
	} );
	
	wp.customize( 'buttons_button_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('buttons_button_opacity', parseInt(to)/10);
		} );
	} );
//link
	wp.customize( 'buttons_link', function( value ) {
		value.bind( function( to ) {
			$( '.widget.meditation_widget_button a' ).css( 'color', to);
		} );
	} );
	

//border
	wp.customize( 'buttons_border', function( value ) {
		value.bind( function( to ) {
			$( '.widget.meditation_widget_button .meditation-link' ).css( 'border-color', to_rgba(to,  GetControlVal('buttons_border_opacity') ));
		} );
	} );

	wp.customize( 'buttons_border_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.widget.meditation_widget_button .meditation-link' ).css( 'border-color', to_rgba(GetControlVal('buttons_border'), to));
		} );
	} );
	
	wp.customize( 'buttons_border_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('buttons_border_opacity', parseInt(to)/10);
		} );
	} );
	
//content
	wp.customize( 'content_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-content, .comment-list .comment-meta' ).css( 'background-color',  to_rgba(to,  GetControlVal('content_color_opacity') ) );
			$( '.category-list a, .pagination .page-numbers.current, .nav-link a' ).css( 'color', to);
			$( '.site' ).addClass( 'hideSelectors' );
		} );
	} );

	wp.customize( 'content_color_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.site-content, .comment-list .comment-meta' ).css( 'background-color', to_rgba(GetControlVal('content_color'), to));
			$( '.category-list a, .pagination .page-numbers.current, .nav-link a' ).css( 'color', to);
		} );
	} );
	
	wp.customize( 'content_color_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('content_color_opacity', parseInt(to)/10);
		} );
	} );
	
//column-content back
	wp.customize( 'sidebar_content_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-area' ).css( 'background-color', to_rgba(to,  GetControlVal('sidebar_content_color_opacity') ) );
		} );
	} );
	
	wp.customize( 'sidebar_content_color_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.main-area' ).css( 'background-color', to_rgba(GetControlVal('sidebar_content_color'), to));
		} );
	} );
	
	wp.customize( 'sidebar_content_color_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('sidebar_content_color_opacity', parseInt(to)/10);
		} );
	} );
	
//blog-content back
	wp.customize( 'blog_content_color', function( value ) {
		value.bind( function( to ) {
			$( '.flex .content-container' ).css( 'background-color', to_rgba(to,  GetControlVal('blog_content_color_opacity') ) );
			$( '.site' ).addClass( 'hideSelectors' );
		} );
	} );
	
	wp.customize( 'blog_content_color_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.flex .content-container' ).css( 'background-color', to_rgba(GetControlVal('blog_content_color'), to));
			$( '.site' ).addClass( 'hideSelectors' );
		} );
	} );
	
	wp.customize( 'blog_content_color_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('blog_content_color_opacity', parseInt(to)/10);
		} );
	} );
	
//text		
	wp.customize( 'content_text', function( value ) {
		value.bind( function( to ) {
			$( '.flex .content-container, #woocommerce-wrapper, .header-wrapper, .nothing-found, .archive-header, .content-footer,.comments-area, .nav-link, .pagination.loop-pagination, .content-container, comment-metadata a' ).css( 'color', to );
		} );
	} );	
	
//menu background		
	wp.customize( 'menu1_color', function( value ) {
		value.bind( function( to ) {
			$( '.top-1-navigation' ).css( 'background-color', to_rgba(to, GetControlVal('menu1_color_opacity')));
			$( '.site' ).addClass( 'hideSelectors' );
		} );
	} );	
	
	wp.customize( 'menu1_color_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.top-1-navigation' ).css( 'background-color', to_rgba(GetControlVal('menu1_color'), to));
		} );
	} );
	wp.customize( 'menu1_color_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('menu1_color_opacity', parseInt(to)/10);
		} );
	} );
	
	wp.customize( 'menu1_link', function( value ) {
		value.bind( function( to ) {
			$( '.top-1-navigation a' ).css( 'color', to);
		} );
	} );	

//menu (top) background		
	wp.customize( 'menu2_color', function( value ) {
		value.bind( function( to ) {
			$( '.top-navigation' ).css( 'background', to_rgba(to, GetControlVal('menu2_color_opacity')));
		} );
	} );	
	
	wp.customize( 'menu2_color_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.top-navigation' ).css( 'background-color', to_rgba(GetControlVal('menu2_color'), to));
		} );
	} );
	wp.customize( 'menu2_color_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('menu2_color_opacity', parseInt(to)/10);
		} );
	} );
	
	wp.customize( 'menu2_link', function( value ) {
		value.bind( function( to ) {
			$( '.top-navigation a' ).css( 'color', to);
		} );
	} );	
	
//menu background		
	wp.customize( 'menu3_color', function( value ) {
		value.bind( function( to ) {
			$( '#footer-navigation' ).css( 'background-color', to_rgba(to, GetControlVal('menu3_color_opacity')));
		} );
	} );	
	
	wp.customize( 'menu3_color_opacity', function( value ) {
		value.bind( function( to ) {
			$( '#footer-navigation' ).css( 'background-color', to_rgba(GetControlVal('menu3_color'), to));
		} );
	} );
	wp.customize( 'menu3_color_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('menu3_color_opacity', parseInt(to)/10);
		} );
	} );
	
	wp.customize( 'menu3_link', function( value ) {
		value.bind( function( to ) {
			$( '#footer-navigation a' ).css( 'color', to);
		} );
	} );

//footer sidebar background		
	wp.customize( 'sidebar2_color', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-footer-wrap' ).css( 'background-color', to_rgba(to, GetControlVal('sidebar2_color_opacity')));
			$( '.site' ).addClass( 'hideSelectors' );
		} );
	} );
	wp.customize( 'sidebar2_color_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-footer-wrap' ).css( 'background-color', to_rgba(GetControlVal('sidebar2_color'), to));
		} );
	} );
	
	wp.customize( 'sidebar2_color_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('sidebar2_color_opacity', parseInt(to)/10);
		} );
	} );

//footer sidebar text
	wp.customize( 'sidebar2_text', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-footer .widget' ).css( 'color', to);
		} );
	} );
	
//footer sidebar link
	wp.customize( 'sidebar2_link', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-footer  .widget a' ).css( 'color', to);
		} );
	} );
	
//footer header background color
	wp.customize( 'sidebar2_header_color', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-footer .widgettitle,.sidebar-footer .widget-title' ).css( 'background-color', to_rgba(to, GetControlVal('sidebar2_header_color_opacity')));
			$( '.sidebar-footer .widgettitle,.sidebar-footer .widget-title' ).css( 'border-color', to );
			$( '.site' ).addClass( 'hideSelectors' );
		} );
	} );

	wp.customize( 'sidebar2_header_color_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-footer .widgettitle,.sidebar-footer .widget-title' ).css( 'background-color', to_rgba(GetControlVal('sidebar2_header_color'), to));
			$( '.site' ).addClass( 'hideSelectors' );	
		} );
	} );
	
	wp.customize( 'sidebar2_header_color_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('sidebar2_header_color_opacity', parseInt(to)/10);
		} );
	} );
	
//footer header text color
	wp.customize( 'sidebar2_header_text', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-footer .widgettitle, .sidebar-footer .widget-title' ).css( 'color', to);
		} );
	} );
	
//footer widget title border
	wp.customize( 'sidebar2_border', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-footer .widgettitle, .sidebar-footer .widget-title' ).css( 'border-color', to);

		} );
	} );

//column

//background		
	wp.customize( 'sidebar3_color', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-1, .sidebar-2, .comment-body' ).css( 'background-color', to_rgba(to, GetControlVal('sidebar3_color_opacity')));
			$( '.site' ).addClass( 'hideSelectors' );
		} );
	} );
	
	wp.customize( 'sidebar3_color_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-1, .sidebar-2, .comment-body' ).css( 'background-color', to_rgba(GetControlVal('sidebar3_color'), to));
		} );
	} );
	
	wp.customize( 'sidebar3_color_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('sidebar3_color_opacity', parseInt(to)/10);
		} );
	} );
	
//border
	wp.customize( 'column_main_border', function( value ) {
		value.bind( function( to ) {
			$( '.sidebar-1, .sidebar-2' ).css( 'border-color', to );
		} );
	} );
	
//text
	wp.customize( 'sidebar3_text', function( value ) {
		value.bind( function( to ) {
			$( '.column  .widget, .comment-body' ).css( 'color', to);
		} );
	} );
	
//link
	wp.customize( 'sidebar3_link', function( value ) {
		value.bind( function( to ) {
			$( '.column .widget a, .comment-body a' ).css( 'color', to);
		} );
	} );
	
//border
	wp.customize( 'column_border', function( value ) {
		value.bind( function( to ) {
			$( '.column .widgettitle, .column .widget-title' ).css( 'border-color', to);
		} );
	} );
	
//column header background color
	wp.customize( 'column_header_color', function( value ) {
		value.bind( function( to ) {
			$( '.column .widget .widgettitle' ).css( 'background-color', to_rgba(to, GetControlVal('column_header_color_opacity')));
			$( '.column .widget .widget-title' ).css( 'background-color', to_rgba(to, GetControlVal('column_header_color_opacity')));
		} );
	} );
	wp.customize( 'column_header_color_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.column .widget .widgettitle' ).css( 'background-color', to_rgba(GetControlVal('column_header_color'), to));
			$( '.column .widget .widget-title' ).css( 'background-color', to_rgba(GetControlVal('column_header_color'), to));
		} );
	} );
	
	wp.customize( 'column_header_color_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('column_header_color_opacity', parseInt(to)/10);
		} );
	} );
	
//column header text color
	wp.customize( 'column_header_text', function( value ) {
		value.bind( function( to ) {
			$( '.column .widget .widgettitle' ).css( 'color', to);
			$( '.column .widget .widget-title' ).css( 'color', to);
		} );
	} );
	
	wp.customize( 'column_widget_back', function( value ) {
		value.bind( function( to ) {
			$( '.column .widget' ).css( 'background-color', to_rgba(to, GetControlVal('column_widget_back_opacity')));
		} );
	} );
	
	wp.customize( 'column_widget_back_opacity', function( value ) {
		value.bind( function( to ) {
			$( '.column .widget' ).css( 'background-color', to_rgba(GetControlVal('column_widget_back'), to));
		} );
	} );
	
	wp.customize( 'column_widget_back_opacity_range', function( value ) {
		value.bind( function( to ) {
			SetControlVal('column_widget_back_opacity', parseInt(to)/10);
		} );
	} );
	
		
//column widget border
	wp.customize( 'border_color', function( value ) {
		value.bind( function( to ) {
			$( '.column .widget' ).css( 'border-color', to);
		} );
	} );
		
	function SetColor(cname, newColor) {
		//update colors in picker
	    var control = api.control(cname); 
		if(control){
			control.setting.set(newColor);	
			picker = control.container.find('.color-picker-hex');
			if(picker)
				if(newColor == '')
					picker.val( control.setting() ).wpColorPicker().trigger( 'clear' );
				else
					picker.val( control.setting() ).wpColorPicker().trigger( 'change' );
		}
		return;
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
	
	function to_rgba( color, opacity) {
		var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
		+ ',' + parseInt(color.slice(-4,-2),16)
		+ ',' + parseInt(color.slice(-2),16)
		+',' + opacity+')';
		return rgbaCol;
	}	
	
} )( jQuery );