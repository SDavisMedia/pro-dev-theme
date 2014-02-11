/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	wp.customize( 'sdm_read_more', function( value ) {
		value.bind( function( to ) {
			$( '.more-link' ).text( to );
		} );
	} );
	wp.customize( 'sdm_credits_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.site-info' ).text( to );
		} );
	} );
	wp.customize( 'sdm_featured_product_headline', function( value ) {
		value.bind( function( to ) {
			$( '.info-box-title' ).text( to );
		} );
	} );
	wp.customize( 'sdm_featured_product_version', function( value ) {
		value.bind( function( to ) {
			$( '.info-version' ).text( to );
		} );
	} );
	wp.customize( 'sdm_featured_product_note', function( value ) {
		value.bind( function( to ) {
			$( '.info-note' ).text( to );
		} );
	} );
	wp.customize( 'sdm_featured_product_button_text', function( value ) {
		value.bind( function( to ) {
			$( '.cta-button' ).text( to );
		} );
	} );
} )( jQuery );