<?php
// Footer copyright section 
function shopbiz_footer_copyright( $wp_customize ) {
	$wp_customize->add_panel('shopbiz_copyright', array(
		'priority' => 500,
		'capability' => 'edit_theme_options',
		'title' => __('Footer Settings','shopbiz'),
	) );
	
	$wp_customize->add_section('copyright_section_one', array(
        'title' => __('Footer Copyright Settings','shopbiz'),
        'description' => __('This is a Footer section.','shopbiz'),
        'priority' => 35,
		'panel' => 'shopbiz_copyright',
    ) );

    // hide meta content
    $wp_customize->add_setting( 'hide_copyright',array(
        'default' => 'true',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control('hide_copyright', array(
        'label' => __('Hide/Show Copyright Text','shopbiz'),
        'description'   => __('Hide/Show Footer Copyright Text', 'shopbiz'),
        'section' => 'copyright_section_one',
        'type' => 'radio',
        'choices' => array('true'=>'On','false'=>'Off'),
    ) );
	
	
	$wp_customize->add_setting('shopbiz_footer_copyright_setting', array(
		'sanitize_callback' => 'shopbiz_footer_copyright_sanitize_text',
        'default' => __('<p>&copy; Copyright 2019 by <a href="#">shopbiz</a>. All Rights Reserved. Powered by <a href="https://wordpress.org/">WordPress</a></p>','shopbiz'),
        
    ) );
    $wp_customize->add_control('shopbiz_footer_copyright_setting', array(
        'label' => __('Copyright text','shopbiz'),
        'section' => 'copyright_section_one',
        'type' => 'textarea',
    ) );
    

	//Footer social link 
	$wp_customize->add_section('copyright_social_icon', array(
        'title' => __('Social Link','shopbiz'),
        'priority' => 45,
		'panel' => 'shopbiz_copyright',
    ) );

	//Hide Footer Social Icons
	$wp_customize->add_setting('hide_footer_icon', array(
        'default' => 'true',
		'sanitize_callback' => 'sanitize_text_field',
    ) );
	$wp_customize->add_control('hide_footer_icon', array(
        'label' => __('Hide/Show Social Icons','shopbiz'),
        'description' => __('Hide/Show Footer Social Icons', 'shopbiz'),
        'section' => 'copyright_social_icon',
        'type' => 'radio',
        'choices' => array('true'=>'On','false'=>'Off'),
    ) );

	// Facebook link
	$wp_customize->add_setting('social_link_facebook', array(
       'sanitize_callback' => 'esc_url_raw',
	   'default' => '#',
    ) );
	$wp_customize->add_control('social_link_facebook', array(
        'label' => __('Facebook URL','shopbiz'),
        'section' => 'copyright_social_icon',
        'type' => 'text',
    ) );

	$wp_customize->add_setting(
        'Social_link_facebook_tab',array(
        'sanitize_callback' => 'shopbiz_copyright_sanitize_checkbox',
	));
	$wp_customize->add_control('Social_link_facebook_tab', array(
        'type' => 'checkbox',
        'label' => __('Open Link New tab/window','shopbiz'),
        'section' => 'copyright_social_icon',
    ) );

	//Twitter link
	$wp_customize->add_setting( 'social_link_twitter', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '#',
    ) );
	$wp_customize->add_control( 'social_link_twitter', array(
        'label' => __('Twitter URL','shopbiz'),
        'section' => 'copyright_social_icon',
        'type' => 'text',
    ) );

	$wp_customize->add_setting( 'Social_link_twitter_tab',array(
	   'sanitize_callback' => 'shopbiz_copyright_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'Social_link_twitter_tab', array(
        'type' => 'checkbox',
        'label' => __('Open Link New tab/window','shopbiz'),
        'section' => 'copyright_social_icon',
    ) );

	//Linkdin link
	$wp_customize->add_setting( 'social_link_linkedin', array(
        'sanitize_callback' => 'esc_url_raw',
		'default' => '#',
    ) );
	$wp_customize->add_control( 'social_link_linkedin', array(
        'label' => __('Linkedin URL','shopbiz'),
        'section' => 'copyright_social_icon',
        'type' => 'text',
    ) );

	$wp_customize->add_setting( 
        'Social_link_linkedin_tab',array(
        'sanitize_callback' => 'shopbiz_copyright_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'Social_link_linkedin_tab', array(
        'type' => 'checkbox',
        'label' => __('Open Link New tab/window','shopbiz'),
        'section' => 'copyright_social_icon',
    ) );

	//Google-plus link
	$wp_customize->add_setting('social_link_google', array(
		'sanitize_callback' => 'esc_url_raw',
		'default' => '#',
    ) );
	$wp_customize->add_control('social_link_google', array(
        'label' => __('Google-plus URL','shopbiz'),
        'section' => 'copyright_social_icon',
        'type' => 'text',
    ) );

	$wp_customize->add_setting(
        'Social_link_google_tab',array(
        'sanitize_callback' => 'shopbiz_copyright_sanitize_checkbox',
	) );

	$wp_customize->add_control('Social_link_google_tab', array(
        'type' => 'checkbox',
        'label' => __('Open Link New tab/window','shopbiz'),
        'section' => 'copyright_social_icon',
    ) );

		
	function shopbiz_footer_copyright_sanitize_text( $input ) {

    return wp_kses_post( force_balance_tags( $input ) );

	}
	
	function shopbiz_copyright_sanitize_checkbox( $input ) {
	// Boolean check 
	return ( ( isset( $input ) && true == $input ) ? true : false );
	}
	
}
add_action( 'customize_register', 'shopbiz_footer_copyright' );
?>