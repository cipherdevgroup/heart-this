<?php
/**
 * Functions to load translations for the plugin.
 *
 * @package   HeartThis\Functions\Languages
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

/**
 * Loads translation file.
 *
 * @since  0.1.0
 * @access public
 * @return bool true when the file was found, false otherwise.
 */
function heart_this_load_textdomain() {
	return load_plugin_textdomain(
		'heart-this',
		false,
		dirname( plugin_basename( HEART_THIS_FILE ) ) . '/languages'
	);
}

/**
 * Remove translations from memory.
 *
 * @since  0.1.0
 * @access public
 * @return bool true if the text domain was loaded, false if it was not.
 */
function heart_this_unload_textdomain() {
	return unload_textdomain( 'heart-this' );
}

/**
 * Whether or not the language has been loaded already.
 *
 * @since  0.1.0
 * @access public
 * @return bool
 */
function heart_this_is_textdomain_loaded() {
	return is_textdomain_loaded( 'heart-this' );
}
