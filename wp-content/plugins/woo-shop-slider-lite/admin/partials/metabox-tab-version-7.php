<?php

/**
 * Provide a admin area main metabox settings for slider version 7
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php

// Set all values for this version tab
$version_seven_show_what_field = $this->form_fields['version_seven_show_what'];
$version_seven_show_what = isset( $values[7][$version_seven_show_what_field['name']] ) ? $values[7][$version_seven_show_what_field['name']] : 'products';

// Regulate which fields to hide when category selected
$version_seven_hide_prod_fields_class = $this->check_css_field_visibility( $version_seven_show_what, 'categories' );

// Multiselect with sortable option
$version_seven_cat_multiselect_field = $this->form_fields['version_seven_cat_multiselect'];
$version_seven_cat_multiselect = isset( $values[7][$version_seven_cat_multiselect_field['name']] ) && !empty( $values[7][$version_seven_cat_multiselect_field['name']] ) ? $values[7][$version_seven_cat_multiselect_field['name']] : array();

$version_seven_custom_link_text_field = $this->form_fields['version_seven_custom_link_text'];
$version_seven_custom_link_text = isset( $values[7][$version_seven_custom_link_text_field['name']] ) ? $values[7][$version_seven_custom_link_text_field['name']] : Shindiri_Woo_Slider_Helper::get_view_more_button_text();

$version_seven_products_sorting_field = $this->form_fields['version_seven_products_sorting'];
$version_seven_products_sorting = isset( $values[7][$version_seven_products_sorting_field['name']] ) && !empty( $values[7][$version_seven_products_sorting_field['name']] ) ? $values[7][$version_seven_products_sorting_field['name']] : 'recent';

// Limit for posts per page as theme is no other page
$version_seven_slider_limit_field = $this->form_fields['version_seven_slider_limit'];
$version_seven_slider_limit = isset( $values[7][$version_seven_slider_limit_field['name']] ) && !empty( $values[7][$version_seven_slider_limit_field['name']] ) ? $values[7][$version_seven_slider_limit_field['name']] : 20;

// Select theme dark or light
$version_seven_theme_color_field = $this->form_fields['version_seven_theme_color'];
$version_seven_theme_color = isset( $values[7][$version_seven_theme_color_field['name']] ) && !empty( $values[7][$version_seven_theme_color_field['name']] ) ? $values[7][$version_seven_theme_color_field['name']] : 'light';

// Slider overlay color
$version_seven_overlay_color_field = $this->form_fields['version_seven_overlay_color'];
$version_seven_overlay_color = isset( $values[7][$version_seven_overlay_color_field['name']] ) ? $values[7][$version_seven_overlay_color_field['name']] : '';

// Content overlay color
$version_seven_content_overlay_field = $this->form_fields['version_seven_content_overlay'];
$version_seven_content_overlay = isset( $values[7][$version_seven_content_overlay_field['name']] ) ? $values[7][$version_seven_content_overlay_field['name']] : '';

$version_seven_custom_placeholder_field = $this->form_fields['version_seven_custom_placeholder'];
$version_seven_custom_placeholder_default = $shortcodes_common_values::$placeholder_small;
$version_seven_custom_placeholder_id = isset( $values[7][$version_seven_custom_placeholder_field['name']] ) ? $values[7][$version_seven_custom_placeholder_field['name']] : '';
$version_seven_custom_placeholder_url =  !empty( $version_seven_custom_placeholder_id ) ? wp_get_attachment_url( $version_seven_custom_placeholder_id ) : $version_seven_custom_placeholder_default;

$version_seven_disable_typography_field = $this->form_fields['version_seven_disable_typography'];
$version_seven_disable_typography = isset( $values[7][$version_seven_disable_typography_field['name']] ) ? $values[7][$version_seven_disable_typography_field['name']] : 'enabled';
// Typography class for visibility on page load
$version_seven_typography_fields_class = $this->check_css_typography_field_visibility( $version_seven_disable_typography );

$version_seven_slider_height_field = $this->form_fields['version_seven_slider_height'];
$version_seven_slider_height = isset( $values[7][$version_seven_slider_height_field['name']] ) && !empty( $values[7][$version_seven_slider_height_field['name']] ) ? $values[7][$version_seven_slider_height_field['name']] : 800;

$version_seven_full_screen_field = $this->form_fields['version_seven_full_screen'];
$version_seven_full_screen = isset( $values[7][$version_seven_full_screen_field['name']] ) && !empty( $values[7][$version_seven_full_screen_field['name']] ) ? $values[7][$version_seven_full_screen_field['name']] : 'no';

// Slider transition
$version_seven_slider_transition_field = $this->form_fields['version_seven_slider_transition'];
$version_seven_slider_transition = isset( $values[7][$version_seven_slider_transition_field['name']] ) && !empty( $values[7][$version_seven_slider_transition_field['name']] ) ? $values[7][$version_seven_slider_transition_field['name']] : 'slide';

// Lazy load
$version_seven_lazy_load_field = $this->form_fields['version_seven_lazy_load'];
$version_seven_lazy_load = isset( $values[7][$version_seven_lazy_load_field['name']] ) && !empty( $values[7][$version_seven_lazy_load_field['name']] ) ? $values[7][$version_seven_lazy_load_field['name']] : 'yes';

// Autoplay fields
$version_seven_autoplay_field = $this->form_fields['version_seven_autoplay'];
$version_seven_autoplay = isset( $values[7][$version_seven_autoplay_field['name']] ) && !empty( $values[7][$version_seven_autoplay_field['name']] ) ? $values[7][$version_seven_autoplay_field['name']] : 'off';

$version_seven_autoplay_timeout_field = $this->form_fields['version_seven_autoplay_timeout'];
$version_seven_autoplay_timeout = isset( $values[7][$version_seven_autoplay_timeout_field['name']] ) && !empty( $values[7][$version_seven_autoplay_timeout_field['name']] ) ? $values[7][$version_seven_autoplay_timeout_field['name']] : 5000;

// On sale ribbon settings
$version_seven_sale_text_color_field = $this->form_fields['version_seven_sale_text_color'];
$version_seven_sale_text_color = isset( $values[7][$version_seven_sale_text_color_field['name']] ) ? $values[7][$version_seven_sale_text_color_field['name']] : '#ffffff';

$version_seven_sale_bg_color_field = $this->form_fields['version_seven_sale_bg_color'];
$version_seven_sale_bg_color = isset( $values[7][$version_seven_sale_bg_color_field['name']] ) ? $values[7][$version_seven_sale_bg_color_field['name']] : '#f04f25';

// Button type
$version_seven_button_type_field = $this->form_fields['version_seven_button_type'];
$version_seven_button_type = isset( $values[7][$version_seven_button_type_field['name']] ) && !empty( $values[7][$version_seven_button_type_field['name']] ) ? $values[7][$version_seven_button_type_field['name']] : 'sh-ws-button-outlined';

/*
 * Settings listed below up to Generate all metabox fields are not used in shortcode classes but for inline css only
 * 
 * Not used id typography is off
 */

