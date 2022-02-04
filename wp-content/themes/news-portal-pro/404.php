<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
				$np_pnf_layout 		 = get_theme_mod( 'np_pnf_layout', 'default' );
				$np_pnf_image 		 = get_theme_mod( 'np_pnf_image', '' );
				$np_pnf_headline 	 = get_theme_mod( 'np_pnf_headline', __( 'Ooops... Error 404', 'news-portal-pro' ) );
				$np_pnf_content   	 = get_theme_mod( 'np_pnf_content', __( 'Sorry, but the page you are looking for doesn`t exist.', 'news-portal-pro' ) );
				$np_pnf_button_label = get_theme_mod( 'np_pnf_button_label', __( 'Home Page', 'news-portal-pro' ) );
				$np_pnf_button_link  = get_theme_mod( 'np_pnf_button_link', esc_url( home_url() ) );
				$np_pnf_latest_posts_option = get_theme_mod( 'np_pnf_latest_posts_option', 'show' );
			?>

			<?php if ( $np_pnf_layout == 'default' ) { ?>
				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'news-portal-pro' ); ?></h1>
					</header><!-- .page-header -->
					<div class="error-num"> <?php esc_html_e( '404', 'news-portal-pro' ); ?> <span><?php esc_html_e( 'error', 'news-portal-pro' );?></span> </div>
					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'news-portal-pro' ); ?></p>
					</div><!-- .page-content -->
				</section><!-- .error-404 -->
			<?php } else { ?>

				<section class="error-404 not-found pnf-extra">
					<div class="top-wrapper-404">
						<div class="pnf-thumb">
							<?php 
								if ( !empty( $np_pnf_image ) ) {
									echo '<image src="'. esc_url( $np_pnf_image ) .'" />';
								}
							?>
						</div>
						<header class="page-header">
							<h1 class="page-title"><?php echo wp_kses_post( $np_pnf_headline ); ?></h1>
						</header><!-- .page-header -->
						<div class="pnf-content"><?php echo wp_kses_post( $np_pnf_content ); ?></div>
						<a href="<?php echo esc_url( $np_pnf_button_link ); ?>" class="pnf-button btn"><?php echo esc_html( $np_pnf_button_label ); ?></a>
					</div><!-- .404-top-wrapper -->
					<?php if ( $np_pnf_latest_posts_option == 'show' ) { ?>
						<div class="page-extra-content">
							<?php
								$np_pnf_post_count = apply_filters( 'news_portal_404_latest_posts_count', 12 );
								$np_pnf_args = array(
									'post_type' 	=> 'post',
									'posts_per_page' => absint( $np_pnf_post_count )
								);
								$np_pnf_query = new WP_Query( $np_pnf_args );
								if ( $np_pnf_query->have_posts() ) {
									echo '<div class="np-pnf-latest-posts-wrapper">';
									echo '<h2 class="section-title">'. esc_html( 'Latest Posts', 'news-portal-pro' ) .'</h2>';
									while ( $np_pnf_query->have_posts() ) {
										$np_pnf_query->the_post();
							?>
										<div class="np-single-post np-clearfix <?php news_portal_post_format_icon(); ?>">
											<div class="np-post-thumb">
												<a href="<?php the_permalink(); ?>">
						                            <figure><?php news_portal_widget_featured_image( 'news-portal-slider-medium' ); ?></figure>
												</a>
											</div><!-- .np-post-thumb -->
											<div class="np-post-content">
												<?php news_portal_post_categories_list(); ?>
												<h3 class="np-post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<div class="np-post-meta">
						                            <?php news_portal_posted_on(); ?>
						                            <?php news_portal_post_comment(); ?>
						                        </div>
											</div><!-- .np-post-content -->
										</div><!-- .np-single-post -->
							<?php
									}
									echo '</div><!-- .np-pnf-latest-posts-wrapper -->';
								}
								wp_reset_postdata();
							?>
						</div><!-- .page-extra-content -->
					<?php } ?>
				</section><!-- .error-404 -->
			<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();