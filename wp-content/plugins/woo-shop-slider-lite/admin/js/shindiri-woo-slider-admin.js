(function( $ ) {
	'use strict';

	/**
	 * All admin-specific JavaScript source
	 */
        

        $(document).ready(function() {
            
            /* Metabox generator functions */
            
            /*
            * Adds img uploader to edit user and edit profile screen
            */

           // Uploading files
           var file_frame;
           var uploaderContainer;
           
           $('.sh-ws-custom-image-buttom').on('click', function (event) {

               event.preventDefault();
               
               uploaderContainer = $(this).parents('.sh-ws-upload-custom-image');
               var attachment;

               // If the media frame already exists, reopen it.
               if (file_frame) {
                   file_frame.open();
                   return;
               }

               // Create the media frame.
               file_frame = wp.media.frames.file_frame = wp.media({
                   multiple: false  // Set to true to allow multiple files to be selected
               });

               // When an image is selected, run a callback.
               file_frame.on('select', function () {

                   // We set multiple to false so only get one image from the uploader
                   attachment = file_frame.state().get('selection').first().toJSON();

                   // Get attachement id and set preview
                   uploaderContainer.find('.sh-ws-custom-image').val(attachment.id);
                   uploaderContainer.find('.sh-ws-sliderimg-preview').attr('src', attachment.url);

               });

               // Finally, open the modal
               file_frame.open();
           });
           
           // Reset button for media uploader
           $('.sh-ws-custom-reset-buttom').on('click', function (event) {

               event.preventDefault();
               
               var imgUploader = $(this).parents('.sh-ws-upload-custom-image');
               var defaultUrl = imgUploader.data('default-url');
               
               // Replace preview image and empty input field
               imgUploader.find('.sh-ws-custom-image').val('');
               imgUploader.find('.sh-ws-sliderimg-preview').attr('src', defaultUrl);
           });
           
           /*
            * Init color picker fields
            */
           $(".sh-ws-color-picker-field").wpColorPicker({});
           
           /*
            * Init range fields
            */
           $('.sh-ws-input-range-field').each(function(){
               var currentRangeInput = $(this);
                var rangeslider = currentRangeInput.find('.sh-ws-js-amount-range');
                var amount = currentRangeInput.find('.sh-ws-js-amount-input');
                var button = currentRangeInput.find('.sh-ws-js-amount-button');

                rangeslider
                        .rangeslider({
                            polyfill: false
                        })
                        .on('input', function () {
                            amount.val(this.value);
                        });

                button.on('click', function (event) {
                    event.preventDefault();
                    rangeslider.val(amount.val()).change();
                    amount.val(rangeslider.val());
                });
            });
            
            /*
             * Multiselect jQuery Tree Multiselect
             * https://github.com/patosai/tree-multiselect.js
             */
            $('select.sh-ws-multiselect-sorting').each(function(){
                var multiselect = $(this);
                var showSidePanel = (multiselect.data('side-panel') === 'no');

                multiselect.treeMultiselect({ 
                    sortable: true,
                    allowBatchSelection: true,
                    showSectionOnSelected: false,
                    hideSidePanel: showSidePanel
                });
            });
            
            /* This plugin related only functions */
            
            /*
            * Show selected tab version on click, used in main metabox
            */
           // Only in full plugin version
            
            /*
             * Search for select fields
             */
            $('.sh-ws-select-search input').on( 'input', function(){
                var selectField = $(this).parents('.sh-ws-settings-field').find('select');
                var options = selectField.find('option');
                var searchedVal = $(this).val();

                options.each(function(){
                    var option = $(this);
                    var html = option.html();
                    if (html.toLowerCase().indexOf(searchedVal) >= 0) {
                        option.show();
                    } else {
                        option.hide();
                    }
                });
            });
            
            // What to show / hide for slider versions when product / category selected
            $('.sh-ws-select-field.1show_what select, \
                .sh-ws-select-field.3show_what select, \
                .sh-ws-select-field.4show_what select, \
                .sh-ws-select-field.5show_what select, \
                .sh-ws-select-field.6show_what select, \
                .sh-ws-select-field.7show_what select, \
                .sh-ws-select-field.8show_what select'
            ).on('change', function(){
                // Fields to hide when categories selected
                var hideProdField = $(this).parents('.sh-ws-tab-content').find('.sh-ws-hide-product-field');
                // Fields to hide when product selected
                var hideCatField = $(this).parents('.sh-ws-tab-content').find('.sh-ws-hide-cat-field');
                
                if ( $(this).find('option:selected').val() === 'categories' ) {
                    hideProdField.fadeOut(300);
                    hideCatField.fadeIn(300);
                } else {
                    hideProdField.fadeIn(300);
                    hideCatField.fadeOut(300);
                }
            });
            
            // Hide style fields not nedded without typography
            // What to show / hide for slider versions when product / category selected
            $('.sh-ws-select-field.1disable_typography, \
                .sh-ws-select-field.2disable_typography, \
                .sh-ws-select-field.3disable_typography, \
                .sh-ws-select-field.4disable_typography, \
                .sh-ws-select-field.5disable_typography, \
                .sh-ws-select-field.6disable_typography, \
                .sh-ws-select-field.7disable_typography, \
                .sh-ws-select-field.8disable_typography'
            ).on('change', function(){
                // Fields to hide when typography disabled
                var hideTypographyField = $(this).parents('.sh-ws-tab-content').find('.sh-ws-hide-typography-off');
                
                if ( $(this).find('option:selected').val() === 'disabled' ) {
                    hideTypographyField.fadeOut(300);
                } else {
                    hideTypographyField.fadeIn(300);
                }
            });
           
       });// End document ready
       
       /*
        * Ace editor for custom css metabox
        */
       $(document).ready(function(){
            // trigger extension
            ace.require("ace/ext/language_tools");
            var editor = ace.edit("sh-ws-custom-css-editor");
            editor.session.setMode("ace/mode/css");
            editor.setTheme("ace/theme/tomorrow_night");
            // enable autocompletion and snippets
            editor.setOptions({
                enableBasicAutocompletion: true,
                enableSnippets: true,
                enableLiveAutocompletion: false
            });
            // Set font size
            document.getElementById('sh-ws-custom-css-editor').style.fontSize='16px';
            
            // Set initial value
            var textareaCss =  $('#sh-ws-custom-css').html();
            editor.setValue(textareaCss);
            
            // Write into textarea on field change
            editor.getSession().on('change', function(e) {
                $('#sh-ws-custom-css').html(editor.getValue());
            });
        });

})( jQuery );
