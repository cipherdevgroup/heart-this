<?php
/**
 * A custom widget to display popular posts based on heart counts.
 *
 * @package   HeartThis\Widgets
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

/**
 * Widget to display posts by hearts popularity.
 */
class Heart_This_Popular_Posts extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in the child class' constructor.
	 *
	 * @var array
	 */
	protected $defaults;

	/**
	 * Register widget information and default settings.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function __construct( $id_base = false, $name = false, $widget_options = array(), $control_options = array() ) {
		$this->id_base = ( $id_base ) ? $id_base : 'heart-this-widget';
		$this->name    = ( $name ) ? $name : __( 'HeartThis - Popular Posts', 'heart-this' );

		$this->defaults = array(
			'title'         => __( 'Popular Posts', 'heart-this' ),
			'description'   => '',
			'posts'         => 1,
			'display_count' => 1,
		);

		$widget_options = wp_parse_args(
			$widget_options,
			array(
				'classname'   => 'heart-this-widget heart-this-popular-posts',
				'description' => __( 'Displays your most popular posts sorted by most liked', 'heart-this' ),
			)
		);

		$control_options = wp_parse_args( $control_options, array() );

		parent::__construct( $this->id_base, $this->name, $widget_options, $control_options );
	}

	/**
	 * Display the widget content.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * @param  array $instance The settings for the particular instance of the widget.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		$title = apply_filters( 'widget_title', $instance['title'], $this->id_base );
		$posts = empty( $instance['posts'] ) ? 1 : $instance['posts'];

		require HEART_THIS_DIR . 'includes/widgets/views/display-popular-posts.php';
	}

	/**
	 * Update a particular instance.
	 *
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $new_instance New settings for this instance as input by the user via form().
	 * @param  array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']         = wp_strip_all_tags( $new_instance['title'] );
		$instance['description']   = strip_tags( $new_instance['description'], '<a><b><strong><i><em><span>' );
		$instance['posts']         = empty( $new_instance['posts'] ) ? 1 : absint( $new_instance['posts'] );
		$instance['display_count'] = empty( $new_instance['display_count'] ) ? 0 : 1;

		return $instance;
	}

	/**
	 * Output a widget field ID.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  string $name The field name to be echoed.
	 * @return void
	 */
	public function field_id( $name ) {
		echo $this->get_field_id( $name );
	}

	/**
	 * Output a widget field name.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  string $name The field name to be echoed.
	 * @return void
	 */
	public function field_name( $name ) {
		echo $this->get_field_name( $name );
	}

	/**
	 * Load a template to display the widget form.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  array $instance The current widget form data.
	 * @return void
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		require HEART_THIS_DIR . 'includes/widgets/views/form-popular-posts.php';
	}
}
