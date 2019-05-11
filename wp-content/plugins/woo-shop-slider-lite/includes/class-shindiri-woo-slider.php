<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/includes
 */


/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/includes
 * @author     Shindiri Studio
 */
class Shindiri_Woo_Slider {
    
    /**
	 * Define metakey for Shindiri_Woo_Slider_Main_Metabox and public usage
	 *
	 * @since    1.0.0
	 */
	const METABOX_KEY = 'shindiri_woo_slider_settings';
    
    /**
	 * Define metakey for Shindiri_Woo_Slider_Main_Metabox and public usage
	 *
	 * @since    1.0.0
	 */
	const CUSTOM_CSS_METABOX_KEY = 'shindiri_woo_slider_custom_css';
    
    /**
	 * Define metakey for Shindiri_Woo_Slider_Main_Metabox and public usage
	 *
	 * @since    1.0.0
	 */
	const COMMON_SETTINGS_METABOX_KEY = 'shindiri_woo_slider_common_settings';
    
    /**
	 * Define shortcode name for admin and public usage
	 *
	 * @since    1.0.0
	 */
	const SHORTCODE_TAG = 'shindiri-woo-slider';
    
    /**
	 * The unique identifier of this plugin for public usage
	 *
	 * @since    1.0.0
	 */
	const PLUGIN_NAME = 'shindiri-woo-slider';

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Shindiri_Woo_Slider_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	public $plugin_name;
    
    /**
	 * The plugin public name.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $plugin_name    The name for plugin, not the identifier but just a name.
	 */
	public $plugin_public_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $version    The current version of the plugin.
	 */
	public $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = self::PLUGIN_NAME;
		$this->plugin_public_name = self::get_plugin_public_name();
		$this->version = '1.2.3';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}
    
    /**
	 * Return plugin official name
	 *
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public static function get_plugin_public_name() {
		return esc_html_x( 'Woo Shop Slider', 'post type and plugin public name', 'woo-shop-slider-lite' );
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Shindiri_Woo_Slider_Loader. Orchestrates the hooks of the plugin.
	 * - Sh_Woo_Slider_i18n. Defines internationalization functionality.
	 * - Shindiri_Woo_Slider_Admin. Defines all hooks for the admin area.
	 * - Shindiri_Woo_Slider_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-shindiri-woo-slider-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-shindiri-woo-slider-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-shindiri-woo-slider-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-shindiri-woo-slider-public.php';

		$this->loader = new Shindiri_Woo_Slider_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Sh_Woo_Slider_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Shindiri_Woo_Slider_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}
    
    /**
	 * Return plugin root url or dir with end trailing slash
	 *
     * @param   $var    What to return, url or dir path
	 *
	 * @since    1.0.0
	 * @access   public
     * 
     * @return  string  Url or dir path as string
	 */
	public static function root_url_or_dir( $var ) {

		// return basedir
        if ( $var === 'dir' ) {
            return plugin_dir_path( dirname( __FILE__ ) );
        }
        // return baseurl
        if ( $var === 'url' ) {
            return plugin_dir_url( dirname( __FILE__ ) );
        }

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Shindiri_Woo_Slider_Admin( $this->get_plugin_name(), $this->get_version() );

        // Register our custom post type
		$this->loader->add_action( 'init', $plugin_admin, 'register_custom_post_type' );
        
        // Adds genelar helper class
        $this->loader->add_action( 'init', $plugin_admin, 'add_helper_class' );
        
        // Add metaboxes for custom post type, but do not load them or init class
        $this->loader->add_action( 'init', $plugin_admin, 'add_metaboxes_class' );
        
        // Add visual composer shortcode to grid builder
        $this->loader->add_action( 'init', $plugin_admin, 'add_visual_composer_shortcode' );
        
        if ( is_admin() ) {
            
            // Calls the metaboxes classes on the post edit screen
            $this->loader->add_action( 'load-post.php', $plugin_admin, 'init_metaboxes' );
            $this->loader->add_action( 'load-post-new.php', $plugin_admin, 'init_metaboxes' );

            // Add custom post type submenu page
            $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_admin_pages' );
            
            // Change footer text for our post type pages and plugin info page
            $this->loader->add_action( 'admin_footer_text', $plugin_admin, 'change_footer_admin_text' );

            // Change publish post button for custom post type
            $this->loader->add_filter( 'gettext', $plugin_admin, 'change_publish_button_text', 10, 2 );
            
            // Add shortcode code to admin all posts screen for custom post type
            $this->loader->add_filter( 'manage_' . Shindiri_Woo_Slider_Admin::$plugin_post_type . '_posts_columns', $plugin_admin, 'posts_columns', 5 );
            $this->loader->add_action( 'manage_' . Shindiri_Woo_Slider_Admin::$plugin_post_type . '_posts_custom_column', $plugin_admin, 'posts_custom_columns', 5, 2 );
            $this->loader->add_action( 'admin_head', $plugin_admin, 'admin_custom_column_style' );
            
            // Calls the tinymce plugin class on the post edit screen
            $this->loader->add_action( 'load-post.php', $plugin_admin, 'init_tinymce_plugin' );
            $this->loader->add_action( 'load-post-new.php', $plugin_admin, 'init_tinymce_plugin' );
            
            // Scripts
            $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
            $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
            
        }
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Shindiri_Woo_Slider_Public( $this->get_plugin_name(), $this->get_version() );
        
        // Scripts and styles
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles_last', 1001 );
		$this->loader->add_action( 'wp_head', $plugin_public, 'enqueue_custom_css', 1003 );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
        
        // Collect all inline css and apply styles that user defined
        $this->loader->add_filter( 'shindiri_woo_slider_plugin_inline_css', $plugin_public, 'collect_inline_css', 10, 1 );
        
        // Add shortcodes for public usage
        $this->loader->add_action( 'init', $plugin_public, 'add_shortcodes' );
        
        // Add quick product view for public usage
        $this->loader->add_action( 'init', $plugin_public, 'add_product_quick_view' );
        
        // Ajax call for shortcode version one
        $this->loader->add_action( 'wp_ajax_shindiri_woo_slider_shortcode_version_one', 'Shindiri_Woo_Slider_Shortcode_Version_One', 'ajax_data' );
        $this->loader->add_action( 'wp_ajax_nopriv_shindiri_woo_slider_shortcode_version_one', 'Shindiri_Woo_Slider_Shortcode_Version_One', 'ajax_data' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Shindiri_Woo_Slider_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
?>