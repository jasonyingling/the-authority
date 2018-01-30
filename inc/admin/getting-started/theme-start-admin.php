<?php
/**
 * Theme updater admin page and functions.
 *
 * @package EDD Sample Theme
 */

 /**
  * Add an admin notice on theme activate
  */
 function the_authority_sample_theme_admin_notices() {
    global $pagenow;

  	if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) { ?>

        <div class="notice notice-success is-dismissible">
            <p><?php printf( __( 'Thanks for using %s. To get the most out of your theme check the <a href="%s">Getting Started</a> page.', 'the-authority' ), __( 'The Authority', 'the-authority' ), admin_url( "themes.php?page=the-authority-start" ) ); ?></p>
        </div>

  	<?php }
 }
 add_action( 'admin_notices', 'the_authority_sample_theme_admin_notices' );

 /**
  * Load Getting Started styles in the admin
  *
  * since 1.0.0
  */
 function the_authority_start_load_admin_scripts() {

 	// Load styles only on our page
 	global $pagenow;
 	if( 'themes.php' != $pagenow )
 		return;

 	/**
 	 * Getting Started scripts and styles
 	 *
 	 * @since 1.0
 	 */

 	// Getting Started javascript
 	wp_enqueue_script( 'the-authority-getting-started', get_template_directory_uri() . '/inc/admin/getting-started/getting-started.js', array( 'jquery' ), '1.0.0', true );

 	// Getting Started styles
 	wp_register_style( 'the-authority-getting-started', get_template_directory_uri() . '/inc/admin/getting-started/getting-started.css', false, '1.0.0' );
 	wp_enqueue_style( 'the-authority-getting-started' );

 	// Thickbox
 	add_thickbox();
 }
 add_action( 'admin_enqueue_scripts', 'the_authority_start_load_admin_scripts' );

class The_Authority_Theme_Updater_Admin {

    /**
     * Initialize the class.
     *
     * @since 1.0.0
     */
    function __construct( $config = array(), $strings = array() ) {

        $config = wp_parse_args( $config, array(
			'theme_slug' => get_template(),
			'version' => '',
			'author' => __( 'Jason Yingling', 'the-authority' ),
		) );

		// Set config arguments
		$this->theme_slug = sanitize_key( $config['theme_slug'] );
		$this->version = $config['version'];
		$this->author = $config['author'];

		// Populate version fallback
		if ( '' == $config['version'] ) {
			$theme = wp_get_theme( $this->theme_slug );
			$this->version = $theme->get( 'Version' );
		}

		// Strings passed in from the updater config
		$this->strings = $strings;

        add_action( 'admin_menu', array( $this, 'start_menu' ) );

    }

	/**
	 * Adds a menu item for the theme license under the appearance menu.
	 *
	 * since 1.0.0
	 */
	function start_menu() {

		$strings = $this->strings;

		add_theme_page(
			$strings['theme-start'],
			$strings['theme-start'],
			'manage_options',
			$this->theme_slug . '-start',
			array( $this, 'start_page' )
		);
	}

	/**
	 * Outputs the markup used on the theme license page.
	 *
	 * since 1.0.0
	 */
	function start_page() {

        $strings = $this->strings;

		// Theme info
		$theme = wp_get_theme( 'the-authority' );

		// Lowercase theme name for resources links
		$theme_name_lower = get_template();

		?>

		<div class="wrap getting-started">
			<h2 class="notices"></h2>
			<div class="intro-wrap">
				<div class="intro">
					<h3><?php printf( esc_html__( 'Getting started with %1$s', 'the-authority' ), $theme['Name'] ); ?> <span>v.<?php echo $theme['Version'] ?></span></h3>

					<h4><?php printf( esc_html__( 'Everything you need to get the most out of %s can be found here.', 'the-authority' ), $theme['Name'] ); ?></h4>
				</div>
			</div>

			<div class="panels">
				<ul class="inline-list">
					<li class="current"><a id="help" href="#"><?php esc_html_e( 'Help File', 'the-authority' ); ?></a></li>
				</ul>

				<div id="panel" class="panel">

					<!-- Help file panel -->
					<div id="help-panel" class="panel-left visible">

						<!-- Grab feed of help file -->
						<?php
							include_once( ABSPATH . WPINC . '/feed.php' );

							$rss = fetch_feed( 'https://jasonyingling.me/help/the-authority/feed/?withoutcomments=1' );

							if ( ! is_wp_error( $rss ) ) :
								$maxitems = $rss->get_item_quantity( 1 );
								$rss_items = $rss->get_items( 0, $maxitems );
							endif;

							$rss_items_check = array_filter( $rss_items );
						?>

						<!-- Output the feed -->
						<?php if ( is_wp_error( $rss ) || empty( $rss_items_check ) ) : ?>
							<p><?php esc_html_e( 'This help file feed seems to be temporarily down. You can always view the help file online in the meantime.', 'the-authority' ); ?> <a href="https://jasonyingling.me/help/<?php echo $theme_name_lower; ?>" title="View help file"><?php echo $theme['Name']; ?> <?php esc_html_e( 'Help File &rarr;', 'the-authority' ); ?></a></p>
						<?php else : ?>
							<?php foreach ( $rss_items as $item ) : ?>
								<?php echo $item->get_content(); ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>

					<div class="panel-right">
						<!-- Activate license -->
						<div class="panel-aside">
                            <h2><?php esc_html_e( 'Introducing Aurora', 'the-authority' ); ?></h2>
                            <p><?php esc_html_e( 'A bold and beautiful WordPress theme for businesses and creators to start selling physical and digital goods via WooCommerce.', 'the-authority' ); ?></p>
                            <a href="https://jasonyingling.me/wordpress-themes/aurora-wordpress-theme/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/inc/admin/getting-started/images/aurora-wordpress-theme-small.jpg' ?>" alt="<?php echo __('Aurora WordPress Theme', 'the-authority'); ?>"></a>
                            <a href="https://jasonyingling.me/wordpress-themes/aurora-wordpress-theme/" target="_blank" class="button-primary"><?php esc_html_e( 'Get it now', 'the-authority' ); ?></a>
						</div><!-- .panel-aside -->

					</div><!-- .panel-right -->
				</div><!-- .panel -->
			</div><!-- .panels -->
		</div><!-- .getting-started -->

		<?php
	}

}
