<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version
 * Admin-specific functions
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin
 * @author     Shindiri Studio
 */
class Shindiri_Woo_Slider_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
    
    /**
	 * The submenu page attached to custom post type which display plugin info
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $plugin_submenu_page_slug    The current version of this plugin.
	 */
	public static $plugin_submenu_page_slug;
    
    /**
	 * The custom post type
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $plugin_post_type    The current version of this plugin.
	 */
	public static $plugin_post_type;
    
    /**
	 * Plugin admin page icon
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $plugin_admin_page_icon    Plugin admin page icon
	 */
	public static $plugin_admin_page_icon = 'dashicons-images-alt2';
    
    /**
	 * Plugin admin page position
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $plugin_admin_page_position    Plugin admin page position
	 */
	public static $plugin_admin_page_position = 70;
    
    /**
	 * Plugin admin menu info page and submenu info page title - meta title tag
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_info_page_title    Plugin admin menu info page and submenu info page title
	 */
	protected $plugin_info_page_title;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->plugin_info_page_title = esc_html_x( 'Woo Shop Slider plugin info', 'Admin page and submenu page title', 'woo-shop-slider-lite' );
		self::$plugin_post_type = $plugin_name;
		self::$plugin_submenu_page_slug = $plugin_name . '-info';

	}
    
    /**
	 * Add all metaboxes
	 *
	 * @since    1.0.0
	 */
    public function add_metaboxes_class() {
        // Main metabox
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/includes/class-shindiri-woo-slider-admin-settings-metabox.php';
        // Custom css
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/includes/class-shindiri-woo-slider-admin-custom-css-metabox.php';
        // Common settings
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/includes/class-shindiri-woo-slider-admin-common-settings-metabox.php';
    }
    
    /**
	 * Calls the metaboxes classes on the post edit screen
	 *
	 * @since    1.0.0
	 */
    public function init_metaboxes() {
        new Shindiri_Woo_Slider_Main_Metabox();
        new Shindiri_Woo_Slider_Custom_Css_Metabox();
        new Shindiri_Woo_Slider_Common_settings_Metabox();
    }
    
    /**
	 * Add helper class but not init class
	 *
	 * @since    1.0.0
	 */
    public function add_helper_class() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/includes/class-shindiri-woo-slider-admin-helper.php';
    }
    
    /**
	 * Add visual composer shortcode to grid builder
	 *
	 * @since    1.0.0
	 */
    public function add_visual_composer_shortcode() {
        include_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/includes/class-shindiri-woo-slider-admin-vc-shortcode.php';
    }
    
    /**
	 * Calls the tinymce classe on the post or page edit screen
	 *
	 * @since    1.0.0
	 */
    public function init_tinymce_plugin() {
        
        if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
            return;
         }
        
        if ( is_admin() && ( get_current_screen()->id === 'page' || get_current_screen()->id === 'post' ) ) {
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/includes/class-shindiri-woo-slider-admin-tinymce-plugin.php';
            new Shindiri_Woo_Slider_Tinymce_Plugin();
        }
    }

	/**
	 * Stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {

        // Load on all our pages
        wp_enqueue_style( $this->plugin_name . '-info', plugin_dir_url( __FILE__ ) . 'css/shindiri-woo-slider-admin-info.css', array(), $this->version, 'all' );
        
        // Load only on edit custom post type screen
        if ( is_admin() && get_current_screen()->id === Shindiri_Woo_Slider::PLUGIN_NAME ) {
            wp_enqueue_style( $this->plugin_name . '-rangeslider', plugin_dir_url( __FILE__ ) . 'css/rangeslider.css', array(), '2.0.4', 'all' );
            wp_enqueue_style( $this->plugin_name . '-tree-multiselect', plugin_dir_url( __FILE__ ) . 'css/jquery.tree-multiselect.min.css', array( $this->plugin_name . '-rangeslider' ), '1.15.0', 'all' );
            wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/shindiri-woo-slider-admin.css', array( $this->plugin_name . '-tree-multiselect' ), $this->version, 'all' );
            
            // Color picker metabox field
            wp_enqueue_style( 'wp-color-picker' );
            
            // Media uploader
            wp_enqueue_media();
        }
	}

	/**
	 * JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {

        // Load only on edit custom post type screen
        if ( is_admin() && self::$plugin_post_type == get_post_type() && ( 'post.php' === $hook || 'post-new.php' === $hook ) ) {
            wp_enqueue_script( $this->plugin_name . '-rangeslider', plugin_dir_url( __FILE__ ) . 'js/rangeslider.min.js', array( 'jquery' ), '2.0.4', true );
            wp_enqueue_script( $this->plugin_name . '-tree-multiselect', plugin_dir_url( __FILE__ ) . 'js/jquery.tree-multiselect.min.js', array( $this->plugin_name . '-rangeslider' ), '1.15.0', true );
            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/shindiri-woo-slider-admin.min.js', array( $this->plugin_name . '-tree-multiselect' ), $this->version, true );
            
            // Color picker metabox field
            wp_enqueue_script( 'wp-color-picker' );
            
            // Media uploader
            wp_enqueue_media();
            
            // Ace editor
            wp_enqueue_script( $this->plugin_name . '-ace-editor', plugin_dir_url( __FILE__ ) . 'js/ace-editor/src-noconflict/ace.js', array( 'jquery' ), '1.2.2', true );
            wp_enqueue_script( $this->plugin_name . '-ace-ext-language_tools', plugin_dir_url( __FILE__ ) . 'js/ace-editor/src-noconflict/ext-language_tools.js', array( $this->plugin_name . '-ace-editor' ), '1.2.2', true );
        }
        
        // Load only on edit custom post type screen
        if ( is_admin() && ( 'post.php' === $hook || 'post-new.php' === $hook ) ) {
            // Tinymce editor plugin js
            wp_enqueue_script( $this->plugin_name . '-tinymce-plugin', plugin_dir_url( __FILE__ ) . 'js/tinymce-plugin.js', array( 'jquery' ), '1.0.0', true );
            wp_localize_script( $this->plugin_name . '-tinymce-plugin', 'sh_ws_slider_shortcode_dynamic_tag', Shindiri_Woo_Slider_Shortcodes::slider_shortcode_dynamic_tag() );
        }

	}

    /**
	 * Registers a Custom Post Type called as plugin_name
	 *
	 * @since    1.0.0
	 */
    public function register_custom_post_type() {
        
        $plugin_public_name = Shindiri_Woo_Slider::get_plugin_public_name();

        register_post_type( self::$plugin_post_type, array(
            'labels' => array(
                'name'               => $plugin_public_name,
                'singular_name'      => $plugin_public_name,
                'menu_name'          => $plugin_public_name,
                'name_admin_bar'     => $plugin_public_name,
                'add_new'            => esc_html_x( 'Add New', 'slider', 'woo-shop-slider-lite' ),
                'add_new_item'       => sprintf( esc_html__( 'Add New %s', 'woo-shop-slider-lite' ), $plugin_public_name ),
                'new_item'           => sprintf( esc_html__( 'New %s', 'woo-shop-slider-lite' ), $plugin_public_name ),
                'edit_item'          => sprintf( esc_html__( 'Edit %s', 'woo-shop-slider-lite' ), $plugin_public_name ),
                'view_item'          => sprintf( esc_html__( 'View %s', 'woo-shop-slider-lite' ), $plugin_public_name ),
                'all_items'          => esc_html__( 'All sliders', 'woo-shop-slider-lite' ),
                'search_items'       => sprintf( esc_html__( 'Search %s', 'woo-shop-slider-lite' ), $plugin_public_name ),
                'parent_item_colon'  => esc_html__( 'Parent:', 'woo-shop-slider-lite' ),
                'not_found'          => sprintf( esc_html__( 'No %s found', 'woo-shop-slider-lite' ), $plugin_public_name ),
                'not_found_in_trash' => sprintf( esc_html__( 'No %s found in trash', 'woo-shop-slider-lite' ), $plugin_public_name ),
            ),

            // Frontend
            'has_archive'        => false,
            'public'             => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'show_in_nav_menus' => false,
            'show_ui' => true,

            // Admin
            'capability_type' => 'post',
            'menu_icon'     => self::$plugin_admin_page_icon,
            'menu_position' => self::$plugin_admin_page_position,
            'query_var'     => true,
            'show_in_menu'  => true,
            'show_in_admin_bar' => false,
            'supports'      => array(
                'title'
            ),
        ) );   
    }
    
    /**
	 * Add admin menu pages
	 *
	 * @since    1.0.0
	 */
    public function add_admin_pages() {
   
        // Custom post type submenu page
        add_submenu_page(
            'edit.php?post_type=' . self::$plugin_post_type, // The slug name for the parent menu
            $this->plugin_info_page_title,  // Page title
            'Plugin info', // Menu title
            'manage_options', // Capability
            self::$plugin_submenu_page_slug, // The slug name to refer to this menu
            array( $this, 'admin_main_panel_info_display' ) // he function to be called to output the content 
        );
    }
    
    /**
	 * Woo Shop Slider main page display
	 *
	 * @since    1.0.0
	 */
    public function admin_main_panel_info_display() {
        // Get admin template
        Shindiri_Woo_Slider_Helper::locate_template( 'partials/admin-display', plugin_dir_path( __FILE__ ) );
    }
    
    /**
	 * Change footer text for our post type pages and plugin info page
	 *
	 * @since    1.0.0
	 */
    public function change_footer_admin_text( $html ) {
        
        $new_html = '<p>' . esc_html__( 'Thank you for choosing Woo Shop Slider', 'woo-shop-slider-lite' ) . '</p>';
        $new_html .= '<p>' . esc_html__( 'Marjan. T. CEO at Shindiri Studio', 'woo-shop-slider-lite' ) . '</p>';
        
        // Woocommerce on or off
        if ( get_current_screen() ) {
            if ( ( self::$plugin_post_type . '_page_shindiri-woo-slider-info' ) === get_current_screen()->id 
                    || 'toplevel_page_shindiri-woo-slider-info' === get_current_screen()->id 
                ) 
            {
                 return $new_html;
            }
        }

        return $html;
    }
    
    /**
	 * Change publish post button for custom post type
	 *
	 * @since    1.0.0
	 */
    public function change_publish_button_text( $translation, $text ) {
        if ( is_admin() && self::$plugin_post_type == get_post_type() && ( $text == 'Publish' || $text == 'Update' ) ) {
            return __( 'Save changes', 'woo-shop-slider-lite' );
        } else {
            return $translation;
        }
    }
    
    /**
	 * Add custom column to custom post type all posts admin screen
	 *
	 * @since    1.0.0
     * 
     * @param   array   $defaults   All posts admin screen columns
	 */
    public function posts_columns( $defaults ) {
        $defaults['shindiri_woo_slider_shortcode'] = esc_html__( 'Shortcode', 'woo-shop-slider-lite' );
        return $defaults;
    }
    
    /**
	 * Add custom column content to custom post type all posts admin screen. Adds shortcode tag
	 *
	 * @since    1.0.0
     * 
     * @param   string   $column_name   Column name
     * @param   int   $id   Post id
	 */
    function posts_custom_columns( $column_name, $id ) {
        if( $column_name === 'shindiri_woo_slider_shortcode' ) {
            echo Shindiri_Woo_Slider_Shortcodes::slider_shortcode_tag( $id );
        }
    }
    
    /**
	 * Add custom column style to custom post type all posts admin screen
	 *
	 * @since    1.0.0
	 */
    function admin_custom_column_style() {
		if ( get_current_screen() ) {
			if ( get_current_screen()->id === 'edit-' . $this->plugin_name && get_post_type() === self::$plugin_post_type ) {
				echo '<style type="text/css">
					.column-shindiri_woo_slider_shortcode { width:20% !important; }
				</style>';
			}
		}
    }
    
    /**
	 * Load enviroment without installed woocommerce
	 *
	 * @since    1.0.0
	 */
	public function no_woocommerce_activated() {
        
		// Add error notice
        add_action( 'admin_notices', array( $this, 'woocommerce_not_active_notice' ) );
        
        // Require helper class
        $this->add_helper_class();
        
        // Add plugin menu info page instead submenu page for custom post type
        add_menu_page( 
            $this->plugin_info_page_title, 
            esc_html_x( 'Woo Shop Slider', 'post type and plugin public name', 'woo-shop-slider-lite' ),  
            'manage_options', 
            self::$plugin_submenu_page_slug, 
            array( $this, 'admin_main_panel_info_display' ), 
            self::$plugin_admin_page_icon, 
            self::$plugin_admin_page_position 
        );
	}
    
    /**
	 * Add admin notice to install Woocommerce if not active or installed
	 *
	 * @since     1.0.0
	 */
    public function woocommerce_not_active_notice() {
        $txt = wp_kses_post( sprintf( __( 'The %s plugin requires WooCommerce. Please install or activate %s plugin.', 'woo-shop-slider-lite' ), '<strong>' . esc_html( Shindiri_Woo_Slider::get_plugin_public_name() ) . '</strong>', '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">'. esc_html__( 'WooCommerce', 'woo-shop-slider-lite' ) . '</a>' ) );
        ?>
        <div class="error">
            <p><?php echo $txt; ?></p>
        </div>
        <?php
    }
    
}
?>