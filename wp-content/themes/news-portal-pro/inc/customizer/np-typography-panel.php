<?php
/**
 * Typography panel in customizer section
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

add_action( 'customize_register', 'news_portal_typography_panel_register' );

if ( !function_exists( 'news_portal_typography_panel_register' ) ) :

	function news_portal_typography_panel_register( $wp_customize ) {

		//Register the custom class for typography
		$wp_customize->register_control_type( 'News_Portal_Typography_Customizer_Control' );

		/**
		 * Add Header Settings panel
		 */
		$wp_customize->add_panel(
	        'news_portal_typography_panel',
        	array(
        		'priority'       => 35,
            	'capability'     => 'edit_theme_options',
            	'theme_supports' => '',
            	'title'          => esc_html__( 'Typography', 'news-portal-pro' ),
            ) 
	    );

/*-----------------------------------------------------------------------------------------------------------------------*/
		/**
		 * Body/Paragraph section
		 */
		$wp_customize->add_section(
	        'news_portal_body_typo_section',
	        array(
	            'title'		=> esc_html__( 'Paragraph', 'news-portal-pro' ),
	            'panel'     => 'news_portal_typography_panel',
	            'priority'  => 5,
	        )
	    );

	    /**
	     * Settings for paragraph typography 
	     */
	    $wp_customize->add_setting( 'p_font_family', array( 'default' => 'Open Sans', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'p_font_style', array( 'default' => 'regular', 'sanitize_callback' => 'sanitize_key', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'p_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'p_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'p_font_size', array( 'default' => '14', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'p_line_height', array( 'default' => '1.8', 'sanitize_callback' => 'news_portal_floatval', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'p_color', array( 'default' => '#3d3d3d ', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );

		/**
	     * Controls for paragraph typography 
	     */
		$wp_customize->add_control( new News_Portal_Typography_Customizer_Control (
			$wp_customize,
				'p_typography',
				array(
					'label'       => esc_html__( 'Paragraph Typography', 'news-portal-pro' ),
					'description' => __( 'Select how you want your paragraphs to appear.', 'news-portal-pro' ),
					'section'     => 'news_portal_body_typo_section',
					'settings'    => array(
						'family'      		=> 'p_font_family',
						'style'       		=> 'p_font_style',
						'text_decoration' 	=> 'p_text_decoration',
						'text_transform' 	=> 'p_text_transform',
						'size'        		=> 'p_font_size',
						'line_height' 		=> 'p_line_height',
						'typocolor'  		=> 'p_color'
					),
					// Pass custom labels. Use the setting key (above) for the specific label.
					'l10n'        => array(),
				)
			)
		);
/*-----------------------------------------------------------------------------------------------------------------------*/
		/**
		 * H1 section
		 */
		$wp_customize->add_section(
	        'news_portal_h1_typo_section',
	        array(
	            'title'		=> esc_html__( 'Heading 1', 'news-portal-pro' ),
	            'panel'     => 'news_portal_typography_panel',
	            'priority'  => 10,
	        )
	    );

	    /**
	     * Settings for Heading 1 typography 
	     */
	    $wp_customize->add_setting( 'h1_font_family', array( 'default' => 'Roboto', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h1_font_style', array( 'default' => '700', 'sanitize_callback' => 'sanitize_key', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h1_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h1_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h1_font_size', array( 'default' => '36', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h1_line_height', array( 'default' => '1.3', 'sanitize_callback' => 'news_portal_floatval', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h1_color', array( 'default' => '#3d3d3d ', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );

		/**
	     * Controls for Header 1 typography
	     */
		$wp_customize->add_control( new News_Portal_Typography_Customizer_Control (
			$wp_customize,
				'h1_typography',
				array(
					'label'       => esc_html__( 'Heading 1 Typography', 'news-portal-pro' ),
					'description' => __( 'Select how you want your Heading 1 to appear.', 'news-portal-pro' ),
					'section'     => 'news_portal_h1_typo_section',
					'settings'    => array(
						'family'      		=> 'h1_font_family',
						'style'       		=> 'h1_font_style',
						'text_decoration' 	=> 'h1_text_decoration',
						'text_transform' 	=> 'h1_text_transform',
						'size'        		=> 'h1_font_size',
						'line_height' 		=> 'h1_line_height',
						'typocolor'  		=> 'h1_color'
					),
					// Pass custom labels. Use the setting key (above) for the specific label.
					'l10n'        => array(),
				)
			)
		);

/*-----------------------------------------------------------------------------------------------------------------------*/
		/**
		 * H2 section
		 */
		$wp_customize->add_section(
	        'news_portal_h2_typo_section',
	        array(
	            'title'		=> esc_html__( 'Heading 2', 'news-portal-pro' ),
	            'panel'     => 'news_portal_typography_panel',
	            'priority'  => 15,
	        )
	    );

	    /**
	     * Settings for Heading 2 typography 
	     */
	    $wp_customize->add_setting( 'h2_font_family', array( 'default' => 'Roboto', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h2_font_style', array( 'default' => '700', 'sanitize_callback' => 'sanitize_key', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h2_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h2_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h2_font_size', array( 'default' => '30', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h2_line_height', array( 'default' => '1.3', 'sanitize_callback' => 'news_portal_floatval', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h2_color', array( 'default' => '#3d3d3d ', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );

		/**
	     * Controls for Header 2 typography 
	     */
		$wp_customize->add_control( new News_Portal_Typography_Customizer_Control (
			$wp_customize,
				'h2_typography',
				array(
					'label'       => esc_html__( 'Heading 2 Typography', 'news-portal-pro' ),
					'description' => __( 'Select how you want your Heading 2 to appear.', 'news-portal-pro' ),
					'section'     => 'news_portal_h2_typo_section',
					'settings'    => array(
						'family'      		=> 'h2_font_family',
						'style'       		=> 'h2_font_style',
						'text_decoration' 	=> 'h2_text_decoration',
						'text_transform' 	=> 'h2_text_transform',
						'size'        		=> 'h2_font_size',
						'line_height' 		=> 'h2_line_height',
						'typocolor'  		=> 'h2_color'
					),
					// Pass custom labels. Use the setting key (above) for the specific label.
					'l10n'        => array(),
				)
			)
		);

/*-----------------------------------------------------------------------------------------------------------------------*/
		/**
		 * H3 section
		 */
		$wp_customize->add_section(
	        'news_portal_h3_typo_section',
	        array(
	            'title'		=> esc_html__( 'Heading 3', 'news-portal-pro' ),
	            'panel'     => 'news_portal_typography_panel',
	            'priority'  => 15,
	        )
	    );

	    /**
	     * Settings for Heading 3 typography 
	     */
	    $wp_customize->add_setting( 'h3_font_family', array( 'default' => 'Roboto', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h3_font_style', array( 'default' => '700', 'sanitize_callback' => 'sanitize_key', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h3_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h3_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h3_font_size', array( 'default' => '26', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h3_line_height', array( 'default' => '1.3', 'sanitize_callback' => 'news_portal_floatval', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h3_color', array( 'default' => '#3d3d3d ', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );

		/**
	     * Controls for Header 3 typography 
	     */
		$wp_customize->add_control( new News_Portal_Typography_Customizer_Control (
			$wp_customize,
				'h3_typography',
				array(
					'label'       => esc_html__( 'Heading 3 Typography', 'news-portal-pro' ),
					'description' => __( 'Select how you want your Heading 3 to appear.', 'news-portal-pro' ),
					'section'     => 'news_portal_h3_typo_section',
					'settings'    => array(
						'family'      		=> 'h3_font_family',
						'style'       		=> 'h3_font_style',
						'text_decoration' 	=> 'h3_text_decoration',
						'text_transform' 	=> 'h3_text_transform',
						'size'        		=> 'h3_font_size',
						'line_height' 		=> 'h3_line_height',
						'typocolor'  		=> 'h3_color'
					),
					// Pass custom labels. Use the setting key (above) for the specific label.
					'l10n'        => array(),
				)
			)
		);

/*-----------------------------------------------------------------------------------------------------------------------*/
		/**
		 * H4 section
		 */
		$wp_customize->add_section(
	        'news_portal_h4_typo_section',
	        array(
	            'title'		=> esc_html__( 'Heading 4', 'news-portal-pro' ),
	            'panel'     => 'news_portal_typography_panel',
	            'priority'  => 20,
	        )
	    );

	    /**
	     * Settings for Heading 4 typography 
	     */
	    $wp_customize->add_setting( 'h4_font_family', array( 'default' => 'Roboto', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h4_font_style', array( 'default' => '700', 'sanitize_callback' => 'sanitize_key', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h4_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h4_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h4_font_size', array( 'default' => '20', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h4_line_height', array( 'default' => '1.3', 'sanitize_callback' => 'news_portal_floatval', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h4_color', array( 'default' => '#3d3d3d ', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );

		/**
	     * Controls for Header 4 typography 
	     */
		$wp_customize->add_control( new News_Portal_Typography_Customizer_Control (
			$wp_customize,
				'h4_typography',
				array(
					'label'       => esc_html__( 'Heading 4 Typography', 'news-portal-pro' ),
					'description' => __( 'Select how you want your Heading 4 to appear.', 'news-portal-pro' ),
					'section'     => 'news_portal_h4_typo_section',
					'settings'    => array(
						'family'      		=> 'h4_font_family',
						'style'       		=> 'h4_font_style',
						'text_decoration' 	=> 'h4_text_decoration',
						'text_transform' 	=> 'h4_text_transform',
						'size'        		=> 'h4_font_size',
						'line_height' 		=> 'h4_line_height',
						'typocolor'  		=> 'h4_color'
					),
					// Pass custom labels. Use the setting key (above) for the specific label.
					'l10n'        => array(),
				)
			)
		);

/*-----------------------------------------------------------------------------------------------------------------------*/
		/**
		 * H5 section
		 */
		$wp_customize->add_section(
	        'news_portal_h5_typo_section',
	        array(
	            'title'		=> esc_html__( 'Heading 5', 'news-portal-pro' ),
	            'panel'     => 'news_portal_typography_panel',
	            'priority'  => 25,
	        )
	    );

	    /**
	     * Settings for Heading 5 typography 
	     */
	    $wp_customize->add_setting( 'h5_font_family', array( 'default' => 'Roboto', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h5_font_style', array( 'default' => '700', 'sanitize_callback' => 'sanitize_key', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h5_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h5_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h5_font_size', array( 'default' => '18', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h5_line_height', array( 'default' => '1.3', 'sanitize_callback' => 'news_portal_floatval', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h5_color', array( 'default' => '#3d3d3d ', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );

		/**
	     * Controls for Header 5 typography 
	     */
		$wp_customize->add_control( new News_Portal_Typography_Customizer_Control (
			$wp_customize,
				'h5_typography',
				array(
					'label'       => esc_html__( 'Heading 5 Typography', 'news-portal-pro' ),
					'description' => __( 'Select how you want your Heading 5 to appear.', 'news-portal-pro' ),
					'section'     => 'news_portal_h5_typo_section',
					'settings'    => array(
						'family'      		=> 'h5_font_family',
						'style'       		=> 'h5_font_style',
						'text_decoration' 	=> 'h5_text_decoration',
						'text_transform' 	=> 'h5_text_transform',
						'size'        		=> 'h5_font_size',
						'line_height' 		=> 'h5_line_height',
						'typocolor'  		=> 'h5_color'
					),
					// Pass custom labels. Use the setting key (above) for the specific label.
					'l10n'        => array(),
				)
			)
		);

/*-----------------------------------------------------------------------------------------------------------------------*/
		/**
		 * H6 section
		 */
		$wp_customize->add_section(
	        'news_portal_h6_typo_section',
	        array(
	            'title'		=> esc_html__( 'Heading 6', 'news-portal-pro' ),
	            'panel'     => 'news_portal_typography_panel',
	            'priority'  => 30,
	        )
	    );

	    /**
	     * Settings for Heading 6 typography 
	     */
	    $wp_customize->add_setting( 'h6_font_family', array( 'default' => 'Roboto', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h6_font_style', array( 'default' => '700', 'sanitize_callback' => 'sanitize_key', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h6_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h6_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h6_font_size', array( 'default' => '16', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h6_line_height', array( 'default' => '1.3', 'sanitize_callback' => 'news_portal_floatval', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'h6_color', array( 'default' => '#3d3d3d ', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );

		/**
	     * Controls for Header 6 typography 
	     */
		$wp_customize->add_control( new News_Portal_Typography_Customizer_Control (
			$wp_customize,
				'h6_typography',
				array(
					'label'       => esc_html__( 'Heading 6 Typography', 'news-portal-pro' ),
					'description' => __( 'Select how you want your Heading 6 to appear.', 'news-portal-pro' ),
					'section'     => 'news_portal_h6_typo_section',
					'settings'    => array(
						'family'      		=> 'h6_font_family',
						'style'       		=> 'h6_font_style',
						'text_decoration' 	=> 'h6_text_decoration',
						'text_transform' 	=> 'h6_text_transform',
						'size'        		=> 'h6_font_size',
						'line_height' 		=> 'h6_line_height',
						'typocolor'  		=> 'h6_color'
					),
					// Pass custom labels. Use the setting key (above) for the specific label.
					'l10n'        => array(),
				)
			)
		);

/*-----------------------------------------------------------------------------------------------------------------------*/
		/**
		 * Main Menu section
		 */
		$wp_customize->add_section(
	        'news_portal_menu_typo_section',
	        array(
	            'title'		=> esc_html__( 'Primary Menu', 'news-portal-pro' ),
	            'panel'     => 'news_portal_typography_panel',
	            'priority'  => 30,
	        )
	    );

	    /**
	     * Settings for Menu typography 
	     */
	    $wp_customize->add_setting( 'menu_font_family', array( 'default' => 'Roboto', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'menu_font_style', array( 'default' => '300', 'sanitize_callback' => 'sanitize_key', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'menu_text_decoration', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'menu_text_transform', array( 'default' => 'none', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'menu_font_size', array( 'default' => '14', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'menu_line_height', array( 'default' => '40', 'sanitize_callback' => 'absint', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'menu_color', array( 'default' => '#ffffff ', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
		$wp_customize->add_setting( 'menu_bg_color', array( 'default' => '#f54337 ', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );

		/**
	     * Controls for Primary Menu typography 
	     */
		$wp_customize->add_control( new News_Portal_Typography_Customizer_Control (
			$wp_customize,
				'menu_typography',
				array(
					'label'       => esc_html__( 'Primary Menu Typography', 'news-portal-pro' ),
					'description' => __( 'Select how you want your primary menu to appear.', 'news-portal-pro' ),
					'section'     => 'news_portal_menu_typo_section',
					'settings'    => array(
						'family'      		=> 'menu_font_family',
						'style'       		=> 'menu_font_style',
						'text_decoration' 	=> 'menu_text_decoration',
						'text_transform' 	=> 'menu_text_transform',
						'size'        		=> 'menu_font_size',
						'px_line_height' 	=> 'menu_line_height',
						'typocolor'  		=> 'menu_color',
						'bg_color' 			=> 'menu_bg_color'
					),
					// Pass custom labels. Use the setting key (above) for the specific label.
					'l10n'        => array(),
				)
			)
		);

	} //close function
	
endif;