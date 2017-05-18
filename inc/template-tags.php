<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package The Authority
 */

if ( ! function_exists( 'the_authority_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function the_authority_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="fa fa-clock-o" aria-hidden="true"></i>' . $time_string . '</a>'
	);

	$byline = sprintf(
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="fa fa-user" aria-hidden="true"></i>' . esc_html( get_the_author(), 'the-authority' ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline">' . $byline . '</span>'; // WPCS: XSS OK.

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'the-authority' ), esc_html__( '1', 'the-authority' ), esc_html__( '%', 'the-authority' ) );
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'the_authority_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function the_authority_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ' ', 'the-authority' ) );
		if ( $categories_list && the_authority_categorized_blog() ) {
			printf( '<div class="cat-links">' . esc_html__( '%1$s', 'the-authority' ) . '</div>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list();
		if ( $tags_list ) {
			printf( '<div class="tags-links">' . esc_html__( '%1$s', 'the-authority' ) . '</div>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link( esc_html__( 'Edit', 'the-authority' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function the_authority_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'the_authority_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'the_authority_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so the_authority_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so the_authority_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in the_authority_categorized_blog.
 */
function the_authority_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'the_authority_categories' );
}
add_action( 'edit_category', 'the_authority_category_transient_flusher' );
add_action( 'save_post',     'the_authority_category_transient_flusher' );

/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available
 *
 * @since authority 1.0
 */
 function the_authority_the_custom_logo() {
	 if ( function_exists( 'the_custom_logo') ) {
		 the_custom_logo();
	 }
 }
