<?php
/**
 * A custom widget to display popular posts based on heart counts.
 *
 * @package   HeartThis\Actions
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

/**
 * Widget to display posts by hearts popularity.
 */
class Heart_This_Popular_Posts extends WP_Widget {

	function __construct() {
		parent::__construct(
			'heart_this_widget',
			'Heart This - Popular Posts',
			array(
				'description' => __( 'Displays your most popular posts sorted by most liked', 'heart-this' ),
			)
		);
	}

	function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$posts = empty( $instance['posts'] ) ? 1 : $instance['posts'];

		require HEART_THIS_DIR . 'includes/widgets/display-popular-posts.php';
	}

	function update( $new_instance, $old_instance ) {
		$new_instance['title']         = wp_strip_all_tags( $new_instance['title'] );
		$new_instance['description']   = strip_tags( $new_instance['description'], '<a><b><strong><i><em><span>' );
		$new_instance['posts']         = wp_strip_all_tags( $new_instance['posts'] );
		$new_instance['display_count'] = wp_strip_all_tags( $new_instance['display_count'] );

		return $new_instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'         => __( 'Popular Posts', 'heart-this' ),
			'description'   => '',
			'posts'         => 5,
			'display_count' => 1,
		) );

		require HEART_THIS_DIR . 'includes/widgets/form-popular-posts.php';
	}
}
