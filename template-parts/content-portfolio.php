<?php
/**
 * Template part for displaying jetpack portfolio.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Authority
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('aty-post-hover aty-border aty-draw aty-meet'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure>
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php the_post_thumbnail(); ?>
				<div class="aty-post-overlay">
					<h2><?php the_title(); ?></h2>
				</div>
			</a>
		</figure>
	<?php endif; ?>
</article><!-- #post-## -->
