<?php
/*
 * generator Breadcrumbs
*/
function generator_custom_breadcrumbs() {

  $generator_showonhome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $generator_delimiter = '/'; // generator_delimiter between crumbs
  $generator_home = __('Home','generator'); // text for the 'Home' link
  $generator_showcurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $generator_before = ' '; // tag before the current crumb
  $generator_after = ' '; // tag after the current crumb

  global $post;
  $generator_homelink = esc_url(home_url());

  if (is_home() || is_front_page()) {

    if ($generator_showonhome == 1) echo '<div id="crumbs" class="font-14 color-fff conter-text generator-breadcrumb"><a href="' . $generator_homelink . '">' . $generator_home . '</a></div>';

  } else {

    echo '<div id="crumbs" class="font-14 color-fff conter-text generator-breadcrumb"><a href="' . $generator_homelink . '">' . $generator_home . '</a> ' . $generator_delimiter . ' ';

    if ( is_category() ) {
      $generator_thisCat = get_category(get_query_var('cat'), false);
      if ($generator_thisCat->parent != 0) echo get_category_parents($generator_thisCat->parent, TRUE, ' ' . $generator_delimiter . ' ');
      echo $generator_before . __('Archive by category ','generator') . single_cat_title(' : ', false)  . $generator_after;

    } elseif ( is_search() ) {
      echo $generator_before . __('Search results for ','generator'); echo ' : '. get_search_query() . $generator_after;

    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $generator_delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $generator_delimiter . ' ';
      echo $generator_before . get_the_time('d') . $generator_after;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $generator_delimiter . ' ';
      echo $generator_before . get_the_time('F') . $generator_after;

    } elseif ( is_year() ) {
      echo $generator_before . get_the_time('Y') . $generator_after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $generator_post_type = get_post_type_object(get_post_type());
        $generator_slug = $generator_post_type->rewrite;
        echo '<a href="' . $generator_homelink . '/' . $generator_slug['slug'] . '/">' . $generator_post_type->labels->singular_name . '</a>';
        if ($generator_showcurrent == 1) echo ' ' . $generator_delimiter . ' ' . $generator_before . get_the_title() . $generator_after;
      } else {
        $generator_cat = get_the_category(); $generator_cat = $generator_cat[0];
        $generator_cats = get_category_parents($generator_cat, TRUE, ' ' . $generator_delimiter . ' ');
        if ($generator_showcurrent == 0) $generator_cats = preg_replace("#^(.+)\s$generator_delimiter\s$#", "$1", $generator_cats);
        echo $generator_cats;
        if ($generator_showcurrent == 1) echo $generator_before . get_the_title() . $generator_after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $generator_post_type = get_post_type_object(get_post_type());
      echo $generator_before . $generator_post_type->labels->singular_name . $generator_after;

    } elseif ( is_attachment() ) {
      $generator_parent = get_post($post->post_parent);
      $generator_cat = get_the_category($generator_parent->ID); $generator_cat = $generator_cat[0];
      echo get_category_parents($generator_cat, TRUE, ' ' . $generator_delimiter . ' ');
      echo '<a href="' . get_permalink($generator_parent) . '">' . $generator_parent->post_title . '</a>';
      if ($generator_showcurrent == 1) echo ' ' . $generator_delimiter . ' ' . $generator_before . get_the_title() . $generator_after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($generator_showcurrent == 1) echo $generator_before . get_the_title() . $generator_after;

    } elseif ( is_page() && $post->post_parent ) {
      $generator_parent_id  = $post->post_parent;
      $generator_breadcrumbs = array();
      while ($generator_parent_id) {
        $generator_page = get_page($generator_parent_id);
        $generator_breadcrumbs[] = '<a href="' . get_permalink($generator_page->ID) . '">' . get_the_title($generator_page->ID) . '</a>';
        $generator_parent_id  = $generator_page->post_parent;
      }
      $generator_breadcrumbs = array_reverse($generator_breadcrumbs);
      for ($i = 0; $i < count($generator_breadcrumbs); $i++) {
        echo $generator_breadcrumbs[$i];
        if ($i != count($generator_breadcrumbs)-1) echo ' ' . $generator_delimiter . ' ';
      }
      if ($generator_showcurrent == 1) echo ' ' . $generator_delimiter . ' ' . $generator_before . get_the_title() . $generator_after;

    } elseif ( is_tag() ) {
      echo $generator_before . __('Posts tagged','generator') . single_tag_title(' : ', false) . $generator_after;

    } elseif ( is_author() ) {
       global $author;
      $generator_userdata = get_userdata($author);
      echo $generator_before . __('Articles posted by','generator'); echo ' : ' . $generator_userdata->display_name . $generator_after;

    } elseif ( is_404() ) {
      echo $generator_before . __('Error 404','generator') . $generator_after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','generator') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</div>';

  }
} // end generator_custom_breadcrumbs()
