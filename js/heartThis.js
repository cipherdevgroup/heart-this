/* global heartThis, cookie */

/**
 * HeartThis Public JavaScript
 *
 * @copyright Copyright 2018, Cipher Development, LLC
 * @license   MIT
 */
( function( window, $, undefined ) {
	'use strict';

	var $hearts   = $( '.heart-this' );
	var cookieSuffix = '-heart-this-status';
	var heartFormat = new Intl.NumberFormat( heartThis.heartLocale );
	var delay = (function() {
		var timer = 0;
		return function( callback, ms ) {
			clearTimeout( timer );
			timer = setTimeout( callback, ms );
		};
	})();

	cookie.defaults.expires = 999;
	cookie.defaults.path = '/';

	function setupHearts() {
		$hearts.each(function() {
			var $link    = $( this );
			var postID   = $link.data( 'post-id' );
			var cookieID = postID + cookieSuffix;

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

	function getCurrentCount( $element ) {
		var $count = $element.find( 'span' );

		if ( 0 === $count.length ) {
			return 0;
		}

		// Clean all non-numeric characters.
		$count = $count.text().replace( /[^0-9]/g, '' );

		return parseInt( $count, 10 );
	}

	function updateCount( $link, cookieID, postID ) {
		var $instances = $( '[data-post-id="' + postID + '"]' );
		var $allNums = $instances.find( 'span' );
		var currentCount = getCurrentCount( $link );
		var updatedCount;

		if ( 'hearted' !== cookie.get( cookieID ) ) {
			cookie.set( cookieID, 'hearted' );
			updatedCount = currentCount + 1;
			$allNums.text( heartFormat.format( updatedCount ) );
			$instances.addClass( 'active is-animating' );
		} else {
			cookie.set( cookieID, 'unhearted' );
			updatedCount = currentCount - 1;
			$allNums.text( heartFormat.format( updatedCount ) );
			$instances.removeClass( 'active' );
		}

		return updatedCount;
	}

	function handleClicks() {
		$hearts.on( 'click touchstart', function() {
			var $link    = $( this );
			var postID   = $link.data( 'post-id' );
			var cookieID = postID + cookieSuffix;

			var updatedCount = updateCount( $link, cookieID, postID );

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
