<?php
/**
 * Class that will return all WooCommerce product data and act as bridge 
 * for easier update due to the WooCommerce API change
 * 
 * @since 1.2.0
 */
class Shindiri_Woo_Slider_WC_Product_Data {
    
    /**
     * Check if woocommerce version is at least 3.0.0 and return deprecated
     * or new product class
     * 
     * @since 1.2.0
     * @param int $product_id
     * @return Shindiri_Woo_Slider_WC_Product_Deprecated | Shindiri_Woo_Slider_WC_Product
     */
    public static function get_product( $product_id ) {
        
        if ( ! ( version_compare( WC()->version, '3.0.0' ) >= 0 ) ) {
            return new Shindiri_Woo_Slider_WC_Product_Deprecated( $product_id );
        }
        
        return new Shindiri_Woo_Slider_WC_Product( $product_id );
    }

}