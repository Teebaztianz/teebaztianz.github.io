<?php
/**
 * Basic shortcodes version class to implement common elements
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/public/shortcodes/versions/basic
 */
class Shindiri_Woo_Slider_Shortcode_Version_Basic {
    
    /**
     * Define css class for active lazy loading
     * 
     * @since   1.0.0
     * @access protected
     * @var $lazy_load_active_css_class   Define css class for active lazy loading
     */
    protected static $lazy_load_active_css_class = 'sh-ws-lazy-active';
    
    /**
     * Define css class for inactive lazy loading
     * 
     * @since   1.0.0
     * @access protected
     * @var $lazy_load_inactive_css_class   Define css class for inactive lazy loading
     */
    protected static $lazy_load_inactive_css_class = 'sh-ws-lazy-inactive';
    
    /**
     * Define css class for typography
     * 
     * @since   1.0.0
     * @access protected
     * @var $typography_css_class   Class which enable / disable slider typography
     */
    protected static $typography_css_class = ' sh-ws-typography';
    
    /**
     * Default loader image url for slides
     * 
     * @since   1.0.0
     * @access public
     * @var $loader_html   Default loader image html for slides
     */
    public static $loader_html;
    
    /**
     * Default small placeholder
     * 
     * @since   1.0.0
     * @access public
     * @var $placeholder_small   Default small placeholder
     */
    public static $placeholder_small;
    
    /**
     * Default placeholder
     * 
     * @since   1.0.0
     * @access public
     * @var $placeholder   Default placeholder
     */
    public static $placeholder;
    
    /**
     * Default slider transition
     * 
     * @since   1.0.0
     * @access protected
     * @var $default_slider_transition   Default slider transition which will be used as a fallbacku if no value supplied. Each slider version will have its own property for selected transition
     */
    protected $default_slider_transition = 'slide';
    
    /**
    * Holds thumb size for large image used to get the right image size
    *
    * @since    1.0.0
    * @access   public
    * @var      string    $thumb_size_large    Checked if large thumb size is default size use large or full thumb size
    */
    public $thumb_size_large;
    
    /**
    * Holds thumb size for thumbnail size image or set array( 300, 300 )
    *
    * @since    1.0.0
    * @access   public
    * @var      string    $thumb_size_thumbnail    Checked if thumbnail size is default size use thumb or array( 300, 300 ) size
    */
    public $thumb_size_thumbnail;
    
    /**
    * Holds hex color selected by user for sale text
    *
    * @since    1.0.0
    * @access   protected
    * @var      string    $sale_text_color    Holds hex color selected by user for sale text
    */
    protected $sale_text_color = NULL;
    
    /**
    * Holds hex color selected by user for background
    *
    * @since    1.0.0
    * @access   protected
    * @var      string    $sale_bg_color    Holds hex color selected by user for background
    */
    public $sale_bg_color = NULL;
    
    /**
     * Class init
     * 
     * @since   1.0.0
     */
    public function __construct() {
        self::$loader_html = '<div class="sh-ws-woo-slider-loader"><div class="sh-ws-uil-ring-css" style="transform:scale(0.88);"><div></div></div></div><!-- .sh-ws-woo-slider-loader -->';
        self::$placeholder_small = plugin_dir_url( __FILE__ ) . 'assets/placeholder-small.jpg';
        self::$placeholder = plugin_dir_url( __FILE__ ) . 'assets/placeholder.jpg';
        
        // Get all image sizes and check if large image has default value
        $large_wp_default_img_size = Shindiri_Woo_Slider_Helper::get_all_image_sizes( 'large' );
        $this->thumb_size_large = isset( $large_wp_default_img_size['width'] ) && $large_wp_default_img_size['width'] == '1024' ? 'large' : 'full';
        
        // Get all image sizes and check if thumbnail image has default value or use array( 300, 300 )
        $thumb_wp_default_img_size = Shindiri_Woo_Slider_Helper::get_all_image_sizes( 'thumbnail' );
        $this->thumb_size_thumbnail = isset( $thumb_wp_default_img_size['width'] ) && $thumb_wp_default_img_size['width'] == '150' ? 'thumbnail' : array( 300, 300 );
    }

