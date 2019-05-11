<?php

/**
 *
 * This file is used to add array of slider versions as metabox tabs
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
        7 => array( 
            'id' => 'version-7', 
            'name' => sprintf( esc_html__( 'Straight %s', 'woo-shop-slider-lite' ), '<span>' . esc_html__( 'Slider', 'woo-shop-slider-lite' ) . '</span>' ),
            'class' => 'Shindiri_Woo_Slider_Shortcode_Version_Seven',
            'path' => Shindiri_Woo_Slider::root_url_or_dir( 'dir' ) . 'public/shortcodes/versions/seven/class-shindiri-woo-slider-version-seven.php',
            'admin_tab' => Shindiri_Woo_Slider::root_url_or_dir( 'dir' ) . 'admin/partials/metabox-tab-version-7.php',
            'image' => Shindiri_Woo_Slider::root_url_or_dir( 'url' ) . 'admin/images/admin-preview/version-7.jpg'
        )
    );