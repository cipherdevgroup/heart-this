<?php
/**
 * A custom widget to display popular posts based on heart counts.
 *
 * @package   HeartThis\Widgets\Views
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

echo $args['before_widget'];

if ( ! empty( $title ) ) {
	echo $args['before_title'] . $title . $args['after_title'];
}

if ( ! empty( $instance['description'] ) ) {
	echo wpautop( $instance['description'] );
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
				number_format_i18n( heart_this_get_meta( $hearts_post->ID ) )
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