    /**
	 * Sanitize array of multiselect values
     * 
     * @since    1.0.0
	 *
	 * @param string $value Value from array_map to sanitize
	 */
    public static function sanitize_array( $value ) {
        return sanitize_text_field( $value );
    }
    
    /**
     * Return WP_Query for shortcode
     *
     * @since 1.0.0
     *
     * @param int    $posts_per_page   Posts per page for Query.
     * @param string    $cat_slug   Category slug to limit results to this one category. Array of cat slugs.
     * @param array    $post_not_in   Use post ids. Specify post NOT to retrieve.
     * @param string    $products_sorting   What type of products to fetch: featured, recent, top_rated, best_selling or on_sale...
     * @param int    $product_id   Id of one product to return Query for
     * 
     * @return  object  Return WP_Query object 
     */
    protected function get_shortcode_products_query( $posts_per_page, $cats_slugs, $post_not_in = '', $products_sorting = '', $product_id = FALSE ) {
        
        $the_query_args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => absint( $posts_per_page ),
            'ignore_sticky_posts' => true,
            'no_found_rows' => 1,
            'meta_query' => array()
        );
        
        // Fetch only one product
        if ( !empty( $product_id ) ) {
            $the_query_args['p'] = absint( $product_id );
        }
        
        // Do not retrive this posts
        if( !empty( $post_not_in ) ) {
            $the_query_args['post__not_in'] =  $post_not_in;
        }
        
        // If selected any category add category param
        if( !empty( $cats_slugs ) ) {
            
            $the_query_args['tax_query'] =  array(
                array(
                    'taxonomy'  => 'product_cat',
                    'field'     => 'slug',
                    'terms'     => $cats_slugs
                )               
            );
        }
        
        // If selected sorting
        switch ( $products_sorting ) {
            case 'featured':
                $the_query_args['meta_key'] = '_featured';
                $the_query_args['meta_value'] = 'yes';
                $the_query_args['orderby'] = 'date';
                $the_query_args['order'] = 'desc';
               
                break;
            
            case 'recent':
                $the_query_args['orderby'] = 'date';
                $the_query_args['order'] = 'desc';

                break;
            
            case 'top_rated':
                add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
                
                break;
            
            case 'best_selling':
                $the_query_args['orderby'] = 'meta_value_num';
                $the_query_args['meta_key'] = 'total_sales';
                $the_query_args['meta_value'] = '0';
                $the_query_args['meta_compare'] = '>';

                break;
            
            case 'on_sale':
                $the_query_args['orderby'] = 'meta_value_num';
                $the_query_args['meta_query'][] = array(
                    'relation' => 'OR',
                    array(
                        'key' => '_sale_price',
                        'value' => 0,
                        'compare' => '>',
                        'type' => 'numeric'
                    ),
                    array(
                        'key' => '_min_variation_sale_price',
                        'value' => 0,
                        'compare' => '>',
                        'type' => 'numeric'
                    )
                );

                break;
            
            case 'random':
                $the_query_args['orderby'] = 'rand';
                $the_query_args['order'] = '';
                break;
        }
        
        // Add visible products in catalog only and stock meta query
        $the_query_args['meta_query'][] = WC()->query->get_meta_query();

        $the_query = new WP_Query( $the_query_args );
        
        // If showing top rated products remove added filter 
        if ( $products_sorting === 'top_rated' ) {
            remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
        }
        
