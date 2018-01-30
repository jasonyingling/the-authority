<?php
/**
 * The Authority functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package The Authority
 */

if ( ! function_exists( 'the_authority_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function the_authority_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on The Authority, use a find and replace
	 * to change 'the-authority' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'the-authority', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'the-authority' ),
		'secondary' => esc_html__( 'Secondary Menu', 'the-authority' ),
		'aty-footer' => esc_html__( 'Footer Menu', 'the-authority' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'width'			=> '300',
		'height'		=> '75',
		'flex-height' 	=> true,
		'flex-width'  	=> true,
	));

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'the_authority_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Gutenberg wide images
	add_theme_support( 'align-wide' );

}
endif; // the_authority_setup
add_action( 'after_setup_theme', 'the_authority_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function the_authority_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'the_authority_content_width', 1440 );
}
add_action( 'after_setup_theme', 'the_authority_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function the_authority_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'the-authority' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'After First Post', 'the-authority' ),
		'id'            => 'at-after-first',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Before Content', 'the-authority' ),
		'id'            => 'at-before-content',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'After Content', 'the-authority' ),
		'id'            => 'at-after-content',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Left', 'the-authority' ),
		'id'            => 'aty-footer-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Middle', 'the-authority' ),
		'id'            => 'aty-footer-middle',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Right', 'the-authority' ),
		'id'            => 'aty-footer-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'the_authority_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function the_authority_scripts() {
	wp_enqueue_style( 'the-authority-style', get_stylesheet_uri(), array(), '20170823' );

	wp_enqueue_style( 'the-authority-print', get_template_directory_uri() . '/print.css', array(), '20170823', 'print' );

	wp_enqueue_script( 'the-authority-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'jquery-mmenu', get_template_directory_uri() . '/js/vendor/jquery.mmenu.min.js', array('jquery'), '20161220', true );

	wp_enqueue_script( 'the-authority-scripts', get_template_directory_uri() . '/js/min/main-min.js', array('jquery'), '20170823', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'the_authority_scripts' );

/**
 * Registers an editor stylesheet for the theme.
 */
function the_authority_theme_add_editor_styles() {
    add_editor_style( 'authority-editor-style.css' );
}
add_action( 'admin_init', 'the_authority_theme_add_editor_styles' );

/**
 * Load theme updater functions.
 * Action is used so that child themes can easily disable.
 */

function the_authority_theme_settings() {
	require( get_template_directory() . '/inc/admin/getting-started/theme-start.php' );
}
add_action( 'after_setup_theme', 'the_authority_theme_settings' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Replaces the excerpt "Read More" text with a link
 */
function the_authority_new_excerpt_more($more) {
	if ( is_admin() ) {
		return $more;
	}

	return '...<a class="excerpt-more-link" href="'. esc_url( get_permalink( get_the_ID() ) ) . '">' . __('Read More', 'the-authority') . '</a>';
}
add_filter('excerpt_more', 'the_authority_new_excerpt_more');

/**
 * Replaces the content "Read More" text with a link
 */
function the_authority_modify_read_more_link( $more ) {
	if ( is_admin() ) {
		return $more;
	}

    return '<a class="more-link" href="' . esc_url( get_permalink() ) . '">' . __('Read More', 'the-authority') . '</a>';
}
add_filter( 'the_content_more_link', 'the_authority_modify_read_more_link' );

/**
 * Removes scrolling to the point of the read more link
 */
function the_authority_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'the_authority_remove_more_link_scroll' );

/**
 * replaces the wp-post-image class with wp-post-image and aty_first_post on the featured image if the first post in the loop
 */
function the_authority_first_post_image($html) {

	global $wp_query;
    if( 0 == $wp_query->current_post ) {
   		$html = str_replace('wp-post-image', 'wp-post-image aty_first_post', $html);
    }

    return $html;
}
add_filter('post_thumbnail_html', 'the_authority_first_post_image', 100);
