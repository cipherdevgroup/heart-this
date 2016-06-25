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

	function handleClicks() {
		$hearts.on( 'click', function() {
			var $link = $( this ),
				data, cookieName;

			if ( $link.hasClass( 'active' ) ) {
				return false;
			}

			data = {
				action: 'heart-this',
				security: heartThis.ajaxNonce,
				heartsID: $link.attr( 'id' )
			};

			cookieName = data.heartsID;

			data.cookie = cookieName;

			$.post( heartThis.ajaxURL, data, function( data ) {
				var heart = cookie.get( cookieName );

				if ( ! heart ) {
					cookie.set( cookieName, data, {
						expires: 999
					});
				}

				heart = cookie.get( cookieName );

				console.log( data );

				$link.find( 'span' ).text( data );
				$link.addClass( 'active' );
			});

			return false;
		});
	}

	function maybeLoadHearts() {
		if ( $( 'body' ).hasClass( 'ajax-heart-this' ) ) {
			$hearts.each(function() {
				var $that = $( this ),
					id = $that.attr( 'id' );

				$that.load( heartThis.ajaxURL, {
					action: 'heart-this',
					postID: id
				});
			});
		}
	}

	// Document ready.
	$( document ).ready(function() {
		handleClicks();
		maybeLoadHearts();
	});
})( this, jQuery );
