<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Use this template only inside the loop
 */

global $post;

// Get user selected values for slider common settings
$common_settings = Shindiri_Woo_Slider_Common_settings_Metabox::get_common_settings();

// Selected accentcolor from metabox settings
$quick_view_color_style = isset( $common_settings['quick_view_color'] ) && !empty( $common_settings['quick_view_color'] ) ? ' style="background: ' . sanitize_text_field( $common_settings['quick_view_color'] ) . ' !important;"' : '';
// Hover data color
$data_color = !empty( $quick_view_color_style ) ? ' data-color="' . esc_js( $common_settings['quick_view_color'] ) . '"' : '';
// Disable or enable plugin quick view typography
$quick_view_typography = isset( $common_settings['quick_view_typography'] ) && $common_settings['quick_view_typography'] === 'disabled' ? '' : ' sh-pqv-typography';
// Sale ribbon settings
$qv_sale_text_color = isset( $common_settings['qv_sale_text_color'] ) && !empty( $common_settings['qv_sale_text_color'] ) ? $common_settings['qv_sale_text_color'] : '';
$qv_sale_bg_color = isset( $common_settings['qv_sale_bg_color'] ) && !empty( $common_settings['qv_sale_bg_color'] ) ? $common_settings['qv_sale_bg_color'] : '';

