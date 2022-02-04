<?php
/**
 * News Portal Additional Settings panel at Theme Customizer
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_portal_additional_settings_register' );

function news_portal_additional_settings_register( $wp_customize ) {

	/**
     * Add Additional Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'news_portal_additional_settings_panel',
	    array(
	        'priority'       => 20,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Additional Settings', 'news-portal-pro' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
	 * Social Icons Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
        'np_social_icons_section',
        array(
            'title'		=> esc_html__( 'Social Icons', 'news-portal-pro' ),
            'panel'     => 'news_portal_additional_settings_panel',
            'priority'  => 5,
        )
    );

    /**
     * Repeater field for social media icons
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'social_media_icons', 
        array(
            'sanitize_callback' => 'news_portal_sanitize_repeater',
            'default' => json_encode(array(
                array(
                    'social_icon_class' => 'fa fa-facebook-f',
                    'social_icon_url' => '',
                    )
            ))
        )
    );
    $wp_customize->add_control( new News_Portal_Repeater_Controler(
        $wp_customize, 
            'social_media_icons', 
            array(
                'label'   => __( 'Social Media Icons', 'news-portal-pro' ),
                'section' => 'np_social_icons_section',
                'settings' => 'social_media_icons',
                'priority' => 5,
                'news_portal_box_label' => __( 'Social Media Icon','news-portal-pro' ),
                'news_portal_box_add_control' => __( 'Add Icon','news-portal-pro' )
            ),
            array(
                'social_icon_class' => array(
                    'type'        => 'social_icon',
                    'label'       => __( 'Social Media Logo', 'news-portal-pro' ),
                    'description' => __( 'Choose social media icon.', 'news-portal-pro' )
                ),
                'social_icon_url' => array(
                    'type'        => 'url',
                    'label'       => __( 'Social Icon Url', 'news-portal-pro' ),
                    'description' => __( 'Enter social media url.', 'news-portal-pro' )
                )
            )
        ) 
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
   	/**
   	 * Category Color Section
   	 *
   	 * @since 1.0.0
   	 */
    $wp_customize->add_section(
        'np_categories_color_section',
        array(
            'title'         => __( 'Categories Color', 'news-portal-pro' ),
            'priority'      => 10,
            'panel'         => 'news_portal_additional_settings_panel',
        )
    );

	$priority = 5;
	$categories = get_categories( array( 'hide_empty' => 1 ) );
	$wp_category_list = array();

	foreach ( $categories as $category_list ) {

		$wp_customize->add_setting( 
			'np_category_color_'.esc_html( strtolower( $category_list->slug ) ),
			array(
				'default'              => '#00a9e0',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'sanitize_hex_color'
			)
		);

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 
			'np_category_color_'.esc_html( strtolower( $category_list->slug ) ),
				array(
					'label'    => sprintf( esc_html__( ' %s', 'news-portal-pro' ), esc_html( $category_list->name ) ),
					'section'  => 'np_categories_color_section',
					'priority' => absint( $priority )
				)
			)
		);
		$priority++;
	}
