<?php
/**
 *
 * This file is used to create quick view for woocommerce products
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woocommerce_Quick_Look
 */


if ( !class_exists( 'Shindiri_Woocommerce_Quick_View' ) ) {
    /**
    * The main metabox class.
    *
    * This is used to create quick view for woocommerce products
    *
    * @since      1.0.0
    * @package    Shindiri_Woocommerce_Quick_Look
    * @author     Shindiri Studio
    */
    class Shindiri_Woocommerce_Quick_Look {
        
        /**
        * Shindiri quick view plugin version
        *
        * @since    1.0.0
        * @access   public
        * @var      string    $plugin_version    Shindiri quick view plugin version
        */
        public $plugin_version = '1.0.0';
        
        /**
        * Shindiri quick view plugin unique name (slug)
        *
        * @since    1.0.0
        * @access   public
        * @var      string    $plugin_name    Shindiri quick view plugin unique name (slug)
        */
        public $plugin_name = 'shindiri-woocommerce-quick-view';
        
        /**
        * Disable or enable Quick View Button
        *
        * @since    1.0.0
        * @access   public
        * @var      boolean    $quick_look_switch    Disable or enable Quick View Button
        */
        public $quick_look_switch = true;
        
        /**
        * Disable or enable Quick View Button on all products in shop and product categories
        *
        * @since    1.1.1
        * @access   public
        * @var      boolean    $quick_look_shop_switch    Disable or enable Quick View Button on all products in shop and product categories
        */
        public $quick_look_shop_switch = false;
        
        /**
        * Quick view shop button additional clsses
        *
        * @since    1.1.1
        * @access   public
        * @var      string    $qv_shop_btn_classes    Quick view shop button additional clsses
        */
        public $qv_shop_btn_classes = '';
        
        /**
        * Hook into the appropriate actions when the class is constructed
        *
        * @since    1.0.0
        */
        public function __construct() {
            
            // Check if WooCommerce is not active
			if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				if (  ! is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) {
					return; // return if not activated
				}
			}
            
            // Quick View Product details
            add_action( 'woocommerce_api_shindiri_wc_generate_quick_view', array( $this, 'quick_view' ) );
            // Scripts
            add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );
            // Generate quick view button on frontend
            add_filter( 'shindiri_wc_generate_quick_view_button', array( $this, 'quick_view_button' ), 10, 4 );
            // Add Quick View Button on all products in shop and product categories
            add_action( 'woocommerce_after_shop_loop_item', array( $this, 'quick_view_button_on_shop_products' ), 10 );

            // Set true or false if Quick Look button disabled by user
            $common_settings = Shindiri_Woo_Slider_Common_settings_Metabox::get_common_settings();
            // Need to be true in no slider exist
            $this->quick_look_switch = isset( $common_settings['quick_look_switch'] ) && $common_settings['quick_look_switch'] === 'disabled' ? false : true;
            // Need to be false if no slider exist
            $this->quick_look_shop_switch = isset( $common_settings['quick_look_shop_switch'] ) && $common_settings['quick_look_shop_switch'] === 'enabled' ? true : false;
            $this->qv_shop_btn_classes = isset( $common_settings['qv_shop_btn_classes'] ) && !empty( $common_settings['qv_shop_btn_classes'] ) ? sanitize_text_field( $common_settings['qv_shop_btn_classes'] ) : '';
            
        }

        /**
        * Generate quick view template
        *
        * @since    1.0.0
        */
        public function quick_view() {
            
            global $post;

            $product_id = absint($_GET['product']);

            if ($product_id) {
                // Get product ready
                $post = get_post($product_id);

                setup_postdata($post);
                
                // Get quick view template
                $_template_file = apply_filters( 'shindiri_woocommerce_quick_view_template', plugin_dir_path( __FILE__ ) . 'templates/quick-look.php' );

                load_template( $_template_file, false );
                
                wp_reset_postdata();
            }
            exit;
        }
        
        /**
        * Add scripts to public site side
        *
        * @since    1.0.0
        */
        function add_scripts() {
            
            global $woocommerce;
            
            if ( isset( $woocommerce ) && $this->quick_look_switch ) {
            
                $assets_path = $woocommerce->plugin_url() . '/assets/';

                // Pretty photo vendor js
                wp_enqueue_script( 'prettyPhoto', $assets_path . 'js/prettyPhoto/jquery.prettyPhoto.min.js', array ( 'jquery' ), $woocommerce->version, true );
                
                // Custom scripts
                wp_enqueue_script( $this->plugin_name, plugins_url( '/assets/js/public.min.js', __FILE__ ), array ( 'prettyPhoto' ), $this->plugin_version, true );
                
                /*
                 * Add loader url that is used across whole slider
                 */
                $sh_ws_common_values = new Shindiri_Woo_Slider_Shortcode_Version_Basic();
                $default_loader = $sh_ws_common_values::$loader_html;
                $quick_view_loader = '<div class="sh-pqv-loader">' . Shindiri_Woo_Slider_Helper::validate_allowed_html( $default_loader ) . '</div>';
                wp_localize_script( $this->plugin_name, 'shindiri_woocommerce_quick_view_js_data', array( 'loader' => $quick_view_loader ) );
                
                // Pretty photo vendor css
                wp_enqueue_style( 'woocommerce_prettyPhoto_css', $assets_path .'css/prettyPhoto.css' );
                // Font awsome vendor files
                wp_enqueue_style( 'shindiri-woo-slider-font-awsome', plugin_dir_url( __FILE__ ) . 'css/font-awsome/css/font-awesome.min.css', array(), '4.5.0', 'all' );
            }
        }
        
        /**
        * Generate quick view button template
        *
        * @since    1.0.0
        * 
         * @param   string  $button     Button html. If passed than the filter will use this html and disregard all other passed vars. If passed empty string than filter will return default button with additional vars used
         * @param   string  $classes    Additional classes to append to button
         * @param   string  $button_text    Custom button text
         * @param   string  $html_tag    Html tag, button or a tag. Pass as string: "a" or "button" without html markup
         * 
        * @return   string  Return quick look init button
        */
        public function quick_view_button( $button = '', $classes = '', $button_text = '', $html_tag = '' ) {
            
            // Return passed button if any and do not generate your own, usualy this will never be true
            if ( !empty( $button ) ) {
                return self::validate_allowed_html( $button );
            }
            
            // Check html tag passed if is a or button
            $button_type = $html_tag === 'a' ? $html_tag : 'button';
            
            // Bridge class to get all WooCommerce product data
            $sh_ws_product = Shindiri_Woo_Slider_WC_Product_Data::get_product( get_the_ID() );
            
            // If Quick Look not disabled return output
            if ( $this->quick_look_switch ) {
                $button = sprintf( '<%s type="button" data-view="?wc-api=shindiri_wc_generate_quick_view&product=%s&width=%s&height=%s&ajax=true" rel="nofollow" class="%s button">%s</%s>',
                    esc_attr( $button_type ),
                    esc_attr( $sh_ws_product->get_id() ),
                    '80%',
                    '60%',
                    empty( $classes ) ? 'sh-ws-quick-look' : 'sh-ws-quick-look ' . esc_attr( $classes ),
                    empty( $button_text ) ? esc_html__( 'Quick look', 'woo-shop-slider-lite' ) : esc_html( $button_text ),
                    esc_attr( $button_type )
                );
            }
            
            // Another filter so user can override only output
            return apply_filters( 'shindiri_woocommerce_quick_view_button', $button, $sh_ws_product );
            
        }
        
        /**
        * Generate quick view button template
        *
        * Using: woocommerce_after_shop_loop_item
        * 
        * @since    1.1.1
        */
        public function quick_view_button_on_shop_products() {
            
            // If Quick Look not disabled and Quick look shop button not disabled
            if ( $this->quick_look_switch && $this->quick_look_shop_switch ) {
                echo apply_filters( 'shindiri_wc_generate_quick_view_button', '', $this->qv_shop_btn_classes );
            }
       }
        
        /**
        * Return sale square ribbon html
        *
        * @since 1.0.0
        * 
        * @param string    $typography_slider_class   If passes class not empty than slider has enabled typography
        * @param object    $post   Post object
        * @param object    $product   Product object
        * @param string    $text_color   Sale ribbon text color
        * @param string    $bg_color   Sale ribbon background color
        * 
        * @return  string  Return sale square ribbon html
        */
       public static function product_sale_square_button( $typography_slider_class, $post, $product, $text_color = '', $bg_color = '' ) {
           
           $sale_text = '';
           
           // Get on sale badge if product on sale
            if ( $product->is_on_sale() ) {

                $sale_text = esc_html__( 'Sale!', 'woo-shop-slider-lite' );

                $inline = array();

                // User selected text color
                if ( !empty( $text_color ) ) {
                    $inline[] = 'color: ' . sanitize_text_field( $text_color ) . ' !important;';
                }

                // User selected background color
                if ( !empty( $bg_color ) ) {
                    $inline[] = 'background: ' . sanitize_text_field( $bg_color ) . ' !important;';
                }

                if ( !empty( $typography_slider_class ) ) {
                    // If our typography is enabled

                    // Will never be empty as of background color
                    $style = !empty( $inline ) && is_array( $inline ) ? ' style="' . implode( ' ', $inline ) . '"' : '';

                    $sale_html = '<span class="onsale" ' . sanitize_text_field( $style ) . '>' . $sale_text . '</span>';
                    return $sale_html;
                } else {
                    // If typography is disabled
                    $sale_html = '<span class="onsale">' . $sale_text . '</span>';
                    $sale_html = apply_filters( 'woocommerce_sale_flash', $sale_html, $post, $product );
                    
                    // Only allowed html
                    $sale_text = self::validate_allowed_html( $sale_html );
                }
            }
            
            return $sale_text;
       }
        
        /**
        * Limit number of words in some string
        *
        * @since 1.0.0
        *
        * @param string    $text   Some text to check for words number
        * 
        * @return  string  Filtered text
        */
       public static function trim_excerpt( $text, $excerpt_length = 40 ) {
           $raw_excerpt = $text;
           $excerpt_more = '...';

           // If you need full excerpt put all below content until Disable read more under upper if
           $text = strip_shortcodes( $text );
           $text = apply_filters('the_content', $text);
           $text = str_replace(']]>', ']]>', $text);
           $text = strip_tags($text, '<a>');

           $words = preg_split('/(<a.*?a>)|\n|\r|\t|\s/', $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE );

           if ( count($words) > $excerpt_length ) {
           array_pop($words);
               $text = implode(' ', $words);
               // Add read more
               $text = !empty( $text ) ? $text . $excerpt_more : $text;

           } else {
               $text = implode(' ', $words);

           }

           return apply_filters('shindiri_woo_slider_wp_trim_excerpt', $text, $raw_excerpt);

       }
       
       /**
        * Validate html for allowed html tags
        *
        * @since 1.0.0
        *
        * @param   string    $html   Post ID.
        * 
        * @access  public
        * @return  Validated string
        */
       public static function validate_allowed_html( $html ) {

           // Get allowed html
           global $allowedposttags;

           // Add more allowed tags
           $allowed_tags = $allowedposttags;

           $allowed_tags['iframe'] = array(
               'src' => 1,
               'width' => 1,
               'height' => 1,
               'align' => 1,
               'class' => 1,
               'name' => 1,
               'id' => 1,
               'frameborder' => 1,
               'seamless' => 1,
               'srcdoc' => 1,
               'sandbox' => 1,
               'allowfullscreen' => 1
           );

           $allowed_tags['embed'] = array(
               'src' => 1,
               'width' => 1,
               'height' => 1,
               'align' => 1,
               'class' => 1,
               'name' => 1,
               'id' => 1,
               'frameborder' => 1,
               'seamless' => 1,
               'srcdoc' => 1,
               'sandbox' => 1,
               'allowfullscreen' => 1
           );

           // Sanitize output
           $html = wp_kses( $html, $allowed_tags );

           return $html;
       }
        
    }
}