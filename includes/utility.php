<?php
/**
 * Functions for registering things and handling data.
 *
 * @package   HeartThis\Functions\Utility
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

/**
 * Register all widgets in the plugin.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_register_widgets() {
	register_widget( 'Heart_This_Popular_Posts' );
}

/**
 * Register the heart this shortcode.
 *
 * @since  0.1.0
 * @access public
 * @param  array $atts User-defined attributes.
 * @return string Formatted HTML for the heart_this shortcode.
 */
function heart_this_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'post_id' => false,
	), $atts );

	return heart_this_get_hearts( $atts['post_id'] );
}

/**
 * Add a body class when ajax heart loading is enabled.
 *
 * @since  0.1.0
 * @access public
 * @param  array $classes The existing body classes.
 * @return array $classes The updated body classes.
 */
function heart_this_body_class( $classes ) {
	if ( 'yes' === heart_this_get_option( 'ajax_hearts' ) ) {
		$classes[] = 'ajax-heart-this';
	}

	return $classes;
}

/**
 * Add the post meta value for hearts.
 *
 * @since  0.1.0
 * @access public
 * @param  int $post_id The current post ID.
 * @return bool
 */
function heart_this_add_meta( $post_id ) {
	return add_post_meta( $post_id, '_heart_this', 0, true );
}

/**
 * Get the post meta value for hearts.
 *
 * @since  0.1.0
 * @access public
 * @param  int $post_id The current post ID.
 * @return int
 */
function heart_this_get_meta( $post_id ) {
	$hearts = get_post_meta( $post_id, '_heart_this', true );

	if ( ! $hearts ) {
		heart_this_add_meta( $post_id );
	}

	return absint( $hearts );
}

/**
 * Update the post meta value for hearts.
 *
 * @since  0.1.0
 * @access public
 * @param  int $post_id The current post ID.
 * @param  int $value The value to be set.
 * @return bool
 */
function heart_this_update_meta( $post_id, $value ) {
	return (bool) update_post_meta( $post_id, '_heart_this', absint( $value ) );
}
