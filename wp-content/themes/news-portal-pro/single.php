<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

get_header(); 

$get_post_id = get_the_ID();

$this_post_layout = get_post_meta( $get_post_id, 'single_post_layout', true );
if ( $this_post_layout == 'default_layout' || empty( $this_post_layout ) ) {
	$this_post_layout = get_theme_mod( 'np_posts_layout', 'layout1' );
}

if ( $this_post_layout == 'layout3' ) {
	echo '<div class="np-post-image-wrapper">';

	$get_post_format 	 = get_post_format();
	$post_featured_video = get_post_meta( $get_post_id, 'post_featured_video', true );
	$post_embed_audio 	 = get_post_meta( $get_post_id, 'post_embed_audio', true );
	$post_embed_gallery  = get_post_meta( $get_post_id, 'post_images', true );

	if ( $get_post_format == 'video' && !empty( $post_featured_video ) ) {
?>
		<div class="np-article-video fitvids-video">
			<div class="video-wrap">
                <?php echo wp_oembed_get( $post_featured_video ); ?>
            </div><!-- .video-wrap -->
		</div><!-- .np-article-video -->
<?php } elseif ( $get_post_format == 'audio' ) { ?>
		<div class="np-article-thumb">
			<?php if ( has_post_thumbnail() ) { ?>
				<figure>
					<?php the_post_thumbnail( 'full' ); ?>
				</figure>
			<?php } ?>
		</div><!-- .single-post-image -->
		<?php if ( !empty( $post_embed_audio ) ) { ?>
			<div class="post-audio"><?php echo do_shortcode( '[audio src="'.$post_embed_audio. '"]' ); ?></div>
		<?php } ?>
<?php } elseif ( $get_post_format == 'gallery' && !empty( $post_embed_gallery ) ) { ?>
		<div class="post-gallery-wrapper">
			<ul class="embed-gallery cS-hidden">
				<?php 
					foreach ( $post_embed_gallery as $key => $value ) {
						$image_id = news_portal_get_image_id_from_url( $value );
						$image_path = wp_get_attachment_image_src( $image_id, 'full', true );
						$full_image_path = wp_get_attachment_image_src( $image_id, 'full', true );
						$image_alt  = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
				?>
						<li><a href="<?php echo esc_url( $full_image_path[0] ); ?>" rel="prettyPhoto[embed-img]"><img src="<?php echo esc_url( $image_path[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" /></a></li>
				<?php
					}
				?>
			</ul>
		</div><!-- .post-gallery-wrapper -->
<?php } else { ?>
		<div class="np-article-thumb">
			<?php if ( has_post_thumbnail() ) { ?>
				<figure>
					<?php the_post_thumbnail( 'full' ); ?>
				</figure>
			<?php } ?>
		</div><!-- .np-article-thumb -->
<?php } ?>

	<header class="entry-header">
		<?php 
			news_portal_post_categories_list();
			the_title( '<h1 class="entry-title">', '</h1>' );
		?>
		<div class="entry-meta">
			<?php news_portal_inner_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
<?php
	echo '</div><!-- .np-post-image-wrapper -->';
	echo '<div class="np-post-content-wrapper">';
}

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		switch ( $this_post_layout ) {
			case 'layout2':
				$req_file = 'two';
				break;

			case 'layout3':
				$req_file = 'three';
				break;

			case 'layout4':
				$req_file = 'four';
				break;

			default:
				$req_file = 'one';
				break;
		}
		while ( have_posts() ) : the_post();

			get_template_part( 'layouts/posts/layout', $req_file );

			news_portal_single_tag_lists();

			$np_posts_review_option = get_theme_mod( 'np_posts_review_option', 'show' );
			$get_review_option = get_post_meta( $get_post_id, 'post_review_option', true );
			$post_review_option_value = empty( $get_review_option ) ? 'no_review' : $get_review_option;
			if ( $np_posts_review_option == 'show' && $post_review_option_value != 'no_review' ) {

				/**
			     * news_portal_post_review_section hook
			     *
			     * @hooked - np_review_section_start - 5
			     * @hooked - np_review_section_title - 10
			     * @hooked - np_review_content_start - 15
			     * @hooked - np_star_review_section - 20
			     * @hooked - np_percent_review_section - 25
			     * @hooked - np_review_summary_section - 30
			     * @hooked - np_review_content_end - 35
			     * @hooked - np_review_section_end - 40
			     *
			     * @since 1.0.0
			     */
				do_action( 'news_portal_post_review_section' );
			}

			//news_portal_post_share();

			the_post_navigation();

			$np_posts_author_option = get_theme_mod( 'np_posts_author_option', 'show' );
			if ( $np_posts_author_option == 'show' ) {
				/**
			     * news_portal_author_box hook
			     *
			     * @hooked - np_author_box_start - 5
			     * @hooked - np_author_avatar_section - 10
			     * @hooked - np_author_description_section - 15
			     * @hooked - np_author_box_end - 20
			     *
			     * @since 1.0.0
			     */
				do_action( 'news_portal_author_box' );
			}

			$np_related_posts_option = get_theme_mod( 'np_related_posts_option', 'show' );
			if ( $np_related_posts_option == 'show' ) {
				/**
			     * news_portal_related_posts hook
			     *
			     * @hooked - np_related_posts_start - 5
			     * @hooked - np_related_posts_section - 10
			     * @hooked - np_related_posts_end - 15
			     *
			     * @since 1.0.0
			     */
			    do_action( 'news_portal_related_posts' );
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

news_portal_set_post_views( $get_post_id );

news_portal_get_sidebar();
if ( $this_post_layout == 'layout3' ) {
	echo '</div><!-- .np-post-content-wrapper -->';
}
get_footer();