<?php

if ( ! function_exists( 'skilled_entry_meta' ) ) {

	/**
	 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	 *
	 * @return void
	 */
	function skilled_entry_meta() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="featured-post">' . esc_html__( 'Sticky', 'skilled' ) . '</span>';
		}

		if ( ! has_post_format( 'link' ) && 'post' == get_post_type() ) {
			echo skilled_entry_date();
		}

		// Post author
		if ( 'post' == get_post_type() ) {
			printf( '<i class="lnr lnr-user"></i><span class="author vcard">%1$s <a class="url fn n" href="%2$s" title="%3$s" rel="author">%4$s</a></span>', esc_html__( 'Posted by', 'skilled' ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( esc_html__( 'View all posts by %s', 'skilled' ), get_the_author() ) ), get_the_author() );

			$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

			if ( $num_comments == 0 ) {

			} else {

				if ( $num_comments > 1 ) {
					$comments = $num_comments . esc_html__( ' Comments', 'skilled' );
				} else {
					$comments = esc_html__( '1 Comment', 'skilled' );
				}
				echo '<span class="comments-count"><i class="fa fa-comment-o"></i><a href="' . get_comments_link() . '">' . get_comments_number() . '</a></span>';
			}

		}

		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( esc_html__( ', ', 'skilled' ) );
		if ( $categories_list ) {
			echo '<i class="lnr lnr-flag"></i><span class="categories-links">' . $categories_list . '</span>';
		}

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', esc_html__( ', ', 'skilled' ) );
		if ( $tag_list ) {
			echo '<i class="fa fa-tag"></i><span class="tags-links">' . $tag_list . '</span>';
		}


	}
}

if ( ! function_exists( 'skilled_entry_date' ) ) {

	/**
	 * Prints HTML with date information for current post.
	 *
	 * @param boolean $echo Whether to echo the date. Default true.
	 *
	 * @return string The HTML-formatted post date.
	 */
	function skilled_entry_date() {
		if ( has_post_format( array( 'chat', 'status' ) ) ) {
			$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'skilled' );
		} else {
			$format_prefix = '%2$s';
		}

		$date = sprintf( '<span class="date"><i class="lnr lnr-clock"></i><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>', esc_url( get_permalink() ),
			esc_attr( sprintf( esc_html__( 'Permalink to %s', 'skilled' ), the_title_attribute( 'echo=0' ) ) ), esc_attr( get_the_date( 'c' ) ), esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) ) );

		return $date;
	}

}
