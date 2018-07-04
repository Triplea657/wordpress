<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
 */

?>	
		</div> <!-- .main-area -->

		<?php
		if ( ( ! is_front_page() || '1' == meditation_get_theme_mod( 'is_home_footer' )) && ! is_page_template( 'page-templates/no-content-footer.php' ) )
			get_sidebar('footer');
			 ?>
	
		<footer id="colophon" class="site-footer">
			<?php do_action('meditation_site_info'); ?>
		</footer><!-- #colophon -->
	</div><!-- #page -->
	<?php wp_footer(); ?>
</body>
</html>