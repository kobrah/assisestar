<?php
/**
 * Define customizer custom classes
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	class News_Portal_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 1.0.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select Category &mdash;', 'news-portal-pro' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span><span class="description customize-control-description">%s</span> %s </label>',
                $this->label,
                $this->description,
                $dropdown
            );
        }
    } // end News_Portal_Customize_Category_Control

    /**
     * Slider Custom Control
     *
     * @author Anthony Hortin <http://maddisondesigns.com>
     * @license http://www.gnu.org/licenses/gpl-2.0.html
     * @link https://github.com/maddisondesigns
     */
    class News_Portal_Slider_Custom_Control extends WP_Customize_Control {
        /**
         * The type of control being rendered
         */
        public $type = 'slider_control';
        /**
         * Enqueue our scripts and styles
         */
        /*public function enqueue() {
            wp_enqueue_script( 'skyrocket-custom-controls-js', $this->get_skyrocket_resource_url() . 'js/customizer.js', array( 'jquery', 'jquery-ui-core' ), '1.0', true );
            wp_enqueue_style( 'skyrocket-custom-controls-css', $this->get_skyrocket_resource_url() . 'css/customizer.css', array(), '1.0', 'all' );
        }*/
        /**
         * Render the control in the customizer
         */
        public function render_content() {
        ?>
            <div class="slider-custom-control">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
                <div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
            </div>
        <?php
        }
    }

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Switch button customize control.
     *
     * @since 1.0.3
     * @access public
     */
    class News_Portal_Customize_Switch_Control extends WP_Customize_Control {

        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'switch';

        /**
         * Displays the control content.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function render_content() {
    ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
                <div class="switch_options">
                    <?php 
                        $show_choices = $this->choices;
                        foreach ( $show_choices as $key => $value ) {
                            echo '<span class="switch_part '.esc_attr( $key ).'" data-switch="'.esc_attr( $key ).'">'. esc_html( $value ).'</span>';
                        }
                    ?>
                    <input type="hidden" id="mt_switch_option" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
                </div>
            </label>
    <?php
        }
    } // end News_Portal_Customize_Switch_Control

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Radio image customize control.
     *
     * @since  1.0.0
     * @access public
     */
    class News_Portal_Customize_Control_Radio_Image extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'radio-image';

        /**
         * Loads the jQuery UI Button script and custom scripts/styles.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-button' );
        }

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();

            // We need to make sure we have the correct image URL.
            foreach ( $this->choices as $value => $args )
                $this->choices[ $value ]['url'] = esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) );

            $this->json['choices'] = $this->choices;
            $this->json['link']    = $this->get_link();
            $this->json['value']   = $this->value();
            $this->json['id']      = $this->id;
        }


        /**
         * Underscore JS template to handle the control's output.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */

        public function content_template() { ?>
            <# if ( data.label ) { #>
                <span class="customize-control-title">{{ data.label }}</span>
            <# } #>

            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>

            <div class="buttonset">

                <# for ( key in data.choices ) { #>

                    <input type="radio" value="{{ key }}" name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}-{{ key }}" {{{ data.link }}} <# if ( key === data.value ) { #> checked="checked" <# } #> /> 

                    <label for="{{ data.id }}-{{ key }}">
                        <span class="screen-reader-text">{{ data.choices[ key ]['label'] }}</span>
                        <img src="{{ data.choices[ key ]['url'] }}" title="{{ data.choices[ key ]['label'] }}" alt="{{ data.choices[ key ]['label'] }}" />
                    </label>
                <# } #>

            </div><!-- .buttonset -->
        <?php }
    } // end News_Portal_Customize_Control_Radio_Image
