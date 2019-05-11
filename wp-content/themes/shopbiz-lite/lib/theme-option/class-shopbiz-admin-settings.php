<?php
/**
 * Admin settings helper
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     shopbiz
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ){
	exit;
}
/**
 * Add admin notice when active theme, just show one time
 *
 * @return bool|null
 */
add_action( 'admin_notices', 'shopbiz_admin_notice' );
function shopbiz_admin_notice() {
  global $current_user;
  $user_id   = $current_user->ID;
  $theme_data  = wp_get_theme();
  if ( !get_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ) ) {
    ?>
    <div class="notice shopbiz-notice">

      
	  <div class="shopbiz-logo">
	  </div>
	  
	  <h1>
        <?php
        /* translators: %1$s: theme name, %2$s theme version */
        printf( esc_html__( 'Thanks For Choosing %1$s - Version %2$s', 'shopbiz' ), esc_html( $theme_data->Name ), esc_html( $theme_data->Version ) );
        ?>
      </h1>
      <p>
        <?php
        /* translators: %1$s: theme name, %2$s link */
        printf( __( 'Visit shopbiz page to take full advantage of theme.', 'shopbiz' ), esc_html( $theme_data->Name ), esc_url( admin_url( 'themes.php?page=shopbiz' ) ) );
        printf( '<a href="%1$s" class="notice-dismiss dashicons dashicons-dismiss dashicons-dismiss-icon"></a>', '?' . esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore=0' );
        ?>
      </p>
      <p>
        <a href="<?php echo esc_url( admin_url( 'themes.php?page=shopbiz' ) ) ?>" class="button button-primary button-hero" style="text-decoration: none;">
          <?php
          /* translators: %s theme name */
          printf( esc_html__( 'Get started with %s', 'shopbiz' ), esc_html( $theme_data->Name ) )
          ?>
        </a>
      </p>
    </div>
    <?php
  }
}
add_action( 'admin_init', 'shopbiz_notice_ignore' );
function shopbiz_notice_ignore() {
  global $current_user;
  $theme_data  = wp_get_theme();
  $user_id   = $current_user->ID;
  /* If user clicks to ignore the notice, add that to their user meta */
  if ( isset( $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) && '0' == $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) {
    add_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore', 'true', true );
  }
}

/*****************************************/

