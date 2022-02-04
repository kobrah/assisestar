<?php
/**
 * NP: Carousel
 *
 * Widget show the posts from selected categories in different carousel layouts.
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

class News_Portal_Carousel extends WP_widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'news_portal_carousel',
            'description' => __( 'Displays posts from selected categories in different carousel layouts.', 'news-portal-pro' )
        );
        parent::__construct( 'news_portal_carousel', __( 'NP: Carousel', 'news-portal-pro' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $np_categories_lists = news_portal_categories_lists();
        
        $fields = array(

            'block_title' => array(
                'news_portal_widgets_name'         => 'block_title',
                'news_portal_widgets_title'        => __( 'Block title', 'news-portal-pro' ),
                'news_portal_widgets_description'  => __( 'Enter your block title. (Optional - Leave blank to hide title.)', 'news-portal-pro' ),
                'news_portal_widgets_field_type'   => 'text'
            ),

            'block_cat_ids' => array(
                'news_portal_widgets_name'         => 'block_cat_ids',
                'news_portal_widgets_title'        => __( 'Block Categories', 'news-portal-pro' ),
                'news_portal_widgets_field_type'   => 'multicheckboxes',
                'news_portal_widgets_field_options' => $np_categories_lists
            ),

            'block_layout' => array(
                'news_portal_widgets_name'         => 'block_layout',
                'news_portal_widgets_title'        => __( 'Block Layouts', 'news-portal-pro' ),
                'news_portal_widgets_default'      => 'layout1',
                'news_portal_widgets_field_type'   => 'selector',
                'news_portal_widgets_field_options' => array(
                    'layout1' => esc_url( get_template_directory_uri() . '/assets/images/carousel-1.png' ),
                    'layout2' => esc_url( get_template_directory_uri() . '/assets/images/full-width-2.png' ),
                    'layout3' => esc_url( get_template_directory_uri() . '/assets/images/featured-post-1.png' )
                )
            ),

            'checkbox_group_title' => array(
                'news_portal_widgets_name' => 'checkbox_group_title',
                'news_portal_widgets_title' => __( 'Block Posts Settings', 'news-portal-pro' ),
                'news_portal_widgets_field_type' => 'np_option_title'
            ),

            'is_slide_auto' => array(
                'news_portal_widgets_name' => 'is_slide_auto',
                'news_portal_widgets_title' => __( 'Slide Auto Play', 'news-portal-pro' ),
                'news_portal_widgets_field_type' => 'checkbox'
            ),

            'np_posts_item' => array(
                'news_portal_widgets_name'         => 'np_posts_item',
                'news_portal_widgets_title'        => __( 'No. of Items', 'news-portal-pro' ),
                'news_portal_widgets_default'      => '4',
                'news_portal_widgets_field_type'   => 'number'
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

            'np_posts_count' => array(
                'news_portal_widgets_name'         => 'np_posts_count',
                'news_portal_widgets_title'        => __( 'No. of Posts', 'news-portal-pro' ),
                'news_portal_widgets_default'      => '8',
                'news_portal_widgets_field_type'   => 'number'
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

        $np_block_title    = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $np_block_cat_ids  = empty( $instance['block_cat_ids'] ) ? '' : $instance['block_cat_ids'];
        $np_block_layout   = empty( $instance['block_layout'] ) ? 'layout1' : $instance['block_layout'];

        $np_slide_auto    = empty( $instance['is_slide_auto'] ) ? null : $instance['is_slide_auto'];
        $np_posts_item     = empty( $instance['np_posts_item'] ) ? 4 : $instance['np_posts_item'];
        $cats_list_option  = empty( $instance['cats_list_option'] ) ? 'show' : $instance['cats_list_option'];
        $np_posts_count    = empty( $instance['np_posts_count'] ) ? 8 : $instance['np_posts_count'];
        
        if ( ! empty( $np_block_cat_ids ) ) {
            $checked_cats = array();
            foreach( $np_block_cat_ids as $cat_key => $cat_value ){
                $checked_cats[] = $cat_key;
            }
        } else {
            return;
        }
        $np_get_cats_ids = implode( ",", $checked_cats );
        $carousel_args = array(
            'cat' => $np_get_cats_ids,
            'posts_per_page' => absint( $np_posts_count ),
        );

        echo $before_widget;
    ?>
        <div class="np-block-wrapper carousel-posts np-clearfix <?php echo esc_attr( $np_block_layout ); ?>" data-auto="<?php echo esc_attr( $np_slide_auto ); ?>" data-items="<?php echo absint( $np_posts_item ); ?>">
            <div class="np-block-title-nav-wrap">
                <?php 
                    if ( !empty( $np_block_title ) ) {
                        echo $before_title . esc_html( $np_block_title ) . $after_title;
                    }
                ?>
                <div class="carousel-nav-action">
                    <div class="np-navPrev carousel-controls"><i class="fa fa-angle-left"></i></div>
                    <div class="np-navNext carousel-controls"><i class="fa fa-angle-right"></i></div>
                </div>
            </div> <!-- np-block-title-nav-wrap -->
            <div class="np-block-posts-wrapper">
                <?php
                    switch ( $np_block_layout ) {
                        case 'layout2':
                            news_portal_second_carousel_section( $carousel_args, $cats_list_option );
                            break;

                        case 'layout3':
                            news_portal_third_carousel_section( $carousel_args, $cats_list_option );
                            break;
                        
                        default:
                            news_portal_default_carousel_section( $carousel_args, $cats_list_option );
                            break;
                    }
                ?>
            </div><!-- .np-block-posts-wrapper -->
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