<?php

//function to create post ((post as in page/post/data)) type
function create_post_type() {
  //wp function to register post of type 'postType'
  register_post_type(
    //post type
    'customPostType',
    //wp function of arrays
    array(
      //assign arrays
      //array name public: true make publicly visible
      'public' => true,
      //labels for WP admin tools UI
      'labels' => array(
        //
        'name' => 'customPostName', /* __('postName') to be translatable */
        //singular name of posttype
        'singular' => "singlularCustomPostName"
      )
    )
  );

}

//call create post type
add_action('init','create_post_type');


//function to load CSS for theme
function loadCSS() {
  //load after WP admin files
  wp_enqueue_style( 'theme-style', get_template_directory_uri() . "/CSS/css.css");
}

//run script load CSS
add_action('wp_enqueue_scripts', 'loadCSS')

?>
