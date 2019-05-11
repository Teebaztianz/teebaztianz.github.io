<?php

/**
 * The public-specific functionality of the plugin.
 * 
 * Inline css which will be parsed if typography for slider version is on
 *
 * @since      1.1.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/public
 */

return '
    /* Outline button */
    div.shindiri-woo-slider-shortcode-version-seven div.[css-id].sh-ws-typography div.shindiri-woo-slide-details div.sh-ws-slide-details-inner.sh-ws-button-outlined button.button
    { border-color: [main_color] !important; color: [button_color] !important; }
    
    div.shindiri-woo-slider-shortcode-version-seven div.[css-id].sh-ws-typography div.shindiri-woo-slide-details div.sh-ws-slide-details-inner.sh-ws-button-outlined button.button:hover
    { background: [main_color] !important; color: [button_color] !important; }
    
    /* Filled and rounded button */
    div.shindiri-woo-slider-shortcode-version-seven div.[css-id].sh-ws-dark-theme.sh-ws-typography div.shindiri-woo-slide-details div.sh-ws-slide-details-inner.sh-ws-button-filled button.button,
    div.shindiri-woo-slider-shortcode-version-seven div.[css-id].sh-ws-light-theme.sh-ws-typography div.shindiri-woo-slide-details div.sh-ws-slide-details-inner.sh-ws-button-filled button.button,
    div.shindiri-woo-slider-shortcode-version-seven div.[css-id].sh-ws-dark-theme.sh-ws-typography div.shindiri-woo-slide-details div.sh-ws-slide-details-inner.sh-ws-button-rounded button.button,
    div.shindiri-woo-slider-shortcode-version-seven div.[css-id].sh-ws-light-theme.sh-ws-typography div.shindiri-woo-slide-details div.sh-ws-slide-details-inner.sh-ws-button-rounded button.button
    { background: [main_color] !important; border-color: [main_color] !important; color: [button_color] !important; }
    
    div.shindiri-woo-slider-shortcode-version-seven div.[css-id].sh-ws-dark-theme.sh-ws-typography div.shindiri-woo-slide-details div.sh-ws-slide-details-inner.sh-ws-button-filled button.button:hover,
    div.shindiri-woo-slider-shortcode-version-seven div.[css-id].sh-ws-light-theme.sh-ws-typography div.shindiri-woo-slide-details div.sh-ws-slide-details-inner.sh-ws-button-filled button.button:hover,
    div.shindiri-woo-slider-shortcode-version-seven div.[css-id].sh-ws-dark-theme.sh-ws-typography div.shindiri-woo-slide-details div.sh-ws-slide-details-inner.sh-ws-button-rounded button.button:hover,
    div.shindiri-woo-slider-shortcode-version-seven div.[css-id].sh-ws-light-theme.sh-ws-typography div.shindiri-woo-slide-details div.sh-ws-slide-details-inner.sh-ws-button-rounded button.button:hover
    { background: [hover] !important; border-color: [hover] !important; color: [button_color] !important; }
';