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

	function setupHearts() {
		$hearts.each(function() {
			var $link = $( this ),
				id = $link.attr( 'id' );

			if ( 'hearted' === cookie.get( id ) ) {
				$link.addClass( 'active' );
			}

			if ( $( 'body' ).hasClass( 'ajax-heart-this' ) ) {
				$link.load( heartThis.ajaxURL, {
					action: 'heart-this',
					security: heartThis.ajaxNonce,
					postID: id
				});
			}
		});
	}

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
				if ( 'hearted' !== cookie.get( cookieName ) ) {
					cookie.set( cookieName, 'hearted' );
					$link.find( 'span' ).text( data );
					$link.addClass( 'active' );
				}
			});

			return false;
		});
	}

	// Document ready.
	$( document ).ready(function() {
		setupHearts();
		handleClicks();
	});
})( this, jQuery );
