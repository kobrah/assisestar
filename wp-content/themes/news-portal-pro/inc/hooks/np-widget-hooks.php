<?php
/**
 * Custom hooks functions for different layout in widget section.
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Widget Title
 *
 * @since 1.0.0
 */
add_action( 'np_widget_title', 'np_widget_title_callback' );
if ( ! function_exists( 'np_widget_title_callback' ) ) :

	function np_widget_title_callback( $np_title_args ) {
		$np_block_title  = $np_title_args['title'];
		$np_block_cat_id = $np_title_args['cat_id'];
		$np_title_cat_link  = get_theme_mod( 'np_widget_cat_link_option', 'show' );
		$np_title_cat_color = get_theme_mod( 'np_widget_cat_color_option', 'show' );
		if ( $np_title_cat_color == 'show' ) {
			$title_class = 'np-title np-cat-'. $np_block_cat_id;
		} else {
			$title_class = 'np-title';
		}
		
		if ( !empty( $np_block_cat_id ) && $np_title_cat_link == 'show' ) {
			$np_blcok_cat_link = get_category_link( $np_block_cat_id );
			echo '<h2 class="np-block-title"><a href="'. esc_url( $np_blcok_cat_link ) .'"><span class="'. esc_attr( $title_class ) .'">'. esc_html( $np_block_title ) .'</span></a></h2>';
		} else {
			echo '<h2 class="np-block-title"><span class="'. esc_attr( $title_class ) .'">'. esc_html( $np_block_title ) .'</span></h2>';
		}
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Featured Slider Default Layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_featured_slider_layout_default' ) ) :

	function news_portal_featured_slider_layout_default( $np_slider_args, $np_featured_cat_ids, $cats_list_option ) {
		if ( !empty( $np_slider_args ) ) {
            $np_slider_query = new WP_Query( $np_slider_args );
            echo '<div class="np-featured-slider-section">';
            if ( $np_slider_query->have_posts() ) {
                echo '<ul class="npFeaturedSlider cS-hidden">';
                while ( $np_slider_query->have_posts() ) {
                    $np_slider_query->the_post();
                    if ( has_post_thumbnail() ) {
	?>
                        <li>
                            <div class="np-single-slide-wrap <?php news_portal_post_format_icon(); ?>">
                                <div class="np-slide-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'news-portal-slider-medium' ); ?>
                                    </a>
                                </div><!-- .np-slide-thumb -->
                                <div class="np-slide-content-wrap">
                                    <?php 
                                        if ( $cats_list_option == 'show' ) {
                                            news_portal_post_categories_list();
                                        }
                                    ?>
                                    <h3 class="post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="np-post-meta">
                                        <?php
                                            news_portal_posted_on();
                                            news_portal_post_comment();
                                        ?>
                                    </div>
                                </div> <!-- np-slide-content-wrap -->
                            </div><!-- .single-slide-wrap -->
                        </li>
    <?php
                    }
                }
                echo '</ul>';
            }
            wp_reset_postdata();
            echo '</div><!-- .np-featured-slider-section -->';
        }

        if ( !empty( $np_featured_cat_ids ) ) {
            $checked_cats = array();
            foreach( $np_featured_cat_ids as $cat_key => $cat_value ) {
                $checked_cats[] = $cat_key;
            }
            $get_cats_ids = implode( ",", $checked_cats );
            $np_featured_args = array(
                    'post_type' => 'post',
                    'cat' => $get_cats_ids,
                    'posts_per_page' => 4
                );
            $np_featured_query = new WP_Query( $np_featured_args );
            echo '<div class="np-featured-section">';
            if ( $np_featured_query->have_posts() ) {
                while ( $np_featured_query->have_posts() ) {
                    $np_featured_query->the_post();
    ?>
                    <div class="np-single-post-wrap np-clearfix <?php news_portal_post_format_icon(); ?>">
                        <div class="np-single-post">
                            <div class="np-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <figure>
                                        <?php news_portal_widget_featured_image( 'news-portal-block-medium' ); ?>
                                    </figure>                                
                                </a>
                            </div><!-- .np-post-thumb -->
                            <div class="np-post-content">
                                <?php
                                    if ( $cats_list_option == 'show' ) {
                                        news_portal_post_categories_list();
                                    }
                                ?>
                                <h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="np-post-meta">
                                    <?php
                                        news_portal_posted_on();
                                        news_portal_post_comment();
                                    ?>
                                </div>
                            </div><!-- .np-post-content -->
                        </div> <!-- np-single-post -->
                    </div><!-- .np-single-post-wrap -->
    <?php
                }
            }
            wp_reset_postdata();
            echo '</div><!-- .np-featured-section -->';
        }
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Featured Slider Layout One
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_featured_slider_layout_one' ) ) :

    function news_portal_featured_slider_layout_one( $np_slider_args, $np_featured_cat_ids, $cats_list_option ) {
        if ( !empty( $np_slider_args ) ) {
            $np_slider_query = new WP_Query( $np_slider_args );
            echo '<div class="np-featured-slider-section">';
            if ( $np_slider_query->have_posts() ) {
                echo '<ul class="npFeaturedSlider cS-hidden">';
                while ( $np_slider_query->have_posts() ) {
                    $np_slider_query->the_post();
                    if ( has_post_thumbnail() ) {
    ?>
                        <li>
                            <div class="np-single-slide-wrap <?php news_portal_post_format_icon(); ?>">
                                <div class="np-slide-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'news-portal-slider-medium' ); ?>
                                    </a>
                                </div><!-- .np-slide-thumb -->
                                <div class="np-slide-content-wrap">
                                    <?php 
                                        if ( $cats_list_option == 'show' ) {
                                            news_portal_post_categories_list();
                                        }
                                    ?>
                                    <h3 class="post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="np-post-meta">
                                        <?php
                                            news_portal_posted_on();
                                            news_portal_post_comment();
                                        ?>
                                    </div>
                                </div> <!-- np-slide-content-wrap -->
                            </div><!-- .single-slide-wrap -->
                        </li>
    <?php
                    }
                }
                echo '</ul>';
            }
            wp_reset_postdata();
            echo '</div><!-- .np-featured-slider-section -->';
        }

        if ( !empty( $np_featured_cat_ids ) ) {
            $checked_cats = array();
            foreach( $np_featured_cat_ids as $cat_key => $cat_value ) {
                $checked_cats[] = $cat_key;
            }
            $get_cats_ids = implode( ",", $checked_cats );
            $np_featured_args = array(
                    'post_type' => 'post',
                    'cat' => $get_cats_ids,
                    'posts_per_page' => 3
                );
            $np_featured_query = new WP_Query( $np_featured_args );
            $total_posts_count = $np_featured_query->post_count;
            echo '<div class="np-featured-section">';
            if ( $np_featured_query->have_posts() ) {
                $post_count = 1;
                while ( $np_featured_query->have_posts() ) {
                    $np_featured_query->the_post();
                    if ( $post_count == 1 ) {
                        echo '<div class="featured-top-section">';
                        $featured_image_size = 'news-portal-horizontal-thumb';
                    } elseif ( $post_count == 2 ) {
                        echo '<div class="featured-bottom-section">';
                        $featured_image_size = 'news-portal-block-medium';
                    } else {
                        $featured_image_size = 'news-portal-block-medium';
                    }
    ?>
                    <div class="np-single-post-wrap np-clearfix <?php news_portal_post_format_icon(); ?>">
                        <div class="np-single-post">
                            <div class="np-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <figure>
                                        <?php news_portal_widget_featured_image( $featured_image_size ); ?>
                                    </figure>                                
                                </a>
                            </div><!-- .np-post-thumb -->
                            <div class="np-post-content">
                                <?php
                                    if ( $cats_list_option == 'show' ) {
                                        news_portal_post_categories_list();
                                    }
                                ?>
                                <h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="np-post-meta">
                                    <?php
                                        news_portal_posted_on();
                                        news_portal_post_comment();
                                    ?>
                                </div>
                            </div><!-- .np-post-content -->
                        </div> <!-- np-single-post -->
                    </div><!-- .np-single-post-wrap -->
    <?php
                if ( $post_count == 1 ) {
                    echo '</div><!-- .featured-top-section -->';
                } elseif ( $post_count == $total_posts_count ) {
                    echo '</div><!-- .featured-bottom-section -->';
                }
                $post_count++;
                }
            }
            wp_reset_postdata();
            echo '</div><!-- .np-featured-section -->';
        }
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Featured Slider Layout Two
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_featured_slider_layout_two' ) ) :

    function news_portal_featured_slider_layout_two( $np_slider_args, $np_featured_cat_ids, $cats_list_option ) {
        if ( !empty( $np_slider_args ) ) {
            $np_slider_query = new WP_Query( $np_slider_args );
            echo '<div class="np-featured-slider-section">';
            if ( $np_slider_query->have_posts() ) {
                echo '<ul class="npFeaturedSlider cS-hidden">';
                while ( $np_slider_query->have_posts() ) {
                    $np_slider_query->the_post();
                    if ( has_post_thumbnail() ) {
    ?>
                        <li>
                            <div class="np-single-slide-wrap <?php news_portal_post_format_icon(); ?>">
                                <div class="np-slide-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'news-portal-slider-medium' ); ?>
                                    </a>
                                </div><!-- .np-slide-thumb -->
                                <div class="np-slide-content-wrap">
                                    <?php 
                                        if ( $cats_list_option == 'show' ) {
                                            news_portal_post_categories_list();
                                        }
                                    ?>
                                    <h3 class="post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="np-post-meta">
                                        <?php
                                            news_portal_posted_on();
                                            news_portal_post_comment();
                                        ?>
                                    </div>
                                </div> <!-- np-slide-content-wrap -->
                            </div><!-- .single-slide-wrap -->
                        </li>
    <?php
                    }
                }
                echo '</ul>';
            }
            wp_reset_postdata();
            echo '</div><!-- .np-featured-slider-section -->';            
        }

        if ( !empty( $np_featured_cat_ids ) ) {
            $checked_cats = array();
            foreach( $np_featured_cat_ids as $cat_key => $cat_value ) {
                $checked_cats[] = $cat_key;
            }
            $get_cats_ids = implode( ",", $checked_cats );
            $np_featured_args = array(
                    'post_type' => 'post',
                    'cat' => $get_cats_ids,
                    'posts_per_page' => 2
                );
            $np_featured_query = new WP_Query( $np_featured_args );
            echo '<div class="np-featured-section">';
            if ( $np_featured_query->have_posts() ) {
                while ( $np_featured_query->have_posts() ) {
                    $np_featured_query->the_post();
    ?>
                    <div class="np-single-post-wrap np-clearfix <?php news_portal_post_format_icon(); ?>">
                        <div class="np-single-post">
                            <div class="np-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <figure>
                                        <?php news_portal_widget_featured_image( 'news-portal-portrait-thumb' ); ?>
                                    </figure>                                
                                </a>
                            </div><!-- .np-post-thumb -->
                            <div class="np-post-content">
                                <?php
                                    if ( $cats_list_option == 'show' ) {
                                        news_portal_post_categories_list();
                                    }
                                ?>
                                <h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="np-post-meta">
                                    <?php
                                        news_portal_posted_on();
                                        news_portal_post_comment();
                                    ?>
                                </div>
                            </div><!-- .np-post-content -->
                        </div> <!-- np-single-post -->
                    </div><!-- .np-single-post-wrap -->
    <?php
                }
            }
            wp_reset_postdata();
            echo '</div><!-- .np-featured-section -->';
        }
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Slider Layout one
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_slider_layout_one' ) ) :

	function news_portal_slider_layout_one( $np_slider_args, $cats_list_option ) {
		$np_slider_query = new WP_Query( $np_slider_args );
        if ( $np_slider_query->have_posts() ) {
            echo '<ul class="npSliderGallery cS-hidden">';
            while ( $np_slider_query->have_posts() ) {
                $np_slider_query->the_post();
                if ( has_post_thumbnail() ) {
                	$post_id = get_the_ID();
                	$thumb_img_url = get_the_post_thumbnail_url( $post_id, 'news-portal-block-medium' );
                	$large_img_url = get_the_post_thumbnail_url( $post_id, 'news-portal-slider-large' );
	?>
                    <li data-thumb="<?php echo esc_url( $thumb_img_url ); ?>" data-src="<?php echo esc_url( $large_img_url ); ?>">
                        <div class="np-single-slide-wrap <?php news_portal_post_format_icon(); ?>">
                            <div class="np-slide-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'full' ); ?>
                                </a>
                            </div><!-- .np-slide-thumb -->
                            <div class="np-slide-content-wrap">
                                <?php 
                                    if ( $cats_list_option == 'show' ) {
                                        news_portal_post_categories_list();
                                    }
                                ?>
                                <h3 class="post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="np-post-meta">
                                    <?php
                                        news_portal_posted_on();
                                        news_portal_post_comment();
                                    ?>
                                </div>
                            </div> <!-- np-slide-content-wrap -->
                        </div><!-- .single-slide-wrap -->
                    </li>
    <?php
                }
            }
            echo '</ul>';
        }
        wp_reset_postdata();
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Slider Layout two
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_slider_layout_two' ) ) :

	function news_portal_slider_layout_two( $np_slider_args, $cats_list_option ) {
		$np_slider_query = new WP_Query( $np_slider_args );
        if ( $np_slider_query->have_posts() ) {
            echo '<ul class="npSlider cS-hidden">';
            while ( $np_slider_query->have_posts() ) {
                $np_slider_query->the_post();
                if ( has_post_thumbnail() ) {
	?>
                    <li>
                        <div class="np-single-slide-wrap <?php news_portal_post_format_icon(); ?>">
                            <div class="np-slide-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'full' ); ?>
                                </a>
                            </div><!-- .np-slide-thumb -->
                            <div class="np-slide-content-wrap">
                                <?php 
                                    if ( $cats_list_option == 'show' ) {
                                        news_portal_post_categories_list();
                                    }
                                ?>
                                <h3 class="post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="np-post-meta">
                                    <?php
                                        news_portal_posted_on();
                                        news_portal_post_comment();
                                    ?>
                                </div>
                            </div> <!-- np-slide-content-wrap -->
                        </div><!-- .single-slide-wrap -->
                    </li>
    <?php
                }
            }
            echo '</ul>';
        }
        wp_reset_postdata();
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Featured Posts Layout One
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_featured_posts_layout_one' ) ) :

	function news_portal_featured_posts_layout_one( $np_posts_args ) {
		$np_posts_query = new WP_Query( $np_posts_args );
        if ( $np_posts_query->have_posts() ) {
            while ( $np_posts_query->have_posts() ) {
                $np_posts_query->the_post();
?>
				<div class="np-single-post-wrap np-clearfix wow fadeInDown <?php news_portal_post_format_icon(); ?>" data-wow-duration="0.8s" data-wow-delay="0.3s">
                    <div class="np-single-post">
                        <div class="np-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <figure><?php news_portal_widget_featured_image( 'news-portal-block-thumb' ); ?></figure>
                            </a>
                        </div><!-- .np-post-thumb -->
                        <div class="np-post-content">
                            <h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="np-post-meta">
                                <?php news_portal_posted_on(); ?>
                            </div>
                        </div><!-- .np-post-content -->
                    </div> <!-- np-single-post -->
                </div><!-- .np-single-post-wrap -->
<?php
			}
		}
		wp_reset_postdata();
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Featured Posts Layout Two
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_featured_posts_layout_two' ) ) :

	function news_portal_featured_posts_layout_two( $np_posts_args, $cats_list_option ) {
		$np_posts_query = new WP_Query( $np_posts_args );
		$total_posts_count = $np_posts_query->post_count;
        if ( $np_posts_query->have_posts() ) {
        	$post_count = 1; $np_post_count = 1;
            while ( $np_posts_query->have_posts() ) {
                $np_posts_query->the_post();
                if ( $post_count == 1 ) {
                	echo '<div class="featured-left-section wow fadeInLeft" data-wow-duration="1.2s" data-wow-delay="0.3s">';
                	$featured_image_size = 'news-portal-small-square-thumb';
                	$title_size = 'small-size';
                } elseif ( $post_count == 3 ) {
                	echo '<div class="featured-middle-section wow fadeInLeft" data-wow-duration="1.2s" data-wow-delay="0.6s">';
                	$featured_image_size = 'news-portal-large-square-thumb';
                	$title_size = 'large-size';
                } elseif ( $post_count == 4 ) {
                	echo '<div class="featured-right-section wow fadeInLeft" data-wow-duration="1.2s" data-wow-delay="0.9s">';
                	$featured_image_size = 'news-portal-small-square-thumb';
                	$title_size = 'small-size';
                } else {
                	$featured_image_size = 'news-portal-small-square-thumb';
                	$title_size = 'small-size';
                }
?>
				<div class="np-single-post-wrap np-clearfix <?php news_portal_post_format_icon(); ?>">
                    <div class="np-single-post">
                        <div class="np-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <figure><?php news_portal_widget_featured_image( $featured_image_size ); ?></figure>
                            </a>
                        </div><!-- .np-post-thumb -->
                        <div class="np-post-content">
                        	<?php
                                if ( $cats_list_option == 'show' ) {
                                    news_portal_post_categories_list();
                                }
                            ?>
                            <h3 class="np-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="np-post-meta">
                                <?php
                                    news_portal_posted_on();
                                    news_portal_post_comment();
                                ?>
                            </div>
                        </div><!-- .np-post-content -->
                    </div> <!-- np-single-post -->
                </div><!-- .np-single-post-wrap -->
<?php
			if ( $total_posts_count < 2 || $post_count == 2 ) {
				echo '</div><!-- .featured-left-section -->';
			} elseif ( $post_count == 3 ) {
				echo '</div><!-- .featured-middle-section -->';
			} elseif ( $np_post_count == $total_posts_count || $post_count == 5 ) {
				echo '</div><!-- .featured-right-section -->';
			}
			$post_count++; $np_post_count++;
			if ( $post_count > 5 ) {
				$post_count = 1;
			}
			}
		}
		wp_reset_postdata();
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Default Layouts
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_block_default_layout_section' ) ) :

	function news_portal_block_default_layout_section( $cat_id ) {
		if ( empty( $cat_id ) ) {
			return;
		}
		$np_post_count = apply_filters( 'news_portal_block_default_posts_count', 6 );
		$block_args = array(
				'cat' => $cat_id,
				'posts_per_page' => $np_post_count,
			);
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if ( $block_query->have_posts() ) {
			$post_count = 1;
			while ( $block_query->have_posts() ) {
				$block_query->the_post();
				if ( $post_count == 1 ) {
					echo '<div class="np-primary-block-wrap wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">';
					$title_size = 'large-size';
				} elseif ( $post_count == 2 ) {
					echo '<div class="np-secondary-block-wrap wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.7s">';
					$title_size = 'small-size';
				} else {
					$title_size = 'small-size';
				}
	?>
					<div class="np-single-post np-clearfix <?php news_portal_post_format_icon(); ?>">
						<div class="np-post-thumb">
							<a href="<?php the_permalink(); ?>">
								<?php if ( $post_count == 1 ) { ?>
                                    <figure><?php news_portal_widget_featured_image( 'news-portal-slider-medium' ); ?></figure>
                                <?php } else { ?>
                                    <figure><?php news_portal_widget_featured_image( 'news-portal-block-thumb' ); ?></figure>
								<?php } ?>
							</a>
						</div><!-- .np-post-thumb -->
						<div class="np-post-content">
							<h3 class="np-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="np-post-meta">
                                <?php
                                    news_portal_posted_on();
                                    news_portal_post_comment();
                                    do_action( 'np_widget_post_review' );
                                ?>
                            </div>
							<?php if ( $post_count == 1 ) { ?>
								<div class="np-post-excerpt"><?php the_excerpt(); ?></div>
							<?php } ?>
						</div><!-- .np-post-content -->
					</div><!-- .np-single-post -->
	<?php
				if ( $post_count == 1 ) {
					echo '</div><!-- .np-primary-block-wrap -->';
				} elseif ( $post_count == $total_posts_count ) {
					echo '</div><!-- .np-secondary-block-wrap -->';
				}
			$post_count++;
			}
		}
		wp_reset_postdata();
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Second Layouts
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'news_portal_block_second_layout_section' ) ) :

	function news_portal_block_second_layout_section( $cat_id ) {
		if ( empty( $cat_id ) ) {
			return;
		}
		$np_post_count = apply_filters( 'news_portal_block_second_layout_posts_count', 6 );
		$block_args = array(
				'cat' => $cat_id,
				'posts_per_page' => $np_post_count,
			);
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if ( $block_query->have_posts() ) {
			$post_count = 1;
			while ( $block_query->have_posts() ) {
				$block_query->the_post();
				if ( $post_count == 1 ) {
					echo '<div class="np-primary-block-wrap wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">';
				} elseif ( $post_count == 3 ) {
					echo '<div class="np-secondary-block-wrap wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.7s">';
				}
				if ( $post_count <= 2 ) {
					$title_size = 'large-size';
                    $np_image_size = 'news-portal-slider-medium';
				} else {
					$title_size = 'small-size';
                    $np_image_size = 'news-portal-block-thumb';
				}
	?>
					<div class="np-single-post np-clearfix <?php news_portal_post_format_icon(); ?>">
						<div class="np-post-thumb">
							<a href="<?php the_permalink(); ?>">
								<figure><?php news_portal_widget_featured_image( $np_image_size ); ?></figure>
							</a>
						</div><!-- .np-post-thumb -->
						<div class="np-post-content">
							<h3 class="np-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="np-post-meta">
                                <?php
                                    news_portal_posted_on();
                                    news_portal_post_comment();
                                    do_action( 'np_widget_post_review' );
                                ?>
                            </div>
							<?php if ( $post_count <= 2 ) { ?>
								<div class="np-post-excerpt"><?php the_excerpt(); ?></div>
							<?php } ?>
						</div><!-- .np-post-content -->
					</div><!-- .np-single-post -->
	<?php
				if ( $post_count == 2 ) {
					echo '</div><!-- .np-primary-block-wrap -->';
				} elseif ( $post_count == $total_posts_count ) {
					echo '</div><!-- .np-secondary-block-wrap -->';
				}
				$post_count++;
			}
		}
		wp_reset_postdata();
	}

endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Box Layouts
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_block_box_layout_section' ) ) :

	function news_portal_block_box_layout_section( $cat_id ) {
		if ( empty( $cat_id ) ) {
			return;
		}
		$np_post_count = apply_filters( 'news_portal_block_box_posts_count', 4 );
		$block_args = array(
				'cat' => $cat_id,
				'posts_per_page' => $np_post_count,
			);
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if ( $block_query->have_posts() ) {
			$post_count = 1;
            $wow_delay = 0;
			while ( $block_query->have_posts() ) {
				$block_query->the_post();
                $wow_delay = $wow_delay+0.3;
				if ( $post_count == 1 ) {
					echo '<div class="np-primary-block-wrap">';
					$title_size = 'large-size';
                    $np_image_size = 'full';
				} elseif ( $post_count == 2 ) {
					echo '<div class="np-secondary-block-wrap np-clearfix">';
					$title_size = 'small-size';
                    $np_image_size = 'news-portal-block-medium';
				} else {
					$title_size = 'small-size';
                    $np_image_size = 'news-portal-block-medium';
				}
	?>
					<div class="np-single-post np-clearfix wow zoomIn <?php news_portal_post_format_icon(); ?>" data-wow-duration="1.5s" data-wow-delay="<?php echo esc_attr( $wow_delay ); ?>s" >
						<div class="np-post-thumb">
							<a href="<?php the_permalink(); ?>">
                                <figure><?php news_portal_widget_featured_image( $np_image_size ); ?></figure>
							</a>
						</div><!-- .np-post-thumb -->
						<div class="np-post-content">
							<h3 class="np-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="np-post-meta">
                                <?php
                                    news_portal_posted_on();
                                    news_portal_post_comment();
                                    if ( $post_count > 1 ) {
                                        do_action( 'np_widget_post_review' );
                                    }
                                ?>
                            </div>
						</div><!-- .np-post-content -->
					</div><!-- .np-single-post -->
	<?php
				if ( $post_count == 1 ) {
					echo '</div><!-- .np-primary-block-wrap -->';
				} elseif ( $post_count == $total_posts_count ) {
					echo '</div><!-- .np-secondary-block-wrap -->';
				}
			$post_count++;
			}
		}
		wp_reset_postdata();
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block alternate grid
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_block_alternate_grid_section' ) ) :

	function news_portal_block_alternate_grid_section( $cat_id ) {
		if ( empty( $cat_id ) ) {
			return;
		}
		$np_post_count = apply_filters( 'news_portal_block_alternate_grid_posts_count', 3 );
		$block_args = array(
				'cat' => $cat_id,
				'posts_per_page' => $np_post_count,
			);
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if ( $block_query->have_posts() ) {
            $post_count = 1;
            $wow_delay = 0;
			while ( $block_query->have_posts() ) {
				$block_query->the_post();
                $wow_delay = $wow_delay+0.3;
	?>
				<div class="np-alt-grid-post np-single-post np-clearfix wow fadeInLeft <?php news_portal_post_format_icon(); ?>" data-wow-duration="1s" data-wow-delay="<?php echo esc_attr( $wow_delay ); ?>s">
					<div class="np-post-thumb">
						<a href="<?php the_permalink(); ?>">
                            <figure><?php news_portal_widget_featured_image( 'news-portal-alternate-grid' ); ?></figure>
						</a>
					</div><!-- .np-post-thumb -->
					<div class="np-post-content">
						<h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="np-post-meta">
                            <?php
                                news_portal_posted_on();
                                news_portal_post_comment();
                                do_action( 'np_widget_post_review' );
                            ?>
                        </div>
						<div class="np-post-excerpt"><?php the_excerpt(); ?></div>
					</div><!-- .np-post-content -->
				</div><!-- .np-single-post -->
	<?php
			$post_count++;
            }
		}
		wp_reset_postdata();
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Carousel Default Layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_default_carousel_section' ) ) :

	function news_portal_default_carousel_section( $carousel_args, $cats_list_option ) {
		$carousel_query = new WP_Query( $carousel_args );
		if ( $carousel_query->have_posts() ) {
			echo '<ul class="postCarousel cS-hidden">';
			while ( $carousel_query->have_posts() ) {
				$carousel_query->the_post();
	?>
				<li>
					<div class="np-single-post np-clearfix <?php news_portal_post_format_icon(); ?>">
						<div class="np-post-thumb">
							<a href="<?php the_permalink(); ?>">
								<figure><?php news_portal_widget_featured_image( 'news-portal-carousel-portrait' ); ?></figure>
							</a>
						</div><!-- .np-post-thumb -->
						<div class="np-post-content">
							<?php
                                if ( $cats_list_option == 'show' ) {
                                    news_portal_post_categories_list();
                                }
                            ?>
							<h3 class="np-post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="np-post-meta">
                                <?php
                                    news_portal_posted_on();
                                    news_portal_post_comment();
                                ?>
                            </div>
						</div><!-- .np-post-content -->
					</div><!-- .np-single-post -->
				</li>
	<?php
			}
			echo '</ul>';
		}
		wp_reset_postdata();
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Carousel Layout Two
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_second_carousel_section' ) ) :

    function news_portal_second_carousel_section( $carousel_args, $cats_list_option ) {
        $carousel_query = new WP_Query( $carousel_args );
        if ( $carousel_query->have_posts() ) {
            echo '<ul class="postCarousel cS-hidden">';
            while ( $carousel_query->have_posts() ) {
                $carousel_query->the_post();
    ?>
                <li>
                    <div class="np-single-post np-clearfix <?php news_portal_post_format_icon(); ?>">
                        <div class="np-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <figure><?php news_portal_widget_featured_image( 'news-portal-list-medium' ); ?></figure>
                            </a>
                        </div><!-- .np-post-thumb -->
                        <div class="np-post-content">
                            <?php
                                if ( $cats_list_option == 'show' ) {
                                    news_portal_post_categories_list();
                                }
                            ?>
                            <h3 class="np-post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="np-post-meta">
                                <?php
                                    news_portal_posted_on();
                                    news_portal_post_comment();
                                ?>
                            </div>
                        </div><!-- .np-post-content -->
                    </div><!-- .np-single-post -->
                </li>
    <?php
            }
            echo '</ul>';
        }
        wp_reset_postdata();
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Carousel Layout Three
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_third_carousel_section' ) ) :

    function news_portal_third_carousel_section( $carousel_args, $cats_list_option ) {
        $carousel_query = new WP_Query( $carousel_args );
        if ( $carousel_query->have_posts() ) {
            echo '<ul class="postCarousel cS-hidden">';
            while ( $carousel_query->have_posts() ) {
                $carousel_query->the_post();
    ?>
                <li>
                    <div class="np-single-post np-clearfix <?php news_portal_post_format_icon(); ?>">
                        <div class="np-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <figure><?php news_portal_widget_featured_image( 'news-portal-list-medium' ); ?></figure>
                            </a>
                        </div><!-- .np-post-thumb -->
                        <div class="np-post-content">
                            <?php
                                if ( $cats_list_option == 'show' ) {
                                    news_portal_post_categories_list();
                                }
                            ?>
                            <h3 class="np-post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="np-post-meta">
                                <?php
                                    news_portal_posted_on();
                                    news_portal_post_comment();
                                    do_action( 'np_widget_post_review' );
                                ?>
                            </div>
                        </div><!-- .np-post-content -->
                    </div><!-- .np-single-post -->
                </li>
    <?php
            }
            echo '</ul>';
        }
        wp_reset_postdata();
    }

endif;


/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * FullWidth First Layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_fullwidth_first_layout_section' ) ) :

	function news_portal_fullwidth_first_layout_section( $block_args, $np_block_column, $cats_list_option ) {		
		$block_query = new WP_Query( $block_args );
        $total_posts_count = $block_query->post_count;
		if ( $block_query->have_posts() ) {
            $post_count = 1;
            $wow_delay = 0;
			echo '<div class="np-fullwidth-grid-wrapper col-'. absint( $np_block_column ) .'">';
			while ( $block_query->have_posts() ) {
				$block_query->the_post();                
                if ( $post_count%$np_block_column == 1 ) {
                    $wow_delay = $wow_delay+0.3;
                    echo '<div class="np-single-posts-wrapper np-clearfix wow fadeInUp" data-wow-duration="1s" data-wow-delay="'. esc_attr( $wow_delay ) .'s">';
                }
	?>
				<div class="np-single-post np-clearfix <?php news_portal_post_format_icon(); ?>">
					<div class="np-post-thumb">
						<a href="<?php the_permalink(); ?>">
                            <figure><?php news_portal_widget_featured_image( 'news-portal-slider-medium' ); ?></figure>
						</a>
					</div><!-- .np-post-thumb -->
					<div class="np-post-content">
						<?php
                            if ( $cats_list_option == 'show' ) {
                                news_portal_post_categories_list();
                            }
                        ?>
						<h3 class="np-post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="np-post-meta">
                            <?php
                                news_portal_posted_on();
                                news_portal_post_comment();
                            ?>
                        </div>
					</div><!-- .np-post-content -->
				</div><!-- .np-single-post -->
	<?php
                if ( 0 == $post_count%$np_block_column || $post_count == $total_posts_count ) {
                    echo '</div><!-- .np-single-posts-wrapper -->';
                }
			    $post_count++;
            }
			echo '</div><!-- .np-fullwidth-grid-wrapper -->';
		}
		wp_reset_postdata();
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * FullWidth Second Layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_fullwidth_second_layout_section' ) ) :

    function news_portal_fullwidth_second_layout_section( $block_args, $np_block_column, $cats_list_option ) {      
        $block_query = new WP_Query( $block_args );
        $total_posts_count = $block_query->post_count;
        if ( $block_query->have_posts() ) {
            $post_count = 1;
            $wow_delay = 0;
            echo '<div class="np-fullwidth-grid-wrapper col-'. absint( $np_block_column ) .'">';
            while ( $block_query->have_posts() ) {
                $block_query->the_post();
                if ( $post_count%$np_block_column == 1 ) {
                    $wow_delay = $wow_delay+0.3;
                    echo '<div class="np-single-posts-wrapper np-clearfix wow fadeInUp" data-wow-duration="1s" data-wow-delay="'. esc_attr( $wow_delay ) .'s">';
                }
    ?>
                <div class="np-single-post np-clearfix <?php news_portal_post_format_icon(); ?>">
                    <div class="np-post-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <figure><?php news_portal_widget_featured_image( 'news-portal-slider-medium' ); ?></figure>
                        </a>
                    </div><!-- .np-post-thumb -->
                    <div class="np-post-content">
                        <?php
                            if ( $cats_list_option == 'show' ) {
                                news_portal_post_categories_list();
                            }
                        ?>
                        <h3 class="np-post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="np-post-meta">
                            <?php
                                news_portal_posted_on();
                                news_portal_post_comment();
                                do_action( 'np_widget_post_review' );
                            ?>
                        </div>
                        <div class="np-post-excerpt"><?php the_excerpt(); ?></div>
                    </div><!-- .np-post-content -->
                </div><!-- .np-single-post -->
    <?php
                if ( 0 == $post_count%$np_block_column || $post_count == $total_posts_count ) {
                    echo '</div><!-- .np-single-posts-wrapper -->';
                }
                $post_count++;
            }
            echo '</div><!-- .np-fullwidth-grid-wrapper -->';
        }
        wp_reset_postdata();
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * FullWidth Third Layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_fullwidth_third_layout_section' ) ) :

    function news_portal_fullwidth_third_layout_section( $block_args, $np_block_column, $cats_list_option ) {      
        $block_query = new WP_Query( $block_args );
        $total_posts_count = $block_query->post_count;
        if ( $block_query->have_posts() ) {
            $post_count = 1;
            $wow_delay = 0;
            echo '<div class="np-fullwidth-grid-wrapper col-'. absint( $np_block_column ) .'">';
            while ( $block_query->have_posts() ) {
                $block_query->the_post();
                if ( $post_count%$np_block_column == 1 ) {
                    $wow_delay = $wow_delay+0.3;
                    echo '<div class="np-single-posts-wrapper np-clearfix wow fadeInUp" data-wow-duration="1s" data-wow-delay="'. esc_attr( $wow_delay ) .'s">';
                }
    ?>
                <div class="np-single-post np-clearfix <?php news_portal_post_format_icon(); ?>">
                    <?php if ( $post_count <= $np_block_column ) { ?>
                        <div class="np-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <figure><?php news_portal_widget_featured_image( 'news-portal-slider-medium' ); ?></figure>
                            </a>
                        </div><!-- .np-post-thumb -->
                    <?php } ?>
                    <div class="np-post-content">
                        <?php
                            if ( $cats_list_option == 'show' ) {
                                news_portal_post_categories_list();
                            }
                        ?>
                        <h3 class="np-post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="np-post-meta">
                            <?php
                                news_portal_posted_on();
                                news_portal_post_comment();
                                if ( $post_count <= $np_block_column ) {
                                    do_action( 'np_widget_post_review' );
                                }
                            ?>
                        </div>
                    </div><!-- .np-post-content -->
                </div><!-- .np-single-post -->
    <?php
                if ( 0 == $post_count%$np_block_column || $post_count == $total_posts_count ) {
                    echo '</div><!-- .np-single-posts-wrapper -->';
                }
                $post_count++;
            }
            echo '</div><!-- .np-fullwidth-grid-wrapper -->';
        }
        wp_reset_postdata();
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Default review posts layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_review_posts_default_section' ) ) :

	function news_portal_review_posts_default_section( $review_type, $post_count ) {
		$review_args = array(
        	'posts_per_page'   => $post_count,
        	'meta_key'         => 'post_review_option',
        	'meta_value'       => $review_type,
        	'suppress_filters' => true
        );

        $review_query = new WP_Query( $review_args );
        $total_posts_count = $review_query->post_count;
        if ( $review_query->have_posts() ) {
        	$post_count = 1;
        	while ( $review_query->have_posts() ) {
        		$review_query->the_post();
        		if ( $post_count == 1 ) {
					echo '<div class="np-primary-block-wrap wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.3s">';
					$title_size = 'large-size';
                    $np_image_size = 'news-portal-slider-medium';
				} elseif ( $post_count == 2 ) {
					echo '<div class="np-secondary-block-wrap wow fadeInLeft" data-wow-duration="0.8s" data-wow-delay="0.6s">';
					$title_size = 'small-size';
                    $np_image_size = 'news-portal-block-thumb';
				} else {
					$title_size = 'small-size';
                    $np_image_size = 'news-portal-block-thumb';
				}
	?>
					<div class="np-single-post np-clearfix <?php news_portal_post_format_icon(); ?>">
						<div class="np-post-thumb">
							<a href="<?php the_permalink(); ?>">
                                <figure><?php news_portal_widget_featured_image( $np_image_size ); ?></figure>
							</a>
						</div><!-- .np-post-thumb -->
						<div class="np-post-content">
							<h3 class="np-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="np-post-meta">
                                <?php
                                    news_portal_posted_on();
                                    news_portal_post_comment();
                                    do_action( 'np_widget_post_review' );
                                ?>
                            </div>
							<?php if ( $post_count == 1 ) { ?>
								<div class="np-post-excerpt"><?php the_excerpt(); ?></div>
							<?php } ?>
						</div><!-- .np-post-content -->
					</div><!-- .np-single-post -->
	<?php
				if ( $post_count == 1 ) {
					echo '</div><!-- .np-primary-block-wrap -->';
				} elseif ( $post_count == $total_posts_count ) {
					echo '</div><!-- .np-secondary-block-wrap -->';
				}
    		$post_count++;
        	}
        }
        wp_reset_postdata();
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * List review posts layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_review_posts_list_section' ) ) :

	function news_portal_review_posts_list_section( $review_type, $post_count ) {
		$review_args = array(
        	'posts_per_page'   => $post_count,
        	'meta_key'         => 'post_review_option',
        	'meta_value'       => $review_type,
        	'suppress_filters' => true
        );

        $review_query = new WP_Query( $review_args );
        $total_posts_count = $review_query->post_count;
        $post_count = 1;
        $wow_delay = 0;
        if ( $review_query->have_posts() ) {
        	while ( $review_query->have_posts() ) {
        		$review_query->the_post();
                $wow_delay = $wow_delay+0.3;
	?>
				<div class="np-single-post np-clearfix wow fadeInLeft <?php news_portal_post_format_icon(); ?>" data-wow-duration="1s" data-wow-delay="<?php echo esc_attr( $wow_delay ); ?>s">
					<div class="np-post-thumb">
						<a href="<?php the_permalink(); ?>">
                            <figure><?php news_portal_widget_featured_image( 'news-portal-block-thumb' ); ?></figure>
						</a>
					</div><!-- .np-post-thumb -->
					<div class="np-post-content">
						<h3 class="np-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="np-post-meta">
                            <?php
                                news_portal_posted_on();
                                news_portal_post_comment();
                                do_action( 'np_widget_post_review' );
                            ?>
                        </div>
					</div><!-- .np-post-content -->
				</div><!-- .np-single-post -->
	<?php
        	$post_count++;
            }
        }
        wp_reset_postdata();
	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * List Posts Layout One
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_list_default_layout_section' ) ) :

    function news_portal_list_default_layout_section( $list_args, $cats_list_option ) {
        $list_query = new WP_Query( $list_args );
        if ( $list_query->have_posts() ) {
            $post_count = 1;
            $wow_delay = 0;
            echo '<div class="np-list-posts-wrapper">';
            while ( $list_query->have_posts() ) {
                $list_query->the_post();
                if ( $post_count == 1 ) {
                    $post_class = 'first-post wow zoomIn';
                    $np_image_size = 'news-portal-block-large';
                } else {
                    $post_class = 'wow fadeInLeft';
                    $np_image_size = 'news-portal-list-medium';
                }
                if ( $post_count == 1 ) {
                    $wow_delay = 0.3;
                } else {
                    $wow_delay = $wow_delay+0.1;
                }
    ?>
                <div class="np-single-post <?php echo esc_attr( $post_class ); ?> np-clearfix <?php news_portal_post_format_icon(); ?>" data-wow-duration="0.5s" data-wow-delay="<?php echo esc_attr( $wow_delay ); ?>s">
                    <div class="np-post-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <figure><?php news_portal_widget_featured_image( $np_image_size ); ?></figure>
                        </a>
                    </div><!-- .np-post-thumb -->
                    <div class="np-post-content">
                        <?php
                            if ( $cats_list_option == 'show' ) {
                                news_portal_post_categories_list();
                            }
                        ?>
                        <?php if ( $post_count == 1 ) { ?>
                            <h2 class="np-post-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                        <?php } else { ?>
                            <h3 class="np-post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php } ?>
                        <div class="np-post-meta">
                            <?php
                                news_portal_posted_on();
                                news_portal_post_comment();
                                if ( $post_count > 1 ) {
                                    do_action( 'np_widget_post_review' );
                                }
                            ?>
                        </div>
                        <?php if ( $post_count > 1 ) { ?>
                            <div class="np-post-excerpt"><?php the_excerpt(); ?></div>
                        <?php } ?>
                    </div><!-- .np-post-content -->
                </div><!-- .np-single-post -->
    <?php
                $post_count++;
            }
            echo '</div><!-- .np-list-posts-wrapper -->';
        }
        wp_reset_postdata();
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * List Posts Layout Two
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_list_second_layout_section' ) ) :

    function news_portal_list_second_layout_section( $list_args, $cats_list_option ) {
        $list_query = new WP_Query( $list_args );
        if ( $list_query->have_posts() ) {
            $wow_delay = 0;
            $post_count = 1;
            echo '<div class="np-list-posts-wrapper">';
            while ( $list_query->have_posts() ) {
                $list_query->the_post();
                if ( $post_count == 1 ) {
                    $wow_delay = 0.3;
                } else {
                    $wow_delay = $wow_delay+0.1;
                }
    ?>
                <div class="np-single-post np-clearfix wow fadeInUp <?php news_portal_post_format_icon(); ?>" data-wow-duration="0.5s" data-wow-delay="<?php echo esc_attr( $wow_delay ); ?>s">
                    <div class="np-post-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <figure><?php news_portal_widget_featured_image( 'news-portal-list-medium' ); ?></figure>
                        </a>
                    </div><!-- .np-post-thumb -->
                    <div class="np-post-content">
                        <?php
                            if ( $cats_list_option == 'show' ) {
                                news_portal_post_categories_list();
                            }
                        ?>
                        <h3 class="np-post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="np-post-meta">
                            <?php
                                news_portal_posted_on();
                                news_portal_post_comment();
                                do_action( 'np_widget_post_review' );
                            ?>
                        </div>
                        <div class="np-post-excerpt"><?php the_excerpt(); ?></div>
                    </div><!-- .np-post-content -->
                </div><!-- .np-single-post -->
    <?php
            $post_count++;
            }
            echo '</div><!-- .np-list-posts-wrapper -->';
        }
        wp_reset_postdata();
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * List Posts Layout Three
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_list_third_layout_section' ) ) :

    function news_portal_list_third_layout_section( $list_args ) {
        $list_query = new WP_Query( $list_args );
        $total_posts_count = $list_query->post_count;
        if ( $list_query->have_posts() ) {
            $post_count = 1;
            $wow_delay = 0;
            echo '<div class="np-list-posts-wrapper col-2">';
            while ( $list_query->have_posts() ) {
                $list_query->the_post();
                if ( $post_count%2 == 1 ) {
                    $wow_delay = $wow_delay+0.2;
                    echo '<div class="np-single-posts-wrapper wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="'. esc_attr( $wow_delay ) .'s">';
                }
    ?>
                <div class="np-single-post np-clearfix wow fadeInUp <?php news_portal_post_format_icon(); ?>" data-wow-duration="0.5s" data-wow-delay="<?php echo esc_attr( $wow_delay ); ?>s">
                    <div class="np-post-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <figure><?php news_portal_widget_featured_image( 'news-portal-block-thumb' ); ?></figure>
                        </a>
                    </div><!-- .np-post-thumb -->
                    <div class="np-post-content">
                        <h3 class="np-post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="np-post-meta">
                            <?php
                                news_portal_posted_on();
                                news_portal_post_comment();
                                do_action( 'np_widget_post_review' );
                            ?>
                        </div>
                    </div><!-- .np-post-content -->
                </div><!-- .np-single-post -->
    <?php
            if ( $post_count%2 == 0 || $post_count == $total_posts_count ) {
                echo '</div><!-- .np-single-posts-wrapper -->';
            }
            $post_count++;
            }
            echo '</div><!-- .np-list-posts-wrapper -->';
        }
        wp_reset_postdata();
    }

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * List Posts Layout Four
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'news_portal_list_forth_layout_section' ) ) :

    function news_portal_list_forth_layout_section( $list_args, $cats_list_option ) {
        $list_query = new WP_Query( $list_args );
        if ( $list_query->have_posts() ) {
            $post_count = 1;
            $wow_delay = 0;
            echo '<div class="np-list-posts-wrapper alternate-img">';
            while ( $list_query->have_posts() ) {
                $list_query->the_post();
                if ( $post_count == 1 ) {
                    $wow_delay = 0.3;
                } else {
                    $wow_delay = $wow_delay+0.1;
                }
    ?>
                <div class="np-single-post np-clearfix wow fadeInUp <?php news_portal_post_format_icon(); ?>" data-wow-duration="0.5s" data-wow-delay="<?php echo esc_attr( $wow_delay ); ?>s">
                    <div class="np-post-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <figure><?php news_portal_widget_featured_image( 'news-portal-list-medium' ); ?></figure>
                        </a>
                    </div><!-- .np-post-thumb -->
                    <div class="np-post-content">
                        <?php
                            if ( $cats_list_option == 'show' ) {
                                news_portal_post_categories_list();
                            }
                        ?>
                        <h3 class="np-post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="np-post-meta">
                            <?php
                                news_portal_posted_on();
                                news_portal_post_comment();
                                do_action( 'np_widget_post_review' );
                            ?>
                        </div>
                        <div class="np-post-excerpt"><?php the_excerpt(); ?></div>
                    </div><!-- .np-post-content -->
                </div><!-- .np-single-post -->
    <?php
            $post_count++;
            }
            echo '</div><!-- .np-list-posts-wrapper -->';
        }
        wp_reset_postdata();
    }

endif;