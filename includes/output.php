<?php

function heart_this_the_content( $content ) {
	if ( is_page_template() ) {
		return $content;
	}

	global $wp_current_filter;

	if ( in_array( 'get_the_excerpt', (array) $wp_current_filter ) ) {
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

function heart_this_body_class( $classes ) {
	if ( 'yes' === heart_this_get_option( 'ajax_hearts' ) ) {
		$classes[] = 'ajax-heart-this';
	}

	return $classes;
}

function heart_this_get_hearts( $post_id = false ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	return sprintf( '<a href="#" class="heart-this" id="heart-this-%s"><span class="heart-this-count">%s</span></a>',
		$post_id,
		heart_this_get_hearts_count( $post_id )
	);
}

/**
 * Template Tag
 */
function heart_this_hearts( $post_id = false ) {
	echo heart_this_get_hearts( $post_id );
}
