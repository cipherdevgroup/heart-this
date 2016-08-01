/* global heartThis, cookie */

/**
 * HeartThis Public JavaScript
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

			if ( $( document.body ).hasClass( 'ajax-heart-this' ) ) {
				$link.find( 'span' ).load( heartThis.ajaxURL, {
					action: 'heart-this',
					security: heartThis.ajaxNonce,
					postID: postID
				});
			}
		});
	}

	function updateCount( currentCount, cookieID, postID ) {
		var $instances = $( '[data-post-id="' + postID + '"]' ),
			$allNums = $instances.find( 'span' ),
			updatedCount;

		if ( 'hearted' !== cookie.get( cookieID ) ) {
			cookie.set( cookieID, 'hearted' );
			updatedCount = currentCount + 1;
			$allNums.text( updatedCount );
			$instances.addClass( 'active is-animating' );
		} else {
			cookie.set( cookieID, 'unhearted' );
			updatedCount = currentCount - 1;
			$allNums.text( updatedCount );
			$instances.removeClass( 'active' );
		}

		return updatedCount;
	}

	function handleClicks() {
		$hearts.on( 'click touchstart', function() {
			var $link    = $( this ),
				postID   = $link.data( 'post-id' ),
				cookieID = postID + cookieSuffix,
				currentCount = ( parseInt( $link.find( 'span' ).text(), 10 ) || 0 ),
				updatedCount;

			updatedCount = updateCount( currentCount, cookieID, postID );

			if ( cookie.get( cookieID ) ) {
				delay( function() {
					$.post( heartThis.ajaxURL, {
						action: 'heart-this',
						security: heartThis.ajaxNonce,
						heartsID: postID,
						heartsValue: updatedCount
					} );
				}, 500 );
			}

			$link.blur();

			return false;
		});
	}

	function stopAnimating() {
		$hearts.on( 'webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
			$( this ).removeClass( 'is-animating' );
		});
	}

	// Document ready.
	$( document ).ready(function() {
		setupHearts();
		handleClicks();
		stopAnimating();
	});
})( this, jQuery );
