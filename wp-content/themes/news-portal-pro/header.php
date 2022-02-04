<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
		/**
	     * news_portal_before_page hook
	     *
	     * @hooked - news_portal_preloader - 5
	     *
	     * @since 1.0.0
	     */
	    do_action( 'news_portal_before_page' );
	?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'news-portal-pro' ) ;?></a>

	<?php 
		$np_top_header_option = get_theme_mod( 'np_top_header_option', 'show' );
		if ( $np_top_header_option == 'show' ) {
			
			/**
		     * news_portal_top_header hook
		     *
		     * @hooked - np_top_header_start - 5
		     * @hooked - np_top_left_section - 10
		     * @hooked - np_top_right_section - 15
		     * @hooked - np_top_header_end - 20
		     *
		     * @since 1.0.0
		     */
		    do_action( 'news_portal_top_header' );
		}

		/**
		 * Header section
		 */
	    $np_header_layout = get_theme_mod( 'np_header_layout', 'default' );
	    switch ( $np_header_layout ) {
	    	case 'layout1':
	    		get_template_part( 'layouts/header/layout', 'one' );
	    		break;

	    	case 'layout2':
	    		get_template_part( 'layouts/header/layout', 'two' );
	    		break;
	    	
	    	default:
	    		get_template_part( 'layouts/header/layout', 'default' );
	    		break;
	    }
	    
		$np_ticker_option = get_theme_mod( 'np_ticker_option', 'show' );
		if ( $np_ticker_option == 'show' && is_front_page() ) {

			/**
		     * news_portal_top_header hook
		     *
		     * @hooked - np_ticker_section_start - 5
		     * @hooked - np_ticker_content - 10
		     * @hooked - np_ticker_section_end - 15
		     *
		     * @since 1.0.0
		     */
		    do_action( 'news_portal_ticker_section' );
		}
	?>

	<div id="content" class="site-content">
		<div class="mt-container">
			<?php 
				$mt_body_classes = get_body_class();
		        if ( in_array( 'woocommerce', $mt_body_classes ) ) {
		            woocommerce_breadcrumb();
		        } else {
		        	news_portal_breadcrumbs();
		        }
			?>