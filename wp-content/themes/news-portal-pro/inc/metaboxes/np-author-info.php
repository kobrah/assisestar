<?php
/**
 * Added extra info field about author
 *
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 *
 */

/**
 * Adds additional user fields
 * more info: http://justintadlock.com/archives/2009/09/10/adding-and-using-custom-user-profile-fields
 */

add_action( 'show_user_profile', 'news_portal_additional_user_fields' );
add_action( 'edit_user_profile', 'news_portal_additional_user_fields' );

function news_portal_additional_user_fields( $user ) { 

	wp_nonce_field( basename( __FILE__ ), 'news_portal_pro_author_meta_nonce' );

	$user_img_url = get_the_author_meta( 'user_meta_image', $user->ID );
	$user_img_id = news_portal_get_image_id_from_url( $user_img_url );
	$user_thumb_img_url = wp_get_attachment_image_src( $user_img_id, 'thumbnail', true );
?>
    <h3><?php esc_html_e( 'Additional User Meta', 'news-portal-pro' ); ?></h3>
    
    <?php
        $image = $image_class = "";
        $author_avatar = get_the_author_meta( 'user_meta_image', $user->ID );
        if ( !empty( $author_avatar ) ) {
            $image = '<img src="'.esc_url( $author_avatar ).'" style="max-width:100%;"/>';    
            $image_class = ' hidden';
        }
    ?>
    <table class="form-table">
        <tr class="user-custom-profile-picture">
            <th><?php esc_html_e( 'Custom Profile Picture', 'news-portal-pro' ); ?></th>
            <td>
                <div class="attachment-media-view">                
                    <div class="placeholder<?php echo esc_attr( $image_class ); ?>">
                        <?php esc_html_e( 'No image selected', 'news-portal-pro' ); ?>
                    </div>
                    <div class="thumbnail thumbnail-image">
                        <?php echo $image; ?>
                    </div>

                    <div class="actions np-clearfix">
                        <button type="button" class="button np-delete-button align-left"><?php esc_html_e( 'Remove', 'news-portal-pro' ); ?></button>
                        <button type="button" class="button np-upload-button alignright"><?php esc_html_e( 'Upload Image', 'news-portal-pro' ); ?></button>
                        
                        <input name="user_meta_image" class="upload-id" type="hidden" value="<?php echo esc_url_raw( $author_avatar ); ?>"/>
                    </div>
                </div>
            </td>
        </tr>
    </table><!-- end form-table -->
<?php } // news_portal_additional_user_fields

/**
* Saves additional user fields to the database
*/
function news_portal_save_additional_user_meta( $user_id ) {

	// Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'news_portal_pro_author_meta_nonce' ] ) || !wp_verify_nonce( $_POST[ 'news_portal_pro_author_meta_nonce' ], basename( __FILE__ ) ) ) {
        return;
    }
 
    // only saves if the current user can edit user profiles
    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
 
    update_user_meta( $user_id, 'user_meta_image', $_POST['user_meta_image'] );
}
 
add_action( 'personal_options_update', 'news_portal_save_additional_user_meta' );
add_action( 'edit_user_profile_update', 'news_portal_save_additional_user_meta' );


$news_portal_user_social_array = array(
    'behance'           => __( 'Behance', 'news-portal-pro' ),
    'delicious'         => __( 'Delicious', 'news-portal-pro' ),
    'deviantart'        => __( 'DeviantArt', 'news-portal-pro' ),
    'digg'              => __( 'Digg', 'news-portal-pro' ),
    'dribbble'          => __( 'Dribbble', 'news-portal-pro' ),
    'facebook'          => __( 'Facebook', 'news-portal-pro' ),
    'flickr'            => __( 'Flickr', 'news-portal-pro' ),
    'github'            => __( 'Github', 'news-portal-pro' ),
    'google-plus'       => __( 'Google+', 'news-portal-pro' ),
    'html5'             => __( 'Html5', 'news-portal-pro' ),
    'instagram'         => __( 'Instagram', 'news-portal-pro' ),    
    'linkedin'          => __( 'LinkedIn', 'news-portal-pro' ),
    'paypal'            => __( 'PayPal', 'news-portal-pro' ),
    'pinterest'         => __( 'Pinterest', 'news-portal-pro' ),
    'reddit'            => __( 'Reddit', 'news-portal-pro' ),
    'rss'               => __( 'RSS', 'news-portal-pro' ),
    'share'             => __( 'Share', 'news-portal-pro' ),
    'skype'             => __( 'Skype', 'news-portal-pro' ),
    'soundcloud'        => __( 'SoundCloud', 'news-portal-pro' ),
    'spotify'           => __( 'Spotify', 'news-portal-pro' ),
    'stack-exchange'    => __( 'StackExchange', 'news-portal-pro' ),
    'stack-overflow'    => __( 'Stackoverflow', 'news-portal-pro' ),
    'steam'             => __( 	'Steam', 'news-portal-pro' ),
    'stumbleupon'       => __( 'StumbleUpon', 'news-portal-pro' ),
    'tumblr'            => __( 'Tumblr', 'news-portal-pro' ),
    'twitter'           => __( 'Twitter', 'news-portal-pro' ),
    'vimeo'             => __( 'Vimeo', 'news-portal-pro' ),
    'vk'                => __( 'VKontakte', 'news-portal-pro' ),
    'windows'           => __( 'Windows', 'news-portal-pro' ),
    'wordpress'         => __( 'WordPress', 'news-portal-pro' ),
    'yahoo'             => __( 'Yahoo', 'news-portal-pro' ),
    'youtube'           => __( 'YouTube', 'news-portal-pro' )
);

add_filter( 'user_contactmethods', 'news_portal_author_meta_contact' );

function news_portal_author_meta_contact() {
    global $news_portal_user_social_array;
    foreach( $news_portal_user_social_array as $icon_id => $icon_name ) {
        $contactmethods[$icon_id] = $icon_name;
    }
    return $contactmethods;
}