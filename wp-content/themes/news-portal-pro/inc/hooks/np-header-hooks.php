<?php
/**
 * Custom hooks functions are define about header section.
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Top header start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_top_header_start' ) ) :

	function np_top_header_start() {
		echo '<div class="np-top-header-wrap">';
		echo '<div class="mt-container">';
	}

endif;

/**
 * Top header left section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_top_left_section' ) ) :

	function np_top_left_section() {
		$np_date_option = get_theme_mod( 'np_top_date_option', 'show' );
?>
		<div class="np-top-left-section-wrapper">
			<?php
				if ( $np_date_option == 'show' ) {
					echo '<div class="date-section">'. esc_html( date_i18n('l, F d, Y') ) .'</div>';
				}
			?>

			<?php if ( has_nav_menu( 'news_portal_top_menu' ) ) { ?>
				<nav id="top-navigation" class="top-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'news_portal_top_menu', 'menu_id' => 'top-menu' ) );
					?>
				</nav><!-- #site-navigation -->
			<?php } ?>
		</div><!-- .np-top-left-section-wrapper -->
<?php
	}

endif;

/**
 * Top header right section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_top_right_section' ) ) :

	function np_top_right_section() {
?>
		<div class="np-top-right-section-wrapper">
			<?php
				$np_top_social_option = get_theme_mod( 'np_top_social_option', 'show' );
				if ( $np_top_social_option == 'show' ) {
					news_portal_social_media();
				}
			?>
		</div><!-- .np-top-right-section-wrapper -->
<?php
	}

endif;

/**
 * Top header end
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_top_header_end' ) ) :

	function np_top_header_end() {
		echo '</div><!-- .mt-container -->';
		echo '</div><!-- .np-top-header-wrap -->';
	}

endif;

/**
 * Managed functions for top header hook
 *
 * @since 1.0.0
 */
add_action( 'news_portal_top_header', 'np_top_header_start', 5 );
add_action( 'news_portal_top_header', 'np_top_left_section', 10 );
add_action( 'news_portal_top_header', 'np_top_right_section', 15 );
add_action( 'news_portal_top_header', 'np_top_header_end', 20 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Ticker section start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_ticker_section_start' ) ) :

	function np_ticker_section_start() {
		$np_ticker_layout = get_theme_mod( 'np_ticker_layout', 'default' );
		echo '<div class="np-ticker-wrapper '. esc_attr( $np_ticker_layout ) .'-ticker">';
		echo '<div class="mt-container">';
		echo '<div class="np-ticker-block np-clearfix">';
	}

endif;

/**
 * Ticker caption
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_ticker_caption' ) ) :

	function np_ticker_caption() {
		$np_ticker_caption = get_theme_mod( 'np_ticker_caption', __( 'Breaking News', 'news-portal-pro' ) );
		echo '<span class="ticker-caption">'. esc_html( $np_ticker_caption ) .'</span>';
	}

endif;


/**
 * Ticker default content
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_ticker_default_content' ) ) :

	function np_ticker_default_content() {
		$np_ticker_type = get_theme_mod( 'np_ticker_type', 'default' );
		if ( $np_ticker_type == 'repeater' ) {
			return;
		}
		$np_ticker_cats_option = get_theme_mod( 'np_ticker_cats_option', 'true' );
		$np_ticker_post_count = get_theme_mod( 'np_ticker_post_count', 5 );
?>		
		<div class="ticker-content-wrapper">
			<?php
				$np_ticker_cat_id = apply_filters( 'np_ticker_cat_id', null );
				$ticker_args = array(
					'cat' => $np_ticker_cat_id,
					'posts_per_page' => intval( $np_ticker_post_count )
				);
				$ticker_query = new WP_Query( $ticker_args );
				if ( $ticker_query->have_posts() ) {
					echo '<ul id="newsTicker" class="cS-hidden">';
					while ( $ticker_query->have_posts() ) {
						$ticker_query->the_post();
			?>			
						<li>
							<div class="news-ticker-title">
								<?php
									if ( $np_ticker_cats_option == 'true' ) {
										news_portal_post_categories_list();
									}
								?>
								<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
							</div><!-- .news-ticker-title -->
						</li>
			<?php
					}
					echo '</ul>';
				}
				wp_reset_query();
			?>
		</div><!-- .ticker-content-wrapper -->
<?php
	}

endif;

/**
 * Ticker repeater content
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_ticker_repeater_content' ) ) :

	function np_ticker_repeater_content() {
		$np_ticker_type = get_theme_mod( 'np_ticker_type', 'default' );
		if ( $np_ticker_type == 'default' ) {
			return;
		}
		$get_ticker_json = get_theme_mod( 'np_ticker_repeater', '' );
		$get_decode_tickers = json_decode( $get_ticker_json );
?>
		<div class="ticker-content-wrapper">
			<?php
				if ( ! empty( $get_decode_tickers ) ) {
					echo '<ul id="newsTicker" class="cS-hidden">';
						foreach( $get_decode_tickers as $get_ticker ) {
							$ticker_content = $get_ticker->np_ticker_content;
			?>
							<li>
								<div class="news-ticker-content">
									<?php echo wp_kses_post( $ticker_content ); ?>
								</div>
							</li>
			<?php
						}
					echo '</ul>';
				}
			?>
		</div><!-- .ticker-content-wrapper -->
<?php
	}

endif;

/**
 * Ticker section end
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_ticker_section_end' ) ) :

	function np_ticker_section_end() {
		echo '</div><!-- .np-ticker-block -->';
		echo '</div><!-- .mt-container -->';
		echo '</div><!-- .np-ticker-wrapper -->';
	}
	
endif;

/**
 * Managed functions for ticker section
 *
 * @since 1.0.0
 */
add_action( 'news_portal_ticker_section', 'np_ticker_section_start', 5 );
add_action( 'news_portal_ticker_section', 'np_ticker_caption', 10 );
add_action( 'news_portal_ticker_section', 'np_ticker_default_content', 15 );
add_action( 'news_portal_ticker_section', 'np_ticker_repeater_content', 20 );
add_action( 'news_portal_ticker_section', 'np_ticker_section_end', 25 );