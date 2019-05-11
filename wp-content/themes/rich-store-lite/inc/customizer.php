<?php    
/**
 *Rich Store Lite Theme Customizer
 *
 * @package Rich Store Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function rich_store_lite_customize_register( $wp_customize ) {	
	
	function rich_store_lite_sanitize_dropdown_pages( $page_id, $setting ) {
	  // Ensure $input is an absolute integer.
	  $page_id = absint( $page_id );
	
	  // If $page_id is an ID of a published page, return it; otherwise, return the default.
	  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function rich_store_lite_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}  
		
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	 //Panel for section & control
	$wp_customize->add_panel( 'rich_store_lite_options_panel_area', array(
		'priority' => null,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Options Panel', 'rich-store-lite' ),		
	) );
	
	//Site Layout Options
	$wp_customize->add_section('rich_store_lite_sitelayout_option',array(
		'title' => __('Layout Options','rich-store-lite'),			
		'priority' => 1,
		'panel' => 	'rich_store_lite_options_panel_area',          
	));		
	
	$wp_customize->add_setting('rich_store_lite_boxlayout_option',array(
		'sanitize_callback' => 'rich_store_lite_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'rich_store_lite_boxlayout_option', array(
    	'section'   => 'rich_store_lite_sitelayout_option',    	 
		'label' => __('Check to Box Layout','rich-store-lite'),
		'description' => __('If you want to box layout please check the Box Layout Option.','rich-store-lite'),
    	'type'      => 'checkbox'
     )); // Layout Options
	
	$wp_customize->add_setting('rich_store_lite_color_scheme',array(
		'default' => '#25b7ac',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'rich_store_lite_color_scheme',array(
			'label' => __('Color Scheme Options','rich-store-lite'),			
			'description' => __('More color options in available PRO Version','rich-store-lite'),
			'section' => 'colors',
			'settings' => 'rich_store_lite_color_scheme'
		))
	);	
	
	//Contact info area
	$wp_customize->add_section('rich_store_lite_header_contactinfo_section',array(
		'title' => __('Header Contact info','rich-store-lite'),				
		'priority' => null,
		'panel' => 	'rich_store_lite_options_panel_area',
	));	
	
	
	$wp_customize->add_setting('rich_store_lite_contactemail',array(
		'sanitize_callback' => 'sanitize_email'
	));
	
	$wp_customize->add_control('rich_store_lite_contactemail',array(
		'type' => 'text',
		'label' => __('Add email address here.','rich-store-lite'),
		'section' => 'rich_store_lite_header_contactinfo_section'
	));	
	
		
	$wp_customize->add_setting('rich_store_lite_header_contactnumber',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('rich_store_lite_header_contactnumber',array(	
		'type' => 'text',
		'label' => __('Add phone number here','rich-store-lite'),
		'section' => 'rich_store_lite_header_contactinfo_section',
		'setting' => 'rich_store_lite_header_contactnumber'
	));	
	
	
	$wp_customize->add_setting('rich_store_lite_show_headercontactinfo_part',array(
		'default' => false,
		'sanitize_callback' => 'rich_store_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'rich_store_lite_show_headercontactinfo_part', array(
	   'settings' => 'rich_store_lite_show_headercontactinfo_part',
	   'section'   => 'rich_store_lite_header_contactinfo_section',
	   'label'     => __('Check To show This Section','rich-store-lite'),
	   'type'      => 'checkbox'
	 ));//Show header contact info
	
	
	 //Header social icons
	$wp_customize->add_section('rich_store_lite_topsocialicons_section',array(
		'title' => __('Header social icons','rich-store-lite'),
		'description' => __( 'Add social icons link here to display icons in header', 'rich-store-lite' ),			
		'priority' => null,
		'panel' => 	'rich_store_lite_options_panel_area', 
	));
	
	$wp_customize->add_setting('rich_store_lite_fb_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'	
	));
	
	$wp_customize->add_control('rich_store_lite_fb_link',array(
		'label' => __('Add facebook link here','rich-store-lite'),
		'section' => 'rich_store_lite_topsocialicons_section',
		'setting' => 'rich_store_lite_fb_link'
	));	
	
	$wp_customize->add_setting('rich_store_lite_twitt_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('rich_store_lite_twitt_link',array(
		'label' => __('Add twitter link here','rich-store-lite'),
		'section' => 'rich_store_lite_topsocialicons_section',
		'setting' => 'rich_store_lite_twitt_link'
	));
	
	$wp_customize->add_setting('rich_store_lite_gplus_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('rich_store_lite_gplus_link',array(
		'label' => __('Add google plus link here','rich-store-lite'),
		'section' => 'rich_store_lite_topsocialicons_section',
		'setting' => 'rich_store_lite_gplus_link'
	));
	
	$wp_customize->add_setting('rich_store_lite_linked_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('rich_store_lite_linked_link',array(
		'label' => __('Add linkedin link here','rich-store-lite'),
		'section' => 'rich_store_lite_topsocialicons_section',
		'setting' => 'rich_store_lite_linked_link'
	));
	
	$wp_customize->add_setting('rich_store_lite_show_socialsection',array(
		'default' => false,
		'sanitize_callback' => 'rich_store_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'rich_store_lite_show_socialsection', array(
	   'settings' => 'rich_store_lite_show_socialsection',
	   'section'   => 'rich_store_lite_topsocialicons_section',
	   'label'     => __('Check To show This Section','rich-store-lite'),
	   'type'      => 'checkbox'
	 ));//Show Header Social icons Section 	 
	
	// Slider Section		
	$wp_customize->add_section( 'rich_store_lite_frontpage_slider_option', array(
		'title' => __('Slider Options', 'rich-store-lite'),
		'priority' => null,
		'description' => __('Default image size for slider is 1400 x 670 pixel.','rich-store-lite'), 
		'panel' => 	'rich_store_lite_options_panel_area',           			
    ));
	
	$wp_customize->add_setting('rich_store_lite_pageforslider1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'rich_store_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('rich_store_lite_pageforslider1',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide one:','rich-store-lite'),
		'section' => 'rich_store_lite_frontpage_slider_option'
	));	
	
	$wp_customize->add_setting('rich_store_lite_pageforslider2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'rich_store_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('rich_store_lite_pageforslider2',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide two:','rich-store-lite'),
		'section' => 'rich_store_lite_frontpage_slider_option'
	));	
	
	$wp_customize->add_setting('rich_store_lite_pageforslider3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'rich_store_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('rich_store_lite_pageforslider3',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide three:','rich-store-lite'),
		'section' => 'rich_store_lite_frontpage_slider_option'
	));	// Slider Section	
	
	$wp_customize->add_setting('rich_store_lite_pageforslidermore',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('rich_store_lite_pageforslidermore',array(	
		'type' => 'text',
		'label' => __('Add slider Read more button name here','rich-store-lite'),
		'section' => 'rich_store_lite_frontpage_slider_option',
		'setting' => 'rich_store_lite_pageforslidermore'
	)); // Slider Read More Button Text
	
	$wp_customize->add_setting('rich_store_lite_pageforslidershowoption',array(
		'default' => false,
		'sanitize_callback' => 'rich_store_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'rich_store_lite_pageforslidershowoption', array(
	    'settings' => 'rich_store_lite_pageforslidershowoption',
	    'section'   => 'rich_store_lite_frontpage_slider_option',
	    'label'     => __('Check To Show This Section','rich-store-lite'),
	    'type'      => 'checkbox'
	 ));//Show Slider Section	
	
		 
}
add_action( 'customize_register', 'rich_store_lite_customize_register' );

function rich_store_lite_custom_css(){ 
?>
	<style type="text/css"> 					
        a, .richstore_default_poststyle h2 a:hover,
        #sidebar aside.widget ul li a:hover,       
		.richstore_default_poststyle h3 a,				
        .postmeta a:hover,
        .button:hover,	
		.top_socialicons a:hover,	
        .sitefooter ul li a:hover, 
        .sitefooter ul li.current_page_item a,		
		.sitefooter ul li a:hover, 
		.sitefooter ul li.current_page_item a,
        .sitemenubox ul li a:hover, 
        .sitemenubox ul li.current-menu-item a,
        .sitemenubox ul li.current-menu-parent a.parent,
        .sitemenubox ul li.current-menu-item ul.sub-menu li a:hover				
            { color:<?php echo esc_html( get_theme_mod('rich_store_lite_color_scheme','#25b7ac')); ?>;}					 
            
        .pagination ul li .current, .pagination ul li a:hover, 
        #commentform input#submit:hover,					
        .nivo-controlNav a.active,
		.nivo-caption .slider_readmore,
		.cart-contents-count,        
		.sitefour_pagecolumn:hover,	
		.nivo-caption .slider_readmore,											
        #sidebar .search-form input.search-submit,				
        .wpcf7 input[type='submit'],				
        nav.pagination .page-numbers.current,
		.woocommerce span.onsale,		       		
        .toggle a	
            { background-color:<?php echo esc_html( get_theme_mod('rich_store_lite_color_scheme','#25b7ac')); ?>;}	
		
		.button:hover
            { border-color:<?php echo esc_html( get_theme_mod('rich_store_lite_color_scheme','#25b7ac')); ?>;}						
         	
    </style> 
<?php       
}
         
add_action('wp_head','rich_store_lite_custom_css');	 

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function rich_store_lite_customize_preview_js() {
	wp_enqueue_script( 'rich_store_lite_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20190401', true );
}
add_action( 'customize_preview_init', 'rich_store_lite_customize_preview_js' );