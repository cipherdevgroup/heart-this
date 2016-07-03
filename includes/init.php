<?php
/**
 * Kick off all actions, filters, and other functionality initialization.
 *
 * @package   HeartThis\Functions\Init
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Provide reliable access to the plugin's functions and methods before
 * the plugin's global actions, filters, and functionality are initialized.
 *
 * @since  0.1.0
 * @access public
 */
do_action( 'heart_this_before_init' );

require_once HEART_THIS_DIR . 'includes/actions.php';
require_once HEART_THIS_DIR . 'includes/filters.php';

/**
 * Callback defined in includes/utility.php
 *
 * @see heart_this_shortcode
 */
add_shortcode( 'heart_this', 'heart_this_shortcode' );

/**
 * Provide reliable access to the plugin's functions and methods after
 * the plugin's global actions, filters, and functionality are initialized.
 *
 * @since  0.1.0
 * @access public
 */
do_action( 'heart_this_after_init' );