// Accent color
$version_seven_accent_color_field = $this->form_fields['version_seven_accent_color'];
$version_seven_accent_color = isset( $values[7][$version_seven_accent_color_field['name']] ) ? $values[7][$version_seven_accent_color_field['name']] : '';

// Button text colors
$version_seven_button_text_color_field = $this->form_fields['version_seven_button_text_color'];
$version_seven_button_text_color = isset( $values[7][$version_seven_button_text_color_field['name']] ) ? $values[7][$version_seven_button_text_color_field['name']] : '';


/* Generate all metabox fields */

// Generate shortcode tag code
$this->field_generator->get_shortcode_tag_field( 
    $post->ID,
    esc_html__( 'Slider shortcode:', 'woo-shop-slider-lite' ), 
    esc_html( Shindiri_Woo_Slider_Shortcodes::slider_shortcode_tag( $post->ID ) )
);

// Get select field to show cateogories or products
$this->field_generator->get_select_field( 
    esc_html__( 'Choose products or categories:', 'woo-shop-slider-lite' ), 
    $version_seven_show_what_field['slider'] . $version_seven_show_what_field['name'], 
    array(
        array( 'value'=> 'categories', 'title' => esc_html__( 'Categories', 'woo-shop-slider-lite' ) ),
        array( 'value'=> 'products', 'title' => esc_html__( 'Products', 'woo-shop-slider-lite' ) ),
    ),
    $version_seven_show_what, 
    esc_html__( 'Choose what to display in Your slider. If "Products" are selected then slider will show products from all selected categories. ', 'woo-shop-slider-lite' )
    . esc_html__( 'It is recommended to have at least 4 product or categories selected for slider to function as designed.', 'woo-shop-slider-lite' ),
    '',
    '',
    FALSE,
    array( 'sh-ws-show-what-field' )
); 

