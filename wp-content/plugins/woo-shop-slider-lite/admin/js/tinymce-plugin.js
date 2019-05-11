(function ($) {
    
    /*
     * javascript code needed to make shortcode appear in TinyMCE edtor
     */ 
    
    "use strict";

    $(window).load(function(){
        $('#sh-ws-tinymce-select').on('change', function () {
            var user_selection = $(this).find('option:selected').val();

            // Only get shortcode if one selected
            if ( user_selection.toString() !== 'nothing' ) {
                var shortcode = sh_ws_slider_shortcode_dynamic_tag.replace('#shortcode_id#', user_selection);
                
                if (tinyMCE.activeEditor === null) {

                    //$('textarea#content').val(shortcode);

                    // Remains to be upgraded so users can use text editor beyond visual
                    alert('Please switch back to visual editor to insert shortcode');

                } else {
                    tinyMCE.execCommand('mceInsertContent', false, shortcode);
                }
                //close the thickbox after adding shortcode to editor
                self.parent.tb_remove();
            }
        });
    });
})(jQuery);

