<?php
/**
 * Display a setting for enabling the default plugin CSS.
 *
 * @package   HeartThis\Admin\Views
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

?>
<label>
	<input type="checkbox" name="<?php echo $name; ?>" value="yes"<?php echo $checked; ?> >
	<?php esc_html_e( 'Load the default plugin styles.', 'heart-this' ); ?>
</label>
<br>
