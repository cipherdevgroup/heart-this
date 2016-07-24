<?php
/**
 * Functions for getting and setting plugin options data.
 *
 * @package   HeartThis\Functions\Options
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

/**
 * Retrieve the plugin options slug.
 *
 * @since  0.1.0
 * @access public
 * @return string the plugin options slug.
 */
function heart_this_get_options_slug() {
	return 'heart_this_options';
}

/**
 * Retrieve the main plugin options.
 *
 * @since  0.1.0
 * @access public
 * @return array an array of all the main plugin options.
 */
function heart_this_get_default_options() {
	return array(
		'show'        => array( 'post' ),
		'enable_css'  => 'yes',
		'ajax_hearts' => defined( 'WP_CACHE' ) && WP_CACHE ? 'yes' : 'no',
	);
}

/**
 * Retrieve the main plugin options.
 *
 * @since  0.1.0
 * @access public
 * @return array an array of all the main plugin options.
 */
function heart_this_get_options() {
	static $options;

	if ( null === $options ) {
		$options = get_option( heart_this_get_options_slug(), heart_this_get_default_options() );
		$options = array_merge( heart_this_get_default_options(), (array) $options );
	}

	return $options;
}

/**
 * Add the main plugin options if they haven't been added yet.
 *
 * @since  0.1.0
 * @access public
 * @param  mixed  $value The value to be added.
 * @param  string $autoload Whether or not to auto-load option into memory.
 * @return array an array of all the main plugin options.
 */
function heart_this_add_options( $value, $autoload = 'no' ) {
	$options = heart_this_get_options();
	if ( empty( $options ) ) {
		return add_option( heart_this_get_options_slug(), $value, '', $autoload );
	}
	return false;
}

/**
 * Set the main plugin options by merging an array of new values in with
 * the old.
 *
 * @since  0.1.0
 * @access public
 * @param  mixed $value The value to be set.
 * @return array an array of all the main plugin options.
 */
function heart_this_set_options( $value ) {
	return update_option(
		heart_this_get_options_slug(),
		array_merge( heart_this_get_options(), (array) $value )
	);
}

/**
 * Delete all of the main plugin options.
 *
 * @since  0.1.0
 * @access public
 * @return array an array of all the main plugin options.
 */
function heart_this_delete_options() {
	return delete_option( heart_this_get_options_slug() );
}

/**
 * Get an option from within the main plugin options array.
 *
 * @since  0.1.0
 * @access public
 * @param  string $slug The slug of the option to get.
 * @return mixed The option value if it exists, false otherwise.
 */
function heart_this_get_option( $slug ) {
	$options = heart_this_get_options();
	return isset( $options[ $slug ] ) ? $options[ $slug ] : false;
}

/**
 * Set an option within the main plugin options array.
 *
 * @since  0.1.0
 * @access public
 * @param  string $slug The slug of the option to set.
 * @param  mixed  $value The value to be set.
 * @return bool True if the option has been set.
 */
function heart_this_set_option( $slug, $value ) {
	return update_option(
		heart_this_get_options_slug(),
		array_merge( heart_this_get_options(), array( $slug => $value ) )
	);
}

/**
 * Delete an option from the main plugin options array.
 *
 * @since  0.1.0
 * @access public
 * @param  string $slug The slug of the option to delete.
 * @return bool True if the option has been deleted.
 */
function heart_this_delete_option( $slug ) {
	$options = heart_this_get_options();
	unset( $options[ $slug ] );

	return update_option(
		heart_this_get_options_slug(),
		$options
	);
}
