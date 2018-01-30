<?php
/**
 * The template for displaying all pages.
 *
 * Template name: Full Banner and Sidebar
 * Template Post Type: post, page, jetpack-testimonial, jetpack-portfolio
 *
 * This template can be used to create a page
 * with a sidebar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Authority
 */

 get_header(); ?>

 	<div id="primary" class="content-area-full content-full-width">
 		<main id="main" class="site-main" role="main">

 			<?php while ( have_posts() ) : the_post(); ?>

 				<?php get_template_part( 'template-parts/content', 'banner-sidebar' ); ?>

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
