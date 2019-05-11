<?php
add_action( 'wp_enqueue_scripts', 'spabeauty_theme_css',999);
function spabeauty_theme_css() {
    wp_enqueue_style( 'spabeauty-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'spabeauty-child-style', get_stylesheet_uri(), array( 'spabeauty-parent-style' ) );
	wp_enqueue_style( 'spabeauty-default-css', get_stylesheet_directory_uri()."/css/colors/default.css" );
	wp_dequeue_style( 'default',get_template_directory_uri() .'/css/colors/default.css');
}

require( get_stylesheet_directory() . '/customize/ta_customize_homepage.php' );
?>