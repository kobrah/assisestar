<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function news_portal_body_classes( $classes ) {

    global $post;
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    /**
     * Sidebar option for post/page/archive
     *
     * @since 1.0.0
     */
    if ( 'post' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'single_post_sidebar', true );
    }

    if ( 'page' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'single_post_sidebar', true );
    }
     
    if ( is_home() ) {
        $home_id = get_option( 'page_for_posts' );
        $sidebar_meta_option = get_post_meta( $home_id, 'single_post_sidebar', true );
    }
    
    if ( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
        $sidebar_meta_option = 'default_sidebar';
    }
    $archive_sidebar        = get_theme_mod( 'np_archive_sidebar', 'right_sidebar' );
    $post_default_sidebar   = get_theme_mod( 'np_default_post_sidebar', 'right_sidebar' );
    $page_default_sidebar   = get_theme_mod( 'np_default_page_sidebar', 'right_sidebar' );
    
    if ( $sidebar_meta_option == 'default_sidebar' ) {
        if ( is_single() ) {
            if ( $post_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif ( $post_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif ( $post_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar';
            } elseif ( $post_default_sidebar == 'no_sidebar_center' ) {
                $classes[] = 'no-sidebar-center';
            }
        } elseif ( is_page() && !is_page_template( 'templates/home-template.php' ) ) {
            if ( $page_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif ( $page_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif ( $page_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar';
            } elseif ( $page_default_sidebar == 'no_sidebar_center' ) {
                $classes[] = 'no-sidebar-center';
            }
        } elseif ( $archive_sidebar == 'right_sidebar' ) {
            $classes[] = 'right-sidebar';
        } elseif ( $archive_sidebar == 'left_sidebar' ) {
            $classes[] = 'left-sidebar';
        } elseif ( $archive_sidebar == 'no_sidebar' ) {
            $classes[] = 'no-sidebar';
        } elseif ( $archive_sidebar == 'no_sidebar_center' ) {
            $classes[] = 'no-sidebar-center';
        }
    } elseif ( $sidebar_meta_option == 'right_sidebar' ) {
        $classes[] = 'right-sidebar';
    } elseif ( $sidebar_meta_option == 'left_sidebar' ) {
        $classes[] = 'left-sidebar';
    } elseif ( $sidebar_meta_option == 'no_sidebar' ) {
        $classes[] = 'no-sidebar';
    } elseif ( $sidebar_meta_option == 'no_sidebar_center' ) {
        $classes[] = 'no-sidebar-center';
    }

    /**
     * option for web site layout 
     */
    $np_website_layout = esc_attr( get_theme_mod( 'np_site_layout', 'fullwidth_layout' ) );
    
    if ( !empty( $np_website_layout ) ) {
        $classes[] = $np_website_layout;
    }

    /**
     * Class for archive
     */
    if ( is_archive() ) {
        $np_archive_layout = get_theme_mod( 'np_archive_layout', 'classic' );
        if ( !empty( $np_archive_layout ) ) {
            $classes[] = 'archive-'.$np_archive_layout;
        }
    }

    /**
     * Class for single post
     */
    if ( is_single() ) {
        $np_single_post_layout = get_post_meta( $post->ID, 'single_post_layout', true );
        if ( $np_single_post_layout == 'default_layout' || empty( $np_single_post_layout ) ) {
            $np_single_post_layout = get_theme_mod( 'np_posts_layout', 'layout1' );
        }
        if ( !empty( $np_single_post_layout ) ) {
            $classes[] = 'single-'. esc_attr( $np_single_post_layout );
        }
    }    

    /**
     * menu shadow
     */
    $np_menu_shadow_option = get_theme_mod( 'np_menu_shadow_option', 'show' );
    if ( $np_menu_shadow_option == 'show' ) {
        $classes[] = 'menu-shadow-on';
    } else {
        $classes[] = 'menu-shadow-off';
    }

    /**
     * Featured image hover type
     */
    $np_img_hover_type = get_theme_mod( 'post_image_hover_type', 'zoomin' );
    $classes[] = 'np-image-'. esc_attr( $np_img_hover_type );

    return $classes;
}
add_filter( 'body_class', 'news_portal_body_classes' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register Google fonts for News Portal.
 *
 * @return string Google fonts URL for the theme.
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_fonts_url' ) ) :
    function news_portal_fonts_url() {
        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto Condensed, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Roboto Condensed font: on or off', 'news-portal-pro' ) ) {
            $font_families[] = 'Roboto Condensed:300italic,400italic,700italic,400,300,700';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'news-portal-pro' ) ) {
            $font_families[] = 'Roboto:300,400,400i,500,700';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Titillium Web, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Titillium Web font: on or off', 'news-portal-pro' ) ) {
            $font_families[] = 'Titillium Web:400,600,700,300';
        }       

        if ( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load google fonts api link at wp_head
 *
 * @since 1.0.0
 */
function news_portal_googlefont_callback() {

    $p_font_family = get_theme_mod( 'p_font_family', 'Open Sans' );
    $p_font_style = get_theme_mod( 'p_font_style', '400' );
    $p_typo = $p_font_family.":".$p_font_style;

    $h1_font_family = get_theme_mod( 'h1_font_family', 'Roboto' );
    $h1_font_style = get_theme_mod( 'h1_font_style', '700' );
    $h1_typo = $h1_font_family.":".$h1_font_style;

    $h2_font_family = get_theme_mod( 'h2_font_family', 'Roboto' );
    $h2_font_style = get_theme_mod( 'h2_font_style', '700' );
    $h2_typo = $h2_font_family.":".$h2_font_style;

    $h3_font_family = get_theme_mod( 'h3_font_family', 'Roboto' );
    $h3_font_style = get_theme_mod( 'h3_font_style', '700' );
    $h3_typo = $h3_font_family.":".$h3_font_style;

    $h4_font_family = get_theme_mod( 'h4_font_family', 'Roboto' );
    $h4_font_style = get_theme_mod( 'h4_font_style', '700' );
    $h4_typo = $h4_font_family.":".$h4_font_style;

    $h5_font_family = get_theme_mod( 'h5_font_family', 'Roboto' );
    $h5_font_style = get_theme_mod( 'h5_font_style', '700' );
    $h5_typo = $h5_font_family.":".$h5_font_style;

    $h6_font_family = get_theme_mod( 'h6_font_family', 'Roboto' );
    $h6_font_style = get_theme_mod( 'h6_font_style', '700' );
    $h6_typo = $h6_font_family.":".$h6_font_style;

    $menu_font_family = get_theme_mod( 'menu_font_family', 'Roboto' );
    $menu_font_style = get_theme_mod( 'menu_font_style', '400' );
    $menu_typo = $menu_font_family.":".$menu_font_style;


    $get_fonts = array( $p_typo , $h1_typo, $h2_typo, $h3_typo, $h4_typo, $h5_typo, $h6_typo, $menu_typo );

    $font_weight_array = array();

    foreach( $get_fonts as $fonts ) {
        $each_font = explode( ':', $fonts );
        if ( !isset( $font_weight_array[$each_font[0]] ) ) {

        $font_weight_array[$each_font[0]][] = $each_font[1];
        }else{
            if ( !in_array( $each_font[1], $font_weight_array[$each_font[0]] ) ) {
                $font_weight_array[$each_font[0]][] = $each_font[1];
            }
        }
    }

    $final_font_array = array();
    
    foreach( $font_weight_array as $font => $font_weight ) {
        $each_font_string = $font.':'.implode( ',', $font_weight );
        $final_font_array[] = $each_font_string;
    }

    $final_font_string = implode( '|', $final_font_array );

    $google_fonts_url = '';

    if ( $final_font_string ) {
        $query_args = array(
            'family' => urlencode( $final_font_string ),
            'subset' => urlencode( 'latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic,khmer,devanagari,arabic,hebrew,telugu' )
        );

        $google_fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return $google_fonts_url;
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles for only admin
 *
 * @since 1.0.0
 */
add_action( 'admin_enqueue_scripts', 'news_portal_admin_scripts' );

function news_portal_admin_scripts( $hook ) {

    global $news_portal_pro_version;

    if ( 'widgets.php' != $hook && 'customize.php' != $hook && 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook && 'profile.php' != $hook ) {
        return;
    }

    if ( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }

    wp_enqueue_script( 'jquery-ui-button' );

    wp_enqueue_script( 'jquery-ui-slider' );
    
    wp_enqueue_script( 'news-portal-admin-script', get_template_directory_uri() .'/assets/js/np-admin-scripts.js', array( 'jquery' ), esc_attr( $news_portal_pro_version ), true );

    wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/assets/css/jquery-ui.css' );

    wp_enqueue_style( 'mt-font-awesome', get_template_directory_uri().'/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

    wp_enqueue_style( 'news-portal-admin-style', get_template_directory_uri() . '/assets/css/np-admin-style.css', array(), esc_attr( $news_portal_pro_version ) );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function news_portal_scripts() {
    
    global $news_portal_pro_version;

    wp_enqueue_style( 'news-portal-fonts', news_portal_fonts_url(), array(), null );

    wp_enqueue_style( 'news-portal-google-fonts', news_portal_googlefont_callback(), array(), null );

    wp_enqueue_style( 'mt-font-awesome', get_template_directory_uri(). '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

    wp_enqueue_style( 'lightslider-style', get_template_directory_uri(). '/assets/library/lightslider/css/lightslider.min.css', array(), '1.1.6' );

    wp_enqueue_style( 'lightgallery-style', get_template_directory_uri(). '/assets/library/lightslider/css/lightgallery.min.css', array(), '1.6.0' );

    wp_enqueue_style( 'pretty-photo', get_template_directory_uri() . '/assets/library/prettyphoto/prettyPhoto.css', array(), '3.1.6' );

    wp_enqueue_style( 'news-portal-preloaders', get_template_directory_uri(). '/assets/css/np-preloaders.css', array(), esc_attr( $news_portal_pro_version ) );

    wp_enqueue_style( 'animate', get_template_directory_uri(). '/assets/library/animate/animate.min.css', array(), '3.5.1' );

    wp_enqueue_style( 'news-portal-pro-style', get_stylesheet_uri() );
    
    wp_enqueue_style( 'news-portal-responsive-style', get_template_directory_uri(). '/assets/css/np-responsive.css', array(), '1.0.0' );

    wp_enqueue_script( 'news-portal-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), esc_attr( $news_portal_pro_version ), true );

    $menu_sticky_option = get_theme_mod( 'np_menu_sticky_option', 'show' );
    if ( $menu_sticky_option == 'show' ) {
          wp_enqueue_script( 'jquery-sticky', get_template_directory_uri(). '/assets/library/sticky/jquery.sticky.js', array( 'jquery' ), '20150416', true );
    
          wp_enqueue_script( 'np-sticky-menu-setting', get_template_directory_uri(). '/assets/library/sticky/sticky-setting.js', array( 'jquery-sticky' ), '20150309', true );
    }

    wp_enqueue_script( 'news-portal-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), esc_attr( $news_portal_pro_version ), true );

    wp_enqueue_script( 'lightslider', get_template_directory_uri().'/assets/library/lightslider/js/lightslider.min.js', array('jquery'), '1.1.6', true );

    wp_enqueue_script( 'lightgallery', get_template_directory_uri().'/assets/library/lightslider/js/lightgallery.min.js', array('jquery'), '1.6.0', true );

    wp_enqueue_script( 'jquery-ui-tabs' );

    wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/library/stickysidebar/theia-sticky-sidebar.js', array( 'jquery' ), '1.4.0', true );

    wp_enqueue_script( 'jquery-prettyphoto', get_template_directory_uri() .'/assets/library/prettyphoto/jquery.prettyPhoto.js', array( 'jquery' ), '3.1.6', true );

    wp_enqueue_script( 'wow', get_template_directory_uri(). '/assets/library/wow/wow.min.js', array('jquery'), '1.1.3', true );

    
    wp_register_script( 'news-portal-custom-script', get_template_directory_uri().'/assets/js/np-custom-scripts.js', array('jquery'), esc_attr( $news_portal_pro_version ), true );

    $animation_option = get_theme_mod( 'homepage_wow_option', 'show' );
    wp_localize_script( 'news-portal-custom-script', 'WowOption', array(
        'mode'=> $animation_option
        ) );
    
    wp_enqueue_script( 'news-portal-custom-script' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'news_portal_scripts' );

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Social media function
 *
 * @since 1.0.0
 */

if ( !function_exists( 'news_portal_social_media' ) ) :
    function news_portal_social_media() {
        $get_social_media_icons = get_theme_mod( 'social_media_icons', '' );
        $get_decode_social_media = json_decode( $get_social_media_icons );
        if ( ! empty( $get_decode_social_media ) ) {
            echo '<div class="mt-social-icons-wrapper">';
            foreach ( $get_decode_social_media as $single_icon ) {
                $icon_class = $single_icon->social_icon_class;
                $icon_url = $single_icon->social_icon_url;
                if ( !empty( $icon_url ) ) {
                    echo '<span class="social-link"><a href="'. esc_url( $icon_url ) .'" target="_blank"><i class="'. esc_attr( $icon_class ) .'"></i></a></span>';
                }
            }
            echo '</div><!-- .mt-social-icons-wrapper -->';
        }
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Category list
 *
 * @return array();
 */
if ( !function_exists( 'news_portal_categories_lists' ) ) :
    function news_portal_categories_lists() {
        $np_categories = get_categories( array( 'hide_empty' => 1 ) );
        $np_categories_lists = array();
        foreach( $np_categories as $category ) {
            $np_categories_lists[$category->term_id] = $category->name;
        }
        return $np_categories_lists;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Category dropdown
 *
 * @return array();
 */
if ( !function_exists( 'news_portal_categories_dropdown' ) ) :
    function news_portal_categories_dropdown() {
        $np_categories = get_categories( array( 'hide_empty' => 1 ) );
        $np_categories_lists = array();
        $np_categories_lists['0'] = esc_html__( 'Select Category', 'news-portal-pro' );
        foreach( $np_categories as $category ) {
            $np_categories_lists[$category->term_id] = $category->name;
        }
        return $np_categories_lists;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Get minified css and removed space
 *
 * @since 1.0.0
 */
function news_portal_css_strip_whitespace( $css ) {
    $replace = array(
        "#/\*.*?\*/#s" => "",  // Strip C style comments.
        "#\s\s+#"      => " ", // Strip excess whitespace.
    );
    $search = array_keys( $replace );
    $css = preg_replace( $search, $replace, $css );

    $replace = array(
        ": "  => ":",
        "; "  => ";",
        " {"  => "{",
        " }"  => "}",
        ", "  => ",",
        "{ "  => "{",
        ";}"  => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} "  => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys( $replace );
    $css = str_replace( $search, $replace, $css );

    return trim( $css );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_hover_color' ) ) :
    function news_portal_hover_color( $hex, $steps ) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max( -255, min( 255, $steps ) );

        // Normalize into a six character long hex string
        $hex = str_replace( '#', '', $hex );
        if ( strlen( $hex ) == 3) {
            $hex = str_repeat( substr( $hex,0,1 ), 2 ).str_repeat( substr( $hex, 1, 1 ), 2 ).str_repeat( substr( $hex,2,1 ), 2 );
        }

        // Split into three parts: R, G and B
        $color_parts = str_split( $hex, 2 );
        $return = '#';

        foreach ( $color_parts as $color ) {
            $color   = hexdec( $color ); // Convert to decimal
            $color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
            $return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
        }

        return $return;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Function define about page/post/archive sidebar
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_get_sidebar' ) ) :
function news_portal_get_sidebar() {
    global $post;

    if ( 'post' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'single_post_sidebar', true );
    }

    if ( 'page' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'single_post_sidebar', true );
    }
     
    if ( is_home() ) {
        $set_id = get_option( 'page_for_posts' );
        $sidebar_meta_option = get_post_meta( $set_id, 'single_post_sidebar', true );
    }
    
    if ( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
        $sidebar_meta_option = 'default_sidebar';
    }
    
    $archive_sidebar      = get_theme_mod( 'np_archive_sidebar', 'right_sidebar' );
    $post_default_sidebar = get_theme_mod( 'np_default_post_sidebar', 'right_sidebar' );
    $page_default_sidebar = get_theme_mod( 'np_default_page_sidebar', 'right_sidebar' );
    
    if ( $sidebar_meta_option == 'default_sidebar' ) {
        if ( is_single() ) {
            if ( $post_default_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif ( $post_default_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif ( is_page() ) {
            if ( $page_default_sidebar == 'right_sidebar' ) {
                get_sidebar();
            } elseif ( $page_default_sidebar == 'left_sidebar' ) {
                get_sidebar( 'left' );
            }
        } elseif ( $archive_sidebar == 'right_sidebar' ) {
            get_sidebar();
        } elseif ( $archive_sidebar == 'left_sidebar' ) {
            get_sidebar( 'left' );
        }
    } elseif ( $sidebar_meta_option == 'right_sidebar' ) {
        get_sidebar();
    } elseif ( $sidebar_meta_option == 'left_sidebar' ) {
        get_sidebar( 'left' );
    }
}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Define font awesome social media icons
 *
 * @return array();
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_font_awesome_social_icon_array' ) ) :
    function news_portal_font_awesome_social_icon_array() {
        return array(
                "fa fa-facebook-square","fa fa-facebook-f","fa fa-facebook","fa fa-facebook-official","fa fa-twitter-square","fa fa-twitter","fa fa-yahoo","fa fa-google","fa fa-google-wallet","fa fa-google-plus-circle","fa fa-google-plus-official","fa fa-instagram","fa fa-linkedin-square","fa fa-linkedin","fa fa-pinterest-p","fa fa-pinterest","fa fa-pinterest-square","fa fa-google-plus-square","fa fa-google-plus","fa fa-youtube-square","fa fa-youtube","fa fa-youtube-play","fa fa-vimeo","fa fa-vimeo-square",
            );
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Get media attachment id from url
 *
 * @since 1.0.0
 */ 
if ( ! function_exists( 'news_portal_get_image_id_from_url' ) ) :

    function news_portal_get_image_id_from_url( $attachment_url ) {
        if ( empty( $attachment_url ) ) {
            return;
        }
        $attachment_id = attachment_url_to_postid( $attachment_url );
        
        return $attachment_id;
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Display Star according to number of rating
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_display_post_rating' ) ) :

    function news_portal_display_post_rating ( $total_stars ) {

        $star_integer = absint( $total_stars );

        // this echo full stars
        for ( $i = 0; $i < $star_integer; $i++ ) {
            echo '<span class="star-value"><i class="fa fa-star"></i></span>';
        }

        $star_rest = $total_stars - $star_integer;

        // this echo full star or half or empty star
        if ( $star_rest >= 0.25 && $star_rest < 0.75 ) {
            echo '<span class="star-value"><i class="fa fa-star-half-o"></i></span>';
        } elseif ( $star_rest >= 0.75 ) {
            echo '<span class="star-value"><i class="fa fa-star"></i></span>';
        } elseif ( $total_stars != 5 ) {
            echo '<span class="star-value"><i class="fa fa-star-o"></i></span>';
        }

        // this echo empty star
        $count = 4-$star_integer;
        for ( $i = 0; $i < $count; $i++ ) {
            echo '<span class="star-value"><i class="fa fa-star-o"></i></span>';
        }
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Define format class
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_post_format_icon' ) ) :

    function news_portal_post_format_icon() {

        $format_icon_option = get_theme_mod( 'np_widget_format_icon_option', 'show' );
        if ( $format_icon_option == 'hide' ) {
            return;
        }

        global $post;
        $post_id = $post->ID;
        $post_format = get_post_format( get_the_ID() );
        if ( !empty( $post_format ) ) {
            $post_format_class = 'post-format-active format-'.$post_format;
            echo esc_attr( $post_format_class );
        }
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Get Post view count
 *
 * @since 1.0.0
 */
function news_portal_get_post_views( $postID ) {
    $count_key = 'news_portal_post_views_count';
    $count = get_post_meta( $postID, $count_key, true) ;
    if ( $count == '' ) {
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return '0';
    }
    return $count;
}
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set Post view count
 *
 * @since 1.0.0
 */
function news_portal_set_post_views( $postID ) {
    $count_key = 'news_portal_post_views_count';
    $count = get_post_meta( $postID, $count_key, true );
    if ( $count == '' ) {
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    }else{
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

// Remove issues with pref-etching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Query WooCommerce activation
 *
 * @since  1.0.0
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {

    function is_woocommerce_activated() {
        if ( class_exists( 'WooCommerce' ) ) {
          return true;
        } else {
          return false;
        }
    }

}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * get Google font variants
 *
 * @since 1.0.0
 */
function get_google_font_variants() {
    $news_portal_font_list = get_option( 'news_portal_google_font', '' );
    
    $font_family = $_REQUEST['font_family'];
    
    $font_array = news_portal_search_key( $news_portal_font_list, 'family', $font_family );
    
    $variants_array = $font_array['0']['variants'] ;
    $options_array = array();
    foreach ( $variants_array  as $key=>$variants ) {
        $options_array .= '<option value="'.$key.'">'.$variants.'</option>';
    }
    echo $options_array;
    die();
}
add_action( "wp_ajax_get_google_font_variants", "get_google_font_variants" );

function news_portal_search_key( $array, $key, $value ) {
    $results = array();

    if ( is_array( $array ) ) {
        if ( isset( $array[$key] ) && $array[$key] == $value ) {
            $results[] = $array;
        }

        foreach ( $array as $subarray ) {
            $results = array_merge( $results, news_portal_search_key( $subarray, $key, $value ) );
        }
    }

    return $results;
}

function news_portal_convert_font_variants( $value ) {
    switch ($value) {
        case '100':
            return 'Thin';
            break;

        case '200':
            return 'Extra Light';
            break;

        case '300':
            return 'Light';
            break;

        case 'regular':
            return 'Normal';
            break;

        case '500':
            return 'Medium';
            break;

        case '600':
            return 'Semi Bold';
            break;

        case '700':
            return 'Bold';
            break;

        case '800':
            return 'Extra Bold';
            break;

        case '900':
            return 'Ultra Bold';
            break;

        case '100italic':
            return 'Thin Italic';
            break;

        case '200italic':
            return 'Extra Light Italic';
            break;

        case '300italic':
            return 'Light Italic';
            break;

        case 'italic':
            return 'Normal Italic';
            break;

        case '500italic':
            return 'Medium Italic';
            break;

        case '600italic':
            return 'Semi Bold Italic';
            break;

        case '700italic':
            return 'Bold Italic';
            break;

        case '800italic':
            return 'Extra Bold Italic';
            break;

        case '900italic':
            return 'Ultra Bold Italic';
            break;
        
        default:
            break;
    }
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Archive title prefix
 *
 * @since 1.0.3
 */
$np_archive_title_prefix_option = get_theme_mod( 'np_archive_title_prefix_option' );

if ( $np_archive_title_prefix_option === true ) {
    add_filter( 'get_the_archive_title', 'news_portal_archive_title_prefix' );
}

if ( ! function_exists( 'news_portal_archive_title_prefix' ) ) :
    
    function news_portal_archive_title_prefix( $title ) {
        return preg_replace( '/^\w+: /', '', $title );
    }

endif;