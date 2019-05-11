<?php

/**
 *
 * This file is used to add tab content fields definitions 
 * which will be used for field generator and savign metabox values
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

return array(
        'slider_version_active' => array(
            'name' => 'slider_version_active',
            'slider' => 0, // Settings for all sliders
            'type' => 'radio',
        ),
    
        // Version 7
        'version_seven_show_what' => array(
            'name' => 'show_what',
            'slider' => 7,
            'type' => 'select',
        ),
        'version_seven_cat_multiselect' => array(
            'name' => 'cat_multiselect',
            'slider' => 7,
            'type' => 'multiselect',
        ),
        'version_seven_slider_limit' => array(
            'name' => 'slider_limit',
            'slider' => 7,
            'type' => 'select',
        ),
        'version_seven_products_sorting' => array(
            'name' => 'products_sorting',
            'slider' => 7,
            'type' => 'select',
        ),
        'version_seven_custom_link_text' => array(
            'name' => 'custom_link_text',
            'slider' => 7,
            'type' => 'text',
        ),
        'version_seven_theme_color' => array(
            'name' => 'theme_color',
            'slider' => 7,
            'type' => 'select',
        ),
        'version_seven_overlay_color' => array(
            'name' => 'overlay_color',
            'slider' => 7,
            'type' => 'text',
        ),
        'version_seven_content_overlay' => array(
            'name' => 'content_overlay',
            'slider' => 7,
            'type' => 'text',
        ),
        'version_seven_custom_placeholder' => array(
            'name' => 'custom_placeholder',
            'slider' => 7,
            'type' => 'text',
        ),
        'version_seven_disable_typography' => array(
            'name' => 'disable_typography',
            'slider' => 7,
            'type' => 'select',
        ),
        'version_seven_slider_height' => array(
            'name' => 'slider_height',
            'slider' => 7,
            'type' => 'range',
        ),
        'version_seven_full_screen' => array(
            'name' => 'full_screen',
            'slider' => 7,
            'type' => 'radio',
        ),
        'version_seven_slider_transition' => array(
            'name' => 'slider_transition',
            'slider' => 7,
            'type' => 'select',
        ),
        'version_seven_lazy_load' => array(
            'name' => 'lazy_load',
            'slider' => 7,
            'type' => 'radio',
        ),
        'version_seven_autoplay' => array(
            'name' => 'autoplay',
            'slider' => 7,
            'type' => 'select',
        ),
        'version_seven_autoplay_timeout' => array(
            'name' => 'autoplay_timeout',
            'slider' => 7,
            'type' => 'range',
        ),
        'version_seven_sale_text_color' => array(
            'name' => 'sale_text_color',
            'slider' => 7,
            'type' => 'text',
        ),
        'version_seven_sale_bg_color' => array(
            'name' => 'sale_bg_color',
            'slider' => 7,
            'type' => 'text',
        ),
        'version_seven_button_type' => array(
            'name' => 'button_type',
            'slider' => 7,
            'type' => 'select',
        ),
        'version_seven_accent_color' => array(
            'name' => 'accent_color',
            'slider' => 7,
            'type' => 'text',
        ),
        'version_seven_button_text_color' => array(
            'name' => 'button_text_color',
            'slider' => 7,
            'type' => 'text',
        ),
    );