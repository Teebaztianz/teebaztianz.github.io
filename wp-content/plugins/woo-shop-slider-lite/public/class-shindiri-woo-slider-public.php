<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version
 * Public-specific functions
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/public
 * @author     Shindiri Studio
 */
class Shindiri_Woo_Slider_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
    
    /**
	 * Add all shrotcodes versions
	 *
	 * @since    1.0.0
	 */
    public function add_shortcodes() {
        
        // Require all classes to handle WooCommerce product
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/shindiri-woo-slider-product/abstracts/abstract-shindiri-woo-slider-wc-product.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/shindiri-woo-slider-product/shindiri-woo-slider-wc-product-data.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/shindiri-woo-slider-product/shindiri-woo-slider-wc-product.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/shindiri-woo-slider-product/shindiri-woo-slider-wc-product-deprecated.php';
        // Require base class that all versions inherit
        require_once plugin_dir_path( __FILE__ ) . 'shortcodes/versions/basic/class-shindiri-woo-slider-version-basic.php';
        
        // Autoload all shortcode slider versions from config array. Include all slider version classes
        $slider_versions = Shindiri_Woo_Slider_Main_Metabox::get_metabox_tab_content_versions();
        if ( is_array( $slider_versions ) && !empty( $slider_versions ) ) {
            foreach ($slider_versions as $class) {
                if ( isset( $class['path'] ) && file_exists( $class['path'] ) ) {
                    include_once $class['path'];
                }
            }
        }
        
        // Require main shortcode class
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/shortcodes/class-shindiri-woo-slider-public-shortcodes.php';
        add_shortcode( Shindiri_Woo_Slider::SHORTCODE_TAG, array( 'Shindiri_Woo_Slider_Shortcodes', 'slider_shortcode' ) );
    }
    
    /**
	 * Add product quick view
	 *
	 * @since    1.0.0
	 */
    public function add_product_quick_view() {
        // Require main shortcode class
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/includes/shindiri-woocommerce-quick-look/shindiri-woocommerce-quick-look.php';
        new Shindiri_Woocommerce_Quick_Look();
    }
	/**
	 * Stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
        
        // Enqueue google fonts
        wp_enqueue_style( $this->plugin_name . '-google-fonts', $this->google_fonts_url() );

        // Font vendor files
		wp_enqueue_style( $this->plugin_name . '-font-awsome', plugin_dir_url( __FILE__ ) . 'css/font-awsome/css/font-awesome.min.css', array(), '4.5.0', 'all' );
		wp_enqueue_style( $this->plugin_name . '-font-hotcart', plugin_dir_url( __FILE__ ) . 'css/hotcart/hotcart.css', array(), '1.0.0', 'all' );
        
        // Swiper vendor files
		wp_enqueue_style( $this->plugin_name . '-swiper', plugin_dir_url( __FILE__ ) . 'css/swiper.css', array(), '3.1.7', 'all' );
        // Custom bootstrap grid
        wp_enqueue_style( $this->plugin_name . '-bootstrap-grid', plugin_dir_url( __FILE__ ) . 'css/custom-bootstrap-grid.css', array( $this->plugin_name . '-swiper' ),'1.0.0', 'all' );

	}
    
    /**
	 * Stylesheets for the public-facing side of the site loaded last.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles_last() {
        // Frontend files
		$main_css_url = apply_filters( 'shindiri_woo_slider_main_css_url', plugin_dir_url( __FILE__ ) . 'css/style.min.css' );
		wp_enqueue_style( $this->plugin_name, $main_css_url, array( $this->plugin_name . '-bootstrap-grid' ), $this->version, 'all' );
        // Filter processed in this class functin 'collect_inline_css'
        $custom_css = apply_filters('shindiri_woo_slider_plugin_inline_css', '');
        wp_add_inline_style( $this->plugin_name, $custom_css );
    }
    
    /**
	 * Return inlince css for all sliders that have used stype settings to customize colors and typography is on
	 *
     * hooked in Shindiri_Woo_Slider_Public/enqueue_styles_last function
     * 
	 * @since    1.1.0
	 */
    public function collect_inline_css( $css = '' ) {
        
        $inline_css = '';
        
        $inline_css_path = plugin_dir_path( __FILE__ ) . 'css/inline-css/';
        
        // Get all created sliders and check their meta values
        $the_query = Shindiri_Woo_Slider_Helper::return_all_sliders( '', -1, true, true, true, false );

        if ( $the_query->have_posts() ) : 
            
            while ( $the_query->have_posts() ) : $the_query->the_post();
        
                // Get meta for each slider
                $meta_values = Shindiri_Woo_Slider_Helper::get_meta_values( get_the_ID() );

                if ( $meta_values ) {

                    // Limit process data only for slider that is market as active
                    if ( isset( $meta_values[0]['slider_version_active'] ) ) {

                        // Parse active version
                        $active_slider_slug = $meta_values[0]['slider_version_active'];
                        $active_version_number = intval( substr( $active_slider_slug, -1 ) );

                        $typography_on = $meta_values[$active_version_number]['disable_typography'] === 'enabled' ? true : false;

                        // If number is indeed active version number and using typography
                        if ( is_int( $active_version_number ) && $typography_on ) {

                            // Separate meta only for active version
                            $slider_settings = $meta_values[$active_version_number];
                            $attributes = array();
                            // Must keep this format
                            $check_settings = array( 
                                'accent_color' => array( 
                                    'main_color', 
                                    'hover'
                                ),
                                'button_text_color' => array( 
                                    'button_color', 
                                    'button_hover'
                                )
                            );
                            
                            /*
                             * Array contain default values to clean leftovers that have not been replaced, 
                             * as one of the settings can be empty and will not replace value at string
                             * 
                             * These values are used in string and will be replaced
                             * 
                             * We first replace values from $check_settings array than clean leftovers
                             * 
                             */
                            $clean_values = array(
                                'search' => array( 
                                    'border-color: [hover] !important;', // Remove this first as of conflict
                                    'border-color: [main_color] !important;', // Remove this first as of conflict
                                    'background: [main_color] !important;', 
                                    'background: [hover] !important;', 
                                    'color: [main_color] !important;',
                                    'color: [hover] !important;', 
                                    'color: [button_color] !important;', 
                                    'color: [button_hover] !important;', 
                                ),
                                'replace' => array( '', '', '', '', '' )
                            );

                            // Loop through every settings field
                            foreach ( $check_settings as $check_one_setting => $atts_to_change ) {

                                // If field from metabox value not empty and exists add it to array for later replacement in inline css string
                                if ( isset( $slider_settings[$check_one_setting] ) && !empty( $slider_settings[$check_one_setting] ) ) {

                                    // Map all that need to be replaced later
                                    foreach( $atts_to_change as $attr_to_change ) {
                                        
                                        $value_from_setting = $slider_settings[$check_one_setting];

                                        // Convert color to rgba only if hover used
                                        if ( $attr_to_change === 'hover' || $attr_to_change === 'button_hover' ) {
                                            $slider_settings[$check_one_setting] = $this->hextorgb( $value_from_setting, 0.8 );
                                        }

                                        $attributes[$attr_to_change] = $slider_settings[$check_one_setting];
                                    }
                                }

                            }

                            // If upper are mapped attributes that need change proceed
                            if ( !empty( $attributes ) ) {

                                // Path to custom inline css
                                $inline_css_file = $inline_css_path . $active_slider_slug . '.php';

                                if ( file_exists( $inline_css_file ) ) {

                                    // Change unique slider class to target only that slider
                                    $css_unique_id = Shindiri_Woo_Slider_Custom_Css_Metabox::generate_slider_custom_css_class( get_the_ID() );

                                    // Search array start with unique class
                                    $search = array(
                                        '[css-id]'
                                    );
                                    // Replace start with unique class value
                                    $replace = array(
                                        $css_unique_id
                                    );

                                    // parse and prepare arrays for str_replace
                                    foreach ( $attributes as $search_this => $replace_with_this ) {
                                        $search[] = '[' . $search_this . ']';
                                        $replace[] = sanitize_text_field( $replace_with_this );
                                    }

                                    // Get inline css and change all values
                                    $inline_css_to_process = include $inline_css_file;
                                    $inline_css_to_process = str_replace( $search, $replace, $inline_css_to_process );
                                    
                                    
                                    // Clean up leftovers that have not been replaced, as one of the settings can be empty
                                    $inline_css_to_process = str_replace( $clean_values['search'], $clean_values['replace'], $inline_css_to_process );
                                    
                                    $inline_css .= $inline_css_to_process;
                                }

                            }
                        }
                    }
                }
            
            endwhile; 
            wp_reset_postdata();
            
        endif;
        
        // Use sanitize to clear all not needed white space
        return sanitize_text_field( $inline_css );
    }
    
    /**
	 * Custom css for the public-facing side of the site. 
     * Loaded after plugin styles
	 *
	 * @since    1.0.0
	 */
	public function enqueue_custom_css() {
        
        // Get all sliders with custom css
        $additional_args = array(
            'meta_key'     => Shindiri_Woo_Slider::CUSTOM_CSS_METABOX_KEY,
            'meta_value'   => 'no-custom-css',
            'meta_compare' => '!='
        );
        
        $the_query = Shindiri_Woo_Slider_Helper::return_all_sliders( $additional_args, -1, true, true, true, false );
        
        if ( $the_query->have_posts() ) : 
            
            echo '<style type="text/css">';
            
            while ( $the_query->have_posts() ) : $the_query->the_post();
        
            // Each sliders custom css
            echo get_post_meta( get_the_ID(), Shindiri_Woo_Slider::CUSTOM_CSS_METABOX_KEY, true );
            
            endwhile; 
            wp_reset_postdata();
            
            echo '</style>';
            
        endif;
    }

	/**
	 * Stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
        
        // Swiper vendor files
		wp_enqueue_script( $this->plugin_name . '-swiper', plugin_dir_url( __FILE__ ) . 'js/swiper.min.js', array( 'jquery' ), '3.1.7', true );
		wp_enqueue_script( $this->plugin_name . '-easing', plugin_dir_url( __FILE__ ) . 'js/jquery.easing.js', array( $this->plugin_name . '-swiper' ), '1.3.0', true );
        
	}
    
    /**
	 * Return Google fonts url
	 *
	 * @since    1.0.0
	 */
	public function google_fonts_url() {
        
        $font_url = '';

        /*
         * Translators: If there are characters in your language that are not supported
         * by these fonts, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Lato', 'woo-shop-slider-lite' ) ) {
            $font_url = add_query_arg( 'family', urlencode( 'Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
        }

        return esc_url_raw( $font_url );
        
	}
    
    /**
     * Convert hex to rgba or rgb color
     *
     * @since 1.1.0
     *
     * @param string    $hex   Hex color with #
     * @param string/int    $alpha   Desired alpha
     * 
     * @return  string  Return rgba / rgb color from hex
     */
    protected function hextorgb( $hex, $alpha = false ) {
        $hex = str_replace( '#', '', $hex );
        if ( strlen( $hex ) == 6) {
            $rgb['r'] = hexdec( substr( $hex, 0, 2 ) );
            $rgb['g'] = hexdec( substr( $hex, 2, 2 ) );
            $rgb['b'] = hexdec( substr( $hex, 4, 2 ) );
        } else if ( strlen( $hex ) == 3 ) {
            $rgb['r'] = hexdec( str_repeat( substr( $hex, 0, 1 ), 2 ) );
            $rgb['g'] = hexdec( str_repeat( substr( $hex, 1, 1 ), 2 ) );
            $rgb['b'] = hexdec( str_repeat( substr( $hex, 2, 1 ), 2 ) );
        } else {
            $rgb['r'] = '0';
            $rgb['g'] = '0';
            $rgb['b'] = '0';
        }
        if ($alpha) {
            $rgb['a'] = $alpha;
        }
        return implode( '', array_keys( $rgb ) ) . '(' . implode( ', ', $rgb ) . ')';
    }

}
?>