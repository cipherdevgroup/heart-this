<?php
/**
 * Kick off all actions, filters, and other functionality initialization.
 *
 * @package    HeartThis\Functions\Init
 * @author     Robert Neu
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Callback defined in includes/utility.php
 *
 * @see heart_this_shortcode
 */
add_shortcode( 'heart_this', 'heart_this_shortcode' );
