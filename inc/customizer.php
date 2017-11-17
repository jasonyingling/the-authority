<?php
/**
 * The Authority Theme Customizer.
 *
 * @package The Authority
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function the_authority_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->default = '#ffffff';

	$wp_customize->get_control( 'header_textcolor' )->section = 'header_colors';
	$wp_customize->get_control( 'background_color' )->section = 'site_colors';

	// Create Theme Colors Panel
	$wp_customize->add_panel( 'theme_colors', array(
		'priority' 			=> 30,
		'theme_supports' 	=> '',
		'title' 			=> __( 'Theme Colors', 'the-authority' ),
		'description' 		=> __( 'Controls the colors for the theme', 'the-authority' ),
	) );

	// Add Sections for Colors
	$wp_customize->add_section( 'site_colors', array(
		'title'				=> __('Site Colors', 'the-authority'),
		'panel'				=> 'theme_colors',
		'priority'			=> '1'
	) );

	$wp_customize->add_section( 'copy_links', array(
		'title'				=> __('Copy, Links, & Buttons', 'the-authority'),
		'panel'				=> 'theme_colors',
		'priority'			=> '2'
	) );

	$wp_customize->add_section( 'header_colors', array(
		'title'				=> __('Header Colors', 'the-authority'),
		'panel'				=> 'theme_colors',
		'priority'			=> '3'
	) );

	$wp_customize->add_section( 'footer_section', array(
		'title'				=> __('Footer Colors', 'the-authority'),
		'panel'				=> 'theme_colors',
		'priority'			=> '4'
	) );

	// Add Navigation width setting
	$wp_customize->add_setting( 'show_mobile_nav', array(
		'default' => '960',
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	) );

	// Add Color Settings
	$wp_customize->add_setting( 'primary_link', array(
	 	'default' => '#f46060',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'			=> 'postMessage',
	 ) );

	 $wp_customize->add_setting( 'primary_hover', array(
 	 	'default' => '#ab4343',
 		'sanitize_callback' => 'sanitize_hex_color',
 	 ) );

 	 $wp_customize->add_setting( 'secondary_shade', array(
  	 	'default' => '#a3a1a1',
  		'sanitize_callback' => 'sanitize_hex_color',
  		'transport'			=> 'postMessage',
  	 ) );

	 $wp_customize->add_setting( 'copy_color', array(
	   'default' => '#2e3641',
	   'sanitize_callback' => 'sanitize_hex_color',
	   'transport'			=> 'postMessage',
	) );

	$wp_customize->add_setting( 'header_background', array(
	 	'default' => '#2e3641',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'			=> 'postMessage',
	 ) );

	 $wp_customize->add_setting( 'header_accents', array(
 	 	'default' => '#f46060',
 		'sanitize_callback' => 'sanitize_hex_color',
 	 ) );

	 $wp_customize->add_setting( 'sec_header_background', array(
 	 	'default' => '#f46060',
 		'sanitize_callback' => 'sanitize_hex_color',
 		'transport'			=> 'postMessage',
 	 ) );

	 $wp_customize->add_setting( 'sec_header_text', array(
 	 	'default' => '#ffffff',
 		'sanitize_callback' => 'sanitize_hex_color',
 		'transport'			=> 'postMessage',
 	 ) );

	 $wp_customize->add_setting( 'sec_header_text_hover', array(
 	 	'default' => '#ab4343',
 		'sanitize_callback' => 'sanitize_hex_color',
 	 ) );

	 $wp_customize->add_setting( 'submenu_background', array(
 	 	'default' => '#ffffff',
 		'sanitize_callback' => 'sanitize_hex_color',
 		'transport'			=> 'postMessage',
 	 ) );

	 $wp_customize->add_setting( 'submenu_text', array(
 	 	'default' => '#a3a1a1',
 		'sanitize_callback' => 'sanitize_hex_color',
 		'transport'			=> 'postMessage',
 	 ) );

	 // Footer
	 $wp_customize->add_setting( 'footer_primary_link', array(
 	 	'default' => '#f46060',
 		'sanitize_callback' => 'sanitize_hex_color',
 		'transport'			=> 'postMessage',
 	 ) );

	 $wp_customize->add_setting( 'footer_primary_hover', array(
 	 	'default' => '#ab4343',
 		'sanitize_callback' => 'sanitize_hex_color',
 	 ) );

 	 $wp_customize->add_setting( 'footer_secondary_shade', array(
  	 	'default' => '#a3a1a1',
  		'sanitize_callback' => 'sanitize_hex_color',
  		'transport'			=> 'postMessage',
  	 ) );

	 $wp_customize->add_setting( 'footer_copy_color', array(
	   'default' => '#ffffff',
	   'sanitize_callback' => 'sanitize_hex_color',
	   'transport'			=> 'postMessage',
	) );

	$wp_customize->add_setting( 'footer_background', array(
	 	'default' => '#2e3641',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'			=> 'postMessage',
	 ) );

	// Add Navigation Width Control
	$wp_customize->add_control( 'show_mobile_nav', array(
		'type'			=> 'number',
		'priority'		=> 50,
		'section'		=> 'title_tagline',
		'label'			=> __( 'Mobile Navigation Control', 'the-authority' ),
		'description'	=> __( 'Set the width at which point the mobile menu button shows and the main navigation disappears.', 'the-authority' ),
		'input_attrs' => array(
            'min'   => 320,
        ),
	) );

	// Add Color Controls
	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'header_background',
		 array(
			 'label'		=> __( 'Header Background', 'the-authority' ),
			 'section'		=> 'header_colors',
			 'settings'		=> 'header_background'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'header_accents',
		 array(
			 'label'		=> __( 'Header Accent', 'the-authority' ),
			 'section'		=> 'header_colors',
			 'settings'		=> 'header_accents'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'sec_header_background',
		 array(
			 'label'		=> __( 'Secondary Header Background', 'the-authority' ),
			 'section'		=> 'header_colors',
			 'settings'		=> 'sec_header_background'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'sec_header_text',
		 array(
			 'label'		=> __( 'Secondary Header Text', 'the-authority' ),
			 'section'		=> 'header_colors',
			 'settings'		=> 'sec_header_text'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'sec_header_text_hover',
		 array(
			 'label'		=> __( 'Secondary Header Hover', 'the-authority' ),
			 'section'		=> 'header_colors',
			 'settings'		=> 'sec_header_text_hover'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'submenu_background',
		 array(
			 'label'		=> __( 'Submenu Background', 'the-authority' ),
			 'section'		=> 'header_colors',
			 'settings'		=> 'submenu_background'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'submenu_text',
		 array(
			 'label'		=> __( 'Submenu Text', 'the-authority' ),
			 'section'		=> 'header_colors',
			 'settings'		=> 'submenu_text'
		 ) )
	);




	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'primary_link',
		 array(
			 'label'		=> __( 'Primary Links & Buttons', 'the-authority' ),
			 'section'		=> 'copy_links',
			 'settings'		=> 'primary_link'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'primary_hover',
		 array(
			 'label'		=> __( 'Hover', 'the-authority' ),
			 'section'		=> 'copy_links',
			 'settings'		=> 'primary_hover'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'secondary_shade',
		 array(
			 'label'		=> __( 'Secondary Links', 'the-authority' ),
			 'section'		=> 'copy_links',
			 'settings'		=> 'secondary_shade'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'copy_color',
		 array(
			 'label'		=> __( 'Copy', 'the-authority' ),
			 'section'		=> 'copy_links',
			 'settings'		=> 'copy_color'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'footer_background',
		 array(
			 'label'		=> __( 'Footer Background', 'the-authority' ),
			 'section'		=> 'footer_section',
			 'settings'		=> 'footer_background'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'footer_primary_link',
		 array(
			 'label'		=> __( 'Footer Links & Buttons', 'the-authority' ),
			 'section'		=> 'footer_section',
			 'settings'		=> 'footer_primary_link'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'footer_primary_hover',
		 array(
			 'label'		=> __( 'Footer Hover', 'the-authority' ),
			 'section'		=> 'footer_section',
			 'settings'		=> 'footer_primary_hover'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'footer_secondary_shade',
		 array(
			 'label'		=> __( 'Secondary Links & Buttons', 'the-authority' ),
			 'section'		=> 'footer_section',
			 'settings'		=> 'footer_secondary_shade'
		 ) )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control (
		$wp_customize,
		'footer_copy_color',
		 array(
			 'label'		=> __( 'Copy', 'the-authority' ),
			 'section'		=> 'footer_section',
			 'settings'		=> 'footer_copy_color'
		 ) )
	);

}
add_action( 'customize_register', 'the_authority_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function the_authority_customize_preview_js() {
	wp_enqueue_script( 'the_authority_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'the_authority_customize_preview_js' );