// Generate categories multiselect fields
$this->field_generator->get_multiselect_field( 
    esc_html__( 'All categories (select a category or multiple categories)', 'woo-shop-slider-lite' ), 
    $version_seven_cat_multiselect_field['slider'] . $version_seven_cat_multiselect_field['name'], 
    $wc_categories_for_select,
    $version_seven_cat_multiselect,
    esc_html__( 'Categories', 'woo-shop-slider-lite' ),
    esc_html( 'Chose categories and then use sorting on the right to make desired order. First category will be used as featured category.', 'woo-shop-slider-lite' )
);

?>
<!-- Tab content box start -->
<div class="sh-ws-tab-content-box sh-ws-box-1">
    <?php 
    // Generate custom link text
    $this->field_generator->get_text_field( 
        esc_html__( 'Set custom button text:', 'woo-shop-slider-lite' ), 
        $version_seven_custom_link_text_field['slider'] . $version_seven_custom_link_text_field['name'], 
        $version_seven_custom_link_text
    );   

    // Generate product sorting select field
    ?> 
    <div<?php echo $version_seven_hide_prod_fields_class; ?>>
    <?php
    $this->field_generator->get_select_field( 
        esc_html__( 'Sort products by:', 'woo-shop-slider-lite' ), 
        $version_seven_products_sorting_field['slider'] . $version_seven_products_sorting_field['name'], 
        array(
            array( 'value'=> 'recent', 'title' => esc_html__( 'Recent products (Ordered by date)', 'woo-shop-slider-lite' ) ),
            array( 'value'=> 'featured', 'title' => esc_html__( 'Featured products (Ordered by date)', 'woo-shop-slider-lite' ) ),
            array( 'value'=> 'top_rated', 'title' => esc_html__( 'Top rated products (Ordered by rating)', 'woo-shop-slider-lite' ) ),
            array( 'value'=> 'best_selling', 'title' => esc_html__( 'Best selling products (Ordered by number of sales)', 'woo-shop-slider-lite' ) ),
            array( 'value'=> 'on_sale', 'title' => esc_html__( 'Products on sale (Ordered by date)', 'woo-shop-slider-lite' ) ),
            array( 'value'=> 'random', 'title' => esc_html__( 'Random', 'woo-shop-slider-lite' ) ),
        ),
        $version_seven_products_sorting
    );  
    ?>
    </div>
    <?php


    // Generate products limit select field
    ?> 
    <div<?php echo $version_seven_hide_prod_fields_class; ?>>
    <?php
    $version_seven_slider_limit_options = array();
    for ( $version_seven_slider_limit_count = 1; $version_seven_slider_limit_count <= 99; $version_seven_slider_limit_count++ ) {
        $version_seven_slider_limit_options[] = array( 'value'=> $version_seven_slider_limit_count, 'title' => $version_seven_slider_limit_count );
    }

    $this->field_generator->get_select_field( 
        esc_html__( 'Maximum products', 'woo-shop-slider-lite' ), 
        $version_seven_slider_limit_field['slider'] . $version_seven_slider_limit_field['name'], 
        $version_seven_slider_limit_options,
        $version_seven_slider_limit
    );
    ?>
    </div>
    
    <?php
    // Generate media uploader
    $this->field_generator->get_media_uploader( 
        esc_html__( 'Slider image placeholder', 'woo-shop-slider-lite' ), 
        $version_seven_custom_placeholder_url, 
        $version_seven_custom_placeholder_field['slider'] . $version_seven_custom_placeholder_field['name'], 
        $version_seven_custom_placeholder_id, 
        $version_seven_custom_placeholder_default, 
        esc_html__( 'Upload slider custom placeholder.', 'woo-shop-slider-lite' ) 
    ); 
    ?>
</div>
<!-- Tab content box end -->

