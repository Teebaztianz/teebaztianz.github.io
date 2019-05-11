<?php
function shopbiz_header_setting( $wp_customize ) {
$wp_customize->remove_control('header_textcolor');

/* Header Section */
	$wp_customize->add_panel( 'header_options', array(
		'priority' => 450,
		'capability' => 'edit_theme_options',
		'title' => __('Header Settings', 'shopbiz'),
	) );
	
	$wp_customize->add_section( 'header_contact' , array(
		'title' => __('Header Info Details Setting', 'shopbiz'),
		'panel' => 'header_options',
   	) );
	
	$wp_customize->add_setting(
		'shopbiz_head_info_one', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'shopbiz_header_sanitize_text',
		'default' => '<li><a><i class="fa fa-clock-o "></i>Open-Hours:10 am to 7pm</a></li>',
    ) );
    $wp_customize->add_control( 'shopbiz_head_info_one', array(
        'label' => __('Info One:', 'shopbiz'),
        'section' => 'header_contact',
        'type' => 'textarea',
    ) );
	
	
	$wp_customize->add_setting(
		'shopbiz_head_info_two', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'shopbiz_header_sanitize_text',
		'default' => '<li><a href="mailto:info@themeansar.com" title="Mail Me"><i class="fa fa-envelope"></i> info@themeansar.com</a></li>',
    ) );
    $wp_customize->add_control( 'shopbiz_head_info_two', array(
        'label' => __('Info Two:', 'shopbiz'),
        'section' => 'header_contact',
        'type' => 'textarea',
    ) );
	
	function shopbiz_header_sanitize_text( $input ) {

    return wp_kses_post( force_balance_tags( $input ) );

	}
	
	}
	add_action( 'customize_register', 'shopbiz_header_setting' );
	?>