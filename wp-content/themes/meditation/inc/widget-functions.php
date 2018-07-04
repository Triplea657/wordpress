<?php
/**
* Functions for displaying input fields in widget's admin panel
*
* @since Meditation 1.0.0
*/

/**
* Output checkbox
 *
 * @since Meditation 1.0.0
 *
 * @param WP_Widget $object widget object.
 * @param string $name widget option name.
 * @param array $instance Array of widget options.
 * @param string $title Title
*/
function meditation_echo_input_checkbox( $object, $name, $instance, $title ) { ?>
	<p>
		<input type="checkbox" name="<?php echo esc_attr( $object->get_field_name( $name ) ); ?>" id="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>"  value="1" <?php checked( $instance[ $name ], '1'); ?> />
		<label for="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>"><?php echo esc_html( $title ); ?></label>
	</p>
	<?php
}

/**
 * Output text field
 *
 * @since Meditation 1.0.0
 *
 * @param WP_Widget $object widget object.
 * @param string $name widget option name.
 * @param array $instance Array of widget options.
 * @param string $title Title
*/
function meditation_echo_input_text( $object, $name, $instance, $title ) { ?>
	<p>
		<label for="<?php echo esc_attr( $object->get_field_id( $name ) );?>"><?php echo esc_html(strtoupper( $title )); ?></label>
		<br>
		<input type="text" name="<?php echo esc_attr( $object->get_field_name( $name ) ); ?>" id="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>" value="<?php echo esc_attr( $instance[$name] ); ?>" />		
	</p>
	<hr>
	<?php
}
/**
 * Add button for selecting image id from media library
 *
 * @since Meditation 1.0.0
 *
 * @param WP_Widget $object widget object.
 * @param string $name widget option name.
 * @param array $instance Array of widget options.
 * @param string $title Title
*/
function meditation_echo_input_upload_id( $object, $name, $instance, $title ) { ?>
		<hr>
		<?php
		if( strpos( $instance[ $name ], 'http' ) !== false ) : ?>
			<img style="max-width:100%;" class="<?php echo esc_attr ( $object->get_field_id( $name ) ) . '_url'; ?>" src="<?php echo esc_url( $instance[ $name ] ); ?>" />
		<?php
		
		else : 
			$img = wp_get_attachment_image_src( $instance[ $name ] );
			if ( $img ) :
		?>
			<img style="max-width:100%;" class="<?php echo $object->get_field_id( $name ) . '_url'; ?>" src="<?php echo esc_attr( $img[0] ); ?>" />
		<?php
			else :
		?>
			<img class="<?php echo $object->get_field_id( $name ) . '_url'; ?>" src="" />
		<?php
			endif;
		endif; 
		
		$widget_id = str_replace( '-' . $name, '', $object->get_field_id( $name ) );
		$widget_id = substr( $widget_id, 7 );
		?>
			
		<br>
		
		<label for="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>"><?php esc_html_e( 'Image Url or Id:', 'meditation' ); ?></label>
		<input name="<?php echo esc_attr ( $object->get_field_name( $name ) ); ?>" id="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_attr( $instance[$name] ); ?>" />		
		<input id="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>_b" class="<?php echo esc_attr( $widget_id ); ?> upload_id_button button button-primary" type="button" value="<?php esc_html_e( 'Upload Image', 'meditation'); ?>" />
		<hr>
	<?php
}
/**
 * Add button for selecting image url from media library
 *
 * @since Meditation 1.0.0
 *
 * @param WP_Widget $object widget object.
 * @param string $name widget option name.
 * @param array $instance Array of widget options.
 * @param string $title Title
*/
function meditation_echo_input_upload( $object, $name, $instance, $title ) { ?>
	<hr>
		<?php if( trim($instance[$name]) != '' ) : ?>
			<img src="<?php echo esc_url(($instance[$name])); ?>" style="max-width:100%;" alt="<?php echo esc_attr_e('Upload', 'meditation'); ?>" />
		<?php endif; ?>
		
		<br>
		<label for="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>"><?php esc_html_e( 'Url:', 'meditation' ); ?></label>
		<input name="<?php echo esc_attr ($object->get_field_name( $name ) ); ?>" id="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $instance[$name] ); ?>" />		
		<input id="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>_b" class="upload_image_button button button-primary" type="button" value="<?php esc_html_e( 'Upload Image', 'meditation'); ?>" />
	<hr>
	<?php
}
/**
 * Output textarea field
 *
 * @since Meditation 1.0.0
 *
 * @param WP_Widget $object widget object.
 * @param string $name widget option name.
 * @param array $instance Array of widget options.
 * @param string $title Title
*/
function meditation_echo_input_textarea( $object, $name, $instance, $title, $rows=10, $cols=30 ) { ?>
	<p>
		<label for="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>"><?php echo esc_html($title); ?></label>
		<br>
		<textarea name="<?php echo esc_attr ($object->get_field_name( $name ) ); ?>" rows="<?php echo $rows;?>" id="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>"><?php echo esc_textarea($instance[$name]); ?></textarea>		
	</p>
	<?php
}

/**
 * Output start of section
 *
 * @since Meditation 1.0.0
 *
 * @param string $text Title
*/
function meditation_echo_section_start( $text, $id ) { ?>

	<div class="section-toggle <?php echo esc_attr( $id ); ?>"> <?php echo esc_html( $text ); ?></div>
	<div class="widget-section <?php echo esc_attr( $id ); ?>">	
	
	<?php
}
/**
 * Output end of section
 *
 * @since Meditation 1.0.0
 *
*/
function meditation_echo_section_end() { ?>
	</div>
	<?php
}

/**
 * Output start of section
 *
 * @since Meditation 1.0.0
 *
 * @param string $text Title
*/
function meditation_echo_section_main_start( $text, $id ) { ?>

	<div class="section-main-toggle <?php echo esc_attr( $id ); ?>"> <?php echo esc_html( $text ); ?></div>
	<div class="widget-main-section <?php echo esc_attr( $id ); ?>">	
	
	<?php
}
/**
 * Output end of section
 *
 * @since Meditation 1.0.0
 *
*/
function meditation_echo_section_main_end() { ?>
	</div>
	<?php
}
/**
 * Output color selection
 *
 * @since Meditation 1.0.0
 *
*/
function meditation_echo_input_color( $object, $name, $instance, $title, $def_color = '#fff') { ?>
	<p>
		<label for="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>"><?php echo esc_html( $title ); ?></label>
		<br>
		<input type="text" name="<?php echo  esc_attr ($object->get_field_name( $name ) );?>" id="<?php echo esc_attr ( $object->get_field_id( $name ) ); ?>" value="<?php echo esc_attr( $instance[ $name]  ); ?>" class="color-picker" data-default-color="<?php echo esc_attr( $def_color ); ?>" />		
	</p>
	<?php
}
