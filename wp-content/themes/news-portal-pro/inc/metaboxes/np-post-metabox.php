<?php
/**
 * Create a metabox to added some custom filed in posts.
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

 add_action( 'add_meta_boxes', 'news_portal_post_meta_options' );
 
 if ( ! function_exists( 'news_portal_post_meta_options' ) ) :

     function  news_portal_post_meta_options() {
        add_meta_box(
            'news_portal_post_meta',
            esc_html__( 'Post Meta Options', 'news-portal-pro' ),
            'news_portal_post_meta_callback',
            'post',
            'normal',
            'high'
        );
     }

 endif;

$news_portal_post_sidebar_options = array(
    'default-sidebar' => array(
        'id'		=> 'post-defalut-sidebar',
        'value'     => 'default_sidebar',
        'label'     => esc_html__( 'Default Sidebar', 'news-portal-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/default-sidebar.png'
    ),
    'left-sidebar' => array(
        'id'		=> 'post-right-sidebar',
        'value'     => 'left_sidebar',
        'label'     => esc_html__( 'Left sidebar', 'news-portal-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png'
    ),
    'right-sidebar' => array(
        'id'		=> 'post-left-sidebar',
        'value'     => 'right_sidebar',
        'label'     => esc_html__( 'Right sidebar', 'news-portal-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png'
    ),
    'no-sidebar' => array(
        'id'		=> 'post-no-sidebar',
        'value'     => 'no_sidebar',
        'label'     => esc_html__( 'No sidebar Full width', 'news-portal-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png'
    ),
    'no-sidebar-center' => array(
        'id'		=> 'post-no-sidebar-center',
        'value'     => 'no_sidebar_center',
        'label'     => esc_html__( 'No sidebar Content Centered', 'news-portal-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar-center.png'
    )
);

$news_portal_post_layout_options = array(
    'default-layout' => array(
        'id'        => 'post-defalut-layout',
        'value'     => 'default_layout',
        'label'     => esc_html__( 'Default Layout', 'news-portal-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/default-layout.jpg'
    ),
    'layout1' => array(
        'id'        => 'post-layout1',
        'value'     => 'layout1',
        'label'     => esc_html__( 'Layout 1', 'news-portal-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/post-layout-1.jpg'
    ),
    'layout2' => array(
        'id'        => 'post-layout2',
        'value'     => 'layout2',
        'label'     => __( 'Layout 2', 'news-portal-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/post-layout-2.jpg'
    ),
    'layout3' => array(
        'id'        => 'post-layout3',
        'value'     => 'layout3',
        'label'     => esc_html__( 'Layout 3', 'news-portal-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/post-layout-3.jpg'
    ),
    'layout4' => array(
        'id'        => 'post-layout4',
        'value'     => 'layout4',
        'label'     => esc_html__( 'Layout 4', 'news-portal-pro' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/post-layout-4.jpg'
    )
);

$post_review_type = array(
    'no_review'      => esc_html__( 'No Review', 'news-portal-pro' ),
    'star_review'    => esc_html__( 'Star Review', 'news-portal-pro' ),
    'percent_review' => esc_html__( 'Percentage Review', 'news-portal-pro' )
);

$post_star_review = array(
    '5'     => esc_html__( '5 Stars', 'news-portal-pro' ),
    '4.5'   => esc_html__( '4.5 Stars', 'news-portal-pro' ),
    '4'     => esc_html__( '4 Stars', 'news-portal-pro' ),
    '3.5'   => esc_html__( '3.5 Stars', 'news-portal-pro' ),
    '3'     => esc_html__( '3 Stars', 'news-portal-pro' ),
    '2.5'   => esc_html__( '2.5 Stars', 'news-portal-pro' ),
    '2'     => esc_html__( '2 Stars', 'news-portal-pro' ),
    '1.5'   => esc_html__( '1.5 Stars', 'news-portal-pro' ),
    '1'     => esc_html__( '1 Stars', 'news-portal-pro' ),
    '0.5'   => esc_html__( '0.5 Stars', 'news-portal-pro' )
);

/**
 * Callback function for post option
 */
