<?php
/**
 *
 * This file is used to create metabox with slider custom css on post edit screen
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 */


/**
 * The main metabox class.
 *
 * This is used to add custom css metabox for custom post type
 * admin-facing site hooks.
 *
 * @since      1.0.0
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 * @author     Shindiri Studio
 */
class Shindiri_Woo_Slider_Custom_Css_Metabox {
    
        const META_VALUE_KEY = Shindiri_Woo_Slider::CUSTOM_CSS_METABOX_KEY;
        const NOUNCE_ACTION = 'shindiri_woo_slider_custom_css_nounce_action';
        const NOUNCE_NAME_FIELD = '_shindiri_woo_slider_custom_css_nounce';

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
	public function add_meta_box( $post_type ) {
        $post_types = array( Shindiri_Woo_Slider_Admin::$plugin_post_type );     //limit meta box to certain post types
        if ( in_array( $post_type, $post_types )) {
            add_meta_box(
                'shindiri_woo_slider_custom_css_meta_box' //HTML 'id' attribute of the edit screen section
                ,sprintf( esc_html__( 'Custom CSS for %s', 'woo-shop-slider-lite' ), Shindiri_Woo_Slider::get_plugin_public_name() ) //Title of the edit screen section, visible to user 
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
       
		// Sanitize the user input.
        $custom_css = Shindiri_Woo_Slider_Helper::validate_allowed_html( $_POST['custom_css'] );
        
        // Insert no-custom-css string if empty
        $custom_css = !empty( $custom_css ) ? $custom_css : 'no-custom-css';

		// Update the meta field.
		update_post_meta( $post_id, self::META_VALUE_KEY, $custom_css );
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

		// Use get_post_meta to retrieve an existing value from the database.
                // Set false to retreive array
		$values = get_post_meta( $post->ID, self::META_VALUE_KEY, true );

        // Override not to store value 'no-custom-css' if empty
        $custom_css = isset( $values ) && !empty( $values ) && $values !== 'no-custom-css' ? $values : '';
        
		/* Display the form, using the current value. */
        $output = '<div class="shindiri-woo-slider-custom-css-metabox">';

            // Description
            $output .= '<textarea name="custom_css" id="sh-ws-custom-css" rows="12">' . Shindiri_Woo_Slider_Helper::validate_allowed_html( $custom_css ) . '</textarea>';
        
                        $output .= '<div class="sh-ws-ace-editor-wrapper">
                                        <pre id="sh-ws-custom-css-editor"></pre>
                                    </div>';
        
                        $output .= '<div class="description">' . esc_html__( 'To target only this slider in Your custom css use class:', 'woo-shop-slider-lite' ) . ' <span>.' . self::generate_slider_custom_css_class( $post->ID ) . '</span></div>';
            
        $output .= '</div><!-- .shindiri-woo-slider-custom-css-metabox -->';
        
        // Echo post meta backend box
        echo $output;
                 
	}
    
    /**
	 * Slider unique css class based on post name and id, used for custom css
	 *
	 * @param int $post_id The post id
     * 
     * @since 1.0.0
     * @return string Slider unique css class based on post name and id
	 */
    public static function generate_slider_custom_css_class( $post_id ) {
        return strtolower( sanitize_file_name( Shindiri_Woo_Slider::PLUGIN_NAME . '-' . get_the_title( $post_id ) . '-' . $post_id ) );
    }
}
?>