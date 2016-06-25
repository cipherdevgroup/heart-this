/* global heartThis, cookie */

/**
 * Heart This Public JavaScript
 *
 * @copyright Copyright 2015, WP Site Care
 * @license   MIT
 */
( function( window, $, undefined ) {
	'use strict';

	var $hearts = $( '.heart-this' );

	cookie.defaults.expires = 999;
	cookie.defaults.path = '/';

	function setupHearts() {
		$hearts.each(function() {
			var $link = $( this );

			if ( 'hearted' === cookie.get( $link.attr( 'id' ) ) ) {
				$link.addClass( 'active' );
			}

			if ( $( 'body' ).hasClass( 'ajax-heart-this' ) ) {
				$link.load( heartThis.ajaxURL, {
					action: 'heart-this',
					security: heartThis.ajaxNonce,
					postID: $link.data( 'post-id' )
				});
			}
		});
	}

	function handleClicks() {
		var delay = (function() {
			var timer = 0;
			return function( callback, ms ) {
				clearTimeout ( timer );
				timer = setTimeout( callback, ms );
			};
		})();

		$hearts.on( 'click', function() {
			var $link      = $( this ),
				cookieName = $link.attr( 'id' ),
				$number    = $link.find( 'span' );

			if ( 'hearted' !== cookie.get( cookieName ) ) {
				cookie.remove( cookieName );
				cookie.set( cookieName, 'hearted' );
				$number.text( ( parseInt( $number.text(), 10 ) || 0 ) + 1 );
				$link.addClass( 'active' );
			} else {
				cookie.remove( cookieName );
				cookie.set( cookieName, 'unhearted' );
				$number.text( ( parseInt( $number.text(), 10 ) || 0 ) - 1 );
				$link.removeClass( 'active' );
			}

			delay( function() {
				$.post( heartThis.ajaxURL, {
					action: 'heart-this',
					security: heartThis.ajaxNonce,
					heartsID: $link.data( 'post-id' ),
					heartsValue: $number.text()
				} );
			}, 1000 );

			return false;
		});
	}

	// Document ready.
	$( document ).ready(function() {
		setupHearts();
		handleClicks();
	});
})( this, jQuery );
