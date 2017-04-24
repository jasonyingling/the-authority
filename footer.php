<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The Authority
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<?php if ( is_active_sidebar( 'aty-footer-left' ) || is_active_sidebar( 'aty-footer-middle' ) || is_active_sidebar( 'aty-footer-right' )  ) : ?>
				<div class="footer-widgets">
					<div class="footer-widget footer-widgets-left" role="complementary">
						<?php if ( is_active_sidebar( 'aty-footer-left' ) ) : ?>
							<?php dynamic_sidebar( 'aty-footer-left' ); ?>
						<?php else : ?>
							&nbsp;
						<?php endif; ?>
					</div><!-- .footer-widgets-left -->
					<div class="footer-widget footer-widgets-middle" role="complementary">
						<?php if ( is_active_sidebar( 'aty-footer-middle' ) ) : ?>
							<?php dynamic_sidebar( 'aty-footer-middle' ); ?>
						<?php else : ?>
							&nbsp;
						<?php endif; ?>
					</div><!-- .footer-widgets-middle -->
					<div class="footer-widget footer-widgets-right" role="complementary">
						<?php if ( is_active_sidebar( 'aty-footer-right' ) ) : ?>
							<?php dynamic_sidebar( 'aty-footer-right' ); ?>
						<?php else : ?>
							&nbsp;
						<?php endif; ?>
					</div><!-- .footer-widgets-right -->
				</div><!-- .footer-widgets -->
			<?php endif; ?>
			<?php if ( has_nav_menu('aty-footer') ) : ?>
				<nav class="footer-navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'aty-footer', 'menu_id' => 'footer-menu' ) ); ?>
				</nav>
			<?php endif; ?>
			<div class="site-info">
				<p><span class="aty-copyright">&copy;</span> <?php echo date('Y'); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a> <span class="aty-separator">|</span> <?php bloginfo('description'); ?></p>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
