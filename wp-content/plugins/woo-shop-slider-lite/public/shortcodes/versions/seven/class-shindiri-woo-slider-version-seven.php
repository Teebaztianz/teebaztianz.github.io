<?php
/**
 * Fired when shortcode slider version is used on frontend
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/public/shortcodes/versions/seven
 */
class Shindiri_Woo_Slider_Shortcode_Version_Seven extends Shindiri_Woo_Slider_Shortcode_Version_Basic {

    /**
     * Slider lazy loading
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $lazy_load    Enabled or disabled lazy loading
     */
    public $lazy_load;

    /**
     * Overlay color for slider
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $overlay_color_style    Overlay color for slider - hex
     */
    public $overlay_color_style;

    /**
     * Overlay color for content
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $content_overlay    Overlay color for content - rgba
     */
    public $content_overlay;

    /**
     * Custom text for link button
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $custom_link_text    Custom text for link button
     */
    public $custom_link_text;

    /**
     * Holds a class to style slider if showing products or categories
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $show_what    Holds a class to style slider if showing products or categories
     */
    public $show_what_class;

    /**
     * Css class that if enabled set slider plugin styles
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $typography_slider_class    Css class that if enabled set slider plugin styles
     */
    public $typography_slider_class;

    /**
     * Button type css class
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $button_type    Button type css class
     */
    public $button_type;

