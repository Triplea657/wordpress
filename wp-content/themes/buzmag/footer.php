<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package buzmag
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <div class="bottom-footer">
            <div class="bm-container">
        		<div class="site-info">
        			<div class="footer-copyright">
                        <span class="copyright-text"><?php echo wp_kses_post( get_theme_mod( 'buzmag_footer_copyright_text'));?></span>
            			<span class="sep"> | </span>
            			<?php printf( esc_html__( 'Buzmag By %1$s.', 'buzmag' ), '<a href="'.esc_url( 'https://buzthemes.com' ).'" rel="designer">'.esc_html__('Buzthemes', 'buzmag').'</a>' ); ?>
    	           </div><!-- .site-info -->
        		</div><!-- .site-info -->
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php
$buzmag_go_top_enable_disable = get_theme_mod('buzmag_go_top_enable_disable');
if($buzmag_go_top_enable_disable == 'enable'){ ?>
    <div id="bm-go-top" class="bm-on"><i class="fa fa-angle-up" aria-hidden="true"></i></div>
<?php } ?>
<div id="dynamic-css"></div>
<?php wp_footer(); ?>

</body>
</html>
