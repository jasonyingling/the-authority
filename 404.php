<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package The Authority
 */

get_header(); ?>

<div class="container">

	<div id="primary" class="content-area-full">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">

				<article class="error-404-copy">
					<header class="page-header">
						<h2 class="error-title"><?php esc_html_e( '404', 'the-authority' ); ?></h2>
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found', 'the-authority' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'Try a search to find what you\'re looking for.', 'the-authority' ); ?></p>

						<?php get_search_form(); ?>

					</div><!-- .page-content -->
				</article>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

</div>

<?php get_footer(); ?>
