<?php
/**
 * Common functionality shared between plugin activation, deactivation, and
 * uninstall hooks.
 *
 * @package   HeartThis\PluginHooks
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

/**
 * Get all blog ids of blogs in the current network which are not
 * archived, spam, or deleted.
 *
 * @since  0.1.0
 * @access protected
 * @return array|false The blog ids, false if no matches.
 */
function _heart_this_get_blog_ids() {
	global $wpdb;
	// Get an array of blog ids.
	$sql = "SELECT blog_id FROM $wpdb->blogs
		WHERE archived = '0' AND spam = '0'
		AND deleted = '0'";

	return $wpdb->get_col( $sql );
}

/**
 * Process plugin action routines based on how the action is called.
 *
 * @since  0.1.0
 * @access public
 * @param  string $action the plugin hook action to be handled.
 * @param  bool   $network_wide True if super admin uses a "Network" action.
 * @return void
 */
function _heart_this_hooks_handle_action( $action, $network_wide ) {
	if ( ! function_exists( $action ) ) {
		return;
	}

	if ( is_multisite() ) {

		if ( ! $network_wide ) {
			$action();
			return;
		}

		foreach ( _heart_this_get_blog_ids() as $blog_id ) {
			switch_to_blog( $blog_id );
			$action();
			restore_current_blog();
		}
	} else {
		$action();
	}
}
