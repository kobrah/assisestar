<?php
/**
 * NP: Featured Slider
 *
 * Widget to display posts from selected categories in slider with featured section.
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

class News_Portal_Featured_Slider extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'news_portal_featured_slider',
            'description' => __( 'Displays posts from selected categories in slider.', 'news-portal-pro' )
        );
        parent::__construct( 'news_portal_featured_slider', __( 'NP: Featured Slider', 'news-portal-pro' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $np_categories_lists = news_portal_categories_lists();

        $fields = array(

            'slider_cat_ids' => array(
                'news_portal_widgets_name'         => 'slider_cat_ids',
                'news_portal_widgets_title'        => __( 'Slider Categories', 'news-portal-pro' ),
                'news_portal_widgets_field_type'   => 'multicheckboxes',
                'news_portal_widgets_field_options' => $np_categories_lists
            ),

            'featured_cat_ids' => array(
                'news_portal_widgets_name'         => 'featured_cat_ids',
                'news_portal_widgets_title'        => __( 'Featured Categories', 'news-portal-pro' ),
                'news_portal_widgets_field_type'   => 'multicheckboxes',
                'news_portal_widgets_field_options' => $np_categories_lists
            ),

            'section_layout' => array(
                'news_portal_widgets_name'         => 'section_layout',
                'news_portal_widgets_title'        => __( 'Featured Slider Layouts', 'news-portal-pro' ),
                'news_portal_widgets_default'      => 'default',
                'news_portal_widgets_field_type'   => 'selector',
                'news_portal_widgets_field_options' => array(
                    'default' => esc_url( get_template_directory_uri() . '/assets/images/featured-slider-1.png' ),
                    'layout1' => esc_url( get_template_directory_uri() . '/assets/images/featured-slider-2.png' ),
                    'layout2' => esc_url( get_template_directory_uri() . '/assets/images/featured-slider-3.png' )
                )
            ),

            'checkbox_group_title' => array(
                'news_portal_widgets_name' => 'checkbox_group_title',
                'news_portal_widgets_title' => __( 'Slider Settings', 'news-portal-pro' ),
                'news_portal_widgets_field_type' => 'np_option_title'
            ),

            'cats_list_option' => array(
                'news_portal_widgets_name' => 'cats_list_option',
                'news_portal_widgets_title' => __( 'Categories Lists', 'news-portal-pro' ),
                'news_portal_widgets_default'    => 'show',
                'news_portal_widgets_field_type' => 'switch',
                'news_portal_widgets_field_options' => array(
                        'show' => __( 'Show', 'news-portal-pro' ),
                        'hide' => __( 'Hide', 'news-portal-pro' )
                    )
            ),

            'is_slide_auto' => array(
                'news_portal_widgets_name' => 'is_slide_auto',
                'news_portal_widgets_title' => __( 'Slide Auto Play', 'news-portal-pro' ),
                'news_portal_widgets_field_type' => 'checkbox'
            ),

            'is_slide_pager' => array(
                'news_portal_widgets_name' => 'is_slide_pager',
                'news_portal_widgets_title' => __( 'Display Slider Pager', 'news-portal-pro' ),
                'news_portal_widgets_field_type' => 'checkbox'
            ),

            'is_slide_control' => array(
                'news_portal_widgets_name' => 'is_slide_control',
                'news_portal_widgets_title' => __( 'Display Slider Control', 'news-portal-pro' ),
                'news_portal_widgets_field_type' => 'checkbox'
            ),

            'slide_pause' => array(
                'news_portal_widgets_name' => 'slide_pause',
                'news_portal_widgets_title' => __( 'Slide pause time', 'news-portal-pro' ),
                'news_portal_widgets_default'       => 3000,
                'news_portal_widgets_min_value'     => 500,
                'news_portal_widgets_max_value'     => 10000,
                'news_portal_widgets_step_value'    => 100,
                'news_portal_widgets_field_type'    => 'range'
            ),

            'slide_speed' => array(
                'news_portal_widgets_name' => 'slide_speed',
                'news_portal_widgets_title' => __( 'Slide speed time', 'news-portal-pro' ),
                'news_portal_widgets_default'       => 600,
                'news_portal_widgets_min_value'     => 100,
                'news_portal_widgets_max_value'     => 10000,
                'news_portal_widgets_step_value'    => 100,
                'news_portal_widgets_field_type'    => 'range'
            ),

            'slide_count' => array(
                'news_portal_widgets_name' => 'slide_count',
                'news_portal_widgets_title' => __( 'No. of. Slide', 'news-portal-pro' ),
                'news_portal_widgets_default'       => 5,
                'news_portal_widgets_min_value'     => 2,
                'news_portal_widgets_max_value'     => 15,
                'news_portal_widgets_step_value'    => 1,
                'news_portal_widgets_field_type'    => 'range'
            )
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        
        if ( empty( $instance ) ) {
            return ;
        }

        $np_slider_cat_ids   = empty( $instance['slider_cat_ids'] ) ? '' : $instance['slider_cat_ids'];
        $np_featured_cat_ids = empty( $instance['featured_cat_ids'] ) ? '' : $instance['featured_cat_ids'];
        $np_section_layout   = empty( $instance['section_layout'] ) ? 'default' : $instance['section_layout'];
        $cats_list_option    = empty( $instance['cats_list_option'] ) ? 'show' : $instance['cats_list_option'];
        $np_slider_auto      = empty( $instance['is_slide_auto'] ) ? null : $instance['is_slide_auto'];
        $np_slider_pager     = empty( $instance['is_slide_pager'] ) ? null : $instance['is_slide_pager'];
        $np_slider_controls  = empty( $instance['is_slide_control'] ) ? null : $instance['is_slide_control'];
        $np_slide_pause      = empty( $instance['slide_pause'] ) ? 3000 : $instance['slide_pause'];
        $np_slide_speed      = empty( $instance['slide_speed'] ) ? 600 : $instance['slide_speed'];
        $np_slide_count      = empty( $instance['slide_count'] ) ? 5 : $instance['slide_count'];

        if ( $np_slider_auto == 1 ) {
            $slide_auto = 'true';
        } else {
            $slide_auto = 'false';
        }
        
        if ( $np_slider_pager == 1 ) {
            $slide_pager = 'true';
        } else {
            $slide_pager = 'false';
        }

        if ( $np_slider_controls == 1 ) {
            $slide_control = 'true';
        } else {
            $slide_control = 'false';
        }

        echo $before_widget;
    ?>
    	<div class="np-block-wrapper slider-posts np-featured-slider np-clearfix <?php echo 'featured-slider-'. esc_attr( $np_section_layout ); ?>" data-layout=<?php echo esc_attr( $np_section_layout ); ?> data-auto="<?php echo esc_attr( $slide_auto ); ?>" data-control="<?php echo esc_attr( $slide_control ); ?>" data-pager="<?php echo esc_attr( $slide_pager ); ?>" data-speed="<?php echo absint( $np_slide_speed ); ?>" data-pause="<?php echo absint( $np_slide_pause ); ?>">
    		<?php                
                if ( !empty( $np_slider_cat_ids ) ) {
                    $checked_cats = array();
                    foreach ( $np_slider_cat_ids as $cat_key => $cat_value ) {
                        $checked_cats[] = $cat_key;
                    }
                    $get_cats_ids = implode( ",", $checked_cats );
                    $np_slider_args = array(
                        'post_type' => 'post',
                        'cat' => $get_cats_ids,
                        'posts_per_page' => absint( $np_slide_count )
                    );
                } else {
                    $np_slider_args = '';
                }

                switch ( $np_section_layout ) {
                    case 'layout1':
                        news_portal_featured_slider_layout_one( $np_slider_args, $np_featured_cat_ids, $cats_list_option );
                        break;

                    case 'layout2':
                        news_portal_featured_slider_layout_two( $np_slider_args, $np_featured_cat_ids, $cats_list_option );
                        break;
                    
                    default:
                        news_portal_featured_slider_layout_default( $np_slider_args, $np_featured_cat_ids, $cats_list_option );
                        break;
                }
    		?>
    	</div><!--- .np-block-wrapper -->
    <?php
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    news_portal_widgets_updated_field_value()     defined in np-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$news_portal_widgets_name] = news_portal_widgets_updated_field_value( $widget_field, $new_instance[$news_portal_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    news_portal_widgets_show_widget_field()       defined in np-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $news_portal_widgets_field_value = !empty( $instance[$news_portal_widgets_name] ) ? $instance[$news_portal_widgets_name] : '';
            news_portal_widgets_show_widget_field( $this, $widget_field, $news_portal_widgets_field_value );
        }
    }
}