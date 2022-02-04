<?php
/**
 * News Portal General Settings panel at Theme Customizer
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_portal_general_settings_register' );

function news_portal_general_settings_register( $wp_customize ) {

	$wp_customize->get_section( 'title_tagline' )->panel = 'news_portal_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = '5';
    $wp_customize->get_section( 'colors' )->panel    = 'news_portal_general_settings_panel';
    $wp_customize->get_section( 'colors' )->priority = '10';
    $wp_customize->get_section( 'background_image' )->panel = 'news_portal_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority = '15';
    $wp_customize->get_section( 'static_front_page' )->panel = 'news_portal_general_settings_panel';
    $wp_customize->get_section( 'static_front_page' )->priority = '20';

    /**
     * Add General Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'news_portal_general_settings_panel',
	    array(
	        'priority'       => 5,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'General Settings', 'news-portal-pro' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Color option for theme
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_theme_color',
        array(
            'default'     => '#F54337',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    ); 
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'np_theme_color',
            array(
                'label'      => __( 'Theme Color', 'news-portal-pro' ),
                'section'    => 'colors',
                'priority'   => 5
            )
        )
    );

    /**
     * Title Color
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_site_title_color',
        array(
            'default'     => '#F54337',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
 
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'np_site_title_color',
            array(
                'label'      => __( 'Header Text Color', 'news-portal-pro' ),
                'section'    => 'colors',
                'priority'   => 10
            )
        )
    );
    
/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Website layout section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'np_website_layout_section',
        array(
            'title'         => __( 'Website Layout', 'news-portal-pro' ),
            'description'   => __( 'Choose a site to display your website more effectively.', 'news-portal-pro' ),
            'priority'      => 55,
            'panel'         => 'news_portal_general_settings_panel',
        )
    );
    
    $wp_customize->add_setting(
        'np_site_layout',
        array(
            'default'           => 'fullwidth_layout',
            'sanitize_callback' => 'news_portal_sanitize_site_layout',
        )       
    );
    $wp_customize->add_control(
        'np_site_layout',
        array(
            'type' => 'radio',
            'priority'    => 5,
            'label' => __( 'Site Layout', 'news-portal-pro' ),
            'section' => 'np_website_layout_section',
            'choices' => array(
                'fullwidth_layout' => __( 'FullWidth Layout', 'news-portal-pro' ),
                'boxed_layout' => __( 'Boxed Layout', 'news-portal-pro' )
            ),
        )
    );

    /**
     * Switch option for preloader
     * 
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'site_preloader_option', 
        array(
            'default' => 'show',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'news_portal_sanitize_switch_option'
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'site_preloader_option', 
            array(
                'type' => 'switch',
                'label' => __( 'PreLoaders Option', 'news-portal-pro' ),
                'description' => __( 'Show/hide pre loaders from site.', 'news-portal-pro' ),
                'priority'      => 10,
                'section' => 'np_website_layout_section',
                'choices' => array(
                    'show' => __( 'Show', 'news-portal-pro' ),
                    'hide' => __( 'Hide', 'news-portal-pro' )
                )
            )
        )
    );

    /**
     * Preloaders layouts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'site_preloader_layout',
        array(
            'default'           => 'three_balls',
            'sanitize_callback' => 'news_portal_sanitize_preloaders',
        )       
    );
    $wp_customize->add_control(
        'site_preloader_layout',
        array(
            'type' => 'select',
            'priority'    => 15,
            'label' => __( 'Preloaders', 'news-portal-pro' ),
            'section' => 'np_website_layout_section',
            'choices' => array(
                'three_balls'       => __( '3 Balls', 'news-portal-pro' ),
                'rectangles'        => __( 'Rectangles', 'news-portal-pro' ),
                'steps'             => __( 'Steps', 'news-portal-pro' ),
                'spinning_border'   => __( 'Spinning Border', 'news-portal-pro' ),
                'single_bleep'      => __( 'Single Bleep', 'news-portal-pro' ),
                'square'            => __( 'Square', 'news-portal-pro' ),
                'hollow_circle'     => __( 'Hollow Circle', 'news-portal-pro' ),
                'knight_rider'      => __( 'Knight Rider', 'news-portal-pro' )
            ),
            'active_callback' => 'news_portal_preloader_callback'
        )
    );
/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Title and tagline checkbox
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'np_site_title_option', 
        array(
            'default' => true,
            'sanitize_callback' => 'news_portal_sanitize_checkbox'
        )
    );
    $wp_customize->add_control( 
        'np_site_title_option', 
        array(
            'label' => esc_html__( 'Display Site Title and Tagline', 'news-portal-pro' ),
            'section' => 'title_tagline',
            'type' => 'checkbox'
        )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Wow animation option
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'homepage_wow_option', 
        array(
            'default' => 'show',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'news_portal_sanitize_switch_option'
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'homepage_wow_option',
            array(
                'type' => 'switch',
                'label' => __( 'Wow Animation Option', 'news-portal-pro' ),
                'description' => __( 'Enable/disable animation on homepage.', 'news-portal-pro' ),
                'priority'      => 20,
                'section' => 'static_front_page',
                'choices' => array(
                    'show' => __( 'Enable', 'news-portal-pro' ),
                    'hide' => __( 'Disable', 'news-portal-pro' )
                ),
                'active_callback' => 'news_portal_wow_option_active_callback'
            )
        )
    );

    /**
     * Logo width slider checkbox
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'np_custom_logo_width_opt', 
        array(
            'default' => false,
            'sanitize_callback' => 'news_portal_sanitize_checkbox'
        )
    );
    $wp_customize->add_control( 
        'np_custom_logo_width_opt', 
        array(
            'label' => esc_html__( 'Checked to show Site Logo Width control.', 'news-portal-pro' ),
            'section' => 'title_tagline',
            'type' => 'checkbox',
            'priority' => 8,
        )
    );

    /**
     * Slider for logo width
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'np_site_logo_width', 
        array(
            'default' => 300,
            'sanitize_callback' => 'absint'
        )
    );
    $wp_customize->add_control( new News_Portal_Slider_Custom_Control(
        $wp_customize,
            'np_site_logo_width', 
            array(
                'label' => esc_html__( 'Site Logo Width (px)', 'news-portal-pro' ),
                'section' => 'title_tagline',
                'priority' => 8,
                'input_attrs' => array(
                    'min' => 50,
                    'max' => 700,
                    'step' => 1,
                )
            )
        )
    );

}