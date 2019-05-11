<?php
/**
 *
 * This file is used to create metabox with slider common settins on post edit screen
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 */


/**
 * The main metabox class.
 *
 * This is used to add common settings metabox for custom post type
 * admin-facing site hooks.
 *
 * @since      1.0.0
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 * @author     Shindiri Studio
 */
class Shindiri_Woo_Slider_Common_settings_Metabox {
    
        const META_VALUE_KEY = Shindiri_Woo_Slider::COMMON_SETTINGS_METABOX_KEY;
        const NOUNCE_ACTION = 'shindiri_woo_slider_common_settings_nounce_action';
        const NOUNCE_NAME_FIELD = '_shindiri_woo_slider_common_settings_nounce';

	/**
	 * Hook into the appropriate actions when the class is constructed
     * 
     * @since 1.0.0
	 */
	public function __construct() {
		// Run only on our custom pages screens
        if ( is_admin() && get_current_screen()->id === Shindiri_Woo_Slider::PLUGIN_NAME ) {
            $this->run();
        }
	}
    
     /**
	 * Add all class actions only for custom post type
	 *
	 * @since    1.0.0
	 */
    private function run() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
    }
    
    /**
	 * Adds the meta box container
     * 
     * @since    1.0.0
	 */
    public function quick_view_scripts() {
        // Using scripts from main metabox for color picker
    }

	/**
	 * Adds the meta box container
     * 
     * @since    1.0.0
	 */
	public function add_meta_box( $post_type ) {
        $post_types = array( Shindiri_Woo_Slider_Admin::$plugin_post_type );     //limit meta box to certain post types
        if ( in_array( $post_type, $post_types )) {
            add_meta_box(
                'shindiri_woo_slider_common_settings_meta_box' //HTML 'id' attribute of the edit screen section
                ,sprintf( esc_html__( 'General settings %s', 'woo-shop-slider-lite' ), '<span>(' . sprintf( esc_html__( 'These settings are global and will be applied on every %s', 'woo-shop-slider-lite' ), Shindiri_Woo_Slider::get_plugin_public_name() ) . ')</span>' ) //Title of the edit screen section, visible to user 
                ,array( $this, 'render_meta_box_content' ) //Function that prints out the HTML for the edit screen section.
                ,$post_type //The type of Write screen on which to show the edit screen section ('post', 'page', 'dashboard', 'link', 'attachment' or 'custom_post_type' where custom_post_type is the custom post type slug) 
                ,'normal' //The part of the page where the edit screen section should be shown ('normal', 'advanced', or 'side'). (Note that 'side' doesn't exist before 2.7) 
                ,'default' //The priority within the context where the boxes should show ('high', 'core', 'default' or 'low') 
            );
        }
	}
        

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
     * 
     * @since 1.0.0
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
                //     so we don't want to do anything.
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
       
		// Sanitize the user inputs.
        $common_settings['quick_look_switch'] = isset( $_POST['quick_look_switch'] ) ? sanitize_text_field( $_POST['quick_look_switch'] ) : '';
        $common_settings['quick_view_color'] = isset( $_POST['quick_view_color'] ) ? sanitize_text_field( $_POST['quick_view_color'] ) : '';
        $common_settings['quick_view_typography'] = isset( $_POST['quick_view_typography'] ) ? sanitize_text_field( $_POST['quick_view_typography'] ) : '';
        $common_settings['qv_sale_text_color'] = isset( $_POST['qv_sale_text_color'] ) ? sanitize_text_field( $_POST['qv_sale_text_color'] ) : '';
        $common_settings['qv_sale_bg_color'] = isset( $_POST['qv_sale_bg_color'] ) ? sanitize_text_field( $_POST['qv_sale_bg_color'] ) : '';
        $common_settings['quick_look_shop_switch'] = isset( $_POST['quick_look_shop_switch'] ) ? sanitize_text_field( $_POST['quick_look_shop_switch'] ) : '';
        $common_settings['qv_shop_btn_classes'] = isset( $_POST['qv_shop_btn_classes'] ) ? sanitize_text_field( $_POST['qv_shop_btn_classes'] ) : '';

		// Update option instead meta value so it can be the same in all sliders
		update_option( self::META_VALUE_KEY, $common_settings );
	}


	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
     * 
     * @since 1.0.0
	 */
	public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( self::NOUNCE_ACTION, self::NOUNCE_NAME_FIELD );

		// Use get option to make settings global
		$values = self::get_common_settings();
        
        // Disable or enable Quick View Button
        $quick_look_switch = isset( $values['quick_look_switch'] ) && !empty( $values['quick_look_switch'] ) ? $values['quick_look_switch'] : 'enabled';
        // Quick view accent color
        $quick_view_color = isset( $values['quick_view_color'] ) && !empty( $values['quick_view_color'] ) ? $values['quick_view_color'] : '';
        // Typography enabled or disabled
        $quick_view_typography = isset( $values['quick_view_typography'] ) && !empty( $values['quick_view_typography'] ) ? $values['quick_view_typography'] : '';
        // Sale text color
        $qv_sale_text_color = isset( $values['qv_sale_text_color'] ) ? $values['qv_sale_text_color'] : '#ffffff';
        // Sale background color
        $qv_sale_bg_color = isset( $values['qv_sale_bg_color'] ) ? $values['qv_sale_bg_color'] : '#c9a46b';
        // Disable or enable Quick View Button on all products in shop and product categories
        $quick_look_shop_switch = isset( $values['quick_look_shop_switch'] ) && !empty( $values['quick_look_shop_switch'] ) ? $values['quick_look_shop_switch'] : 'disabled';
        // Quick view shop button additional clsses
        $qv_shop_btn_classes = isset( $values['qv_shop_btn_classes'] ) ? $values['qv_shop_btn_classes'] : '';
        
        
		/* Display the form */
        
        ?>
            <div class="shindiri-quick-view-settings-metabox">
            <table class="form-table">
                <tbody>
                    
                    <tr class="form-field form-field-full-width">
                        <th scope="row"><label for="default_role"><?php esc_html_e( 'Quick Look button', 'woo-shop-slider-lite' ); ?></label></th>
                        <td>
                            <select name="quick_look_switch">
                                <option value="disabled" <?php selected( $quick_look_switch, 'disabled' ); ?>><?php esc_html_e( 'Disabled', 'woo-shop-slider-lite' ); ?></option>
                                <option value="enabled" <?php selected( $quick_look_switch, 'enabled' ); ?>><?php esc_html_e( 'Enabled', 'woo-shop-slider-lite' ); ?></option>
                            </select>
                            <p class="description"><?php esc_html_e( 'Disable or enable Quick View Button in all sliders.', 'woo-shop-slider-lite' ); ?></p>
                            <p class="description">
                                <strong>
                                <?php 
                                echo sprintf( 
                                    esc_html__( 'To override built in Quick look functionality, hook some other Quick View plugin or use other html visit this link: %s', 'woo-shop-slider-lite' ), 
                                    '<a href="http://www.shindiristudio.com/wooslider/documentation/#quick-look-override" target="_blank">' . esc_html__( 'Documentation', 'woo-shop-slider-lite' ) . '</a>'
                                ); 
                                ?>
                                </strong>
                            </p>
                        </td>
                    </tr>
                    
                    <tr class="form-field">
                        <th scope="row"><label><?php esc_html_e( 'Quick view accent color', 'woo-shop-slider-lite' ); ?></label></th>
                        <td>
                            <input type="text" name="quick_view_color" value="<?php echo sanitize_text_field( $quick_view_color ) ?>" class="sh-ws-color-picker-field" data-default-color="" />
                            <p class="description"><?php esc_html_e( 'Color will be used as accent color in quick view for: separator, button and hover on slider arrows.', 'woo-shop-slider-lite' ); ?></p>
                        </td>
                    </tr>

                    <tr class="form-field">
                        <th scope="row"><label for="default_role"><?php esc_html_e( 'Quick view typography', 'woo-shop-slider-lite' ); ?></label></th>
                        <td>
                            <select name="quick_view_typography">
                                <option value="enabled" <?php selected( $quick_view_typography, 'enabled' ); ?>><?php esc_html_e( 'Enabled', 'woo-shop-slider-lite' ); ?></option>
                                <option value="disabled" <?php selected( $quick_view_typography, 'disabled' ); ?>><?php esc_html_e( 'Disabled', 'woo-shop-slider-lite' ); ?></option>
                            </select>
                            <p class="description"><?php esc_html_e( 'If you want to use custom typography for quick view, please select Disabled option.', 'woo-shop-slider-lite' ); ?></p>
                        </td>
                    </tr>
                    
                    <tr class="form-field">
                        <th scope="row"><label><?php esc_html_e( 'Quick view sale ribbon text color', 'woo-shop-slider-lite' ); ?></label></th>
                        <td>
                            <input type="text" name="qv_sale_text_color" value="<?php echo sanitize_text_field( $qv_sale_text_color ) ?>" class="sh-ws-color-picker-field" data-default-color="" />
                            <p class="description"></p>
                        </td>
                    </tr>
                    
                    <tr class="form-field">
                        <th scope="row"><label><?php esc_html_e( 'Quick view sale ribbon background color', 'woo-shop-slider-lite' ); ?></label></th>
                        <td>
                            <input type="text" name="qv_sale_bg_color" value="<?php echo sanitize_text_field( $qv_sale_bg_color ) ?>" class="sh-ws-color-picker-field" data-default-color="" />
                            <p class="description"></p>
                        </td>
                    </tr>
                    
                    <tr class="form-field">
                        <th scope="row"><label for="default_role"><?php esc_html_e( 'Quick Look button on shop products', 'woo-shop-slider-lite' ); ?></label></th>
                        <td>
                            <select name="quick_look_shop_switch">
                                <option value="enabled" <?php selected( $quick_look_shop_switch, 'enabled' ); ?>><?php esc_html_e( 'Enabled', 'woo-shop-slider-lite' ); ?></option>
                                <option value="disabled" <?php selected( $quick_look_shop_switch, 'disabled' ); ?>><?php esc_html_e( 'Disabled', 'woo-shop-slider-lite' ); ?></option>
                            </select>
                            <p class="description"><?php esc_html_e( 'Disable or enable Quick View Button on all products in shop and product categories.', 'woo-shop-slider-lite' ); ?></p>
                            <p class="description">
                                <strong>
                                <?php esc_html_e( 'Important: Quick look button must be enabled. This settings depends from Your theme code and may not be compatible with all themes as it require some WooCommerce hooks to be implemented.', 'woo-shop-slider-lite' ); ?>
                                </strong>
                            </p>
                        </td>
                    </tr>
                    
                    <tr class="form-field">
                        <th scope="row"><label><?php esc_html_e( 'Quick look shop button additional classes', 'woo-shop-slider-lite' ); ?></label></th>
                        <td>
                            <input type="text" name="qv_shop_btn_classes" value="<?php echo sanitize_text_field( $qv_shop_btn_classes ) ?>" />
                            <p class="description">
                                <?php esc_html_e( 'Add css classes for Quick look button on shop and product category pages and style button to fit Your needs.', 'woo-shop-slider-lite' ); ?>
                            </p>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div><!-- .shindiri-quick-view-settings-metabox -->
        <?php
                 
	}
    
    /**
	 * Render Meta Box content.
     * 
     * @since 1.1.0
     * 
     * @return   array  Return common metabox settings or empty array if no such option or results
	 */
    public static function get_common_settings() {
        return get_option( self::META_VALUE_KEY, array() );
    }
}
?>