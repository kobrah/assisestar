<?php
/**
 * Template part for displaying post in layout two.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */
$get_post_id = get_the_ID();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
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
			the_title( '<h1 class="entry-title">', '</h1>' );
			news_portal_post_categories_list();
		?>
	</header><!-- .entry-header -->

	<div class="np-post-content-wrapper layout2">
		<div class="postmeta">
			<div class="post-on">
				<span class="date-day"><?php echo esc_html( get_the_date( 'd' ) ); ?></span>
				<span class="date-mth-yr"><?php echo esc_html( get_the_date( 'M Y' ) ); ?></span>
			</div><!-- .post-on -->
			<div class="extra-meta">
				<?php 
					$post_view_count = news_portal_get_post_views( $get_post_id );
					echo '<span class="post-view">'. absint( $post_view_count ) .'</span>';
					news_portal_post_comment();
				?>
			</div><!-- .extra-meta -->
		</div><!--. postmeta -->
		<div class="entry-content">
			<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'news-portal-pro' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'news-portal-pro' ),
					'after'  => '</div>',
				) );
			?>
			<footer class="entry-footer">
				<?php news_portal_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .entry-content -->
	</div><!-- .np-post-content-wrapper -->
	
</article><!-- #post-<?php the_ID(); ?> -->