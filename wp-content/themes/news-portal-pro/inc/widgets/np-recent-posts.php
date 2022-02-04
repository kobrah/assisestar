<?php
/**
 * NP: Recent Posts
 *
 * Widget to display latest posts with thumbnail.
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

class News_Portal_Recent_Posts extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'news_portal_recent_posts',
            'description' => __( 'A widget shows recent posts with thumbnail.', 'news-portal-pro' )
        );
        parent::__construct( 'news_portal_recent_posts', __( 'NP: Recent Posts', 'news-portal-pro' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'widget_title' => array(
                'news_portal_widgets_name'         => 'widget_title',
                'news_portal_widgets_title'        => __( 'Widget title', 'news-portal-pro' ),
                'news_portal_widgets_field_type'   => 'text'
            ),

            'np_posts_count' => array(
                'news_portal_widgets_name'         => 'np_posts_count',
                'news_portal_widgets_title'        => __( 'No. of Posts', 'news-portal-pro' ),
                'news_portal_widgets_default'      => '5',
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

        $np_widget_title  = empty( $instance['widget_title'] ) ? '' : $instance['widget_title'];
        $np_posts_count   = empty( $instance['np_posts_count'] ) ? '' : $instance['np_posts_count'];

        $np_posts_args = array(
                'posts_per_page' => $np_posts_count
            );
        $np_post_query = new WP_Query( $np_posts_args );

        echo $before_widget;
    ?>
            <div class="np-recent-posts-wrapper">
                <?php
                    if ( !empty( $np_widget_title ) ) {
                        echo $before_title . esc_html( $np_widget_title ) . $after_title;
                    }

                    if ( $np_post_query->have_posts() ) {
                        echo '<ul>';
                        while ( $np_post_query->have_posts() ) {
                            $np_post_query->the_post();
                ?>
                            <li>
                                <div class="np-single-post np-clearfix <?php news_portal_post_format_icon(); ?>">
                                    <div class="np-post-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <figure><?php news_portal_widget_featured_image( 'news-portal-block-thumb' ); ?></figure>
                                        </a>
                                    </div><!-- .np-post-thumb -->
                                    <div class="np-post-content">
                                        <h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="np-post-meta">
                                            <?php news_portal_posted_on(); ?>
                                            <?php news_portal_post_comment(); ?>
                                            <?php do_action( 'np_widget_post_review' ); ?>
                                        </div>
                                    </div><!-- .np-post-content -->
                                </div><!-- .np-single-post -->
                            </li>
                <?php
                        }
                        echo '</ul>';
                    }
                    wp_reset_postdata();
                ?>
            </div><!-- .np-recent-posts-wrapper -->
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
            $news_portal_widgets_field_value = !empty( $instance[$news_portal_widgets_name] ) ? wp_kses_post( $instance[$news_portal_widgets_name] ) : '';
            news_portal_widgets_show_widget_field( $this, $widget_field, $news_portal_widgets_field_value );
        }
    }
}