if ( ! function_exists( 'news_portal_post_meta_callback' ) ) :

	function news_portal_post_meta_callback() {
		global $post, $news_portal_post_sidebar_options, $news_portal_post_layout_options, $post_review_type, $post_star_review;

        $get_post_meta_identity = get_post_meta( $post->ID, 'post_meta_identity', true );
        $post_identity_value = empty( $get_post_meta_identity ) ? 'np-metabox-info' : $get_post_meta_identity;

        $get_review_option = get_post_meta( $post->ID, 'post_review_option', true );
        $post_review_option_value = empty( $get_review_option ) ? 'no_review' : $get_review_option;

        $star_rating = get_post_meta( $post->ID, 'star_rating', true );
        $star_review_count = get_post_meta( $post->ID, 'star_review_count', true );

        $percent_rating = get_post_meta( $post->ID, 'percent_rating', true );
        $percent_review_count = get_post_meta( $post->ID, 'percent_review_count', true );

        $np_get_review_description = get_post_meta( $post->ID, 'post_review_description', true );

        $post_gallery_images = get_post_meta( $post->ID, 'post_images', true );
        $post_images_count = get_post_meta( $post->ID, 'post_gallery_image_count', true );

        $get_post_video = get_post_meta( $post->ID, 'post_featured_video', true );

        $get_post_audio = get_post_meta( $post->ID, 'post_embed_audio', true );

		wp_nonce_field( basename( __FILE__ ), 'news_portal_post_meta_nonce' );
?>
		<div class="np-meta-container np-clearfix">
			<ul class="np-meta-menu-wrapper">
				<li class="np-meta-tab <?php if ( $post_identity_value == 'np-metabox-info' ) { echo 'active'; } ?>" data-tab="np-metabox-info"><span class="dashicons dashicons-clipboard"></span><?php esc_html_e( 'Information', 'news-portal-pro' ); ?></li>
				<li class="np-meta-tab <?php if ( $post_identity_value == 'np-metabox-sidebar' ) { echo 'active'; } ?>" data-tab="np-metabox-sidebar"><span class="dashicons dashicons-exerpt-view"></span><?php esc_html_e( 'Sidebars', 'news-portal-pro' ); ?></li>
                <li class="np-meta-tab <?php if ( $post_identity_value == 'np-metabox-layout' ) { echo 'active'; } ?>" data-tab="np-metabox-layout"><span class="dashicons dashicons-layout"></span><?php esc_html_e( 'Layouts', 'news-portal-pro' ); ?></li>
                <li class="np-meta-tab <?php if ( $post_identity_value == 'np-metabox-review' ) { echo 'active'; } ?>" data-tab="np-metabox-review"><span class="dashicons dashicons-star-half"></span><?php esc_html_e( 'Reviews', 'news-portal-pro' ); ?></li>
                <li class="np-meta-tab np-format-meta-tab <?php if ( $post_identity_value == 'np-metabox-gallery' ) { echo 'active'; } ?>" id="np-meta-tab-gallery" data-tab="np-metabox-gallery"><span class="dashicons dashicons-format-gallery"></span><?php esc_html_e( 'Gallery Format', 'news-portal-pro' ); ?></li>
                <li class="np-meta-tab np-format-meta-tab <?php if ( $post_identity_value == 'np-metabox-video' ) { echo 'active'; } ?>" id="np-meta-tab-video" data-tab="np-metabox-video"><span class="dashicons dashicons-format-video"></span><?php esc_html_e( 'Video Format', 'news-portal-pro' ); ?></li>
                <li class="np-meta-tab np-format-meta-tab <?php if ( $post_identity_value == 'np-metabox-audio' ) { echo 'active'; } ?>" id="np-meta-tab-audio" data-tab="np-metabox-audio"><span class="dashicons dashicons-format-audio"></span><?php esc_html_e( 'Audio Format', 'news-portal-pro' ); ?></li>
			</ul><!-- .np-meta-menu-wrapper -->
			<div class="np-metabox-content-wrapper">
				
				<!-- Info tab content -->
				<div class="np-single-meta <?php if ( $post_identity_value == 'np-metabox-info' ) { echo 'active'; } ?>" id="np-metabox-info">
					<div class="content-header">
						<h4><?php esc_html_e( 'About Metabox Options', 'news-portal-pro' ) ;?></h4>
					</div><!-- .content-header -->
					<div class="meta-options-wrap"><?php esc_html_e( 'In this section we have lots of features which make your post unique and completely different.', 'news-portal-pro' ); ?></div><!-- .meta-options-wrap  -->
				</div><!-- #np-metabox-info -->

				<!-- Sidebar tab content -->
				<div class="np-single-meta" id="np-metabox-sidebar">
					<div class="content-header">
						<h4><?php esc_html_e( 'Available Sidebars', 'news-portal-pro' ) ;?></h4>
						<span class="section-desc"><em><?php esc_html_e( 'Select sidebar from available options which replaced sidebar layout from customizer settings.', 'news-portal-pro' ); ?></em></span>
					</div><!-- .content-header -->
					<div class="np-meta-options-wrap">
						<div class="buttonset">
							<?php
			                   	foreach ( $news_portal_post_sidebar_options as $field ) {
			                    	$news_portal_post_sidebar = get_post_meta( $post->ID, 'single_post_sidebar', true );
                                    $news_portal_post_sidebar = ( $news_portal_post_sidebar ) ? $news_portal_post_sidebar : 'default_sidebar';
			                ?>
			                    	<input type="radio" id="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" name="single_post_sidebar" <?php checked( $field['value'], $news_portal_post_sidebar ); ?> />
			                    	<label for="<?php echo esc_attr( $field['id'] ); ?>">
			                    		<span class="screen-reader-text"><?php echo esc_html( $field['label'] ); ?></span>
			                    		<img src="<?php echo esc_url( $field['thumbnail'] ); ?>" title="<?php echo esc_attr( $field['label'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
			                    	</label>
			                    
			                <?php } ?>
						</div><!-- .buttonset -->
					</div><!-- .meta-options-wrap  -->
				</div><!-- #np-metabox-sidebar -->

                <!-- Layouts tab content -->
                <div class="np-single-meta" id="np-metabox-layout">
                    <div class="content-header">
                        <h4><?php esc_html_e( 'Available Layouts', 'news-portal-pro' ) ;?></h4>
                        <span class="section-desc"><em><?php esc_html_e( 'Select post layout from available options which replaced post layout from customizer settings.', 'news-portal-pro' ); ?></em></span>
                    </div><!-- .content-header -->
                    <div class="np-meta-options-wrap">
                        <div class="buttonset">
                            <?php
                                foreach ( $news_portal_post_layout_options as $field ) {
                                    $news_portal_post_layout = get_post_meta( $post->ID, 'single_post_layout', true );
                                    $news_portal_post_layout = ( $news_portal_post_layout ) ? $news_portal_post_layout : 'default_layout';
                            ?>
                                    <input type="radio" id="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" name="single_post_layout" <?php checked( $field['value'], $news_portal_post_layout ); ?> />
                                    <label for="<?php echo esc_attr( $field['id'] ); ?>">
                                        <span class="screen-reader-text"><?php echo esc_html( $field['label'] ); ?></span>
                                        <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" title="<?php echo esc_attr( $field['label'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
                                    </label>
                                
                            <?php } ?>
                        </div><!-- .buttonset -->
                    </div><!-- .meta-options-wrap -->
                </div><!-- #np-metabox-layout -->

                <!-- Reviews tab content -->
                <div class="np-single-meta" id="np-metabox-review">
                    <div class="np-meta-options-wrap np-meta-review-wrap">
                        <div class="np-review-type">
                            <h4><?php esc_html_e( 'Review Type', 'news-portal-pro' ) ;?></h4>
                            
                            <div class="type-selector">
                                <select id="selectReview" name="post_review_option" class="np-meta-dropdown">
                                    <?php foreach( $post_review_type as $post_review => $post_review_label ) { ?>
                                        <option value="<?php echo esc_attr( $post_review ); ?>" <?php selected( $post_review_option_value, $post_review ); ?>><?php echo esc_html( $post_review_label ); ?></option>
                                    <?php } ?>
                                </select>
                            </div><!-- .type-selector -->

                            <div id="type-star_review" class="review-types">
                                <div class="star-review-label review-title"><strong><?php esc_html_e( 'Add star ratings for this post :', 'news-portal-pro' ); ?></strong></div>
                                <div class="post-review-section star-section">
                                    <?php
                                        $count = 0;
                                        if ( !empty( $star_rating ) ){
                                            foreach ( $star_rating as $rate_value ) {
                                                if ( !empty( $rate_value['feature_name'] ) || !empty( $rate_value['feature_star'] ) ) {
                                                $count++;
                                    ?>

                                    <div class="review-section-group star-group">
                                        <span class="custom-label"><?php esc_html_e( 'Feature Name:', 'news-portal-pro' ); ?></span>
                                        <input style="width: 300px;" type="text" name="star_ratings[<?php echo absint( $count ); ?>][feature_name]" value="<?php echo esc_attr( $rate_value['feature_name'] ); ?>"/>
                                        <select name="star_ratings[<?php echo absint( $count ); ?>][feature_star]">
                                            <option value=""><?php esc_html_e( 'Select rating', 'news-portal-pro' ); ?></option>
                                            <?php foreach ( $post_star_review as $key => $value ) { ?>
                                                    <option value="<?php echo esc_attr( $key ); ?>"<?php selected( $rate_value['feature_star'], $key ); ?>><?php echo esc_html( $value ); ?></option>
                                            <?php } ?>
                                        </select>
                                        <a href="#" class="delete-review-stars dlt-btn button"><?php esc_html_e( 'Delete', 'news-portal-pro' ); ?></a>
                                    </div><!-- .review-section-group -->
                                    <?php
                                                }
                                            } 
                                        } else {
                                    ?>
                                            <div class="review-section-group star-group">
                                                <span class="custom-label"><?php esc_html_e( 'Feature Name:', 'news-portal-pro' ); ?></span>
                                                <input style="width: 300px;" type="text" name="star_ratings[<?php echo absint( $count ); ?>][feature_name]" value=""/>
                                                <select name="star_ratings[<?php echo absint( $count ); ?>][feature_star]">
                                                    <option value=""><?php esc_html_e( 'Select rating', 'news-portal-pro' ); ?></option>
                                                    <?php foreach ( $post_star_review as $key => $value ) { ?>
                                                            <option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
                                                    <?php } ?>
                                                </select>
                                                <a href="#" class="delete-review-stars dlt-btn button"><?php esc_html_e( 'Delete', 'news-portal-pro' ); ?></a>
                                            </div><!-- .review-section-group -->
                                    <?php
                                        }
                                    ?>
                                </div><!-- .post-review-section.star-section -->
                                <input id="post_star_review_count" type="hidden" name="star_review_count" value="<?php echo absint( $count ); ?>" />
                                <a href="#" class="add-review-stars add-review-btn button"><?php esc_html_e( 'Add rating category', 'news-portal-pro' );?></a>
                            </div><!-- #type-star_review -->

                            <div id="type-percent_review" class="review-types">
                                <div class="percent-review-label review-title"><strong><?php esc_html_e( 'Add Percentage ratings for this post :', 'news-portal-pro' ); ?></strong></div>
                                <div class="post-review-section percent-section">
                                    <?php 
                                        $p_count = 0;
                                        if ( !empty( $percent_rating ) ) {
                                            foreach ( $percent_rating as $key => $value ) {
                                                $p_count++;
                                    ?>
                                            <div class="review-section-group percent-group">
                                                <span class="custom-label"><?php esc_html_e( 'Feature Name:', 'news-portal-pro' ); ?></span>
                                                    <input style="width: 300px;" type="text" name="percent_ratings[<?php echo absint( $p_count ); ?>][feature_name]" value="<?php echo esc_html( $value['feature_name'] ); ?>"/>
                                                <span class="opt-sep"><?php esc_html_e( 'Percent: ', 'news-portal-pro' ); ?></span>
                                                <input style="width: 100px;" type="number" min="1" max="100" name="percent_ratings[<?php echo absint( $p_count ); ?>][feature_percent]" value="<?php echo intval( $value['feature_percent'] ); ?>" step="1"/>
                                                <a href="#" class="delete-review-percents dlt-btn button"><?php esc_html_e( 'Delete', 'news-portal-pro' ); ?></a>
                                            </div><!-- .review-section-group -->
                                    <?php 
                                            }
                                        } else {
                                    ?>
                                            <div class="review-section-group percent-group">
                                                <span class="custom-label"><?php esc_html_e( 'Feature Name:', 'news-portal-pro' ); ?></span>
                                                    <input style="width: 300px;" type="text" name="percent_ratings[<?php echo absint( $p_count ); ?>][feature_name]" value=""/>
                                                <span class="opt-sep"><?php esc_html_e( 'Percent: ', 'news-portal-pro' ); ?></span>
                                                <input style="width: 100px;" type="number" min="1" max="100" name="percent_ratings[<?php echo absint( $p_count ); ?>][feature_percent]" value="" step="1"/>
                                                <a href="#" class="delete-review-percents dlt-btn button"><?php esc_html_e( 'Delete', 'news-portal-pro' ); ?></a>
                                            </div><!-- .review-section-group -->
                                    <?php
                                        }
                                    ?>
                                </div><!-- .post-review-section.percent-section -->
                                <input id="post_percent_review_count" type="hidden" name="percent_review_count" value="<?php echo absint( $p_count ); ?>" />
                                <a href="#" class="add-review-percents add-review-btn button"><?php esc_html_e( 'Add rating category', 'news-portal-pro' ); ?></a>
                            </div><!-- #type-percentage_review -->

                        </div><!-- .np-review-type -->
                        <div class="post-review-summary">
                            <div class="review-title"><strong><?php esc_html_e( 'Review description:', 'news-portal-pro' );?></strong></div>
                            <p class="review-textarea">
                                <textarea row="5" name="post_review_description"><?php echo wp_kses_post( $np_get_review_description ); ?></textarea>
                            </p>
                        </div><!-- .post-review-desc -->
                    </div><!-- .np-meta-options-wrap -->
			    </div><!-- #np-metabox-review -->

                <!-- post format gallery tab content -->
                <div class="np-single-meta np-format-wrap" id="np-metabox-gallery">
                    <div class="content-header">
                        <h4><?php esc_html_e( 'Gallery Images', 'news-portal-pro' ) ;?></h4>
                        <span class="section-desc"><em><?php esc_html_e( 'Add multiple images for post format gallery.', 'news-portal-pro' ); ?></em></span>
                    </div><!-- .content-header -->
                    <div class="np-meta-options-wrap">
                        <div class="format-input">
                            <div class="post-gallery-section">
                                <?php
                                    $total_img = 0;
                                    if ( !empty( $post_gallery_images ) ){
                                        $total_img = count( $post_gallery_images );
                                        $img_counter = 0;
                                        foreach( $post_gallery_images as $key => $img_value ){
                                           $attachment_id = news_portal_get_image_id_from_url( $img_value );
                                           $img_url = wp_get_attachment_image_src( $attachment_id, 'thumbnail', true );
                                ?>
                                            <div class="gal-img-block">
                                                <div class="gal-img"><img src="<?php echo esc_url( $img_url[0] ); ?>" /><span class="fig-remove" title="<?php echo esc_attr( 'remove', 'news-portal-pro' ); ?>"></span></div>
                                                <input type="hidden" name="post_images[<?php echo absint( $img_counter ); ?>]" class="hidden-media-gallery" value="<?php echo esc_url( $img_value ); ?>" />
                                            </div>
                                <?php
                                            $img_counter++;
                                        }
                                    }
                                ?>
                            </div><!-- .post-gallery-section -->
                            <input id="post_image_count" type="hidden" name="post_gallery_image_count" value="" />
                            <span class="add-img-btn" id="post_gallery_upload_button" title="<?php esc_html_e( 'Add Images', 'news-portal-pro' ); ?>"></span>
                        </div><!-- .format-input -->
                    </div><!-- .meta-options-wrap -->
                </div><!-- #np-metabox-gallery -->

                <!-- post format video tab content -->
                <div class="np-single-meta np-format-wrap" id="np-metabox-video">
                    <div class="np-meta-options-wrap">
                        <div class="format-input">
                            <div class="format-input">
                                <input type="text" name="post_featured_video" size="90" class="post-featured-video" value="<?php echo esc_url( $get_post_video ); ?>" />
                                <input class="button" type="button" id="reset-video-embed" value="<?php esc_html_e( 'Reset video url ', 'news-portal-pro' ) ;?>" />
                            </div><!-- .format-input -->
                            <span><em><?php esc_html_e( 'Paste a video link from Youtube, Vimeo it will be embedded in the post and the thumb used as the featured image of this post. ', 'news-portal-pro' ); ?></em></span>
                        </div><!-- .format-input -->
                    </div><!-- .meta-options-wrap -->
                </div><!-- #np-metabox-video -->

                <!-- post format audio tab content -->
                <div class="np-single-meta np-format-wrap" id="np-metabox-audio">
                    <div class="np-meta-options-wrap">
                        <div class="format-input">
                            <input type="text" name="post_embed_audio" size="90" class="post-audio-url" value="<?php echo esc_url( $get_post_audio ); ?>" />
                            <input class="button" name="media_upload_button" id="post_audio_upload_button" value="<?php esc_html_e( 'Embed audio', 'news-portal-pro' ); ?>" type="button" />
                            <input class="button" type="button" id="reset-audio-embed" value="<?php esc_html_e( 'Reset url', 'news-portal-pro' ); ?>" />
                        </div><!-- .format-input -->
                    </div><!-- .meta-options-wrap -->
                </div><!-- #np-metabox-audio -->

            <div class="clear"></div>
            <input type="hidden" id="post-meta-selected" name="post_meta_identity" value="<?php echo esc_attr( $post_identity_value ); ?>" />
            </div><!-- .np-metabox-content-wrapper -->
		</div><!-- .np-meta-container -->
<?php
	}

endif;

/*--------------------------------------------------------------------------------------------------------------*/
/**
 * Function for save value of meta opitons
 *
 * @since 1.0.0
 */
add_action( 'save_post', 'news_portal_save_post_meta' );

if ( ! function_exists( 'news_portal_save_post_meta' ) ) :

    function news_portal_save_post_meta( $post_id ) {

        global $post;

        // Verify the nonce before proceeding.
        $news_portal_post_nonce   = isset( $_POST['news_portal_post_meta_nonce'] ) ? $_POST['news_portal_post_meta_nonce'] : '';
        $news_portal_post_nonce_action = basename( __FILE__ );

        //* Check if nonce is set...
        if ( ! isset( $news_portal_post_nonce ) ) {
            return;
        }

        //* Check if nonce is valid...
        if ( ! wp_verify_nonce( $news_portal_post_nonce, $news_portal_post_nonce_action ) ) {
            return;
        }

        //* Check if user has permissions to save data...
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

        //* Check if not an autosave...
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }

        //* Check if not a revision...
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

        /**
         * Post sidebar
         */
        $post_sidebar = get_post_meta( $post_id, 'single_post_sidebar', true ); 
        $stz_post_sidebar = sanitize_text_field( $_POST['single_post_sidebar'] );

        if ( $stz_post_sidebar && $stz_post_sidebar != $post_sidebar ) {  
            update_post_meta ( $post_id, 'single_post_sidebar', $stz_post_sidebar );  
        } elseif ( '' == $stz_post_sidebar && $post_sidebar ) {  
            delete_post_meta( $post_id,'single_post_sidebar', $post_sidebar );  
        }

        /**
         * Post layout
         */
        $post_layout = get_post_meta( $post_id, 'single_post_layout', true ); 
        $stz_post_layout = sanitize_text_field( $_POST['single_post_layout'] );

        if ( $stz_post_layout && $stz_post_layout != $post_layout ) {  
            update_post_meta ( $post_id, 'single_post_layout', $stz_post_layout );  
        } elseif ( '' == $stz_post_layout && $post_layout ) {  
            delete_post_meta( $post_id,'single_post_layout', $post_layout );  
        }

        /**
         * post meta identity
         */
        $post_identity = get_post_meta( $post_id, 'post_meta_identity', true );
        $stz_post_identity = sanitize_text_field( $_POST[ 'post_meta_identity' ] );

        if ( $stz_post_identity && '' == $stz_post_identity ){
            add_post_meta( $post_id, 'post_meta_identity', $stz_post_identity );
        } elseif ( $stz_post_identity && $stz_post_identity != $post_identity ) {
            update_post_meta($post_id, 'post_meta_identity', $stz_post_identity );
        } elseif ( '' == $stz_post_identity && $post_identity ) {
            delete_post_meta( $post_id, 'post_meta_identity', $post_identity );
        }

        /**
         * update post review option
         */
        $post_review_option = get_post_meta( $post_id, 'post_review_option', true );
        $stz_post_review_option = sanitize_text_field( $_POST[ 'post_review_option' ] );

        if ( $stz_post_review_option && '' == $stz_post_review_option ){
            add_post_meta( $post_id, 'post_review_option', $stz_post_review_option );
        } elseif ( $stz_post_review_option && $stz_post_review_option != $post_review_option ) {  
            update_post_meta($post_id, 'post_review_option', $stz_post_review_option );  
        } elseif ( '' == $stz_post_review_option && $post_review_option ) {  
            delete_post_meta( $post_id,'post_review_option', $post_review_option );  
        }

        if ( $stz_post_review_option == 'star_review' ) {
            /**
             * update all data of star review
             */
            $stz_star_rating = $_POST['star_ratings'];
            update_post_meta( $post_id, 'star_rating', $stz_star_rating );

            /**
             * update data for star count
             */    
            $star_review_count = get_post_meta( $post_id, 'star_review_count', true );
            $stz_star_review_count = sanitize_text_field( $_POST[ 'star_review_count' ] );

            if ( $stz_star_review_count && '' == $stz_star_review_count ){
                add_post_meta( $post_id, 'star_review_count', $stz_star_review_count );
            } elseif ( $stz_star_review_count && $stz_star_review_count != $star_review_count ) {
                update_post_meta($post_id, 'star_review_count', $stz_star_review_count );
            } elseif ( '' == $stz_star_review_count && $star_review_count ) {
                delete_post_meta( $post_id, 'star_review_count', $star_review_count );
            }
        }

        if ( $stz_post_review_option == 'percent_review' ) {
            /**
             * update all data of percentage review
             */
            $stz_percent_rating = $_POST['percent_ratings'];
            update_post_meta( $post_id, 'percent_rating', $stz_percent_rating );

            /**
             * update data for percent count
             */
            $percent_review_count = get_post_meta( $post_id, 'percent_review_count', true );
            $stz_percent_review_count = sanitize_text_field( $_POST[ 'percent_review_count' ] );

            if ( $stz_percent_review_count && '' == $stz_percent_review_count ){
                add_post_meta( $post_id, 'percent_review_count', $stz_percent_review_count );
            } elseif ( $stz_percent_review_count && $stz_percent_review_count != $percent_review_count ) {
                update_post_meta($post_id, 'percent_review_count', $stz_percent_review_count );
            } elseif ( '' == $stz_percent_review_count && $percent_review_count ) {
                delete_post_meta( $post_id, 'percent_review_count', $percent_review_count );
            }
        }


        /**
         * update review summary
         */
        $post_review_description = get_post_meta( $post_id, 'post_review_description', true );
        $stz_review_description = wp_kses_post( $_POST[ 'post_review_description' ] );

        if ( $stz_review_description && '' == $stz_review_description ){
            add_post_meta( $post_id, 'post_review_description', $stz_review_description );
        } elseif ( $stz_review_description && $stz_review_description != $post_review_description ) {  
            update_post_meta($post_id, 'post_review_description', $stz_review_description );  
        } elseif ( '' == $stz_review_description && $post_review_description ) {  
            delete_post_meta( $post_id, 'post_review_description', $post_review_description );  
        }

        /**
         * update data for embed gallery
         */
        if ( isset( $_POST['post_images'] ) ) {
            $stz_post_image = $_POST['post_images'];
            update_post_meta( $post_id, 'post_images', $stz_post_image );

            $image_count = get_post_meta( $post_id, 'post_gallery_image_count', true );
            $stz_image_count = intval( $_POST['post_gallery_image_count'] );
           
            if ( $stz_image_count && '' == $stz_image_count ){
                add_post_meta( $post_id, 'post_gallery_image_count', $stz_image_count );
            } elseif ($stz_image_count && $stz_image_count != $image_count) {
                update_post_meta($post_id, 'post_gallery_image_count', $stz_image_count);
            } elseif ('' == $stz_image_count && $image_count) {
                delete_post_meta($post_id,'post_gallery_image_count');
            }
        }

        /**
         * update data for featured video
         */ 
        if ( isset( $_POST['post_featured_video'] ) ) {
               
            $post_featured_video = get_post_meta( $post_id, 'post_featured_video', true );
            $stz_post_featured_video = esc_url_raw( $_POST[ 'post_featured_video' ] );

            if ( $stz_post_featured_video && '' == $stz_post_featured_video ){
                add_post_meta( $post_id, 'post_featured_video', $stz_post_featured_video );
            } elseif ( $stz_post_featured_video && $stz_post_featured_video != $post_featured_video ) {
                update_post_meta($post_id, 'post_featured_video', $stz_post_featured_video );
            } elseif ( '' == $stz_post_featured_video && $post_featured_video ) {
                delete_post_meta( $post_id, 'post_featured_video', $post_featured_video );
            }

        }

        /**
         * update data for embed audio
         */ 
        if ( isset( $_POST['post_embed_audio'] ) ) {
               
            $post_embed_audio = get_post_meta( $post_id, 'post_embed_audio', true );
            $stz_post_embed_audio = esc_url_raw( $_POST[ 'post_embed_audio' ] );

            if ( $stz_post_embed_audio && '' == $stz_post_embed_audio ){
                add_post_meta( $post_id, 'post_embed_audio', $stz_post_embed_audio );
            } elseif ( $stz_post_embed_audio && $stz_post_embed_audio != $post_embed_audio ) {
                update_post_meta($post_id, 'post_embed_audio', $stz_post_embed_audio );
            } elseif ( '' == $stz_post_embed_audio && $post_embed_audio ) {
                delete_post_meta( $post_id, 'post_embed_audio', $post_embed_audio );
            }

        }
    }

endif;