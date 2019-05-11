<?php 
// Adding customizer home page setting
function shopbiz_style_customizer( $wp_customize ){
//Theme color
class WP_color_Customize_Control extends WP_Customize_Control {
public $type = 'new_menu';

       function render_content()
	   {
	   echo '<h3>Select Your Theme Color</h3>';
		  $name = '_customize-color-radio-' . $this->id; 
		  foreach($this->choices as $key => $value ) {
            ?>
               <label>
				<input type="radio" value="<?php echo $key; ?>" name="<?php echo esc_attr( $name ); ?>" data-customize-setting-link="<?php echo esc_attr( $this->id ); ?>" <?php if($this->value() == $key){ echo 'checked'; } ?>>
				<img <?php if($this->value() == $key){ echo 'class="selected_img"'; } ?> src="<?php echo get_template_directory_uri(); ?>/images/color/<?php echo $value; ?>" alt="<?php echo esc_attr( $value ); ?>" />
				</label>
				
            <?php
		  } ?>
		
		  <script>
			jQuery(document).ready(function($) {
				$("#customize-control-theme_color label img").click(function(){
					$("#customize-control-theme_color label img").removeClass("selected_img");
					$(this).addClass("selected_img");
				});
			});
		  </script>
		  <?php 
       }

}

//Predefined Background color
class WP_back_Customize_Control extends WP_Customize_Control {
public $type = 'new_menu';

       function render_content()
       
	   {
	   echo '<h3>Predefined Default Background</h3>';
		  $name = '_customize-radio-' . $this->id; 
		  foreach($this->choices as $key => $value ) {
            ?>
               <label>
				<input type="radio" value="<?php echo $key; ?>" name="<?php echo esc_attr( $name ); ?>" data-customize-setting-link="<?php echo esc_attr( $this->id ); ?>" <?php if($this->value() == $key){ echo 'checked'; } ?>>
				
				<img <?php if($this->value() == $key){ echo 'class="background_active"'; } ?> src="<?php echo get_template_directory_uri(); ?>/images/bg-pattern/<?php echo esc_attr( $key ); ?>" alt="<?php echo esc_attr( $value ); ?>" />
				</label>
            <?php
		  }
		  ?>
		  <script>
			jQuery(document).ready(function($) {
				$("#customize_control_shopbiz_options-back_image label img").click(function(){
					$("#customize_control_shopbiz_options-back_image label img").removeClass("background_active");
					$(this).addClass("background_active");
				});
			});
		  </script>
		  <?php
       }

}

//Line Break 
class WP_line_break_Customize_Control extends WP_Customize_Control {
public $type = 'new_menu';

       function render_content()
	   {
	   echo '<hr></hr>';
		} }
		
//Line Break 
class WP_line_break_header_Customize_Control extends WP_Customize_Control {
public $type = 'new_menu';

       function render_content()
	   {
	   echo '<hr></hr>';
		} }	


	//Theme Layout Panel
	 $wp_customize->add_panel('shopbiz_theme_style_setting', array(
	 	'priority'   		=> 		200,
     	'capability'       =>      'edit_theme_options',
     	'theme_supports'   =>      '',
     	'title'            =>      __( 'Theme Style Palette', 'shopbiz' ),
    ) );
	
	/* Theme Header Style settings */
	$wp_customize->add_section( 'shopbiz_theme_skin_color', array(
		'title' => __('Set Your Header Color', 'shopbiz'),
		'panel' => 'shopbiz_theme_style_setting',
   	) );
	
	$wp_customize->add_setting('shopbiz_hedaer_skin_enable', array(
        'default' => 'false',
		'sanitize_callback' => 'sanitize_text_field',
    ) );
	$wp_customize->add_control('shopbiz_hedaer_skin_enable', array(
        'label' => __('Enable/Disable Header Custom Color Feature','shopbiz'),
        'section' => 'shopbiz_theme_skin_color',
        'type' => 'radio',
		'choices' => array('true' => 'On','false' => 'Off',)
    ) );

    $wp_customize->add_setting('shopbiz_top_background', array(
		'default' => '#3f51b5',
		'sanitize_callback' => 'sanitize_text_field',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shopbiz_top_background', array(
		'label' => __( 'Top Bar Background Color', 'shopbiz' ),
		'section' => 'shopbiz_theme_skin_color',
		'settings' => 'shopbiz_top_background',) 
	) );

	//Top Bar text color
	$wp_customize->add_setting('shopbiz_top_color', array(
		'default' => '#fff',
		'sanitize_callback' => 'sanitize_text_field',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shopbiz_top_color', array(
		'label'      => __( 'Top Bar Text Color', 'shopbiz' ),
		'section'    => 'shopbiz_theme_skin_color',
		'settings'   => 'shopbiz_top_color',) 
	) );
	
	//Line break
	$wp_customize->add_setting( 
		'shopbiz_break_section', array(
		'sanitize_callback' => 'sanitize_text_field',	
    ) );
	
	$wp_customize->add_control(new WP_line_break_Customize_Control($wp_customize,'shopbiz_break_section', array(
       	'section' => 'shopbiz_theme_skin_color',
		'type' => 'radio',
		'settings' => 'shopbiz_break_section',)
	) );
	
	//header background color
	$wp_customize->add_setting('shopbiz_header_background', array(
	'default' => '#3f51b5',
	'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shopbiz_header_background', array(
		'label'      => __('Header Background Color', 'shopbiz' ),
		'section'    => 'shopbiz_theme_skin_color',
		'settings'   => 'shopbiz_header_background',) 
	) );

	//Site Title Text color
	$wp_customize->add_setting('shopbiz_site_title_color', array(
		'default' => '#fff',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,'shopbiz_site_title_color', array(
		'label'      => __('Site Title Text Color', 'shopbiz' ),
		'section'    => 'shopbiz_theme_skin_color',
		'settings'   => 'shopbiz_site_title_color',) 
	) );

	//Line break
	$wp_customize->add_setting(
	'shopbiz_menu_setting_section',
	array('sanitize_callback' => 'sanitize_text_field',)
	
    );
	
	$wp_customize->add_control(new WP_line_break_header_Customize_Control($wp_customize,'shopbiz_menu_setting_section', array(
       	'section' => 'shopbiz_theme_skin_color',
		'type' => 'radio',
		'settings' => 'shopbiz_menu_setting_section',)
	) );
	
	//Menu Background color
	$wp_customize->add_setting('shopbiz_menu_background', array(
		'default' => '#3f51b5',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shopbiz_menu_background', array(
		'label' => __('Menu Background Color', 'shopbiz' ),
		'section' => 'shopbiz_theme_skin_color',
		'settings' => 'shopbiz_menu_background',) 
	) );

	//Menu Background Hover color
	$wp_customize->add_setting('shopbiz_menu_background_hover', array(
		'default' => '#fff',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shopbiz_menu_background_hover', array(
		'label'      => __('Menu Background Hover/Active Color', 'shopbiz' ),
		'section'    => 'shopbiz_theme_skin_color',
		'settings'   => 'shopbiz_menu_background_hover',) 
	) );

	//Menu text color & Menu active color
	$wp_customize->add_setting('shopbiz_menu_color', array(
		'default' => '#fff',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shopbiz_menu_color', array(
		'label'      => __('Menu Text Color', 'shopbiz' ),
		'section'    => 'shopbiz_theme_skin_color',
		'settings'   => 'shopbiz_menu_color',) 
	) );
	
	//Menu active color-radio-
	$wp_customize->add_setting('shopbiz_menu_active_color', array(
		'default' => '#3f51b5',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shopbiz_menu_active_color', array(
		'label' => __('Menu Text Hover/Active Color', 'shopbiz' ),
		'section' => 'shopbiz_theme_skin_color',
		'settings' => 'shopbiz_menu_active_color',) 
	) );
	
	//Sub Menu Background Color
	$wp_customize->add_setting('shopbiz_menu_submenu_background', array(
		'default' => '#fff',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'shopbiz_menu_submenu_background', array(
		'label' => __('Sub Menu Background Color', 'shopbiz' ),
		'section' => 'shopbiz_theme_skin_color',
		'settings' => 'shopbiz_menu_submenu_background',) 
	) );
	
	
	//Sub Menu Hover Color
	$wp_customize->add_setting('shopbiz_menu_submenu_background_hover', array(
		'default' => '#f5f5f5',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'shopbiz_menu_submenu_background_hover', array(
		'label'      => __('Sub Menu Background Hover color', 'shopbiz' ),
		'section'    => 'shopbiz_theme_skin_color',
		'settings'   => 'shopbiz_menu_submenu_background_hover',) 
	) );
	
	//Sub Menu text Color
	$wp_customize->add_setting('shopbiz_menu_submenu_color', array(
		'default' => '#212121',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shopbiz_menu_submenu_color', array(
		'label'      => __('Sub Menu Text Color', 'shopbiz' ),
		'section'    => 'shopbiz_theme_skin_color',
		'settings'   => 'shopbiz_menu_submenu_color',) 
	) );

	//Sub Menu text Color
	$wp_customize->add_setting('shopbiz_menu_submenu_active_color', array(
		'default' => '#212121',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shopbiz_menu_submenu_active_color', array(
		'label'      => __('Sub Menu Text Hover/Active Color', 'shopbiz' ),
		'section'    => 'shopbiz_theme_skin_color',
		'settings'   => 'shopbiz_menu_submenu_active_color',) 
	) );
	
	//Line break
	$wp_customize->add_setting('shopbiz_menu_setting_section', array(
		'sanitize_callback' => 'sanitize_text_field',
		'sanitize_callback' => 'esc_url_raw',
    ));
	
	$wp_customize->add_control(new WP_line_break_header_Customize_Control($wp_customize,'shopbiz_menu_setting_section', array(
       	'section' => 'shopbiz_theme_skin_color',
		'type' => 'radio',
		'settings' => 'shopbiz_menu_setting_section',)
	) );
	
	/* Theme Footer Style settings */
	$wp_customize->add_section( 'shopbiz_footer_color' , array(
		'title' => __('Set Your Footer Color', 'shopbiz'),
		'panel' => 'shopbiz_theme_style_setting',
   	) );
	
	//Footer Enable Color
    $wp_customize->add_setting('shopbiz_footer_color_enable', array(
        'default' => 'false',
		'sanitize_callback' => 'sanitize_text_field',
    ) );
	$wp_customize->add_control('shopbiz_footer_color_enable', array(
        'label' => __('Enable/Disable Footer Custom Color Feature','shopbiz'),
        'section' => 'shopbiz_footer_color',
        'type' => 'radio',
		'choices' => array('true' => 'On','false' => 'Off',)
    ) );
	
	//Footer background
	$wp_customize->add_setting('shopbiz_footer_background', array(
		'default' => '#202830',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shopbiz_footer_background', array(
		'label' => __('Footer Background Color ', 'shopbiz' ),
		'section' => 'shopbiz_footer_color',
		'settings' => 'shopbiz_footer_background',) 
	) );
	
	//Footer Widget Heading color
	$wp_customize->add_setting('shopbiz_footer_head_color', array(
		'default' => '#fff',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shopbiz_footer_head_color', array(
		'label' => __('Footer Widget Heading Color ', 'shopbiz' ),
		'section' => 'shopbiz_footer_color',
		'settings' => 'shopbiz_footer_head_color',) 
	) );

	//Footer color
	$wp_customize->add_setting('shopbiz_footer_text_color', array(
	'default' => '#969ea7',
	'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,'shopbiz_footer_text_color', array(
		'label' => __('Footer Text Color ', 'shopbiz' ),
		'section' => 'shopbiz_footer_color',
		'settings' => 'shopbiz_footer_text_color',) 
	) );

	$wp_customize->add_setting('shopbiz_footer_text_active_color', array(
	'default' => '#fff',
	'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,'shopbiz_footer_text_active_color', array(
		'label' => __('Footer Text Hover/Active', 'shopbiz' ),
		'section' => 'shopbiz_footer_color',
		'settings' => 'shopbiz_footer_text_active_color',) 
	) );

	//Footer Copyright background
	$wp_customize->add_setting('shopbiz_footer_copy_background', array(
		'default' => '#1a2128',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'shopbiz_footer_copy_background', array(
		'label' => __('Footer Copyright Background Color ', 'shopbiz' ),
		'section' => 'shopbiz_footer_color',
		'settings' => 'shopbiz_footer_copy_background',) 
	) );

	//Footer Copyright Color
	$wp_customize->add_setting('shopbiz_footer_copy_color', array(
		'default' => '#969ea7',
		'sanitize_callback' => 'esc_url_raw',
    ) );
	
	$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'shopbiz_footer_copy_color', array(
		'label' => __('Footer Copyright Text Color ', 'shopbiz' ),
		'section' => 'shopbiz_footer_color',
		'settings' => 'shopbiz_footer_copy_color',) 
	) );
	
	//Line break
	$wp_customize->add_setting(
		'shopbiz_footer_setting_section', array(
		'sanitize_callback' => 'sanitize_text_field',
    ) );
	
	$wp_customize->add_control(new WP_line_break_header_Customize_Control($wp_customize,'shopbiz_footer_setting_section', array(
       	'section' => 'shopbiz_footer_color',
		'type' => 'radio',
		'settings' => 'shopbiz_footer_setting_section',)
	) );
	/* Theme Footer Style settings end */
}
add_action( 'customize_register', 'shopbiz_style_customizer' );