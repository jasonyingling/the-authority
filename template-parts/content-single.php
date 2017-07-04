<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Authority
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('container'); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php the_authority_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="aty-featured-image">
			<?php the_post_thumbnail('full'); ?>
		</figure>
	<?php endif; ?>

	<div class="entry-content">
		<?php if ( has_excerpt() ) : ?>
			<div class="entry-intro">
				<?php the_excerpt(); ?>
			</div><!-- .entry-intro -->
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'at-before-content' ) ) : ?>
			<div class="entry-before-content">
				<?php dynamic_sidebar( 'at-before-content' ); ?>
			</div>
		<?php endif; ?>

		<?php the_content(); ?>

		<?php if ( is_active_sidebar( 'at-after-content' ) ) : ?>
			<div class="entry-after-content">
				<?php dynamic_sidebar( 'at-after-content' ); ?>
			</div>
		<?php endif; ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'the-authority' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php the_authority_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
