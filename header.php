<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The Authority
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'the-authority' ); ?></a>
	<div class="secondary-header">
		<div class="container">
			<?php if (has_nav_menu('secondary')) : ?>
			<nav class="secondary-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
			</nav><!-- end .secondary-navigation -->
			<?php endif; ?>

			<div class="secondary-aside">
				<div class="site-search">
					<button class="site-search-button js-toggle-site-search">
						<i class="fa fa-search"></i><span><?php esc_html_e( 'Search', 'the-authority'); ?></span>
					</button>
				</div><!-- .site-search -->
				<?php if ( class_exists( 'Easy_Digital_Downloads' ) ) : ?>
				<div class="aty-edd-cart">
					<a class="<?php if ( edd_get_cart_quantity() ) { echo 'cart-has-items'; } ?>" href="<?php echo esc_url( edd_get_checkout_uri() ); ?>">
						<i class="fa fa-shopping-cart"></i>
						<?php if ( edd_get_cart_quantity() ) : ?>
							<span class="edd-cart-quantity"><?php echo edd_get_cart_quantity(); ?></span>
						<?php endif; ?>
					</a>
				</div><!-- .site-search -->
				<?php endif; ?>
			</div>
		</div><!-- .container -->

		<div class="site-search-dropdown js-site-search-dropdown">
			<div class="container">
				<?php get_search_form(); ?>
			</div><!-- .container -->
		</div><!-- .site-search-dropdown -->

	</div><!-- .secondary-header -->
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="site-branding">
				<?php the_authority_the_custom_logo(); ?>
				<?php if ( is_home() ) : ?>
					<h1 id="site-title" class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p id="site-title" class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif; ?>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div><!-- .site-branding -->

			<a href="#mobile-navigation" class="mobile-menu-button hamburger-button">
			    <span></span>
			</a>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->

		</div><!-- end .container -->

		<nav id="mobile-navigation" class="mobile-navigation" role="navigation">
			<div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'mobile-menu' ) ); ?>
			</div>
		</nav><!-- #mobile-navigation -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">

		<?php if ( get_header_image_tag() ) : ?>
			<div class="container aty-custom-header"><?php the_header_image_tag(); ?></div>
		<?php endif; ?>
