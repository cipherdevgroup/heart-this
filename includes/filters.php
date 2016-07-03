<?php
/**
 * All default actions for the plugin.
 *
 * @package   HeartThis\Actions
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Callback defined in includes/scripts.php
 *
 * @see heart_this_the_content
 */
add_filter( 'the_content', 'heart_this_the_content' );

/**
 * Callback defined in includes/scripts.php
 *
 * @see heart_this_body_class
 */
add_filter( 'body_class', 'heart_this_body_class' );
