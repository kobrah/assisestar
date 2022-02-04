<?php
/**
 * Custom hooks functions are define about footer section.
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_footer_start' ) ) :

	function np_footer_start() {
		$np_widget_bg_type = get_theme_mod( 'np_footer_widget_bg_type', 'bg_color' );
		$np_widget_bg_image = get_theme_mod( 'np_widget_bg_image', '' );
		if ( $np_widget_bg_type == 'bg_image' ) {
			echo '<footer id="colophon" class="site-footer np-widget-bg-img" role="contentinfo" style="background-image:url('. esc_url( $np_widget_bg_image ) .'); background-position: center; background-attachment: fixed; background-size: cover;">';
		} else {
			echo '<footer id="colophon" class="site-footer np-widget-bg-color" role="contentinfo">';
		}
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer widget section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_footer_widget_section' ) ) :

	function np_footer_widget_section() {
		get_sidebar( 'footer' );
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_bottom_footer_start' ) ) :

	function np_bottom_footer_start() {
		$np_sub_footer_layout = get_theme_mod( 'np_sub_footer_layout', 'default' );
		echo '<div class="bottom-footer '. esc_attr( $np_sub_footer_layout ) .' np-clearfix">';
		echo '<div class="mt-container">';
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer side info
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_footer_site_info_section' ) ) :

	function np_footer_site_info_section() {
?>
		<div class="site-info wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
			<span class="np-copyright-text">
				<?php 
					$np_copyright_text = get_theme_mod( 'np_copyright_text', __( 'News Portal', 'news-portal-pro' ) );
					echo wp_kses_post( $np_copyright_text );
				?>
			</span>
		</div><!-- .site-info -->
<?php
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer menu
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_footer_menu_section' ) ) :

	function np_footer_menu_section() {
?>
		<nav id="footer-navigation" class="footer-navigation" role="navigation">
			<button class="menu-toggle hide" aria-controls="footer-menu" aria-expanded="false"><?php esc_html_e( 'Footer Menu', 'news-portal-pro' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'news_portal_footer_menu', 'menu_id' => 'footer-menu' ) );
			?>
		</nav><!-- #site-navigation -->
<?php
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer end
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_bottom_footer_end' ) ) :

	function np_bottom_footer_end() {
		echo '</div><!-- .mt-container -->';
		echo '</div> <!-- bottom-footer -->';
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer end
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_footer_end' ) ) :

	function np_footer_end() {
		echo '</footer><!-- #colophon -->';
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Go to Top Icon
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_go_top' ) ) :

	function np_go_top() {
		echo '<div id="np-scrollup" class="animated arrow-hide"><i class="fa fa-chevron-up"></i></div>';
	}
	
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Managed functions for footer hook
 *
 * @since 1.0.0
 */
add_action( 'news_portal_footer', 'np_footer_start', 5 );
add_action( 'news_portal_footer', 'np_footer_widget_section', 10 );
add_action( 'news_portal_footer', 'np_bottom_footer_start', 15 );
add_action( 'news_portal_footer', 'np_footer_site_info_section', 20 );
add_action( 'news_portal_footer', 'np_footer_menu_section', 25 );
add_action( 'news_portal_footer', 'np_bottom_footer_end', 30 );
add_action( 'news_portal_footer', 'np_footer_end', 35 );
add_action( 'news_portal_footer', 'np_go_top', 40 );