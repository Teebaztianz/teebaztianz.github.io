<?php 
/**
Template Name: Home Page
*/
		get_header(); 
		
		//=========== Get Home Slider ===========//
		get_template_part('sections/home','slider');
		
		//=========== Get Index callout ===========//
		get_template_part('sections/home', 'calltoaction');	
		
		//=========== Get Index Category ===========//
		get_template_part('sections/home', 'services');	
		
		//=========== Get Index Callout ===========//		
		get_template_part('sections/home', 'feature');		
		
		//=========== Get Index News ===========//
		get_template_part('sections/home', 'blog');

get_footer();

?>