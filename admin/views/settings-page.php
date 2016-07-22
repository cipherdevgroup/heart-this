<?php
/**
 * Display the main settings page.
 *
 * @package   HeartThis\Admin\Views
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

?>
<div class="wrap">
	<h1><?php esc_html_e( 'HeartThis Settings', 'heart-this' ); ?></h2>
	<form action="options.php" method="post">
		<?php settings_fields( 'heart-this' ); ?>
		<?php do_settings_sections( 'heart-this' ); ?>
		<?php submit_button(); ?>
	</form>
</div>
