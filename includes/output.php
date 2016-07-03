<?php
/**
 * Functions to display heart counts on the front end.
 *
 * @package    HeartThis\Functions\Output
 * @author     Robert Neu
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

/**
 * Return HTML markup to display the heart count and button for liking content.
 *
 * @since  0.1.0
 * @access public
 * @param  int $post_id The ID if the post to display hearts for.
 * @return string $hearts The formatted markup to display hearts.
 */
function heart_this_get_hearts( $post_id = false ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$output = sprintf( '<a href="#" class="heart-this" id="heart-this-%s" data-post-id="%s"><span>%s</span></a>',
		uniqid(),
		$post_id,
		heart_this_get_meta( $post_id )
	);

	$output = sprintf( '<span class="heart-this-wrap">%s</span>', $output );

	return apply_filters( 'heart_this_hearts', $output, $post_id );
}

/**
 * Output HTML markup to display the heart count and button for liking content.
 *
 * @since  0.1.0
 * @access public
 * @param  int $post_id The ID if the post to display hearts for.
 * @return void
 */
function heart_this_hearts( $post_id = false ) {
	echo heart_this_get_hearts( $post_id );
}

/**
 * Callback to filter the hearts output into the WordPress content.
 *
 * @since  0.1.0
 * @access public
 * @param  string $content The existing WordPress content.
 * @return string $content The updated WordPress content.
 */
function heart_this_the_content( $content ) {
	if ( is_page_template() ) {
		return $content;
	}

	global $wp_current_filter;

	if ( in_array( 'get_the_excerpt', (array) $wp_current_filter, true ) ) {
		return $content;
	}

	$options = heart_this_get_options();

	if ( is_singular( 'post' ) && 'yes' === $options['add_to_posts'] ) {
		$content .= heart_this_get_hearts();
	}

	if ( is_page() && ! is_front_page() && 'yes' === $options['add_to_pages'] ) {
		$content .= heart_this_get_hearts();
	}

	$is_other = is_front_page() || is_home() || is_category() || is_tag() || is_author() || is_date() || is_search();

	if ( $is_other && 'yes' === $options['add_to_other'] ) {
		$content .= heart_this_get_hearts();
	}

	return $content;
}
