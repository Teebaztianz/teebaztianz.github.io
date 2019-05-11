<?php
/**
 *
 * This file contain functions used to register shortcode with Visual Composer
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 */

/*
 * Register shortcode with visual composer
 * 
 * @since      1.0.0
 */
if ( ! function_exists( 'shindiri_woo_slider_vc_map' ) ) {
    function shindiri_woo_slider_vc_map() {
        
        // Set first value in array as Visual Composer does not remember first value
        $array = array( 'none' => esc_html( 'Please select slider', 'woo-shop-slider-lite' ) );
        
        // Get all sliders
        $all_sliders = Shindiri_Woo_Slider_Helper::return_all_sliders( '', -1, true, true, false, false );

        if ( ! empty( $all_sliders ) && ! is_wp_error( $all_sliders ) ) {

            if ( $all_sliders->have_posts() ) : while ( $all_sliders->have_posts() ) : $all_sliders->the_post();
       
                $key = get_the_title();
        
                $array[ esc_attr( get_the_ID() ) ] = sanitize_text_field( $key );

            endwhile; 
            wp_reset_postdata();
            endif;
        }

        vc_map( array(
            'name' => sprintf( esc_html__('Shindiri %s', 'woo-shop-slider-lite'), Shindiri_Woo_Slider::get_plugin_public_name() ),
            'base' => Shindiri_Woo_Slider::SHORTCODE_TAG,
            'content_element' => true,
            
            'category' => Shindiri_Woo_Slider::get_plugin_public_name(),
            'icon' => plugins_url( 'images/vc-icon.png', dirname( __FILE__ ) ),
            'params' => array(
                // add params same as with any other content element
                array(
                    'type' => 'sh-ws-dropdown',
                    'admin_label' => true,
                    'heading' => esc_html__( 'Selected slider id', 'woo-shop-slider-lite' ),
                    'param_name' => 'id',
                    'value' => $array
                ),
            )
        ) );
    }
}

/*
 * Add our own dropdown param
 * 
 * @since      1.0.0
 */
if ( !function_exists( 'shindiri_woo_slider_dropdown_param' ) ) {
    function shindiri_woo_slider_dropdown_param( $settings, $value ) {
        
        $array_values = isset( $settings['value'] ) && !empty( $settings['value'] ) ? $settings['value'] : array();
        $options = '';
                
        if ( is_array( $array_values ) && !empty( $array_values ) ) {
            foreach ($array_values as $arr_key => $arr_value) {
                $selected = $arr_key == $value ? ' selected="selected"' : '';
                $options .= '<option value="' . esc_attr( $arr_key ) . '"' . $selected . '>' . esc_html( $arr_value ) . '</option>';
            }
        }
        
        return '<div class="sh-ws-dropdown-param">'
                . '<select name="' . esc_attr($settings['param_name']) . '" class="wpb_vc_param_value wpb-select ' .
                esc_attr($settings['param_name']) . ' ' .
                esc_attr($settings['type']) . '_field">'
                . $options . '</select>' .
                '</div>'; // This is html markup that will be outputted in content elements edit form
    }

}


/*
 * Check if Visual Composer plugin is activated
 * 
 * @since      1.0.0
 */
if ( ! function_exists( 'shindiri_woo_slider_is_vc_activated' ) ) {
    function shindiri_woo_slider_is_vc_activated() {
        return defined( 'WPB_VC_VERSION' );
    }
}

/*
 * Check if Visual Composer is installed and map shortcode and add custom param
 */
if ( shindiri_woo_slider_is_vc_activated() ) {
    vc_add_shortcode_param( 'sh-ws-dropdown', 'shindiri_woo_slider_dropdown_param' );
    shindiri_woo_slider_vc_map();
}