/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Customize controls for repeater field
     *
     * @since 1.0.0
     */
    class News_Portal_Repeater_Controler extends WP_Customize_Control {
        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'repeater';

        public $news_portal_box_label = '';

        public $news_portal_box_add_control = '';

        /**
         * The fields that each container row will contain.
         *
         * @access public
         * @var array
         */
        public $fields = array();

        /**
         * Repeater drag and drop controller
         *
         * @since  1.0.0
         */
        public function __construct( $manager, $id, $args = array(), $fields = array() ) {
            $this->fields = $fields;
            $this->news_portal_box_label = $args['news_portal_box_label'] ;
            $this->news_portal_box_add_control = $args['news_portal_box_add_control'];
            parent::__construct( $manager, $id, $args );
        }

        public function render_content() {

            $values = json_decode( $this->value() );
        ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

            <?php if ( $this->description ){ ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post( $this->description ); ?>
                </span>
            <?php } ?>

            <ul class="np-repeater-field-control-wrap">
                <?php $this->news_portal_get_fields(); ?>
            </ul>

            <input type="hidden" <?php esc_attr( $this->link() ); ?> class="np-repeater-collector" value="<?php echo esc_attr( $this->value() ); ?>" />
            <button type="button" class="button np-repeater-add-control-field"><?php echo esc_html( $this->news_portal_box_add_control ); ?></button>
    <?php
        }

        private function news_portal_get_fields(){
            $fields = $this->fields;
            $values = json_decode( $this->value() );

            if ( is_array( $values ) ){
            foreach( $values as $value ){
        ?>
            <li class="np-repeater-field-control">
            <h3 class="np-repeater-field-title"><?php echo esc_html( $this->news_portal_box_label ); ?></h3>
            
            <div class="np-repeater-fields">
            <?php
                foreach ( $fields as $key => $field ) {
                $class = isset( $field['class'] ) ? $field['class'] : '';
            ?>
                <div class="np-repeater-field np-repeater-type-<?php echo esc_attr( $field['type'] ).' '. esc_attr( $class ); ?>">

                <?php 
                    $label = isset( $field['label'] ) ? $field['label'] : '';
                    $description = isset( $field['description'] ) ? $field['description'] : '';
                    if ( $field['type'] != 'checkbox' ) { 
                ?>
                        <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                        <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
                <?php 
                    }

                    $new_value = isset( $value->$key ) ? $value->$key : '';
                    $default = isset( $field['default'] ) ? $field['default'] : '';

                    switch ( $field['type'] ) {
                        case 'text':
                            echo '<input data-default="'.esc_attr( $default ).'" data-name="'.esc_attr( $key ).'" type="text" value="'.esc_attr( $new_value ).'"/>';
                            break;

                        case 'url':
                            echo '<input data-default="'.esc_attr( $default ).'" data-name="'.esc_attr( $key ).'" type="text" value="'.esc_url( $new_value ).'"/>';
                            break;

                        case 'textarea':
                            echo '<textarea data-default="'.esc_attr( $default ).'"  data-name="'.esc_attr( $key ).'">'.esc_textarea( $new_value ).'</textarea>';
                            break;

                        case 'social_icon':
                            echo '<div class="np-repeater-selected-icon">';
                            echo '<i class="'.esc_attr( $new_value ).'"></i>';
                            echo '<span><i class="fa fa-angle-down"></i></span>';
                            echo '</div>';
                            echo '<ul class="np-repeater-icon-list np-clearfix">';
                            $news_portal_font_awesome_social_icon_array = news_portal_font_awesome_social_icon_array();
                            foreach ( $news_portal_font_awesome_social_icon_array as $news_portal_font_awesome_icon ) {
                                $icon_class = $new_value == $news_portal_font_awesome_icon ? 'icon-active' : '';
                                echo '<li class='.esc_attr( $icon_class ).'><i class="'.esc_attr( $news_portal_font_awesome_icon ).'"></i></li>';
                            }
                            echo '</ul>';
                            echo '<input data-default="'.esc_attr( $default ).'" type="hidden" value="'.esc_attr( $new_value ).'" data-name="'.esc_attr($key).'"/>';
                            break;

                        default:
                            break;
                    }
                ?>
                </div>
                <?php
                } ?>

                <div class="np-clearfix np-repeater-footer">
                    <div class="alignright">
                    <a class="np-repeater-field-remove" href="#remove"><?php esc_html_e( 'Delete', 'news-portal-pro' ) ?></a> |
                    <a class="np-repeater-field-close" href="#close"><?php esc_html_e( 'Close', 'news-portal-pro' ) ?></a>
                    </div>
                </div>
            </div>
            </li>
            <?php   
            }
            }
        }
    } // end News_Portal_Repeater_Controler
