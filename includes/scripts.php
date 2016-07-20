<?php
/**
 * Functions for loading plugin scripts and styles.
 *
 * @package   HeartThis\Functions\Scripts
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

/**
 * Helper function for getting the script `.min` suffix for minified files.
 *
 * @since  0.1.0
 * @access public
 * @return string
 */
function heart_this_get_suffix() {
	static $suffix;

	if ( null === $suffix ) {
		$debug   = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;
		/**
		 * Whether or not to enable minified versions of styles and JavaScript files
		 *
		 * @param boolean $debug
		 */
		$enabled = (bool) apply_filters( 'heart_this_enable_suffix', ! $debug );
		$suffix  = $enabled ? '.min' : '';
	}

	return $suffix;
}

/**
 * Helper function to determine whether or not to load a packed version of
 * our JavaScript libraries on the front end.
 *
 * Developers can filter heart_this_enable_packed_js to false if they
 * are loading any of the following libraries in their theme or plugin:
 *
 * @since  0.1.0
 * @access protected
 * @return bool
 */
function _heart_this_enable_packed_js() {
	$suffix = heart_this_get_suffix();

	if ( empty( $suffix ) ) {
		return false;
	}

	/**
	 * Whether or not to enable the bundled JS
	 *
	 * @param boolean true
	 */
	return (bool) apply_filters( 'heart_this_enable_packed_js', true );
}

/**
 * Load all required CSS files on the front end.
 *
 * Developers can disable our CSS by filtering heart_this_load_css to
 * false within their theme or plugin.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_load_css() {
	$load = false;
	if ( 'yes' === heart_this_get_option( 'enable_css' ) ) {
		$load = true;
	}

	/**
	 * Whether or not to enable the bundled CSS
	 *
	 * @param boolean $load True or false value
	 */
	if ( ! (bool) apply_filters( 'heart_this_load_css', $load ) ) {
		return;
	}

	$suffix = heart_this_get_suffix();

	wp_enqueue_style(
		'heart-this',
		HEART_THIS_URI . "css/heart-this{$suffix}.css",
		array(),
		HEART_THIS_VERSION
	);
}

/**
 * Load all required JavaScript files on the front end.
 *
 * Developers can disable our JS by filtering heart_this_load_js to
 * false within their theme or plugin.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_load_js() {
	/**
	 * Whether or not to enable the bundled JS
	 *
	 * @param boolean true
	 */
	if ( ! apply_filters( 'heart_this_load_js', true ) ) {
		return;
	}

	if ( _heart_this_enable_packed_js() ) {
		heart_this_load_packed_js();
	} else {
		heart_this_load_unpacked_js();
	}

	wp_localize_script(
		'heart-this',
		'heartThis',
		array(
			'ajaxURL'   => admin_url( 'admin-ajax.php' ),
			'ajaxNonce' => wp_create_nonce( 'heart-this-get-set' ),
		)
	);
}

/**
 * Load the packed and minified version of our JavaScript files. This is the
 * preferred loading method as it saves us from adding a bunch of http
 * requests, but it could create conflicts with some plugins and themes.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_load_packed_js() {
	$suffix = heart_this_get_suffix();

	wp_enqueue_script(
		'heart-this',
		HEART_THIS_URI . "js/heartThis.pkgd{$suffix}.js",
		array( 'jquery' ),
		HEART_THIS_VERSION,
		true
	);
}

/**
 * Load all of our JS files individually to for maximum compatibility.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function heart_this_load_unpacked_js() {
	$suffix = heart_this_get_suffix();

	wp_enqueue_script(
		'cookie-js',
		HEART_THIS_URI . "js/src/vendor/cookie{$suffix}.js",
		array(),
		'1.2.0',
		true
	);

	wp_enqueue_script(
		'heart-this',
		HEART_THIS_URI . "js/src/heartThis{$suffix}.js",
		array( 'jquery', 'cookie-js' ),
		HEART_THIS_VERSION,
		true
	);
}

/**
 * Handle ajax requests from the front end.
 *
 * @since  0.1.0
 * @access public
 * @param  int $post_id The current post ID.
 * @return void
 */
function heart_this_ajax_callback( $post_id ) {
	check_ajax_referer( 'heart-this-get-set', 'security' );

	$data = wp_unslash( $_POST ); // Input var okay.

	if ( isset( $data['heartsID'] ) ) {
		heart_this_update_meta( absint( $data['heartsID'] ), $data['heartsValue'] );
		exit;
	}

	if ( isset( $data['postID'] ) ) {
		echo absint( heart_this_get_meta( absint( $data['postID'] ) ) );
		exit;
	}

	exit;
}
