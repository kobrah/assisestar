<?php
/**
 * Custom hooks functions are define.
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Function for display preloader
 *
 * @since 1.0.0
 */
add_action( 'news_portal_before_page', 'news_portal_preloader', 5 );

if ( ! function_exists( 'news_portal_preloader' ) ) :

    function news_portal_preloader() {
        $np_preloader_options = get_theme_mod( 'site_preloader_option', 'show' );
        if ( $np_preloader_options == 'hide' ) {
            return;
        }
        $np_preloader_layout = get_theme_mod( 'site_preloader_layout', 'three_balls' );
?>
        <div id="preloader-background">
            <div class="preloader-wrapper">
                <?php if ( $np_preloader_layout == 'three_balls' ) { ?>
                    <div class="multiple1">
                        <div class="ball1"></div>
                        <div class="ball2"></div>
                        <div class="ball3"></div>
                    </div>
                <?php } elseif ( $np_preloader_layout == 'rectangles' ) { ?>
                    <div class="mult2rect mult2rect1"></div>
                    <div class="mult2rect mult2rect2"></div>
                    <div class="mult2rect mult2rect3"></div>
                    <div class="mult2rect mult2rect4"></div>
                    <div class="mult2rect mult2rect5"></div>
                <?php } elseif ( $np_preloader_layout == 'steps' ) { ?>
                    <div class="single1">
                       <div class="single1ball"></div>
                    </div>
                <?php } elseif ( $np_preloader_layout == 'spinning_border' ) { ?>
                    <div class="single4"></div>
                <?php } elseif ( $np_preloader_layout == 'single_bleep' ) { ?>
                    <div class="single6"></div>
                <?php } elseif ( $np_preloader_layout == 'square' ) { ?>
                    <div class="single5"></div>
                <?php } elseif ( $np_preloader_layout == 'hollow_circle' ) { ?>
                    <div class="single8"></div>
                <?php } elseif ( $np_preloader_layout == 'knight_rider' ) { ?>
                    <div class="single9"></div>
                <?php } else { ?>
                    <div class="multiple1">
                        <div class="ball1"></div>
                        <div class="ball2"></div>
                        <div class="ball3"></div>
                    </div>
                <?php } ?>
            </div>
        </div><!-- #preloader-background -->
<?php
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Related Posts start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_related_posts_start' ) ) :

	function np_related_posts_start() {
		echo '<div class="np-related-section-wrapper">';
	}

endif;

/**
 * Related Posts section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_related_posts_section' ) ) :

	function np_related_posts_section() {
		$np_related_option = get_theme_mod( 'np_related_posts_option', 'show' );
		if ( $np_related_option == 'hide' ) {
			return;
		}
		$np_related_title = get_theme_mod( 'np_related_posts_title', __( 'Related Posts', 'news-portal-pro' ) );
		if ( !empty( $np_related_title ) ) {
			echo '<h2 class="np-related-title np-clearfix">'. esc_html( $np_related_title ) .'</h2>';
		}
		global $post;
        if ( empty( $post ) ) {
            $post_id = '';
        } else {
            $post_id = $post->ID;
        }
        $categories = get_the_category( $post_id );
        if ( $categories ) {
            $category_ids = array();
            foreach( $categories as $category_ed ) {
                $category_ids[] = $category_ed->term_id;
            }
        }
		$np_post_count = apply_filters( 'news_portal_related_posts_count', 3 );
		
		$related_args = array(
				'no_found_rows'            	=> true,
                'update_post_meta_cache'   	=> false,
                'update_post_term_cache'   	=> false,
                'ignore_sticky_posts'      	=> 1,
                'orderby'                  	=> 'rand',
                'post__not_in'             	=> array( $post_id ),
                'category__in'				=> $category_ids,
				'posts_per_page' 		   	=> $np_post_count
			);
		$related_query = new WP_Query( $related_args );
		if ( $related_query->have_posts() ) {
			echo '<div class="np-related-posts-wrap np-clearfix">';
			while( $related_query->have_posts() ) {
				$related_query->the_post();
	?>
				<div class="np-single-post np-clearfix">
					<div class="np-post-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'news-portal-block-medium' ); ?>
						</a>
					</div><!-- .np-post-thumb -->
					<div class="np-post-content">
						<h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="np-post-meta">
							<?php news_portal_posted_on(); ?>
						</div>
					</div><!-- .np-post-content -->
				</div><!-- .np-single-post -->
	<?php
			}
			echo '</div><!-- .np-related-posts-wrap -->';
		}
		wp_reset_postdata();
	}

endif;

/**
 * Related Posts end
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_related_posts_end' ) ) :

	function np_related_posts_end() {
		echo '</div><!-- .np-related-section-wrapper -->';
	}

endif;

/**
 * Managed functions for related posts section
 *
 * @since 1.0.0
 */
add_action( 'news_portal_related_posts', 'np_related_posts_start', 5 );
add_action( 'news_portal_related_posts', 'np_related_posts_section', 10 );
add_action( 'news_portal_related_posts', 'np_related_posts_end', 15 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Get author box start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_author_box_start' ) ) :

	function np_author_box_start() {
		echo '<div class="np-author-box-wrapper np-clearfix">';
	}

endif;

/**
 * Get author avatar for box
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_author_avatar_section' ) ) :

	function np_author_avatar_section() {
		global $post;
		$author_id = $post->post_author;
        $author_avatar = get_avatar( $author_id, '132' );
        $author_extra_img_url = get_the_author_meta( 'user_meta_image', $post->post_author );
?>
		<div class="author-avatar">
            <a class="author-image" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>">
                <?php 
                    if ( !empty( $author_extra_img_url ) ) {
                        $author_img_id = news_portal_get_image_id_from_url( $author_extra_img_url );
                        $author_thumb_img = wp_get_attachment_image_src( $author_img_id, 'thumbnail', true );
                        echo '<img src="'. esc_url( $author_thumb_img[0] ) .'" />';
                    } else {
                        echo $author_avatar;
                    }
                ?>
            </a>
        </div><!-- .author-avatar -->
<?php
	}

endif;

/**
 * Get author avatar for box
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_author_description_section' ) ) :

	function np_author_description_section() {
		global $post;
		$author_nickname = get_the_author_meta( 'display_name' );
		$np_author_website = get_the_author_meta( 'user_url' );
?>
		<div class="author-desc-wrapper">                
            <a class="author-title" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( $author_nickname ); ?></a>
            <div class="author-description"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></div>
            <div class="author-social">
                <?php 
                    global $news_portal_user_social_array;
                    foreach( $news_portal_user_social_array as $icon_id => $icon_name ) {
                        $author_social_link = get_the_author_meta( $icon_id );
                        if ( !empty( $author_social_link ) ) {
                ?>
                            <span class="social-icon-wrap"><a href="<?php echo esc_url( $author_social_link )?>" target="_blank" title="<?php echo esc_attr( $icon_name )?>"><i class="fa fa-<?php echo esc_attr( $icon_id ); ?>"></i></a></span>
                <?php            
                        }
                    }
                ?>
            </div><!-- .author-social -->
            <?php if ( !empty( $np_author_website ) ) { ?>
                <a href="<?php echo esc_url( $np_author_website ); ?>" target="_blank" class="admin-dec"><?php echo esc_url( $np_author_website ); ?></a>
            <?php } ?>
        </div><!-- .author-desc-wrapper-->
<?php
	}

endif;

/**
 * Get author box end
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_author_box_end' ) ) :

	function np_author_box_end() {
		echo '</div><!-- .np-author-box-wrapper -->';
	}

endif;

/**
 * Managed functions for author box section
 *
 * @since 1.0.0
 */
add_action( 'news_portal_author_box', 'np_author_box_start', 5 );
add_action( 'news_portal_author_box', 'np_author_avatar_section', 10 );
add_action( 'news_portal_author_box', 'np_author_description_section', 15 );
add_action( 'news_portal_author_box', 'np_author_box_end', 20 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * review section start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_review_section_start' ) ) :

	function np_review_section_start() {
		echo '<div class="np-post-review-section-wrapper np-clearfix">';
	}

endif;

/**
 * review section title
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_review_section_title' ) ) :

	function np_review_section_title() {
		$post_review_title = get_theme_mod( 'np_posts_review_title', __( 'Review Overview', 'news-portal-pro' ) );
?>
		<div class="section-title"><h4 class="review-title"><?php echo esc_html( $post_review_title ); ?></h4></div>
<?php
	}

endif;

/**
 * review content start
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_review_content_start' ) ) :

	function np_review_content_start() {
		echo '<div class="review-content-wrapper">';
	}

endif;

/**
 * star review section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_star_review_section' ) ) :

	function np_star_review_section() {
		global $post;
		$get_review_option = get_post_meta( $post->ID, 'post_review_option', true );
		$post_review_option_value = empty( $get_review_option ) ? 'no_review' : $get_review_option;
        
		if ( $post_review_option_value == 'percent_review' ) {
			return;
		}
		$star_rating = get_post_meta( $post->ID, 'star_rating', true );
		if ( !empty ( $star_rating ) ) {
            $count = count( $star_rating );
            $total_review = 0;
            foreach ( $star_rating as $key => $value ) {
            	$featured_name = $value['feature_name'];
                $star_value = $value['feature_star'];
                $total_review = $total_review+$star_value;
	?>
    		<div class="single-review-wrap star-review np-clearfix">
				<span class="review-featured-name"><?php echo esc_html( $featured_name ); ?></span>
                <span class="stars-count"><?php news_portal_display_post_rating( $star_value );?></span>
			</div><!-- .single-review-wrap -->
	<?php
            }
            $total_review = $total_review/$count;
    		$total_review = round( $total_review, 1 );
    		$final_value = round( $total_review, 1 );

    		$GLOBALS['total_review'] = $total_review;
    		$GLOBALS['final_value'] = $final_value;
    	}
	}

endif;

/**
 * percent review section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_percent_review_section' ) ) :

	function np_percent_review_section() {
		global $post;
		$get_review_option = get_post_meta( $post->ID, 'post_review_option', true );
		$post_review_option_value = empty( $get_review_option ) ? 'no_review' : $get_review_option;
		if ( $post_review_option_value == 'star_review' ) {
			return;
		}
		$percent_rating = get_post_meta( $post->ID, 'percent_rating', true );
		if ( !empty ( $percent_rating ) ) {
            $count = count( $percent_rating );
            $total_review = 0;
            foreach ( $percent_rating as $key => $value ) {
            	$featured_name = $value['feature_name'];
                $percent_value = $value['feature_percent'];
	?>
			<div class="single-review-wrap percent-review np-clearfix">
				<div class="review-details">
					<span class="review-featured-name"><?php echo esc_html( $featured_name ); ?></span>
					<span class="review-percent"><?php echo esc_attr( $percent_value );?> &#37; </span>
				</div>
			</div><!-- .single-review-wrap -->
	<?php
                if ( empty( $percent_value ) ) {
                    $percent_value = '1';
                }
                $total_review = $total_review+$percent_value;
            }
            $total_review = $total_review/$count; 
            $total_review = round( $total_review, 1 );
            $final_value = $total_review/20;

            $GLOBALS['total_review'] = $total_review;
    		$GLOBALS['final_value'] = $final_value;
    	}
	}

endif;

/**
 * review summary section
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_review_summary_section' ) ) :

	function np_review_summary_section() {
		
		global $post, $total_review, $final_value;

		$post_review_sum_title = get_theme_mod( 'np_posts_review_sum_title', __( 'Summary', 'news-portal-pro' ) );
		$post_review_description = get_post_meta( $post->ID, 'post_review_description', true );

?>
		<div class="review-summary-wrap np-clearfix">
			<div class="sum-title-detail-wrap">
				<span class="sum-title"><?php echo esc_html( $post_review_sum_title ); ?></span>
				<div class="sum-details"><?php echo wp_kses_post( $post_review_description ); ?></div>
			</div>
			<div class="total-review-wrapper">
				<div class="total-value-star-wrap">
                    <span class="total-value"><?php echo esc_html( $total_review ); ?></span>
                    <span class="stars-count"><?php news_portal_display_post_rating( $final_value ); ?></span>
                </div>
            </div>
		</div><!-- .review-summary-wrap -->
<?php
	}

endif;

/**
 * review content end
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_review_content_end' ) ) :

	function np_review_content_end() {
		echo '</div><!-- .review-content-wrapper -->';
	}

endif;

/**
 * review content end
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'np_review_section_end' ) ) :

	function np_review_section_end() {
		echo '</div><!-- .np-post-review-section-wrapper -->';
	}

endif;

/**
 * Managed functions for author box section
 *
 * @since 1.0.0
 */
add_action( 'news_portal_post_review_section', 'np_review_section_start', 5 );
add_action( 'news_portal_post_review_section', 'np_review_section_title', 10 );
add_action( 'news_portal_post_review_section', 'np_review_content_start', 15 );
add_action( 'news_portal_post_review_section', 'np_star_review_section', 20 );
add_action( 'news_portal_post_review_section', 'np_percent_review_section', 25 );
add_action( 'news_portal_post_review_section', 'np_review_summary_section', 30 );
add_action( 'news_portal_post_review_section', 'np_review_content_end', 35 );
add_action( 'news_portal_post_review_section', 'np_review_section_end', 40 );

/*------------------------------------------------------------------------------------------------*/
/**
 * Function to display review section at widget post
 *
 * @since 1.0.0
 */
add_action( 'np_widget_post_review', 'np_widget_post_review_cb' );

if ( ! function_exists( 'np_widget_post_review_cb' ) ):

    function np_widget_post_review_cb() {
        global $post;

        $post_review_option = get_theme_mod( 'np_widget_post_review', 'show' );
        if ( $post_review_option == 'hide' ) {
        	return;
        }

        $post_review_type = get_post_meta( $post->ID, 'post_review_option', true );
        switch ( $post_review_type ) {
            case 'star_review':
                $post_meta_name = 'star_rating';
                $post_meta_value = 'feature_star';
                break;
            case 'percent_review':
                $post_meta_name = 'percent_rating';
                $post_meta_value = 'feature_percent';
                break;
            default:
                $post_meta_name = 'star_rating';
                $post_meta_value = 'feature_star';
        }
        if ( $post_review_type != 'no_review' && !empty( $post_review_type ) ) {
            $product_rating = get_post_meta( $post->ID, $post_meta_name, true );
            $count = count( $product_rating );
            $total_review = 0;
            foreach ( $product_rating as $key => $value ) {
                $rate_value = $value[ $post_meta_value ];
                $total_review = $total_review+$rate_value;
            }
            if ( $post_meta_name == 'star_rating' ) {
                $total_review = $total_review/$count;
                $final_value = round( $total_review, 1 );
                echo '<div class="post-review-wrapper">';
                news_portal_display_post_rating( $final_value );
                echo '</div>';
            } elseif ( $post_meta_name == 'percent_rating' ) {
                $total_review = $total_review/$count/10/2;
                $final_value = round( $total_review, 1 );
                echo '<div class="post-review-wrapper">';
                news_portal_display_post_rating( $final_value );
                echo '</div>';           
            }
        }
    }
    
endif;