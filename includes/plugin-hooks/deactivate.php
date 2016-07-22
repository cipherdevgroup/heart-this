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
 * Process deactivation routines based on how the plugin is deactivated.
 *
 * @since  0.1.0
 * @access public
 * @param  bool $network_wide True if super admin uses "Network Deactivate".
 * @return void
 */
function heart_this_deactivate( $network_wide = false ) {
	_heart_this_hooks_handle_action( '_heart_this_deactivate', $network_wide );
}

/**
 * Remove unnecessary data on plugin deactivation.
 *
 * @since  0.1.0
 * @access protected
 * @return void
 */
function _heart_this_deactivate() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

}
