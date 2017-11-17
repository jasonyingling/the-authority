<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'The_Authority_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-start-admin.php' );
}

// The theme version to use in the updater
define( 'THE_AUTHORITY_SL_THEME_VERSION', wp_get_theme( 'the-authority' )->get( 'Version' ) );

// Loads the updater classes
$updater = new The_Authority_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'item_name'      => __( 'The Authority', 'the-authority' ), // Name of theme
		'theme_slug'     => 'the-authority', // Theme slug
		'version'        => THE_AUTHORITY_SL_THEME_VERSION, // The current version of this theme
		'author'         => __( 'Jason Yingling', 'the-authority' ), // The author of this theme
	),

	// Strings
	$strings = array(
		'theme-start'    => __( 'Getting Started', 'the-authority' ),
	)

);
