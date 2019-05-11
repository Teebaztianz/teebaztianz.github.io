<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin. Used to describe plugin and give plugin info data. 
 * No settings are allowed in this page
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="sh-ws-plugin-info-page wrap">
    <h1><?php echo esc_html_x( 'Welcome to ', 'welcome message to info page', 'woo-shop-slider-lite' ) . esc_html( Shindiri_Woo_Slider::get_plugin_public_name() ) . esc_html_x( ' Lite', 'Slider free lite version', 'woo-shop-slider-lite' ); ?> <span><?php echo esc_html_x( 'by', 'created by', 'woo-shop-slider-lite' ); ?> ShindiriStudio</span></h1>
   
   <div class="sh-ws-plugin-info-content">
       <img src="<?php echo Shindiri_Woo_Slider::root_url_or_dir( 'url' ) . 'admin/images/slider_info_img.png' ?>"/>
       <p>A complete slider solution for your WooCommerce needs. Simply select a version of slider that you like the most and import categories and thats it! Have fun.</p>
       
       <ul>
           <li><a href="http://www.shindiristudio.com/wooslider/documentation/" target="_blank">> <?php echo esc_html_x( 'Documentation', 'plugin documentation', 'woo-shop-slider-lite' ); ?></a></li>
           <li><a href="http://www.shindiristudio.com/wooslider/" target="_blank">> <?php echo esc_html_x( 'Live Demo', 'plugin live demo link', 'woo-shop-slider-lite' ); ?></a></li>
           <li><a href="http://codecanyon.net/user/shindiristudio/portfolio?ref=ShindiriStudio&utm_source=wooSlider&utm_medium=wooSliderPlugin&utm_campaign=pluginInfo" target="_blank">> <?php echo esc_html_x( 'More Shindiri Studio Plugins', 'shindiri studio codecanyon', 'woo-shop-slider-lite' ); ?></a></li>
           <li><a href="http://themeforest.net/user/shindiristudio/portfolio?ref=ShindiriStudio&utm_source=wooSlider&utm_medium=wooSliderPlugin&utm_campaign=pluginInfo" target="_blank">> <?php echo esc_html_x( 'More Shindiri Studio Templates', 'shindiri studio themeforest', 'woo-shop-slider-lite' ); ?></a></li>
       </ul>
   </div>

   
</div>