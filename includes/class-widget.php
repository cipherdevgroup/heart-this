<?php
/**
 * A custom widget to display popular posts based on heart counts.
 *
 * @package   HeartThis\Actions
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

/**
 * Widget to display posts by hearts popularity.
 */
class Heart_This_Popular_Posts extends WP_Widget {

	function __construct() {
		parent::__construct(
			'heart_this_widget',
			'Heart This - Popular Posts',
			array(
				'description' => __( 'Displays your most popular posts sorted by most liked', 'heart-this' ),
			)
		);
	}

	function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$desc  = $instance['description'];
		$posts = empty( $instance['posts'] ) ? 1: $instance['posts'];

		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		if ( $desc ) {
			echo '<p>' . $desc . '</p>';
		}

		$hearts_posts = get_posts( array(
			'numberposts' => $posts,
			'orderby'     => 'meta_value_num',
			'order'       => 'DESC',
			'meta_key'    => '_heart_this',
			'post_type'   => 'post',
		) );

		if ( ! empty( $hearts_posts ) ) {

			$count_output = '';

			echo '<ul class="heart-this-popular-posts">';

			foreach ( $hearts_posts as $hearts_post ) {

				if ( $instance['display_count'] ) {
					$count_output = sprintf( ' <span class="heart-this-count">(%s)</span>',
						heart_this_get_meta( $hearts_post->ID )
					);
				}

				printf( '<li><a href="%s">%s</a>%s</li>',
					esc_url( get_permalink( $hearts_post->ID ) ),
					get_the_title( $hearts_post->ID ),
					$count_output
				);
			}

			echo '</ul>';

			wp_reset_postdata();
		}

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$new_instance['title']         = wp_strip_all_tags( $new_instance['title'] );
		$new_instance['description']   = strip_tags( $new_instance['description'], '<a><b><strong><i><em><span>' );
		$new_instance['posts']         = wp_strip_all_tags( $new_instance['posts'] );
		$new_instance['display_count'] = wp_strip_all_tags( $new_instance['display_count'] );

		return $new_instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'         => __( 'Popular Posts', 'heart-this' ),
			'description'   => '',
			'posts'         => 5,
			'display_count' => 1,
		) );

		$title         = $instance['title'];
		$description   = $instance['description'];
		$posts         = $instance['posts'];
		$display_count = $instance['display_count'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'heart-this' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php esc_html_e( 'Description:', 'heart-this' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo $description; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts' ); ?>"><?php esc_html_e( 'Posts:', 'heart-this' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'posts' ); ?>" name="<?php echo $this->get_field_name( 'posts' ); ?>" type="text" value="<?php echo $posts; ?>" size="3" />
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'display_count' ); ?>" name="<?php echo $this->get_field_name( 'display_count' ); ?>" type="checkbox" value="1" <?php checked( $display_count ); ?>>
			<label for="<?php echo $this->get_field_id( 'display_count' ); ?>"><?php esc_html_e( 'Display like counts', 'heart-this' ); ?></label>
		</p>
		<?php
	}
}
