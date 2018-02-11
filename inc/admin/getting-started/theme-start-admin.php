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
                 <p><?php printf( __( 'Sign up to get important product updates and information from <a href="%s">Themes.Pizza</a>.', 'the-authority'), esc_url('https://www.themes.pizza') ); ?></p>

                 <!-- Begin MailChimp Signup Form -->
                 <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                 <style type="text/css">
                     #mc_embed_signup{background:#ffffff; clear:left; font:14px Helvetica,Arial,sans-serif; padding: 0; max-width: 300px; }
                     #mc_embed_signup form { padding: 0; }
                     #mc_embed_signup .mc-field-group { padding-bottom: 10px; }
                     #mc_embed_signup div#mce-responses { margin: 0; padding: 0; }
                     #mc_embed_signup div.response { margin-top: 0; padding-top: 0; }
                     /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                        We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                 </style>
                 <div id="mc_embed_signup">
                 <form action="https://pizza.us17.list-manage.com/subscribe/post?u=70c8e0d050385a46da35a77ef&amp;id=8f30673aa7" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                     <div id="mc_embed_signup_scroll">

                 <div class="mc-field-group">
                     <label for="mce-EMAIL" style="visibility: hidden; height: 4px;">Email Address </label>
                     <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address">
                 </div>
                 <div class="mc-field-group input-group" style="display: none;">
                     <strong>Freemium Themes </strong>
                     <ul>
                         <li><input type="checkbox" value="2" name="group[3225][2]" id="mce-group[3225]-3225-1" checked><label for="mce-group[3225]-3225-1">The Authority</label></li>
                     </ul>
                 </div>
                     <div id="mce-responses" class="clear">
                         <div class="response" id="mce-error-response" style="display:none"></div>
                         <div class="response" id="mce-success-response" style="display:none"></div>
                     </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                     <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_70c8e0d050385a46da35a77ef_8f30673aa7" tabindex="-1" value=""></div>
                     <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                     </div>
                 </form>
                 </div>
                 <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='BIRTHDAY';ftypes[3]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                 <!--End mc_embed_signup-->
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

						<!-- Grab feed of help file -->
						<?php
							include_once( ABSPATH . WPINC . '/feed.php' );

							$rss = fetch_feed( 'https://www.themes.pizza/downloads/the-authority-pro/feed/?withoutcomments=1' );

							if ( ! is_wp_error( $rss ) ) :
								$maxitems = $rss->get_item_quantity( 1 );
								$rss_items = $rss->get_items( 0, $maxitems );
							endif;

							$rss_items_check = array_filter( $rss_items );
						?>

						<!-- Output the feed -->
						<?php if ( is_wp_error( $rss ) || empty( $rss_items_check ) ) : ?>
							<p><?php esc_html_e( 'Get even more out of your theme with The Authority Pro.', 'the-authority' ); ?> <a href="https://www.themes.pizza/downloads/the-authority-pro/" title="View The Authority Pro"><?php esc_html_e( 'Go Pro &rarr;', 'the-authority' ); ?></a></p>
                            <ul>
                                <li><?php esc_html_e( 'Drive action with a banner on your homepage.', 'the-authority' ); ?></li>
                                <li><?php esc_html_e( 'Show off what you do with custom sections.', 'the-authority' ); ?></li>
                                <li><?php esc_html_e( 'Improved styles for portfolios and testimonials.', 'the-authority' ); ?></li>
                                <li><?php esc_html_e( 'Start selling with full WooCommerce support.', 'the-authority' ); ?></li>
                            </ul>
						<?php else : ?>
							<?php foreach ( $rss_items as $item ) : ?>
								<?php echo $item->get_content(); ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>

					<!-- Help file panel -->
					<div id="help-panel" class="panel-left">

						<!-- Grab feed of help file -->
						<?php
							include_once( ABSPATH . WPINC . '/feed.php' );

							$rss = fetch_feed( 'https://www.themes.pizza/help/the-authority/feed/?withoutcomments=1' );

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
