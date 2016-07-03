<?php
/**
 * Initialize and register all plugin hooks.
 *
 * @package   HeartThis\PluginHooks
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Callback defined in includes/plugin-hooks/activate.php
 *
 * @see heart_this_activate_new_site
 */
add_action( 'wpmu_new_blog', 'heart_this_activate_new_site' );

/**
 * Callback defined in includes/plugin-hooks/activate.php
 *
 * @see heart_this_activate
 */
register_activation_hook( HEART_THIS_FILE, 'heart_this_activate' );

/**
 * Callback defined in includes/plugin-hooks/deactivate.php
 *
 * @see heart_this_deactivate
 */
register_deactivation_hook( HEART_THIS_FILE, 'heart_this_deactivate' );

/**
 * Callback defined in includes/plugin-hooks/uninstall.php
 *
 * @see heart_this_uninstall
 */
register_uninstall_hook( HEART_THIS_FILE, 'heart_this_uninstall' );
