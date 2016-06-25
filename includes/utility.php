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
	$atts = shortcode_atts( array(), $atts );

	return heart_this_get_hearts();
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
 * @return bool
 */
function heart_this_get_meta( $post_id ) {
	return get_post_meta( $post_id, '_heart_this', true );
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
	return update_post_meta( $post_id, '_heart_this', $value );
}

/**
 * Set up post meta for posts that don't have it yet.
 *
 * @since  0.1.0
 * @access public
 * @param  int $post_id The current post ID.
 * @return void
 */
function heart_this_setup_hearts( $post_id ) {
	if ( is_numeric( $post_id ) ) {
		heart_this_add_meta( $post_id );
	}
}

/**
 * Check if a given post has been hearted.
 *
 * @since  0.1.0
 * @access public
 * @param  int $post_id The current post ID.
 * @return bool
 */
function heart_this_is_hearted( $post_id, $data = array() ) {
	if ( ! isset( $data['cookie'] ) ) {
		return false;
	}

	return isset( $_COOKIE[ $data['cookie'] ] ); // Input var okay.
}

function _heart_this_prepare_post_id( $raw_id ) {
	return str_replace( 'heart-this-', '', sanitize_key( $raw_id ) );
}

/**
 * Set the hearts count for a given post.
 *
 * @since  0.1.0
 * @access public
 * @param  array $data The data which contains the heart count.
 * @return int $hearts The number of hearts for a given post.
 */
function heart_this_set_hearts_count( $post_id, $data = array() ) {
	if ( ! is_numeric( $post_id ) ) {
		return;
	}

	$hearts = heart_this_get_meta( $post_id );

	if ( heart_this_is_hearted( $post_id, $data ) ) {
		$hearts--;
	} else {
		$hearts++;
	}

	heart_this_update_meta( $post_id, $hearts );

	return absint( $hearts );
}

/**
 * Get the hearts count for a given post.
 *
 * @since  0.1.0
 * @access public
 * @param  int $post_id The current post ID.
 * @return int $hearts The number of hearts for a given post.
 */
function heart_this_get_hearts_count( $post_id ) {
	if ( ! is_numeric( $post_id ) ) {
		return;
	}

	$hearts = heart_this_get_meta( $post_id );

	if ( ! $hearts ) {
		heart_this_add_meta( $post_id );
	}

	return absint( $hearts );
}
