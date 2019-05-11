<?php
/**
 *
 * This file is used to slider and other shortcodes
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/public/shortcodes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * The plugin shortcodes class
 *
 * @since      1.0.0
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/public/shortcodes
 * @author     Shindiri Studio
 */
class Shindiri_Woo_Slider_Shortcodes {
    
    /**
	 * Return shortcode output based on settings in main metabox for custom post type
	 *
	 * @since    1.0.0
     * 
     * @param   array   $atts   Shortcode attributes
	 */
	public static function slider_shortcode( $atts ) {
        
        /*
         * If shortcode is used under Visual Composer editor fill atts
         * Othervise it will be already defined
         */
        if ( shindiri_woo_slider_is_vc_activated() ) {
            if ( empty( $atts['id'] ) ) {
                // Check for major change in 4.6 Visual Composer version
                if ( function_exists( 'vc_map_get_attributes' ) ) {
                    $atts = vc_map_get_attributes( Shindiri_Woo_Slider::SHORTCODE_TAG, $atts );
                    extract( $atts );
                }
            }
        }
        
        $post_id = isset( $atts['id'] ) && !empty( $atts['id'] ) ? absint( $atts['id'] ) : '';
        
        // Prevent further errors
        if ( empty( $post_id ) ) {
            return esc_html__( 'Something went wrong. Please check slider settings.', 'woo-shop-slider-lite' );
        }
        
        $meta_values = Shindiri_Woo_Slider_Helper::get_meta_values( $post_id );
        
        if ( empty( $meta_values ) ) {
            return esc_html__( 'Meta key does not exist. Please check slider settings.', 'woo-shop-slider-lite' );
        }
        
        /*
         * Check for selected version and execute that class version
         */
        $slider_version = isset( $meta_values[0]['slider_version_active'] ) && !empty( $meta_values[0]['slider_version_active'] ) ? sanitize_text_field( $meta_values[0]['slider_version_active'] ) : 'version-1';
        $slider_versions = Shindiri_Woo_Slider_Main_Metabox::get_metabox_tab_content_versions();
        $shortcode_output = '';

        // Compare selected slider version and include that shortcode class from config file of slider versions
        if ( is_array( $slider_versions ) && !empty( $slider_versions ) ) {
            foreach ( $slider_versions as $slider ) {
                if ( $slider_version === $slider['id'] ) {
                    if ( class_exists( $slider['class'] ) ) {
                        $shortcode = new $slider['class']();
                        $shortcode_output = $shortcode->slider_shortcode( $post_id, $meta_values );
                    }
                }
            }
        }

		return $shortcode_output;
	}
    
    /**
	 * Return shortcode markup for desired post
	 *
	 * @since    1.0.0
     * 
     * @param   int   $post_id   Post id
	 */
    public static function slider_shortcode_tag( $post_id ) {
        
        $shortcode = '[' . Shindiri_Woo_Slider::SHORTCODE_TAG . ' id="' . $post_id . '"]';
        
        return $shortcode;
    }
    
    /**
	 * Return shortcode markup for dynamic replacemnt of shortcode id param
	 *
	 * @since    1.0.0
     * 
     * @param   int   $post_id   Post id
     * 
     * @return string Return shortcode markup for dynamic replacemnt of shortcode id param. The "#shortcode_id#" string need to be replaced
	 */
    public static function slider_shortcode_dynamic_tag() {
        
        $shortcode = '[' . Shindiri_Woo_Slider::SHORTCODE_TAG . ' id="#shortcode_id#"]';
        
        return $shortcode;
    }
 }
?>