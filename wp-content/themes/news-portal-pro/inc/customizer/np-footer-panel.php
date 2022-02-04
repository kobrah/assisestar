<?php
/**
 * News Portal Footer Settings panel at Theme Customizer
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_portal_footer_settings_register' );

function news_portal_footer_settings_register( $wp_customize ) {

	/**
     * Add Additional Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'news_portal_footer_settings_panel',
	    array(
	        'priority'       => 30,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Footer Settings', 'news-portal-pro' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
	 * Widget Area Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
        'np_footer_widget_section',
        array(
            'title'		=> esc_html__( 'Widget Area', 'news-portal-pro' ),
            'panel'     => 'news_portal_footer_settings_panel',
            'priority'  => 5,
        )
    );

    /**
     * Switch option for Top Header
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_footer_widget_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_footer_widget_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Footer Widget Section', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option for footer widget area section.', 'news-portal-pro' ),
                'section'   => 'np_footer_widget_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 5,
            )
        )
    );

    /**
     * Field for Image Radio
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'footer_widget_layout',
        array(
            'default'           => 'column_three',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Control_Radio_Image(
        $wp_customize,
        'footer_widget_layout',
            array(
                'label'    => esc_html__( 'Footer Widget Layout', 'news-portal-pro' ),
                'description' => esc_html__( 'Choose layout from available layouts', 'news-portal-pro' ),
                'section'  => 'np_footer_widget_section',
                'choices'  => array(
	                    'column_four' => array(
	                        'label' => esc_html__( 'Columns Four', 'news-portal-pro' ),
	                        'url'   => '%s/assets/images/footer-4.png'
	                    ),
	                    'column_three' => array(
	                        'label' => esc_html__( 'Columns Three', 'news-portal-pro' ),
	                        'url'   => '%s/assets/images/footer-3.png'
	                    ),
	                    'column_two' => array(
	                        'label' => esc_html__( 'Columns Two', 'news-portal-pro' ),
	                        'url'   => '%s/assets/images/footer-2.png'
	                    ),
	                    'column_one' => array(
	                        'label' => esc_html__( 'Column One', 'news-portal-pro' ),
	                        'url'   => '%s/assets/images/footer-1.png'
	                    )
	            ),
	            'priority' => 10
            )
        )
    );

    /**
     * Footer widget background type
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_footer_widget_bg_type',
        array(
            'default'           => 'bg_color',
            'sanitize_callback' => 'news_portal_sanitize_widget_bg_type',
        )       
    );
    $wp_customize->add_control(
        'np_footer_widget_bg_type',
        array(
            'type' => 'select',
            'priority'    => 15,
            'label' => __( 'Background Type', 'news-portal-pro' ),
            'section' => 'np_footer_widget_section',
            'choices' => array(
                'bg_color'   => __( 'Background Color', 'news-portal-pro' ),
                'bg_image'   => __( 'Background Image', 'news-portal-pro' )
            )
        )
    );

    /**
     * Widget bg color
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_widget_bg_color',
        array(
            'default'     => '#000000',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
 
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'np_widget_bg_color',
            array(
                'label'      => __( 'Background Color', 'news-portal-pro' ),
                'section'    => 'np_footer_widget_section',
                'priority'   => 20,
                'active_callback' => 'news_portal_widget_bg_color_callback'
            )
        )
    );

    /**
     * Widget bg image
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_widget_bg_image',
            array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        'np_widget_bg_image',
            array(
                'label'      => esc_html__( 'Background Image', 'news-portal-pro' ),
                'section'    => 'np_footer_widget_section',
                'priority' => 25,
                'active_callback' => 'news_portal_widget_bg_image_callback'
            )
        )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
	 * Bottom Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
        'np_footer_bottom_section',
        array(
            'title'		=> esc_html__( 'Bottom Section', 'news-portal-pro' ),
            'panel'     => 'news_portal_footer_settings_panel',
            'priority'  => 10,
        )
    );

    /**
     * Text field for copyright
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_copyright_text',
        array(
            'default'    => __( 'News Portal Pro | Theme: News Portal Pro by <a href="https://mysterythemes.com/">Mystery Themes</a> ', 'news-portal-pro' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'news_portal_sanitize_textarea_content'
            )
    );
    $wp_customize->add_control(
        'np_copyright_text',
        array(
            'type'      => 'textarea',
            'label'     => esc_html__( 'Copyright Text', 'news-portal-pro' ),
            'section'   => 'np_footer_bottom_section',
            'priority'  => 5
        )
    );
    $wp_customize->selective_refresh->add_partial( 
        'np_copyright_text', 
            array(
                'selector' => 'span.np-copyright-text',
                'render_callback' => 'news_portal_customize_partial_copyright',
            )
    );

    /**
     * Sub footer layout
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_sub_footer_layout',
        array(
            'default'           => 'default',
            'sanitize_callback' => 'news_portal_sanitize_sub_footer_layout',
        )       
    );
    $wp_customize->add_control(
        'np_sub_footer_layout',
        array(
            'type' => 'radio',
            'priority'    => 10,
            'label' => __( 'Sub Footer Layout', 'news-portal-pro' ),
            'section' => 'np_footer_bottom_section',
            'choices' => array(
                'default' => __( 'Default Layout', 'news-portal-pro' ),
                'layout1' => __( 'Layout One', 'news-portal-pro' )
            ),
        )
    );
}