<?php  $generator_options = get_option( 'faster_theme_options' ); ?>
<footer class="footer-menu">
  <div class="container footer-menu no-padding">
	<div class="footer-div"><?php if ( is_active_sidebar( 'footer-1' ) ) {  dynamic_sidebar( 'footer-1' ); } ?></div>
    <div class="footer-div"><?php if ( is_active_sidebar( 'footer-2' ) ) {  dynamic_sidebar( 'footer-2' ); } ?></div>
    <div class="footer-div"> <?php if ( is_active_sidebar( 'footer-3' ) ) {  dynamic_sidebar( 'footer-3' ); } ?></div>
    <div class="footer-div"><?php if ( is_active_sidebar( 'footer-4' ) ) {  dynamic_sidebar( 'footer-4' ); } ?></div>
  </div>
  <div class="copyright col-lg-12">
    <div class="container container-generator">
      <div class="col-md-12 footer-margin-top text-center">
	  	<?php if(!empty($generator_options['footertext'])) {
			 	echo esc_attr($generator_options['footertext']).' '; 
			  }
		?>
		<span class='generator-poweredby'>
		<?php printf( __( 'Powered by %1$s.', 'generator' ), '<a href="http://fasterthemes.com/wordpress-themes/generator" target="_blank">Generator WordPress Theme</a>' ); ?>
		</span>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>