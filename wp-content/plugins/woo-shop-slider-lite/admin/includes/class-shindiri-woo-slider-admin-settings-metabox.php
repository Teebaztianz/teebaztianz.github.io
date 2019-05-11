<?php
/**
 *
 * This file is used to create metabox with slider settings on post edit screen
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 */


/**
 * The main metabox class.
 *
 * This is used to add main settings metabox for custom post type
 * admin-facing site hooks.
 *
 * @since      1.0.0
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 * @author     Shindiri Studio
 */
class Shindiri_Woo_Slider_Main_Metabox {
    
    /**
    * Define metakey and nounce fields values
    *
    * @since    1.0.0
    */
    const META_VALUE_KEY = Shindiri_Woo_Slider::METABOX_KEY;
    const NOUNCE_ACTION = 'shindiri_woo_slider_main_metabox_nounce_action';
    const NOUNCE_NAME_FIELD = '_shindiri_woo_slider_main_metabox_nounce';

    /**
    * All form fields names used in this metabox. Make validation and sve much easier
    *
    * @since    1.0.0
    * @access   private
    * @var     array    $form_fields    Store all form fields names. Array ( 'field_description' => array( 'name' => 'input_name', 'slider' => slider_number, 'type' => 'input_type' ) )
    */
    private $form_fields = array();
    
    /**
    * All slider version tabs 
    *
    * @since    1.0.0
    * @access   public
    * @var      array    $slider_versions    Array of slider versions as metabox tabs
    */
    public static $slider_versions = array();
    
    /**
    * General plugin helper class
    *
    * @since    1.0.0
    * @access   private
    * @var      Shindiri_Woo_Slider_Helper    $helper    General helper class defined in Shindiri_Woo_Slider/admin/includes
    */
    private $helper;
    
    /**
    * Plugin metabox fields generator class
    *
    * @since    1.0.0
    * @access   private
    * @var      Shindiri_Woo_Slider_Metabox_Fields_Generator    $field_generator    Metabox field generator class defined in Shindiri_Woo_Slider/admin/includes
    */
    private $field_generator;
    
    /**
    * Plugin metabox hide field css class if category selected
    *
    * @since    1.0.0
    * @access   private
    * @var      string    $hide_prod_field_css_class    Used on field if needs to hide when category selected
    */
    private $hide_prod_field_css_class = 'sh-ws-hide-product-field';
    
    /**
    * Plugin metabox hide field css class if product selected
    *
    * @since    1.0.0
    * @access   private
    * @var      string    $hide_prod_field_css_class    Used on field if needs to hide if product selected
    */
    private $hide_cat_field_css_class = 'sh-ws-hide-cat-field';
    
    /**
    * Plugin metabox hide field css class used on server side by php
    *
    * @since    1.0.0
    * @access   private
    * @var      string    $hide_field_php_css_class    Used on field if needs to hide if php return some value
    */
    private $hide_field_php_css_class = 'sh-ws-php-hide-field';

    /**
	 * Hook into the appropriate actions when the class is constructed
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
       
        // Run only on our custom pages screens
        if ( is_admin() && get_current_screen()->id === Shindiri_Woo_Slider::PLUGIN_NAME ) {
            $this->add_metabox_field_generator_class();
            $this->run();
        }
	}
    
    /**
	 * Add helper class which generate metabox common fields
	 *
	 * @since    1.0.0
	 */
    public function add_metabox_field_generator_class() {
        require_once plugin_dir_path( __FILE__ ) . '/class-shindiri-woo-slider-admin-metabox-field-generator.php';
    }
    
    /**
	 * Add all class actions only for custom post type
	 *
	 * @since    1.0.0
	 */
    private function run() {
        
        // Load array of slider versions as metabox tabs for render function
        add_action( 'add_meta_boxes', array( $this, 'load_metabox_tab_content_versions' ), 10 );
        
        // Load tab content fields values for render function and array of slider versions as metabox tabs
        add_action( 'add_meta_boxes', array( $this, 'load_metabox_tab_content_fields' ), 10 );
        add_action( 'save_post', array( $this, 'load_metabox_tab_content_fields' ), 10 );
        
        // Call metabox
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );

        // Init main plugin helper class
        $this->helper = Shindiri_Woo_Slider_Helper::init();
        
