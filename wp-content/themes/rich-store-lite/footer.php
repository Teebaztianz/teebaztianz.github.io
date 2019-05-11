<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Rich Store Lite
 */
?>

<div class="sitefooter"> 
           <div class="copyrightwrap">
              <div class="container">               
				    <?php bloginfo('name'); ?> | <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'rich-store-lite' ) ); ?>">
				     <?php
				         /* translators: %s: WordPress. */
				          printf( __( 'Proudly Powered by %s.', 'rich-store-lite' ), 'WordPress' );
				     ?>
			       </a>   <a href="<?php echo esc_url( __( 'https://gracethemes.com/themes/free-ecommerce-marketplace-wordpress-theme/', 'rich-store-lite' ) ); ?>" target="_blank">
				       <?php printf( __( 'Theme by %s', 'rich-store-lite' ), 'Grace Themes' ); ?>
                    </a>                 
            </div><!--end .container-->  
         </div><!--end .copyrightwrap-->     
                                 
     </div><!--end #sitefooter-->
</div><!--#end sitelayout_options-->

<?php wp_footer(); ?>
</body>
</html>