<?php
/**
 * News Portal Design Settings panel at Theme Customizer
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_portal_design_settings_register' );

function news_portal_design_settings_register( $wp_customize ) {

	// Register the radio image control class as a JS control type.
    $wp_customize->register_control_type( 'News_Portal_Customize_Control_Radio_Image' );

	/**
     * Add Design Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'news_portal_design_settings_panel',
	    array(
	        'priority'       => 25,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Design Settings', 'news-portal-pro' ),
	    )
    );

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Archive Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'np_archive_settings_section',
        array(
            'title'     => esc_html__( 'Archive Settings', 'news-portal-pro' ),
            'panel'     => 'news_portal_design_settings_panel',
            'priority'  => 5,
        )
    );      

    /**
     * Image Radio field for archive sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_archive_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Control_Radio_Image(
        $wp_customize,
        'np_archive_sidebar',
            array(
                'label'    => esc_html__( 'Archive Sidebars', 'news-portal-pro' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'news-portal-pro' ),
                'section'  => 'np_archive_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        ),
                        'no_sidebar_center' => array(
                            'label' => esc_html__( 'No Sidebar Center', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/no-sidebar-center.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Image Radio field for archive layout
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_archive_layout',
        array(
            'default'           => 'classic',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Control_Radio_Image(
        $wp_customize,
        'np_archive_layout',
            array(
                'label'    => esc_html__( 'Archive Layouts', 'news-portal-pro' ),
                'description' => esc_html__( 'Choose layout from available layouts', 'news-portal-pro' ),
                'section'  => 'np_archive_settings_section',
                'choices'  => array(
                        'classic' => array(
                            'label' => esc_html__( 'Classic', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/archive-layout1.png'
                        ),
                        'grid' => array(
                            'label' => esc_html__( 'Grid', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/archive-layout2.png'
                        ),
                        'list' => array(
                            'label' => esc_html__( 'List', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/archive-layout3.png'
                        ),
                        'classicabove' => array(
                            'label' => esc_html__( 'Classic Above', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/archive-layout4.png'
                        )
                ),
                'priority' => 10
            )
        )
    );

    /**
     * Archive title prefix option
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'np_archive_title_prefix_option', 
        array(
            'default' => false,
            'sanitize_callback' => 'news_portal_sanitize_checkbox'
        )
    );
    $wp_customize->add_control( 
        'np_archive_title_prefix_option', 
        array(
            'label' => esc_html__( 'Checked to hide archive title prefix.', 'news-portal-pro' ),
            'description'   => __( 'eg: category, month, author, tag', 'news-portal-pro' ),
            'section' => 'np_archive_settings_section',
            'type' => 'checkbox',
            'priority' => 15
        )
    );

    /**
     * Text field for archive read more
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_archive_read_more_text',
        array(
            'default'      => __( 'Continue Reading', 'news-portal-pro' ),
            'transport'    => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'np_archive_read_more_text',
        array(
            'type'      	=> 'text',
            'label'        	=> esc_html__( 'Read More Text', 'news-portal-pro' ),
            'description'  	=> __( 'Enter read more button text for archive page.', 'news-portal-pro' ),
            'section'   	=> 'np_archive_settings_section',
            'priority'  	=> 20
        )
    );
    $wp_customize->selective_refresh->add_partial( 
        'np_archive_read_more_text', 
            array(
                'selector' => '.np-archive-more > a',
                'render_callback' => 'news_portal_customize_partial_archive_more',
            )
    );

    /**
     * Number field for archive excerpt length
     *
     * @since 1.0.0
     */
    /*$wp_customize->add_setting(
        'np_archive_excerpt_length',
        array(
            'default'      => 50,
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'np_archive_excerpt_length',
        array(
            'type'          => 'number',
            'label'         => esc_html__( 'Excerpt Length', 'news-portal-pro' ),
            'description'   => __( 'Set the number of word for archive excerpt content.', 'news-portal-pro' ),
            'section'       => 'np_archive_settings_section',
            'priority'      => 20
        )
    );*/

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Page Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'np_page_settings_section',
        array(
            'title'     => esc_html__( 'Page Settings', 'news-portal-pro' ),
            'panel'     => 'news_portal_design_settings_panel',
            'priority'  => 10,
        )
    );      

    /**
     * Image Radio for page sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_default_page_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Control_Radio_Image(
        $wp_customize,
        'np_default_page_sidebar',
            array(
                'label'    => esc_html__( 'Page Sidebars', 'news-portal-pro' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'news-portal-pro' ),
                'section'  => 'np_page_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        ),
                        'no_sidebar_center' => array(
                            'label' => esc_html__( 'No Sidebar Center', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/no-sidebar-center.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Post Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'np_post_settings_section',
        array(
            'title'     => esc_html__( 'Post Settings', 'news-portal-pro' ),
            'panel'     => 'news_portal_design_settings_panel',
            'priority'  => 15,
        )
    );      

    /**
     * Image Radio for post sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_default_post_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Control_Radio_Image(
        $wp_customize,
        'np_default_post_sidebar',
            array(
                'label'    => esc_html__( 'Post Sidebars', 'news-portal-pro' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'news-portal-pro' ),
                'section'  => 'np_post_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        ),
                        'no_sidebar_center' => array(
                            'label' => esc_html__( 'No Sidebar Center', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/no-sidebar-center.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Image Radio field for archive layout
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_posts_layout',
        array(
            'default'           => 'layout1',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Control_Radio_Image(
        $wp_customize,
        'np_posts_layout',
            array(
                'label'    => esc_html__( 'Posts Layouts', 'news-portal-pro' ),
                'description' => esc_html__( 'Choose layout from available layouts', 'news-portal-pro' ),
                'section'  => 'np_post_settings_section',
                'choices'  => array(
                        'layout1' => array(
                            'label' => esc_html__( 'Layout 1', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/post-layout-1.jpg'
                        ),
                        'layout2' => array(
                            'label' => esc_html__( 'Layout 2', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/post-layout-2.jpg'
                        ),
                        'layout3' => array(
                            'label' => esc_html__( 'Layout 3', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/post-layout-3.jpg'
                        ),
                        'layout4' => array(
                            'label' => esc_html__( 'Layout 4', 'news-portal-pro' ),
                            'url'   => '%s/assets/images/post-layout-4.jpg'
                        )
                ),
                'priority' => 10
            )
        )
    );

    /**
     * Switch option for Post Review
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_posts_review_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_posts_review_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Post Review Option', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option for posts review section at single post page.', 'news-portal-pro' ),
                'section'   => 'np_post_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 15,
            )
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'np_posts_review_option', 
            array(
                'selector' => '.np-post-review-section-wrapper',
                'render_callback' => 'news_portal_customize_partial_review_section',
            )
    );

    /**
     * Text field for review section title
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_posts_review_title',
        array(
            'default'    => __( 'Review Overview', 'news-portal-pro' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'np_posts_review_title',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Review Section Title', 'news-portal-pro' ),
            'section'   => 'np_post_settings_section',
            'priority'  => 20
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'np_posts_review_title', 
            array(
                'selector' => 'h4.-review-title',
                'render_callback' => 'news_portal_customize_partial_review_title',
            )
    );

    /**
     * Text field for review summery title
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_posts_review_sum_title',
        array(
            'default'    => __( 'Summary', 'news-portal-pro' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'np_posts_review_sum_title',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Summary Title', 'news-portal-pro' ),
            'section'   => 'np_post_settings_section',
            'priority'  => 25
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'np_posts_review_sum_title', 
            array(
                'selector' => 'span.sum-title',
                'render_callback' => 'news_portal_customize_partial_review_sum_title',
            )
    );

    /**
     * Switch option for author section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_posts_author_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_posts_author_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Author Option', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option for author section at single post page.', 'news-portal-pro' ),
                'section'   => 'np_post_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 30,
            )
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'np_posts_author_option', 
            array(
                'selector' => '.np-author-box-wrapper',
                'render_callback' => 'news_portal_customize_partial_author_box',
            )
    );

    /**
     * Switch option for Related posts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_related_posts_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_related_posts_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Related Post Option', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option for related posts section at single post page.', 'news-portal-pro' ),
                'section'   => 'np_post_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 35,
            )
        )
    );

    /**
     * Text field for related post section title
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_related_posts_title',
        array(
            'default'    => __( 'Related Posts', 'news-portal-pro' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'np_related_posts_title',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Related Post Section Title', 'news-portal-pro' ),
            'section'   => 'np_post_settings_section',
            'priority'  => 40
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'np_related_posts_title', 
            array(
                'selector' => 'h2.np-related-title',
                'render_callback' => 'news_portal_customize_partial_related_title',
            )
    );
/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * 404 Page Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'np_pnf_settings_section',
        array(
            'title'     => esc_html__( '404 Page Settings', 'news-portal-pro' ),
            'panel'     => 'news_portal_design_settings_panel',
            'priority'  => 20,
        )
    );

    /**
     * 404 Page layout
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_pnf_layout',
        array(
            'default' => 'default',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'news_portal_pnf_layout'
        )
    );
    $wp_customize->add_control(
        'np_pnf_layout',
        array(
            'type' => 'select',
            'priority' => 5,
            'label' => __( 'Page Layout', 'news-portal-pro' ),
            'section' => 'np_pnf_settings_section',
            'choices' => array(                    
                    'default' => __( 'Default Layout', 'news-portal-pro' ),
                    'extra'   => __( 'Extra Layout', 'news-portal-pro' )
                )
        )
    );

    /**
     * Post fallback image
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_pnf_image',
            array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        'np_pnf_image',
            array(
                'label'      => esc_html__( '404 Image', 'news-portal-pro' ),
                'section'    => 'np_pnf_settings_section',
                'priority' => 10,
                'active_callback' => 'news_portal_pnf_extra_layout_callback'
            )
        )
    );

    /**
     * Textarea field for 404 page headline
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_pnf_headline',
        array(
            'default'    => __( 'Ooops... Error 404', 'news-portal-pro' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'news_portal_sanitize_textarea_content'
            )
    );
    $wp_customize->add_control(
        'np_pnf_headline',
        array(
            'type'      => 'textarea',
            'label'     => esc_html__( 'Page Headline', 'news-portal-pro' ),
            'section'   => 'np_pnf_settings_section',
            'priority'  => 15,
            'active_callback' => 'news_portal_pnf_extra_layout_callback'
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'np_pnf_headline', 
            array(
                'selector' => '.top-wrapper-404 .page-title',
                'render_callback' => 'news_portal_customize_partial_pnf_headline',
            )
    );

    /**
     * Textarea field for 404 page content
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_pnf_content',
        array(
            'default'    => __( 'Sorry, but the page you are looking for doesn`t exist.', 'news-portal-pro' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'news_portal_sanitize_textarea_content'
            )
    );
    $wp_customize->add_control(
        'np_pnf_content',
        array(
            'type'      => 'textarea',
            'label'     => esc_html__( 'Page Content', 'news-portal-pro' ),
            'section'   => 'np_pnf_settings_section',
            'priority'  => 20,
            'active_callback' => 'news_portal_pnf_extra_layout_callback'
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'np_pnf_content', 
            array(
                'selector' => '.top-wrapper-404 .pnf-content',
                'render_callback' => 'news_portal_customize_partial_pnf_content',
            )
    );

    /**
     * Text field for button label
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_pnf_button_label',
        array(
            'default'    => __( 'Home Page', 'news-portal-pro' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'np_pnf_button_label',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Page Button', 'news-portal-pro' ),
            'section'   => 'np_pnf_settings_section',
            'priority'  => 25,
            'active_callback' => 'news_portal_pnf_extra_layout_callback'
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'np_pnf_button_label', 
            array(
                'selector' => '.top-wrapper-404 .pnf-button',
                'render_callback' => 'news_portal_customize_partial_pnf_btn_txt',
            )
    );

    /**
     * Text field for button link
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_pnf_button_link',
        array(
            'default'    => esc_url( home_url() ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control(
        'np_pnf_button_link',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Page Button Link', 'news-portal-pro' ),
            'section'   => 'np_pnf_settings_section',
            'priority'  => 30,
            'active_callback' => 'news_portal_pnf_extra_layout_callback'
        )
    );

    /**
     * Switch option for Latest Posts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_pnf_latest_posts_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_pnf_latest_posts_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Latest Posts Option', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option for latest posts section at 404 page.', 'news-portal-pro' ),
                'section'   => 'np_pnf_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 35,
                'active_callback' => 'news_portal_pnf_extra_layout_callback'
            )
        )
    );


}