/**
 * Image upload functions
 */
var selector;
function upload_media_image(selector){
// ADD IMAGE LINK
    jQuery('body').on( 'click', selector , function( event ){
    event.preventDefault();

    var imgContainer = jQuery(this).closest('.attachment-media-view').find( '.thumbnail-image'),
    placeholder = jQuery(this).closest('.attachment-media-view').find( '.placeholder'),
    imgIdInput = jQuery(this).siblings('.upload-id');

    // Create a new media frame
    frame = wp.media({
        title: 'Select or Upload Image',
        button: {
        text: 'Use Image'
        },
        multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected in the media frame...
    frame.on( 'select', function() {

    // Get media attachment details from the frame state
    var attachment = frame.state().get('selection').first().toJSON();

    // Send the attachment URL to our custom image input field.
    imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
    placeholder.addClass('hidden');
    imgIdInput.val( attachment.url ).trigger('change');
    });

    // Finally, open the modal on click
    frame.open();
    
    });
}

function delete_media_image(selector){
    // DELETE IMAGE LINK
    jQuery('body').on( 'click', selector, function( event ){

    event.preventDefault();
    var imgContainer = jQuery(this).closest('.attachment-media-view').find( '.thumbnail-image'),
    placeholder = jQuery(this).closest('.attachment-media-view').find( '.placeholder'),
    imgIdInput = jQuery(this).siblings('.upload-id');

    // Clear out the preview image
    imgContainer.find('img').remove();
    placeholder.removeClass('hidden');

    // Delete the image id from the hidden input
    imgIdInput.val( '' ).trigger('change');

    });
}

/**
 * update function for review selector
*/
function np_typesReview() {
    var cur_selection = jQuery('#selectReview option:selected').val();

    if( cur_selection === undefined ) {
        return;
    }

    if( cur_selection.indexOf("no_review") !== -1 ) {
        jQuery('.review-types').hide();
        jQuery('.post-review-desc').hide();
        jQuery('.post-review-summary').hide();
    } else {
        jQuery('.review-types').hide();
        jQuery('#type-' + cur_selection).fadeIn();
        jQuery('.post-review-desc').fadeIn();
        jQuery('.post-review-summary').fadeIn();
    }
}

/**
 *function about post format
 */
function postFormat() {
    var cur_format = jQuery("input[type='radio'].post-format:checked").val();
    if (cur_format === '0') {
        jQuery('.np-format-meta-tab').hide();
        jQuery('.np-format-wrap').hide();
    } else {
        jQuery('.np-format-meta-tab').hide();
        jQuery('.np-format-wrap').hide();
        jQuery('#np-meta-tab-'+cur_format).fadeIn();
        //jQuery('#np-metabox'+cur_format).fadeIn();
    }
}

jQuery(document).ready(function($) {
    "use strict";

    /**
     * Image upload at widget
     */
    upload_media_image('.np-upload-button');
    delete_media_image('.np-delete-button');

    /**
     * Image selector in widget
     */
    $('body').on('click','.selector-labels label', function(){
        var $this = $(this);
        var value = $this.data('val');
        $this.siblings().removeClass('selector-selected');
        $this.addClass('selector-selected');
        $this.closest('.selector-labels').next('input').val(value).change();
    });

    
    
    /**
     * Script for switch option
     */
    $('.wiz_switch_options').each(function() {
        
        var obj = $(this);

        var switchPart = obj.children('.switch_part').attr('data-switch');
        var input = obj.children('input'); //cache the element where we must set the value
        var input_val = obj.children('input').val(); //cache the element where we must set the value

        obj.children('.switch_part.'+input_val).addClass('selected');
        obj.children('.switch_part').on('click', function(){
            var switchVal = $(this).attr('data-switch');
            obj.children('.switch_part').removeClass('selected');
            $(this).addClass('selected');
            $(input).val(switchVal).change(); //Finally change the value to 1
        });
    });

    /**
     * Range slider
     */
    $('.range-input').each(function(){
        var $this = $(this);
        $this.slider({
            range: "min",
            value: parseFloat($this.data('value')),
            min: parseFloat($this.data('min')),
            max: parseFloat($this.data('max')),
            step: parseFloat($this.data('step')),
            slide: function( event, ui ) {
                $this.siblings(".range-input-selector").val(ui.value).change();
                $this.siblings(".show-range-value").text(ui.value);
            }
        });
    });

    /**
     * widget value after updated
     */
    $(document).on('widget-updated widget-added', function(){

        /**
         * Script for switch option
         */
        $('.wiz_switch_options').each(function() {
            //This object
            var obj = $(this);

            var switchPart = obj.children('.switch_part').attr('data-switch');
            var input = obj.children('input'); //cache the element where we must set the value
            var input_val = obj.children('input').val(); //cache the element where we must set the value

            obj.children('.switch_part.'+input_val).addClass('selected');
            obj.children('.switch_part').on('click', function(){
                var switchVal = $(this).attr('data-switch');
                obj.children('.switch_part').removeClass('selected');
                $(this).addClass('selected');
                $(input).val(switchVal).change(); //Finally change the value to 1
            });
        });

        /**
         * Range slider
         */
        $('.range-input').each(function(){
            var $this = $(this);
            $this.slider({
                range: "min",
                value: parseFloat($this.data('value')),
                min: parseFloat($this.data('min')),
                max: parseFloat($this.data('max')),
                step: parseFloat($this.data('step')),
                slide: function( event, ui ) {
                    $this.siblings(".range-input-selector").val(ui.value).change();
                    $this.siblings(".show-range-value").text(ui.value);
                }
            });
        });
    });

    /**
     * Radio Image control in metabox
     * Use buttonset() for radio images.
     */
    $( '.np-meta-options-wrap .buttonset' ).buttonset();

    /**
     * Meta tabs and its content
     */
    var curTab = $('.np-meta-menu-wrapper li.active').data('tab');
    $('.np-metabox-content-wrapper').find('#'+curTab).show();
    $('.np-metabox-content-wrapper').find('#'+curTab).addClass('active');
    
    $('ul.np-meta-menu-wrapper li').click(function (){
        var id = $(this).data('tab');
        
        $('ul.np-meta-menu-wrapper li').removeClass('active');
        $(this).addClass('active');
        $('.np-metabox-content-wrapper').find('.np-single-meta').removeClass('active');
        
        $('.np-metabox-content-wrapper .np-single-meta').hide();
        $('#'+id).fadeIn();
        $('#post-meta-selected').val(id);
    });

    /**
     * Review options
     */
    np_typesReview();
    $('#selectReview').change(function() {
        np_typesReview();
    });

    /**
     * Add new star row
     */
    var count = $('#post_star_review_count').val();
    $('.add-review-stars').click(function(e){
        e.preventDefault();
        count++;
        $('.post-review-section.star-section').append('<div class="review-section-group star-group">'+
                            '<span class="custom-label">Feature Name: </span>'+
                            '<input style="width: 300px;" type="text" name="star_ratings['+count+'][feature_name]" value="" />'+
                            ' <select name="star_ratings['+count+'][feature_star]">'+
                            '<option value="">Select rating</option>'+
                            '<option value="5">5 stars</option>'+
                            '<option value="4.5">4.5 stars</option>'+
                            '<option value="4">4 stars</option>'+
                            '<option value="3.5">3.5 stars</option>'+
                            '<option value="3">3 stars</option>'+
                            '<option value="2.5">2.5 stars</option>'+
                            '<option value="2">2 stars</option>'+
                            '<option value="1.5">1.5 stars</option>'+
                            '<option value="1">1 stars</option>'+
                            '<option value="0.5">0.5 stars</option>'+
                            '</select>'+
                            ' <a href="#" class="delete-review-stars dlt-btn button">Delete</a>'+
                            '</div></div>'
                            );
    });

    /**
     * Remove star row
     */
    $(document).on('click', '.delete-review-stars', function(e){
        e.preventDefault();
        $(this).parent('.review-section-group.star-group').remove();
    });

    /**
     * Add new percent row
     */
    var pCount = $('#post_percent_review_count').val();
    $('.add-review-percents').click(function(e){
        e.preventDefault();
        pCount++;
        $('.post-review-section.percent-section').append('<div class="review-section-group percent-group"><span class="custom-label">Feature Name: </span>'+
                            '<input style="width: 300px;" type="text" name="percent_ratings['+pCount+'][feature_name]" value="" />'+
                            ' <span class="opt-sep">Percent: </span>'+
                            '<input style="width: 100px;" type="number" min="1" max="100" name="percent_ratings['+pCount+'][feature_percent]" value="" step="1" />'+
                            '<a href="#" class="delete-review-percents dlt-btn button">Delete</a>'+
                            '</div>'
                            );
        
    });

    /**
     * Remove percent row
     */
    $(document).on('click', '.delete-review-percents', function(e){
        e.preventDefault();
       $(this).parent('.review-section-group.percent-group').remove();
    });

    /**
     * Change the post format
     */
    postFormat();
    $('input[name="post_format"]').change(function () {
        postFormat();
    });

    /**
     * Add gallery images
     */
    $(document).on('click', '#post_gallery_upload_button', function (e) {
        var img_count = $('#post_image_count').val();
        var dis = $(this);
        var send_attachment_bkp = wp.media.editor.send.attachment;
        var custom_media = true;
        wp.media.editor.send.attachment = function (props, attachment) {
            if (custom_media) {
                var img = attachment.sizes.thumbnail.url;
                $('.post-gallery-section').append('<div class="gal-img-block"><div class="gal-img"><img src="' + img + '" height="150px" width="150px"/><span class="fig-remove" title="remove"></span></div><input type="hidden" name="post_images[' + img_count + ']" class="hidden-media-gallery" value="' + attachment.url + '" /></div>');
                img_count++;
                $('#post_image_count').val(img_count);
            } else {
                return _orig_send_attachment.apply( $(this), [props, attachment]);
            }
        }

        wp.media.editor.open($(this));
        return false;
    });

    /**
     * Remove gallery images
     */
    $(document).on('click', '.fig-remove', function () {
        $(this).parents('.gal-img-block').remove();
    });

    /**
     * Reset video embed value
     */
    $('#reset-video-embed').click(function () {
        $('input[name="post_featured_video"]').val('');
    });

    /**
     * Add audio file
     */
    $('#post_audio_upload_button').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var audio = wp.media.frames.file_frame = wp.media({
            title: 'Upload Audio File',
            button: {
                text: 'Use this file',
            },
            // multiple: true if you want to upload multiple files at once
            multiple: false,
            library: {
                type: 'audio'
            }
        }).open()
                .on('select', function (e) {
                    // This will return the selected audio from the Media Uploader, the result is an object
                    var uploaded_audio = audio.state().get('selection').first();
                    // We convert uploaded_audio to a JSON object to make accessing it easier
                    // Output to the console uploaded_audio
                    var audio_url = uploaded_audio.toJSON().url;
                    // Let's assign the url value to the input field
                    $this.prev('input').val(audio_url);
                });
        //$('#audiourl_remove').show();
    });

    /**
     * Reset audio embed value
     */
    $('#reset-audio-embed').click(function () {
        $('input[name="post_embed_audio"]').val('');
    });

});