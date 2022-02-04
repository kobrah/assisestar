<?php
/**
 * Define new and managed hook about woocommerce
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

/**
 * Change woocommerce page title
 */
add_filter( 'woocommerce_show_page_title', 'woocommerce_show_page_title_callback' );

function woocommerce_show_page_title_callback() {
?>
	<h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>
<?php
}

/**
 * Add starter wrapper before main content
 */
add_action( 'woocommerce_before_main_content', 'add_start_wrapper_before_main_content', 5 );

function add_start_wrapper_before_main_content() {
	echo '<div id="primary" class="content-area">';
	echo '<main id="main" class="site-main" role="main">';
}

/**
 * Add end wrapper before main content
 */
add_action( 'woocommerce_after_main_content', 'add_end_after_main_content', 15 );
function add_end_after_main_content() {
	echo '</main>';
	echo '</div>';
}

/**
 * Added class on body about columns
 */
add_action( 'body_class', 'news_portal_woo_body_class' );
if ( ! function_exists( 'news_portal_woo_body_class' ) ) {

	function news_portal_woo_body_class( $class ) {
        $np_woo_loop_columns = get_option( 'woocommerce_catalog_columns', 4 );
        $class[] = 'columns-'.absint( $np_woo_loop_columns );
        return $class;
	}
    
}

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * managed woocommerce breadcrumbs
 *
 * @since 1.0.0
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

$bread_option = get_theme_mod( 'np_breadcrumb_option', 'show' );
if (  $bread_option == 'hide' ) {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
}

add_filter( 'woocommerce_breadcrumb_defaults', 'np_woocommerce_breadcrumbs_option' );
function np_woocommerce_breadcrumbs_option() {

	$home_value = get_theme_mod( 'np_bread_home', __( 'Home', 'news-portal-pro' ) );
	$sep_value = get_theme_mod( 'np_bread_sep', '>' );

    return array(
            'delimiter'   => '<span class="sep">'. esc_html( $sep_value ) .'</span>',
            'wrap_before' => '<div class="np-breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList"><nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav></div>',
            'before'      => '<span>',
            'after'       => '</span>',
            'home'        => esc_html( $home_value ),
        );
}

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Managed single product page
 *
 * @since 1.0.0
 */

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );