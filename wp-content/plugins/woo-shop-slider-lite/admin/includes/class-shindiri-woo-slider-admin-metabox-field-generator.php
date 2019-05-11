<?php
/**
 *
 * This file contain common functions for generating fields on metabox screen
 *
 * @since      1.0.0
 *
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 */


/**
 * The helper class.
 *
 * This file contain common functions for generating fields on metabox screen
 * admin-facing site hooks.
 *
 * @since      1.0.0
 * @package    Shindiri_Woo_Slider
 * @subpackage Shindiri_Woo_Slider/admin/includes
 * @author     Shindiri Studio
 */
class Shindiri_Woo_Slider_Metabox_Fields_Generator {
    
    /**
	 * Container class for every generated field
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $field_container_class     Container class for every generated field
	 */
    private $field_container_class = 'sh-ws-settings-field';
    
    /**
     * Echo media uploader field
     *
     * @since 1.0.0
     *
     * @param   string    $label_text   Text to display as label
     * @param   string    $img_url   Url to preview image
     * @param   string    $name   Field name
     * @param   string/int    $value   Field value
     * @param   string    $default_img_url   Default image url
     * @param   string    $description   Some field description
     * 
     * @access   public
     */
    public function get_media_uploader( $label_text, $img_url, $name, $value, $default_img_url = NULL, $description = '', $default_button_text = '' ) {
        $field_classes = $this->field_container_class . ' ' . $name;
        $default_button_text = empty( $default_button_text ) ? esc_html__( 'Default', 'woo-shop-slider-lite' ) : $default_button_text;
        ?>
        <div class="<?php echo esc_attr( $field_classes ) ?>">
            <table class="form-table">
                <tr class="sh-ws-upload-custom-image" data-default-url="<?php echo esc_url( $default_img_url ); ?>" >
                    <th><label><?php echo esc_html( $label_text ); ?></label></th>
                    <td>
                        <img class="sh-ws-sliderimg-preview" src="<?php echo esc_url( $img_url ); ?>" style="width:200px; height: auto;"><br />
                        <input type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" class="sh-ws-custom-image" style="display: none;"/>
                        <input type='button' class="sh-ws-custom-image-buttom button-primary" value="<?php esc_html_e( 'Upload Image', 'woo-shop-slider-lite' ); ?>" />
                        <?php if ( ! is_null( $default_img_url ) ) : ?>
                        <input type='button' class="sh-ws-custom-reset-buttom button-primary" value="<?php echo esc_html( $default_button_text ); ?>" />
                        <?php endif; ?>
                        <br />
                        <p class="description"><?php echo wp_kses_post( $description );; ?></p>
                    </td>
                </tr>
            </table><!-- end form-table -->
        </div>
        <?php
        
    }
    
    /**
     * Echo color picker field
     *
     * @since 1.0.0
     *
     * @param   string    $label_text   Text to display as label
     * @param   string    $name   Field name
     * @param   string/int    $value   Field value
     * @param   string    $default_color   Default hex color code
     * @param   string    $description   Some field description
     * 
     * @access   public
     */
    public function get_color_picker( $label_text, $name, $value, $default_color = '', $description = '' ) {
        $field_classes = $this->field_container_class . ' ' . $name;
        ?>
        <div class="<?php echo esc_attr( $field_classes ) ?>">
            <table class="form-table">
                <tbody>
                    <tr class="form-field">
                    <th scope="row"><label><?php echo esc_html( $label_text ); ?></label></th>
                    <td><input type="text" name="<?php echo $name; ?>" value="<?php echo esc_attr( $value ); ?>" class="sh-ws-color-picker-field" data-default-color="<?php echo esc_attr( $default_color ); ?>" />
                    <p class="description"><?php echo wp_kses_post( $description ); ?></p></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
    }
    
    /**
     * Echo text input field
     *
     * @since 1.0.0
     *
     * @param   string    $label_text   Text to display as label
     * @param   string    $name   Field name
     * @param   string/int    $value   Field value
     * @param   string    $description   Some field description
     * 
     * @access   public
     */
    public function get_text_field( $label_text, $name, $value, $description = '' ) {
        $field_classes = $this->field_container_class . ' ' . $name;
        ?>
        <div class="<?php echo esc_attr( $field_classes ) ?>">
            <label><?php echo esc_html( $label_text ); ?></label>
            <input type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" />
            <p class="description"><?php echo esc_html( $description ); ?></p> 
        </div>
        <?php
    }
    
