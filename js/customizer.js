/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
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

	/*******
	* Header Colors
	********/

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
			}

			$( '#site-title a, .site-description, .main-navigation ul:not(.sub-menu) > li:not(.callout-nav) > a' ).css( {
				'color': to,
			} );
		} );
	} );

	// Header Background Color
	wp.customize( 'header_background', function( value ) {
		value.bind( function( to ) {
			$( '.site-header, .site-search-dropdown' ).css( {
				'background-color': to
			} );
		} );
	} );

	// Secondary Header Background Color
	wp.customize( 'sec_header_background', function( value ) {
		value.bind( function( to ) {
			$( '.secondary-header, .secondary-navigation #secondary-menu>li>.sub-menu' ).css( {
				'background-color': to
			} );
		} );
	} );

	// Secondary Header Text
	wp.customize( 'sec_header_text', function( value ) {
		value.bind( function( to ) {
			$( '.secondary-navigation ul a, .site-search .site-search-button, .aty-edd-cart a' ).css( {
				'color': to
			} );
		} );
	} );

	// Submenu Background
	wp.customize( 'submenu_background', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation ul ul' ).css( {
				'background-color': to
			} );
		} );
	} );

	// Submenu Text
	wp.customize( 'submenu_text', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation ul ul li a' ).css( {
				'color': to
			} );
		} );
	} );

	/*******
	* Footer Colors
	********/

	// Footer Background
	wp.customize( 'footer_background', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer' ).css( {
				'background-color': to
			} );
		} );
	} );

	// Footer Primary
	wp.customize( 'footer_primary_link', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer .widget:not(.widget_archive):not(.widget_pages) a' ).css( {
				'color': to
			} );
			$( '.site-footer button, .site-footer input[type="button"], .site-footer input[type="reset"], .site-footer input[type="submit"]' ).css( {
				'background-color': to
			} );
			$( '.site-footer .widget_calendar thead' ).css( {
				'background': to
			} );
		} );
	} );

	// Footer Secondary
	wp.customize( 'footer_secondary_shade', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer .widget_archive ul a, .site-footer .widget_categories ul a' ).css( {
				'background-color': to
			} );
		} );
	} );

	// Footer Copy Color
	wp.customize( 'footer_copy_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer, .site-footer .site-info a, .footer-widgets .widget-title, .footer-navigation ul li a, .site-footer .widget_pages ul li a, .site-footer .widget_nav_menu ul li a, .footer-widgets .widget_calendar caption' ).css( {
				'color': to
			} );
		} );
	} );


	/*******
	* Copy, Links, & Buttons
	********/

	// Primary Links & Buttons
	wp.customize( 'primary_link', function( value ) {
		value.bind( function( to ) {
			$( '.entry-content a' ).css( {
				'color': to
			} );
			$( 'blockquote, .widget-area button, .widget-area input[type="button"], .widget-area input[type="reset"], .widget-area input[type="submit"]' ).css( {
				'border-color': to
			} );
			$( '.main-navigation .callout-nav, .widget_calendar thead, .widget-area button, .widget-area input[type="button"], .widget-area input[type="reset"], .widget-area input[type="submit"], .site-search-dropdown button' ).css( {
				'background': to
			} );
		} );
	} );

	// Secondary
	wp.customize( 'secondary_shade', function( value ) {
		value.bind( function( to ) {
			$( '.entry-meta>span, .entry-meta span a, .tags-links a' ).css( {
				'color': to
			} );
			$( '.widget_archive ul a, .widget_categories ul a' ).css( {
				'background': to
			} );
			$( 'div.cat-links a' ).css( {
				'background-color': to
			} );
		} );
	} );

	// Copy
	wp.customize( 'copy_color', function( value ) {
		value.bind( function( to ) {
			$( 'body, .entry-title a, .page-title a, .widget-title' ).css( {
				'color': to
			} );
		} );
	} );

} )( jQuery );
