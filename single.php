<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package The Authority
 */

get_header(); ?>

	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<div class="aty-post-navigation">
				<?php the_post_navigation(array(
					'prev_text'                  => __( '<strong>Previous</strong><br> %title', 'the-authority' ),
		            'next_text'                  => __( '<strong>Next</strong><br> %title', 'the-authority' ),
		            'screen_reader_text' => __( 'Continue Reading', 'the-authority' ),
				)); ?>
			</div>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					echo '<section class="comments-section">';
					comments_template();
					echo '</section><!-- .comments-section -->';
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
