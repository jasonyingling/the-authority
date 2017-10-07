<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package The Authority
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses the_authority_header_style()
 * @uses the_authority_admin_header_style()
 * @uses the_authority_admin_header_image()
 */
function the_authority_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'the_authority_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 1440,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'the_authority_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'the_authority_custom_header_setup' );

if ( ! function_exists( 'the_authority_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see the_authority_custom_header_setup().
 */
function the_authority_header_style() {
	$header_text_color = get_header_textcolor();

	$header_background = get_theme_mod( 'header_background' );
	$primary_link = get_theme_mod( 'primary_link' );
	$primary_hover = get_theme_mod( 'primary_hover' );
	$secondary_shade = get_theme_mod( 'secondary_shade' );
	$copy_color = get_theme_mod( 'copy_color' );
	$header_accents = get_theme_mod( 'header_accents' );
	$secondary_header = get_theme_mod( 'sec_header_background' );
	$secondary_header_text = get_theme_mod( 'sec_header_text');
	$secondary_header_text_hover = get_theme_mod( 'sec_header_text_hover');
	$submenu_background = get_theme_mod( 'submenu_background');
	$submenu_text = get_theme_mod( 'submenu_text');

	$footer_background = get_theme_mod( 'footer_background');
	$footer_primary = get_theme_mod( 'footer_primary_link');
	$footer_hover = get_theme_mod( 'footer_primary_hover');
	$footer_secondary = get_theme_mod( 'footer_secondary_shade');
	$footer_copy = get_theme_mod( 'footer_copy_color');

	?>
	<style type="text/css">
	<?php
		if ( $primary_link ) :
	?>
		a, a:visited, .entry-title a:hover, .entry-title a:focus, .page-title a:hover, .page-title a:focus, .entry-meta span a:hover, .entry-meta span a:focus, .tags-links a:hover, .tags-links a:focus, #site-title a:hover {
			color: <?php echo esc_attr( $primary_link ); ?>;
		}
		blockquote, button, input[type="button"], input[type="reset"], input[type="submit"] {
			border-color: <?php echo esc_attr( $primary_link ); ?>;
		}
		.main-navigation .callout-nav, .widget_calendar thead, button, input[type="button"], input[type="reset"], input[type="submit"], .widget_archive ul a:hover, .widget_categories ul a:hover, .site-search-dropdown button {
			background: <?php echo esc_attr( $primary_link ); ?>;
		}
		div.cat-links a:hover, div.cat-links a:focus {
			background-color: <?php echo esc_attr( $primary_link ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $primary_hover ) :
	?>
		a:hover, a:focus {
			color: <?php echo esc_attr( $primary_hover ); ?>;
		}
		.main-navigation .callout-nav:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .site-search-dropdown button:hover {
			background: <?php echo esc_attr( $primary_hover ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $secondary_shade ) :
	?>
		.entry-meta>span, .entry-meta span a, .tags-links a {
			color: <?php echo esc_attr( $secondary_shade ); ?>;
		}
		.widget_archive ul a, .widget_categories ul a {
			background: <?php echo esc_attr( $secondary_shade ); ?>;
		}
		div.cat-links a {
			background-color: <?php echo esc_attr( $secondary_shade ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $copy_color ) :
	?>
		body, input, select, textarea, .entry-title a, .page-title a, .entry-title a:visited, .page-title a:visited, .widget-title {
			color: <?php echo esc_attr( $copy_color ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		#site-title a,
		.site-description,
		.main-navigation ul:not(.sub-menu) > li:not(.callout-nav) > a {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	<?php
		if ( $header_background ) :
	?>
		.site-header, .site-search-dropdown {
			background-color: <?php echo esc_attr( $header_background ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $header_accents ) :
	?>
		.main-navigation ul ul:before, .main-navigation ul li a:before {
			background-color: <?php echo esc_attr( $header_accents ); ?>;
		}
		.hamburger-button span, .hamburger-button:before, .hamburger-button:after {
			background: <?php echo esc_attr( $header_accents ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $secondary_header ) :
	?>
		.secondary-header, .secondary-navigation #secondary-menu>li>.sub-menu {
			background-color: <?php echo esc_attr( $secondary_header ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $secondary_header_text ) :
	?>
		.secondary-navigation ul a, .secondary-navigation ul a:visited, .site-search .site-search-button, .aty-edd-cart a, .aty-edd-cart a:visited {
			color: <?php echo esc_attr( $secondary_header_text ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $secondary_header_text_hover ) :
	?>
		.secondary-navigation ul a:hover, .secondary-navigation ul a:focus, .site-search .site-search-button:hover, .site-search .site-search-button:focus, .aty-edd-cart a:hover, .aty-edd-cart a:focus {
			color: <?php echo esc_attr( $secondary_header_text_hover ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $submenu_background ) :
	?>
		.main-navigation ul ul {
			background-color: <?php echo esc_attr( $submenu_background ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $submenu_text ) :
	?>
		.main-navigation ul ul li a {
			color: <?php echo esc_attr( $submenu_text ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $footer_background ) :
	?>
		.site-footer {
			background-color: <?php echo esc_attr( $footer_background ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $footer_primary ) :
	?>
		.site-footer a, .site-footer .site-info a:hover, .footer-navigation ul li a:hover, .site-footer .widget_pages ul li a:hover, .site-footer .widget_nav_menu ul li a:hover,
		.footer-navigation ul li a:focus, .site-footer .widget_pages ul li a:focus, .site-footer .widget_nav_menu ul li a:focus,
		.footer-navigation ul li ul li a:hover, .site-footer .widget_pages ul li ul li a:hover, .site-footer .widget_nav_menu ul li ul li a:hover,
		.footer-navigation ul li ul li a:focus, .site-footer .widget_pages ul li ul li a:focus, .site-footer .widget_nav_menu ul li ul li a:focus {
			color: <?php echo esc_attr( $footer_primary ); ?>;
		}
		.site-footer button, .site-footer input[type="button"], .site-footer input[type="reset"], .site-footer input[type="submit"] {
			background-color: <?php echo esc_attr( $footer_primary ); ?>;
		}
		.site-footer .widget_calendar thead,
		.site-footer .widget_archive ul a:hover, .site-footer .widget_categories ul a:hover,
		.site-footer .widget_archive ul a:focus, .site-footer .widget_categories ul a:focus {
			background: <?php echo esc_attr( $footer_primary ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $footer_hover ) :
	?>
		.site-footer a:hover, .site-footer a:focus {
			color: <?php echo esc_attr( $footer_hover ); ?>;
		}
		.site-footer button:hover, .site-footer input[type="button"]:hover, .site-footer input[type="reset"]:hover, .site-footer input[type="submit"]:hover,
		.site-footer button:focus, .site-footer input[type="button"]:focus, .site-footer input[type="reset"]:focus, .site-footer input[type="submit"]:focus {
			background-color: <?php echo esc_attr( $footer_hover ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $footer_copy ) :
	?>
		.site-footer, .site-footer .site-info a, .footer-widgets .widget-title,
		.footer-navigation ul li a, .site-footer .widget_pages ul li a, .site-footer .widget_nav_menu ul li a,
		.footer-widgets .widget_calendar caption {
			color: <?php echo esc_attr( $footer_copy ); ?>;
		}
	<?php
		endif;
	?>

	<?php
		if ( $footer_secondary ) :
	?>
		.site-footer .widget_archive ul a, .site-footer .widget_categories ul a {
			background-color: <?php echo esc_attr( $footer_secondary ); ?>
		}
	<?php
		endif;
	?>

	</style>
	<?php
}
endif; // the_authority_header_style
