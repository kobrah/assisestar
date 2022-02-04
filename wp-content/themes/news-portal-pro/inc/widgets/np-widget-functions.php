<?php
/**
 * News Portal custom function and work related to widgets.
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function news_portal_widgets_init() {
	
	/**
	 * Register right sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'news-portal-pro' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register left sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'news-portal-pro' ),
		'id'            => 'np_left_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register header ads area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Header Ads', 'news-portal-pro' ),
		'id'            => 'np_header_ads_area',
		'description'   => esc_html__( 'Add banner widgets here.', 'news-portal-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register home top section area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Top Section', 'news-portal-pro' ),
		'id'            => 'np_home_top_section_area',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="np-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register home middle section area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Middle Section', 'news-portal-pro' ),
		'id'            => 'np_home_middle_section_area',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="np-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register home middle aside area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Middle Aside', 'news-portal-pro' ),
		'id'            => 'np_home_middle_aside_area',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="np-block-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register home middle fullwidth area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Middle (FullWidth)', 'news-portal-pro' ),
		'id'            => 'np_home_middle_fullwidth_area',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="np-block-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register home bottom section area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Bottom Section', 'news-portal-pro' ),
		'id'            => 'np_home_bottom_section_area',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="np-block-title">',
		'after_title'   => '</h2>',
	) );

	/**
	 * Register home bottom aside area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Bottom Aside', 'news-portal-pro' ),
		'id'            => 'np_home_bottom_aside_area',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="np-block-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register home bottom fullwidth area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Bottom (FullWidth)', 'news-portal-pro' ),
		'id'            => 'np_home_bottom_fullwidth_area',
		'description'   => esc_html__( 'Add widgets here.', 'news-portal-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="np-block-title">',
		'after_title'   => '</h4>',
	) );	

	/**
	 * Register 4 different footer area 
	 *
	 * @since 1.0.0
	 */
	register_sidebars( 4 , array(
		'name'          => esc_html__( 'Footer %d', 'news-portal-pro' ),
		'id'            => 'news_portal_footer_sidebar',
		'description'   => esc_html__( 'Added widgets are display at Footer Widget Area.', 'news-portal-pro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	if ( is_woocommerce_activated() ) {
		/**
		 * Register shop sidebar
		 *
		 * @since 1.0.0
		 */
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'news-portal-pro' ),
			'id'            => 'np_shop_sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'news-portal-pro' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
}
add_action( 'widgets_init', 'news_portal_widgets_init' );

/*-----------------------------------------------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'news_portal_registers_widgets' );

if ( ! function_exists( 'news_portal_registers_widgets' ) ) :

	/**
	 * Registered required widget class
	 *
	 * @since 1.1.1
	 */
	function news_portal_registers_widgets() {

		//Ads Widget
		register_widget( 'News_Portal_Ads_Banner' );

		//Block Posts Widget
		register_widget( 'News_Portal_Block_Posts' );

		//Carousel Widget
		register_widget( 'News_Portal_Carousel' );

		//Default Tabbed Widget
		register_widget( 'News_Portal_Default_Tabbed' );

		//Featured Posts Widget
		register_widget( 'News_Portal_Featured_Posts' );

		//Featured Slider Widget
		register_widget( 'News_Portal_Featured_Slider' );

		//FullWidth Posts Widget
		register_widget( 'News_Portal_FullWidth_Posts' );

		// List Posts Widget
		register_widget( 'News_Portal_List_Posts' );

		// Recent Posts Widget
		register_widget( 'News_Portal_Recent_Posts' );

		// Review Posts Widget
		register_widget( 'News_Portal_Review_Posts' );

		// Slider Widget
		register_widget( 'News_Portal_Slider' );

		//Social Media Widget
		register_widget( 'News_Portal_Social_Media' );

	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load widget required files
 *
 * @since 1.0.0
 */

require get_template_directory() . '/inc/widgets/np-widget-fields.php';    // Widget fields
require get_template_directory() . '/inc/widgets/np-ads-banner.php';       // Ads banner widget
require get_template_directory() . '/inc/widgets/np-featured-slider.php';  // Featured Slider widget
require get_template_directory() . '/inc/widgets/np-slider.php';   		   // Slider widget
require get_template_directory() . '/inc/widgets/np-featured-posts.php';   // Featured posts widget
require get_template_directory() . '/inc/widgets/np-block-posts.php';      // Block posts widget
require get_template_directory() . '/inc/widgets/np-fullwidth-posts.php';  // FullWidth posts widget
require get_template_directory() . '/inc/widgets/np-social-media.php';     // Social Media widget
require get_template_directory() . '/inc/widgets/np-recent-posts.php';     // Recent Posts widget
require get_template_directory() . '/inc/widgets/np-default-tabbed.php';   // Default Tabbed widget

require get_template_directory() . '/inc/widgets/np-review-posts.php';     // Review Posts widget
require get_template_directory() . '/inc/widgets/np-list-posts.php';       // List Posts widget
require get_template_directory() . '/inc/widgets/np-carousel.php';         // Carousel widget

/*-----------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'news_portal_widget_featured_image' ) ) :

	/**
	 * Featured Image for widget with fallback
	 *
	 */
	function news_portal_widget_featured_image( $np_image_size ) {
		global $post;
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( $np_image_size );
		} else {
			$fb_img_url = get_theme_mod( 'np_post_fallback_image', '' );
			if ( empty( $fb_img_url ) ) {
				return;
			}
			$fb_img_id     = news_portal_get_image_id_from_url( $fb_img_url );
			$fb_image_path = wp_get_attachment_image_src( $fb_img_id, $np_image_size, true );
			$fb_image_alt  = get_post_meta( $fb_img_id, '_wp_attachment_image_alt', true );
			echo '<img src="'. esc_url( $fb_image_path[0] ) .'" alt="'. esc_attr( $fb_image_alt ) .'" />';
		}
	}
	
endif;