<?php
/**
 * Functions to display heart counts on the front end.
 *
 * @package   HeartThis\Functions\Output
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     0.1.0
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
		number_format_i18n( heart_this_get_meta( $post_id ) )
	);

	$output = sprintf( '<span class="heart-this-wrap">%s</span>', $output );

	/**
	 * Filters the returned HTML markup
	 *
	 * @param string  $output  HTML markup
	 * @param integer $post_id The post ID
	 */
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
 * Determine whether or not hearts should be automatically added.
 *
 * @since  0.1.0
 * @access public
 * @param  int $post_id The post ID to be checked.
 * @return bool True if hearts should be auto-shown, false otherwise.
 */
function heart_this_should_auto_show( $post_id ) {
	if ( is_feed() ) {
		return false;
	}

	$show    = false;
	$option  = (array) heart_this_get_option( 'show' );
	$type    = get_post_type();
	$is_type = in_array( $type, $option, true );

	if ( is_singular() ) {
		if ( $is_type ) {
			$show = true;
		}
	} elseif ( in_array( 'index', $option, true ) ) {
		if ( 'post' === $type ) {
			$is_type = true;
		}

		if ( ( is_home() || is_archive() || is_search() ) && $is_type ) {
			$show = true;
		}
	}

	/**
	 * Whether or not the heart should be added
	 *
	 * @param boolean $show     Whether or not it should be added
	 * @param integer $post_id  The post ID
	 */
	return (bool) apply_filters( 'heart_this_should_auto_show', $show, $post_id );
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

	global $post, $wp_current_filter;

	if ( empty( $post ) || is_preview() || is_admin() ) {
		return $content;
	}

	if ( in_array( 'get_the_excerpt', (array) $wp_current_filter, true ) ) {
		return $content;
	}

	// Prevent potential infinite loops.
	$done = false;
	foreach ( $wp_current_filter as $filter ) {
		if ( 'the_content' === $filter ) {
			if ( $done ) {
				return $content;
			} else {
				$done = true;
			}
		}
	}

	if ( heart_this_should_auto_show( $post->ID ) ) {
		$content .= heart_this_get_hearts();
	}

	return $content;
}