/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Custom class for typography 
     */
    class News_Portal_Typography_Customizer_Control extends WP_Customize_Control {
    
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'typography';

        /**
         * Array 
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $l10n = array();

        /**
         * Set up our control.
         *
         * @since  1.0.0
         * @access public
         * @param  object  $manager
         * @param  string  $id
         * @param  array   $args
         * @return void
         */
        public function __construct( $manager, $id, $args = array() ) {

            // Let the parent class do its thing.
            parent::__construct( $manager, $id, $args );

            // Make sure we have labels.
            $this->l10n = wp_parse_args(
                $this->l10n,
                array(
                    'family'      => esc_html__( 'Font Family', 'news-portal-pro' ),
                    'size'        => esc_html__( 'Font Size',   'news-portal-pro' ),
                    'style'      => esc_html__( 'Font Weight/Style', 'news-portal-pro' ),
                    'line_height' => esc_html__( 'Line Height', 'news-portal-pro' ),
                    'px_line_height' => esc_html__( 'Line Height', 'news-portal-pro' ),
                    'text_decoration' => esc_html__( 'Text Decoration', 'news-portal-pro' ),
                    'text_transform' => esc_html__( 'Text Transform', 'news-portal-pro' ),
                    'typocolor' => esc_html__( 'Font Color', 'news-portal-pro' ),
                    'bg_color' => esc_html__( 'Background Color', 'news-portal-pro' )
                )
            );
        }

        /**
         * Enqueue scripts/styles.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_style( 'wp-color-picker' );
        }

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();

            // Loop through each of the settings and set up the data for it.
            foreach ( $this->settings as $setting_key => $setting_id ) {
                $this->json[ $setting_key ] = array(
                    'link'  => $this->get_link( $setting_key ),
                    'value' => $this->value( $setting_key ),
                    'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
                );

                if ( 'family' === $setting_key )
                    $this->json[ $setting_key ]['choices'] = $this->get_font_families();

                elseif ( 'style' === $setting_key )
                    $this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

                elseif ( 'text_transform' === $setting_key )
                    $this->json[ $setting_key ]['choices'] = $this->get_text_transform_choices();

                elseif ( 'text_decoration' === $setting_key )
                    $this->json[ $setting_key ]['choices'] = $this->get_text_decoration_choices();
            }
        }

        /**
         * Underscore JS template to handle the control's output.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function content_template() {
        ?>

        <# if ( data.label ) { #>
            <span class="customize-control-title">{{ data.label }}</span>
        <# } #>

        <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>

        <ul>

        <# if ( data.family && data.family.choices ) { #>

            <li class="typography-font-family">

            <# if ( data.family.label ) { #>
                <span class="customize-control-title">{{ data.family.label }}</span>
            <# } #>

                <select {{{ data.family.link }}} id="{{ data.section }}" class="typography_face">

                <# _.each( data.family.choices, function( label, choice ) { #>
                    <option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                <# } ) #>

                </select>

            </li>
        <#  } #>

        <# if ( data.style && data.style.choices ) { #>

            <li class="typography-font-style">

            <# if ( data.style.label ) { #>
                <span class="customize-control-title">{{ data.style.label }}</span>
            <# } #>

                <select {{{ data.style.link }}}>

                <# _.each( data.style.choices, function( label, choice ) { #>
                    <option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                <# } ) #>

                </select>
            </li>
        <#  } #>

        <# if ( data.text_transform && data.text_transform.choices ) { #>

            <li class="typography-text-transform">

            <# if ( data.text_transform.label ) { #>
                <span class="customize-control-title">{{ data.text_transform.label }}</span>
            <# } #>

                <select {{{ data.text_transform.link }}} id="p_typography_text_transform" class="typography_text_transform">

                    <# _.each( data.text_transform.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.text_transform.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                    <# } ) #>

                </select>
            </li>
        <# } #>

        <# if ( data.text_decoration && data.text_decoration.choices ) { #>

            <li class="typography-text-decoration">

            <# if ( data.text_decoration.label ) { #>
                <span class="customize-control-title">{{ data.text_decoration.label }}</span>
            <# } #>

                <select {{{ data.text_decoration.link }}} id="p_typography_text_decoration" class="typography_text_decoration">

                    <# _.each( data.text_decoration.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.text_decoration.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                    <# } ) #>

                </select>
            </li>
        <#  } #>

        <# if ( data.size ) { #>

            <li class="typography-font-size">

            <# if ( data.size.label ) { #>
                <span class="customize-control-title">{{ data.size.label }} </span>
            <# } #>

                <span class="slider-value-size"></span>px
                <input type="hidden" {{{ data.size.link }}} value="{{ data.size.value }}" />
                <div class="slider-range-size" value="{{ data.size.value }}" ></div>

            </li>
        <#  } #>

        <# if ( data.line_height ) { #>

            <li class="typography-line-height">

            <# if ( data.line_height.label ) { #>
                <span class="customize-control-title">{{ data.line_height.label }}</span>
            <# } #>

                <span class="slider-value-line-height"></span>
                <input type="hidden" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />
                <div class="slider-range-line-height" value="{{ data.line_height.value }}"></div>
          
            </li>
        <#  } #>

        <# if ( data.px_line_height ) { #>

            <li class="typography-line-height">

            <# if ( data.px_line_height.label ) { #>
                <span class="customize-control-title">{{ data.px_line_height.label }}</span>
            <# } #>

                <span class="slider-value-size"></span>px
                <input type="hidden" {{{ data.px_line_height.link }}} value="{{ data.px_line_height.value }}" />
                <div class="slider-range-size" value="{{ data.px_line_height.value }}" ></div>
          
            </li>
        <#  } #>

        <# if ( data.typocolor ) { #>

            <li class="typography-color">
                <# if ( data.typocolor.label ) { #>
                    <span class="customize-control-title">{{{ data.typocolor.label }}}</span>
                <# } #>

                    <div class="customize-control-content">
                        <input class="color-picker-hex" type="text" maxlength="7" placeholder="<?php esc_attr_e( 'Hex Value', 'news-portal-pro' ); ?>" {{{ data.typocolor.link }}} value="{{ data.typocolor.value }}"  />
                    </div>
            </li>
        <#  } #>

        <# if ( data.bg_color ) { #>

            <li class="typography-color">
                <# if ( data.bg_color.label ) { #>
                    <span class="customize-control-title">{{{ data.bg_color.label }}}</span>
                <# } #>

                    <div class="customize-control-content">
                        <input class="color-picker-hex" type="text" maxlength="7" placeholder="<?php esc_attr_e( 'Hex Value', 'news-portal-pro' ); ?>" {{{ data.bg_color.link }}} value="{{ data.bg_color.value }}"  />
                    </div>
            </li>
        <#  } #>

        </ul>
        <?php }

        /**
         * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
         *
         * @todo Integrate with Google fonts.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        public function get_fonts() { return array(); }

        /**
         * Returns the available font families.
         *
         * @todo Pull families from `get_fonts()`.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        function get_font_families() {
            
            $google_api_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCxgjQ1TrWRIvQ3ADTZS1d_cXgoKRYKd70&sort=alpha';
            $google_api_url = wp_remote_get( $google_api_url, array( 'sslverify' => false, 'timeout' => 120 ) );
            $response       = wp_remote_retrieve_body( $google_api_url );
            $data           = json_decode( $response, true );

            foreach ( $data['items'] as $datas ) {
                $font_array[] = array(
                    'family' =>  $datas['family'],
                    'variants' => $datas['variants']
                );
            }

            foreach ( $font_array as $key => $value ) {
    
                unset( $variants );
                foreach ( $value['variants'] as $nkey => $nvalue ) {
                    $variants[$nvalue] = news_portal_convert_font_variants( $nvalue );
                }

                $new_font_array[] = array(
                   'family' =>  $value['family'],
                   'variants' => $variants
                );
            }

            $news_portal_google_font = get_option( 'news_portal_google_font', '' );
            if ( empty( $news_portal_google_font ) ) {
                update_option( 'news_portal_google_font', $new_font_array );
                $news_portal_google_font = get_option( 'news_portal_google_font', '' );
            }

            foreach ( $news_portal_google_font as $key => $value ) {
                $mt_fonts[$value['family']] =  $value['family'] ;
            }

            return $mt_fonts;
        }

        /**
         * Returns the available font weights.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        public function get_font_weight_choices() {
            if ( $this->settings['family']->id ){
                $news_portal_font_list = get_option( 'news_portal_google_font', '' );

                $font_family_id = $this->settings['family']->id;
                $default_font_family = $this->settings['family']->default;
                $get_font_family = get_theme_mod( $font_family_id, $default_font_family );

                $font_array = news_portal_search_key( $news_portal_font_list, 'family', $get_font_family );

                $variants_array = $font_array['0']['variants'] ;

                if ( is_array( $variants_array ) ){
                    $options_array = array();
                    foreach ( $variants_array  as $key => $variants ) {
                        $options_array[$key] = $variants;
                    }
                    return $options_array;
                }else{
                    return array(
                      '400' => esc_html__( 'Normal', 'news-portal-pro' ),
                      '700' => esc_html__( 'Bold', 'news-portal-pro' ),
                    );
                }
            } else {
                return array(
                  '400' => esc_html__( 'Normal', 'news-portal-pro' ),
                  '700' => esc_html__( 'Bold', 'news-portal-pro' ),
                );
            }
        }

        /**
         * Returns the available font text decoration.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        public function get_text_decoration_choices() {
            return array(
                'none'          => esc_html__( 'None', 'news-portal-pro' ),
                'underline'     => esc_html__( 'Underline', 'news-portal-pro' ),
                'line-through'  => esc_html__( 'Line-through', 'news-portal-pro' ),
                'overline'      => esc_html__( 'Over-line', 'news-portal-pro' )
            );
        }

        /**
         * Returns the available font text transform.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        public function get_text_transform_choices() {
            return array(
                'none'       => esc_html__( 'None', 'news-portal-pro' ),
                'uppercase'  => esc_html__( 'Uppercase', 'news-portal-pro' ),
                'lowercase'  => esc_html__( 'Lowercase', 'news-portal-pro' ),
                'capitalize' => esc_html__( 'Capitalize', 'news-portal-pro' )
            );
        }
    }// end News_Portal_Typography_Customizer_Control

} //end WP_Customize_Control