    /**
     * Echo select field
     *
     * @since 1.0.0
     *
     * @param   string    $label_text   Text to display as label
     * @param   string    $name   Field name
     * @param   array    $options   Array of options. array( [0] => array( 'value' => 'some_value', 'title' => 'User visible title' ) ... )
     * @param   string/int    $value   Field value
     * @param   string    $description   Some field description
     * @param   string    $all_cats_option   Add All cateogries option, passed string will be used for user visible title. Default value for this option is string "all_selected"
     * @param   string    $all_cats_option_value   Value for all cats value returned
     * @param   boolean    $show_search   Show search for select field
     * @param   string    $classes  Additional classes
     * 
     * @access   public
     */
    public function get_select_field( $label_text, $name, $options, $value, $description = '', $all_cats_option = '', $all_cats_option_value = 'all_selected', $show_search = FALSE, $classes = array() ) {
        
        $classes = !empty( $classes ) && is_array( $classes ) ? ' ' . implode( ' ', $classes ) : ''; 
        
        $field_classes = $this->field_container_class . ' sh-ws-select-field ' . $name . $classes;
        ?>
        <div class="<?php echo esc_attr( $field_classes ) ?>">
            <label><?php echo esc_html( $label_text ); ?></label>
            
            <?php if ( $show_search ) : ?>
            <div class="sh-ws-select-search"><input type="text" value="" placeholder="<?php esc_html_e( 'Search...', 'woo-shop-slider-lite' ) ?>"/></div>
            <?php endif; ?>
            
            <select name="<?php echo esc_attr( $name ); ?>">
            <?php 
            if ( !empty( $all_cats_option ) ) {
                // Include all cateogries option
                echo '<option value="' . esc_attr( $all_cats_option_value ) . '"' . selected( esc_attr( $all_cats_option_value ), esc_attr( $value ) ) . '>' . esc_html( $all_cats_option ) . '</option>';
            }

            foreach ( $options as $option ) {
                echo '<option value="' . esc_attr( $option['value'] ) . '"' . selected( esc_attr( $option['value'] ), esc_attr( $value ) ) . '>' . esc_html( $option['title'] ) . '</option>';
            }
            ?>
            </select>
            <p class="description"><?php echo esc_html( $description ); ?></p> 
        </div>
        <?php
    }
    
    /**
     * Echo multiselect field with sorting
     * Documentation: https://github.com/patosai/tree-multiselect.js
     *
     * @since 1.0.0
     *
     * @param   string    $label_text   Text to display as label
     * @param   string    $name   Field name
     * @param   array    $options   Array of options. array( [0] => array( 'value' => 'some_value', 'title' => 'User visible title' ) ... )
     * @param   string    $value   Top level dropdown as description what to select
     * @param   string/int    $data_section   Field value
     * @param   string    $description   Some field description
     * @param   boolean    $side_panel   Show or hide side panel
     * 
     * @access   public
     */
    public function get_multiselect_field( $label_text, $name, $options, $value, $data_section, $description = '', $side_panel = TRUE ) {
        $field_classes = $this->field_container_class . ' sh-ws-multiselect-field ' . $name;
        $side_panel_data = $side_panel === TRUE ? 'yes' : 'no';
        ?>
        <div class="<?php echo esc_attr( $field_classes ) ?>">
            <label class="sh-ws-left-label"><?php echo esc_html( $label_text ); ?></label>
            <label class="sh-ws-right-label"><?php echo esc_html__( 'Selected categories (drag category to change order)', 'woo-shop-slider-lite' ); ?></label>
            <select class="sh-ws-multiselect-sorting" name="<?php echo esc_attr( $name ); ?>[]" multiple="multiple" style="display: none;" data-side-panel="<?php echo $side_panel_data; ?>">
            <?php 
        
            foreach ( $options as $option ) {
                $selected = in_array( $option['value'], $value ) ? ' selected="selected"' : '';
                $data_index = !empty( $selected ) ?  ' data-index="' . esc_attr( array_search( $option['value'], $value ) ) . '"' : '';
                echo '<option value="' . esc_attr( $option['value'] ) . '"' . $selected . $data_index . ' data-section="' . esc_attr( $data_section ) . '">' . esc_html( $option['title'] ) . '</option>';
            }
            ?>
            </select>
            <p class="description"><?php echo esc_html( $description ); ?></p> 
        </div>
        <?php
    }
    
    /**
     * Echo textarea input field
     *
     * @since 1.0.0
     *
     * @param   string    $label_text   Text to display as label
     * @param   string    $name   Field name
     * @param   string/int    $value   Field value
     * @param   array    $editor_settings   Wp text editor settings array.
     * @param   string    $description   Some field description
     * 
     * @access   public
     */
    public function get_textarea_field( $label_text, $name, $value, $editor_settings = '', $description = '' ) {
        $field_classes = $this->field_container_class . ' ' . $name;
        ?>
        <div class="<?php echo esc_attr( $field_classes ) ?>">
            <label><?php echo esc_html( $label_text ); ?></label>
            <br /><br />
            <?php
            // Textarea editor settings
            if ( empty( $editor_settings ) ) {
                $editor_settings = array( 
                    'textarea_rows' => 7,
                    'teeny' => false,
                    'wpautop' => true
                );
            }
            
            wp_editor( wp_kses_post( $value ), $name, $editor_settings );
            
            if ( !empty( $description ) ) :
            ?>
            <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
        </div>
        <?php
    }
    
