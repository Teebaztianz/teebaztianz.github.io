<?php
/**
 *
 * This file contain common functions for backend fetching data, also used to fetch some data on public side
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 */


/**
 * The helper class.
 *
 * This is used to fetch various data for other classes
 * admin-facing and public-facing site hooks.
 *
 * @since      1.0.0
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 * @author     Shindiri Studio
 */
class Shindiri_Woo_Slider_Helper {

    /**
     * Hold an instance of the class
     *
     * @since    1.0.0
     * @access   private
     * @var      object    $instance    Hold and instance of the Shindiri_Woo_Slider_Helper class
     */
    private static $instance;

    /**
     * Hold an instance of the Shindiri_Woo_Slider_Shortcode_Version_Basic class
     *
     * @since    1.0.0
     * @access   private
     * @var      object    $shortcodes_basic_class    Hold and instance of the Shindiri_Woo_Slider_Shortcode_Version_Basic class which has all common default values in it
     */
    public $shortcodes_basic_class;

    /**
     * The product categories
     *
     * @since    1.0.0
     * @access   private
     * @var      object    $product_categories     Woocommerc product categories WP_Query object
     */
    public $product_categories;

    /**
     * The product categories for form select field
     *
     * @since    1.0.0
     * @access   private
     * @var      array    $product_cats_for_select    Array of current Wooocommerce cateogries as slug => name + count for select form field
     */
    public $product_cats_for_select;

    /**
     * All products from woocommerce
     *
     * @since    1.0.0
     * @access   private
     * @var      object    $all_products     Woocommerc all products WP_Query object
     */
    public $all_products;

    /**
     * All woocommerce products for form select field
     *
     * @since    1.0.0
     * @access   private
     * @var      array    $all_products_for_select    Array of current Wooocommerce products as id => name for select form field
     */
    public $all_products_for_select;

    /**
     * Class construct
     *
     * @since    1.0.0
     */
    public function __construct() {
        $this->load_data();
    }

    /**
     *  The singleton method for helper class
     *
     * @since    1.0.0
     *
     * @access   public
     * @return  object  Return static var that hold an instance of the Shindiri_Woo_Slider_Helper class
     */
    public static function init() {

        if ( !isset( self::$instance ) ) {
            self::$instance = new Shindiri_Woo_Slider_Helper();
        }

        return self::$instance;
    }

    /**
     * Load data into helper vars
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_data() {
        $this->product_categories = $this->fetch_products_categories();
        $this->product_cats_for_select = $this->get_products_cats_for_select();
        $this->all_products = $this->fetch_all_products();
        $this->all_products_for_select = $this->get_all_products_for_select();
        $this->shortcodes_basic_class = new Shindiri_Woo_Slider_Shortcode_Version_Basic();
    }

    /**
     * Return all Woocommerce products WP_Query object
     *
     * @since   1.0.0
     *
     * @access  private
     * @return  object  Return all products WP_Query object
     */
    private function fetch_all_products() {

        $args = array (
            'post_type' => 'product',
            'orderby'      => 'name',
            'order'        => 'ASC',
            'post_status' => 'publish',
            'posts_per_page' => '-1',
            'ignore_sticky_posts' => true,
            'no_found_rows' => 1,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false
        );

        // Add visible products in catalog only and stock meta query
        $args['meta_query'][] = WC()->query->get_meta_query();

        $all_products = new WP_Query( $args );

        if ( is_wp_error( $all_products ) ) {
            $all_products = false;
        }

        return $all_products;
    }

    /**
     * Return all products categories from current site
     *
     * @since   1.0.0
     *
     * @access  private
     * @return  array  Returns an array of term objects or false
     */
    private function fetch_products_categories() {

        $taxonomies = array (
            'product_cat',
        );

        $args = array (
            'orderby'      => 'name',
            'order'        => 'ASC',
            'hide_empty'   => true,
            'number'       => '',
        );

        $categories = get_terms( $taxonomies, $args );

        if ( is_wp_error( $categories ) ) {
            $categories = false;
        }

        return $categories;
    }

    /**
     * Return all products categories from current site
     *
     * @since   1.0.0
     *
     * @access  public
     * @return  array  Returns an array of term objects or false
     */
    public static function return_products_categories() {

        $taxonomies = array (
            'product_cat',
        );

        $args = array (
            'orderby'      => 'name',
            'order'        => 'ASC',
            'hide_empty'   => true,
            'number'       => '',
        );

        $categories = get_terms( $taxonomies, $args );

        if ( is_wp_error( $categories ) ) {
            $categories = false;
        }

        return $categories;
    }