        return $the_query;
    }
    
    /**
     * Convert hex to rgba or rgb color
     *
     * @since 1.0.0
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
    
    /**
     * Limit number of words in some string
     *
     * @since 1.0.0
     *
     * @param string    $text   Some text to check for words number
     * 
     * @return  string  Filtered text
     */
    public function trim_excerpt( $text ) {
        $raw_excerpt = $text;
        $excerpt_more = '...';
        
        // If you need full excerpt put all below content until Disable read more under upper if
        $text = strip_shortcodes( $text );
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        $text = strip_tags($text, '<a>');
        
        $excerpt_length = apply_filters('shindiri_woo_slider_excerpt_length', 40);

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
     * Return add to cart ajax woocommerce button
     *
     * @since 1.0.0
     *
     * @param object    $product   Woocommerce product object
     * @param string    $classes   Additional classes to pass to link 
     * @param string    $link_text   Link text
     * 
     * @return  string  Formated string, ajax button html
     */
    public function ajax_add_to_cart_button( $product, $classes = '', $link_text = '' ) {
        
        /*
         * Please note:
         * If Wocommerce option "Redirect to the cart page after successful addition" is checked ajax link won't work
         * If Wocommerce option "Enable AJAX add to cart buttons on archives" is unchecked ajax link won't work
         * 
         * Did not used function "woocommerce_template_loop_add_to_cart" here as additional customization was needed
         */

        $button = '';
        
        // Fix for ajax button not working for variable product. Add ajax add to cart only for simple products
        $classes = 'simple' === $product->get_type()  ? $classes . ' ajax_add_to_cart' : $classes;

        // Output add to cart or if not avaliable select options or view product
        $button = apply_filters( 'shindiri_woo_slider_add_to_cart_ajax_slide_button',
            sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s">%s</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( $product->get_id() ),
                esc_attr( $product->get_sku() ),
                1, // Quantity
                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' . ' ' . esc_attr( $classes ) : ' add_to_cart_button sh-ws-product-not-purchasable  sh-ws-product-not-in-stock' . esc_attr( $classes ),
                esc_attr( $product->get_type() ),
                empty( $link_text ) ? esc_html( $product->add_to_cart_text() ) : esc_html( $link_text )
            ),
        $product );
        
        return $button;
    }
    
    /**
     * Return add to cart and view slide buttons
     *
     * @since 1.0.0
     *
     * @param object    $product   Woocommerce product object
     * @param string    $typography_slider_class   Css class passed to add syles
     * 
     * @return  string  Html for slide quick buttons. Quick view button and add to cart ajax button
     */
    public function slide_quick_buttons( $product, $typography_slider_class ) {
        
        $output = '';
        
        $output = '<div class="sh-ws-slide-add-to-cart' . esc_attr( $typography_slider_class ) . '">
                        <div class="sh-ws-slide-add-to-cart-wrapper">
                            ' . $this->ajax_add_to_cart_button( $product, 'sh-ws-hotcart-icon add-to-cart-icon', 'k' ) . '
                            <div class="sh-ws-slide-add-to-cart-ajax">' . $this->ajax_add_to_cart_button( $product ) . '</div>
                        </div>
                    </div><!-- .sh-ws-slide-add-to-cart -->
                    
                    <div class="sh-ws-slide-quick-look' . esc_attr( $typography_slider_class ) . '">
                        <div class="sh-ws-slide-quick-look-wrapper">
                            
                            ' . apply_filters( 'shindiri_wc_generate_quick_view_button', '', 'sh-ws-hotcart-icon quick-look-icon', '!', 'a' ) . '
                            <div class="sh-ws-slide-quick-look-btn-wrapper">' . apply_filters( 'shindiri_wc_generate_quick_view_button', '' ) . '</div>
                        </div>
                    </div>';
        
        return $output;
    }

    /**
     * Return sale square ribbon html
     *
     * @since 1.0.0
     * 
     * @param string    $typography_slider_class   If passes class not empty than slider has enabled typography
     * @param object    $post   Post object
     * @param object    $product   Product object
     * 
     * @return  string  Return sale square ribbon html
     */
    protected function product_sale_square_button( $typography_slider_class, $post, $product ) {

        $sale_text = esc_html__( 'Sale!', 'woo-shop-slider-lite' );
        
        $inline = array();
        
        // User selected text color
        if ( !empty( $this->sale_text_color ) ) {
            $inline[] = 'color: ' . sanitize_text_field( $this->sale_text_color ) . ' !important;';
        }
        
        // User selected background color
        if ( !empty( $this->sale_bg_color ) ) {
            $inline[] = 'background: ' . sanitize_text_field( $this->sale_bg_color ) . ' !important;';
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
            return Shindiri_Woo_Slider_Helper::validate_allowed_html( $sale_html );
        }
    }
}