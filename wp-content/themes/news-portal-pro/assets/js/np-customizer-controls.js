( function( api ) {

    api.controlConstructor['typography'] = api.Control.extend( {
        ready: function() {
            var control = this;

            control.container.on( 'change', '.typography-font-family select',
                function() {
                    control.settings['family'].set( jQuery( this ).val() );
                }
            );

            control.container.on( 'change', '.typography-font-style select',
                function() {
                    control.settings['style'].set( jQuery( this ).val() );
                }
            );

            control.container.on( 'change', '.typography-text-transform select',
                function() {
                    control.settings['text_transform'].set( jQuery( this ).val() );
                }
            );

            control.container.on( 'change', '.typography-text-decoration select',
                function() {
                    control.settings['text_decoration'].set( jQuery( this ).val() );
                }
            );
        }
    } );

    api.controlConstructor['show_on_front'] = api.Control.extend( {
        ready: function() {
            var control = this;
            control.container.on( 'click', function() {
                control.settings['homepage_wow_option'].toggle();
            } );
        }
    } );

} )( wp.customize );

jQuery(document).ready(function($) {

    "use strict";

    /**
     * Script for switch option
     */
    $('.switch_options').each(function() {
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
     * Radio Image control in customizer
     */
    // Use buttonset() for radio images.
    $( '.customize-control-radio-image .buttonset' ).buttonset();

    // Handles setting the new value in the customizer.
    $( '.customize-control-radio-image input:radio' ).change(
        function() {

            // Get the name of the setting.
            var setting = $( this ).attr( 'data-customize-setting-link' );

            // Get the value of the currently-checked radio input.
            var image = $( this ).val();

            // Set the new value.
            wp.customize( setting, function( obj ) {

                obj.set( image );
            } );
        }
    );

    /**
      * Function for repeater field
     */
    function news_portal_refresh_repeater_values(){
        $(".np-repeater-field-control-wrap").each(function(){
            
            var values = []; 
            var $this = $(this);
            
            $this.find(".np-repeater-field-control").each(function(){
            var valueToPush = {};   

            $(this).find('[data-name]').each(function(){
                var dataName = $(this).attr('data-name');
                var dataValue = $(this).val();
                valueToPush[dataName] = dataValue;
            });

            values.push(valueToPush);
            });

            $this.next('.np-repeater-collector').val(JSON.stringify(values)).trigger('change');
        });
    }

    $('#customize-theme-controls').on('click','.np-repeater-field-title',function(){
        $(this).next().slideToggle();
        $(this).closest('.np-repeater-field-control').toggleClass('expanded');
    });

    $('#customize-theme-controls').on('click', '.np-repeater-field-close', function(){
        $(this).closest('.np-repeater-fields').slideUp();;
        $(this).closest('.np-repeater-field-control').toggleClass('expanded');
    });

    $("body").on("click",'.np-repeater-add-control-field', function(){

        var $this = $(this).parent();
        if(typeof $this != 'undefined') {

            var field = $this.find(".np-repeater-field-control:first").clone();
            if(typeof field != 'undefined'){
                
                field.find("input[type='text'][data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });
                
                field.find(".np-repeater-icon-list").each(function(){
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    $(this).prev('.np-repeater-selected-icon').children('i').attr('class','').addClass(defaultValue);
                    
                    $(this).find('li').each(function(){
                        var icon_class = $(this).find('i').attr('class');
                        if(defaultValue == icon_class ){
                            $(this).addClass('icon-active');
                        }else{
                            $(this).removeClass('icon-active');
                        }
                    });
                });

                field.find('.np-repeater-fields').show();

                $this.find('.np-repeater-field-control-wrap').append(field);

                field.addClass('expanded').find('.np-repeater-fields').show(); 
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                news_portal_refresh_repeater_values();
            }

        }
        return false;
     });
    
    $("#customize-theme-controls").on("click", ".np-repeater-field-remove",function(){
        if( typeof  $(this).parent() != 'undefined'){
            $(this).closest('.np-repeater-field-control').slideUp('normal', function(){
                $(this).remove();
                news_portal_refresh_repeater_values();
            });
        }
        return false;
    });

    $("#customize-theme-controls").on('keyup change', '[data-name]',function(){
        news_portal_refresh_repeater_values();
        return false;
    });

    /*Drag and drop to change order*/
    $(".np-repeater-field-control-wrap").sortable({
        orientation: "vertical",
        update: function( event, ui ) {
            news_portal_refresh_repeater_values();
        }
    });

    $('body').on('click', '.np-repeater-icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.np-repeater-icon-list').prev('.np-repeater-selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.np-repeater-icon-list').next('input').val(icon_class).trigger('change');
        news_portal_refresh_repeater_values();
    });

    $('body').on('click', '.np-repeater-selected-icon', function(){
        $(this).next().slideToggle();
    });  

    /**
     * Image selector in widget
     */
    $('body').on('click','.selector-labels label', function(){
        var $this = $(this);
        var value = $this.data('val');
        $this.closest('.selector-labels').next('input').val(value).trigger('change');
    });

    $( document ).on( 'expand', '.customize-control-widget_form', function(e){
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
                $(input).val(switchVal).trigger('change'); //Finally change the value to 1
            });
        });

        $('.range-input').each(function(){
            var $this = $(this);
            $this.slider({
                range: "min",
                value: parseFloat($this.data('value')),
                min: parseFloat($this.data('min')),
                max: parseFloat($this.data('max')),
                step: parseFloat($this.data('step')),
                slide: function( event, ui ) {
                    $this.siblings(".range-input-selector").val(ui.value).trigger('change');
                    $this.siblings(".show-range-value").text(ui.value);
                }
            });
        });

    });

    /**
     * Slider Custom Control
     *
     * @author Anthony Hortin <http://maddisondesigns.com>
     * @license http://www.gnu.org/licenses/gpl-2.0.html
     * @link https://github.com/maddisondesigns
     */

    // Set our slider defaults and initialise the slider
    $('.slider-custom-control').each(function(){
        var sliderValue = $(this).find('.customize-control-slider-value').val();
        var newSlider = $(this).find('.slider');
        var sliderMinValue = parseFloat(newSlider.attr('slider-min-value'));
        var sliderMaxValue = parseFloat(newSlider.attr('slider-max-value'));
        var sliderStepValue = parseFloat(newSlider.attr('slider-step-value'));

        newSlider.slider({
            value: sliderValue,
            min: sliderMinValue,
            max: sliderMaxValue,
            step: sliderStepValue,
            change: function(e,ui){
                // Important! When slider stops moving make sure to trigger change event so Customizer knows it has to save the field
                $(this).parent().find('.customize-control-slider-value').trigger('change');
          }
        });
    });

    // Change the value of the input field as the slider is moved
    $('.slider').on('slide', function(event, ui) {
        $(this).parent().find('.customize-control-slider-value').val(ui.value);
    });

    // Reset slider and input field back to the default value
    $('.slider-reset').on('click', function() {
        var resetValue = $(this).attr('slider-reset-value');
        $(this).parent().find('.customize-control-slider-value').val(resetValue);
        $(this).parent().find('.slider').slider('value', resetValue);
    });

    // Update slider if the input field loses focus as it's most likely changed
    $('.customize-control-slider-value').blur(function() {
        var resetValue = $(this).val();
        var slider = $(this).parent().find('.slider');
        var sliderMinValue = parseInt(slider.attr('slider-min-value'));
        var sliderMaxValue = parseInt(slider.attr('slider-max-value'));

        // Make sure our manual input value doesn't exceed the minimum & maxmium values
        if(resetValue < sliderMinValue) {
            resetValue = sliderMinValue;
            $(this).val(resetValue);
        }
        if(resetValue > sliderMaxValue) {
            resetValue = sliderMaxValue;
            $(this).val(resetValue);
        }
        $(this).parent().find('.slider').slider('value', resetValue);
    });

    // site logo width control
    wp.customize( 'np_custom_logo_width_opt', function( setting ) {
        wp.customize.control( 'np_site_logo_width', function( control ) {
            var visibility = function() {
                if ( true === setting.get() ) {
                    control.container.slideDown( 180 );
                } else {
                    control.container.slideUp( 180 );
                }
            };

            visibility();
            setting.bind( visibility );
        });
    });
        
});