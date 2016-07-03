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

require_once HEART_THIS_DIR . 'includes/plugin-hooks/common.php';
require_once HEART_THIS_DIR . 'includes/plugin-hooks/activate.php';
require_once HEART_THIS_DIR . 'includes/plugin-hooks/deactivate.php';
require_once HEART_THIS_DIR . 'includes/plugin-hooks/uninstall.php';
require_once HEART_THIS_DIR . 'includes/plugin-hooks/init.php';
