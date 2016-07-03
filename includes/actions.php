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
 * @see heart_this_load_css
 */
add_action( 'wp_enqueue_scripts', 'heart_this_load_css', 20 );

/**
 * Callback defined in includes/scripts.php
 *
 * @see heart_this_load_js
 */
add_action( 'wp_enqueue_scripts', 'heart_this_load_js',  20 );

/**
 * Callback defined in includes/utility.php
 *
 * @see heart_this_register_widgets
 */
add_action( 'widgets_init', 'heart_this_register_widgets' );

/**
 * Callback defined in includes/utility.php
 *
 * @see heart_this_add_meta
 */
add_action( 'publish_post', 'heart_this_add_meta' );

/**
 * Callback defined in includes/utility.php
 *
 * @see heart_this_ajax_callback
 */
add_action( 'wp_ajax_heart-this', 'heart_this_ajax_callback' );

/**
 * Callback defined in includes/utility.php
 *
 * @see heart_this_ajax_callback
 */
add_action( 'wp_ajax_nopriv_heart-this', 'heart_this_ajax_callback' );
