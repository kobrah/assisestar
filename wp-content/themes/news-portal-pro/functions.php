<?php

/**
 * News Portal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */
if ( !function_exists( 'news_portal_setup' ) ) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function news_portal_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on News Portal, use a find and replace
         * to change 'news-portal-pro' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'news-portal-pro', get_template_directory() . '/languages' );
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        add_image_size(
            'news-portal-block-thumb',
            136,
            102,
            true
        );
        add_image_size(
            'news-portal-block-medium',
            305,
            207,
            true
        );
        add_image_size(
            'news-portal-block-large',
            784,
            420,
            true
        );
        add_image_size(
            'news-portal-list-medium',
            464,
            290,
            true
        );
        add_image_size(
            'news-portal-slider-large',
            1172,
            398,
            true
        );
        add_image_size(
            'news-portal-slider-medium',
            622,
            420,
            true
        );
        add_image_size(
            'news-portal-carousel-portrait',
            400,
            600,
            true
        );
        add_image_size(
            'news-portal-alternate-grid',
            340,
            316,
            true
        );
        add_image_size(
            'news-portal-horizontal-thumb',
            580,
            195,
            true
        );
        add_image_size(
            'news-portal-portrait-thumb',
            305,
            420,
            true
        );
        add_image_size(
            'news-portal-small-square-thumb',
            321,
            257,
            true
        );
        add_image_size(
            'news-portal-large-square-thumb',
            540,
            501,
            true
        );
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'news_portal_top_menu'     => esc_html__( 'Top Menu', 'news-portal-pro' ),
            'news_portal_primary_menu' => esc_html__( 'Primary Menu', 'news-portal-pro' ),
            'news_portal_footer_menu'  => esc_html__( 'Footer Menu', 'news-portal-pro' ),
        ) );
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ) );
        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support( 'post-formats', array(
            'aside',
            'gallery',
            'video',
            'audio'
        ) );
        // Add theme support for Custom Logo.
        add_theme_support( 'custom-logo', array(
            'width'       => 300,
            'height'      => 45,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'news_portal_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );
        /*
         * Redirect to theme welcome page after theme activation
         */
        global  $pagenow ;
        
        if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
            wp_redirect( admin_url( "themes.php?page=news-portal-pro-settings" ) );
            // theme welcome page
        }
        
        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
    }

}
add_action( 'after_setup_theme', 'news_portal_setup' );
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function news_portal_content_width()
{
    $GLOBALS['content_width'] = apply_filters( 'news_portal_content_width', 640 );
}

add_action( 'after_setup_theme', 'news_portal_content_width', 0 );
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set the theme version
 *
 * @global int $news_portal_pro_version
 * @since 1.0.0
 */
function news_portal_theme_version()
{
    $news_portal_theme_info = wp_get_theme();
    $GLOBALS['news_portal_pro_version'] = $news_portal_theme_info->get( 'Version' );
}

add_action( 'after_setup_theme', 'news_portal_theme_version', 0 );
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function news_portal_pingback_header()
{
    if ( is_singular() && pings_open() ) {
        echo  '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">' ;
    }
}

add_action( 'wp_head', 'news_portal_pingback_header' );
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
/**
 * Load breadcrumb file.
 */
require get_template_directory() . '/inc/np-breadcrumbs.php';
/**
 * Load Widget function file
 */
require get_template_directory() . '/inc/widgets/np-widget-functions.php';
/**
 * Load dynamic styles
 */
require get_template_directory() . '/inc/np-dynamic-styles.php';
/**
 * Custom files for hook
 */
require get_template_directory() . '/inc/hooks/np-header-hooks.php';
require get_template_directory() . '/inc/hooks/np-widget-hooks.php';
require get_template_directory() . '/inc/hooks/np-custom-hooks.php';
require get_template_directory() . '/inc/hooks/np-footer-hooks.php';
/**
 * Woocommerce Setup
 */

if ( is_woocommerce_activated() ) {
    require get_template_directory() . '/inc/hooks/np-woo-hooks.php';
    /**
     * Load WooCommerce theme support.
     */
    function news_portal_woocommerce_support()
    {
        add_theme_support( 'woocommerce' );
    }
    
    add_action( 'after_setup_theme', 'news_portal_woocommerce_support' );
}

/**
 * Load metabox file for posts
 */
require get_template_directory() . '/inc/metaboxes/np-post-metabox.php';
require get_template_directory() . '/inc/metaboxes/np-author-info.php';
/**
 * Load welcome pages
 */
//require get_template_directory() . '/inc/welcome/welcome.php';
require get_template_directory() . '/inc/theme-settings/mt-theme-settings.php';

if ( !function_exists( 'mt_freemius_sdk' ) ) {
    // Create a helper function for easy SDK access.
    function mt_freemius_sdk()
    {
        global  $mt_freemius_sdk ;
        
        if ( !isset( $mt_freemius_sdk ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $mt_freemius_sdk = fs_dynamic_init( array(
                'id'              => '5941',
                'slug'            => 'news-portal-pro',
                'premium_slug'    => 'news-portal-pro',
                'type'            => 'theme',
                'public_key'      => 'pk_851249a3e5ddd367a3fb6935e5c7e',
                'is_premium'      => true,
                'is_premium_only' => true,
                'has_addons'      => false,
                'has_paid_plans'  => true,
                'menu'            => array(
                'slug'    => 'news-portal-pro-settings',
                'support' => false,
                'parent'  => array(
                'slug' => 'themes.php',
            ),
            ),
                'is_live'         => true,
            ) );
        }
        
        return $mt_freemius_sdk;
    }
    
    // Init Freemius.
    mt_freemius_sdk();
    // Signal that SDK was initiated.
    do_action( 'mt_freemius_sdk_loaded' );
}
