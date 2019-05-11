<?php
/**
 * WooCommerce Compatibility File
 * See: https://wordpress.org/plugins/woocommerce/
 *
 * @package Catch Store 1.0
 */

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'catch_store_is_woocommerce_activated' ) ) {
	function catch_store_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

if ( ! function_exists( 'catch_store_header_mini_cart_refresh_number' ) ) {
	/**
	 * Update Header Cart items number on add to cart
	 */
	function catch_store_header_mini_cart_refresh_number( $fragments ){
	    ob_start();
	    ?>
	    <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'catch-store' ), WC()->cart->get_cart_contents_count() ) );?></span>
	    <?php
	        $fragments['.count'] = ob_get_clean();
	    return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'catch_store_header_mini_cart_refresh_number' );

if ( ! function_exists( 'catch_store_header_mini_cart_refresh_amount' ) ) {
	/**
	 * Update Header Cart amount on add to cart
	 */
	function catch_store_header_mini_cart_refresh_amount( $fragments ){
	    ob_start();
	    ?>
	    <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span>
	    <?php
	        $fragments['.amount'] = ob_get_clean();
	    return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'catch_store_header_mini_cart_refresh_amount' );