<?php
/**
 * Abstract class for product data used in this plugin
 */
abstract class Shindiri_Woo_Slider_Abstract_Product {
    
    /**
     * WooCommerce product object
     * 
     * @since 1.2.0
     * @var WC_Product
     */
    protected $product;
    
    /**
     * Constructor
     * 
     * @since 1.2.0
     * @param int $product_id
     */
    public function __construct( $product_id ) {
        $this->product = wc_get_product( $product_id );
    }
    
    /**
     * Return WooCommerce product object
     * @since 1.2.0
     * @return WC_Product|WC_Product_External|WC_Product_Grouped|WC_Product_Simple|WC_Product_Variable
     */
    public function get_product() {
        return $this->product;
    }
    
    /**
     * Return Product id
     * 
     * @since 1.2.0
     * @return int
     */
    abstract public function get_id();
    
    /**
     * Return Product Title (name)
     * 
     * @since 1.2.0
     * @return string
     */
    abstract public function get_name();
    
    /**
     * Return Product sku
     * 
     * @since 1.2.0
     * @return string
     */
    abstract public function get_sku();
    
    /**
     * Return Product permalink
     * 
     * @since 1.2.0
     * @return string
     */
    abstract public function get_permalink();
    
    /**
     * Return Product type
     * @since 1.2.0
     * @return string
     */
    abstract public function get_type();
    
    /**
     * Return product featured image id
     * 
     * @since 1.2.0
     * @return int
     */
    abstract public function get_featured_image_id();
    
    /**
     * Return gallery attachments ids
     * 
     * @since 1.2.0
     * @return array Array of attachments ids
     */
    abstract public function get_gallery_image_ids();

    /**
     * Return product price html formated for this slider
     *
     * @since 1.0.0
     * @return string Formated string, price html for product
     */
    abstract public function slider_price_html();
    
    /**
     * Returns the product categories in a list.
     *
     * @since 1.2.0
     * @param string $sep (default: ', ').
     * @param string $before (default: '').
     * @param string $after (default: '').
     * @return string
     */
    abstract public function get_category_list( $sep = ', ', $before = '', $after = '' );
    
    /**
     * Return product short description
     * @since 1.2.0
     * @return string Product short description
     */
    abstract public function get_short_description();
    
    /**
     * Return product add to cart url
     * 
     * @since 1.2.0
     * @return string
     */
    abstract public function add_to_cart_url();
    
    /**
     * Return if Product is purchasable
     * 
     * @since 1.2.0
     * @return boolean
     */
    abstract public function is_purchasable();
    
    /**
     * Return if product is in stock
     * 
     * @since 1.2.0
     * @return boolean
     */
    abstract public function is_in_stock();
    
    /**
     * Return product add to cart text for button or something else
     * 
     * @since 1.2.0
     * @return string
     */
    abstract public function add_to_cart_text();
    
    /**
     * Return if product is on sale
     * 
     * @since 1.2.0
     * @return boolean
     */
    abstract public function is_on_sale();
    
    /**
     * Return price formated as html
     * 
     * @since 1.2.0
     * @return string
     */
    abstract public function get_price_html();
    
    /**
     * Return variation price
     * 
     * @since 1.2.0
     * @return string
     */
    abstract public function get_variation_price( $min_or_max = 'min', $include_taxes = false );
    
    /**
     * Return product active price
     * 
     * @since 1.2.0
     * @return string
     */
    abstract public function get_price( $price = '', $qty = 1 );
    
    /**
     * Return check if product is sold individually
     * 
     * @since 1.2.0
     * @return boolean
     */
    abstract public function is_sold_individually();
    
    /**
     * Return check if product can be backordered
     * 
     * @since 1.2.0
     * @return boolean
     */
    abstract public function backorders_allowed();
    
    /**
     * Return number of items avaliable for sale
     * 
     * @since 1.2.0
     * @return int|null
     */
    abstract public function get_stock_quantity();
    
    /**
     * Return cart button text for product single page
     * 
     * @since 1.2.0
     * @return string
     */
    abstract public function single_add_to_cart_text();
    
}