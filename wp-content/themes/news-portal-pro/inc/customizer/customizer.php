<?php
/**
 * News Portal Theme Customizer
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_portal_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
    $wp_customize->selective_refresh->add_partial( 
        'blogname', 
            array(
                'selector' => '.site-title a',
                'render_callback' => 'news_portal_customize_partial_blogname',
            )
    );

    $wp_customize->selective_refresh->add_partial( 
        'blogdescription', 
            array(
                'selector' => '.site-description',
                'render_callback' => 'news_portal_customize_partial_blogdescription',
            )
    );

}
add_action( 'customize_register', 'news_portal_customize_register' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function news_portal_customize_preview_js() {

    wp_enqueue_script( 'jquery-ui-slider' );

	wp_enqueue_script( 'news-portal-google-webfont', get_template_directory_uri() . '/assets/js/webfontloader.js', array( 'jquery' ) );

    wp_enqueue_script( 'news_portal_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20170815', true );
}
add_action( 'customize_preview_init', 'news_portal_customize_preview_js' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */
function news_portal_customize_backend_scripts() {

    global $news_portal_pro_version;

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

    //wp_enqueue_style( 'jquery-ui', esc_url( get_template_directory_uri() . '/assets/css/jquery-ui.css' ) );
    
    wp_enqueue_style( 'news_portal_admin_customizer_style', get_template_directory_uri() . '/assets/css/np-customizer-style.css' );

    wp_enqueue_script( 'ajax_script_function', get_template_directory_uri(). '/assets/js/typo-ajax.js', array('jquery'), esc_attr( $news_portal_pro_version ), true );

    wp_localize_script( 'ajax_script_function', 'ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

    wp_enqueue_script( 'news_portal_admin_customizer', get_template_directory_uri() . '/assets/js/np-customizer-controls.js', array( 'jquery', 'customize-controls' ), esc_attr( $news_portal_pro_version ), true );
}
add_action( 'customize_controls_enqueue_scripts', 'news_portal_customize_backend_scripts', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load required files for customizer section
 *
 * @since 1.0.0
 */

require get_template_directory() . '/inc/customizer/np-general-panel.php';          // General Settings
require get_template_directory() . '/inc/customizer/np-header-panel.php';  		    // Header Settings
require get_template_directory() . '/inc/customizer/np-additional-panel.php';       // Additional Settings
require get_template_directory() . '/inc/customizer/np-design-panel.php';           // Design Settings
require get_template_directory() . '/inc/customizer/np-footer-panel.php';           // Footer Settings
require get_template_directory() . '/inc/customizer/np-typography-panel.php';       // Typography Settings

require get_template_directory() . '/inc/customizer/np-custom-classes.php';         // Custom Classes
require get_template_directory() . '/inc/customizer/np-customizer-sanitize.php';    // Customizer Sanitize