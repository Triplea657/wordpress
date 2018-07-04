<?php
/**
 * Olesya User Profile Widget.
 *
 * @package Olesya_Lite
 */

/**
 * Olesya User Profile widget class.
 */
class Olesya_Lite_User_Profile_Widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor. Set the default widget options and create widget.
	 */
	function __construct() {

		$this->defaults = array(
			'title'          => '',
			'user'           => '',
			'page'           => '',
			'page_link_text' => __( 'Read More', 'olesya-lite' ),
		);

		$widget_ops = array(
			'classname'   => 'user-profile',
			'description' => __( 'Displays user profile block with Gravatar', 'olesya-lite' ),
			'customize_selective_refresh' => true,
		);

		$control_ops = array(
			'id_base' => 'olesya-lite-user-profile',
			'width'   => 200,
			'height'  => 250,
		);

		parent::__construct( 'olesya-lite-user-profile', '<code>*</code>' . __( 'Olesya User Profile', 'olesya-lite' ), $widget_ops, $control_ops );

	}

	/**
	 * Echo the widget content.
	 *
	 * @param array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {

		//* Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $args['before_widget'];

			if ( !empty( $instance['user'] ) ) {
				echo sprintf( '<div class="profile-avatar">%s</div>', get_avatar( $instance['user'], 256 ) );
			}

			if ( ! empty( $instance['title'] ) ){
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];
			}

			echo wpautop( esc_attr( get_the_author_meta( 'description', $instance['user'] ) ) );

			if ( ! empty( $instance['page'] ) && ! empty( $instance['page_link_text'] ) ) {
				echo sprintf( '<p class="widget-more-link"><a href="%s">%s</a></p>', get_page_link( $instance['page'] ), $instance['page_link_text'] );
			}


		echo $args['after_widget'];

	}

	/**
	 * Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via form()
	 * @param array $old_instance Old settings for this instance
	 * @return array Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {

		$new_instance['title']          = sanitize_text_field( $new_instance['title'] );
		$new_instance['user']			= sanitize_user( $new_instance['user'] );
		$new_instance['page']			= absint( $new_instance['page'] );
		$new_instance['page_link_text'] = sanitize_text_field( $new_instance['page_link_text'] );

		return $new_instance;

	}

	/**
	 * Echo the settings update form.
	 *
	 * @param array $instance Current settings
	 */
	function form( $instance ) {

		//* Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'olesya-lite' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'user' ) ); ?>"><?php _e( 'Select a user. The email address for this account will be used to pull the Gravatar image.', 'olesya-lite' ); ?></label><br />
			<?php wp_dropdown_users( array( 'who' => 'authors', 'name' => $this->get_field_name( 'user' ), 'selected' => $instance['user'] ) ); ?>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_name( 'page' ) ); ?>"><?php _e( 'Choose your extended "About Me" page from the list below. This will be the page linked to at the end of the about me section.', 'olesya-lite' ); ?></label><br />
			<?php wp_dropdown_pages( array( 'name' => $this->get_field_name( 'page' ), 'show_option_none' => __( 'None', 'olesya-lite' ), 'selected' => absint( $instance['page'] ) ) ); ?>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'page_link_text' ) ); ?>"><?php _e( 'Extended page link text', 'olesya-lite' ); ?>:</label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'page_link_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'page_link_text' ) ); ?>" value="<?php echo esc_attr( $instance['page_link_text'] ); ?>" class="widefat" />
		</p>

		<?php

	}

}