/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Widget Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'np_widget_settings_section',
        array(
            'title'     => esc_html__( 'Widget Settings', 'news-portal-pro' ),
            'panel'     => 'news_portal_additional_settings_panel',
            'priority'  => 15,
        )
    );

    /**
     * Switch option for category link at widget title
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_widget_cat_link_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_widget_cat_link_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Category Link', 'news-portal-pro' ),
                'description'   => esc_html__( 'Enable/Disable option for category link for widget title in block layout widget.', 'news-portal-pro' ),
                'section'   => 'np_widget_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Enable', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Disable', 'news-portal-pro' )
                    ),
                'priority'  => 5,
            )
        )
    );

    /**
     * Switch option for category color at widget title
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_widget_cat_color_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_widget_cat_color_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Category Color', 'news-portal-pro' ),
                'description'   => esc_html__( 'Enable/Disable option for category color for widget title in block layout widget.', 'news-portal-pro' ),
                'section'   => 'np_widget_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Enable', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Disable', 'news-portal-pro' )
                    ),
                'priority'  => 10,
            )
        )
    );

    /**
     * Switch option for post format icon in widget posts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_widget_format_icon_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'news_portal_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_widget_format_icon_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Post Format Icon', 'news-portal-pro' ),
                'description'   => esc_html__( 'Show/Hide option for post format icon in widget posts.', 'news-portal-pro' ),
                'section'   => 'np_widget_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'news-portal-pro' ),
                    'hide'  => esc_html__( 'Hide', 'news-portal-pro' )
                    ),
                'priority'  => 15,
            )
        )
    );

    /**
     * Post date option (condition apply only for widget posts)
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_widget_post_date', 
        array(
            'default' => 'show',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'news_portal_sanitize_switch_option'
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_widget_post_date', 
            array(
                'type' => 'switch',
                'label' => __( 'Post Date Option', 'news-portal-pro' ),
                'description' => __( 'Show/hide date from post ( only from widget posts ).', 'news-portal-pro' ),
                'priority'      => 20,
                'section' => 'np_widget_settings_section',
                'choices' => array(
                    'show' => __( 'Show', 'news-portal-pro' ),
                    'hide' => __( 'Hide', 'news-portal-pro' )
                )
            )
        )
    );
    /*$wp_customize->selective_refresh->add_partial(
        'np_widget_post_date', 
            array(
                'selector' => 'span.posted-on',
                'render_callback' => 'news_portal_customize_partial_widget_post_date',
            )
    );*/

    /**
     * Post author option (condition apply only for widget posts)
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_widget_post_author', 
        array(
            'default' => 'show',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'news_portal_sanitize_switch_option'
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_widget_post_author', 
            array(
                'type' => 'switch',
                'label' => __( 'Post Author Option', 'news-portal-pro' ),
                'description' => __( 'Show/hide author from post ( only from widget posts ).', 'news-portal-pro' ),
                'priority'      => 25,
                'section' => 'np_widget_settings_section',
                'choices' => array(
                    'show' => __( 'Show', 'news-portal-pro' ),
                    'hide' => __( 'Hide', 'news-portal-pro' )
                )
            )
        )
    );
    /*$wp_customize->selective_refresh->add_partial(
        'np_widget_post_author', 
            array(
                'selector' => 'span.byline',
                'render_callback' => 'news_portal_customize_partial_widget_author',
            )
    );*/

    /**
     * Post comment option (condition apply only for widget posts)
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_widget_post_comment', 
        array(
            'default' => 'show',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'news_portal_sanitize_switch_option'
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_widget_post_comment', 
            array(
                'type' => 'switch',
                'label' => __( 'Post Comment Option', 'news-portal-pro' ),
                'description' => __( 'Show/hide comment from post ( only from widget posts ).', 'news-portal-pro' ),
                'priority'      => 30,
                'section' => 'np_widget_settings_section',
                'choices' => array(
                    'show' => __( 'Show', 'news-portal-pro' ),
                    'hide' => __( 'Hide', 'news-portal-pro' )
                )
            )
        )
    );
    /*$wp_customize->selective_refresh->add_partial(
        'np_widget_post_comment', 
            array(
                'selector' => 'span.comments-link',
                'render_callback' => 'news_portal_customize_partial_widget_comment',
            )
    );*/

    /**
     * Post review option (condition apply only for widget posts)
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_widget_post_review', 
        array(
            'default' => 'show',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
            'sanitize_callback' => 'news_portal_sanitize_switch_option'
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_widget_post_review', 
            array(
                'type' => 'switch',
                'label' => __( 'Post Review Option', 'news-portal-pro' ),
                'description' => __( 'Show/hide review from post ( only from widget posts ).', 'news-portal-pro' ),
                'priority'      => 35,
                'section' => 'np_widget_settings_section',
                'choices' => array(
                    'show' => __( 'Show', 'news-portal-pro' ),
                    'hide' => __( 'Hide', 'news-portal-pro' )
                )
            )
        )
    );
    /*$wp_customize->selective_refresh->add_partial(
        'np_widget_post_review', 
            array(
                'selector' => '.post-review-wrapper',
                'render_callback' => 'news_portal_customize_partial_widget_review',
            )
    );*/

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Featured Image Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'np_featured_image_settings_section',
        array(
            'title'     => esc_html__( 'Featured Image Settings', 'news-portal-pro' ),
            'panel'     => 'news_portal_additional_settings_panel',
            'priority'  => 20,
        )
    );

    /**
     * Post image hover types
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'post_image_hover_type',
        array(
            'default' => 'zoomin',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'news_portal_image_hover_type'
        )
    );
    $wp_customize->add_control(
        'post_image_hover_type',
        array(
            'type' => 'select',
            'priority' => 5,
            'label' => __( 'Image Hover Type', 'news-portal-pro' ),
            'section' => 'np_featured_image_settings_section',
            'choices' => array(                    
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
                )
        )
    );

    /**
     * Switch option for Fallback image
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_post_fallback_image_option', 
        array(
            'default' => 'show',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'news_portal_sanitize_switch_option'
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_post_fallback_image_option', 
            array(
                'type' => 'switch',
                'label' => __( 'Fallback Image Option', 'news-portal-pro' ),
                'description' => __( 'Show/hide option for post fallback images.', 'news-portal-pro' ),
                'priority'      => 15,
                'section' => 'np_featured_image_settings_section',
                'choices' => array(
                    'show' => __( 'Show', 'news-portal-pro' ),
                    'hide' => __( 'Hide', 'news-portal-pro' )
                )
            )
        )
    );

    /**
     * Post fallback image
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_post_fallback_image',
            array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw'
            )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        'np_post_fallback_image',
            array(
                'label'      => esc_html__( 'Fallback Image', 'news-portal-pro' ),
                'section'    => 'np_featured_image_settings_section',
                'priority' => 20
            )
        )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Breadcrumbs Section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'np_breadcrumb_section',
        array(
            'title'         => __( 'Breadcrumbs Settings', 'news-portal-pro' ),
            'panel'         => 'news_portal_additional_settings_panel',
            'priority'      => 25            
        )
    );

    /**
     * Switch option for Breadcrumb
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_breadcrumb_option', 
        array(
            'default' => 'show',
            'transport' => 'postMessage',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'news_portal_sanitize_switch_option'
        )
    );
    $wp_customize->add_control( new News_Portal_Customize_Switch_Control(
        $wp_customize,
            'np_breadcrumb_option', 
            array(
                'type' => 'switch',
                'label' => __( 'Breadcrumb Option', 'news-portal-pro' ),
                'description' => __( 'Show/hide option for breadcrumb at innerpages.', 'news-portal-pro' ),
                'priority'      => 5,
                'section' => 'np_breadcrumb_section',
                'choices' => array(
                    'show' => __( 'Show', 'news-portal-pro' ),
                    'hide' => __( 'Hide', 'news-portal-pro' )
                )
            )
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'np_breadcrumb_option', 
            array(
                'selector' => '.np-breadcrumbs',
                'render_callback' => 'news_portal_customize_partial_breadcrumb_option',
            )
    );

    /**
     * Breadcrumbs Home Text
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_bread_home',
        array(
            'default'    => __( 'Home', 'news-portal-pro' ),
            'transport' => 'postMessage',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'np_bread_home',
        array(
            'type' => 'text',
            'priority' => 10,
            'label' => __( 'Home Text', 'news-portal-pro' ),
            'description' => __( 'Add breadcrumbs home text.', 'news-portal-pro' ),
            'section' => 'np_breadcrumb_section'
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'np_bread_home', 
            array(
                'selector' => '.np-breadcrumbs a.home span',
                'render_callback' => 'news_portal_customize_partial_breadcrumb_home',
            )
    );

    /**
     * Breadcrumbs Separator value
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_bread_sep',
        array(
            'default' => '>',
            'transport' => 'postMessage',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'np_bread_sep',
        array(
            'type' => 'text',
            'priority' => 15,
            'label' => __( 'Separator Value', 'news-portal-pro' ),
            'section' => 'np_breadcrumb_section'
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'np_bread_sep', 
            array(
                'selector' => '.np-breadcrumbs span.sep',
                'render_callback' => 'news_portal_customize_partial_breadcrumb_sep',
            )
    );

    /**
     * Breadcrumbs category prefix
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_bread_cat_prefix',
        array(
            'default' => __( 'Archive by Category', 'news-portal-pro' ),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'np_bread_cat_prefix',
        array(
            'type' => 'text',
            'priority' => 20,
            'label' => __( 'Category Prefix Text', 'news-portal-pro' ),
            'section' => 'np_breadcrumb_section'
        )
    );

    /**
     * Breadcrumbs search prefix
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_bread_search_prefix',
        array(
            'default' => __( 'Search Results for', 'news-portal-pro' ),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'np_bread_search_prefix',
        array(
            'type' => 'text',
            'priority' => 25,
            'label' => __( 'Search Prefix Text', 'news-portal-pro' ),
            'section' => 'np_breadcrumb_section'
        )
    );

    /**
     * Breadcrumbs tag prefix
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_bread_tag_prefix',
        array(
            'default' => __( 'Posts Tagged', 'news-portal-pro' ),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'np_bread_tag_prefix',
        array(
            'type' => 'text',
            'priority' => 30,
            'label' => __( 'Tag Prefix Text', 'news-portal-pro' ),
            'section' => 'np_breadcrumb_section'
        )
    );

    /**
     * Breadcrumbs author prefix
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_bread_author_prefix',
        array(
            'default' => __( 'Articles Posted by', 'news-portal-pro' ),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'np_bread_author_prefix',
        array(
            'type' => 'text',
            'priority' => 35,
            'label' => __( 'Author Prefix Text', 'news-portal-pro' ),
            'section' => 'np_breadcrumb_section'
        )
    );

    /**
     * Breadcrumbs error/404 prefix
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_bread_error_prefix',
        array(
            'default' => __( 'Error 404', 'news-portal-pro' ),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'np_bread_error_prefix',
        array(
            'type' => 'text',
            'priority' => 40,
            'label' => __( 'Error/404 Prefix Text', 'news-portal-pro' ),
            'section' => 'np_breadcrumb_section'
        )
    );

    /**
     * Breadcrumbs page prefix
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_bread_page_prefix',
        array(
            'default' => __( 'Page', 'news-portal-pro' ),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'np_bread_page_prefix',
        array(
            'type' => 'text',
            'priority' => 45,
            'label' => __( 'Page Prefix Text', 'news-portal-pro' ),
            'section' => 'np_breadcrumb_section'
        )
    );

    /**
     * Breadcrumbs comment page prefix
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'np_bread_cmt_page_prefix',
        array(
            'default' => __( 'Comment Page', 'news-portal-pro' ),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'np_bread_cmt_page_prefix',
        array(
            'type' => 'text',
            'priority' => 50,
            'label' => __( 'Comment Page Prefix Text', 'news-portal-pro' ),
            'section' => 'np_breadcrumb_section'
        )
    );

}