    /**
     * Return all products categories from current site as slug => name + count for select form field
     *
     * @since    1.0.0
     *
     * @access  private
     * @return  array   Return array of Woocommerc product categories
     */
    private function get_products_cats_for_select() {

        $array = array();

        $categories = $this->fetch_products_categories();

        if ( ! empty( $categories ) ) {
            foreach ( $categories as $category ) {
                $array[] = array( 'value'=> $category->slug, 'title' => esc_html__( $category->name ) . ' (' . $category->count . ')' );
            }
        }

        return $array;
    }

    /**
     * Return all products from current site as id => name for select form field
     *
     * @since    1.0.0
     *
     * @access  private
     * @return  array   Return array of Woocommerc products for select form field
     */
    private function get_all_products_for_select() {

        $array = array();

        $products = $this->all_products;

        if ( ! empty( $products ) ) {

            if ( $products->have_posts() ) : while ( $products->have_posts() ) : $products->the_post();

                $array[] = array( 'value'=> absint( get_the_ID() ), 'title' => esc_html__( get_the_title() ) );

            endwhile;
                wp_reset_postdata();
            endif;
        }

        return $array;
    }

    /**
     * Return all sliders (plugin custom post type)
     *
     * @param   $additional_args   Additional WP_Query arguments to merge with default ones
     * @param   $posts_per_page   Number of post to show per page
     * @param   $no_found_rows   Reduce Sql operations if no pagination needed
     * @param   $nopaging   Show all posts or use pagination
     * @param   $update_post_meta_cache   Post meta information cache
     * @param   $update_post_term_cache   Post term information cache
     *
     * @since   1.0.0
     *
     * @access  public
     * @return  object  Returns WP_Query object holding plugin custom post type published posts or false
     */
    public static function return_all_sliders( $additional_args = '', $posts_per_page = '-1', $no_found_rows = false, $nopaging = false, $update_post_meta_cache = true, $update_post_term_cache = true ) {

        $args = array(
            'post_type' => Shindiri_Woo_Slider_Admin::$plugin_post_type,
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'ignore_sticky_posts' => true,
            'no_found_rows' => $no_found_rows,
            'nopaging' => $nopaging, // Use only if posts per page is not -1
            'update_post_meta_cache' => $update_post_meta_cache,
            'update_post_term_cache' => $update_post_term_cache
        );

        if ( !empty( $additional_args ) ) {
            $args = array_merge_recursive( $args, $additional_args );
        }

        $the_query = new WP_Query( $args );

        if ( is_wp_error( $the_query ) ) {
            $the_query = false;
        }

        return $the_query;
    }

    /**
     * Return all sliders (plugin custom post type)
     *
     * @since   1.0.0
     *
     * @access  public
     * @return  array  Returns array( 'slider_id' => 'slider_name' ) of all existing published sliders
     */
    public static function return_all_sliders_array() {

        $array = array();

        $all_sliders = Shindiri_Woo_Slider_Helper::return_all_sliders( '', -1, true, true, false, false );

        if ( ! empty( $all_sliders ) && ! is_wp_error( $all_sliders ) ) {

            if ( $all_sliders->have_posts() ) : while ( $all_sliders->have_posts() ) : $all_sliders->the_post();

                $array[ esc_attr( get_the_ID() ) ] = self::validate_allowed_html( get_the_title() );

            endwhile;
                wp_reset_postdata();
            endif;
        }

        return $array;

    }

    /**
     * Retrieve post meta field from main metabox for a desired post.
     *
     * @since 1.0.0
     *
     * @param int    $post_id   Post ID.
     *
     * @access   public
     * @return  array or false if no such metakey
     */
    public static function get_meta_values( $post_id ) {
        $values = get_post_meta( $post_id, Shindiri_Woo_Slider::METABOX_KEY, true );
        return !empty( $values ) ? $values : FALSE;
    }

