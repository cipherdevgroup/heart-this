<?php
/**
 * Functions for registering and interacting with plugin settings.
 *
 * @package   HeartThis\Admin\Actions
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

/**
 * Register the plugin settings.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_admin_register_settings() {
	register_setting(
		'heart-this',
		heart_this_get_options_slug(),
		'heart_this_admin_settings_validate'
	);

	add_settings_section(
		'heart-this',
		'',
		'heart_this_admin_setting_section_intro',
		'heart-this'
	);

	add_settings_field(
		'show_on',
		__( 'Automatically enable on', 'heart-this' ),
		'heart_this_admin_setting_show_on',
		'heart-this',
		'heart-this'
	);

	add_settings_field(
		'enable_css',
		__( 'Enable CSS', 'heart-this' ),
		'heart_this_admin_setting_enable_css',
		'heart-this',
		'heart-this'
	);

	add_settings_field(
		'ajax_hearts',
		__( 'AJAX Like Counts', 'heart-this' ),
		'heart_this_admin_setting_ajax_hearts',
		'heart-this',
		'heart-this'
	);

	add_settings_field(
		'instructions',
		__( 'Shortcode and Template Tag', 'heart-this' ),
		'heart_this_admin_setting_instructions',
		'heart-this',
		'heart-this'
	);
}

/**
 * Add the plugin options page.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_admin_add_settings_page() {
	add_options_page(
		'HeartThis',
		'HeartThis',
		'update_core',
		'heart-this',
		'heart_this_admin_settings_page'
	);
}

/**
 * Output markup for the plugin settings page.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_admin_settings_page() {
	require_once HEART_THIS_DIR . 'admin/views/settings-page.php';
}

/**
 * Output markup for the plugin settings introduction.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_admin_setting_section_intro() {
	echo wpautop( esc_html__( 'HeartThis allows you to display like icons throughout your site. Customize the output of HeartThis with this settings page.', 'heart-this' ) );
}

/**
 * Return a list of potential display locations for hearts.
 *
 * @since  0.1.0
 * @access public
 * @return array A list of option values for when to show hearts.
 */
function heart_this_admin_get_show_option_values() {
	$shows = array_values( get_post_types( array( 'public' => true ) ) );
	array_unshift( $shows, 'index' );

	return $shows;
}

/**
 * Output markup for the plugin display settings.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_admin_setting_show_on() {
	$options_slug = heart_this_get_options_slug();
	$option       = (array) heart_this_get_option( 'show' );
	$name         = "{$options_slug}[show][]";

	require HEART_THIS_DIR . 'admin/views/setting-show-on.php';
}

/**
 * Output markup for the plugin CSS settings.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_admin_setting_enable_css() {
	$name = heart_this_get_options_slug() . '[enable_css]';
	$checked = 'yes' === heart_this_get_option( 'enable_css' ) ? ' checked="checked"' : '';

	require_once HEART_THIS_DIR . 'admin/views/setting-enable-css.php';
}

/**
 * Output markup for the plugin ajax settings.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_admin_setting_ajax_hearts() {
	$name = heart_this_get_options_slug() . '[ajax_hearts]';
	$checked = 'yes' === heart_this_get_option( 'ajax_hearts' ) ? ' checked="checked"' : '';

	require_once HEART_THIS_DIR . 'admin/views/setting-ajax-hearts.php';
}

/**
 * Output markup for the plugin usage instructions.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_admin_setting_instructions() {
	require_once HEART_THIS_DIR . 'admin/views/setting-instructions.php';
}

/**
 * Ensure only valid options are allowed for the show-on settings.
 *
 * @since  0.1.0
 * @access protected
 * @param  array $input The raw input.
 * @return array An array of validated and sanitized options.
 */
function _heart_this_admin_sanitize_show_options( $input ) {
	if ( empty( $input['show'] ) ) {
		return array();
	}

	foreach ( (array) $input['show'] as $key => $show ) {
		if ( ! in_array( $show, heart_this_admin_get_show_option_values(), true ) ) {
			unset( $input['show'][ $key ] );
		}
	}

	return $input['show'];
}

/**
 * Validate the settings.
 *
 * @since  0.1.0
 * @access public
 * @param  array $input The raw input.
 * @return array $input The validated input.
 */
function heart_this_admin_settings_validate( $input ) {
	foreach ( heart_this_get_default_options() as $key => $value ) {
		if ( 'show' === $key ) {
			continue;
		}

		if ( ! isset( $input[ $key ] ) ) {
			$input[ $key ] = 'no';
		}
	}

	foreach ( $input as $key => $value ) {
		if ( 'show' === $key ) {
			continue;
		}

		if ( 'yes' !== $value ) {
			$input[ $key ] = 'no';
		} else {
			$input[ $key ] = 'yes';
		}
	}

	$input['show'] = _heart_this_admin_sanitize_show_options( $input );

	return $input;
}
