<?php
/**
 * Plugin Name: HeartThis
 * Plugin URI:  https://github.com/wpsitecare/heart-this/
 * Description: Add a simple heart button to let people tell you they love your WordPress content.
 * Version:     0.1.0
 * Author:      WP Site Care
 * Author URI:  http://www.wpsitecare.com
 * License:     MIT
 * License URI: http://wpsitecare.mit-license.org/
 * Text Domain: heart-this
 * Domain Path: /languages
 *
 * @package    HeartThis
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * The current version of the plugin.
 *
 * @since 0.1.0
 */
define( 'HEART_THIS_VERSION', '0.1.0' );

/**
 * The absolute path to the root plugin file.
 *
 * @since 0.1.0
 */
define( 'HEART_THIS_FILE', __FILE__ );

/**
 * The absolute path to the plugin's root directory with a trailing slash.
 *
 * @since 0.1.0
 * @uses  plugin_dir_path()
 */
define( 'HEART_THIS_DIR', plugin_dir_path( __FILE__ ) );

/**
 * The absolute path to the plugin's root directory with a trailing slash.
 *
 * @since 0.1.0
 * @uses  plugin_dir_url()
 */
define( 'HEART_THIS_URI', plugin_dir_url( __FILE__ ) );

require_once HEART_THIS_DIR . 'includes/plugin-hooks/includes.php';
require_once HEART_THIS_DIR . 'includes/widgets/class-popular-posts.php';
require_once HEART_THIS_DIR . 'includes/language.php';
require_once HEART_THIS_DIR . 'includes/options.php';
require_once HEART_THIS_DIR . 'includes/output.php';
require_once HEART_THIS_DIR . 'includes/scripts.php';
require_once HEART_THIS_DIR . 'includes/utility.php';
require_once HEART_THIS_DIR . 'admin/settings.php';

add_action( 'plugins_loaded', 'heart_this' );
/**
 * Fire all of the actions, filters, and any other functionality kickoffs.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this() {
	require_once HEART_THIS_DIR . 'includes/init.php';
}

add_action( 'plugins_loaded', 'heart_this_admin' );
/**
 * Fire all of the admin actions, filters, and any other functionality kickoffs.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_admin() {
	if ( is_admin() ) {
		require_once HEART_THIS_DIR . 'admin/init.php';
	}
}