<!-- Tab content box start -->
<div class="sh-ws-tab-content-box sh-ws-box-2">
    <?php 
    // Generate full screen radio fields
    $this->field_generator->get_radio_field( 
        esc_html__( 'FullScreen slider', 'woo-shop-slider-lite' ), 
        $version_seven_full_screen_field['slider'] . $version_seven_full_screen_field['name'], 
        $version_seven_full_screen,
        array( 
            array( 'label' => esc_html__( 'Yes', 'woo-shop-slider-lite' ), 'value' => 'yes' ),
            array( 'label' => esc_html__( 'No', 'woo-shop-slider-lite' ), 'value' => 'no' ),
        )
    );  

    // Generate input range field
    $this->field_generator->get_range_slider( 
        esc_html__( 'Slider height', 'woo-shop-slider-lite' ),  
        $version_seven_slider_height_field['slider'] . $version_seven_slider_height_field['name'],
        $version_seven_slider_height, 
        2800,
        450,
        1
    ); 
    
    // Generate lazy load radio fields
    $this->field_generator->get_radio_field( 
        esc_html__( 'Lazy loading', 'woo-shop-slider-lite' ), 
        $version_seven_lazy_load_field['slider'] . $version_seven_lazy_load_field['name'],
        $version_seven_lazy_load,
        array( 
            array( 'label' => esc_html__( 'Yes', 'woo-shop-slider-lite' ), 'value' => 'yes' ),
            array( 'label' => esc_html__( 'No', 'woo-shop-slider-lite' ), 'value' => 'no' ),
        )
    );  
    ?>
</div>
<!-- Tab content box end -->

<!-- Tab content box start -->
<div class="sh-ws-tab-content-box sh-ws-box-3">
    <?php 
    // Generate transition select field
    $this->field_generator->get_select_field( 
        esc_html__( 'Slider transition', 'woo-shop-slider-lite' ), 
        $version_seven_slider_transition_field['slider'] . $version_seven_slider_transition_field['name'], 
        array(
            array( 'value'=> 'slide', 'title' => esc_html__( 'Slide', 'woo-shop-slider-lite' ) ),
            array( 'value'=> 'coverflow', 'title' => esc_html__( 'Coverflow', 'woo-shop-slider-lite' ) ),
        ),
        $version_seven_slider_transition, 
        ''
    ); 
    
    // Generate autoplay radio fields
    $this->field_generator->get_select_field( 
        esc_html__( 'Autoplay', 'woo-shop-slider-lite' ),
        $version_seven_autoplay_field['slider'] . $version_seven_autoplay_field['name'],
        array(
            array( 'value'=> 'off', 'title' => esc_html__( 'Off', 'woo-shop-slider-lite' ) ),
            array( 'value'=> 'on', 'title' => esc_html__( 'On', 'woo-shop-slider-lite' ) ),
            array( 'value'=> 'mobile', 'title' => esc_html__( 'Only on mobile and tablets', 'woo-shop-slider-lite' ) ),
        ),
        $version_seven_autoplay, 
        esc_html__( 'Enable slider autoplay.', 'woo-shop-slider-lite' )
    ); 

    // Generate autoplay timeout range slider
    $this->field_generator->get_range_slider( 
        esc_html__( 'Autoplay timeout', 'woo-shop-slider-lite' ),
        $version_seven_autoplay_timeout_field['slider'] . $version_seven_autoplay_timeout_field['name'],
        $version_seven_autoplay_timeout, 
        10000,
        1000,
        1,
        esc_html__( 'Delay between transitions (in ms).', 'woo-shop-slider-lite' )
    );
    ?>
</div>
<!-- Tab content box end -->


<!-- Subsection  Style settings start -->
<div class="sh-ws-tab-content-subsection">
    <?php echo esc_html__( 'Style settings', 'woo-shop-slider-lite' ); ?>
</div>

<?php 
// Generate enable / disable typography select field
$this->field_generator->get_select_field( 
    sprintf( esc_html__( '%s typography', 'woo-shop-slider-lite' ), Shindiri_Woo_Slider::get_plugin_public_name() ),
    $version_seven_disable_typography_field['slider'] . $version_seven_disable_typography_field['name'], 
    array(
        array( 'value'=> 'enabled', 'title' => esc_html__( 'Enabled', 'woo-shop-slider-lite' ) ),
        array( 'value'=> 'disabled', 'title' => esc_html__( 'Disabled', 'woo-shop-slider-lite' ) ),
    ),
    $version_seven_disable_typography, 
    esc_html__( 'Chose &quot;disable&quot; to use current theme font-family, colors, etc...', 'woo-shop-slider-lite' )
); 
?>

