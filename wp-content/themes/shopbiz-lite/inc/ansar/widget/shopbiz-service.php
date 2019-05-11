<?php 
add_action('widgets_init','shopbiz_service_widget');
function shopbiz_service_widget(){
	
	return register_widget('shopbiz_service_widget');
}

class shopbiz_service_widget extends WP_Widget{
	
	function __construct() {
		parent::__construct(
			'shopbiz_service_widget', // Base ID
			__('shopbiz - Service Widget', 'shopbiz'), // Name
			array( 'description' => __( 'Service Section Widget', 'shopbiz'), ) // Args
		);
	}

    function widget($args, $instance) {

        extract($args);

        echo $before_widget;
		$service_page=(isset($instance['service_page'])?$instance['service_page']:'');
		
		if(($instance['service_page']) !=null) {
		$page= get_post($instance['service_page']);
		$post_thumbnail_id = get_post_thumbnail_id($service_page);
		$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
		?>

        <div class="ta-service <?php if($instance['style'] == 2): echo 'two'; endif;?>">
        	<?php // Check for displaying feature image
				if($instance['hide_image'] != true): 
					echo '<img class="img-responsive" src="'. wp_get_attachment_url( get_post_thumbnail_id($instance['service_page']) ) .'" />';
				endif; ?>
			<div class="ta-service-inner ">
				<?php if( !empty($instance['sericon']) ): ?>
				<div class="ser-icon">
                	<i class="fa <?php echo htmlspecialchars_decode(apply_filters('widget_title', $instance['sericon'])); ?>"></i>
                </div>
                <?php endif; ?>
				<?php echo '<h3 class="widgettitle">'. $page->post_title .'</h3>'; ?>
            	<?php if($page->post_excerpt) echo '<p>'.$page->post_excerpt. '</p>'; // check for the page content ?>
            </div>
         </div>
        <?php }
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
		$instance['style'] = isset($new_instance['style']) ? $new_instance['style'] : '';
		$instance['sericon'] = isset($new_instance['sericon']) ? $new_instance['sericon'] : '';
		$instance['hide_image'] = isset($new_instance['hide_image']) ? $new_instance['hide_image'] : '';
		$instance['service_page'] = ( ! empty( $new_instance['service_page'] ) ) ? $new_instance['service_page'] : '';
	    return $instance;

    }

    function form($instance) {
		$instance['style'] = isset($new_instance['style']) ? $new_instance['style'] : '';

        ?>
        <table>
        	<tr>
                <p>
                    <label for="<?php echo $this->get_field_id('style'); ?>"><?php _e('style', 'shopbiz'); ?></label>
                </p>
                <p>

                
                    <select name="<?php echo $this->get_field_name('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>">
                    <option value="1" <?php selected( $instance['style'], 1 ); ?>><?php _e('Service With image','shopbiz'); ?></option>
    				<option value="2" <?php selected( $instance['style'], 2 ); ?>><?php _e('Service With Icon','shopbiz'); ?></option>
                    </select>
            	</p>
            </tr>
        	<tr>	
        	<p>
			<label for="<?php echo $this->get_field_id( 'service_page' ); ?>"><?php _e( 'Select Pages:','shopbiz' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'service_page' ); ?>" name="<?php echo $this->get_field_name( 'service_page' ); ?>">
				<option value>--Select--</option>
				<?php
					$service_page = $instance['service_page'];
					$pages = get_pages($service_page); 				
					foreach ( $pages as $page ) {
						$option = '<option value="' . $page->ID . '" ';
						$option .= ( $page->ID == $service_page ) ? 'selected="selected"' : '';
						$option .= '>';
						$option .= $page->post_title;
						$option .= '</option>';
						echo $option;
					}
				?>
						
			</select>
			<br/>
			</p>
			</tr>
			<tr>
        	<p>
			<label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Service Icon', 'shopbiz'); ?></label><br/> 
			<input type="text" name="<?php echo $this->get_field_name('sericon'); ?>" id="<?php echo $this->get_field_id('sericon'); ?>" value="<?php if( !empty($instance['sericon']) ): echo $instance['sericon']; endif; ?>" placeholder="<?php _e( 'fa fa-check','shopbiz' ); ?>" class="widefat"/>
			</p>
			</tr>
			<tr>
				<p>
				<input type="checkbox" name="<?php echo $this->get_field_name('hide_image'); ?>" id="<?php echo $this->get_field_id('hide_image'); ?>" <?php if( !empty($instance['hide_image']) ): checked( (bool) $instance['hide_image'], true ); endif; ?> ><?php _e( 'Hide Featured Image','shopbiz' ); ?>
				</p>
			</tr>
		</table>
    <?php
    }

}