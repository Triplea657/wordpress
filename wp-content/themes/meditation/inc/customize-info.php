<?php
/**
 * Add new fields to customizer, create panel 'Info'
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @since Meditation 1.0.0
 */
 
function meditation_customize_register_info( $wp_customize ) {

	class Meditation_Customize_Button_Control extends WP_Customize_Control {
		public $type = 'button';
	 
		/**
		 * Render the control's content.
		 *
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 *
		 * @since Meditation 1.0.0
		 */
		public function render_content() {
			?>
			<form>
			<input type="button" value="<?php echo esc_attr( $this->label ); ?>" onclick="window.open('<?php echo esc_js( $this->value() ); ?>')" />
			</form>
			<?php
		}
	}

	class Meditation_Customize_Donate_Control extends WP_Customize_Control {
		public $type = 'donate';
	 
		/**
		 * Render the control's content.
		 *
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 *
		 * @since Meditation 1.1.0
		 */
		public function render_content() {
			?>
			<p>
			<?php
				if ( ! is_child_theme() ) {
					_e( 'Hi! Thank you for using Meditation! You can support this free theme and help to improve it.', 'meditation' );
				} elseif ( defined( 'LIVEPORTFOLIO_VERSION' ) ) {
					_e( 'You can support this free theme and help to improve it.', 'meditation' );
				} elseif ( defined( 'CUSTOMLITE_VERSION' ) ) {
					_e( 'If you like this Theme and found it usefull you can say "Thank you" to the author. This is greatly appreciated! Anyway, this is a free theme and this option is optional.', 'meditation' );
				}
			?>
			</p>
			<?php if ( ! is_child_theme() ) : ?>	
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
				">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/ru_RU/i/scr/pixel.gif" width="1" height="1">
				</form>
				
			<?php elseif ( defined( 'LIVEPORTFOLIO_VERSION' ) ) : ?>
			
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
				">
				<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/ru_RU/i/scr/pixel.gif" width="1" height="1">
				</form>
			<?php elseif ( defined( 'CUSTOMLITE_VERSION' ) ) : ?>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
				">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/ru_RU/i/scr/pixel.gif" width="1" height="1">
				</form>
			<?php endif; ?>
			<p>
			<?php

		}
	}

	$defaults = meditation_get_defaults();
	
	$wp_customize->add_section( 'donate', array(
		'title'          => __( 'Donate', 'meditation' ),
		'priority'       => 0,
	) );
	
	$wp_customize->add_setting( 'donate', array(
		'type'			 => 'empty',
		'default'        => '',
		'sanitize_callback' => 'Meditation_sanitize_url'
	) );
	
	$wp_customize->add_control( new Meditation_Customize_Donate_Control( $wp_customize, 'donate', array(
		'label'   => __( 'Donate', 'meditation' ),
		'description'   => __( 'Donate', 'meditation' ),
		'section' => 'donate',
		'settings'   => 'donate',
		'priority'   => 1,
	) ) );

}
add_action( 'customize_register', 'meditation_customize_register_info' );