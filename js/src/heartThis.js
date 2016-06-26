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

	function updateNumber( $number, $object, cookieID ) {
		var currentNumber = ( parseInt( $number.text(), 10 ) || 0 );

		if ( 'hearted' !== cookie.get( cookieID ) ) {
			cookie.set( cookieID, 'hearted' );
			$number.text( currentNumber + 1 );
			$object.addClass( 'active is-animating' );
		} else {
			cookie.set( cookieID, 'unhearted' );
			$number.text( currentNumber - 1 );
			$object.removeClass( 'active' );
		}

		return $number;
	}

	function handleClicks() {
		$hearts.on( 'click touchstart', function() {
			var $link    = $( this ),
				postID   = $link.data( 'post-id' ),
				cookieID = postID + cookieSuffix,
				$number  = $link.find( 'span' );

			$number = updateNumber( $number, $link, cookieID );

			if ( cookie.get( cookieID ) ) {
				delay( function() {
					$.post( heartThis.ajaxURL, {
						action: 'heart-this',
						security: heartThis.ajaxNonce,
						heartsID: postID,
						heartsValue: $number.text()
					} );
				}, 2000 );
			}

			return false;
		});

		$hearts.on( 'webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
			$( this ).removeClass( 'is-animating' );
		});
	}

	// Document ready.
	$( document ).ready(function() {
		setupHearts();
		handleClicks();
	});
})( this, jQuery );