        // Init metabox field generator class
        $this->field_generator = new Shindiri_Woo_Slider_Metabox_Fields_Generator();
        
    }
    
    /**
     * Return version sliders tab configuration, array of slider versions, for shortcode main class
	 *
	 * @since    1.0.0
     * @return array    array of slider versions
	 */
    public static function get_metabox_tab_content_versions() {
        if ( empty( self::$slider_versions ) ) {
            self::$slider_versions = require dirname( dirname( __FILE__ ) ) . '/partials/main-metabox-tab-content-assign-slider-versions.php';
            self::$slider_versions = apply_filters( 'shindiri_woo_slider_main_metabox_slider_versions', self::$slider_versions );
        }
        
        return self::$slider_versions;
    }
    
    /**
     * Adds version sliders tab configuration, array of slider versions as metabox tabs
	 *
	 * @since    1.0.0
	 */
    public function load_metabox_tab_content_versions() {
        self::$slider_versions = require dirname( dirname( __FILE__ ) ) . '/partials/main-metabox-tab-content-assign-slider-versions.php';
        self::$slider_versions = apply_filters( 'shindiri_woo_slider_main_metabox_slider_versions', self::$slider_versions );
    }
    
    /**
	 * Add tab content fields definitions which will be used for field generator and savign metabox values
	 *
	 * @since    1.0.0
	 */
    public function load_metabox_tab_content_fields() {
        $this->form_fields = require dirname( dirname( __FILE__ ) ) . '/partials/main-metabox-tab-content-assign-fields.php';
        //$this->form_fields = apply_filters( 'shindiri_woo_slider_main_metabox_fields', $this->form_fields );
    }

    /**
	 * Adds the meta box container
	 *
	 * @since    1.0.0
     * 
     * @param   string  $post_type  Post type to filter adding metabox container
	 */
	public function add_meta_box( $post_type ) {
        $post_types = array( Shindiri_Woo_Slider_Admin::$plugin_post_type );     //limit meta box to certain post types
        if ( in_array( $post_type, $post_types )) {
            add_meta_box(
                'shindiri_woo_slider_meta_box' //HTML 'id' attribute of the edit screen section
                ,sprintf( esc_html__( '%s settings', 'woo-shop-slider-lite' ), Shindiri_Woo_Slider::get_plugin_public_name() ) //Title of the edit screen section, visible to user 
                ,array( $this, 'render_meta_box_content' ) //Function that prints out the HTML for the edit screen section.
                ,$post_type //The type of Write screen on which to show the edit screen section ('post', 'page', 'dashboard', 'link', 'attachment' or 'custom_post_type' where custom_post_type is the custom post type slug) 
                ,'normal' //The part of the page where the edit screen section should be shown ('normal', 'advanced', or 'side'). (Note that 'side' doesn't exist before 2.7) 
                ,'high' //The priority within the context where the boxes should show ('high', 'core', 'default' or 'low') 
            );
        }
	}     

	/**
	 * Save the meta when the post is saved.
     * 
     * @since    1.0.0
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {
	
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */
                
		// Check if our nonce is set.
		if ( ! isset( $_POST[self::NOUNCE_NAME_FIELD] ) )
			return $post_id;

		$nonce = $_POST[self::NOUNCE_NAME_FIELD];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, self::NOUNCE_ACTION ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
        // so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */
       
		// Sanitize all user inputs.
        $data = array();

        foreach ( $this->form_fields as $field => $field_data ) {
            
            // Sanitize different types of fields
            if ( $field_data['type'] === 'text' 
                    || $field_data['type'] === 'checkbox' 
                    || $field_data['type'] === 'select' 
                    || $field_data['type'] === 'radio' 
                ) {
                
                $data[$field_data['slider']][$field_data['name']] = isset( $_POST[$field_data['slider'] . $field_data['name']] ) ? sanitize_text_field( $_POST[$field_data['slider'] . $field_data['name']] ) : '';
                
            } elseif( $field_data['type'] === 'textarea' ) {
                
                $data[$field_data['slider']][$field_data['name']] = isset( $_POST[$field_data['slider'] . $field_data['name']] ) ? wp_kses_post( $_POST[$field_data['slider'] . $field_data['name']] ) : '';
                
            } elseif ( $field_data['type'] === 'range' ) {
                
                // Range and all other types
                $data[$field_data['slider']][$field_data['name']] = isset( $_POST[$field_data['slider'] . $field_data['name']] ) ? absint( $_POST[$field_data['slider'] . $field_data['name']] ) : '';
            
            } elseif ( $field_data['type'] === 'multiselect' ) {

                // Sanitize multiselect array
                if ( isset( $_POST[$field_data['slider'] . $field_data['name']] ) ) {
                    
                    $multiselect = $_POST[$field_data['slider'] . $field_data['name']];
                    $multiselect = array_map( array( $this, 'sanitize_array' ), $multiselect );
                    $data[$field_data['slider']][$field_data['name']] = $multiselect;
                    
                } else {
                    $data[$field_data['slider']][$field_data['name']] = array();
                }
                
            }
        }

		// Update the meta field.
		update_post_meta( $post_id, self::META_VALUE_KEY, $data );
	}
    
    /**
	 * Sanitize array of multiselect values
     * 
     * @since    1.0.0
	 *
	 * @param string $value Value from array_map to sanitize
	 */
    private function sanitize_array( $value ) {
        return sanitize_text_field( $value );
    }
    
    /**
     * Return css classes to hide or not metabox field, use only on fields you need to hide or hide after in javascript when show product or categories
     *
     * @since 1.0.0
     *
     * @param   any    $value   Value of the field
     * @param   any    $compare   Value to compare and select which css classes to return
     * 
     * @access  public
     * @return  string  Css class or empty string if passed $value is empty
     */
    public function check_css_field_visibility( $value, $compare ) {
        
        $hide_filed_class = $this->hide_prod_field_css_class;
        
        // If check done for selected category than set class for cats
        if ( $compare === 'products' ) {
            $hide_filed_class = $this->hide_cat_field_css_class;
        }
        
        if ( !empty( $value )  ) {
            return $value === $compare ? ' class="' . $hide_filed_class . ' ' . $this->hide_field_php_css_class . '"' : ' class="' . $hide_filed_class . '"';
        } else {
            return '';
        }
    }
    
    /**
     * Return css classes to hide or not metabox field, use only on fields you need to hide or hide after in javascript when typography disabled or not
     *
     * @since 1.1.0
     *
     * @param   any    $value   Value of the field
     * 
     * @access  public
     * @return  string  Css class or empty string if passed $value = 'enabled'
     */
    public function check_css_typography_field_visibility( $value ) {
        return $value === 'enabled' ? '' : ' ' . $this->hide_field_php_css_class;
    }

	/**
	 * Render Meta Box content.
     * 
     * @since    1.0.0
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( self::NOUNCE_ACTION, self::NOUNCE_NAME_FIELD );

		// Get values
		$values = get_post_meta( $post->ID, self::META_VALUE_KEY, true );
        
        // Prepare categories and products for all sliders
        $wc_categories_for_select = $this->helper->product_cats_for_select;
        $wc_products_for_select = $this->helper->all_products_for_select;
        
        // Get common values for all sliders used on frontend in shortcodes
        $shortcodes_common_values = $this->helper->shortcodes_basic_class;

        // Get which slider version tab is active
        $field_all_versions = $this->form_fields['slider_version_active'];
        $slider_version_active = isset( $values[0][$field_all_versions['name']] ) && !empty( $values[0][$field_all_versions['name']] ) ? sanitize_text_field( $values[0][$field_all_versions['name']] ) : 'version-7';
        
        
		/* Display the form, using the current value. */
        ?>
        <div class="sh-ws-metabox-content">
            <?php 
            
            /*
             * Added for Lite version to print all premium tabs with images
             */
            ?>
            <div class="sh-ws-metabox-banner">
                <a target="_blank" href="http://codecanyon.net/item/woo-shop-slider-woocommerce-slider-for-products-single-product-and-categories/14840747?ref=shindiristudio">
                    <img src="<?php echo Shindiri_Woo_Slider::root_url_or_dir( 'url' ) . 'admin/images/full-version.jpg'; ?>" style="max-width: 100%; height: auto;"/>
                </a>
            </div>

            <div class="sh-ws-tab-activator">
                <?php 
                // Print tab selector radio buttons
                if ( is_array( self::$slider_versions ) && !empty( self::$slider_versions ) ) {
                    foreach ( self::$slider_versions as $one_slider_version ) {
                        if ( !empty( $one_slider_version ) ) {
                        $tab_active = $slider_version_active === $one_slider_version['id'] ? ' active' : '';
                        $tab_img = isset( $one_slider_version['image'] ) && !empty( $one_slider_version['image'] ) ? '<img src="' . esc_url( $one_slider_version['image'] ) . '" />' : '';
                        ?>
                        <div class="sh-ws-tab-radio<?php echo esc_attr( $tab_active ); ?>" data-tab="sh-ws-tab-<?php echo esc_attr( $one_slider_version['id'] ); ?>">
                            <label for="sh-ws-<?php echo esc_attr( $one_slider_version['id'] ); ?>"><?php echo Shindiri_Woo_Slider_Helper::validate_allowed_html( $one_slider_version['name'] ); ?></label>
                            <input id="sh-ws-<?php echo esc_attr( $one_slider_version['id'] ); ?>" type="<?php echo esc_attr( $field_all_versions['type'] ); ?>" name="<?php echo $field_all_versions['slider'] . $field_all_versions['name']; ?>" value="<?php echo esc_attr( $one_slider_version['id'] ) ?>" <?php checked( $slider_version_active, $one_slider_version['id'] ); ?>/>
                            <div class="sh-ws-tab-radio-img"><?php echo $tab_img; ?></div>
                        </div><!-- .sh-ws-tab-radio -->
                        <?php
                        }
                    }
                }
                
                /*
                 * Added for Lite version to print all premium tabs with images
                 */
                $premium_tabs_imag = array(  
                    1 => array( 
                        'name' => sprintf( esc_html__( 'Casual %s', 'woo-shop-slider-lite' ), '<span>' . esc_html__( 'Slider', 'woo-shop-slider-lite' ) . '</span>' ), // Name for the radio button in metabox
                        'image' => Shindiri_Woo_Slider::root_url_or_dir( 'url' ) . 'admin/images/admin-preview/premium-version-1.jpg'
                    ),
                    2 => array( 
                        'name' => sprintf( esc_html__( 'Card %s', 'woo-shop-slider-lite' ), '<span>' . esc_html__( 'Slider', 'woo-shop-slider-lite' ) . '</span>' ),
                        'image' => Shindiri_Woo_Slider::root_url_or_dir( 'url' ) . 'admin/images/admin-preview/premium-version-2.jpg'
                    ),
                    3 => array( 
                        'name' => sprintf( esc_html__( 'Velocity %s', 'woo-shop-slider-lite' ), '<span>' . esc_html__( 'Slider', 'woo-shop-slider-lite' ) . '</span>' ),
                        'image' => Shindiri_Woo_Slider::root_url_or_dir( 'url' ) . 'admin/images/admin-preview/premium-version-3.jpg'
                    ),
                    4 => array( 
                        'name' => sprintf( esc_html__( 'Polar %s', 'woo-shop-slider-lite' ), '<span>' . esc_html__( 'Slider', 'woo-shop-slider-lite' ) . '</span>' ),
                        'image' => Shindiri_Woo_Slider::root_url_or_dir( 'url' ) . 'admin/images/admin-preview/premium-version-4.jpg'
                    ),
                    5 => array( 
                        'name' => sprintf( esc_html__( 'Kanji %s', 'woo-shop-slider-lite' ), '<span>' . esc_html__( 'Slider', 'woo-shop-slider-lite' ) . '</span>' ),
                        'image' => Shindiri_Woo_Slider::root_url_or_dir( 'url' ) . 'admin/images/admin-preview/premium-version-5.jpg'
                    ),
                    6 => array( 
                        'name' => sprintf( esc_html__( 'Suburb %s', 'woo-shop-slider-lite' ), '<span>' . esc_html__( 'Slider', 'woo-shop-slider-lite' ) . '</span>' ),
                        'image' => Shindiri_Woo_Slider::root_url_or_dir( 'url' ) . 'admin/images/admin-preview/premium-version-6.jpg'
                    ),
                    8 => array( 
                        'name' => sprintf( esc_html__( 'Roll %s', 'woo-shop-slider-lite' ), '<span>' . esc_html__( 'Slider', 'woo-shop-slider-lite' ) . '</span>' ),
                        'image' => Shindiri_Woo_Slider::root_url_or_dir( 'url' ) . 'admin/images/admin-preview/premium-version-8.jpg'
                    ),
                );
                
                foreach ( $premium_tabs_imag as $premium_tab ) {
                    ?>
                    <div class="sh-ws-tab-radio">
                        <label><?php echo $premium_tab['name'] ?></label>
                        <div class="sh-ws-tab-radio-img">
                            <a target="_blank" href="http://codecanyon.net/item/woo-shop-slider-woocommerce-slider-for-products-single-product-and-categories/14840747?ref=shindiristudio">
                                <img src="<?php echo $premium_tab['image']; ?>" />
                            </a>
                        </div>
                    </div><!-- .sh-ws-tab-radio -->
                    <?php
                }
                ?>

            </div>

            <div class="sh-ws-tabs"> 
                <?php 
                // Print every version tab content
                if ( is_array( self::$slider_versions ) && !empty( self::$slider_versions ) ) {
                    foreach ( self::$slider_versions as $one_slider_content ) {
                        if ( !empty( $one_slider_content ) ) {
                        ?>
                        <div class="sh-ws-tab-content sh-ws-tab-<?php echo esc_attr( $one_slider_content['id'] ); ?><?php echo $slider_version_active === $one_slider_content['id'] ? ' active' : ''; ?>">
                    
                            <?php 
                            // Get admin template
                            if ( isset( $one_slider_content['admin_tab'] ) && file_exists( $one_slider_content['admin_tab'] ) ) {
                                include_once $one_slider_content['admin_tab'];
                            }
                            ?>

                        </div><!-- .sh-ws-tab -->
                        <?php
                        }
                    }
                }
                ?>
            </div><!-- .sh-ws-tabs -->
        
        </div><!-- .sh-ws-metabox-content -->
        <?php
	}

}
?>