<?php
/**
 * All default actions for the plugin.
 *
 * @package   HeartThis\Admin\Actions
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Callback defined in includes/language.php
 *
 * @see heart_this_load_textdomain
 */
add_action( 'admin_init', 'heart_this_load_textdomain' );

/**
 * Callback defined in admin/settings.php
 *
 * @see heart_this_admin_register_settings
 */
add_action( 'admin_init', 'heart_this_admin_register_settings' );

/**
 * Callback defined in admin/settings.php
 *
 * @see heart_this_admin_add_settings_page
 */
add_action( 'admin_menu', 'heart_this_admin_add_settings_page' );
