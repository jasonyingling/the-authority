<?php
/**
 * The template for displaying all pages.
 *
 * Template name: Landing Page
 *
 * This template consists of a header, content, and footer
 * with no padding between. This can be useful if using page
 * builder plugins like Divi to create custom landing pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package The Authority
 */

 get_header(); ?>

    <div class="aty-full-container">

 			<?php while ( have_posts() ) : the_post(); ?>

 				<?php the_content() ?>

 			<?php endwhile; // End of the loop. ?>

    </div>

 <?php get_footer(); ?>
