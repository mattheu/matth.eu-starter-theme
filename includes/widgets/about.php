<?php

// register About User Widget
// add_action( 'widgets_init', create_function( '', 'register_widget( "MTF_About_User_Widget" );' ) );

add_action( 'widgets_init', function() {
	register_widget( "MTF_About_User_Widget" );
} );

/**
 * Adds Skype_Blog_Stay_In_Touch_Widget.
 */
class MTF_About_User_Widget extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'mtf_about_user_widget', // Base ID
			'About user',            // Name
			array( 'description' => 'User name, avatar & description.', )
		);

	}

	/**
	 * Front-end display of widget.
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$user_id = $instance['user_id'];

		?>

		<?php echo $before_widget; ?>

			<?php echo $before_title . $title . $after_title; ?>

			<?php echo get_avatar( $user_id, '130' ); ?>

			<p><?php echo the_author_meta( 'description', $user_id ); ?></p>

		<?php echo $after_widget;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['user_id'] = strip_tags( $new_instance['user_id'] );

		return $instance;

	}

	/**
	 * Admin widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	 public function form( $instance ) {

		$instance = wp_parse_args( $instance, array(
			'title' => 'About Me',
			'user_id' => 1
		) ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'user_id' ); ?>">User:</label>
			<select id="<?php echo $this->get_field_id( 'user_id' ); ?>" name="<?php echo $this->get_field_name( 'user_id' ); ?>">
				<?php
    			foreach ( get_users() as $user )
        			printf( '<option value="%d" %s>%s</option>', $user->ID, selected( $user->ID, $instance['user_id'], false ), $user->user_nicename );
    			?>
			</select>
		</p>

	<?php }

}
