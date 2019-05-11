<?php
function shopbiz_homepage_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
$wp_customize->add_panel( 'homepage_setting', array(
                'priority'       => 450,
                'capability'     => 'edit_theme_options',
                'title'      => __('Homepage Section Settings', 'shopbiz'),
            ) );

		    /* --------------------------------------
		    =========================================
		    Latest News Section
		    =========================================
		    -----------------------------------------*/
		    // add section to manage Latest News
		    $wp_customize->add_section(
		    	'news_section_settings', array(
		        'title' => __('News & Events Setting','shopbiz'),
		        'panel'  => 'homepage_setting'
		    ) );

			//Enable news
			$wp_customize->add_setting(
		    	'shopbiz_news_enable', array(
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'shopbiz_homepage_sanitize_checkbox',
		        'default'=> true,
		    ) );	
		    $wp_customize->add_control( 
		    	'shopbiz_news_enable', array(
		    	'label'   => __('Enable News Section','shopbiz'),
		    	'section' => 'news_section_settings',
		    	'type' => 'checkbox',
		    ) );
			
		    //Latest News Background Image
		    $wp_customize->add_setting( 
		    	'news_background', array(
		    	'sanitize_callback' => 'esc_url_raw',
		    ) );
		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
		    	'news_background', array(
		    	'label'    => __( 'Choose Background Image', 'shopbiz' ),
		    	'section'  => 'news_section_settings',
		    	'settings' => 'news_background', ) 
		    ) );

		    //Latest News Overlay color
            $wp_customize->add_setting(
                'news_section_color', array( 'sanitize_callback' => 'sanitize_text_field',
            ) );
            
            $wp_customize->add_control(new shopbiz_Customize_Alpha_Color_Control( $wp_customize,'news_section_color', array(
                'label' => __('News Section Overlay Color', 'shopbiz' ),
                'palette' => true,
                'section' => 'news_section_settings')
            ) );

            // hide meta content
            $wp_customize->add_setting(
                'disable_news_meta', array(
                'default' => 'false',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control(
                'disable_news_meta', array(
                'label' => __('Hide/Show Blog Meta:- Like author name,categories', 'shopbiz'),
                'description'   => __('Hide / Show Blog Meta:- Like author name,categories', 'shopbiz'),
                'section' => 'news_section_settings',
                'type' => 'radio',
                'choices' => array('true'=>'On','false'=>'Off'),
            ) );

		    // Latest News Title Setting
		    $wp_customize->add_setting(
		    	'shopbiz_news_title', array(
		        'default' => esc_html__('Latest News','shopbiz'),
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'shopbiz_homepage_title_sanitize_text',
		        'transport'         => $selective_refresh,
		    ) );	
		    $wp_customize->add_control( 
		    	'shopbiz_news_title',array(
		    	'label'   => __('Latest News Title','shopbiz'),
		    	'section' => 'news_section_settings',
		    	'type' => 'text',
		    ) );

		    // Latest News Subtitle Setting
		    $wp_customize->add_setting(
		    	'shopbiz_news_subtitle', array(
		        'capability'     => 'edit_theme_options',
		        'default' => 'laoreet ipsum eu laoreet. ugiignissimat Vivamus dignissim feugiat erat sit amet convallis.',
		        'sanitize_callback' => 'shopbiz_homepage_title_sanitize_text',
		        'transport'         => $selective_refresh,
		    ) );  
		    $wp_customize->add_control( 
		    	'shopbiz_news_subtitle',array(
		    	'label'   => __('Latest News Subtitle','shopbiz'),
		    	'section' => 'news_section_settings',
		    	'type' => 'textarea',
		    ) );	

		   
			



			
			

			function shopbiz_homepage_sanitize_checkbox( $input ) {
			// Boolean check 
			return ( ( isset( $input ) && true == $input ) ? true : false );
			}
			
			
			function shopbiz_homepage_title_sanitize_text ( $input ) {

			return wp_kses_post( force_balance_tags( $input ) );

			}	

			
			
}

add_action( 'customize_register', 'shopbiz_homepage_setting' );


/**
 * Selective refresh for news section
 */
function shopbiz_register_news_section_partials( $wp_customize ){

	//Service
	$wp_customize->selective_refresh->add_partial( 'shopbiz_news_title', array(
		'selector'            => '.ta-blog-section .shopbiz-heading h3',
		'settings'            => 'shopbiz_news_title',
		'render_callback'  => 'shopbiz_news_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'shopbiz_news_subtitle', array(
		'selector'            => '.ta-blog-section .shopbiz-heading p',
		'settings'            => 'shopbiz_news_subtitle',
		'render_callback'  => 'shopbiz_news_discription_render_callback',
	
	) );
	
}

add_action( 'customize_register', 'shopbiz_register_news_section_partials' );



function shopbiz_news_title_render_callback() {
	return get_theme_mod( 'shopbiz_news_title' );
}

function shopbiz_news_discription_render_callback() {
	return get_theme_mod( 'shopbiz_news_subtitle' );
}
?>