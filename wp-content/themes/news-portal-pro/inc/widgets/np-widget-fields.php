<?php
/**
 * Define custom fields for widgets
 * 
 * @package Mystery Themes
 * @subpackage News Portal Pro
 * @since 1.0.0
 */

function news_portal_widgets_show_widget_field( $instance = '', $widget_field = '', $mt_widget_field_value = '' ) {
    
    extract( $widget_field );

    switch ( $news_portal_widgets_field_type ) {

        // Standard text field
        case 'text' :
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>"><?php echo esc_html( $news_portal_widgets_title ); ?></label></span>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $news_portal_widgets_name ) ); ?>" type="text" value="<?php echo esc_html( $mt_widget_field_value ); ?>" />

                <?php if ( isset( $news_portal_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $news_portal_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        case 'np_option_title':
            echo '<p><span class="field-label"><label class="field-title">'. esc_html( $news_portal_widgets_title ) .'</label></span></p>';
            break;

        // Standard url field
        case 'url' :
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>"><?php echo esc_html( $news_portal_widgets_title ); ?></label></span>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $news_portal_widgets_name ) ); ?>" type="text" value="<?php echo esc_url( $mt_widget_field_value ); ?>" />

                <?php if ( isset( $news_portal_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $news_portal_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;
        
        // Checkbox field
        case 'checkbox' :
        ?>
            <p>
                <input id="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $news_portal_widgets_name ) ); ?>" type="checkbox" value="1" <?php checked( '1', $mt_widget_field_value ); ?>/>
                <label for="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>"><?php echo esc_html( $news_portal_widgets_title ); ?></label>

                <?php if ( isset( $news_portal_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $news_portal_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        // Select field
        case 'select' :
            if ( empty( $mt_widget_field_value ) ) {
                $mt_widget_field_value = $news_portal_widgets_default;
            }
        ?>
            <p>
                <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>"><?php echo esc_html( $news_portal_widgets_title ); ?></label></span> 
                <select name="<?php echo esc_attr( $instance->get_field_name( $news_portal_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>" class="widefat">
                    <?php foreach ( $news_portal_widgets_field_options as $athm_option_name => $athm_option_title ) { ?>
                        <option value="<?php echo esc_attr( $athm_option_name ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $athm_option_name ) ); ?>" <?php selected( $athm_option_name, $mt_widget_field_value ); ?>><?php echo esc_html( $athm_option_title ); ?></option>
                    <?php } ?>
                </select>

                <?php if ( isset( $news_portal_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $news_portal_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        case 'switch':
            if ( empty( $mt_widget_field_value ) ) {
                $mt_widget_field_value = $news_portal_widgets_default;
            }
        ?>
            <p><strong><label class="field-title"><?php echo esc_html( $news_portal_widgets_title ); ?></label></strong></p>
            <?php if ( isset( $news_portal_widgets_description ) ) { ?>
                <br />
                <em><?php echo wp_kses_post( $news_portal_widgets_description ); ?></em>
            <?php } ?>
            <div class="wiz_switch_options">
                <?php 
                    foreach ( $news_portal_widgets_field_options as $athm_option_name => $athm_option_title ) {
                        if ( $athm_option_name == $mt_widget_field_value ) {
                            $s_select = '';
                        } else {
                            $s_select = '';
                        }
                        echo '<span class="switch_part '. esc_attr( $athm_option_name ) .' '. esc_attr( $s_select ) .'" data-switch="'. esc_attr( $athm_option_name ).'">'. esc_html( $athm_option_title ) .'</span>';
                    }
                ?>
                <input type="hidden" name="<?php echo esc_attr( $instance->get_field_name( $news_portal_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>" value="<?php echo esc_attr( $mt_widget_field_value ); ?>" />
            </div>
        <?php
            break;

        case 'number' :
            if ( empty( $mt_widget_field_value ) ) {
                $mt_widget_field_value = $news_portal_widgets_default;
            }
        ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>"><?php echo esc_html( $news_portal_widgets_title ); ?></label>
                <input name="<?php echo esc_attr( $instance->get_field_name( $news_portal_widgets_name ) ); ?>" type="number" step="1" min="1" id="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>" value="<?php echo esc_html( $mt_widget_field_value ); ?>" class="small-text" />

                <?php if ( isset( $news_portal_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $news_portal_widgets_description ); ?></em>
                <?php } ?>
            </p>
        <?php
            break;

        case 'range':
            if ( empty( $mt_widget_field_value ) ) {
                $mt_widget_field_value = $news_portal_widgets_default;
            }
        ?>
            <p><span class="range-field-label"><label class="field-title"><?php echo esc_html( $news_portal_widgets_title ); ?></label></span></p>
            <div class="np-range-slider">
                <div class="show-range-value"><?php echo absint( $mt_widget_field_value ); ?></div>
                <div class="range-input" data-defaultvalue="<?php echo absint( $news_portal_widgets_default ); ?>" data-value="<?php echo absint( $mt_widget_field_value ); ?>" data-min="<?php echo absint( $news_portal_widgets_min_value ); ?>" data-max="<?php echo absint( $news_portal_widgets_max_value ); ?>" data-step="<?php echo absint( $news_portal_widgets_step_value ); ?>"></div>
                <input  class="range-input-selector" type="hidden" id="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $news_portal_widgets_name ) ); ?>" value="<?php echo absint( $mt_widget_field_value ); ?>"/>
                
            </div><!-- .np-range-slider -->
        <?php
            break;        

        //Multi checkboxes
        case 'multicheckboxes':
        ?>
            <p><span class="field-label"><label><?php echo esc_html( $news_portal_widgets_title ); ?></label></span></p>
            <ul class="mt-multiple-checkbox">

        <?php    
            foreach ( $news_portal_widgets_field_options as $athm_option_name => $athm_option_title ) {
                if ( isset( $mt_widget_field_value[$athm_option_name] ) ) {
                    $mt_multicheckbox_value = 1;
                } else {
                    $mt_multicheckbox_value = 0;
                }
            ?>
                <div class="mt-single-checkbox">
                    <p>
                        <input id="<?php echo esc_attr( $instance->get_field_name( $news_portal_widgets_name ).'['.$athm_option_name.']' ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $news_portal_widgets_name ).'['.$athm_option_name.']' ); ?>" type="checkbox" value="1" <?php checked( '1', $mt_multicheckbox_value ); ?>/>
                        <label for="<?php echo esc_attr( $instance->get_field_name( $news_portal_widgets_name ).'['.$athm_option_name.']' ); ?>"><?php echo esc_html( $athm_option_title ); ?></label>
                    </p>
                </div><!-- .mt-single-checkbox -->
            <?php
                }
                echo '</ul>';
                if ( isset( $news_portal_widgets_description ) ) {
            ?>
                    <em><?php echo wp_kses_post( $news_portal_widgets_description ); ?></em>
            <?php
                }
            break;

        case 'selector':
            if ( empty( $mt_widget_field_value ) ) {
                $mt_widget_field_value = $news_portal_widgets_default;
            }
        ?>
            <p><span class="field-label"><label class="field-title"><?php echo esc_html( $news_portal_widgets_title ); ?></label></span></p>
        <?php            
            echo '<div class="selector-labels">';
            foreach ( $news_portal_widgets_field_options as $option => $val ){
                $class = ( $mt_widget_field_value == $option ) ? 'selector-selected': '';
                echo '<label class="'.esc_attr( $class ).'" data-val="'.esc_attr( $option ).'">';
                echo '<img src="'.esc_url( $val ).'"/>';
                echo '</label>'; 
            }
            echo '</div>';
            echo '<input data-default="'.esc_attr( $mt_widget_field_value ).'" type="hidden" value="'.esc_attr( $mt_widget_field_value ).'" name="'.esc_attr( $instance->get_field_name( $news_portal_widgets_name ) ).'"/>';
            break;

        case 'upload':
            $image = $image_class = "";
            if ( $mt_widget_field_value ){ 
                $image = '<img src="'.esc_url( $mt_widget_field_value ).'" style="max-width:100%;"/>';
                $image_class = ' hidden';
            }
        ?>
            <div class="attachment-media-view">
                <p><span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>"><?php echo esc_html( $news_portal_widgets_title ); ?>:</label></span></p>
            
                <div class="placeholder<?php echo esc_attr( $image_class ); ?>">
                    <?php esc_html_e( 'No image selected', 'news-portal-pro' ); ?>
                </div>
                <div class="thumbnail thumbnail-image"><?php echo $image; ?></div>

                <div class="actions np-clearfix">
                    <button type="button" class="button np-delete-button align-left"><?php esc_html_e( 'Remove', 'news-portal-pro' ); ?></button>
                    <button type="button" class="button np-upload-button alignright"><?php esc_html_e( 'Select Image', 'news-portal-pro' ); ?></button>
                    <input name="<?php echo esc_attr( $instance->get_field_name( $news_portal_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $news_portal_widgets_name ) ); ?>" class="upload-id" type="hidden" value="<?php echo esc_url( $mt_widget_field_value ) ?>"/>
                </div>

                <?php if ( isset( $news_portal_widgets_description ) ) { ?>
                    <br />
                    <em><?php echo wp_kses_post( $news_portal_widgets_description ); ?></em>
                <?php } ?>

            </div>
        <?php
            break;
    }
}

function news_portal_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );
    
    if ( $news_portal_widgets_field_type == 'number') {
        return intval( $new_field_value );
    } elseif ( $news_portal_widgets_field_type == 'url' ) {
        return esc_url( $new_field_value );
    } elseif ( $news_portal_widgets_field_type == 'multicheckboxes' ) {
        $multicheck_list = array();
        if ( is_array( $new_field_value ) ){
            foreach( $new_field_value as $key => $value ){
                $multicheck_list[absint( $key )] = esc_attr( $value );
            }
        }
        return $multicheck_list;
    } else {
        return sanitize_text_field( $new_field_value );
    }
}