    /**
     * Retrieve desired plugin template file and apply filter
     *
     * @since     1.0.0
     * @param     string    $path   The path to tempalte file, without plugin_dir_path
     * @param     string    $plugin_dir_path    Plugin dir path with trailing slash at the end, if not supplied plugin root directory will be used
     * @param     undefined    $data     Some additional data passed, default NULL
     * @param     string    $file_extension     Targeted file extension, default php
     * @return    boolean   true or false
     */
    public static function locate_template( $path, $plugin_dir_path = '', $data = NULL, $file_extension = 'php' ) {

        // Build templte path
        if ( empty( $plugin_dir_path ) ) {
            $plugin_dir_path = plugin_dir_path( dirname( __FILE__ ) );
        }

        $template_path = $plugin_dir_path . $path . '.' . $file_extension;

        // Allow templates to be filtered
        $template_path = apply_filters( 'shindiri_woo_slider_locate_template', $template_path, $path, $plugin_dir_path );

        // Include template
        if ( file_exists( $template_path ) ) {
            include $template_path;
            return true;
        } else {
            return false;
        }
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
            'src' => true,
            'width' => true,
            'height' => true,
            'align' => true,
            'class' => true,
            'name' => true,
            'id' => true,
            'frameborder' => true,
            'seamless' => true,
            'srcdoc' => true,
            'sandbox' => true,
            'allowfullscreen' => true
        );

        $allowed_tags['embed'] = array(
            'src' => true,
            'width' => true,
            'height' => true,
            'align' => true,
            'class' => true,
            'name' => true,
            'id' => true,
            'frameborder' => true,
            'seamless' => true,
            'srcdoc' => true,
            'sandbox' => true,
            'allowfullscreen' => true
        );

        // Sanitize output
        $html = wp_kses( $html, $allowed_tags );

        return $html;
    }

    /**
     * List available image sizes with width and height following, or return one image size
     *
     * @since 1.0.0
     *
     * @param   sting    $size   Which image size to get.
     *
     * @access  public
     * @return  Array
     */
    public static function get_all_image_sizes( $size = '' ) {

        global $_wp_additional_image_sizes;

        $sizes = array();
        $get_intermediate_image_sizes = get_intermediate_image_sizes();

        // Create the full array with sizes and crop info
        foreach( $get_intermediate_image_sizes as $_size ) {

            if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

                $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
                $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
                $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

            } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                $sizes[ $_size ] = array(
                    'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                    'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                    'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
                );

            }

        }

        // Get only 1 size if found
        if ( $size ) {

            if( isset( $sizes[ $size ] ) ) {
                return $sizes[ $size ];
            } else {
                return false;
            }

        }

        return $sizes;
    }

    /**
     * Print slider error html with message on public side
     *
     * @since 1.0.0
     *
     * @param   sting    $error   Error description
     *
     * @access  public
     * @return  string
     */
    public static function slider_public_error( $error ) {
        return '<div class="shindiri-woo-slider-error">' . self::validate_allowed_html( $error ) . '</div>';
    }

    /**
     * Print slider error html with message:
     * No product categories found. Please change slider setting
     *
     * @since 1.2.3
     *
     * @param   sting    $error   Error description
     *
     * @access  public
     * @return  string
     */
    public static function slider_public_error_no_categories() {
        return '<div class="shindiri-woo-slider-error">' . esc_html__( 'No product categories found. Please change slider settings', 'shindiri-woo-slider' ) . '</div>';
    }

    /**
     * Print slider error html with message:
     * No results for current setting found. Please change slider settings
     *
     * @since 1.2.3
     *
     * @param   sting    $error   Error description
     *
     * @access  public
     * @return  string
     */
    public static function slider_public_error_no_results() {
        return '<div class="shindiri-woo-slider-error">' . esc_html__( 'No results for current setting found. Please change slider settings', 'shindiri-woo-slider' ) . '</div>';
    }

    /**
     * Print slider error html with message:
     * Something wrong happened. Please review and update slider settings. Click update button again.
     *
     * @since 1.2.3
     *
     * @param   sting    $error   Error description
     *
     * @access  public
     * @return  string
     */
    public static function slider_public_error_resave() {
        return '<div class="shindiri-woo-slider-error">' . esc_html__( 'Something wrong happened. Please review and update slider settings. Please click update button again.', 'shindiri-woo-slider' ) . '</div>';
    }

    /**
     * Return default slider button text for featured product or anything else product related
     *
     * @since    1.0.0
     *
     * @return  string  Return default slider button text
     */
    public static function get_default_button_text() {
        return esc_html__( 'VIEW PRODUCT', 'shindiri-woo-slider' );
    }

    /**
     * Return default slider button text for button linking to some category
     *
     * @since    1.0.0
     *
     * @return  string  Return default slider button text for category display
     */
    public static function get_default_category_button_text() {
        return esc_html__( 'VIEW COLLECTION', 'shindiri-woo-slider' );
    }

    /**
     * Return view more default slider button text
     *
     * @since    1.0.0
     *
     * @return  string  Return view more default slider button text
     */
    public static function get_view_more_button_text() {
        return esc_html__( 'VIEW MORE', 'shindiri-woo-slider' );
    }
}