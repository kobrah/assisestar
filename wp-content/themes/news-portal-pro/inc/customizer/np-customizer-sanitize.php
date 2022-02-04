<?php
/**
 * File to sanitize customizer field
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

/**
 * Sanitize checkbox value
 *
 * @since 1.0.0
 */
function news_portal_sanitize_checkbox( $input ) {
    //returns true if checkbox is checked
    return ( ( isset( $input ) && true == $input ) ? true : false );
}


/**
 * Sanitize Number in floatval
 *
 * @since 1.0.0
 */
function news_portal_floatval( $input ) {
    $output = floatval( $input );
    return $output;
}

/**
 * Sanitize repeater value
 *
 * @since 1.0.0
 */
function news_portal_sanitize_repeater( $input ){
    $input_decoded = json_decode( $input, true );
        
    if ( !empty( $input_decoded ) ) {
        foreach ( $input_decoded as $boxes => $box ){
            foreach ( $box as $key => $value ){
                $input_decoded[$boxes][$key] = wp_kses_post( $value );
            }
        }
        return json_encode( $input_decoded );
    }
    
    return $input;
}

/**
 * Sanitize site layout
 *
 * @since 1.0.0
 */
function news_portal_sanitize_site_layout( $input ) {
    $valid_keys = array(
        'fullwidth_layout' => __( 'Fullwidth Layout', 'news-portal-pro' ),
        'boxed_layout' => __( 'Boxed Layout', 'news-portal-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * switch option (show/hide)
 *
 * @since 1.0.0
 */
function news_portal_sanitize_switch_option( $input ) {
    $valid_keys = array(
            'show'  => __( 'Show', 'news-portal-pro' ),
            'hide'  => __( 'Hide', 'news-portal-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * header layout option
 *
 * @since 1.0.0
 */
function news_portal_sanitize_header_layout_option( $input ) {
    $valid_keys = array(
            'default' => __( 'Default Layout', 'news-portal-pro' ),
            'layout1' => __( 'Layout one', 'news-portal-pro' ),
            'layout2' => __( 'Layout two', 'news-portal-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * ticker layout option
 *
 * @since 1.0.0
 */
function news_portal_sanitize_ticker_layout_option( $input ) {
    $valid_keys = array(
            'default' => __( 'Default Layout', 'news-portal-pro' ),
            'layout1' => __( 'Layout one', 'news-portal-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * ticker content type
 *
 * @since 1.0.0
 */
function news_portal_sanitize_ticker_type( $input ) {
    $valid_keys = array(
            'default'  => esc_html__( 'Default content', 'news-portal-pro' ),
            'repeater'  => esc_html__( 'Repeater content', 'news-portal-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * featured image hover type
 *
 * @since 1.0.0
 */
function news_portal_image_hover_type( $input ) {
    $valid_keys = array(
            'zoomin'        => __( 'Zoom In', 'news-portal-pro' ),
            'zoomin_rotate' => __( 'Zoom In Rotate', 'news-portal-pro' ),
            'zoomout'       => __( 'Zoom Out', 'news-portal-pro' ),
            'zoomout_rotate'=> __( 'Zoom Out Rotate', 'news-portal-pro' ),
            'shine'         => __( 'Shine', 'news-portal-pro' ),
            'slanted_shine' => __( 'Slanted Shine', 'news-portal-pro' ),
            'grayscale'     => __( 'Grayscale', 'news-portal-pro' ),
            'opacity'       => __( 'Opacity', 'news-portal-pro' ),
            'flashing'      => __( 'Flashing', 'news-portal-pro' ),
            'circle'        => __( 'Circle', 'news-portal-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * site preloaders layout
 *
 * @since 1.0.0
 */
function news_portal_sanitize_preloaders( $input ) {
    $valid_keys = array(
            'three_balls'       => __( '3 Balls', 'news-portal-pro' ),
            'rectangles'        => __( 'Rectangles', 'news-portal-pro' ),
            'steps'             => __( 'Steps', 'news-portal-pro' ),
            'spinning_border'   => __( 'Spinning Border', 'news-portal-pro' ),
            'single_bleep'      => __( 'Single Bleep', 'news-portal-pro' ),
            'square'            => __( 'Square', 'news-portal-pro' ),
            'hollow_circle'     => __( 'Hollow Circle', 'news-portal-pro' ),
            'knight_rider'      => __( 'Knight Rider', 'news-portal-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}


/**
 * Widget background type
 *
 * @since 1.0.0
 */
function news_portal_sanitize_widget_bg_type( $input ) {
    $valid_keys = array(
            'bg_color'   => __( 'Background Color', 'news-portal-pro' ),
            'bg_image'   => __( 'Background Image', 'news-portal-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sub Footer Layout
 *
 * @since 1.0.0
 */
function news_portal_sanitize_sub_footer_layout( $input ) {
    $valid_keys = array(
            'default' => __( 'Default Layout', 'news-portal-pro' ),
            'layout1' => __( 'Layout One', 'news-portal-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * 404 page layout
 *
 * @since 1.0.0
 */
function news_portal_pnf_layout( $input ) {
    $valid_keys = array(
            'default' => __( 'Default Layout', 'news-portal-pro' ),
            'extra'   => __( 'Extra Layout', 'news-portal-pro' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

if ( ! function_exists( 'news_portal_sanitize_textarea_content' ) ) :

    /**
     * Sanitize textarea content.
     *
     * @since 1.0.0
     *
     * @param string               $input Content to be sanitized.
     * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
     * @return string Sanitized content.
     */
    function news_portal_sanitize_textarea_content( $input, $setting ) {

        return ( stripslashes( wp_filter_post_kses( addslashes( $input ) ) ) );

    }
endif;


/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_customize_register()
 *
 * @return void
 */
function news_portal_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site title description for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_customize_register()
 *
 * @return void
 */
function news_portal_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Render the copyright content for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_footer_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_copyright() {
    return get_theme_mod( 'np_copyright_text' );
}

/**
 * Render the related post title for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_design_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_related_title() {
    return get_theme_mod( 'np_related_posts_title' );
}

/**
 * Render the archive read more text for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_design_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_archive_more() {
    return get_theme_mod( 'np_archive_read_more_text' );
}

/**
 * Render the ticker caption for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_header_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_ticker_caption() {
    return get_theme_mod( 'np_ticker_caption' );
}

/**
 * Render the breadcrumbs section for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_additional_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_breadcrumb_option() {
    $get_value = get_theme_mod( 'np_breadcrumb_option' );
    if ( $get_value == 'show' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Render the breadcrumb home text for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_additional_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_breadcrumb_home() {
    return get_theme_mod( 'np_bread_home' );
}

/**
 * Render the breadcrumb separator for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_additional_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_breadcrumb_sep() {
    return get_theme_mod( 'np_bread_sep' );
}

/**
 * Render the review section at single page for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_design_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_review_section() {
    $get_value = get_theme_mod( 'np_posts_review_option' );
    if ( $get_value == 'show' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Render the review section title separator for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_design_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_review_title() {
    return get_theme_mod( 'np_posts_review_review_title' );
}

/**
 * Render the review summary title separator for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_design_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_review_sum_title() {
    return get_theme_mod( 'np_posts_review_sum_title' );
}

/**
 * Render the author box section at single page for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_design_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_author_box() {
    $get_value = get_theme_mod( 'np_posts_author_option' );
    if ( $get_value == 'show' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Render the page not found headline at single page for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_design_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_pnf_headline() {
    return get_theme_mod( 'np_pnf_headline' );
}

/**
 * Render the page not found content at single page for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_design_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_pnf_content() {
    return get_theme_mod( 'np_pnf_content' );
}

/**
 * Render the page not found button label at single page for the selective refresh partial.
 *
 * @since 1.0.0
 * @see news_portal_design_settings_register()
 *
 * @return void
 */
function news_portal_customize_partial_pnf_btn_txt() {
    return get_theme_mod( 'np_pnf_button_label' );
}



/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Active callback function for news ticker default content type
 *
 * @since 1.0.0
 */
function news_portal_ticker_default_content_type_callback( $control ) {
    if ( $control->manager->get_setting( 'np_ticker_type' )->value() == 'default' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Active callback function for news ticker content type
 *
 * @since 1.0.0
 */
function news_portal_ticker_content_type_callback( $control ) {
    if ( $control->manager->get_setting( 'np_ticker_type' )->value() == 'repeater' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Active callback function for site preloader layout
 *
 * @since 1.0.0
 */
function news_portal_preloader_callback( $control ) {
    if ( $control->manager->get_setting( 'site_preloader_option' )->value() == 'show' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Active callback function for widget background color
 *
 * @since 1.0.0
 */
function news_portal_widget_bg_color_callback( $control ) {
    if ( $control->manager->get_setting( 'np_footer_widget_bg_type' )->value() == 'bg_color' ) {
        return true;
    } else {
        return false;
    }
}


/**
 * Active callback function for widget background image
 *
 * @since 1.0.0
 */
function news_portal_widget_bg_image_callback( $control ) {
    if ( $control->manager->get_setting( 'np_footer_widget_bg_type' )->value() == 'bg_image' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Active callback function for page not found extra layout
 *
 * @since 1.0.0
 */
function news_portal_pnf_extra_layout_callback( $control ) {
    if ( $control->manager->get_setting( 'np_pnf_layout' )->value() == 'extra' ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Active callback function for homepage wow option
 *
 * @since 1.0.0
 */
function news_portal_wow_option_active_callback( $control ) {
    if ( $control->manager->get_setting( 'show_on_front' )->value() == 'page' ) {
        return true;
    } else {
        return false;
    }
}

