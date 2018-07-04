<?php
/**
 * Class to add custom colors controls
 *
 * @since Meditation 1.0.0
 */

class meditation_Colors_Class {

	private $colors = array();
	private $sections = array();
	private $color_schemes = array();
	private $color_scheme = null;
	private $is_use_default_colors = false;
	
	function __construct() {
		$defaults = meditation_get_defaults();
	 
		$this->color_scheme = meditation_get_theme_mod( 'color_scheme' );
				
		$this->add_scheme(0, __('Red and White', 'meditation'));
		$this->add_scheme(1, __('Blue and White', 'meditation'));
		$this->add_scheme(2, __('Orange and Green', 'meditation'));
		$this->add_scheme(3, __('Orange and Blue', 'meditation'));
		$this->add_scheme(4, __('Black and Red', 'meditation'));
		$this->add_scheme(5, __('Black and Green', 'meditation'));
		$this->add_scheme(6, __('Red and Yellow', 'meditation'));
		$this->add_scheme(7, __('Red and Dark Content', 'meditation'));
		$this->add_scheme(8, __('Black Content', 'meditation'));
		$this->add_scheme(9, __('Orange Content', 'meditation'));
		$this->add_scheme(10, __('Brown and Orange', 'meditation'));
		$this->add_scheme(11, __('Gray and White', 'meditation'));
		$this->add_scheme(12, __('Gray Content', 'meditation'));
		$this->add_scheme(13, __('Blue and Magenta', 'meditation'));
		$this->add_scheme(14, __('Dark Blue and White', 'meditation'));
		
		$section_id = 'main_colors';
		$section_priority = 10;
		$p = 10;
		
		$this->add_section($section_id, __('Main Colors', 'meditation'), __('Main website colors', 'meditation'), $section_priority++);

	/* colors */
	
		$i = 'site_name_back';
		
		$this->add_color($i, $section_id, __('Header Background', 'meditation'), $p++, true);
		$this->set_color($i, 0, '#1e73be', 0);
		$this->set_color($i, 1, '#ffffff', 1);
		$this->set_color($i, 2, '#ffffff', 0);
		$this->set_color($i, 3, '#ffffff', 1);
		$this->set_color($i, 4, '#ffffff', 1);
		$this->set_color($i, 5, '#335b0c', 1);
		$this->set_color($i, 6, '#ffffff', 0);
		$this->set_color($i, 7, '#ffffff', 0);
		$this->set_color($i, 8, '#ffffff', 1);
		$this->set_color($i, 9, '#dd9933', 1);
		$this->set_color($i, 10, '#dd9933', 1);
		$this->set_color($i, 11, '#ffffff', 1);
		$this->set_color($i, 12, '#ffffff', 1);
		$this->set_color($i, 13, '#ffffff', 1);
		$this->set_color($i, 14, '#ffffff', 1);
		
		$i = 'description_color';
		
		$this->add_color($i, $section_id, __('Description', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#ffffff');	
		$this->set_color($i, 1, '#ffffff');
		$this->set_color($i, 2, '#ffffff');		
		$this->set_color($i, 3, '#ffffff');		
		$this->set_color($i, 4, '#ffffff');		
		$this->set_color($i, 5, '#ffffff');		
		$this->set_color($i, 6, '#ffffff');		
		$this->set_color($i, 7, '#ffffff');		
		$this->set_color($i, 8, '#ffffff');		
		$this->set_color($i, 9, '#dd9933');		
		$this->set_color($i, 10, '#dd9933');		
		$this->set_color($i, 11, '#ffffff');		
		$this->set_color($i, 12, '#ffffff');		
		$this->set_color($i, 13, '#ffffff');		
		$this->set_color($i, 14, '#ffffff');		
		
		$i = 'site_description_back';
		
		$this->add_color($i, $section_id, __('Description Background', 'meditation'), $p++, true);
		$this->set_color($i, 0, '#dd3333', 1);
		$this->set_color($i, 1, '#dd3333', 1);
		$this->set_color($i, 2, '#ffffff', 0);
		$this->set_color($i, 3, '#ffffff', 0);
		$this->set_color($i, 4, '#ffffff', 0);
		$this->set_color($i, 5, '#ffffff', 0);
		$this->set_color($i, 6, '#ffffff', 0);
		$this->set_color($i, 7, '#ffffff', 0);
		$this->set_color($i, 8, '#000000', 1);
		$this->set_color($i, 9, '#000000', 1);
		$this->set_color($i, 10, '#ffffff', 1);
		$this->set_color($i, 11, '#ffffff', 0);
		$this->set_color($i, 12, '#ffffff', 0);
		$this->set_color($i, 13, '#25bae8', 0.7);
		$this->set_color($i, 14, '#1e73be', 0.7);
		
		$i = 'link_color';
		
		$this->add_color($i, $section_id, __('Link', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#dd3333');
		$this->set_color($i, 1, '#1e73be');
		$this->set_color($i, 2, '#1b5613');
		$this->set_color($i, 3, '#dd9933');
		$this->set_color($i, 4, '#dd3333');
		$this->set_color($i, 5, '#dd3333');
		$this->set_color($i, 6, '#dd3333');
		$this->set_color($i, 7, '#eeee22');
		$this->set_color($i, 8, '#dd3333');
		$this->set_color($i, 9, '#000000');
		$this->set_color($i, 10, '#4c1903');
		$this->set_color($i, 11, '#4c4c4c');
		$this->set_color($i, 12, '#4c4c4c');
		$this->set_color($i, 13, '#e22fbc');
		$this->set_color($i, 14, '#24147f');

		$i = 'hover_color';
		
		$this->add_color($i, $section_id, __('Link Hover', 'meditation'), $p++, false, 'refresh');
		$this->set_color($i, 0, '#dd9933');
		$this->set_color($i, 1, '#dd3333');
		$this->set_color($i, 2, '#dd9933');
		$this->set_color($i, 3, '#1e73be');
		$this->set_color($i, 4, '#000000');
		$this->set_color($i, 5, '#000000');
		$this->set_color($i, 6, '#000000');
		$this->set_color($i, 7, '#ffffff');
		$this->set_color($i, 8, '#ffffff');
		$this->set_color($i, 9, '#ffffff');
		$this->set_color($i, 10, '#ffffff');
		$this->set_color($i, 11, '#000000');
		$this->set_color($i, 12, '#000000');
		$this->set_color($i, 13, '#25bae8');
		$this->set_color($i, 14, '#000000');
		
		$i = 'heading_color';
		
		$this->add_color($i, $section_id, __('H1-H6 heading', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#1e73be');
		$this->set_color($i, 1, '#1e73be');
		$this->set_color($i, 2, '#000000');
		$this->set_color($i, 3, '#000000');
		$this->set_color($i, 4, '#000000');
		$this->set_color($i, 5, '#000000');
		$this->set_color($i, 6, '#000000');
		$this->set_color($i, 7, '#ffffff');
		$this->set_color($i, 8, '#ffffff');
		$this->set_color($i, 9, '#ffffff');
		$this->set_color($i, 10, '#4c1903');
		$this->set_color($i, 11, '#3d3d3d');
		$this->set_color($i, 12, '#878787');
		$this->set_color($i, 13, '#25bae8');
		$this->set_color($i, 14, '#000000');
		
		$i = 'heading_link';
		
		$this->add_color($i, $section_id, __('H1-H6 Link', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#dd3333');	
		$this->set_color($i, 1, '#1e73be');	
		$this->set_color($i, 2, '#1b5613');
		$this->set_color($i, 3, '#dd9933');
		$this->set_color($i, 4, '#dd3333');
		$this->set_color($i, 5, '#dd3333');
		$this->set_color($i, 6, '#dd3333');
		$this->set_color($i, 7, '#eeee22');
		$this->set_color($i, 8, '#dd3333');
		$this->set_color($i, 9, '#ffffff');
		$this->set_color($i, 10, '#4c1903');
		$this->set_color($i, 11, '#4c4c4c');
		$this->set_color($i, 12, '#4c4c4c');
		$this->set_color($i, 13, '#e22fbc');
		$this->set_color($i, 14, '#24147f');
			
		$i = 'box_shadow';
		
		$this->add_color($i, $section_id, __('Shadow color', 'meditation'), $p++, true);
		$this->set_color($i, 0, '#000000', '0');
		$this->set_color($i, 1, '#a5a5a5', '0.5');
		$this->set_color($i, 2, '#000000', '0');
		$this->set_color($i, 3, '#000000', '0.3');
		$this->set_color($i, 4, '#000000', '0');
		$this->set_color($i, 5, '#000000', '0');
		$this->set_color($i, 6, '#000000', '0.3');
		$this->set_color($i, 7, '#000000', '0.5');
		$this->set_color($i, 8, '#000000', '0.5');
		$this->set_color($i, 9, '#000000', '0.5');
		$this->set_color($i, 10, '#000000', '0');
		$this->set_color($i, 11, '#a5a5a5', '0.4');
		$this->set_color($i, 12, '#a5a5a5', '0.4');
		$this->set_color($i, 13, '#25bae8', '0.4');
		$this->set_color($i, 14, '#000000', '0.4');
		
	//section menu 
		$section_id = 'menu_1_colors';
		$p = 0;
		
		$this->add_section($section_id, __('Menu', 'meditation'), __('Menu Colors', 'meditation'), $section_priority++);
		
		$i = 'menu1_color';
		
		$this->add_color($i, $section_id, __('Menu', 'meditation'), $p+=2, true);
		$this->set_color($i, 0, '#ffffff', 1);
		$this->set_color($i, 1, '#1e73be', 1);
		$this->set_color($i, 2, '#25751a', 1);
		$this->set_color($i, 3, '#dd9933', 1);
		$this->set_color($i, 4, '#dd3333', 1);
		$this->set_color($i, 5, '#000000', 1);
		$this->set_color($i, 6, '#c64c2d', 1);
		$this->set_color($i, 7, '#c64c2d', 1);
		$this->set_color($i, 8, '#000000', 1);
		$this->set_color($i, 9, '#000000', 1);
		$this->set_color($i, 10, '#4c1903', 1);
		$this->set_color($i, 11, '#757575', 1);
		$this->set_color($i, 12, '#757575', 1);
		$this->set_color($i, 13, '#e22fbc', 1);
		$this->set_color($i, 14, '#24147f', 1);

		$i = 'menu1_link';
		
		$this->add_color($i, $section_id, __('Link', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#dd3333');		
		$this->set_color($i, 1, '#ffffff');
		$this->set_color($i, 2, '#ffffff');		
		$this->set_color($i, 3, '#ffffff');		
		$this->set_color($i, 4, '#ffffff');		
		$this->set_color($i, 5, '#ffffff');		
		$this->set_color($i, 6, '#eeee22');		
		$this->set_color($i, 7, '#eeee22');		
		$this->set_color($i, 8, '#dd3333');		
		$this->set_color($i, 9, '#dd9933');		
		$this->set_color($i, 10, '#dd9933');		
		$this->set_color($i, 11, '#ffffff');		
		$this->set_color($i, 12, '#ffffff');		
		$this->set_color($i, 13, '#ffffff');		
		$this->set_color($i, 14, '#ffffff');		
		
		$i = 'menu1_top_hover';
		
		$this->add_color($i, $section_id, __('Top Level Link Hover', 'meditation'), $p++, false, 'refresh');
		$this->set_color($i, 0, '#dd9933');
		$this->set_color($i, 1, '#d3e7ed');
		$this->set_color($i, 2, '#ffffff');
		$this->set_color($i, 3, '#ffffff');
		$this->set_color($i, 4, '#ffffff');
		$this->set_color($i, 5, '#ffffff');
		$this->set_color($i, 6, '#ffffff');
		$this->set_color($i, 7, '#ffffff');
		$this->set_color($i, 8, '#ffffff');
		$this->set_color($i, 9, '#ffffff');
		$this->set_color($i, 10, '#ffffff');
		$this->set_color($i, 11, '#e2e2e2');
		$this->set_color($i, 12, '#e2e2e2');
		$this->set_color($i, 13, '#e3c7e8');
		$this->set_color($i, 14, '#ffffff');

		$i = 'menu1_hover_back';
		
		$this->add_color($i, $section_id, __('Sub Menu Background', 'meditation'), $p++, false, 'refresh');
		$this->set_color($i, 0, '#dd3333');
		$this->set_color($i, 1, '#ffffff');
		$this->set_color($i, 2, '#ffffff');
		$this->set_color($i, 3, '#ffffff');
		$this->set_color($i, 4, '#000000');
		$this->set_color($i, 5, '#335b0c');
		$this->set_color($i, 6, '#a83326');
		$this->set_color($i, 7, '#000000');
		$this->set_color($i, 8, '#ffffff');
		$this->set_color($i, 9, '#dd9933');
		$this->set_color($i, 10, '#dd9933');
		$this->set_color($i, 11, '#ffffff');
		$this->set_color($i, 12, '#ffffff');
		$this->set_color($i, 13, '#ffffff');
		$this->set_color($i, 14, '#ffffff');
		
		$i = 'menu1_hover';
		
		$this->add_color($i, $section_id, __('Sub Menu Text', 'meditation'), $p++, false, 'refresh');
		$this->set_color($i, 0, '#ffffff');
		$this->set_color($i, 1, '#1e73be');
		$this->set_color($i, 2, '#25751a');
		$this->set_color($i, 3, '#1e73be');
		$this->set_color($i, 4, '#ffffff');
		$this->set_color($i, 5, '#ffffff');
		$this->set_color($i, 6, '#ffffff');
		$this->set_color($i, 7, '#ffffff');
		$this->set_color($i, 8, '#dd3333');
		$this->set_color($i, 9, '#ffffff');
		$this->set_color($i, 10, '#ffffff');
		$this->set_color($i, 11, '#757575');
		$this->set_color($i, 12, '#757575');
		$this->set_color($i, 13, '#25bae8');
		$this->set_color($i, 14, '#24147f');
						
		//content
		$section_id = 'content_colors';
		$p = 0;

		$this->add_section($section_id, __('Content', 'meditation'), __('Sidebar Colors', 'meditation'), $section_priority++);

		$i = 'content_color';
		
		$this->add_color($i, $section_id, __('Content Background', 'meditation'), $p++, true);
		$this->set_color($i, 0, '#ffffff', 1);	
		$this->set_color($i, 1, '#ffffff', 1);	
		$this->set_color($i, 2, '#ffffff', 1);	
		$this->set_color($i, 3, '#ffffff', 1);	
		$this->set_color($i, 4, '#ffffff', 1);	
		$this->set_color($i, 5, '#ffffff', 1);	
		$this->set_color($i, 6, '#ffffff', 1);	
		$this->set_color($i, 7, '#3d3d3d', 1);	
		$this->set_color($i, 8, '#282828', 1);	
		$this->set_color($i, 9, '#dd9933', 1);	
		$this->set_color($i, 10, '#dd9933', 1);	
		$this->set_color($i, 11, '#ffffff', 1);	
		$this->set_color($i, 12, '#dddddd', 1);	
		$this->set_color($i, 13, '#ffffff', 1);	
		$this->set_color($i, 14, '#ffffff', 1);	
		
		$i = 'content_text';
		
		$this->add_color($i, $section_id, __('Text', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#444444');		
		$this->set_color($i, 1, '#000000');
		$this->set_color($i, 2, '#3d3d3d');		
		$this->set_color($i, 3, '#3d3d3d');		
		$this->set_color($i, 4, '#3d3d3d');		
		$this->set_color($i, 5, '#3d3d3d');		
		$this->set_color($i, 6, '#3d3d3d');		
		$this->set_color($i, 7, '#eeeeee');		
		$this->set_color($i, 8, '#ffffff');		
		$this->set_color($i, 9, '#ffffff');		
		$this->set_color($i, 10, '#ffffff');		
		$this->set_color($i, 11, '#565656');		
		$this->set_color($i, 12, '#565656');		
		$this->set_color($i, 13, '#123075');		
		$this->set_color($i, 14, '#000000');		
		
		$i = 'sidebar_content_color';
		
		$this->add_color($i, $section_id, __('Content Area Background', 'meditation'), $p++, true);
		$this->set_color($i, 0, '#ffffff', 1);	
		$this->set_color($i, 1, '#ffffff', 1);
		$this->set_color($i, 2, '#ffffff', 1);
		$this->set_color($i, 3, '#ffffff', 1);
		$this->set_color($i, 4, '#ffffff', 1);
		$this->set_color($i, 5, '#ffffff', 1);
		$this->set_color($i, 6, '#ffffff', 1);
		$this->set_color($i, 7, '#d1d1d1', 1);
		$this->set_color($i, 8, '#282828', 1);
		$this->set_color($i, 9, '#282828', 1);
		$this->set_color($i, 10, '#dd9933', 1);
		$this->set_color($i, 11, '#878787', 1);
		$this->set_color($i, 12, '#8c8c8c', 1);
		$this->set_color($i, 13, '#ffffff', 1);
		$this->set_color($i, 14, '#24147f', 1);
		
		$i = 'blog_content_color';
		
		$this->add_color($i, $section_id, __('Blog Content Background', 'meditation'), $p++, true);
		$this->set_color($i, 0, '#ffffff', 1);	
		$this->set_color($i, 1, '#ffffff', 1);
		$this->set_color($i, 2, '#ffffff', 1);
		$this->set_color($i, 3, '#ffffff', 1);
		$this->set_color($i, 4, '#ffffff', 1);
		$this->set_color($i, 5, '#ffffff', 1);
		$this->set_color($i, 6, '#ffffff', 1);
		$this->set_color($i, 7, '#262626', 1);	
		$this->set_color($i, 8, '#282828', 1);	
		$this->set_color($i, 9, '#dd9933', 1);	
		$this->set_color($i, 10, '#dd9933', 1);	
		$this->set_color($i, 11, '#ffffff', 1);	
		$this->set_color($i, 12, '#dddddd', 1);	
		$this->set_color($i, 13, '#ffffff', 1);	
		$this->set_color($i, 14, '#ffffff', 1);	

	//columns
		$section_id = 'sidebar_3_colors';
		$p = 0;

		$this->add_section($section_id, __('Columns', 'meditation'), __('Sidebar Colors', 'meditation'), $section_priority++);

		$i = 'sidebar3_color';
		
		$this->add_color($i, $section_id, __('Sidebar Background Color', 'meditation'), $p++, true);
		$this->set_color($i, 0, '#f4dd8b', 1);	
		$this->set_color($i, 1, '#ffffff', 1);
		$this->set_color($i, 2, '#dd9933', 1);		
		$this->set_color($i, 3, '#1e73be', 1);		
		$this->set_color($i, 4, '#2d2d2d', 1);		
		$this->set_color($i, 5, '#335b0c', 1);		
		$this->set_color($i, 6, '#a83326', 1);		
		$this->set_color($i, 7, '#a83326', 1);		
		$this->set_color($i, 8, '#282828', 1);		
		$this->set_color($i, 9, '#ffffff', 1);		
		$this->set_color($i, 10, '#4c1903', 1);		
		$this->set_color($i, 11, '#595959', 1);		
		$this->set_color($i, 12, '#dddddd', 1);		
		$this->set_color($i, 13, '#25bae8', 1);		
		$this->set_color($i, 14, '#24147f', 1);		
		
		$i = 'sidebar3_link';

		$this->add_color($i, $section_id, __('Link', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#dd3333');	
		$this->set_color($i, 1, '#1e73be');	
		$this->set_color($i, 2, '#1b5613');	
		$this->set_color($i, 3, '#ffffff');	
		$this->set_color($i, 4, '#ffffff');	
		$this->set_color($i, 5, '#ffffff');	
		$this->set_color($i, 6, '#ffffff');	
		$this->set_color($i, 7, '#ffffff');	
		$this->set_color($i, 8, '#dd3333');	
		$this->set_color($i, 9, '#dd9933');	
		$this->set_color($i, 10, '#dd9933');	
		$this->set_color($i, 11, '#afafaf');	
		$this->set_color($i, 12, '#4c4c4c');	
		$this->set_color($i, 13, '#ffffff');	
		$this->set_color($i, 14, '#ffffff');	
		
		$i = 'sidebar3_hover';
		
		$this->add_color($i, $section_id, __('Hover', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#dd9933');
		$this->set_color($i, 1, '#dd3333');
		$this->set_color($i, 2, '#ffffff');
		$this->set_color($i, 3, '#dd9933');
		$this->set_color($i, 4, '#cccccc');
		$this->set_color($i, 5, '#cccccc');
		$this->set_color($i, 6, '#eeee22');
		$this->set_color($i, 7, '#eeee22');
		$this->set_color($i, 8, '#ffffff');
		$this->set_color($i, 9, '#000000');
		$this->set_color($i, 10, '#ffffff');
		$this->set_color($i, 11, '#ffffff');
		$this->set_color($i, 12, '#000000');
		$this->set_color($i, 13, '#000000');
		$this->set_color($i, 14, '#d5dae5');
		
		$i = 'sidebar3_text';
		
		$this->add_color($i, $section_id, __('Text', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#000000');
		$this->set_color($i, 1, '#000000');
		$this->set_color($i, 2, '#000000');
		$this->set_color($i, 3, '#c0cedb');
		$this->set_color($i, 4, '#cccccc');
		$this->set_color($i, 5, '#cccccc');
		$this->set_color($i, 6, '#cccccc');
		$this->set_color($i, 7, '#cccccc');
		$this->set_color($i, 8, '#cccccc');
		$this->set_color($i, 9, '#999999');
		$this->set_color($i, 10, '#cccccc');
		$this->set_color($i, 11, '#dddddd');
		$this->set_color($i, 12, '#a3a3a3');
		$this->set_color($i, 13, '#a3a3a3');
		$this->set_color($i, 14, '#d5dae5');
		
		$i = 'column_header_color';

		$this->add_color($i, $section_id, __('Widget Title Background', 'meditation'), $p++, true);
		$this->set_color($i, 0, '#dd3333', 1);
		$this->set_color($i, 1, '#dd3333', 1);
		$this->set_color($i, 2, '#dd9933', 0);
		$this->set_color($i, 3, '#dd9933', 1);
		$this->set_color($i, 4, '#000000', 1);
		$this->set_color($i, 5, '#000000', 1);
		$this->set_color($i, 6, '#c64c2d', 1);
		$this->set_color($i, 7, '#c64c2d', 1);
		$this->set_color($i, 8, '#333333', 1);	
		$this->set_color($i, 9, '#dd9933', 1);	
		$this->set_color($i, 10, '#dd9933', 1);	
		$this->set_color($i, 11, '#757575', 1);	
		$this->set_color($i, 12, '#757575', 1);	
		$this->set_color($i, 13, '#ffffff', 1);	
		$this->set_color($i, 14, '#1e73be', 1);	
		
		$i = 'column_header_text';
		
		$this->add_color($i, $section_id, __('Widget Title Text', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#ffffff');		
		$this->set_color($i, 1, '#ffffff');
		$this->set_color($i, 2, '#ffffff');
		$this->set_color($i, 3, '#ffffff');
		$this->set_color($i, 4, '#ffffff');
		$this->set_color($i, 5, '#ffffff');
		$this->set_color($i, 6, '#eeee22');
		$this->set_color($i, 7, '#eeee22');
		$this->set_color($i, 8, '#cccccc');
		$this->set_color($i, 9, '#ffffff');
		$this->set_color($i, 10, '#4c1903');
		$this->set_color($i, 11, '#ffffff');
		$this->set_color($i, 12, '#ffffff');
		$this->set_color($i, 13, '#25bae8');
		$this->set_color($i, 14, '#ffffff');
		
		$i = 'column_border';
		
		$this->add_color($i, $section_id, __('Title Border', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#dd3333');
		$this->set_color($i, 1, '#dd9933');
		$this->set_color($i, 2, '#ffffff');
		$this->set_color($i, 3, '#ffffff');
		$this->set_color($i, 4, '#ffffff');
		$this->set_color($i, 5, '#ffffff');
		$this->set_color($i, 6, '#dd9933');
		$this->set_color($i, 7, '#dd9933');
		$this->set_color($i, 8, '#dd3333');
		$this->set_color($i, 9, '#ffffff');
		$this->set_color($i, 10, '#e5bb24');
		$this->set_color($i, 11, '#a8a8a8');
		$this->set_color($i, 12, '#a8a8a8');
		$this->set_color($i, 13, '#25bae8');
		$this->set_color($i, 14, '#25bae8');
		
		$i = 'column_main_border';
		
		$this->add_color($i, $section_id, __('Column Border', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#ffffff');
		$this->set_color($i, 1, '#1e73be');
		$this->set_color($i, 2, '#dd9933');
		$this->set_color($i, 3, '#ffffff');
		$this->set_color($i, 4, '#ffffff');
		$this->set_color($i, 5, '#ffffff');
		$this->set_color($i, 6, '#ffffff');
		$this->set_color($i, 7, '#eeee22');
		$this->set_color($i, 8, '#dd3333');
		$this->set_color($i, 9, '#ffffff');
		$this->set_color($i, 10, '#4c1903');
		$this->set_color($i, 11, '#595959');
		$this->set_color($i, 12, '#969696');
		$this->set_color($i, 13, '#25bae8');
		$this->set_color($i, 14, '#24147f');
		
	//footer sidebar 
		$section_id = 'sidebar_2_colors';
		$p = 0;
		
		$this->add_section($section_id, __('Footer Sidebar', 'meditation'), __('Sidebar Colors', 'meditation'), $section_priority++);

		$i = 'sidebar2_color';

		$this->add_color($i, $section_id, __('Sidebar Background Color', 'meditation'), $p+=2, true);
		$this->set_color($i, 0, '#9b2723', 1);
		$this->set_color($i, 1, '#1e73be', 1);
		$this->set_color($i, 2, '#25751a', 1);
		$this->set_color($i, 3, '#dd9933', 1);
		$this->set_color($i, 4, '#dd3333', 1);
		$this->set_color($i, 5, '#000000', 1);
		$this->set_color($i, 6, '#212121', 1);
		$this->set_color($i, 7, '#212121', 1);
		$this->set_color($i, 8, '#000000', 1);	
		$this->set_color($i, 9, '#ffffff', 1);	
		$this->set_color($i, 10, '#4c1903', 1);	
		$this->set_color($i, 11, '#595959', 1);	
		$this->set_color($i, 12, '#595959', 1);	
		$this->set_color($i, 13, '#25bae8', 1);	
		$this->set_color($i, 14, '#0e0d51', 1);	
		
		$i = 'sidebar2_link';

		$this->add_color($i, $section_id, __('Link', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#ffffff');	
		$this->set_color($i, 1, '#ffffff');	
		$this->set_color($i, 2, '#ffffff');	
		$this->set_color($i, 3, '#ffffff');	
		$this->set_color($i, 4, '#ffffff');	
		$this->set_color($i, 5, '#ffffff');	
		$this->set_color($i, 6, '#ffffff');	
		$this->set_color($i, 7, '#ffffff');	
		$this->set_color($i, 8, '#dd3333');	
		$this->set_color($i, 9, '#dd9933');	
		$this->set_color($i, 10, '#dd9933');	
		$this->set_color($i, 11, '#afafaf');	
		$this->set_color($i, 12, '#afafaf');	
		$this->set_color($i, 13, '#ffffff');	
		$this->set_color($i, 14, '#ffffff');	
		
		$i = 'sidebar2_hover';

		$this->add_color($i, $section_id, __('Hover', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#ddbd8d');
		$this->set_color($i, 1, '#cbdced');
		$this->set_color($i, 2, '#dd9933');
		$this->set_color($i, 3, '#1e73be');
		$this->set_color($i, 4, '#000000');
		$this->set_color($i, 5, '#cccccc');
		$this->set_color($i, 6, '#eeee22');
		$this->set_color($i, 7, '#eeee22');
		$this->set_color($i, 8, '#ffffff');
		$this->set_color($i, 9, '#000000');
		$this->set_color($i, 10, '#ffffff');
		$this->set_color($i, 11, '#ffffff');
		$this->set_color($i, 12, '#ffffff');
		$this->set_color($i, 13, '#000000');
		$this->set_color($i, 14, '#d5dae5');
		
		$i = 'sidebar2_text';
		
		$this->add_color($i, $section_id, __('Text', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#ddbd8d');
		$this->set_color($i, 1, '#cbdced');
		$this->set_color($i, 2, '#b4ef99');
		$this->set_color($i, 3, '#e8debb');
		$this->set_color($i, 4, '#f4dfdc');
		$this->set_color($i, 5, '#cccccc');
		$this->set_color($i, 6, '#cccccc');
		$this->set_color($i, 7, '#cccccc');
		$this->set_color($i, 8, '#cccccc');
		$this->set_color($i, 9, '#999999');
		$this->set_color($i, 10, '#cccccc');
		$this->set_color($i, 11, '#dddddd');
		$this->set_color($i, 12, '#dddddd');
		$this->set_color($i, 13, '#e5edf9');
		$this->set_color($i, 14, '#d5dae5');
		
		$i = 'sidebar2_header_color';

		$this->add_color($i, $section_id, __('Widget Title Background', 'meditation'), $p++, true);
		$this->set_color($i, 0, '#dd3333', 0.5);
		$this->set_color($i, 1, '#175e1b', 0);
		$this->set_color($i, 2, '#ffffff', 0);
		$this->set_color($i, 3, '#ffffff', 0);
		$this->set_color($i, 4, '#ffffff', 0);
		$this->set_color($i, 5, '#ffffff', 0);
		$this->set_color($i, 6, '#c64c2d', 1);
		$this->set_color($i, 7, '#c64c2d', 1);
		$this->set_color($i, 8, '#333333', 1);	
		$this->set_color($i, 9, '#dd9933', 1);	
		$this->set_color($i, 10, '#dd9933', 1);	
		$this->set_color($i, 11, '#757575', 1);	
		$this->set_color($i, 12, '#757575', 1);	
		$this->set_color($i, 13, '#ffffff', 1);	
		$this->set_color($i, 14, '#1e73be', 1);	
		
		$i = 'sidebar2_header_text';
		
		$this->add_color($i, $section_id, __('Widget Title Text', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#ffffff');		
		$this->set_color($i, 1, '#ffffff');
		$this->set_color($i, 2, '#ffffff');
		$this->set_color($i, 3, '#ffffff');
		$this->set_color($i, 4, '#ffffff');
		$this->set_color($i, 5, '#ffffff');
		$this->set_color($i, 6, '#eeee22');
		$this->set_color($i, 7, '#eeee22');
		$this->set_color($i, 8, '#cccccc');
		$this->set_color($i, 9, '#ffffff');
		$this->set_color($i, 10, '#cccccc');
		$this->set_color($i, 11, '#ffffff');
		$this->set_color($i, 12, '#ffffff');
		$this->set_color($i, 13, '#25bae8');
		$this->set_color($i, 14, '#ffffff');

		$i = 'sidebar2_border';

		$this->add_color($i, $section_id, __('Title Border', 'meditation'), $p++, false);
		$this->set_color($i, 0, '#dd3333');
		$this->set_color($i, 1, '#d9e8f7');
		$this->set_color($i, 2, '#ffffff');
		$this->set_color($i, 3, '#ffffff');
		$this->set_color($i, 4, '#ffffff');
		$this->set_color($i, 5, '#ffffff');
		$this->set_color($i, 6, '#dd9933');
		$this->set_color($i, 7, '#dd9933');
		$this->set_color($i, 8, '#dd3333');
		$this->set_color($i, 9, '#ffffff');
		$this->set_color($i, 10, '#e5bb24');
		$this->set_color($i, 11, '#a8a8a8');
		$this->set_color($i, 12, '#a8a8a8');
		$this->set_color($i, 13, '#25bae8');
		$this->set_color($i, 14, '#25bae8');
		
		
		add_action( 'customize_register', array( $this, 'meditation_create_colors_controls' ), 21 );
		add_action( 'meditation_option_defaults', array( $this, 'meditation_add_defaults' ) );
		add_action( 'customize_controls_print_scripts', array( $this, 'meditation_print_customizer_js_colors') );

	}
	
	/* Print js for color scheme switching */
	public function meditation_print_customizer_js_colors() {

	?>
	<script type="text/javascript">
		jQuery( document ).ready(function( $ ) {
			var api = wp.customize;
			function SetControlVal(name, newVal) {
				var control = api.control(name); 
				if( control ){
					control.setting.set( newVal );
				}
				return;
			}	
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
			wp.customize( 'color_scheme', function( value ) {
				value.bind( function( to ) {
				
					meditation_refresh_colors(to);

				});
			});
			
			function meditation_refresh_colors( color_scheme ) { 
			
			<?php 
				foreach( $this->color_schemes as $scheme_id => $value ) {
					?>
				
				if ( '<?php echo esc_js($scheme_id); ?>' == color_scheme) {
					<?php
						foreach($this->colors as $id => $scheme) {
							$index = ( array_key_exists($scheme_id, $this->colors[$id] ) ? $scheme_id : 0 );
						?>
						SetColor('<?php echo esc_js($id); ?>', '<?php echo esc_js($scheme[$index]['def_val']); ?>');
						<?php 
							if( '1' == $scheme['is_has_opacity'] ) {
						?>
						SetControlVal('<?php echo esc_js($id.'_opacity'); ?>', '<?php echo esc_js($scheme[$index]['def_op']); ?>');
						SetControlVal('<?php echo esc_js($id.'_opacity_range'); ?>', '<?php echo esc_js($scheme[$index]['def_op']) * 10; ?>');
						<?php
							}	
						?>
					<?php
						}
						?>
						SetColor('header_textcolor', '#<?php echo esc_js( meditation_text_color( $scheme_id ) ); ?>');
					}
			<?php
				}?>				
			}
		});
	</script>
	<?php
	}
	
	public function get_color_scheme() {
	
		return $this->color_scheme; 
		
	}
	
	public function add_section($name, $title, $description, $priority, $panel = 'custom_colors') {
	
		$this->sections[$name]['title'] = $title;
		$this->sections[$name]['description'] = $description;
		$this->sections[$name]['priority'] = $priority;
		$this->sections[$name]['panel'] = $panel;
		
	}

	// Set color properties
	public function add_color($name, $section, $title, $priority, $is_has_opacity = false, $transport = 'postMessage') {
	
		$this->colors[$name]['section'] = $section;
		$this->colors[$name]['val'] = '';
		$this->colors[$name]['text'] = $title;
		$this->colors[$name]['priority'] = $priority;
		$this->colors[$name]['is_has_opacity'] = $is_has_opacity;
		$this->colors[$name]['transport'] = $transport;
		
	}
	
	// Set color value and opacity for the color scheme
	public function set_color($name, $color_scheme, $color, $opacity = 1) {

		$this->colors[$name][$color_scheme]['def_val'] = $color;
		$this->colors[$name][$color_scheme]['def_op'] = $opacity;
		
	}	
	// Set color value and opacity for the color scheme
	public function use_default( $id ) {

		$this->is_use_default_colors = true;
		$this->color_scheme = $id;
		
	}
	
	// Return hex color value
	public function get_color( $name ) {
	
		if ( ! isset( $this->colors[ $name ] ) )
			return 'transparent';

		if ( true == $this->is_use_default_colors ) {
			$color = $this->colors[ $name ][ $this->color_scheme ]['def_val'];
			
			if( $this->colors[$name]['is_has_opacity'] ) {
				$opacity = $this->colors[ $name ][ $this->color_scheme ]['def_op'];
				$color = $this->hex_to_rgba( $color, $opacity );
			}
		} else {
			$color = get_theme_mod($name, $this->colors[ $name ][ $this->color_scheme ]['def_val']);
			
			if( $this->colors[$name]['is_has_opacity'] ) {
				$opacity = get_theme_mod($name.'_opacity', $this->colors[ $name ][ $this->color_scheme ]['def_op']);
				$color = $this->hex_to_rgba( $color, $opacity );
			}
		}
		
		return $color;
	}
	
// Return hex color value
	public function get_color_val( $name ) {

		if ( true == $this->is_use_default_colors ) {
			$color = $this->colors[ $name ][ $this->color_scheme ]['def_val'];
		} else {
			$color = get_theme_mod($name, $this->colors[ $name ][ $this->color_scheme ]['def_val']);
		}
		
		return $color;
	}
	
	// Add new color scheme
	public function add_scheme( $id, $text) {
		$this->color_schemes[ $id ] = $text;
	}
	
	// Set color scheme
	public function set_scheme( $id ) {
		$this->color_scheme = $id;
	}
	
	// Return color schemes
	public function get_schemes() {
		return $this->color_schemes;
	}
	
	// Add sections and controls to the Customizer
	public function meditation_create_colors_controls( $wp_customize ) {

		$wp_customize->add_panel( 'custom_colors', array(
			'priority'       => 102,
			'title'          => __( 'Colors', 'meditation' ),
			'description'    => __( 'In this section you can change colors for different elements.', 'meditation' ),
		) );
		
		$wp_customize->add_section( 'color_scheme', array(
			'title'          => __( 'Color Scheme', 'meditation' ),
			'description'    => __( 'This option refresh theme colors.', 'meditation' ),
			'priority'       => 1,
			'panel'  => 'custom_colors',
		) );

		$wp_customize->add_setting( 'color_scheme', array(
			'default'        => $this->color_scheme,
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'meditation_sanitize_color_scheme'
		) );

		$wp_customize->add_control( 'color_scheme', array(
			'label'      => __( 'Color Scheme', 'meditation' ),
			'section'    => 'color_scheme',
			'settings'   => 'color_scheme',
			'type'       => 'select',
			'priority'   => 1,
			'choices'	 => $this->get_schemes(),
		) );
	
		// Register Customizer sections
		foreach( $this->sections as $id => $section ) {
		
			$wp_customize->add_section( $id, array(
				'priority'       => $section['priority'],
				'title'          => $section['title'],
				'description'    => $section['description'],
				'panel'  => $section['panel'],
			) );
			
		}	
		// Register Customizer settings and controls
		foreach( $this->colors as $id => $colors ) {
			$p = $colors['priority'];
				
			$wp_customize->add_setting( $id, array(
				'default'        => $colors[ $this->color_scheme ]['def_val'],
				'transport'		 => $colors['transport'],
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'meditation_sanitize_hex_color'
			) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
				'label'   => $colors['text'],
				'section' => $colors['section'],
				'settings'   => $id,
				'priority' =>  $colors['priority'],
			) ) );
			
			if( $colors['is_has_opacity'] ) {
				$wp_customize->add_setting( $id.'_opacity', array(
					'default'        => $colors[ $this->color_scheme ]['def_op'],
					'transport'		 => 'postMessage',
					'capability'     => 'edit_theme_options',
					'sanitize_callback' => 'meditation_sanitize_opacity'
				) );
				
				$wp_customize->add_control( $id.'_opacity', array(
					'label'      => __('Opacity for the ', 'meditation').$colors['text'],
					'section'    => $colors['section'],
					'settings'   => $id.'_opacity',
					'type'       => 'select',
					'priority'   => $colors['priority'],
					'choices'	 => array (
										   '0' => '0',
										   '0.1' => '0.1', 
										   '0.2' => '0.2', 
										   '0.3' => '0.3', 
										   '0.4' => '0.4', 
										   '0.5' => '0.5',
										   '0.6' => '0.6', 
										   '0.7' => '0.7',
										   '0.8' => '0.8',
										   '0.9' =>  '0.9',
										   '1' => '1')
				) );
				$wp_customize->add_setting( $id.'_opacity_range', array(
					'type'			 => 'empty',
					'default'        => 10*get_theme_mod($id.'_opacity', $colors[ $this->color_scheme ]['def_op']),
					'capability'     => 'edit_theme_options',
					'transport'		 => 'postMessage',
					'sanitize_callback' => 'absint'
				) );

				$wp_customize->add_control( $id.'_opacity_range', array(
					'label'      => '',
					'section'    => $colors['section'],
					'settings'   => $id.'_opacity_range',
					'type'       => 'range',
					'input_attrs' => array(
						'min'   => 0,
						'max'   => 10,
						'step'  => 1,),
						'priority' =>  $colors['priority'],
				));
			}
		}
	}
	
	/**
	 * Transform hex color to rgba
	 *
	 * @param string $color hex color. 
	 * @param int $opacity opacity. 
	 * @return string rgba color.
	 * @since Meditation 1.0.0
	 */
	function hex_to_rgba( $color, $opacity ) {

		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		$hex = array('ffffff');
		
		if ( 6 == strlen($color) ) {
				$hex = array( $color[0].$color[1], $color[2].$color[3], $color[4].$color[5] );
		} elseif ( 3 == strlen( $color ) ) {
				$hex = array( $color[0].$color[0], $color[1].$color[1], $color[2].$color[2] );
		}

		$rgb =  array_map('hexdec', $hex);

		return 'rgba('.implode(",",$rgb).','.$opacity.')';
	}
	/* Add values to defaults array */

	function meditation_add_defaults( $defaults ) {

		foreach( $this->colors as $id => $values ) {

			$defaults[ $id ] = $values[0]['def_val'];
			
		}

		return $defaults;
	}
}
/**
 * Return string Sanitized color scheme
 *
 * @since Meditation 1.0.0
 */
function meditation_sanitize_color_scheme( $value ) {
	global $meditation_colors_class;
	$defaults = meditation_get_defaults();
	$possible_values = $meditation_colors_class->get_schemes();
	return ( array_key_exists( $value, $possible_values ) ? $value : $defaults['color_scheme'] );
}

 /**
 * Add custom styles to the header.
 *
 * @since Meditation 1.0.0
*/
function meditation_hook_css_colors() {

	global $meditation_colors_class;
	$colors = $meditation_colors_class;
?>
	<style type="text/css">	
		
		@media screen and (min-width: 960px) {
			.site-title {
				background: <?php echo esc_attr($colors->get_color('site_name_back')); ?>;
			}
		}
		
		.site-title a:after, 
		.site-title a:before {
			background: #<?php echo esc_attr( meditation_text_color( $colors->get_color_scheme() ) ); ?>;
		}

		.site-description {
			background: <?php echo esc_attr($colors->get_color('site_description_back')); ?>;
		}

		button,
		input,
		.content a,
		.comments-area a
		.site .comment-list .reply a {
			color: <?php echo esc_attr($colors->get_color('link_color')); ?>;
		}
		
		.read-more a:after,
		.site .site-content .read-more a:hover {
			background-color: <?php echo esc_attr($colors->get_color('link_color')); ?>;
			color: <?php echo esc_attr($colors->get_color('content_color')); ?>;
		}
		
		.read-more a,
		.tags a,
		.post-date,
		.flex .content-container,
		.pagination .page-numbers {
			border-color: <?php echo esc_attr($colors->get_color('link_color')); ?>;			
		}
		
		/* content */
		.main-area {
			background-color:<?php echo esc_attr($colors->get_color('sidebar_content_color')); ?>;
		}
		
		body#tinymce,
		.site .site-content,
		.site .entry-title a:after,
		.site .entry-content a:after,
		.site .tags a:after,
		.site .post-date:after,
		.site .page-numbers:after,
		.flex .content-container:after, 
		.flex .content-container:before,
		.content-container > article:before,
		.content-container > article:after,
		.content-container .entry-title:before,
		.comment-list .comment-meta {
			background-color: <?php echo esc_attr($colors->get_color('content_color')); ?>;			
		}

		body#tinymce,
		.site-content,
		.comment-body .comment-meta,
		.pagination .page-numbers,
		.comment-metadata, .comment-metadata a, .comment-edit-link,
		.comment-notes, .comment-awaiting-moderation, .logged-in-as, .no-comments, .form-allowed-tags,.form-allowed-tags code {
			color: <?php echo esc_attr($colors->get_color('content_text')); ?>;
		}		
		
		.flex .content-container,
		.flex .entry-title a:after,
		.flex .post-date:after {
			background-color: <?php echo esc_attr($colors->get_color('blog_content_color')); ?>;
		}
		
		.woo-shop .woocommerce-breadcrumb a,
		.woo-shop .woocommerce-breadcrumb,
		.woo-shop .orderby {
			color: <?php echo esc_attr($colors->get_color('content_text')); ?>;
		}
		
		.woo-shop .woocommerce-breadcrumb {
			border-bottom: 5px solid <?php echo esc_attr($colors->get_color('content_color')); ?>;
		}
		
		.nav-link a,
		.project-list a,
		.category-list a,
		.category-list a:after,
		.search-form:before,
		.pagination .page-numbers.current {
			background: <?php echo esc_attr($colors->get_color('heading_color')); ?>;
			color: <?php echo esc_attr($colors->get_color('content_color')); ?>;
		}

		<?php if ( 0 == $colors->get_color_scheme() ) : ?>
			.animate-on-load.header-effect-4 .image-wrapper:before {
				background-color: #000;
			}
		<?php else: ?>
			.animate-on-load.header-effect-4 .image-wrapper:before {
				background-color: #fff;
			}
		<?php endif; ?>
		
		.pagination .page-numbers {
			border-color: <?php echo esc_attr($colors->get_color('heading_color')); ?>;
		}
		
		.category-list a:hover:before {
			background-color: <?php echo esc_attr($colors->get_color('content_color')); ?>;
		}

		.pagination .page-numbers,
		.site .entry-header .entry-title a {
			color: <?php echo esc_attr($colors->get_color('heading_link')); ?>;
		}
		
		.entry-content a:hover,
		.entry-summary a:hover,
		.entry-title a:hover,
		.entry-meta a:hover,
		.comments-link a:hover,
		.comment-author.vcard a:hover,
		.comment-metadata a:hover,
		.site .entry-header .entry-title a:hover,
		.site-content h1 a:hover, .site-content h2 a:hover, .site-content h3 a:hover, .site-content h4 a:hover, .site-content h5 a:hover, .site-content h6 a:hover{
			color: <?php echo esc_attr($colors->get_color('hover_color')); ?>;
		}
		
		.entry-title a:hover:before,
		.entry-content a:hover:before,
		.tags a:hover:before {
			background-color: <?php echo esc_attr($colors->get_color('hover_color')); ?>;
		}

		.site-description h2 {
			color: <?php echo esc_attr($colors->get_color('description_color')); ?>;
		}
		
		.entry-header .entry-title a, .site .comment-metadata a, .site .comment-author.vcard a,
		.site-content h1, .site-content h2, .site-content h3, .site-content h4, .site-content h5, .site-content h6,
		.site-content h1 a, .site-content h2 a, .site-content h3 a, .site-content h4 a, .site-content h5 a, .site-content h6 a {
			color: <?php echo esc_attr($colors->get_color('heading_color')); ?>;
		}
		
		.site-title h1 a {
			color: #<?php echo esc_attr( meditation_text_color( $colors->get_color_scheme() ) ); ?>;

		}
		
		.entry-date a:hover:before,
		.author.vcard a:hover:before,
		.edit-link a:hover:before,
		.tag a:hover:before,
		.content .project a:hover:before,
		.tags a:hover:before,
		.content .project-list a:hover:before,
		.category-list a:hover:before,
		.comments-link a:hover:before {
			text-shadow: 5px 1px 10px <?php echo esc_attr($colors->get_color('box_shadow')); ?>;
		}
	
		@media screen and (min-width: 680px) {
			.pagination .page-numbers:hover,
			.project-list a:hover,
			.category-list a:hover,
			.tags a:hover,
			.flex .content-container,
			.comment-list .comment-meta,
			.widgettitle,
			.widget-title,
			.menu-top,
			.menu-top ul ul {
				box-shadow: 5px 1px 10px <?php echo esc_attr($colors->get_color('box_shadow')); ?>;

			}
		}
		
		/* Column sidebar */

		.image-container,
		.no-image, .sidebar-header a,
		.sidebar-1, .sidebar-2, .comment-body, .widget a:after {
			background-color:<?php echo esc_attr($colors->get_color('sidebar3_color')); ?>;
		}

		.no-image .sidebar-header, .column .widget, .comment-body {
			color: <?php echo esc_attr($colors->get_color('sidebar3_text')); ?>;
		}
	
		.sidebar-header a, .small a, .small a:before, .small li:before, .comment-body a {
			color: <?php echo esc_attr($colors->get_color('sidebar3_link')); ?>;
		}
		
		.column .widget_tag_cloud a {
			border-color: <?php echo esc_attr($colors->get_color('sidebar3_link')); ?>;
		}

		.sidebar-header a:hover, .column a:hover {
			color: <?php echo esc_attr($colors->get_color('sidebar3_hover')); ?>;
		}
		
		.sidebar-header {
			color: #fff;
		}
		.widget a:hover:before {
			background-color: <?php echo esc_attr($colors->get_color('sidebar3_hover')); ?>;
		}

		.column .widgettitle,
		.column .widgettitle a,
		.column .widget-title,
		.column .widget-title a {
			background-color: <?php echo esc_attr($colors->get_color('column_header_color')); ?>;
			color: <?php echo esc_attr($colors->get_color('column_header_text')); ?>;
		}
		
		.column .widget-title:after, .column .widgettitle:after, 
		.column .widget-title:before, .column .widgettitle:before {
			background: <?php echo esc_attr($colors->get_color('column_header_text')); ?>;
		}
		
		.column .widgettitle, .column .widget-title {
			border-color: <?php echo esc_attr($colors->get_color('column_border')); ?>;
		}

		.column .widget {
			background-color: <?php echo esc_attr($colors->get_color('column_widget_back')); ?>;
		}
		
		.sidebar-1, .sidebar-2 {
			border-color: <?php echo esc_attr($colors->get_color('column_main_border')); ?>;
		}
		
		/* Top Menu */

		.horisontal-navigation ul {
			background-color: <?php echo esc_attr($colors->get_color('menu1_hover_back')); ?>;
		}

		.horisontal-navigation li a {
			color: <?php echo esc_attr($colors->get_color('menu1_hover')); ?>;
		}			
		
		@media screen and (min-width: 680px) {
		
			.horisontal-navigation > div > ul > li.current-menu-item:before,
			.horisontal-navigation > div > ul > li.current_page_item:before,
			.horisontal-navigation > div > ul > li.current-page-ancestor:before,
			.horisontal-navigation > div > ul > li.current-menu-ancestor:before,
			.horisontal-navigation > div > ul > li:hover:before {
				background-color: <?php echo esc_attr($colors->get_color('menu1_hover_back')); ?>;
			}
			
			.horisontal-navigation ul li ul li:hover a:after,
			.horisontal-navigation > div > ul > li > a:hover {
				color: <?php echo esc_attr($colors->get_color('menu1_top_hover')); ?>;
			}
			
			.horisontal-navigation li ul li.current-menu-item a,
			.horisontal-navigation li ul li.current_page_item a,
			.horisontal-navigation li ul li.current-page-ancestor a,
			.horisontal-navigation li ul li.current-menu-ancestor a,
			.horisontal-navigation li ul li a:hover {
				background-color: <?php echo esc_attr($colors->get_color('menu1_hover')); ?>;
				color: <?php echo esc_attr($colors->get_color('menu1_hover_back')); ?> !important;
			}

		}

		.cloned.menu-visible, .cloned .nav-horizontal:before,.cloned:before,.cloned .nav-horizontal:before, .cloned:after,
		.top-1-navigation,
		.site-info,
		.horisontal-navigation > div > ul > li:after {
			background-color: <?php echo esc_attr($colors->get_color('menu1_color')); ?>;
		}

		.horisontal-navigation li ul {
			background-color: <?php echo esc_attr($colors->get_color('menu1_hover_back')); ?>;
		}

		.top-1-navigation .horisontal-navigation li ul li a {
			color: <?php echo esc_attr($colors->get_color('menu1_hover')); ?>;
		}

		.top-1-navigation .horisontal-navigation li ul .current-menu-ancestor > a,
		.top-1-navigation .horisontal-navigation li ul .current_page_ancestor > a {
			background-color: <?php echo esc_attr($colors->get_color('menu1_hover')); ?>;
			color: <?php echo esc_attr($colors->get_color('menu1_hover_back')); ?>;
		}	
		
		@media screen and (min-width: 680px) {
			.top-1-navigation ul {
				background-color: transparent;
			}
			.top-1-navigation .horisontal-navigation li a {
				color: <?php echo esc_attr($colors->get_color('menu1_link')); ?>;
			}
		}
		
		/* Footer Sidebar */
		
		.sidebar-footer-wrap,
		.sidebar-footer .widget a:after {
			background-color: <?php echo esc_attr($colors->get_color('sidebar2_color')); ?>;
		}
		.site-info,
		.site-info a {
			color: <?php echo esc_attr($colors->get_color('menu1_link')); ?>;
		}
	
		.sidebar-footer .widgettitle,
		.sidebar-footer .widgettitle a,
		.sidebar-footer .widget-title,
		.sidebar-footer .widget-title a,
		.sidebar-footer .widget {
			color: <?php echo esc_attr($colors->get_color('sidebar2_text')); ?>;
		}
		
		.sidebar-footer .widget-title:after, .sidebar-footer .widgettitle:after, 
		.sidebar-footer .widget-title:before, .sidebar-footer .widgettitle:before {
			background: <?php echo esc_attr($colors->get_color('sidebar2_text')); ?>;
		}
		
		.sidebar-footer .widget a,
		.sidebar-footer .widget li:before {
			color: <?php echo esc_attr($colors->get_color('sidebar2_link')); ?>;
		}
		
		.sidebar-footer .widget_tag_cloud a {
			border-color: <?php echo esc_attr($colors->get_color('sidebar3_color')); ?>;
		}
		
		.sidebar-footer .widget a:hover {
			color: <?php echo esc_attr($colors->get_color('sidebar2_hover')); ?>;
		}
		
		.sidebar-footer .widget a:hover:before {
			background-color: <?php echo esc_attr($colors->get_color('sidebar2_hover')); ?>;
		}
		
		.sidebar-footer .widgettitle,
		.sidebar-footer .widgettitle a,
		.sidebar-footer .widget-title,
		.sidebar-footer .widget-title a {
			background-color: <?php echo esc_attr($colors->get_color('sidebar2_header_color')); ?>;
			color: <?php echo esc_attr($colors->get_color('sidebar2_header_text')); ?>;
		}
		
		.sidebar-footer .widgettitle, .sidebar-footer .widget-title {
			border-color: <?php echo esc_attr($colors->get_color('sidebar2_border')); ?>;
		}
		
	</style>
	<?php
}
add_action('wp_head', 'meditation_hook_css_colors');