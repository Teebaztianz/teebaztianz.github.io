<?php

/**
 *
 * This file contain TinyMce plugin functions for adding shortcode button to the text editor
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 */


/**
 * The TinyMce plugin class
 *
 * Adds shortcode button to the text editor
 * admin-facing site hooks.
 *
 * @since      1.0.0
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 * @author     Shindiri Studio
 */
class Shindiri_Woo_Slider_Tinymce_Plugin {
    
    public function __construct() {
        add_action('admin_footer', array( $this, 'tinymce_shortcode_media_button_popup' ) );
        add_action('media_buttons', array( $this, 'add_my_tinymce_media_button' ) );
    }
    
    /**
	 * Add the button to the tinymce editor
	 *
	 * @since    1.0.0
	 * @access   public
	 */
    function add_my_tinymce_media_button($context){
        $button_title = sprintf( esc_html__( 'Add %s Shortcode', 'woo-shop-slider-lite' ), Shindiri_Woo_Slider::get_plugin_public_name() );
        echo "<a href=\"#TB_inline?width=480&inlineId=sh-ws-tinymce-popup&width=640&height=513\" class=\"button thickbox\" id=\"my_shortcode_popup_button\" title=\"{$button_title}\">{$button_title}</a>";
    }
    
    /**
	 * Generate inline content for the popup window when the shortcode button is clicked
	 *
	 * @since    1.0.0
	 * @access   public
	 */
    function tinymce_shortcode_media_button_popup(){

        $the_query = Shindiri_Woo_Slider_Helper::return_all_sliders( '', -1, true, true, false, false );

        $html = '<select id="sh-ws-tinymce-select">';
        
            $html .= '<option value="nothing">' . esc_html__( 'Select slider', 'woo-shop-slider-lite' ) . '</option>';
        
        if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
        
            $html .= '<option value="' . esc_attr( get_the_ID() ) . '">' . esc_html( get_the_title() ) . ' </option>';

        endwhile; wp_reset_postdata(); else :
            
            $html .= '<option value="nothing">' . esc_html__( 'No Sliders found', 'woo-shop-slider-lite' ) . '</option>';
            
        endif;

        $html .= '<select>';


        ?>
        <div id="sh-ws-tinymce-popup" style="display:none;">
            <!--".wrap" class div is needed to make thickbox content look good-->
            <div class="wrap">
                <h2><?php esc_html_e( 'Please select slider', 'woo-shop-slider-lite' ); ?></h2>
                <div>
                    <?php echo $html; ?>
                </div>
            </div>
        </div>
    <?php
    }
}