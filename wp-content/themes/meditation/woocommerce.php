<?php
/**
 * The template for displaying woocommerce archive pages.
 *
 * @package WordPress
 * @subpackage meditation
 * @since Meditation 1.0.0
 */
get_header(); 

$meditation_layout_name = ( is_shop() || is_archive() ? 'layout_shop' : 'layout_shop-page' );
$meditation_layout = meditation_get_theme_mod( $meditation_layout_name );
global $woocommerce_loop;
$meditation_columns = 4;

if ( ! empty( $woocommerce_loop['columns'] ) )
	$meditation_columns = apply_filters( 'loop_shop_columns', 4 );
if ( is_singular() )
	$meditation_columns = 0;
?>

<div class="main-wrapper woo-shop <?php echo esc_attr($meditation_layout); ?> flex-layout-<?php echo esc_attr( $meditation_columns ); ?>">

	<div class="site-content"> 
		<div class="content"> 
			<?php if ( is_singular() ) : ?>
			<div class="content-container">
			<?php endif; ?>
	
					<?php woocommerce_breadcrumb(); ?>
					<?php woocommerce_content(); ?>
					<?php do_action( 'meditation_after_content' ); ?>	

			<?php if ( is_singular() ) : ?>
			</div><!-- .content-container -->
			<?php endif; ?>

		</div><!-- .content -->
	</div><!-- .site-content -->
	<?php meditation_get_sidebar( $meditation_layout ); ?>

</div> <!-- .main-wrapper.woo-shop -->

<?php
get_footer();
