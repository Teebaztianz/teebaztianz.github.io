<?php
/**
 * Mega Stores Theme Customizer.
 *
 * @package TC Mega Stores
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tc_mega_stores_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	$categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cats[$category->slug] = $category->name;
	}
	if(tc_mega_stores_is_wc()){
	$product_cat = get_terms( 'product_cat' ); // Get all Categories
	//$wp_category_list = array();
	$product_cats = array();
	$i = 0;
	foreach($product_cat as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$product_cats[$category->slug] = $category->name;
	}
	}
	//general settings
	
	$wp_customize->add_section( 'tc_mega_stores_general_section' , array(
		'title'       => __( 'General Options', 'tc-mega-stores' ),
		'priority'    => 20,
		'description' => __( 'Theme\'s general settings ', 'tc-mega-stores' ),
	) );
	
	$wp_customize->add_setting( 'tc_mega_stores_theme_color_setting', array (
		'default'     => '#fe8bad',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tc_mega_stores_theme_color', array(
		'label'    => __( 'Theme Color', 'tc-mega-stores' ),
		'section'  => 'tc_mega_stores_general_section',
		'settings' => 'tc_mega_stores_theme_color_setting',
	) ) );
	
	$wp_customize->add_setting('tc_mega_stores_home_layout', array(
		'default' => 'right',
		'sanitize_callback' => 'tc_mega_stores_sanitize_text_field',
	));

	$wp_customize->add_control('tc_mega_stores_home_layout', array(
		'settings' => 'tc_mega_stores_home_layout',
		'type' => 'select',
		'label' => __('Select Blog Page Layout:','tc-mega-stores'),
		'section' => 'tc_mega_stores_general_section',
		'choices' => array(
			'left'=> __('Left Sidebar','tc-mega-stores'),
			'right'=> __('Right Sidebar','tc-mega-stores'),
			'full'=> __('Full Width','tc-mega-stores'),			
			),
		'priority'	=> 25
	));
	
	$wp_customize->add_setting('tc_mega_stores_post_layout', array(
		'default' => 'right',
		'sanitize_callback' => 'tc_mega_stores_sanitize_text_field',
	));

	$wp_customize->add_control('tc_mega_stores_post_layout', array(
		'settings' => 'tc_mega_stores_post_layout',
		'type' => 'select',
		'label' => __('Select Post Page Layout:','tc-mega-stores'),
		'section' => 'tc_mega_stores_general_section',
		'choices' => array(
			'left'=> __('Left Sidebar','tc-mega-stores'),
			'right'=> __('Right Sidebar','tc-mega-stores'),
			'full'=> __('Full Width','tc-mega-stores'),			
			),
		'priority'	=> 25
	));
	
	//header settings
	$wp_customize->add_section( 'tc_mega_stores_topbar_section' , array(
		'title'       => __( 'Topbar', 'tc-mega-stores' ),
		'priority'    => 20,
		'description' => __( 'Topbar settings ', 'tc-mega-stores' ),
	) );
	
	
	$wp_customize->add_setting('tc_mega_stores_display_topbar_setting', array(
		'default'        => 0,
		'sanitize_callback' => 'tc_mega_stores_sanitize_checkbox',
	));
	$wp_customize->add_control('tc_mega_stores_display_topbar_setting', array(
		'settings' => 'tc_mega_stores_display_topbar_setting',
		'label'    => __('Display TopBar', 'tc-mega-stores'),
		'section'  => 'tc_mega_stores_topbar_section',
		'type'     => 'checkbox',
		'priority'	=> 24
	));
	
	$wp_customize->add_setting('tc_mega_stores_display_topmenu_setting', array(
		'default'        => 0,
		'sanitize_callback' => 'tc_mega_stores_sanitize_checkbox',
	));

	$wp_customize->add_control('tc_mega_stores_display_topmenu_control', array(
		'settings' => 'tc_mega_stores_display_topmenu_setting',
		'label'    => __('Display Header Menu', 'tc-mega-stores'),
		'section'  => 'tc_mega_stores_topbar_section',
		'type'     => 'checkbox',
		'active_callback' =>'tc_mega_stores_topbar_active_callback',
		'priority'	=> 24
	));
	
	for($i=1; $i<=3; $i++){
	$wp_customize->add_setting('tc_mega_stores_header_icon_'.$i, array(
		'default' => '',
		'sanitize_callback' => 'tc_mega_stores_sanitize_text_field',
	));

	$wp_customize->add_control('tc_mega_stores_header_icon_'.$i, array(
		'settings' => 'tc_mega_stores_header_icon_'.$i,
		'label' => __('Header Element Icon ','tc-mega-stores').$i,
		'description' => __( 'Please add <strong>FontAwesome</strong> Class of respective social. Like  <strong>fa fa-facebook</strong>', 'tc-mega-stores' ),
		'section' => 'tc_mega_stores_topbar_section',
		'active_callback' =>'tc_mega_stores_topbar_active_callback',
		'priority'	=> 24
	));
	
	$wp_customize->add_setting('tc_mega_stores_header_heading_'.$i, array(
		'default' => '',
		'sanitize_callback' => 'tc_mega_stores_sanitize_text_field',
	));

	$wp_customize->add_control('tc_mega_stores_header_heading_'.$i, array(
		'settings' => 'tc_mega_stores_header_heading_'.$i,
		'label' => __('Header Element Heading ','tc-mega-stores').$i,
		'description' => __( 'Please add element\'s heading', 'tc-mega-stores' ),
		'section' => 'tc_mega_stores_topbar_section',
		'active_callback' =>'tc_mega_stores_topbar_active_callback',
		'priority'	=> 24
	));
	}
	
	//Main Panel
	$wp_customize->add_panel( 'tc_mega_stores_home_featured_panel', array(
		'priority'       => 25,
		'capability'     => 'edit_theme_options',
		'title'          => __('Front Page Features', 'tc-mega-stores' ),
		'description'    => __('Section that will show on Front page', 'tc-mega-stores' ),
	) );
	
	//slider
	$wp_customize->add_section( 'tc_mega_stores_slider_section' , array(
		'title'       => __( 'Slider', 'tc-mega-stores' ),
		'priority'    => 20,
		'description' => __( 'Slider Option', 'tc-mega-stores' ),
		'panel'  => 'tc_mega_stores_home_featured_panel',
	) );

	$wp_customize->add_setting('tc_mega_stores_display_slider_setting', array(
		'default'        => 1,
		'sanitize_callback' => 'tc_mega_stores_sanitize_checkbox',
	));

	$wp_customize->add_control('tc_mega_stores_display_slider_control', array(
		'settings' => 'tc_mega_stores_display_slider_setting',
		'label'    => __('Display Slider', 'tc-mega-stores'),
		'section'  => 'tc_mega_stores_slider_section',
		'type'     => 'checkbox',
		'priority'	=> 24
	));
	//  =============================
	//  Select Box               
	//  =============================
	$wp_customize->add_setting('tc_mega_stores_category_slider', array(
		'default' => '',
		'sanitize_callback' => 'tc_mega_stores_sanitize_category',
	));

	$wp_customize->add_control('tc_mega_stores_slider_control', array(
		'settings' => 'tc_mega_stores_category_slider',
		'type' => 'select',
		'label' => __('Select Category:','tc-mega-stores'),
		'section' => 'tc_mega_stores_slider_section',
		'active_callback' =>'tc_mega_stores_slider_active_callback',
		'choices' => $cats,
		'priority'	=> 25
	));
	
	//new products
	$wp_customize->add_section( 'tc_mega_stores_recent_section' , array(
		'title'       => __( 'Recent Products', 'tc-mega-stores' ),
		'priority'    => 25,
		'description' => __( 'This is WooCommerce Section. Please Activate WooCommerce Plugin to Enable it.', 'tc-mega-stores' ),
		'panel'  => 'tc_mega_stores_home_featured_panel',
	) );
	
	$wp_customize->add_setting('tc_mega_stores_display_recent_setting', array(
		'default'        => 0,
		'sanitize_callback' => 'tc_mega_stores_sanitize_checkbox',
	));

	$wp_customize->add_control('tc_mega_stores_display_recent_control', array(
		'settings' => 'tc_mega_stores_display_recent_setting',
		'label'    => __('Display Recent Products', 'tc-mega-stores'),
		'section'  => 'tc_mega_stores_recent_section',
		'type'     => 'checkbox',
		'priority'	=> 24
	));
	
	$wp_customize->add_setting('tc_mega_stores_heading_recent', array(
		'default' => '',
		'sanitize_callback' => 'tc_mega_stores_sanitize_text_field',
	));

	$wp_customize->add_control('tc_mega_stores_heading_recent_control', array(
		'settings' => 'tc_mega_stores_heading_recent',
		'label' => __('Recent Products Section Heading','tc-mega-stores'),
		'section' => 'tc_mega_stores_recent_section',
		'active_callback' =>'tc_mega_stores_recent_active_callback',
		'priority'	=> 25
	));
	
	//Products Category
	$wp_customize->add_section( 'tc_mega_stores_category_section' , array(
		'title'       => __( 'Products Categories', 'tc-mega-stores' ),
		'priority'    => 25,
		'description' => __( 'This is WooCommerce Section. Please Activate WooCommerce Plugin to Enable it.', 'tc-mega-stores' ),
		'panel'  => 'tc_mega_stores_home_featured_panel',
	) );
	
	$wp_customize->add_setting('tc_mega_stores_display_cate_setting', array(
		'default'        => 0,
		'sanitize_callback' => 'tc_mega_stores_sanitize_checkbox',
	));

	$wp_customize->add_control('tc_mega_stores_display_categories_control', array(
		'settings' => 'tc_mega_stores_display_cate_setting',
		'label'    => __('Display Products Categories Section', 'tc-mega-stores'),
		'section'  => 'tc_mega_stores_category_section',
		'type'     => 'checkbox',
		'priority'	=> 24
	));
	
	$wp_customize->add_setting('tc_mega_stores_heading_categories', array(
		'default' => '',
		'sanitize_callback' => 'tc_mega_stores_sanitize_text_field',
	));

	$wp_customize->add_control('tc_mega_stores_heading_categories_control', array(
		'settings' => 'tc_mega_stores_heading_categories',
		'label' => __('Products Categories Section Heading','tc-mega-stores'),
		'section' => 'tc_mega_stores_category_section',
		'active_callback' =>'tc_mega_stores_category_active_callback',
		'priority'	=> 25
	));
	
	//Products Collection 1
	$wp_customize->add_section( 'tc_mega_stores_collection_section' , array(
		'title'       => __( 'Products Collection 1', 'tc-mega-stores' ),
		'priority'    => 25,
		'description' => __( 'This is WooCommerce Section. Please Activate WooCommerce Plugin to Enable it.', 'tc-mega-stores' ),
		'panel'  => 'tc_mega_stores_home_featured_panel',
	) );
	
	$wp_customize->add_setting('tc_mega_stores_display_coll1_setting', array(
		'default'        => 0,
		'sanitize_callback' => 'tc_mega_stores_sanitize_checkbox',
	));

	$wp_customize->add_control('tc_mega_stores_display_col1_control', array(
		'settings' => 'tc_mega_stores_display_coll1_setting',
		'label'    => __('Display Products Collection 1', 'tc-mega-stores'),
		'section'  => 'tc_mega_stores_collection_section',
		'type'     => 'checkbox',
		'priority'	=> 24
	));
	if(tc_mega_stores_is_wc()){
	$wp_customize->add_setting('tc_mega_stores_product_cat1', array(
		'default' => '',
		'sanitize_callback' => 'tc_mega_stores_sanitize_text_field',
	));

	$wp_customize->add_control('tc_mega_stores_product_cat1_control', array(
		'settings' => 'tc_mega_stores_product_cat1',
		'type' => 'select',
		'label' => __('Select Product Category:','tc-mega-stores'),
		'section' => 'tc_mega_stores_collection_section',
		'active_callback' =>'tc_mega_stores_col1_active_callback',
		'choices' => $product_cats,
		'priority'	=> 25
	));
	}
	//Products Collection 2
	$wp_customize->add_section( 'tc_mega_stores_collection2_section' , array(
		'title'       => __( 'Products Collection 2', 'tc-mega-stores' ),
		'priority'    => 25,
		'description' => __( 'This is WooCommerce Section. Please Activate WooCommerce Plugin to Enable it.', 'tc-mega-stores' ),
		'panel'  => 'tc_mega_stores_home_featured_panel',
	) );
	
	$wp_customize->add_setting('tc_mega_stores_display_coll2_setting', array(
		'default'        => 0,
		'sanitize_callback' => 'tc_mega_stores_sanitize_checkbox',
	));

	$wp_customize->add_control('tc_mega_stores_display_col2_control', array(
		'settings' => 'tc_mega_stores_display_coll2_setting',
		'label'    => __('Display Products Collection 2', 'tc-mega-stores'),
		'section'  => 'tc_mega_stores_collection2_section',
		'type'     => 'checkbox',
		'priority'	=> 24
	));
	if(tc_mega_stores_is_wc()){
	$wp_customize->add_setting('tc_mega_stores_product_cat2', array(
		'default' => '',
		'sanitize_callback' => 'tc_mega_stores_sanitize_text_field',
	));

	$wp_customize->add_control('tc_mega_stores_product_cat2_control', array(
		'settings' => 'tc_mega_stores_product_cat2',
		'type' => 'select',
		'label' => __('Select Product Category:','tc-mega-stores'),
		'section' => 'tc_mega_stores_collection2_section',
		'active_callback' =>'tc_mega_stores_col2_active_callback',
		'choices' => $product_cats,
		'priority'	=> 25
	));
	}
	
	//blog
	$wp_customize->add_section( 'tc_mega_stores_blog_section' , array(
		'title'       => __( 'Blog', 'tc-mega-stores' ),
		'priority'    => 25,
		'description' => __( 'Blog Option', 'tc-mega-stores' ),
		'panel'  => 'tc_mega_stores_home_featured_panel',
	) );

	$wp_customize->add_setting('tc_mega_stores_display_blog_setting', array(
		'default'        => 1,
		'sanitize_callback' => 'tc_mega_stores_sanitize_checkbox',
	));

	$wp_customize->add_control('tc_mega_stores_display_blog_setting', array(
		'settings' => 'tc_mega_stores_display_blog_setting',
		'label'    => __('Display Blog', 'tc-mega-stores'),
		'section'  => 'tc_mega_stores_blog_section',
		'type'     => 'checkbox',
		'priority'	=> 25
	));
	$wp_customize->add_setting('tc_mega_stores_heading_blog', array(
		'default' => '',
		'sanitize_callback' => 'tc_mega_stores_sanitize_text_field',
	));

	$wp_customize->add_control('tc_mega_stores_heading_blog', array(
		'settings' => 'tc_mega_stores_heading_blog',
		'label' => __('Blog Heading:','tc-mega-stores'),
		'section' => 'tc_mega_stores_blog_section',
		'active_callback' =>'tc_mega_stores_blog_active_callback',
		'priority'	=> 30
	));
	
	//footer
	$wp_customize->add_section( 'tc_mega_stores_footer_section' , array(
		'title'       => __( 'Footer', 'tc-mega-stores' ),
		'priority'    => 25,
		'description' => __( 'Footer Option', 'tc-mega-stores' ),
	) );

	$wp_customize->add_setting('tc_mega_stores_footer_credit', array(
		'default' => '',
		'sanitize_callback' => 'tc_mega_stores_sanitize_text_field',
	));

	$wp_customize->add_control('tc_mega_stores_footer_credit', array(
		'settings' => 'tc_mega_stores_footer_credit',
		'label' => __('Footer Credit Text:','tc-mega-stores'),
		'section' => 'tc_mega_stores_footer_section',
		'priority'	=> 30
	));
	
	$wp_customize->add_setting('tc_mega_stores_footer_company', array(
		'default' => '',
		'sanitize_callback' => 'tc_mega_stores_sanitize_text_field',
	));

	$wp_customize->add_control('tc_mega_stores_footer_company', array(
		'settings' => 'tc_mega_stores_footer_company',
		'label' => __('Footer Company Name:','tc-mega-stores'),
		'section' => 'tc_mega_stores_footer_section',
		'priority'	=> 30
	));
	
	$wp_customize->add_setting('tc_mega_stores_footer_link', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control('tc_mega_stores_footer_link', array(
		'settings' => 'tc_mega_stores_footer_link',
		'label' => __('Footer Company Link:','tc-mega-stores'),
		'section' => 'tc_mega_stores_footer_section',
		'priority'	=> 30
	));
}
add_action( 'customize_register', 'tc_mega_stores_customize_register' );
	
function tc_mega_stores_slider_active_callback() {
	if ( get_theme_mod( 'tc_mega_stores_display_slider_setting', 0 ) ) {
		return true;
	}
	return false;
}
function tc_mega_stores_recent_active_callback() {
	if ( get_theme_mod( 'tc_mega_stores_display_recent_setting', 0 ) ) {
		return true;
	}
	return false;
}
function tc_mega_stores_category_active_callback() {
	if ( get_theme_mod( 'tc_mega_stores_display_cate_setting', 0 ) ) {
		return true;
	}
	return false;
}
function tc_mega_stores_col1_active_callback() {
	if ( get_theme_mod( 'tc_mega_stores_display_coll1_setting', 0 ) ) {
		return true;
	}
	return false;
}
function tc_mega_stores_col2_active_callback() {
	if ( get_theme_mod( 'tc_mega_stores_display_coll2_setting', 0 ) ) {
		return true;
	}
	return false;
}
function tc_mega_stores_blog_active_callback() {
	if ( get_theme_mod( 'tc_mega_stores_display_blog_setting', 0 ) ) {
		return true;
	}
	return false;
}

function tc_mega_stores_topbar_active_callback() {
	if ( get_theme_mod( 'tc_mega_stores_display_topbar_setting', 0 ) ) {
		return true;
	}
	return false;
}


/**
 * 1Sanitize checkbox
 */

if (!function_exists( 'tc_mega_stores_sanitize_checkbox' ) ) :
	function tc_mega_stores_sanitize_checkbox( $input ) {
		if ( $input != 1 ) {
			return 0;
		} else {
			return 1;
		}
	}
endif;

/**
 * Sanitize integer input
 */

if ( ! function_exists( 'tc_mega_stores_sanitize_category' ) ){
	function tc_mega_stores_sanitize_category( $input ) {
		$categories = get_categories();
		$cats = array();
		$i = 0;
		foreach($categories as $category){
			if($i==0){
				$default = $category->slug;
				$i++;
			}
			$cats[$category->slug] = $category->name;
		}
		$valid = $cats;

		if ( array_key_exists( $input, $valid ) ) {
			return $input;
		} else {
			return '';

		}
	}
}

function tc_mega_stores_sanitize_text_field( $str ) {

	return sanitize_text_field( $str );

}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tc_mega_stores_customize_preview_js() {
	wp_enqueue_script( 'tc_mega_stores_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'tc_mega_stores_customize_preview_js' );