    /**
     * Echo shortcode tag code field
     *
     * @since 1.0.0
     *
     * @param   int    $post_id   Post id
     * @param   string    $label_text   Text to display as label
     * @param   string    $tag_code   Shortcode tag code generated by Shortcode class Shindiri_Woo_Slider_Shortcodes
     * @param   string    $description   Some field description
     * 
     * @access   public
     */
    public function get_shortcode_tag_field( $post_id, $label_text, $tag_code, $description = '' ) {
        $field_classes = $this->field_container_class . ' shortcode-tag-code';
        ?>
        <div class="<?php echo esc_attr( $field_classes ) ?>">
            <label><?php echo esc_html( $label_text ); ?></label>
            <input type="text" value="<?php echo esc_html( Shindiri_Woo_Slider_Shortcodes::slider_shortcode_tag( $post_id ) ); ?>" class="sh-ws-shortcode-tag" readonly>
            <?php
            if ( !empty( $description ) ) :
            ?>
            <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
        </div>
        <?php
    }
    
    /**
     * Echo tab headline
     *
     * @since 1.0.0
     *
     * @param   string    $text   Headline text
     * 
     * @access   public
     */
    public function get_tab_headline( $text ) {
        $field_classes = $this->field_container_class . ' sh-ws-headline';
        ?>
        <div class="<?php echo esc_attr( $field_classes ) ?>">
            <h2><?php echo esc_html( $text ) . ' ' . esc_html_x( 'slider', 'appended text to slider name', 'woo-shop-slider-lite' ); ?></h2>
        </div>
        <?php
    }
    
    /**
     * Echo input range slider field
     *
     * @since 1.0.0
     *
     * @param   string    $label_text   Text to display as label
     * @param   string    $name   Field name
     * @param   string/int    $value   Field value
     * @param   int    $max   Input maximum value
     * @param   int    $min   Input minimum value
     * @param   int    $step   Range input step value
     * @param   string    $description   Some description
     * @param   string    $orientation   Range slider orientation
     * 
     * @access   public
     */
    public function get_range_slider( $label_text, $name, $value, $max, $min, $step = 1, $description = '', $orientation = 'horizontal' ) {
        $field_classes = $this->field_container_class . ' ' . $name;
        ?>
        <div class="<?php echo esc_attr( $field_classes ) ?>">
            <label><?php echo esc_html( $label_text ); ?></label>
            <div class="sh-ws-input-range-field">
                <input name="<?php echo esc_attr( $name ); ?>" type="range" step="<?php echo esc_attr( $step ); ?>" class="sh-ws-js-amount-range" value="<?php echo absint( $value ); ?>" min="<?php echo esc_attr( $min ); ?>" max="<?php echo esc_attr( $max ); ?>" data-orientation="<?php echo esc_attr( $orientation ); ?>" />
                <div class="sh-ws-js-amount">
                    <input type="number" class="sh-ws-js-amount-input" value="<?php echo absint( $value ); ?>" min="<?php echo esc_attr( $min ); ?>" max="<?php echo esc_attr( $max ); ?>"  />
                    <button type="button" class="sh-ws-js-amount-button button-primary"><?php esc_html_e( 'Change value', 'woo-shop-slider-lite' ); ?></button>
                </div><!-- .sh-ws-js-amount -->
            </div><!-- .sh-ws-input-range-field -->
            <?php if ( empty( $description ) ) : ?>
            <p class="description"><?php esc_html_e( 'If slider is unconveniant for you to use, please enter height in input field next to this slider. Please use numbers only (example: 800).', 'woo-shop-slider-lite' ); ?></p>
            <?php else : ?>
            <p class="description"><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
            <p class="description sh-ws-important"><?php echo sprintf( esc_html__( 'Maximum value: %s, minimum value: %s.', 'woo-shop-slider-lite' ), $max, $min ); ?></p>
            <p class="description sh-ws-important"><?php esc_html_e( 'Click "Change value" button to update value.', 'woo-shop-slider-lite' ); ?></p>
        </div>
        <?php
    }
    
    /**
     * Echo radio input field
     *
     * @since 1.0.0
     *
     * @param   string    $label_text   Text to display as label
     * @param   string    $name   Field name
     * @param   string/int    $value   Field value
     * @param   array    $options   Array of values to echo radio choices. Format: array( 'one_value', 'second_value'...)
     * @param   string    $description   Some field description
     * 
     * @access   public
     */
    public function get_radio_field( $label_text, $name, $value, $options, $description = '' ) {
        $field_classes = $this->field_container_class . ' sh-ws-input-radio-field ' . $name;
        ?>
        <div class="<?php echo esc_attr( $field_classes ) ?>">
            <label><?php echo esc_html( $label_text ); ?></label>
            <?php
            $i = 1;
            foreach ( $options as $option ) {
                $id = $name . $i;
                echo '<label class="sh-ws-radio-label" for="' . esc_attr( $id ) . '">' . esc_html( $option['label'] ) . '</label><input id="' . esc_attr( $id ) . '" type="radio" name="' . esc_attr( $name ) . '" value="' . esc_attr( $option['value'] ) . '" ' . checked( $value, $option['value'], false ) . '/>';
                $i++;
            }
            ?>
            <p class="description"><?php echo esc_html( $description ); ?></p> 
        </div>
        <?php
    }
}