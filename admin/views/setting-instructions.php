<?php
/**
 * Display instructions for using the plugin.
 *
 * @package   HeartThis\Admin\Views
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

?>
<p><?php esc_html_e( 'To use HeartThis in your posts and pages you can use the shortcode:', 'heart-this' ); ?></p>
<p><code>[heart_this_hearts]</code></p>
<p><?php esc_html_e( 'To use HeartThis manually in your theme template use the following PHP code:', 'heart-this' ); ?></p>
<p>
	<code>
		&lt;?php
		if ( function_exists( 'heart_this_hearts' ) ) {
			heart_this_hearts();
		}
		?&gt;
	</code>
</p>
