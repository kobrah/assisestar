<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'news_portal_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function news_portal_posted_on() {
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
			/* translators: %s: post date. */
			esc_html_x( ' %s', 'post date', 'news-portal-pro' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( ' %s', 'post author', 'news-portal-pro' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		$post_date_option = get_theme_mod( 'np_widget_post_date', 'show' );
		$post_author_option = get_theme_mod( 'np_widget_post_author', 'show' );

		if ( $post_date_option == 'show' ) {
			echo '<span class="posted-on">' . $posted_on . '</span>';
		}

		if ( $post_author_option == 'show' ) {
			echo '<span class="byline"> ' . $byline . '</span>';
		}

	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'news_portal_post_comment' ) ) :

	/**
	 * Comment for homepage post
	 */
	function news_portal_post_comment() {

		$post_comment_option = get_theme_mod( 'np_widget_post_comment', 'show' );
		if ( $post_comment_option == 'hide' ) {
			return;
		}

		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( '0 ', 'news-portal-pro' ), esc_html__( '1 ', 'news-portal-pro' ), esc_html__( '%s ', 'news-portal-pro' ) );
		echo '</span>';
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'news_portal_inner_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function news_portal_inner_posted_on() {
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
			/* translators: %s: post date. */
			esc_html_x( ' %s', 'post date', 'news-portal-pro' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( ' %s', 'post author', 'news-portal-pro' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		$post_view_count = news_portal_get_post_views( get_the_ID() );
		echo '<span class="post-view">'. absint( $post_view_count ) .'</span>';

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'news-portal-pro' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'news_portal_single_tag_lists' ) ) :

	/**
	 * Prints HTML with meta information for the tags.
	 */
	function news_portal_single_tag_lists() {
		if ( is_single() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'news-portal-pro' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'news-portal-pro' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'news_portal_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function news_portal_entry_footer() {
		
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'news-portal-pro' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function news_portal_categorized_blog() {
	$all_the_cool_cats = get_transient( 'news_portal_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'news_portal_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 || is_preview() ) {
		// This blog has more than 1 category so news_portal_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so news_portal_categorized_blog should return false.
		return false;
	}
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Flush out the transients used in news_portal_categorized_blog.
 */
function news_portal_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'news_portal_categories' );
}
add_action( 'edit_category', 'news_portal_category_transient_flusher' );
add_action( 'save_post',     'news_portal_category_transient_flusher' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Categories list in multiple color background
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_post_categories_list' ) ) :

	function news_portal_post_categories_list() {
		global $post;
		$post_id = $post->ID;
		$categories_list = get_the_category($post_id);
		if ( !empty( $categories_list ) ) {
?>
		<div class="post-cats-list">
			<?php 
				foreach ( $categories_list as $cat_data ) {
					$cat_name = $cat_data->name;
					$cat_id = $cat_data->term_id;
					$cat_link = get_category_link( $cat_id );
			?>
				<span class="category-button np-cat-<?php echo esc_attr( $cat_id ); ?>"><a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a></span>
			<?php 
				}
			?>
		</div>
<?php
		}
	}
	
endif;