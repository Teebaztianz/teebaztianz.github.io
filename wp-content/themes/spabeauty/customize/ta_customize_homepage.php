<?php function spabeauty_callout_setting( $wp_customize ) { 

			/* --------------------------------------
            =========================================
            Call To Action Section
            =========================================
            -----------------------------------------*/  
            //calltoaction settings
            $wp_customize->add_section(
                'spa_calltoaction_section_settings', array(
                'title' => __('Call to action setting','spabeauty'),
				'panel'  => 'homepage_setting',
				'priority' => 170,
            ) ); 

        	//Call to action Enable / Disable setting
        	$wp_customize->add_setting(
        		'spa_calltoaction_enable', array(
        		'default'        => 'true',
        		'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
        	) );
        	$wp_customize->add_control('spa_calltoaction_enable', array(
        		'label'   => __('Hide/Show call to action section', 'spabeauty'),
        		'section' => 'spa_calltoaction_section_settings',
        		'type'    => 'radio',
        		'choices'=>array('true'=>__('On','spabeauty'), 'false'=>__('Off','spabeauty')),
        	) );

            //Call to action Background image
            $wp_customize->add_setting( 'spa_calltoaction_background', array(
                'sanitize_callback' => 'esc_url_raw',
            ) );

            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
            	'spa_calltoaction_background', array(
                'label'    => __( 'Choose background image', 'spabeauty' ),
                'section'  => 'spa_calltoaction_section_settings',
                'settings' => 'spa_calltoaction_background',) 
            ) );

           
			//Callto action overlay color
			$wp_customize->add_setting(
				'spa_overlay_calltoaction_color_control', array( 'sanitize_callback' => 'sanitize_text_field',
				
				)
			);
			
			$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'spa_overlay_calltoaction_color_control', array(
				'label'      => __('Overlay color', 'spabeauty' ),
				'palette' => true,
				'section' => 'spa_calltoaction_section_settings',
				'settings' => 'spa_overlay_calltoaction_color_control',) 
				)
			) ;

            //product Text Color setting
            $wp_customize->add_setting(
                'spa_calltoaction_text_color', array( 'sanitize_callback' => 'sanitize_text_field',
                
            ) );
            
            $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'spa_calltoaction_text_color', array(
               'label'      => __('Text color', 'spabeauty' ),
                'palette' => true,
                'section' => 'spa_calltoaction_section_settings')
            ) );
			
			

            // Call to action Title Setting
            $wp_customize->add_setting(
            	'spa_calltoaction_title', array(
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ) );  
            $wp_customize->add_control( 
            	'spa_calltoaction_title', array(
                'label'   => __('Section title','spabeauty'),
                'section' => 'spa_calltoaction_section_settings',
                'type' => 'text',
            ) );
			
			// Call to action Description
            $wp_customize->add_setting(
            	'spa_calltoaction_subtitle', array(
                'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'spa_template_sanitize_text',
            ) );  
            $wp_customize->add_control( 
            	'spa_calltoaction_subtitle', array(
                'label'   => __('Section subtitle','spabeauty'),
                'section' => 'spa_calltoaction_section_settings',
                'type' => 'textarea',
            ) );
   
            // Call to action Button  Label
            $wp_customize->add_setting(
                'spa_calltoaction_button_one_label', array(
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ) );  
            $wp_customize->add_control( 
            	'spa_calltoaction_button_one_label', array(
                'label'   => __('Button title','spabeauty'),
                'section' => 'spa_calltoaction_section_settings',
                'type' => 'text',
            ) ); 

            // Call to action Button  link
            $wp_customize->add_setting(
                'spa_calltoaction_button_one_link', array(
                'default' =>  '#',
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            ) );  
            $wp_customize->add_control( 
            	'spa_calltoaction_button_one_link', array(
                'label'   => __('Button link','spabeauty'),
                'section' => 'spa_calltoaction_section_settings',
                'type' => 'text'
            ) );  

             //Call to action Button Target
            $wp_customize->add_setting(
                'spa_calltoaction_button_one_target', array(
                'default' => 'true',
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ) );  
            $wp_customize->add_control( 
            	'spa_calltoaction_button_one_target', array(
                'label'   => __('Open link in new tab/window','spabeauty'),
                'section' => 'spa_calltoaction_section_settings',
                'type' => 'checkbox'
            ) );

		   
}
add_action( 'customize_register', 'spabeauty_callout_setting' );
?>