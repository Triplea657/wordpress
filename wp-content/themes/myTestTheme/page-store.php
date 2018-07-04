<?php define( 'WP_USE_THEMES', false); get_header(); ?>




  <body>

    <!--header 1-->
    <h1>
      <?php
        //return site title
        echo get_bloginfo('title');
       ?>
    </h1>

    <!--header 2-->
    <h2>
      <?php
        //return site description
        echo get_bloginfo('description');
       ?>
    </h2>

    <!---->
    <?php
      //
      $customPostQuery = array(
        'post_type' => 'customPostType',
        'post_status' => 'publish'
      );
      //function getCustomPosts query gets custom posts
      $getCustomPosts = new WP_Query($customPostQuery);
    ?>

    <!-- begin php loop -->
    <?php if( $getCustomPosts->have_posts() ): //if any posts belonging to $getCustomPosts
        while($getCustomPosts->have_posts() ): $getCustomPosts->the_post(); //while has posts, begin while loop
    ?>

    <!-- Loop this -->
    <h3>
      <a href="<?php the_permalink(); ?>">
        <?php
          //title info on main page
          the_title();
        ?>
      </a>
    </h3>
    <?php
      the_content();
    ?>

  <!-- end php loop -->
  <?php
    endwhile; else: //end while loop
  ?>
  <p>
    <?php //if no posts matched
      esc_html_e('Sorry, no posts matched your criteria.');
    ?>
  </p>
  <?php endif; ?>
  <!--end php loop-->

  </body>
</html>
