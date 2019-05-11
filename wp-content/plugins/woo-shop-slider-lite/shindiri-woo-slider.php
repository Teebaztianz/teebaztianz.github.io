<?php

/**
 * Plugin Name: Shindiri Woo Shop Slider Lite
 * Plugin URI: http://shindiristudio.com/wooslider/
 * Description: Woo Shop Slider Lite - WooCommerce slider for products and categories
 * Version: 1.2.3
 * Author: Shindiri Studio
 * Author URI: http://shindiristudio.com/
 * License:           
 * License URI:       
 * 
 * Requires at least: 4.0
 * Tested up to: 4.9.8
 * 
 * Text Domain: woo-shop-slider-lite
 * Domain Path: /languages
 *
 * WC requires at least: 2.3.0
 * WC tested up to: 3.4.4
 *
 * Shortcode integration works with at least: 4.4 Visual Composer version, tested up to: 5.5.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define lite version plugin
define( 'SHINDIRI_WOO_SLIDER_LITE', true );

/**
 * If full version plugin activated add admin notice
 */
if ( defined( 'SHINDIRI_WOO_SLIDER_FULL' ) ) {
    add_action( 'admin_notices', 'shindiri_woo_slider_full_version_exists' );
    return;
}

/**
 * Add admin notice if lite version of the plugin already installed
 *
 * @since 1.0.6
 */
function shindiri_woo_slider_full_version_exists() {
   $txt = esc_html__( 'Warning! The full version of the Shindiri Woo Shop Slider plugin is activated. Please deactivate full version if you want to use lite version of the plugin.', 'woo-shop-slider-lite' );
   ?>
   <div class="error">
       <p><?php echo $txt; ?></p>
   </div>
   <?php
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-shindiri-woo-slider-activator.php
 */
if ( !function_exists( 'activate_shindiri_woo_slider' ) ) {
    function activate_shindiri_woo_slider() {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-shindiri-woo-slider-activator.php';
        Shindiri_Woo_Slider_Activator::activate();
    }
    
    register_activation_hook( __FILE__, 'activate_shindiri_woo_slider' );
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-shindiri-woo-slider-deactivator.php
 */
if ( !function_exists( 'deactivate_shindiri_woo_slider' ) ) {
    function deactivate_shindiri_woo_slider() {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-shindiri-woo-slider-deactivator.php';
        Shindiri_Woo_Slider_Deactivator::deactivate();
    }
    
    register_deactivation_hook( __FILE__, 'deactivate_shindiri_woo_slider' );
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
if ( !class_exists( 'Shindiri_Woo_Slider' ) ) {
    require plugin_dir_path( __FILE__ ) . 'includes/class-shindiri-woo-slider.php';
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
if ( !function_exists( 'run_shindiri_woo_slider' ) ) {
    function run_shindiri_woo_slider() {

        $plugin = new Shindiri_Woo_Slider();

        // Check if WooCommerce is active even in multinetwork

        // Make sure function exists
        if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
            require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
        }

        if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
            return;
        }

        // Check if WooCommerce is active
        if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            if (  ! is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) {

                // Add no Woocommerce info functions
                $plugin_admin = new Shindiri_Woo_Slider_Admin( $plugin->plugin_name, $plugin->version );
                add_action( 'admin_menu', array( $plugin_admin, 'no_woocommerce_activated' ) );
                // Change footer text for our post type pages and plugin info page
                add_action( 'admin_footer_text', array( $plugin_admin, 'change_footer_admin_text' ) );
                return;
            }
        }

        $plugin->run();

    }
    run_shindiri_woo_slider();
}