// Bridge class to get all WooCommerce product data
$sh_ws_product = Shindiri_Woo_Slider_WC_Product_Data::get_product( get_the_ID() );
?>
<div class="shindiri-product-quick-view<?php echo esc_attr( $quick_view_typography ); ?>">

	<div class="sh-pqv-product">
        
		<div class="sh-pqv-quick-view-images">

            <div class="sh-pqv-quick-view-container sh_ws-swiper-container"<?php echo $data_color; ?>>
                <div class="sh_ws-swiper-wrapper">
                    <?php 
                    // Featured image added to swiper slider
                    // Get all image sizes and check if large image has default value
                    $large_wp_default_img_size = Shindiri_Woo_Slider_Helper::get_all_image_sizes( 'large' );
                    $thumbnail_size = isset( $large_wp_default_img_size['width'] ) && $large_wp_default_img_size['width'] == '1024' ? 'large' : 'full';
                    $thumbnail = has_post_thumbnail() ? wp_get_attachment_image_src( $sh_ws_product->get_featured_image_id(), $thumbnail_size ) : false;
                    $thumbnail_url = isset( $thumbnail[0] ) ? $thumbnail[0] : wc_placeholder_img_src();
                    ?>
                    <div class="sh_ws-swiper-slide quick-slide" <?php echo 'style="background-image: url(\'' . esc_url( $thumbnail_url ) . '\')"'; ?>></div>
                    <?php 
                    
                    // Gallery images
                    $quick_view_gallery_ids = $sh_ws_product->get_gallery_image_ids();

                    if ( is_array( $quick_view_gallery_ids ) && !empty( $quick_view_gallery_ids ) ) {

                        foreach ( $quick_view_gallery_ids as $imgId ) {

                            $gallery_thumbnail = wp_get_attachment_image_src( $imgId, 'shop_single' );
                            $gallery_thumbnail_url = isset( $gallery_thumbnail[0] ) ? $gallery_thumbnail[0] : '';

                            if ( empty( $gallery_thumbnail_url ) ) {
                                continue;
                            }

                            echo '<div class="sh_ws-swiper-slide" style="background-image: url(\'' . esc_url( $gallery_thumbnail_url ) . '\')"></div>';
                        }
                    }

                    ?>

                </div>

                <!-- Add Arrows -->
                <div class="sh-pqv-button-next"><div class="sh-ws-arrow-wrapper"><div class="sh-ws-line"></div><div class="sh-ws-arrow"></div></div></div>
                <div class="sh-pqv-button-prev"><div class="sh-ws-arrow-wrapper"><div class="sh-ws-line"></div><div class="sh-ws-arrow"></div></div></div>

                <div class="shindiri-woo-product-sale">
                    <?php
                    /*
                     * Get on salce badge if product on sale
                     */
                    echo Shindiri_Woocommerce_Quick_Look::product_sale_square_button( 
                            $quick_view_typography, 
                            $post, 
                            $sh_ws_product, 
                            $qv_sale_text_color, 
                            $qv_sale_bg_color 
                        );
                    ?>
                </div>

            </div><!-- .sh_ws-swiper-wrapper -->

		</div><!-- .sh-pqv-quick-view-images -->

		<div class="sh-pqv-content">
            <div class="sh-pqv-title">
                <a href="<?php echo esc_url( $sh_ws_product->get_permalink() ); ?>">
                <?php 
                    $title = esc_html( Shindiri_Woocommerce_Quick_Look::trim_excerpt( $sh_ws_product->get_name(), 11 ) ); 
                    echo Shindiri_Woocommerce_Quick_Look::validate_allowed_html( $title );
                ?>
                </a>
            </div>
            
            <div class="sh-pqv-separator"<?php echo $quick_view_color_style; ?>></div>
            
            <div class="sh-pqv-description">
                <?php 
                    $excerpt_length = apply_filters('shindiri_woocommerce_quick_look_excerpt_length', 40);
                    $excerpt = Shindiri_Woocommerce_Quick_Look::trim_excerpt( $sh_ws_product->get_short_description(), $excerpt_length ); 
                    echo Shindiri_Woocommerce_Quick_Look::validate_allowed_html( $excerpt );
                ?>
            </div>
            
            <div class="sh-pqv-price">
                
                <?php 
                // Price for simple product
                if ( 'simple' === $sh_ws_product->get_type() ) : ?>
                <span class="sh-pqv-price-label"><?php esc_html_e('Price', 'woo-shop-slider-lite' ); ?></span>
                <div><?php echo $sh_ws_product->get_price_html(); ?></div>
                
                <?php 
                // Price for variable product
                elseif ( 'variable' === $sh_ws_product->get_type() ): ?>
                <span class="sh-pqv-price-label"><?php esc_html_e('Price from', 'woo-shop-slider-lite' ); ?></span>
                <div><?php echo wc_price( $sh_ws_product->get_variation_price( 'min' ) ); ?></div>
                
                <?php 
                // Price for other product types
                else : ?>
                <span class="sh-pqv-price-label"><?php esc_html_e('Price from', 'woo-shop-slider-lite' ); ?></span>
                <div><?php echo wc_price( $sh_ws_product->get_price() ); ?></div>
                <?php endif; ?>
                
            </div>
            
            <?php 
            // Build input and add to cart form and check if ajax enabled
            $ajax_add_to_cart_enabled = 'yes' === get_option( 'woocommerce_enable_ajax_add_to_cart', 'no' ) ? TRUE : FALSE;
            
            $add_to_cart_form = '<form class="cart sh-pqv-add-to-cart-form sh_ws_clearfix" method="post" enctype="multipart/form-data">';
                    
            if ( ! $sh_ws_product->is_sold_individually() ) {
	 			$add_to_cart_form .= woocommerce_quantity_input( 
                    array(
                        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $sh_ws_product ),
                        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $sh_ws_product->backorders_allowed() ? '' : $sh_ws_product->get_stock_quantity(), $sh_ws_product ),
                        'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
                    ),
                    $sh_ws_product,
                    false
                );
	 		}
            
            // Add hidden input if ajax add to cart off 
            if ( ! $ajax_add_to_cart_enabled ) {
                $add_to_cart_form .= '<input type="hidden" name="add-to-cart" value="' . esc_attr( $sh_ws_product->get_id() ) . '" />';
            }
             
            // Get add to cart button from Wocommerce template or if ajax add to cart off get regular button
            if ( ! $ajax_add_to_cart_enabled ) {
                $add_to_cart_form .= '<button type="submit" class="single_add_to_cart_button add_to_cart_button button">' . esc_html( $sh_ws_product->single_add_to_cart_text() ) . '</button>';
            } else {
                
                /*
                 * Hardcoded add to cart function from woocommerce 2.5 as needed to function normal
                 * 
                 * Some themes may have outdated templates so add to cart will not work properly. So we can not use default woocommerce function
                 * Woocommerce from 2.5 add ajax_add_to_cart for ajax call, while versions before use add_to_cart_button for ajax request
                 */
                // Output add to cart or if not avaliable select options or view product
                $add_to_cart_form .= apply_filters( 'shindiri_woocommerce_quick_view_add_to_cart_button',
                    sprintf( '<a %s href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="sh-pqv-add-to-cart-button single_add_to_cart_button button %s product_type_%s">%s</a>',
                        $ajax_add_to_cart_enabled === FALSE ? 'type="submit"' : 'type="link"',
                        esc_url( $sh_ws_product->add_to_cart_url() ),
                        esc_attr( $sh_ws_product->get_id() ),
                        esc_attr( $sh_ws_product->get_sku() ),
                        esc_attr( isset( $quantity ) ? $quantity : 1 ),
                        $sh_ws_product->is_purchasable() && $sh_ws_product->is_in_stock() ? 'add_to_cart_button ajax_add_to_cart' : '',
                        esc_attr( $sh_ws_product->get_type() ),
                        esc_html( $sh_ws_product->add_to_cart_text() )
                    ),
                $sh_ws_product );
            }
            $add_to_cart_form .= '</form>';     
            ?>
            
            <?php 
            // Only 
            if ( 'simple' === $sh_ws_product->get_type() && $sh_ws_product->is_in_stock() ) : ?>
			<div class="sh-pqv-quantity"><?php esc_html_e('Quantity', 'woo-shop-slider-lite' ); echo $add_to_cart_form; ?></div>
            <?php else : ?>
            <div class="sh-pqv-quantity sh-ws-other-products">
                <div class="cart sh_ws_clearfix">
                    <a
                        class="single_add_to_cart_button button" 
                        href="<?php echo esc_url( $sh_ws_product->get_permalink() ) ?>" 
                        alt=""
                        <?php echo $quick_view_color_style; ?>><?php esc_html_e( $sh_ws_product->add_to_cart_text() ); ?>
                    </a>
                </div>
            </div>
            <?php endif; ?>
		</div><!-- .sh-pqv-content -->
	</div>
</div>