if ( ! class_exists( 'shopbiz_Admin_Settings' ) ){
    /**
	 * shopbiz Admin Settings
	 */
	class shopbiz_Admin_Settings{

    /**
		 * View all actions
		 *
		 * @since 1.0
		 * @var array $view_actions
		 */
		static public $view_actions = array();

		/**
		 * Menu page title
		 *
		 * @since 1.0
		 * @var array $menu_page_title
		 */
		static public $menu_page_title = 'shopbiz Theme';

		/**
		 * Page title
		 *
		 * @since 1.0
		 * @var array $page_title
		 */
		static public $page_title = 'shopbiz';

		/**
		 * Plugin slug
		 *
		 * @since 1.0
		 * @var array $plugin_slug
		 */
		static public $plugin_slug = 'shopbiz';

		/**
		 * Default Menu position
		 *
		 * @since 1.0
		 * @var array $default_menu_position
		 */
		static public $default_menu_position = 'themes.php';

		/**
		 * Parent Page Slug
		 *
		 * @since 1.0
		 * @var array $parent_page_slug
		 */
		static public $parent_page_slug = 'general';

		/**
		 * Current Slug
		 *
		 * @since 1.0
		 * @var array $current_slug
		 */
		static public $current_slug = 'general';

		/**
		 * Constructor
		 */
		function __construct() {

			if ( ! is_admin() ) {
				return;
			}

			add_action( 'after_setup_theme', __CLASS__ . '::init_admin_settings', 99 );
		}
        /**
		 * Admin settings init
		 */
		static public function init_admin_settings() {
			self::$menu_page_title = apply_filters( 'shopbiz_menu_page_title', __( 'Shopbiz Options', 'shopbiz' ) );
			self::$page_title      = apply_filters( 'shopbiz_page_title', __( 'shopbiz', 'shopbiz' ) );

			if ( isset( $_REQUEST['page'] ) && strpos( $_REQUEST['page'], self::$plugin_slug ) !== false ) {
				add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles_scripts' );
            
				// Let extensions hook into saving.
				do_action( 'shopbiz_admin_settings_scripts' );
				self::save_settings();
			}
            add_action( 'admin_enqueue_scripts', __CLASS__ . '::admin_scripts' );
			add_action( 'admin_menu', __CLASS__ . '::add_admin_menu', 99 );

			add_action( 'shopbiz_menu_general_action', __CLASS__ . '::general_page',99 );
			add_action( 'shopbiz_header_right_section', __CLASS__ . '::top_header_right_section' );
			add_filter( 'admin_title', __CLASS__ . '::shopbiz_admin_title', 10, 2 );
			add_action( 'shopbiz_welcome_page_right_sidebar_content', __CLASS__ . '::shopbiz_welcome_page_starter_sites_section', 10 );
			add_action( 'shopbiz_welcome_page_right_sidebar_content', __CLASS__ . '::shopbiz_welcome_page_knowledge_base_scetion', 11 );
			add_action( 'coshopbiz_welcome_page_right_sidebar_content', __CLASS__ . '::shopbiz_welcome_page_five_star_scetion', 12 );
			add_action( 'shopbiz_welcome_page_content', __CLASS__ . '::shopbiz_welcome_page_content' );
			// AJAX.
			add_action( 'wp_ajax_shopbiz-sites-plugin-activate', __CLASS__ . '::required_plugin_activate' );

		}
		 /**
		 * View actions
		 */
		static public function get_view_actions() {

			if ( empty( self::$view_actions ) ) {

				$actions            = array(
					'general' => array(
						'label' => __( 'Welcome', 'shopbiz' ),
						'show'  => ! is_network_admin(),
					),
				);
				self::$view_actions = apply_filters( 'shopbiz_menu_options', $actions );
			}

			return self::$view_actions;
		}
        /**
		 * Save All admin settings here
		 */
		static public function save_settings() {

			// Only admins can save settings.
			if ( ! current_user_can( 'manage_options' ) ){
				return;
			}

			// Let extensions hook into saving.
			do_action( 'shopbiz_admin_settings_save' );
		}

        /**
		 * Enqueues the needed CSS/JS for the builder's admin settings page.
		 *
		 * @since 1.0
		 */
		static public function styles_scripts(){
			// Styles.
			wp_enqueue_style( 'shopbiz-admin-settings', SHOPBIZ_THEME_URI . 'lib/theme-option/assets/css/shopbiz-admin-menu-settings.css', array(), 999 );
			// Script.
		}

		/**
		 * Enqueues the needed CSS/JS for Backend.
		 *
		 * @since 1.0
		 */
		static public function admin_scripts(){
			// Styles.
			wp_enqueue_style( 'shopbiz-admin', SHOPBIZ_THEME_URI . 'lib/theme-option/assets/css/shopbiz-admin.css', array(), 999 );

		}
        /**
		 * Add main menu
		 *
		 * @since 1.0
		 */
		static public function add_admin_menu() {

			$parent_page    = self::$default_menu_position;
			$page_title     = self::$menu_page_title;
			$capability     = 'manage_options';
			$page_menu_slug = self::$plugin_slug;
			$page_menu_func = __CLASS__ . '::menu_callback';

			if ( apply_filters( 'shopbiz_dashboard_admin_menu', true ) ) {
				add_theme_page( $page_title, $page_title, $capability, $page_menu_slug, $page_menu_func );
			} else {
				do_action( 'shopbiz_register_admin_menu', $parent_page, $page_title, $capability, $page_menu_slug, $page_menu_func );
			}
		}

        /**
		 * Menu callback
		 *
		 * @since 1.0
		 */
		static public function menu_callback() {

			$current_slug = isset( $_GET['action'] ) ? esc_attr( $_GET['action'] ) : self::$current_slug;

			$active_tab   = str_replace( '_', '-', $current_slug );
			$current_slug = str_replace( '-', '_', $current_slug );

			$ast_icon           = apply_filters( 'shopbiz_page_top_icon', true );
			$ast_visit_site_url = apply_filters( 'shopbiz_site_url', 'https://themeansar.com' );
			$ast_wrapper_class  = apply_filters( 'shopbiz_welcome_wrapper_class', array( $current_slug ) );
			$my_theme = wp_get_theme();
			$consult_theme_version = $my_theme->get( 'Version' );
            
			?>
			<div class="consult-menu-page-wrapper wrap consult-clear <?php echo esc_attr( implode( ' ', $ast_wrapper_class ) ); ?>">
					<div class="consult-theme-page-header">
						<div class="consult-container consult-flex">
							<div class="consult-theme-title">
								<a href="<?php echo esc_url( $ast_visit_site_url ); ?>" target="_blank" rel="noopener" >
								<?php if ( $ast_icon ) { ?>
									<img src="<?php echo esc_url( SHOPBIZ_THEME_URI . 'lib/theme-option/assets/images/logo-white.png' ); ?>" class="consult-theme-icon" alt="<?php echo esc_attr( self::$page_title ); ?> " >
									<span class="shopbiz-theme-version"><?php echo  esc_html($consult_theme_version); ?></span>
								<?php } ?>
								<?php do_action( 'shopbiz_welcome_page_header_title' ); ?>
								</a>
							</div>
							<?php do_action( 'shopbiz_header_right_section' ); ?>
						</div>
					</div>
				<?php do_action( 'shopbiz_menu_' . esc_attr( $current_slug ) . '_action' ); ?>
			</div>
			<?php
		}
        /**
		 * Include general page
		 *
		 * @since 1.0
		 */
		static public function general_page(){
			get_template_part( 'lib/theme-option/view-general');
		}
        
        /**
		 * Include Welcome page right starter sites content
		 *
		 * @since 1.2.4
		 */
		static public function shopbiz_welcome_page_starter_sites_section(){
			?>
			<div class="postbox">
				<h2 class="hndle consult-normal-cusror">
					<span class="dashicons dashicons-admin-customizer"></span>
					<span><?php echo esc_html( apply_filters( 'shopbiz_sites_menu_page_title', __( 'Install Plugin', 'shopbiz' ) ) ); ?></span>
				</h2>
				<img class="consult-starter-sites-img" src="<?php echo esc_url( SHOPBIZ_THEME_URI . 'lib/theme-option/assets/images/shopbiz-preview.png' ); ?>">
				<div class="inside">
					
					<p>
						<?php
							esc_html_e( 'Click the below button and install ICYCLUB plugin in customizer Setting for full advatages frontpage and many other theme feature', 'shopbiz' );
						?>
					</p>
					<a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-primary button-hero" style="text-decoration: none;">
					<?php echo esc_html__('Go to Cutomizer Panel','shopbiz'); ?> </a>
				</div>
			</div>

			<?php
		}
        /**
		 * Include Welcome page right side knowledge base content
		 *
		 * @since 1.2.4
		 */
		static public function shopbiz_welcome_page_knowledge_base_scetion(){
			?>

			<div class="postbox">
				<h2 class="hndle consult-normal-cusror">
					<span class="dashicons dashicons-book"></span>
					<span><?php esc_html_e( 'Learn More', 'shopbiz' ); ?></span>
				</h2>
				<div class="inside">
					<p>
						<?php esc_html_e( 'Want to know how it works, take a look on this and get whole knowledge about shopbiz. Learn shopbiz', 'shopbiz' ); ?>
					</p>
					<a href="<?php echo esc_url('https://themeansar.com/help/'); ?>" target="_blank" rel="noopener"><?php echo esc_html__('Visit Us','shopbiz'); ?></a>
				</div>
			</div>
			<?php
		}

	
		/**
		 * Include Welcome page right side Five Star Support
		 *
		 * @since 1.2.4
		 */
		static public function shopbiz_welcome_page_five_star_scetion(){
			?>
			<div class="postbox">
				<h2 class="hndle shopbiz-normal-cusror">
					<span class="dashicons dashicons-sos"></span>
					<span><?php esc_html_e( 'Customer Support', 'shopbiz' ); ?></span>
				</h2>
				<div class="inside">
					<p>
						<?php
						printf(
							esc_html__( 'We start with what the customer needs and we work backwards. You\'re absolutely free to contact us and shopbiz team will be happy to help you.', 'shopbiz' ));
						?>
					</p>
					<a href="<?php echo esc_url('https://themeansar.com/help/'); ?>" target="_blank" rel="noopener"><?php echo esc_html__('Submit Ticket','shopbiz'); ?></a>
				</div>
			</div>
			<?php
		}

         
		/**
		 * Include Welcome page content
		 *
		 * @since 1.2.4
		 */
		static public function shopbiz_welcome_page_content() {

			$shopbiz_addon_tagline = apply_filters( 'shopbiz_addon_list_tagline', __( 'Get More Options with shopbiz Pro!', 'shopbiz' ) );
			$consult_visit_pro_feature_site_url = apply_filters( 'shopbiz_pro_site_url', 'https://themeansar.com/themes/shopbiz/' );
			
			
			// Quick settings.
			$quick_settings = apply_filters(
				'shopbiz_quick_settings',
				array(
					'logo-favicon' => array(
						'title'     => __( 'Upload Logo', 'shopbiz' ),
						'dashicon'  => 'dashicons-format-image',
						'quick_url' => admin_url( 'customize.php?autofocus[control]=custom_logo' ),
					),
					'colors'       => array(
						'title'     => __( 'Set Colors', 'shopbiz' ),
						'dashicon'  => 'dashicons-admin-customizer',
						'quick_url' => admin_url( 'customize.php?autofocus[control]=custom_color' ),
					),
					
					'sidebars'     => array(
						'title'     => __( 'Sidebar Options', 'shopbiz' ),
						'dashicon'  => 'dashicons-align-left',
						'quick_url' => admin_url( 'customize.php?autofocus[control]=shopbiz-section-sidebar-group' ),
					),
					
					'social'     => array(
						'title'     => __( 'Social Icon', 'shopbiz' ),
						'dashicon'  => 'dashicons-groups',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=shopbiz-social-icon' ),
					),
					
					'site-button'     => array(
						'title'     => __( 'Site Button', 'shopbiz' ),
						'dashicon'  => 'dashicons-admin-post',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=shopbiz-site-button' ),
					),
				)
			);
			?>
			<div class="postbox">
				<h2 class="hndle consult-normal-cusror"><span><?php esc_html_e( 'Visit to Customizer Settings:', 'shopbiz' ); ?></span></h2>
					<div class="consult-quick-setting-section">
						<?php
						if ( ! empty( $quick_settings ) ) :
							?>
							<div class="consult-quick-links">
								<ul class="consult-flex">
									<?php
									foreach ( (array) $quick_settings as $key => $link ) {
										echo '<li class=""><span class="dashicons ' . esc_attr( $link['dashicon'] ) . '"></span><a class="ast-quick-setting-title" href="' . esc_url( $link['quick_url'] ) . '" target="_blank" rel="noopener">' . esc_html( $link['title'] ) . '</a></li>';
									}
									?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
			</div>
			
			<div class="postbox">
				<h2 class="hndle consult-normal-cusror"><span><?php esc_html_e( 'shopbiz Usefull Links', 'shopbiz' ); ?></span></h2>
					<div class="consult-quick-setting-section">
													<div class="consult-quick-links">
								<ul class="consult-flex">
									<li class=""><span class="dashicons dashicons-format-image"></span><a class="ast-quick-setting-title" href="<?php echo esc_url('https://themeansar.com/demo/wp/shopbiz/default/');?>" target="_blank" rel="noopener"><?php esc_html_e( 'Pro Demo', 'shopbiz' ); ?></a></li>
									
									<li class=""><span class="dashicons dashicons-align-left"></span><a class="ast-quick-setting-title" href="<?php echo esc_url('https://wordpress.org/support/theme/shopbiz-lite/reviews/#new-post');?>" target="_blank" rel="noopener"><?php esc_html_e( 'Your Feedback', 'shopbiz' ); ?></a></li>
									
									<li class=""><span class="dashicons dashicons-groups"></span><a class="ast-quick-setting-title" href="<?php echo esc_url('https://themeansar.com/help/');?>" target="_blank" rel="noopener"><?php esc_html_e( 'Premium Support', 'shopbiz' ); ?></a></li>
									</ul>
							</div>
											</div>
			</div>
		   
			<div class="postbox shopbiz-pro-link">
				<h2 class="shopbiz-pro-build"><span><a href="<?php echo esc_url('https://themeansar.com/themes/shopbiz/');?>" target="_blank">
				<?php echo esc_html_e('Get More Options with Shopbiz Pro!','shopbiz'); ?></a></span>
					<?php do_action( 'shopbiz_addon_bulk_action' ); ?>
				</h2>
			</div>

			<?php
		}
        
		/**
		 * Update Admin Title.
		 *
		 * @since 1.0.19
		 *
		 * @param string $admin_title Admin Title.
		 * @param string $title Title.
		 * @return string
		 */
		static public function shopbiz_admin_title( $admin_title, $title ) {

			$screen = get_current_screen();
			if ( 'appearance_page_shopbiz' == $screen->id ) {

				$view_actions = self::get_view_actions();

				$current_slug = isset( $_GET['action'] ) ? esc_attr( $_GET['action'] ) : self::$current_slug;
				$active_tab   = str_replace( '_', '-', $current_slug );

				if ( 'general' != $active_tab && isset( $view_actions[ $active_tab ]['label'] ) ) {
					$admin_title = str_replace( $title, $view_actions[ $active_tab ]['label'], $admin_title );
				}
			}

			return $admin_title;
		}

        /**
		 * shopbiz Header Right Section Links
		 *
		 * @since 1.2.4
		 */
		static public function top_header_right_section(){

			$top_links = apply_filters(
				'shopbiz_header_top_links',
				array(
					'shopbiz-theme-info' => array(
						'title' => __( 'Easy to use, Fully Customizable, Unique options', 'shopbiz' ),
					),
				)
			);

			if ( ! empty( $top_links ) ) {
				?>
				<div class="consult-top-links">
					<ul>
						<?php
						foreach ( (array) $top_links as $key => $info ) {
							/* translators: %1$s: Top Link URL wrapper, %2$s: Top Link URL, %3$s: Top Link URL target attribute */
							printf(
								'<li><%1$s %2$s %3$s > %4$s </%1$s>',
								isset( $info['url'] ) ? 'a' : 'span',
								isset( $info['url'] ) ? 'href="' . esc_url( $info['url'] ) . '"' : '',
								isset( $info['url'] ) ? 'target="_blank" rel="noopener"' : '',
								esc_html( $info['title'] )
							);
						}
						?>
						</ul>
					</div>
				<?php
			}
		}
    /**
		 * Required Plugin Activate
		 *
		 * @since 1.2.4
		 */
		static public function required_plugin_activate() {

			if ( ! current_user_can( 'install_plugins' ) || ! isset( $_POST['init'] ) || ! $_POST['init'] ) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => __( 'No plugin specified', 'shopbiz' ),
					)
				);
			}

			$plugin_init = ( isset( $_POST['init'] ) ) ? esc_attr( $_POST['init'] ) : '';

			$activate = activate_plugin( $plugin_init, '', false, true );

			if ( is_wp_error( $activate ) ) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => $activate->get_error_message(),
					)
				);
			}

			wp_send_json_success(
				array(
					'success' => true,
					'message' => __( 'Plugin Successfully Activated', 'shopbiz' ),
				)
			);

		}




	}
   new Shopbiz_Admin_Settings;

}