<?php
function shopbiz_scripts() {
	wp_enqueue_style('Poppins-font', 'https://fonts.googleapis.com/css?family=Poppins');
	
	wp_enqueue_style('bootstrap_style', get_template_directory_uri() . '/css/bootstrap.css');

    wp_enqueue_style('bootstrap_style_min', get_template_directory_uri() . '/css/bootstrap.min.css');

	wp_enqueue_style( 'shopbiz-style', get_stylesheet_uri() );

	wp_enqueue_style('shopbiz_color', get_template_directory_uri() . '/css/colors/default.css');
	
	wp_enqueue_style('smartmenus',get_template_directory_uri().'/css/jquery.smartmenus.bootstrap.css');

    wp_enqueue_style('carousel',get_template_directory_uri().'/css/owl.carousel.css');

    wp_enqueue_style('owl_transitions',get_template_directory_uri().'/css/owl.transitions.css');

    wp_enqueue_style('font-awesome',get_template_directory_uri().'/css/font-awesome.css');

	wp_enqueue_style('font-awesome_min',get_template_directory_uri().'/css/font-awesome.min.css');

	wp_enqueue_style('animate',get_template_directory_uri().'/css/animate.css');

    wp_enqueue_style('animate_min',get_template_directory_uri().'/css/animate.min.css');

	/* Js script */

   wp_enqueue_script( 'shopbiz-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'));
    
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));

     wp_enqueue_script('smartmenus', get_template_directory_uri() . '/js/jquery.smartmenus.js' , array('jquery'));

     wp_enqueue_script('smartmenus_bootstrap', get_template_directory_uri() . '/js/jquery.smartmenus.bootstrap.js' , array('jquery'));

    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'));

    wp_enqueue_script('shopbiz-custom', get_template_directory_uri() . '/js/custom.js' , array('jquery'));


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'shopbiz_scripts');

//Header Custom Color
function shopbiz_header_color() {
    $shopbiz_hedaer_skin_enable = get_theme_mod('shopbiz_hedaer_skin_enable','false');
    if( $shopbiz_hedaer_skin_enable == 'true') {
    header_color();
    }
}
add_action('wp_footer','shopbiz_header_color');

//Footer Custom Color
function shopbiz_footer_color() {
    $shopbiz_footer_color_enable = get_theme_mod('shopbiz_footer_color_enable','false');
    if( $shopbiz_footer_color_enable == 'true') {
        footer_color();
    }
}
add_action('wp_footer','shopbiz_footer_color');
?>