    /**
     * Return shortcode html
     *
     * @since 1.0.0
     *
     * @param int    $post_id   Post ID.
     * @param array    $meta_values   Meta values from custom post type.
     *
     * @access   public
     * @return  string  Shortcode html output
     */
    public function slider_shortcode( $post_id, $meta_values ) {

        /*
         * Get metadata array key for this slider version only and check if set. 
         * For this version slider key is 7
         */
        if ( isset( $meta_values[7] ) ) {
            $meta_values = $meta_values[7];
        } else {
            return esc_html__( 'Something went wrong. Please check slider version metadata settings.', 'shindiri-woo-slider' );
        }

        /*  Params check */

        /*
         * Please note, all fallbacks for vars here are just a simple reassurance and will almost never be used as slider will not pass empty meta values.
         * Only in case someone mess up with main metabox files, these fallbacks will prevent fatals errors
         */

        $add_css_classes = array();

        // Custom css class
        $add_css_classes[] = Shindiri_Woo_Slider_Custom_Css_Metabox::generate_slider_custom_css_class( $post_id );

        // Get user choice what to display
        $show_what = isset( $meta_values['show_what'] ) && !empty( $meta_values['show_what'] ) ? sanitize_text_field( $meta_values['show_what'] ) : 'categories';
        $this->show_what_class = $show_what;

        // Get custom texta and set fallback in case of error. Default use user entered text
        $this->custom_link_text = isset( $meta_values['custom_link_text'] ) && !empty( $meta_values['custom_link_text'] ) ? $meta_values['custom_link_text'] : '';

        // Check if user chose to use our typography, or if var not defined use our
        $this->typography_slider_class = isset( $meta_values['disable_typography'] ) && $meta_values['disable_typography'] === 'disabled' ? '' : self::$typography_css_class;
        $add_css_classes[] = !empty( $this->typography_slider_class ) ? $this->typography_slider_class : '';
        // Slider height
        $slider_height = isset( $meta_values['slider_height'] ) && !empty( $meta_values['slider_height'] ) ? 'height: ' . absint( $meta_values['slider_height'] ) . 'px;' : '';
        // Override if full screen selected
        $slider_attributes = array();
        $slider_attributes[] = isset( $meta_values['full_screen'] ) && $meta_values['full_screen'] === 'yes' ? ' height: 100vh;' : $slider_height;

        $posts_per_page = isset( $meta_values['slider_limit'] ) && !empty( $meta_values['slider_limit'] ) ? absint( $meta_values['slider_limit'] ) : 20;

        self::$placeholder = isset( $meta_values['custom_placeholder'] ) && !empty( $meta_values['custom_placeholder'] ) ? wp_get_attachment_url( $meta_values['custom_placeholder'] ) : self::$placeholder;

        // All selected categories
        $cats_slugs = isset( $meta_values['cat_multiselect'] ) && !empty( $meta_values['cat_multiselect'] ) ? array_map( __CLASS__ . '::sanitize_array', $meta_values['cat_multiselect'] ) : '';

        // Get user choice how to sort products
        $products_sorting = isset( $meta_values['products_sorting'] ) && !empty( $meta_values['products_sorting'] ) ? sanitize_text_field( $meta_values['products_sorting'] ) : 'recent';

        // Theme color
        $theme_color = isset( $meta_values['theme_color'] ) && !empty( $meta_values['theme_color'] ) ? $meta_values['theme_color'] : 'light';
        $add_css_classes[] = !empty( $theme_color ) && $theme_color === 'light' ? 'sh-ws-light-theme' : 'sh-ws-dark-theme';

        // Overlay on - off and color picker - hex color
        $this->overlay_color_style = isset( $meta_values['overlay_color'] ) && !empty( $meta_values['overlay_color'] ) ? ' style="background-color: ' . sanitize_text_field( $meta_values['overlay_color'] ) . ';"' : '';

        // Overlay on - off for content color overlay - rgba color
        $this->content_overlay_style = isset( $meta_values['content_overlay'] ) && !empty( $meta_values['content_overlay'] ) ? ' style="background-color: ' . sanitize_text_field( $this->hextorgb( $meta_values['content_overlay'], 0.9 ) ) . ';"' : '';

        // Slider transition
        $slider_transition = isset( $meta_values['slider_transition'] ) && !empty( $meta_values['slider_transition'] ) ? $meta_values['slider_transition'] : $this->default_slider_transition;

        // Lazy loading
        $this->lazy_load = isset( $meta_values['lazy_load'] ) && !empty( $meta_values['lazy_load'] ) && $meta_values['lazy_load'] === 'yes' ? true : false;

        // Add all css classes to shortcode wrapper
        $add_css_classes[] = $this->lazy_load ? self::$lazy_load_active_css_class : self::$lazy_load_inactive_css_class;

        // Autoplay params
        $autoplay = isset( $meta_values['autoplay'] ) && !empty( $meta_values['autoplay'] ) ? $meta_values['autoplay'] : '';
        $autoplay_timeout = isset( $meta_values['autoplay_timeout'] ) && !empty( $meta_values['autoplay_timeout'] ) ? absint( $meta_values['autoplay_timeout'] ) : 5000;

        // Set 0 for autoplay if disabled
        switch ( $autoplay ) {
            case 'on':
                // Do not override value
                break;

            case 'mobile':
                // Only on mobile
                $autoplay_timeout = wp_is_mobile() ? $autoplay_timeout : 0;
                break;

            default:
                $autoplay_timeout = 0;
                break;
        }

        // Sale colors
        // Text color
        $this->sale_text_color = isset( $meta_values['sale_text_color'] ) && !empty( $meta_values['sale_text_color'] ) ? sanitize_text_field( $meta_values['sale_text_color'] ) : '';

        // Background color
        $this->sale_bg_color = isset( $meta_values['sale_bg_color'] ) && !empty( $meta_values['sale_bg_color'] ) ? sanitize_text_field( $meta_values['sale_bg_color'] ) : '';

        // Button type
        $this->button_type = isset( $meta_values['button_type'] ) && !empty( $meta_values['button_type'] ) ? $meta_values['button_type'] : 'sh-ws-button-outlined';


        /* Queriess */

        $slides = '';

        if ( $show_what === 'products' ) {

            /* User selected to show products */

            $the_query = $this->get_shortcode_products_query( $posts_per_page, $cats_slugs, '', $products_sorting );

            // If no result for query return error
            if ( is_wp_error( $the_query ) || empty( $the_query->posts ) ) {
                return Shindiri_Woo_Slider_Helper::slider_public_error_no_results();
            }

            $slides = $this->get_product_slides( $the_query );

        } else {

            /* User selected to show categories */

            // If no category selected fetch all woocommerce categories
            if ( !is_array( $cats_slugs ) && empty( $cats_slugs ) ) {

                $wc_all_cats = Shindiri_Woo_Slider_Helper::return_products_categories();

                if ( !empty( $wc_all_cats ) && is_array( $wc_all_cats ) ) {
                    foreach ( $wc_all_cats as $wc_cat ) {
                        $cats_slugs[] = sanitize_text_field( $wc_cat->slug );
                    }
                } else {
                    // If no categories found throw error
                    return Shindiri_Woo_Slider_Helper::slider_public_error_no_categories();
                }
            }

            if ( !empty( $cats_slugs ) ) {
                // Get swiper slider slides
                $slides = $this->get_categories_slides( $cats_slugs );
            }

        }


        /* Html output */

        // Get all additional classes
        $css_classes = implode( ' ', $add_css_classes );

        // Unique id for shortcode and swiper init
        $slider_unique_selector = uniqid('sh_woo_slider_');
        $output = '';
        $slider = '';

        /* Build style for shortcode background image and height */
        $slider_inline_style =  !empty( $slider_attributes ) ? ' style="' . implode( '', $slider_attributes ) . '"' : '';


        /* Slider html */
        $slider = '<!-- Swiper --> 
                    <div class="sh_ws-swiper-container shindiri-woo-slider-slider ' . $slider_unique_selector . '" 
                        data-selector="' . esc_attr( $slider_unique_selector ) . '" 
                        data-lazy-load="' . esc_attr( $this->lazy_load ) . '" 
                        data-autoplay="' . esc_attr( $autoplay_timeout ) . '" 
                        data-transition="' . esc_attr( $slider_transition ) . '"
                        ' . $slider_inline_style . '>

                        <!-- Slides-->
                        <div class="sh_ws-swiper-wrapper">';

        $slider .= $slides;

        $slider .= '</div> 
                    
                        <div class="shindiri-woo-slider-button-next">
                            <div class="sh-ws-arrow-overlay"' . $this->overlay_color_style . '></div>
                            <div class="sh-ws-arrow-wrapper">
                                <div class="sh-ws-arrow">
                                    <div class="sh-ws-arrow-relative">
                                        <div class="sh-ws-line"></div>
                                        <div class="sh-ws-div-arrow"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shindiri-woo-slider-button-prev">
                            <div class="sh-ws-arrow-overlay"' . $this->overlay_color_style . '></div>
                            <div class="sh-ws-arrow-wrapper">
                                <div class="sh-ws-arrow">
                                    <div class="sh-ws-arrow-relative">
                                        <div class="sh-ws-line"></div>
                                        <div class="sh-ws-div-arrow"></div> 
                                    </div>
                                </div>
                            </div>
                        </div> 
                            
                    </div>
                    <!-- Swiper JS -->';


        /* Whole shortcode output */

        $output .= '<div class="shindiri-woo-slider-shortcode-version-seven">';

        $output     .= '<div class="shindiri-woo-slider-shortcode-wrapper ' . esc_attr( $css_classes ) . '">
         
                            <div class="shindiri-woo-slider-wrapper">' . $slider . '</div>';

        $output     .= '</div><!-- .shindiri-woo-slider-shortcode-wrapper -->';

        $output .= '</div><!-- .shindiri-woo-slider-shortcode-version-two -->';

        // Add script
        wp_enqueue_script( Shindiri_Woo_Slider::PLUGIN_NAME . '-version-seven', plugin_dir_url( __FILE__ ) . 'assets/shindiri-woo-slider-public.min.js', array( Shindiri_Woo_Slider::PLUGIN_NAME . '-easing' ), false, true );
        wp_localize_script( Shindiri_Woo_Slider::PLUGIN_NAME . '-version-seven', 'shindiri_woo_slider_7_data', array( 'is_mobile' => wp_is_mobile() ) );

        return $output;
    }

