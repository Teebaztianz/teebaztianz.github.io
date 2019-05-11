<?php
/*
 * Plugin Name:       Icyclub
 * Plugin URI:        
 * Description:       Icyclub plugin is comptible for Themeansar theme.
 * Version:           1.3
 * Author:            themeicy
 * Author URI:        https://themeicy.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       icyclub
 * Domain Path:       /languages
 */
 
define( 'ICYCP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ICYCP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

function icycp_activate() {
	$theme = wp_get_theme();
	if ( 'Consultup' == $theme->name){
		require_once('inc/consultup/features/customizer.php');
		require_once('inc/consultup/sections/homepage.php');
	}

	elseif ( 'Shopbiz Lite' == $theme->name){
		require_once('inc/shopbiz/features/customizer.php');
		require_once('inc/shopbiz/sections/homepage.php');
	}
}
add_action( 'init', 'icycp_activate' );

function icycp_enqueue(){
	wp_enqueue_style('icycp-custom-controls-css', plugin_dir_url(__FILE__) . 'assets/css/customizer.css', false, '1.0.0');
}
add_action('admin_enqueue_scripts', 'icycp_enqueue');


function icycp_customizer_section_live_preview() {
	wp_enqueue_script(
		'icycp-section-customizer-preview', plugin_dir_url(__FILE__) . 'assets/js/customizer.js', array(
			'jquery',
			'customize-preview',
		), 999, true
	);
}
add_action( 'customize_preview_init', 'icycp_customizer_section_live_preview' );


$theme = wp_get_theme();
if ( 'Consultup' == $theme->name){
		
	
register_activation_hook( __FILE__, 'icycp_page_installation_function');
function icycp_page_installation_function()
{	
$item_details_page = get_option('item_details_page'); 
    if(!$item_details_page){
	require_once('inc/consultup/pages/home.php');
	require_once('inc/consultup/pages/blog.php');
	update_option( 'item_details_page', 'Done' );
   }
}
}

if ( 'Shopbiz Lite' == $theme->name){
register_activation_hook( __FILE__, 'icycp_page_installation_function');
function icycp_page_installation_function()
{	
$item_details_page = get_option('item_details_page'); 
    if(!$item_details_page){
	require_once('inc/shopbiz/pages/home.php');
	require_once('inc/shopbiz/pages/blog.php');
	update_option( 'item_details_page', 'Done' );
   }
}
}
?>