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

       	if (  (is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) || ( false === get_option( 'the_authority_admin_notice_shown' ) ) ) { ?>

            <?php update_option( 'the_authority_admin_notice_shown', true ); ?>
             <div class="notice notice-success is-dismissible">
                 <p><?php printf( __( 'Thanks for using %s. To get the most out of your theme check the <a href="%s">Getting Started</a> page. For even more features including WooCommerce support get <a href="%s">The Authority Pro</a>.', 'the-authority' ), __( 'The Authority', 'the-authority' ), admin_url( "themes.php?page=the-authority-start" ), esc_url('https://www.themes.pizza/downloads/the-authority-pro') ); ?></p>
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
                    <li class="current"><a id="pro" href="#"><?php esc_html_e( 'Go Pro', 'the-authority' ); ?></a></li>
					<li><a id="help" href="#"><?php esc_html_e( 'Help File', 'the-authority' ); ?></a></li>
				</ul>

				<div id="panel" class="panel">

                    <!-- Help file panel -->
					<div id="pro-panel" class="panel-left visible">

                        <?php get_template_part( '/inc/admin/getting-started/authority-pro' ); ?>

					</div>

					<!-- Help file panel -->
					<div id="help-panel" class="panel-left">

                        <?php get_template_part( '/inc/admin/getting-started/authority-help' ); ?>

					</div>

					<div class="panel-right">
						<!-- Activate license -->
						<div class="panel-aside">
                            <h2><?php esc_html_e( 'Go Pro', 'the-authority' ); ?></h2>
                            <a href="https://www.themes.pizza/downloads/the-authority-pro/" target="_blank"><img src="<?php echo get_template_directory_uri() . '/inc/admin/getting-started/images/the-authority-pro.jpg' ?>" alt="<?php echo __('Aurora WordPress Theme', 'the-authority'); ?>"></a>
                            <p><?php esc_html_e( 'Get even more features to show your authority by upgrading to The Authority Pro.', 'the-authority' ); ?></p>
                            <ul>
                                <li><?php esc_html_e( 'Drive action with a banner on your homepage.', 'the-authority' ); ?></li>
                                <li><?php esc_html_e( 'Show off what you do with custom sections.', 'the-authority' ); ?></li>
                                <li><?php esc_html_e( 'Improved styles for portfolios and testimonials.', 'the-authority' ); ?></li>
                                <li><?php esc_html_e( 'Start selling with full WooCommerce support.', 'the-authority' ); ?></li>
                            </ul>
                            <a href="https://www.themes.pizza/downloads/the-authority-pro/" target="_blank" class="button-primary"><?php esc_html_e( 'Get it now', 'the-authority' ); ?></a>
						</div><!-- .panel-aside -->

					</div><!-- .panel-right -->
				</div><!-- .panel -->
			</div><!-- .panels -->
		</div><!-- .getting-started -->

		<?php
	}

}
