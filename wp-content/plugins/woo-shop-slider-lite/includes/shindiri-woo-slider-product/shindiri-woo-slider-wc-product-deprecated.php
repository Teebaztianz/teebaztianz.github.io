<?php

/**
 * Class that will return all WooCommerce product data for version below, not including, 3.0.0
 * 
 * @since 1.2.0
 */
class Shindiri_Woo_Slider_WC_Product_Deprecated extends Shindiri_Woo_Slider_Abstract_Product {
    
    /**
     * Return Product id
     * 
     * @since 1.2.0
     * @return int
     */
    public function get_id() {
        return get_the_ID();
    }
    
    /**
     * Return Product Title (name)
     * 
     * @since 1.2.0
     * @return string
     */
    public function get_name() {
        return get_the_title();
    }
    
    /**
     * Return Product sku
     * 
     * @since 1.2.0
     * @return string
     */
    public function get_sku() {
        return $this->product->get_sku();
    }
    
    /**
     * Return Product permalink
     * 
     * @since 1.2.0
     * @return string
     */
    public function get_permalink() {
        return get_the_permalink();
    }
    
    /**
     * Get product type
     * 
     * @since 1.2.0
     * @return string Product type
     */
    public function get_type() {
        return $this->product->product_type;
    }
    
    /**
     * Return product featured image id
     * 
     * @since 1.2.0
     * @return int
     */
    public function get_featured_image_id() {
        return get_post_thumbnail_id( $this->product->ID );
    }
    
    /**
     * Return gallery attachments ids
     * 
     * @since 1.2.0
     * @return array Array of attachments ids
     */
    public function get_gallery_image_ids() {
        return $this->product->get_gallery_attachment_ids();
    }
    
    /**
     * Return product price html formated for this slider
     *
     * @since 1.0.0
     * @return string Formated string, price html for product
     */
    public function slider_price_html() {
        
        $price_html = '';
        
        if ( is_object( $this->product ) ) {
            $from_text = esc_html__('From', 'woo-shop-slider-lite' );

             if ( $this->product->product_type === 'simple' || $this->product->product_type === 'external' ) {
                $price_html = $this->product->get_price_html();

            } elseif ( $this->product->product_type === 'variable' ) {
                // Price for variable product
                $price_html = '<span class="sh-ws-price-from">' . esc_html( $from_text ) . '</span>'
                . '<span class="amount">' . wc_price( $this->product->get_variation_price( 'min' ) ) . '</span>';

            } else {
                // Price for other product types
                $price_html = '<span class="sh-ws-price-from">' . esc_html( $from_text ) . '</span>'
                . '<span class="amount">' . wc_price( $this->product->get_price() ) . '</span>';
            }
        }
        
        return $price_html;
    }
    
    /**
     * Returns the product categories in a list.
     *
     * @since 1.2.0
     * @param string $sep (default: ', ').
     * @param string $before (default: '').
     * @param string $after (default: '').
     * @return string
     */
    public function get_category_list( $sep = ', ', $before = '', $after = '' ) {
        return $this->product->get_categories( $sep, $before, $after );
    }
    
    /**
     * Return product short description
     * @since 1.2.0
     * @return string Product short description
     */
    public function get_short_description() {
        return get_the_excerpt( $this->get_id() );
    }
    
    /**
     * Return product add to cart url
     * 
     * @since 1.2.0
     * @return string
     */
    public function add_to_cart_url() {
        return $this->product->add_to_cart_url();
    }
    
    /**
     * Return if Product is purchasable
     * 
     * @since 1.2.0
     * @return boolean
     */
    public function is_purchasable() {
        return $this->product->is_purchasable();
    }
    
    /**
     * Return if product is in stock
     * 
     * @since 1.2.0
     * @return boolean
     */
    public function is_in_stock() {
        return $this->product->is_in_stock();
    }
    
    /**
     * Return product add to cart text for button or something else
     * 
     * @since 1.2.0
     * @return string
     */
    public function add_to_cart_text() {
        return $this->product->add_to_cart_text();
    }
    
    /**
     * Return if product is on sale
     * 
     * @since 1.2.0
     * @return boolean
     */
    public function is_on_sale() {
        return $this->product->is_on_sale();
    }
    
    /**
     * Return price formated as html
     * 
     * @since 1.2.0
     * @return string
     */
    public function get_price_html() {
        return $this->product->get_price_html();
    }
    
    /**
     * Return variation price
     * 
     * @since 1.2.0
     * @return string
     */
    public function get_variation_price( $min_or_max = 'min', $include_taxes = false ) {
        return $this->product->get_variation_price( $min_or_max, $include_taxes );
    }
    
    /**
     * Return product active price
     * 
     * @since 1.2.0
     * @return string
     */
    public function get_price( $price = '', $qty = 1 ) {
        return $this->product->get_price( $price, $qty );
    } 
    
    /**
     * Return check if product is sold individually
     * 
     * @since 1.2.0
     * @return boolean
     */
    public function is_sold_individually() {
        return $this->product->is_sold_individually();
    }
    
    /**
     * Return check if product can be backordered
     * 
     * @since 1.2.0
     * @return boolean
     */
    public function backorders_allowed() {
        return $this->product->backorders_allowed();
    }
    
    /**
     * Return number of items avaliable for sale
     * 
     * @since 1.2.0
     * @return int|null
     */
    public function get_stock_quantity() {
        return $this->product->get_stock_quantity();
    }
    
    /**
     * Return cart button text for product single page
     * 
     * @since 1.2.0
     * @return string
     */
    public function single_add_to_cart_text() {
        return $this->product->single_add_to_cart_text();
    }
}