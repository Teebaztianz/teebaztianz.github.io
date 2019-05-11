<?php 
/**
 // Template Name: Homepage
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package shopbiz
 */
get_header();

	do_action( 'icycp_shopbiz_homepage_sections', false );
	//=========== Get Index News ===========//
		get_template_part('sections/home', 'blog');
	
get_footer();
?>