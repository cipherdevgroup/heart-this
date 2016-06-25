<?php
/**
 * Kick off all actions, filters, and other functionality initialization.
 *
 * @package    HeartThis\Functions\Init
 * @author     Robert Neu
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Provide reliable access to the plugin's functions and methods before
 * the plugin's global actions, filters, and functionality are initialized.
 *
 * @since  0.1.0
 * @access public
 */
do_action( 'heart_this_before_init' );

require_once HEART_THIS_DIR . 'includes/actions.php';
require_once HEART_THIS_DIR . 'includes/filters.php';
require_once HEART_THIS_DIR . 'includes/register.php';

/**
 * Provide reliable access to the plugin's functions and methods after
 * the plugin's global actions, filters, and functionality are initialized.
 *
 * @since  0.1.0
 * @access public
 */
do_action( 'heart_this_after_init' );