<!-- Tab content box start -->
<div class="sh-ws-tab-content-box sh-ws-box-1">
    <div class="sh-ws-hide-typography-off<?php echo $version_seven_typography_fields_class; ?>">
    <?php 
    // Geberate text color select field
    $this->field_generator->get_select_field( 
        esc_html__( 'Select light or dark content', 'woo-shop-slider-lite' ), 
        $version_seven_theme_color_field['slider'] . $version_seven_theme_color_field['name'], 
        array(
            array( 'value'=> 'light', 'title' => esc_html__( 'Light', 'woo-shop-slider-lite' ) ),
            array( 'value'=> 'dark', 'title' => esc_html__( 'Dark', 'woo-shop-slider-lite' ) ),
        ),
        $version_seven_theme_color
    ); 
    ?>
    </div><!-- .sh-ws-hide-typography-off -->
    
    <?php 
    // Generate color picker for slider overlay
    $this->field_generator->get_color_picker( 
        esc_html__( 'Select overlay color for slides', 'woo-shop-slider-lite' ), 
        $version_seven_overlay_color_field['slider'] . $version_seven_overlay_color_field['name'], 
        $version_seven_overlay_color, 
        ''
    );  
    
    // Generate color picker for content overlay
    $this->field_generator->get_color_picker( 
        esc_html__( 'Select content overlay color', 'woo-shop-slider-lite' ), 
        $version_seven_content_overlay_field['slider'] . $version_seven_content_overlay_field['name'], 
        $version_seven_content_overlay,
        '',
        esc_html__( 'Set overlay color for product or category details.', 'woo-shop-slider-lite' ) 
    ); 
    ?>
</div>
<!-- Tab content box end -->

<!-- Tab content box start -->
<div class="sh-ws-tab-content-box sh-ws-box-2">
    <div class="sh-ws-hide-typography-off<?php echo $version_seven_typography_fields_class; ?>">
    <?php 
    // Generate color picker for accent color
    $this->field_generator->get_color_picker( 
        esc_html__( 'Main color', 'woo-shop-slider-lite' ), 
        $version_seven_accent_color_field['slider'] . $version_seven_accent_color_field['name'], 
        $version_seven_accent_color, 
        ''
    );
    
    // Generate button type select field
    $this->field_generator->get_select_field( 
        esc_html__( 'Button type', 'woo-shop-slider-lite' ),
        $version_seven_button_type_field['slider'] . $version_seven_button_type_field['name'],
        array(
            array( 'value'=> 'sh-ws-button-filled', 'title' => esc_html_x( 'Filled', 'button type for css', 'woo-shop-slider-lite' ) ),
            array( 'value'=> 'sh-ws-button-outlined', 'title' => esc_html_x( 'Outlined', 'button type for css', 'woo-shop-slider-lite' ) ),
            array( 'value'=> 'sh-ws-button-rounded', 'title' => esc_html_x( 'Rounded', 'button type for css', 'woo-shop-slider-lite' ) ),
        ),
        $version_seven_button_type
    ); 
    
    // Generate color picker for button text color
    $this->field_generator->get_color_picker( 
        esc_html__( 'Button text color', 'woo-shop-slider-lite' ), 
        $version_seven_button_text_color_field['slider'] . $version_seven_button_text_color_field['name'], 
        $version_seven_button_text_color, 
        ''
    );
    ?>
    </div><!-- .sh-ws-hide-typography-off -->
</div>
<!-- Tab content box end -->

<!-- Tab content box start -->
<div class="sh-ws-tab-content-box sh-ws-box-3">
    <div class="sh-ws-hide-typography-off<?php echo $version_seven_typography_fields_class; ?>">
    <?php 
    // Generate color picker for overlay
    $this->field_generator->get_color_picker( 
        esc_html__( 'Product sale ribbon text color', 'woo-shop-slider-lite' ), 
        $version_seven_sale_text_color_field['slider'] . $version_seven_sale_text_color_field['name'], 
        $version_seven_sale_text_color,
        ''
    ); 
    
    // Generate color picker for overlay
    $this->field_generator->get_color_picker( 
        esc_html__( 'Product sale background color', 'woo-shop-slider-lite' ), 
        $version_seven_sale_bg_color_field['slider'] . $version_seven_sale_bg_color_field['name'], 
        $version_seven_sale_bg_color, ''
    ); 
    ?>
    </div><!-- .sh-ws-hide-typography-off -->
</div>
<!-- Tab content box end -->

<!-- Subsection  Style settings end -->