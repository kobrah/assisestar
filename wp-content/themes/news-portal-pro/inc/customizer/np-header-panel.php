<?php
/**
 * News Portal Header Settings panel at Theme Customizer
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_portal_header_settings_register' );

function news_portal_header_settings_register( $wp_customize ) {

	/**
     * Add General Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'news_portal_header_settings_panel',
	    array(
	        'priority'       => 10,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Header Settings', 'news-portal-pro' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
	
	/**
     * Top Header Section
     */
    $wp_customize->add_section(
        'np_top_header_section',
        array(
            'title'     => __( 'Top Header Section', 'news-portal-pro' ),
            'priority'  => 5,
            'panel'     => 'news_portal_header_settings_panel'
        )
    );

    /**
     * Switch option for Top Header
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_top_header_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_top_header_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Top Header Section', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option for top header section.', 'news-portal-pro' ),
                'section'   => 'np_top_header_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 5,
            )
        )
    );

    /**
     * Switch option for Current Date
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_top_date_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_top_date_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Current Date', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option for current date at top header section.', 'news-portal-pro' ),
                'section'   => 'np_top_header_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 10,
            )
        )
    );

    /**
     * Switch option for Social Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_top_social_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_top_social_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Social Icons', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option for social media icons at top header section.', 'news-portal-pro' ),
                'section'   => 'np_top_header_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 15,
            )
        )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Header layout section
     */
    $wp_customize->add_section(
        'np_header_layout_section',
        array(
            'title'     => __( 'Header Layout', 'news-portal-pro' ),
            'priority'  => 10,
            'panel'     => 'news_portal_header_settings_panel'
        )
    );

    /**
     * Radio button for header section layouts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_header_layout',
        array(
            'default'           => 'default',
            'sanitize_callback' => 'news_portal_sanitize_header_layout_option',
        )
    );
    $wp_customize->add_control(
        'np_header_layout',
        array(
            'type'          => 'radio',
            'priority'      => 5,
            'label'         => __( 'Available Layouts', 'news-portal-pro' ),
            'description'   => esc_html__( 'Choose layout from available layouts.', 'news-portal-pro' ),
            'section'       => 'np_header_layout_section',
            'choices' => array(
                'default' => __( 'Default Layout', 'news-portal-pro' ),
                'layout1' => __( 'Layout one', 'news-portal-pro' ),
                'layout2' => __( 'Layout two', 'news-portal-pro' )
            ),
        )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Header Section
     */
    $wp_customize->add_section(
        'np_header_option_section',
        array(
            'title'     => __( 'Header Option', 'news-portal-pro' ),
            'priority'  => 15,
            'panel'     => 'news_portal_header_settings_panel'
        )
    );    

    /**
     * Switch option for Home Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_menu_sticky_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_menu_sticky_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Sticky Menu', 'news-portal-pro' ),
                'description'   => esc_html__( 'Enable/Disable option for sticky menu.', 'news-portal-pro' ),
                'section'   => 'np_header_option_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Enable', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Disable', 'news-portal-pro' )
                    ),
                'priority'  => 5,
            )
        )
    );

    /**
     * Switch option for Home Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_home_icon_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_home_icon_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Home Icon', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option for home icon at primary menu.', 'news-portal-pro' ),
                'section'   => 'np_header_option_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 10,
            )
        )
    );

    /**
     * Switch option for Search Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_search_icon_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_search_icon_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Search Icon', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option for search icon at primary menu.', 'news-portal-pro' ),
                'section'   => 'np_header_option_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 15,
            )
        )
    );

    /**
     * Switch option for shadow under primary menu
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_menu_shadow_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_menu_shadow_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Shadow Under Menu', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option about shadow display under primary menu.', 'news-portal-pro' ),
                'section'   => 'np_header_option_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 20,
            )
        )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Ticker Section
     */
    $wp_customize->add_section(
        'np_ticker_section',
        array(
            'title'     => __( 'Ticker Section', 'news-portal-pro' ),
            'priority'  => 20,
            'panel'     => 'news_portal_header_settings_panel'
        )
    );

    /**
     * Switch option for Home Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_ticker_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_ticker_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Ticker Option', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option for news ticker section.', 'news-portal-pro' ),
                'section'   => 'np_ticker_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 5,
            )
        )
    );

    /**
     * Text field for ticker caption
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_ticker_caption',
        array(
            'default'    => __( 'Breaking News', 'news-portal-pro' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'np_ticker_caption',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Ticker Caption', 'news-portal-pro' ),
            'section'   => 'np_ticker_section',
            'priority'  => 10
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'np_ticker_caption', 
            array(
                'selector' => '.ticker-caption',
                'render_callback' => 'news_portal_customize_partial_ticker_caption',
            )
    );

    /**
     * Radio button for ticker section layouts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_ticker_layout',
        array(
            'default'           => 'default',
            'sanitize_callback' => 'news_portal_sanitize_ticker_layout_option',
        )
    );
    $wp_customize->add_control(
        'np_ticker_layout',
        array(
            'type'          => 'radio',
            'priority'      => 15,
            'label'         => __( 'Ticker Section Layout', 'news-portal-pro' ),
            'description'   => esc_html__( 'Choose layout from available layouts.', 'news-portal-pro' ),
            'section'       => 'np_ticker_section',
            'choices' => array(
                'default' => __( 'Default Layout', 'news-portal-pro' ),
                'layout1' => __( 'Layout one', 'news-portal-pro' )
            ),
        )
    );

    /**
     * Select option for ticker type
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_ticker_type',
        array(
            'default' => 'default',
            'sanitize_callback' => 'news_portal_sanitize_ticker_type',
            )
    );
    $wp_customize->add_control(
        'np_ticker_type', 
        array(
            'type'        => 'select',
            'label'       => esc_html__( 'Ticker Content Type', 'news-portal-pro' ),
            'description' => esc_html__( 'Select suitable option for news ticker content.', 'news-portal-pro' ),
            'section'     => 'np_ticker_section',
            'choices'     => array(
                'default'  => esc_html__( 'Default content', 'news-portal-pro' ),
                'repeater'  => esc_html__( 'Repeater content', 'news-portal-pro' )
                ),
            'priority'  => 20
        )
    );

    /**
     * Checkbox to show/hide categories lists in ticker section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_ticker_cats_option',
        array(
            'default' => 'true',
            'sanitize_callback' => 'news_portal_sanitize_checkbox'
        )
    );
    $wp_customize->add_control(
        'np_ticker_cats_option',
        array(
            'label' => esc_html__( 'Checked to show category lists.', 'news-portal-pro' ),
            'section' => 'np_ticker_section',
            'type' => 'checkbox',
            'priority' => 25,
            'active_callback' => 'news_portal_ticker_default_content_type_callback'
        )
    );

    /**
     * Number field for news ticker post count
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_ticker_post_count',
        array(
            'default'      => 5,
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'np_ticker_post_count',
        array(
            'type'          => 'number',
            'label'         => esc_html__( 'No. of Post Count', 'news-portal-pro' ),
            'description'   => __( 'Set the number of news ticker post count.', 'news-portal-pro' ),
            'section'       => 'np_ticker_section',
            'priority'      => 30,
            'active_callback' => 'news_portal_ticker_default_content_type_callback'
        )
    );

    /**
     * Repeater field for news ticker content
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_ticker_repeater', 
        array(
            'sanitize_callback' => 'news_portal_sanitize_repeater',
            'default' => json_encode(array(
                array(
                    'np_ticker_content' => ''
                    )
            ))
        )
    );
    $wp_customize->add_control( new News_Portal_Repeater_Controler(
        $wp_customize, 
            'np_ticker_repeater', 
            array(
                'label'   => __( 'News Tickers', 'news-portal-pro' ),
                'section' => 'np_ticker_section',
                'settings' => 'np_ticker_repeater',
                'priority' => 35,
                'news_portal_box_label' => __( 'News Ticker','news-portal-pro' ),
                'news_portal_box_add_control' => __( 'Add Ticker','news-portal-pro' ),
                'active_callback' => 'news_portal_ticker_content_type_callback'
            ),
            array(
                'np_ticker_content' => array(
                    'type'        => 'textarea',
                    'label'       => __( 'Ticker Content.', 'news-portal-pro' ),
                    'description' => __( 'Add your ticker content here.', 'news-portal-pro' )
                )
            )
        ) 
    );
}