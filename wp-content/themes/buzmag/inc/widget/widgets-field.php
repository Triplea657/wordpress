<?php
/**
 * Define fields for Widgets.
 * 
 * @package buzmag
 */

function buzmag_widgets_show_widget_field( $instance = '', $widget_field = '', $athm_field_value = '' ) {
	$buzmag_pagelist[0] = array(
        'value' => 0,
        'label' => esc_html__('--choose--','buzmag')
    );
    $arg = array('posts_per_page'   => -1);
    $buzmag_pages = get_pages($arg);
    foreach($buzmag_pages as $buzmag_page) :
        $buzmag_pagelist[$buzmag_page->ID] = array(
            'value' => $buzmag_page->ID,
            'label' => $buzmag_page->post_title
        );
    endforeach;
    //print_r($widget_field);
	extract( $widget_field );
	
	switch( $buzmag_widgets_field_type ) {
	
		// Standard text field
		case 'text' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $buzmag_widgets_name )); ?>"><?php echo esc_html($buzmag_widgets_title); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($instance->get_field_id( $buzmag_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $buzmag_widgets_name )); ?>" type="text" value="<?php echo esc_attr($athm_field_value); ?>" />
				
				<?php if( isset( $buzmag_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($buzmag_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;

		// Textarea field
		case 'textarea' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $buzmag_widgets_name )); ?>"><?php echo esc_html($buzmag_widgets_title); ?>:</label>
				<textarea class="widefat" rows="6" id="<?php echo esc_attr($instance->get_field_id( $buzmag_widgets_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $buzmag_widgets_name )); ?>"><?php echo esc_html($athm_field_value); ?></textarea>
			</p>
			<?php
			break;
            
		//Multi checkboxes
        case 'multicheckboxes' :
            
            if( isset( $buzmag_widgets_title ) ) { ?>
                <label><?php echo esc_html( $buzmag_widgets_title ); ?>:</label>
            <?php }
            
            echo '<div class="buzmag-multiple-checkbox">';
                foreach ( $buzmag_widgets_field_options as $athm_option_name => $athm_option_title) {
                    if( isset( $athm_field_value[$athm_option_name] ) ) {
                        $athm_field_value[$athm_option_name] = 1;
                    }else{
                        $athm_field_value[$athm_option_name] = 0;
                    } ?>
                    
                    <p>
                        <input id="<?php echo esc_attr( $instance->get_field_id( $buzmag_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $buzmag_widgets_name ) ).'['.esc_attr( $athm_option_name ).']'; ?>" type="checkbox" value="1" <?php checked('1', $athm_field_value[$athm_option_name]); ?>/>
                        <label for="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>"><?php echo esc_html( $athm_option_title ); ?></label>
                    </p>
                <?php }
            echo '</div>';
            
            if (isset($buzmag_widgets_description)) { ?>
                    <small><em><?php echo esc_html($buzmag_widgets_description); ?></em></small>
            <?php }
            
        break;
                        
		// Radio fields
		case 'radio' : ?>
			<p>
				<?php
				echo esc_attr($buzmag_widgets_title); 
				echo '<br />';
				foreach( $buzmag_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
					<input id="<?php echo esc_attr($instance->get_field_id( $athm_option_name )); ?>" name="<?php echo esc_attr($instance->get_field_name( $buzmag_widgets_name )); ?>" type="radio" value="<?php echo esc_attr($athm_option_name); ?>" <?php checked( $athm_option_name, $athm_field_value ); ?> />
					<label for="<?php echo esc_attr($instance->get_field_id( $athm_option_name )); ?>"><?php echo esc_html($athm_option_title); ?></label>
					<br />
				<?php } ?>
				
				<?php if( isset( $buzmag_widgets_description ) ) { ?>
				<small><?php echo esc_html($buzmag_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		// Select field
		case 'select' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $buzmag_widgets_name )); ?>"><?php echo esc_html($buzmag_widgets_title); ?>:</label>
				<select name="<?php echo esc_attr($instance->get_field_name( $buzmag_widgets_name )); ?>" id="<?php echo esc_attr($instance->get_field_id( $buzmag_widgets_name )); ?>" class="widefat">
					<?php
					foreach ( $buzmag_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
						<option value="<?php echo esc_attr($athm_option_name); ?>" id="<?php echo esc_attr($instance->get_field_id( $athm_option_name )); ?>" <?php selected( $athm_option_name, $athm_field_value ); ?>><?php echo esc_html($athm_option_title); ?></option>
					<?php } ?>
				</select>

				<?php if( isset( $buzmag_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($buzmag_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
			
		case 'number' : ?>
			<p>
				<label for="<?php echo esc_attr($instance->get_field_id( $buzmag_widgets_name )); ?>"><?php echo esc_html($buzmag_widgets_title); ?>:</label><br />
				<input name="<?php echo esc_attr($instance->get_field_name( $buzmag_widgets_name )); ?>" type="number" step="1" min="1" id="<?php echo esc_attr($instance->get_field_id( $buzmag_widgets_name )); ?>" value="<?php echo esc_attr($athm_field_value); ?>" class="small-text" />
				
				<?php if( isset( $buzmag_widgets_description ) ) { ?>
				<br />
				<small><?php echo esc_html($buzmag_widgets_description); ?></small>
				<?php } ?>
			</p>
			<?php
			break;
        
	}
	
}

function buzmag_widgets_updated_field_value( $widget_field, $new_field_value ) {
    
	extract( $widget_field );
	
	// Allow only integers in number fields
	if( $buzmag_widgets_field_type == 'number' ) {
		return absint( $new_field_value );
	}
    elseif ($buzmag_widgets_field_type == 'multicheckboxes') {
         return wp_kses_post($new_field_value);
    } 
    elseif( $buzmag_widgets_field_type == 'textarea' ) {
        
		if( !isset( $buzmag_widgets_allowed_tags ) ) {
			$buzmag_widgets_allowed_tags = '<p><strong><em><a>';
		}
		return strip_tags( $new_field_value, $buzmag_widgets_allowed_tags );
		
	}
    else {
		return strip_tags( $new_field_value );
	}

}