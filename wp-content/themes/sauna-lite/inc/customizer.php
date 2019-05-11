<?php
/**
 * Sauna Lite Theme Customizer
 *
 * @package Sauna Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sauna_lite_customize_register( $wp_customize ) {

	/* Custom panel type - used for multiple levels of panels */
	if ( class_exists( 'WP_Customize_Panel' ) ) {

		/**
		 * Class Sauna_Lite_WP_Customize_Panel
		 */
		class Sauna_Lite_WP_Customize_Panel extends WP_Customize_Panel {

			/**
			 * Panel
			 *
			 * @var $panel string Panel
			 */
			public $panel;

			/**
			 * Panel type
			 *
			 * @var $type string Panel type.
			 */
			public $type = 'sauna_lite_panel';

			/**
			 * Form the json
			 */
			public function json() {

				$array                   = wp_array_slice_assoc(
					(array) $this, array(
						'id',
						'description',
						'priority',
						'type',
						'panel',
					)
				);
				$array['title']          = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
				$array['content']        = $this->get_content();
				$array['active']         = $this->active();
				$array['instanceNumber'] = $this->instance_number;

				return $array;

			}

		}

	}

	$wp_customize->register_panel_type( 'Sauna_Lite_WP_Customize_Panel' );

	/**
	 * Upsells
	 */
	load_template( trailingslashit( get_template_directory() ) . 'inc/class-customizer-theme-info-control.php' );

	$wp_customize->add_section(
		'sauna_lite_theme_info_main_section', array(
			'title'    => __( 'View PRO version', 'sauna-lite' ),
			'priority' => 1,
		)
	);
	$wp_customize->add_setting(
		'sauna_lite_theme_info_main_control', array(
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		new sauna_lite_Theme_Info(
			$wp_customize, 'sauna_lite_theme_info_main_control', array(
				'section'     => 'sauna_lite_theme_info_main_section',
				'priority'    => 100,
				'options'     => array(
					esc_html__( 'Enable-Disable options on every section', 'sauna-lite' ),
					esc_html__( 'Background Color & Image Option', 'sauna-lite' ),
					esc_html__( '100+ Font Family Options', 'sauna-lite' ),
					esc_html__( 'Advanced Color options', 'sauna-lite' ),
					esc_html__( 'Translation ready', 'sauna-lite' ),
					esc_html__( 'Gallery, Banner, Post Type Plugin Functionality', 'sauna-lite' ),
					esc_html__( 'Integrated Google map', 'sauna-lite' ),
					esc_html__( '1 Year Free Support', 'sauna-lite' ),
				),
				'button_url'  => esc_url( 'https://www.themescaliber.com/premium/sauna-spa-wordpress-theme' ),
				'button_text' => esc_html__( 'View PRO version', 'sauna-lite' ),
			)
		)
	);

	$font_array = array(
        '' => __( 'No Fonts', 'sauna-lite' ),
        'Abril Fatface' => __( 'Abril Fatface', 'sauna-lite' ),
        'Acme' => __( 'Acme', 'sauna-lite' ),
        'Anton' => __( 'Anton', 'sauna-lite' ),
        'Architects Daughter' => __( 'Architects Daughter', 'sauna-lite' ),
        'Arimo' => __( 'Arimo', 'sauna-lite' ),
        'Arsenal' => __( 'Arsenal', 'sauna-lite' ),
        'Arvo' => __( 'Arvo', 'sauna-lite' ),
        'Alegreya' => __( 'Alegreya', 'sauna-lite' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'sauna-lite' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'sauna-lite' ),
        'Bangers' => __( 'Bangers', 'sauna-lite' ),
        'Boogaloo' => __( 'Boogaloo', 'sauna-lite' ),
        'Bad Script' => __( 'Bad Script', 'sauna-lite' ),
        'Bitter' => __( 'Bitter', 'sauna-lite' ),
        'Bree Serif' => __( 'Bree Serif', 'sauna-lite' ),
        'BenchNine' => __( 'BenchNine', 'sauna-lite' ),
        'Cabin' => __( 'Cabin', 'sauna-lite' ),
        'Cardo' => __( 'Cardo', 'sauna-lite' ),
        'Courgette' => __( 'Courgette', 'sauna-lite' ),
        'Cherry Swash' => __( 'Cherry Swash', 'sauna-lite' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'sauna-lite' ),
        'Crimson Text' => __( 'Crimson Text', 'sauna-lite' ),
        'Cuprum' => __( 'Cuprum', 'sauna-lite' ),
        'Cookie' => __( 'Cookie', 'sauna-lite' ),
        'Chewy' => __( 'Chewy', 'sauna-lite' ),
        'Days One' => __( 'Days One', 'sauna-lite' ),
        'Dosis' => __( 'Dosis', 'sauna-lite' ),
        'Droid Sans' => __( 'Droid Sans', 'sauna-lite' ),
        'Economica' => __( 'Economica', 'sauna-lite' ),
        'Fredoka One' => __( 'Fredoka One', 'sauna-lite' ),
        'Fjalla One' => __( 'Fjalla One', 'sauna-lite' ),
        'Francois One' => __( 'Francois One', 'sauna-lite' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'sauna-lite' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'sauna-lite' ),
        'Great Vibes' => __( 'Great Vibes', 'sauna-lite' ),
        'Handlee' => __( 'Handlee', 'sauna-lite' ),
        'Hammersmith One' => __( 'Hammersmith One', 'sauna-lite' ),
        'Inconsolata' => __( 'Inconsolata', 'sauna-lite' ),
        'Indie Flower' => __( 'Indie Flower', 'sauna-lite' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'sauna-lite' ),
        'Julius Sans One' => __( 'Julius Sans One', 'sauna-lite' ),
        'Josefin Slab' => __( 'Josefin Slab', 'sauna-lite' ),
        'Josefin Sans' => __( 'Josefin Sans', 'sauna-lite' ),
        'Kanit' => __( 'Kanit', 'sauna-lite' ),
        'Lobster' => __( 'Lobster', 'sauna-lite' ),
        'Lato' => __( 'Lato', 'sauna-lite' ),
        'Lora' => __( 'Lora', 'sauna-lite' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'sauna-lite' ),
        'Lobster Two' => __( 'Lobster Two', 'sauna-lite' ),
        'Merriweather' => __( 'Merriweather', 'sauna-lite' ),
        'Monda' => __( 'Monda', 'sauna-lite' ),
        'Montserrat' => __( 'Montserrat', 'sauna-lite' ),
        'Muli' => __( 'Muli', 'sauna-lite' ),
        'Marck Script' => __( 'Marck Script', 'sauna-lite' ),
        'Noto Serif' => __( 'Noto Serif', 'sauna-lite' ),
        'Open Sans' => __( 'Open Sans', 'sauna-lite' ),
        'Overpass' => __( 'Overpass', 'sauna-lite' ),
        'Overpass Mono' => __( 'Overpass Mono', 'sauna-lite' ),
        'Oxygen' => __( 'Oxygen', 'sauna-lite' ),
        'Orbitron' => __( 'Orbitron', 'sauna-lite' ),
        'Patua One' => __( 'Patua One', 'sauna-lite' ),
        'Pacifico' => __( 'Pacifico', 'sauna-lite' ),
        'Padauk' => __( 'Padauk', 'sauna-lite' ),
        'Playball' => __( 'Playball', 'sauna-lite' ),
        'Playfair Display' => __( 'Playfair Display', 'sauna-lite' ),
        'PT Sans' => __( 'PT Sans', 'sauna-lite' ),
        'Philosopher' => __( 'Philosopher', 'sauna-lite' ),
        'Permanent Marker' => __( 'Permanent Marker', 'sauna-lite' ),
        'Poiret One' => __( 'Poiret One', 'sauna-lite' ),
        'Quicksand' => __( 'Quicksand', 'sauna-lite' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'sauna-lite' ),
        'Raleway' => __( 'Raleway', 'sauna-lite' ),
        'Rubik' => __( 'Rubik', 'sauna-lite' ),
        'Rokkitt' => __( 'Rokkitt', 'sauna-lite' ),
        'Russo One' => __( 'Russo One', 'sauna-lite' ),
        'Righteous' => __( 'Righteous', 'sauna-lite' ),
        'Slabo' => __( 'Slabo', 'sauna-lite' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'sauna-lite' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'sauna-lite'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'sauna-lite' ),
        'Sacramento' => __( 'Sacramento', 'sauna-lite' ),
        'Shrikhand' => __( 'Shrikhand', 'sauna-lite' ),
        'Tangerine' => __( 'Tangerine', 'sauna-lite' ),
        'Ubuntu' => __( 'Ubuntu', 'sauna-lite' ),
        'VT323' => __( 'VT323', 'sauna-lite' ),
        'Varela Round' => __( 'Varela Round', 'sauna-lite' ),
        'Vampiro One' => __( 'Vampiro One', 'sauna-lite' ),
        'Vollkorn' => __( 'Vollkorn', 'sauna-lite' ),
        'Volkhov' => __( 'Volkhov', 'sauna-lite' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'sauna-lite' )
    );

	//add home page setting pannel
	$wp_customize->add_panel( 'sauna_lite_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'sauna-lite' ),
	    'description' => __( 'Description of what this panel does.', 'sauna-lite' )
	) );

	//Color / Font Pallete
	$wp_customize->add_section( 'sauna_lite_typography', array(
    	'title'      => __( 'Color / Font Pallete', 'sauna-lite' ),
		'priority'   => 30,
		'panel' => 'sauna_lite_panel_id'
	) );
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'sauna_lite_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sauna_lite_paragraph_color', array(
		'label' => __('Paragraph Color', 'sauna-lite'),
		'section' => 'sauna_lite_typography',
		'settings' => 'sauna_lite_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('sauna_lite_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'sauna_lite_sanitize_choices'
	));
	$wp_customize->add_control(
	    'sauna_lite_paragraph_font_family', array(
	    'section'  => 'sauna_lite_typography',
	    'label'    => __( 'Paragraph Fonts','sauna-lite'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	$wp_customize->add_setting('sauna_lite_paragraph_font_size',array(
		'default'	=> '12px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sauna_lite_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','sauna-lite'),
		'section'	=> 'sauna_lite_typography',
		'setting'	=> 'sauna_lite_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'sauna_lite_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sauna_lite_atag_color', array(
		'label' => __('"a" Tag Color', 'sauna-lite'),
		'section' => 'sauna_lite_typography',
		'settings' => 'sauna_lite_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('sauna_lite_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'sauna_lite_sanitize_choices'
	));
	$wp_customize->add_control(
	    'sauna_lite_atag_font_family', array(
	    'section'  => 'sauna_lite_typography',
	    'label'    => __( '"a" Tag Fonts','sauna-lite'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'sauna_lite_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sauna_lite_li_color', array(
		'label' => __('"li" Tag Color', 'sauna-lite'),
		'section' => 'sauna_lite_typography',
		'settings' => 'sauna_lite_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('sauna_lite_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'sauna_lite_sanitize_choices'
	));
	$wp_customize->add_control(
	    'sauna_lite_li_font_family', array(
	    'section'  => 'sauna_lite_typography',
	    'label'    => __( '"li" Tag Fonts','sauna-lite'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'sauna_lite_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sauna_lite_h1_color', array(
		'label' => __('H1 Color', 'sauna-lite'),
		'section' => 'sauna_lite_typography',
		'settings' => 'sauna_lite_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('sauna_lite_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'sauna_lite_sanitize_choices'
	));
	$wp_customize->add_control(
	    'sauna_lite_h1_font_family', array(
	    'section'  => 'sauna_lite_typography',
	    'label'    => __( 'H1 Fonts','sauna-lite'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('sauna_lite_h1_font_size',array(
		'default'	=> '50px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sauna_lite_h1_font_size',array(
		'label'	=> __('H1 Font Size','sauna-lite'),
		'section'	=> 'sauna_lite_typography',
		'setting'	=> 'sauna_lite_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'sauna_lite_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sauna_lite_h2_color', array(
		'label' => __('h2 Color', 'sauna-lite'),
		'section' => 'sauna_lite_typography',
		'settings' => 'sauna_lite_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('sauna_lite_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'sauna_lite_sanitize_choices'
	));
	$wp_customize->add_control(
	    'sauna_lite_h2_font_family', array(
	    'section'  => 'sauna_lite_typography',
	    'label'    => __( 'h2 Fonts','sauna-lite'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('sauna_lite_h2_font_size',array(
		'default'	=> '45px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sauna_lite_h2_font_size',array(
		'label'	=> __('h2 Font Size','sauna-lite'),
		'section'	=> 'sauna_lite_typography',
		'setting'	=> 'sauna_lite_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'sauna_lite_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sauna_lite_h3_color', array(
		'label' => __('h3 Color', 'sauna-lite'),
		'section' => 'sauna_lite_typography',
		'settings' => 'sauna_lite_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('sauna_lite_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'sauna_lite_sanitize_choices'
	));
	$wp_customize->add_control(
	    'sauna_lite_h3_font_family', array(
	    'section'  => 'sauna_lite_typography',
	    'label'    => __( 'h3 Fonts','sauna-lite'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('sauna_lite_h3_font_size',array(
		'default'	=> '36px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sauna_lite_h3_font_size',array(
		'label'	=> __('h3 Font Size','sauna-lite'),
		'section'	=> 'sauna_lite_typography',
		'setting'	=> 'sauna_lite_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'sauna_lite_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sauna_lite_h4_color', array(
		'label' => __('h4 Color', 'sauna-lite'),
		'section' => 'sauna_lite_typography',
		'settings' => 'sauna_lite_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('sauna_lite_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'sauna_lite_sanitize_choices'
	));
	$wp_customize->add_control(
	    'sauna_lite_h4_font_family', array(
	    'section'  => 'sauna_lite_typography',
	    'label'    => __( 'h4 Fonts','sauna-lite'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('sauna_lite_h4_font_size',array(
		'default'	=> '30px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sauna_lite_h4_font_size',array(
		'label'	=> __('h4 Font Size','sauna-lite'),
		'section'	=> 'sauna_lite_typography',
		'setting'	=> 'sauna_lite_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'sauna_lite_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sauna_lite_h5_color', array(
		'label' => __('h5 Color', 'sauna-lite'),
		'section' => 'sauna_lite_typography',
		'settings' => 'sauna_lite_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('sauna_lite_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'sauna_lite_sanitize_choices'
	));
	$wp_customize->add_control(
	    'sauna_lite_h5_font_family', array(
	    'section'  => 'sauna_lite_typography',
	    'label'    => __( 'h5 Fonts','sauna-lite'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('sauna_lite_h5_font_size',array(
		'default'	=> '25px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sauna_lite_h5_font_size',array(
		'label'	=> __('h5 Font Size','sauna-lite'),
		'section'	=> 'sauna_lite_typography',
		'setting'	=> 'sauna_lite_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'sauna_lite_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sauna_lite_h6_color', array(
		'label' => __('h6 Color', 'sauna-lite'),
		'section' => 'sauna_lite_typography',
		'settings' => 'sauna_lite_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('sauna_lite_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'sauna_lite_sanitize_choices'
	));
	$wp_customize->add_control(
	    'sauna_lite_h6_font_family', array(
	    'section'  => 'sauna_lite_typography',
	    'label'    => __( 'h6 Fonts','sauna-lite'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('sauna_lite_h6_font_size',array(
		'default'	=> '18px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sauna_lite_h6_font_size',array(
		'label'	=> __('h6 Font Size','sauna-lite'),
		'section'	=> 'sauna_lite_typography',
		'setting'	=> 'sauna_lite_h6_font_size',
		'type'	=> 'text'
	));

	$wp_customize->add_section( 'sauna_lite_left_right', array(
    	'title'      => __( 'Layout Settings', 'sauna-lite' ),
		'priority'   => null,
		'panel' => 'sauna_lite_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('sauna_lite_theme_options',array(
	        'default' => '',
	        'sanitize_callback' => 'sauna_lite_sanitize_choices'	        
	)  );

	$wp_customize->add_control('sauna_lite_theme_options',
	    array(
	        'type' => 'radio',
	        'label' => __('Do you want this section','sauna-lite'),
	        'section' => 'sauna_lite_left_right',
	        'choices' => array(
	            'Left Sidebar' => __('Left Sidebar','sauna-lite'),
	            'Right Sidebar' => __('Right Sidebar','sauna-lite'),
	            'One Column' => __('One Column','sauna-lite'),
	            'Three Columns' => __('Three Columns','sauna-lite'),
	            'Four Columns' => __('Four Columns','sauna-lite'),
	            'Grid Layout' => __('Grid Layout','sauna-lite')
	        ),
	    )
    );

	//home page slider
	$wp_customize->add_section( 'sauna_lite_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'sauna-lite' ),
		'priority'   => 30,
		'panel' => 'sauna_lite_panel_id'
	) );

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'sauna_lite_slidersettings-page-' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'absint'
		) );

		$wp_customize->add_control( 'sauna_lite_slidersettings-page-' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'sauna-lite' ),
			'section'  => 'sauna_lite_slidersettings',
			'type'     => 'dropdown-pages'
		) );

	}

	//OUR services
	$wp_customize->add_section('sauna_lite_our_services',array(
		'title'	=> __('Our Services','sauna-lite'),
		'description'=> __('This section will appear below the slider.','sauna-lite'),
		'panel' => 'sauna_lite_panel_id',
	));	
	
	$wp_customize->add_setting('sauna_lite_sec1_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sauna_lite_sec1_title',array(
		'label'	=> __('Section Title','sauna-lite'),
		'section'=> 'sauna_lite_our_services',
		'setting'=> 'sauna_lite_sec1_title',
		'type'=> 'text'
	));

	for ( $count = 0; $count <= 2; $count++ ) {

		$wp_customize->add_setting( 'sauna_lite_services_sec_ettings-page-' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'absint'
		));
		$wp_customize->add_control( 'sauna_lite_services_sec_ettings-page-' . $count, array(
			'label'    => __( 'Select Service Page', 'sauna-lite' ),
			'section'  => 'sauna_lite_our_services',
			'type'     => 'dropdown-pages'
		));
	}

	//Copyright
	$wp_customize->add_section('sauna_lite_text',array(
		'title'	=> __('Footer Text','sauna-lite'),
		'description'=> __('This section will appear in the footer','sauna-lite'),
		'panel' => 'sauna_lite_panel_id',
	));	
	
	$wp_customize->add_setting('sauna_lite_footer_copy',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('sauna_lite_footer_copy',array(
		'label'	=> __('Text','sauna-lite'),
		'section'=> 'sauna_lite_text',
		'setting'=> 'sauna_lite_footer_copy',
		'type'=> 'text'
	));
}
add_action( 'customize_register', 'sauna_lite_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Sauna_Lite_Customizer_Upsell {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $manager Customizer manager.
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . 'inc/sauna-customize-theme-info-main.php' );
		load_template( trailingslashit( get_template_directory() ) . 'inc/sauna-customize-upsell-section.php' );

		// Register custom section types.
		$manager->register_section_type( 'Sauna_Lite_Customizer_Theme_Info_Main' );

		// Main Documentation Link In Customizer Root.
		$manager->add_section(
			new Sauna_Lite_Customizer_Theme_Info_Main(
				$manager, 'sauna-lite-theme-info', array(
					'theme_info_title' => __( 'Sauna Docs', 'sauna-lite' ),
					'label_url'        => esc_url( 'https://themescaliber.com/doc/free-tc-sauna/' ),
					'label_text'       => __( 'Documentation', 'sauna-lite' ),
				)
			)
		);

		// Frontpage Sections Upsell.
		$manager->add_section(
			new Sauna_Lite_Customizer_Upsell_Section(
				$manager, 'sauna-lite-upsell-frontpage-sections', array(
					'panel'       => 'sauna_lite_panel_id',
					'priority'    => 500,
					'options'     => array(
						esc_html__( 'Products Section', 'sauna-lite' ),
						esc_html__( 'About us section', 'sauna-lite' ),
						esc_html__( 'Packages section', 'sauna-lite' ),
						esc_html__( 'Gallery Section', 'sauna-lite' ),
						esc_html__( 'Team section', 'sauna-lite' ),
						esc_html__( 'Blog section', 'sauna-lite' ),
						esc_html__( 'Counter section', 'sauna-lite' ),
						esc_html__( 'Testimonial section', 'sauna-lite' ),
					),
					'button_url'  => esc_url( 'https://www.themescaliber.com/premium/sauna-spa-wordpress-theme' ),
					'button_text' => esc_html__( 'View PRO version', 'sauna-lite' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'sauna-lite-upsell-js', trailingslashit( get_template_directory_uri() ) . 'inc/js/sauna-customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'sauna-lite-theme-info-style', trailingslashit( get_template_directory_uri() ) . 'inc/css/sauna-style.css' );
	}
}

Sauna_Lite_Customizer_Upsell::get_instance();