    /**
     * Slides html for swiper slider from selected categories
     *
     * @since 1.0.0
     *
     * @param array    $cats_slugs   Array of user selected categories
     *
     * @access   private
     * @return  string  Slides html for swiper slider from selected categories
     */
    private function get_categories_slides( $cats_slugs ) {

        $slides = '';

        if ( !empty( $cats_slugs ) ) {

            foreach ( $cats_slugs as $cat ) {

                $cat = get_term_by( 'slug', $cat, 'product_cat' );

                if ( !is_wp_error( $cat ) && !empty( $cat ) ) {

                    $cat_thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
                    $cat_image_url = wp_get_attachment_image_src( $cat_thumbnail_id, 'full' );
                    $cat_image_url = isset( $cat_image_url[0] ) ? $cat_image_url[0] : self::$placeholder;

                    $category_desc = !empty( $cat->description ) ? esc_html( $cat->description ) : '';

                    $slides .= $this->get_slide_template(
                        $category_desc,
                        get_term_link( $cat->slug, 'product_cat' ),
                        $cat_image_url,
                        '',
                        '<span>' . $cat->name . '</span>'
                    );

                }

            }

        }

        return $slides;

    }

    /**
     * Return slides for shortocodes
     *
     * @since 1.0.0
     *
     * @param object    $the_query   Query object for WordPress loop to generate slides
     *
     * @access   private
     * @return  string  Slides html for swiper slider
     */
    private function get_product_slides( $the_query ) {

        $slides = '';

        if ( $the_query->have_posts() ) :

            while ( $the_query->have_posts() ) : $the_query->the_post();

                $product_id = get_the_ID();
                // Bridge class to get all WooCommerce product data
                $sh_ws_product = Shindiri_Woo_Slider_WC_Product_Data::get_product( $product_id );

                $post = get_post( $product_id );
                $sale_html = '';

                // Use placeholder if no post thumbnail
                $thumbnail = has_post_thumbnail() ? wp_get_attachment_image_src( $sh_ws_product->get_featured_image_id(), 'full' ) : false;
                $thumbnail_url = isset( $thumbnail[0] ) ? $thumbnail[0] : self::$placeholder;

                // Get all product categories
                $product_cats = $sh_ws_product->get_category_list( ', ', '<span>', '</span>' );

                // Other data
                $permalink = $sh_ws_product->get_permalink();
                $title = $sh_ws_product->get_name();
                $price_html = $sh_ws_product->slider_price_html();

                // Get on sale badge if product on sale
                if ( $sh_ws_product->is_on_sale() ) :
                    $sale_html = $this->product_sale_square_button( $this->typography_slider_class, $post, $sh_ws_product );
                endif;

                // Add quick view button
                $quick_view_button = apply_filters( 'shindiri_wc_generate_quick_view_button', '' );

                // Get swiper slides
                $slides .= $this->get_slide_template(
                    $title,
                    $permalink,
                    $thumbnail_url,
                    $price_html,
                    $product_cats,
                    $sale_html,
                    $quick_view_button
                );

            endwhile;
            wp_reset_postdata();

        endif;

        return $slides;
    }

