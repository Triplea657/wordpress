<?php
if ( get_theme_mod( 'instagram_username' ) ) {
	the_widget( 'null_instagram_widget',
		array(
			'username'	=> esc_html( get_theme_mod( 'instagram_username' ) ),
			'number'	=> absint( get_theme_mod( 'instagram_number', 12 ) ),
			'size'		=> esc_attr( get_theme_mod( 'instagram_size', 'small' ) ),
			'target'	=> esc_attr( get_theme_mod( 'instagram_target', '_blank' ) ),
			'link'		=> esc_attr( get_theme_mod( 'instagram_text_link', __( 'Follow Me', 'olesya-lite' ) ) ),
		),
		array(
			'before_widget' => '<div class="instagram-footer">',
			'after_widget'  => '</div>'
		)
	);
} else {
	if ( is_customize_preview() ) {
		echo '<div class="instagram-footer not-visible"></div>';
	}
}
