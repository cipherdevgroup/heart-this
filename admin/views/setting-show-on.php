<?php
/**
 * Display a setting for enabling automatic button insertion on certain pages.
 *
 * @package   HeartThis\Admin\Views
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

?>
<?php $br = false; ?>

<?php foreach ( heart_this_admin_get_show_option_values() as $show ) : ?>
	<?php
	if ( 'index' === $show ) :
		$label = __( 'Blog Page, Archive Pages, and Search Results', 'heart-this' );
	else :
		$label = get_post_type_object( $show )->labels->name;
	endif;
	?>

	<?php if ( $br ) : ?>
		<br />
	<?php endif; ?>

	<label>
		<input type="checkbox"<?php checked( in_array( $show, $option, true ) ); ?> name="<?php echo $name; ?>" value="<?php echo esc_attr( $show ); ?>" /> <?php echo esc_html( $label ); ?>
	</label>

	<?php $br = true; ?>

<?php endforeach; ?>
