<?php
/**
 * A custom widget to display popular posts based on heart counts.
 *
 * @package   HeartThis\Actions
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'heart-this' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php esc_html_e( 'Description:', 'heart-this' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo $instance['description']; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php esc_html_e( 'Posts:', 'heart-this' ); ?></label>
	<input id="<?php echo $this->get_field_id( 'posts' ); ?>" name="<?php echo $this->get_field_name( 'posts' ); ?>" type="number" min="1" value="<?php echo $instance['posts']; ?>" size="3" />
</p>
<p>
	<input id="<?php echo $this->get_field_id( 'display_count' ); ?>" name="<?php echo $this->get_field_name( 'display_count' ); ?>" type="checkbox" value="1" <?php checked( $instance['display_count'] ); ?>>
	<label for="<?php echo $this->get_field_id( 'display_count' ); ?>"><?php esc_html_e( 'Display like counts', 'heart-this' ); ?></label>
</p>