    /**
     * Swiper slide template for category or product
     *
     * @since 1.0.0
     *
     * @param string    $title   Product or category title
     * @param string    $permalink   Link for the title
     * @param string    $thumbnail_url   Url for the product or category thumbnail
     * @param string    $price_html     Price html
     * @param string    $product_cats     Product categories
     * @param string    $sale_html     Product sale ribbon htl
     * @param string    $quick_view_button     Quick view button html
     *
     * @access   private
     * @return  string  Swiper slide template for category or product
     */
    private function get_slide_template( $title, $permalink, $thumbnail_url, $price_html = '', $product_cats = '', $sale_html = '', $quick_view_button = '' ) {

        $slide = '';

        $background_image_style = $this->lazy_load ? ' data-background="' . esc_url( $thumbnail_url ) . '"' : ' style="background-image: url(\'' . esc_url( $thumbnail_url ) . '\')"';

        // Get swiper slide
        $slide = '<div class="sh_ws-swiper-slide shindiri-woo-slider-slide">
                    
                    <div class="shindiri-woo-slider-slide-wrapper swiper-lazy" ' . $background_image_style . '>
                        <div class="sh-ws-slide-overlay"' . $this->overlay_color_style . '></div>';

        $slide      .= '<div class="sh-ws-swiper-lazy-preloader">' . Shindiri_Woo_Slider_Helper::validate_allowed_html( self::$loader_html ) . '</div>';

        // Sale html
        if ( !empty( $sale_html ) ) {
            $slide              .= '<div class="shindiri-woo-slide-sale">
                                    ' . $sale_html . '
                                </div>';
        }

        $slide      .= '<div class="shindiri-woo-slide-details"' . $this->content_overlay_style . '>
                            <div class="' . esc_attr( $this->button_type ) . ' sh-ws-slide-details-inner ' . esc_attr( $this->show_what_class ) . '">';

        // Product categories
        if ( !empty( $product_cats ) ) {
            $slide              .= '<div class="shindiri-woo-slide-categories">
                                    ' . Shindiri_Woo_Slider_Helper::validate_allowed_html( $product_cats ) . '
                                </div>';
        }

        $slide              .= '<a class="shindiri-woo-slide-title" href="' . esc_url( $permalink ) . '">' . esc_html( $title ) . '</a>';

        // Price html
        if ( !empty( $price_html ) ) {
            $slide              .= '<div class="shindiri-woo-slide-price">
                                    ' . Shindiri_Woo_Slider_Helper::validate_allowed_html( $price_html ) . '
                                </div>';
        }

        $slide              .= '<button type="button" class="shindiri-woo-slide-button button" onclick="window.location=\'' . esc_url( $permalink ) . '\';">
                            ' . esc_html( $this->custom_link_text ) . '</button>'
            . $quick_view_button;

        $slide          .= '</div><!-- .sh-ws-slide-details-inner -->
                        </div><!-- .shindiri-woo-slide-details -->

                    </div>
                </div>';

        return $slide;
    }

}