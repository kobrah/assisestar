<?php
/**
 * Functions and codes for dynamic styles
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */


add_action( 'wp_enqueue_scripts', 'news_portal_dynamic_styles' );

if ( ! function_exists( 'news_portal_dynamic_styles' ) ) :

    function news_portal_dynamic_styles() {

        $get_categories = get_categories( array( 'hide_empty' => 1 ) );
        $np_theme_color = get_theme_mod( 'np_theme_color', '#f54337' );
        $np_theme_hover_color = news_portal_hover_color( $np_theme_color, '-50' );

        $np_site_title_option = get_theme_mod( 'np_site_title_option', true );
        $np_site_title_color  = get_theme_mod( 'np_site_title_color', '##f54337' );

        $np_widget_bg_color = get_theme_mod( 'np_widget_bg_color', '#000000' );

        $np_site_logo_width = get_theme_mod( 'np_site_logo_width', '300' );
        $np_custom_logo_width_opt = get_theme_mod( 'np_custom_logo_width_opt', false );

        $output_css = '';

        foreach ( $get_categories as $category ) {

            $cat_color = get_theme_mod( 'np_category_color_'.strtolower( $category->slug ), '#00a9e0' );

            $cat_hover_color = news_portal_hover_color( $cat_color, '-50' );
            $cat_id = $category->term_id;
            
            if ( !empty( $cat_color ) ) {
                $output_css .= ".category-button.np-cat-". esc_attr( $cat_id ) ." a { background: ". esc_attr( $cat_color ) ."}\n";

                $output_css .= ".category-button.np-cat-". esc_attr( $cat_id ) ." a:hover { background: ". esc_attr( $cat_hover_color ) ."}\n";

                $output_css .= ".np-block-title .np-cat-". esc_attr( $cat_id ) ." { color: ". esc_attr( $cat_color ) ."}\n";
            }
        }

        $output_css .= ".navigation .nav-links a,.bttn,button,input[type=button],input[type=reset],input[type=submit],.navigation .nav-links a:hover,.bttn:hover,button,input[type=button]:hover,input[type=reset]:hover,input[type=submit]:hover,.widget_search .search-submit,.edit-link .post-edit-link,.reply .comment-reply-link,.np-top-header-wrap,.np-header-menu-wrapper,.home #masthead.default .np-home-icon a,.np-home-icon a:hover,#site-navigation ul li:hover>a,#site-navigation ul li.current-menu-item>a,#site-navigation ul li.current_page_item>a,#site-navigation ul li.current-menu-ancestor>a,.np-header-menu-wrapper::before,.np-header-menu-wrapper::after,.np-header-search-wrapper .search-form-main .search-submit,.layout1-ticker .lSSlideOuter.vertical .lSAction>a:hover,.layout1-ticker .ticker-caption,.default-ticker .ticker-caption,.news_portal_featured_slider .np-featured-slider-section .lSAction>a:hover,.news_portal_slider .np-slider .lSAction>a:hover,.news_portal_featured_slider .lSSlideOuter .lSPager.lSpg>li:hover a,.news_portal_featured_slider .lSSlideOuter .lSPager.lSpg>li.active a,.news_portal_slider .np-slider .lSSlideOuter .lSPager.lSpg>li:hover a,.news_portal_slider .np-slider .lSSlideOuter .lSPager.lSpg>li.active a,.news_portal_default_tabbed ul.widget-tabs li,.news_portal_default_tabbed ul.widget-tabs li.ui-tabs-active,.news_portal_default_tabbed ul.widget-tabs li:hover,.news_portal_carousel .carousel-nav-action .carousel-controls:hover,.news_portal_social_media .social-link a,.news_portal_social_media .social-link a:hover,.news_portal_social_media .layout2 .social-link a:hover,.news_portal_social_media .layout3 .social-link a:hover,.single-layout2 .post-on,.np-archive-more .np-button:hover,.error404 .page-title,.pnf-extra .pnf-button.btn,#np-scrollup,.woocommerce .price-cart:after,.woocommerce ul.products li.product .price-cart .button:hover,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit.alt,.woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.added_to_cart.wc-forward,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce ul.products li.product .onsale,.woocommerce span.onsale,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt[disabled]:disabled,.woocommerce #respond input#submit.alt[disabled]:disabled:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt[disabled]:disabled,.woocommerce a.button.alt[disabled]:disabled:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt[disabled]:disabled,.woocommerce button.button.alt[disabled]:disabled:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt[disabled]:disabled,.woocommerce input.button.alt[disabled]:disabled:hover,.format-video:before,.format-audio:before,.format-gallery:before,div.wpforms-container-full .wpforms-form input[type='submit'], div.wpforms-container-full .wpforms-form button[type='submit'],div.wpforms-container-full .wpforms-form .wpforms-page-button,div.wpforms-container-full .wpforms-form input[type='submit']:hover, div.wpforms-container-full .wpforms-form button[type='submit']:hover,div.wpforms-container-full .wpforms-form .wpforms-page-button:hover{ background: ". esc_attr( $np_theme_color ) ."}\n";

        $output_css .= ".home #masthead.default .np-home-icon a:hover,#masthead.default .np-home-icon a:hover,#site-navigation ul li:hover > a, #site-navigation ul li.current-menu-item > a,#site-navigation ul li.current_page_item > a,#site-navigation ul li.current-menu-ancestor > a,.news_portal_default_tabbed ul.widget-tabs li.ui-tabs-active, .news_portal_default_tabbed ul.widget-tabs li:hover { background: ". esc_attr( $np_theme_hover_color ) ."}\n";

        $output_css .= ".np-header-menu-block-wrap::before, .np-header-menu-block-wrap::after { border-right-color: ". esc_attr( $np_theme_hover_color ) ."}\n";

        $output_css .= "a,a:hover,a:focus,a:active,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.entry-footer a:hover,.comment-author .fn .url:hover,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.home #masthead.layout1 .np-home-icon a, #masthead.layout1 .np-home-icon a:hover,#masthead.layout1 #site-navigation ul li:hover>a,#masthead.layout1 #site-navigation ul li.current-menu-item>a,#masthead.layout1 #site-navigation ul li.current_page_item>a,#masthead.layout1 #site-navigation ul li.current-menu-ancestor>a,#masthead.layout1 .search-main:hover,.np-slide-content-wrap .post-title a:hover,.news_portal_featured_posts .np-single-post .np-post-content .np-post-title a:hover,.news_portal_fullwidth_posts .np-single-post .np-post-title a:hover,.news_portal_block_posts .layout3 .np-primary-block-wrap .np-single-post .np-post-title a:hover,.news_portal_list_posts .np-single-post .np-post-title:hover,.news_portal_featured_posts .layout2 .featured-middle-section .np-single-post .np-post-title a:hover,.news_portal_carousel .np-single-post .np-post-content .np-post-title a:hover,.news_portal_featured_slider .np-featured-section .np-single-post .np-post-content .np-post-title a:hover,.news_portal_featured_posts .layout2 .featured-left-section .np-single-post .np-post-content .np-post-title a:hover,.news_portal_featured_posts .layout2 .featured-right-section .np-single-post .np-post-content .np-post-title a:hover,.news_portal_featured_posts .layout1 .np-single-post-wrap .np-post-content .np-post-title a:hover,.np-block-title,.widget-title,.page-header .page-title,.np-related-title,.np-post-review-section-wrapper .review-title,.np-pnf-latest-posts-wrapper .section-title,.np-post-meta span:hover,.np-post-meta span a:hover,.news_portal_featured_posts .layout2 .np-single-post-wrap .np-post-content .np-post-meta span:hover,.news_portal_featured_posts .layout2 .np-single-post-wrap .np-post-content .np-post-meta span a:hover,.np-post-title.small-size a:hover,.news_portal_carousel .layout3 .np-single-post .np-post-content .np-post-title a:hover,.single-layout2 .extra-meta .post-view::before,.single-layout2 .extra-meta .comments-link::before,.np-post-meta span.star-value,#top-footer .widget a:hover,#top-footer .widget a:hover:before,#footer-navigation ul li a:hover,.entry-title a:hover,.entry-meta span a:hover,.entry-meta span:hover,.review-content-wrapper .stars-count,.review-content-wrapper .review-percent,.woocommerce ul.products li.product .price,.woocommerce div.product p.price,.woocommerce div.product span.price,.woocommerce .woocommerce-message:before,.woocommerce div.product p.price ins,.woocommerce div.product span.price ins,.woocommerce div.product p.price del,.woocommerce .woocommerce-info:before,.np-slide-content-wrap .np-post-meta span:hover,.np-slide-content-wrap .np-post-meta span a:hover,.news_portal_featured_posts .np-single-post .np-post-meta span:hover,.news_portal_featured_posts .np-single-post .np-post-meta span a:hover,.news_portal_list_posts .np-single-post .np-post-meta span:hover,.news_portal_list_posts .np-single-post .np-post-meta span a:hover,.news_portal_featured_posts .layout2 .featured-middle-section .np-single-post .np-post-meta span:hover,.news_portal_featured_posts .layout2 .featured-middle-section .np-single-post .np-post-meta span a:hover,.news_portal_carousel .np-single-post .np-post-meta span:hover,.news_portal_carousel .np-single-post .np-post-meta span a:hover,.news_portal_featured_posts .layout1 .np-single-post-wrap .np-post-content .np-post-meta span:hover,.news_portal_featured_posts .layout1 .np-single-post-wrap .np-post-content .np-post-meta span a:hover#masthead #site-navigation ul > li:hover > .sub-toggle, #masthead  #site-navigation ul > li.current-menu-item .sub-toggle, #masthead #site-navigation ul > li.current-menu-ancestor .sub-toggle{ color: ". esc_attr( $np_theme_color ) ."}\n";

        $output_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.widget_search .search-submit,.layout1-ticker .lSSlideOuter.vertical .lSAction>a:hover,.news_portal_slider .slider-layout1 .lSSlideOuter .lSPager.lSGallery li.active,.news_portal_slider .slider-layout1 .lSSlideOuter .lSPager.lSGallery li:hover,.news_portal_social_media .layout3 .social-link a:hover,.np-archive-more .np-button:hover,.woocommerce form .form-row.woocommerce-validated .select2-container,.woocommerce form .form-row.woocommerce-validated input.input-text,.woocommerce form .form-row.woocommerce-validated select{ border-color: ". esc_attr( $np_theme_color ) ."}\n";

        $output_css .= ".comment-list .comment-body,.np-header-search-wrapper .search-form-main,.woocommerce .woocommerce-info,.woocommerce .woocommerce-message { border-top-color: ". esc_attr( $np_theme_color ) ."}\n";

        $output_css .= ".np-header-search-wrapper .search-form-main:before{ border-bottom-color: ". esc_attr( $np_theme_color ) ."}\n";
        
        $output_css .= ".layout1-ticker .ticker-caption:after,.np-breadcrumbs{ border-left-color: ". esc_attr( $np_theme_color ) ."}\n";
        
        $output_css .= "#colophon { background: ". esc_attr( $np_widget_bg_color ) ."}\n";

        $output_css .= ".ball1,.single1ball,.single6,.single9:before{ background: ". esc_attr( $np_theme_color ) ."}\n";

        $output_css .= ".single4{ border-top-color: ". esc_attr( $np_theme_color ) ."}\n";

        $output_css .= ".single4{ border-bottom-color: ". esc_attr( $np_theme_color ) ."}\n";

        if ( true === $np_custom_logo_width_opt ) {
            $output_css .= ".site-branding .custom-logo { width: ". absint( $np_site_logo_width ) ."px }\n";
        }

        if ( $np_site_title_option === true ) {
            $output_css .=".site-title a, .site-description {
                color:". esc_attr( $np_site_title_color ) .";
            }\n";
        } else {
            $output_css .=".site-title, .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }\n";
        }

        /**
         * Body typography
         */
        $p_font_family          = get_theme_mod( 'p_font_family', 'Open Sans' );
        $p_font_style           = get_theme_mod( 'p_font_style', 'regular' );
        $p_text_decoration      = get_theme_mod( 'p_text_decoration', 'none' );
        $p_text_transform       = get_theme_mod( 'p_text_transform', 'none' );
        $p_font_size            = get_theme_mod( 'p_font_size', '14' ) . 'px';
        $p_line_height          = get_theme_mod( 'p_line_height', '1.8' );
        $p_color                = get_theme_mod( 'p_color', '#3d3d3d ' );

        if ( !empty( $p_font_style ) ) {
            $p_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $p_font_style );
            if ( isset( $p_font_style_weight[1] ) ) {
                $p_font_style = $p_font_style_weight[1];
            } else {
                $p_font_style = 'normal';
            }

            if ( isset( $p_font_style_weight[0] ) ) {
                $p_font_weight = $p_font_style_weight[0];
            } else {
                $p_font_weight = 400;
            }
        }
        $output_css .= "body {
            font-family: $p_font_family;
            font-style: $p_font_style;
            font-size: $p_font_size;
            font-weight: $p_font_weight;
            text-decoration: $p_text_decoration;
            text-transform: $p_text_transform;
            line-height: $p_line_height;
            color: $p_color;
        }\n";

        /**
         * H1 typography
         */
        $h1_font_family         = get_theme_mod( 'h1_font_family', 'Roboto' );
        $h1_font_style          = get_theme_mod( 'h1_font_style', '700' );
        $h1_text_decoration     = get_theme_mod( 'h1_text_decoration', 'none' );
        $h1_text_transform      = get_theme_mod( 'h1_text_transform', 'none' );
        $h1_font_size           = get_theme_mod( 'h1_font_size', '36' ) . 'px';
        $h1_line_height         = get_theme_mod( 'h1_line_height', '1.3' );
        $h1_color               = get_theme_mod( 'h1_color', '#3d3d3d' );

        if ( !empty( $h1_font_style ) ) {
            $h1_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $h1_font_style );
            if ( isset( $h1_font_style_weight[1] ) ) {
                $h1_font_style = $h1_font_style_weight[1];
            } else {
                $h1_font_style = 'normal';
            }

            if ( isset( $h1_font_style_weight[0] ) ) {
                $h1_font_weight = $h1_font_style_weight[0];
            } else {
                $h1_font_weight = 700;
            }
        }
        $output_css .= "h1, .search-results .entry-title, .archive .entry-title, .single .entry-title, .entry-title{
            font-family: $h1_font_family;
            font-style: $h1_font_style;
            font-size: $h1_font_size;
            font-weight: $h1_font_weight;
            text-decoration: $h1_text_decoration;
            text-transform: $h1_text_transform;
            line-height: $h1_line_height;
            color: $h1_color;
        }\n";

        /**
         * H2 typography
         */
        $h2_font_family         = get_theme_mod( 'h2_font_family', 'Roboto' );
        $h2_font_style          = get_theme_mod( 'h2_font_style', '700' );
        $h2_text_decoration     = get_theme_mod( 'h2_text_decoration', 'none' );
        $h2_text_transform      = get_theme_mod( 'h2_text_transform', 'none' );
        $h2_font_size           = get_theme_mod( 'h2_font_size', '30' ) . 'px';
        $h2_line_height         = get_theme_mod( 'h2_line_height', '1.3' );
        $h2_color               = get_theme_mod( 'h2_color', '#3d3d3d' );

        if ( !empty( $h2_font_style ) ) {
            $h2_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $h2_font_style );
            if ( isset( $h2_font_style_weight[1] ) ) {
                $h2_font_style = $h2_font_style_weight[1];
            } else {
                $h2_font_style = 'normal';
            }

            if ( isset( $h2_font_style_weight[0] ) ) {
                $h2_font_weight = $h2_font_style_weight[0];
            } else {
                $h2_font_weight = 700;
            }
        }
        $output_css .= "h2 {
            font-family: $h2_font_family;
            font-style: $h2_font_style;
            font-size: $h2_font_size;
            font-weight: $h2_font_weight;
            text-decoration: $h2_text_decoration;
            text-transform: $h2_text_transform;
            line-height: $h2_line_height;
            color: $h2_color;
        }\n";

        /**
         * H3 typography
         */
        $h3_font_family         = get_theme_mod( 'h3_font_family', 'Roboto' );
        $h3_font_style          = get_theme_mod( 'h3_font_style', '700' );
        $h3_text_decoration     = get_theme_mod( 'h3_text_decoration', 'none' );
        $h3_text_transform      = get_theme_mod( 'h3_text_transform', 'none' );
        $h3_font_size           = get_theme_mod( 'h3_font_size', '26' ) . 'px';
        $h3_line_height         = get_theme_mod( 'h3_line_height', '1.3' );
        $h3_color               = get_theme_mod( 'h3_color', '#3d3d3d' );

        if ( !empty( $h3_font_style ) ) {
            $h3_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $h3_font_style );
            if ( isset( $h3_font_style_weight[1] ) ) {
                $h3_font_style = $h3_font_style_weight[1];
            } else {
                $h3_font_style = 'normal';
            }

            if ( isset( $h3_font_style_weight[0] ) ) {
                $h3_font_weight = $h3_font_style_weight[0];
            } else {
                $h3_font_weight = 700;
            }
        }
        $output_css .= "h3 {
            font-family: $h3_font_family;
            font-style: $h3_font_style;
            font-size: $h3_font_size;
            font-weight: $h3_font_weight;
            text-decoration: $h3_text_decoration;
            text-transform: $h3_text_transform;
            line-height: $h3_line_height;
            color: $h3_color;
        }\n";

        /**
         * H4 typography
         */
        $h4_font_family         = get_theme_mod( 'h4_font_family', 'Roboto' );
        $h4_font_style          = get_theme_mod( 'h4_font_style', '700' );
        $h4_text_decoration     = get_theme_mod( 'h4_text_decoration', 'none' );
        $h4_text_transform      = get_theme_mod( 'h4_text_transform', 'none' );
        $h4_font_size           = get_theme_mod( 'h4_font_size', '20' ) . 'px';
        $h4_line_height         = get_theme_mod( 'h4_line_height', '1.3' );
        $h4_color               = get_theme_mod( 'h4_color', '#3d3d3d' );

        if ( !empty( $h4_font_style ) ) {
            $h4_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $h4_font_style );
            if ( isset( $h4_font_style_weight[1] ) ) {
                $h4_font_style = $h4_font_style_weight[1];
            } else {
                $h4_font_style = 'normal';
            }

            if ( isset( $h4_font_style_weight[0] ) ) {
                $h4_font_weight = $h4_font_style_weight[0];
            } else {
                $h4_font_weight = 700;
            }
        }
        $output_css .= "h4 {
            font-family: $h4_font_family;
            font-style: $h4_font_style;
            font-size: $h4_font_size;
            font-weight: $h4_font_weight;
            text-decoration: $h4_text_decoration;
            text-transform: $h4_text_transform;
            line-height: $h4_line_height;
            color: $h4_color;
        }\n";

        /**
         * H5 typography
         */
        $h5_font_family         = get_theme_mod( 'h5_font_family', 'Roboto' );
        $h5_font_style          = get_theme_mod( 'h5_font_style', '700' );
        $h5_text_decoration     = get_theme_mod( 'h5_text_decoration', 'none' );
        $h5_text_transform      = get_theme_mod( 'h5_text_transform', 'none' );
        $h5_font_size           = get_theme_mod( 'h5_font_size', '18' ) . 'px';
        $h5_line_height         = get_theme_mod( 'h5_line_height', '1.3' );
        $h5_color               = get_theme_mod( 'h5_color', '#3d3d3d' );

        if ( !empty( $h5_font_style ) ) {
            $h5_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $h5_font_style );
            if ( isset( $h5_font_style_weight[1] ) ) {
                $h5_font_style = $h5_font_style_weight[1];
            } else {
                $h5_font_style = 'normal';
            }

            if ( isset( $h5_font_style_weight[0] ) ) {
                $h5_font_weight = $h5_font_style_weight[0];
            } else {
                $h5_font_weight = 700;
            }
        }
        $output_css .= "h5 {
            font-family: $h5_font_family;
            font-style: $h5_font_style;
            font-size: $h5_font_size;
            font-weight: $h5_font_weight;
            text-decoration: $h5_text_decoration;
            text-transform: $h5_text_transform;
            line-height: $h5_line_height;
            color: $h5_color;
        }\n";

        /**
         * H6 typography
         */
        $h6_font_family         = get_theme_mod( 'h6_font_family', 'Roboto' );
        $h6_font_style          = get_theme_mod( 'h6_font_style', '700' );
        $h6_text_decoration     = get_theme_mod( 'h6_text_decoration', 'none' );
        $h6_text_transform      = get_theme_mod( 'h6_text_transform', 'none' );
        $h6_font_size           = get_theme_mod( 'h6_font_size', '16' ) . 'px';
        $h6_line_height         = get_theme_mod( 'h6_line_height', '1.3' );
        $h6_color               = get_theme_mod( 'h6_color', '#3d3d3d' );

        if ( !empty( $h6_font_style ) ) {
            $h6_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $h6_font_style );
            if ( isset( $h6_font_style_weight[1] ) ) {
                $h6_font_style = $h6_font_style_weight[1];
            } else {
                $h6_font_style = 'normal';
            }

            if ( isset( $h6_font_style_weight[0] ) ) {
                $h6_font_weight = $h6_font_style_weight[0];
            } else {
                $h6_font_weight = 700;
            }
        }
        $output_css .= "h6 {
            font-family: $h6_font_family;
            font-style: $h6_font_style;
            font-size: $h6_font_size;
            font-weight: $h6_font_weight;
            text-decoration: $h6_text_decoration;
            text-transform: $h6_text_transform;
            line-height: $h6_line_height;
            color: $h6_color;
        }\n";

        /**
         * Menu typography
         */
        $menu_font_family       = get_theme_mod( 'menu_font_family', 'Roboto' );
        $menu_font_style        = get_theme_mod( 'menu_font_style', '300' );
        $menu_text_decoration   = get_theme_mod( 'menu_text_decoration', 'none' );
        $menu_text_transform    = get_theme_mod( 'menu_text_transform', 'none' );
        $menu_font_size         = get_theme_mod( 'menu_font_size', '14' ) . 'px';
        $menu_line_height       = get_theme_mod( 'menu_line_height', '40' ) . 'px';
        $menu_color             = get_theme_mod( 'menu_color', '#ffffff' );
        $menu_bg_color          = get_theme_mod( 'menu_bg_color', '#f54337' );
        $menu_bg_dark_color     = news_portal_hover_color( $menu_bg_color, '-50' );

        if ( !empty( $menu_font_style ) ) {
            $menu_font_style_weight = preg_split( '/(?<=[0-9])(?=[a-z]+)/i', $menu_font_style );
            if ( isset( $menu_font_style_weight[1] ) ) {
                $menu_font_style = $menu_font_style_weight[1];
            } else {
                $menu_font_style = 'normal';
            }

            if ( isset( $menu_font_style_weight[0] ) ) {
                $menu_font_weight = $menu_font_style_weight[0];
            } else {
                $menu_font_weight = 400;
            }
        }
        $output_css .= "#site-navigation ul li a{
            font-family: $menu_font_family;
            font-style: $menu_font_style;
            font-size: $menu_font_size;
            font-weight: $menu_font_weight;
            text-decoration: $menu_text_decoration;
            text-transform: $menu_text_transform;
            line-height: $menu_line_height;
            color: $menu_color;
        }\n";
                        
        $output_css .= ".np-header-menu-wrapper,.np-header-menu-wrapper::before, .np-header-menu-wrapper::after,#site-navigation ul.sub-menu,#site-navigation ul.children,#masthead.layout2 .np-header-menu-block-wrap{ background-color: ". esc_attr( $menu_bg_color ) ."}\n";
        
        $output_css .= ".np-header-menu-block-wrap::before, .np-header-menu-block-wrap::after{ border-right-color: ". esc_attr( $menu_bg_dark_color ) ."}\n";
        
        $output_css .= ".np-header-search-wrapper .search-main,.np-home-icon a,#masthead .menu-toggle{ color: ". esc_attr( $menu_color ) ."}\n";
        
        $output_css .= "@media (max-width: 768px) { #site-navigation,.main-small-navigation li.current-menu-item > .sub-toggle i { background: ". esc_attr( $menu_bg_color ) ." !important } }\n";
        
        $refine_output_css = news_portal_css_strip_whitespace( $output_css );

        wp_add_inline_style( 'news-portal-pro-style', $refine_output_css );
    }
    
endif;