<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Profix
 */

if ( ! function_exists( 'profi_shovondesign_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function profi_shovondesign_posted_on() {
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

	$year = get_the_time('Y');
	$months = get_the_time('m');

	$posted_on = sprintf(
		'<i class="fa fa-clock-o"></i><a href="' . esc_url( get_month_link( $year, $months ) ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		'<span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	$display_post_by = cs_get_option('post_by');
	$display_post_date = cs_get_option('post_date');

	if ( $display_post_date != true ) { } else {
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
	
	if ( $display_post_by != true ) { } else {
		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	}

}
endif;

if ( ! function_exists( 'profi_shovondesign_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function profi_shovondesign_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		$display_post_category = cs_get_option('post_category');
		$display_post_tag = cs_get_option('post_tag');

		/* translators: used between list items, there is a space after the comma */
		if ( $display_post_category != true ) { } else {
			$categories_list = get_the_category_list( esc_html__( ', ', 'profix' ) );
			if ( $categories_list && profi_shovondesign_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'profix' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
		}

		/* translators: used between list items, there is a space after the comma */
		if ( $display_post_tag != true ) { } else {
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'profix' ) );
			if ( $tags_list ) {
				echo '<span class="tags-links"><i class="fa fa-tags"></i>'.$tags_list.'</span>'; // WPCS: XSS OK.
			}
		}
	}

	$display_post_comment = cs_get_option('post_comment');

	if ( $display_post_comment != true ) { } else {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="fa fa-comment"></i>';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'profix' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'profix' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function profi_shovondesign_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'profi_shovondesign_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'profi_shovondesign_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so profi_shovondesign_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so profi_shovondesign_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in profi_shovondesign_categorized_blog.
 */
function profi_shovondesign_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'profi_shovondesign_categories' );
}
add_action( 'edit_category', 'profi_shovondesign_category_transient_flusher' );
add_action( 'save_post',     'profi_shovondesign_category_transient_flusher' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function profi_shovondesign_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'profi_shovondesign_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function profi_shovondesign_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'profi_shovondesign_pingback_header' );