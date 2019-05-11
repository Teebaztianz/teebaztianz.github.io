<?php
/**
 *Rich Store Lite About Theme
 *
 * @package Rich Store Lite
 */

//about theme info
add_action( 'admin_menu', 'rich_store_lite_abouttheme' );
function rich_store_lite_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'rich-store-lite'), __('About Theme Info', 'rich-store-lite'), 'edit_theme_options', 'rich_store_lite_guide', 'rich_store_lite_mostrar_guide');   
} 

//Info of the theme
function rich_store_lite_mostrar_guide() { 	
?>
<div class="grace_wrapper">
	<div class="grace_left">
   		   <div class="grace_heading">
			  <h3><?php esc_html_e('About Theme Info', 'rich-store-lite'); ?></h3>
		   </div>
          <p><?php esc_html_e('Rich Store Lite is a professional, modern, clean and responsive Marketplace WordPress Theme designed for creating ecommerce website that will definitely draw more customers to your business. This theme is specially designed for product sellers, book store, multimedia, digital agency and other businesses that need a WooCommerce compatible theme for their online business website. This theme can also be used for different purposes such as corporate, business, portfolio, photography, blog, personal website and many more. With its beautiful crafted homepage layout, you can create fully functional website for your online store. Rich Store is very clean coded theme which is fast to install and easy to customize. This ecommerce theme is very flexible and comes with great features that you can use for designing your unique eCommerce website.','rich-store-lite'); ?></p>
<div class="grace_heading"> <?php esc_html_e('Theme Features', 'rich-store-lite'); ?></div>
 

<div class="grace_column2">
  <h4><?php esc_html_e('Theme Customizer', 'rich-store-lite'); ?></h4>
  <div class="description"><?php esc_html_e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'rich-store-lite'); ?></div>
</div>

<div class="grace_column2">
  <h4><?php esc_html_e('Responsive Ready', 'rich-store-lite'); ?></h4>
  <div class="description"><?php esc_html_e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'rich-store-lite'); ?></div>
</div>

<div class="grace_column2">
<h4><?php esc_html_e('Cross Browser Compatible', 'rich-store-lite'); ?></h4>
<div class="description"><?php esc_html_e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'rich-store-lite'); ?></div>
</div>

<div class="grace_column2">
<h4><?php esc_html_e('E-commerce', 'rich-store-lite'); ?></h4>
<div class="description"><?php esc_html_e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'rich-store-lite'); ?></div>
</div>
<hr />  
</div><!-- .grace_left -->
	
<div class="grace_right">			
        <div>				
            <a href="<?php echo esc_url( RICH_STORE_LITE_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'rich-store-lite'); ?></a> | 
            <a href="<?php echo esc_url( RICH_STORE_LITE_PROTHEME_URL ); ?>" target="_blank"><?php esc_html_e('Purchase Pro', 'rich-store-lite'); ?></a> | 
            <a href="<?php echo esc_url( RICH_STORE_LITE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'rich-store-lite'); ?></a>
        </div>		
</div><!-- .grace_right-->
<div class="clear"></div>
</div><!-- .grace_wrapper -->
<?php } ?>