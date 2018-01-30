<?php
/**
 * Template part for displaying jetpack portfolio.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Authority
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('aty-testimonial'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure>
			<?php the_post_thumbnail(); ?>
		</figure>
	<?php endif; ?>

	<div class="aty-testimonial-content">
		<?php the_content(); ?>
		<h2 class="aty-testimonial-title"><?php the_title(); ?></h2>
	</div>

</article><!-- #post-## -->
