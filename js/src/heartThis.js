/* global heartThis, cookie */

/**
 * Heart This Public JavaScript
 *
 * @copyright Copyright 2015, WP Site Care
 * @license   MIT
 */
( function( window, $, undefined ) {
	'use strict';

	var $hearts   = $( '.heart-this' ),
		cookieSuffix = '-heart-this-status',
		delay;

	cookie.defaults.expires = 999;
	cookie.defaults.path = '/';

	delay = (function() {
		var timer = 0;
		return function( callback, ms ) {
			clearTimeout ( timer );
			timer = setTimeout( callback, ms );
		};
	})();

	function setupHearts() {
		$hearts.each(function() {
			var $link    = $( this ),
				postID   = $link.data( 'post-id' ),
				cookieID = postID + cookieSuffix;

			if ( 'hearted' === cookie.get( cookieID ) ) {
				$link.addClass( 'active' );
			}

			if ( $( 'body' ).hasClass( 'ajax-heart-this' ) ) {
				$link.load( heartThis.ajaxURL, {
					action: 'heart-this',
					security: heartThis.ajaxNonce,
					postID: postID
				});
			}
		});
	}

	function handleClicks() {
		$hearts.on( 'click', function() {
			var $link    = $( this ),
				postID   = $link.data( 'post-id' ),
				cookieID = postID + cookieSuffix,
				$number  = $link.find( 'span' );

			if ( 'hearted' !== cookie.get( cookieID ) ) {
				cookie.set( cookieID, 'hearted' );
				$number.text( ( parseInt( $number.text(), 10 ) || 0 ) + 1 );
				$link.addClass( 'active' );
			} else {
				cookie.set( cookieID, 'unhearted' );
				$number.text( ( parseInt( $number.text(), 10 ) || 0 ) - 1 );
				$link.removeClass( 'active' );
			}

			delay( function() {
				$.post( heartThis.ajaxURL, {
					action: 'heart-this',
					security: heartThis.ajaxNonce,
					heartsID: postID,
					heartsValue: $number.text()
				} );
			}, 2000 );

			return false;
		});
	}

	// Document ready.
	$( document ).ready(function() {
		setupHearts();
		handleClicks();
	});
})( this, jQuery );
