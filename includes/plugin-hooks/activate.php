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
 * Process activation routines based on how the plugin is activated.
 *
 * @since  0.1.0
 * @access public
 * @param  bool $network_wide True if super admin uses "Network Activate".
 * @return void
 */
function heart_this_activate( $network_wide = false ) {
	_heart_this_hooks_handle_action( '_heart_this_activate', $network_wide );
}

/**
 * Fired when a new site is activated with a WPMU environment.
 *
 * @since  0.1.0
 * @access public
 * @param  int $blog_id ID of the new blog.
 * @return void
 */
function heart_this_activate_new_site( $blog_id ) {
	if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
		return;
	}

	switch_to_blog( $blog_id );
	_heart_this_activate();
	restore_current_blog();
}

/**
 * Set up the plugin's base options and store some data which may be useful
 * on upgrade.
 *
 * @since  0.1.0
 * @access protected
 * @return array $setup an array of default plugin setup options.
 */
function _heart_this_activate_setup_options() {
	$current = heart_this_get_options();
	$version = isset( $current['version'] ) ? $current['version'] : false;
	$options = array(
		'is_installed' => true,
	);

	if ( $version ) {
		$options['updated_from'] = $version;
	}
	$options['version'] = HEART_THIS_VERSION;

	return $options;
}

/**
 * Add or reset the plugin's default options.
 *
 * @since  0.1.0
 * @access protected
 * @param  array $options The options to be set.
 * @return bool true if options have been set, false otherwise.
 */
function _heart_this_activate_add_options( $options ) {
	if ( heart_this_add_options( $options, 'yes' ) ) {
		return true;
	}

	return heart_this_set_options( $options );
}

/**
 * Set up roles, options and required data on plugin activation.
 *
 * @since  0.1.0
 * @access protected
 * @return void
 */
function _heart_this_activate() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	_heart_this_activate_add_options( _heart_this_activate_setup_options() );
}
