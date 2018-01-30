<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Authority
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="aty-featured-image">
			<?php the_post_thumbnail(); ?>
		</figure>
	<?php endif; ?>

	<div class="banner-sidebar">

		<div class="content-area">

			<div class="entry-content">
				<?php if ( is_active_sidebar( 'at-before-content' ) ) : ?>
					<div class="entry-before-content">
						<?php dynamic_sidebar( 'at-before-content' ); ?>
					</div>
				<?php endif; ?>

				<?php the_content(); ?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'the-authority' ),
						'after'  => '</div>',
					) );
				?>
				<?php if ( is_active_sidebar( 'at-after-content' ) ) : ?>
					<div class="entry-after-content">
						<?php dynamic_sidebar( 'at-after-content' ); ?>
					</div>
				<?php endif; ?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php the_authority_entry_footer(); ?>
			</footer><!-- .entry-footer -->

		</div><!-- .content-area -->

		<?php get_sidebar(); ?>

	</div><!-- .banner-sidebar -->

</article><!-- #post-## -->
