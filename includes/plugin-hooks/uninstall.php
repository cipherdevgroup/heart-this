<?php
/**
 * HeartThis activation, deactivation, and uninstall hooks.
 *
 * @package   HeartThis\PluginHooks
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

/**
 * Clean up all leftover roles, options, and data on plugin removal.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_uninstall() {
	_heart_this_hooks_handle_action( '_heart_this_uninstall', true );
}

/**
 * Clean up all leftover roles, options, and data on plugin removal.
 *
 * @since  0.1.0
 * @access protected
 * @return void
 */
function _heart_this_uninstall() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	heart_this_delete_options();
}
