<?php
/**
 * Display a setting for enabling automatic button insertion on certain pages.
 *
 * @package    HeartThis\Admin\Views
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

?>
<label>
	<input type="checkbox" name="<?php echo $name; ?>" value="yes"<?php echo $checked; ?> >
	<?php echo esc_html( $label ); ?>
</label>
<br>
