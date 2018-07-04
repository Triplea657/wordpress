<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Olesya_Lite
 */

?>

	</div><!-- #content -->

	<?php get_sidebar( 'footer' );?>

	<?php if ( has_nav_menu ( 'social' ) ) : ?>
		<div class="social-links">
		<?php wp_nav_menu( array(
			'theme_location' 	=> 'social',
			'depth' 			=> 1,
			'link_before' 		=> '<span>',
			'link_after' 		=> '</span>',
			'container_class' 	=> 'wrap',
		) ); ?>
		</div>
	<?php endif; ?>

	<?php olesya_lite_do_instagram_footer();?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrap">
			<p class="footer-credits">
				<?php olesya_lite_do_footer_copyright();?>
			</p>
			<a href="#page" class="back-to-top"><?php echo __( 'Back to top', 'olesya-lite' );?> <span class="fa fa-chevron-up"></span></a>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
