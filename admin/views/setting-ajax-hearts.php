<?php
/**
 * Display a setting for enabling ajax heart count loading.
 *
 * @package   HeartThis\Admin\Views
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

?>
<label>
	<input type="checkbox" name="<?php echo $name; ?>" value="yes"<?php echo $checked; ?>>
	<?php esc_html_e( 'AJAX Heart Counts on page load', 'heart-this' ); ?>
</label>
<br>

<span class="description">
	<?php esc_html_e( 'If you are using a caching plugin, you may want to dynamically load the like counts via AJAX.', 'heart-this' ); ?>
</span>
