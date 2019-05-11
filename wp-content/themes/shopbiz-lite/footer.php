<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package shopbiz
 */
?>
<!--==================== ta-FOOTER AREA ====================-->
<footer> 
  <!--Start ta-footer-widget-area-->
  <?php if ( is_active_sidebar( 'footer_widget_area' ) ) { ?>
  <div class="ta-footer-widget-area">
    <div class="container">
      <div class="row">
        <?php  dynamic_sidebar( 'footer_widget_area' ); ?>
      </div>
    </div>
  </div>
  <?php } ?>
  <!--End ta-footer-widget-area-->
  <div class="ta-footer-copyright">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
			<?php if( get_theme_mod( 'hide_copyright' ) !='false') { echo get_theme_mod('shopbiz_footer_copyright_setting',__('<p>&copy; Copyright 2019 by <a href="#">shopbiz</a>. All Rights Reserved. Powered by <a href=" https://wordpress.org/">WordPress</a></p>','shopbiz')); } ?>
		</div>
        <div class="col-md-6 text-right">
          <?php if(get_theme_mod('hide_footer_icon') != 'false' ) { ?>
          <ul class="ta-social">
                       <?php if(get_theme_mod('social_link_facebook','#')!='') { ?>
            <li><span class="icon-soci"><a href="<?php echo esc_url(get_theme_mod('social_link_facebook')); ?>" <?php if(get_theme_mod('Social_link_facebook_tab')==1){ echo "target='_blank'"; } ?> ><i class="fa fa-facebook"></i></a></span></li>
            <?php } if(get_theme_mod('social_link_twitter','#')!='') { ?>
            <li><span class="icon-soci"><a href="<?php echo esc_url(get_theme_mod('social_link_twitter')); ?>" <?php if(get_theme_mod('Social_link_twitter_tab')==1){ echo "target='_blank'"; } ?> ><i class="fa fa-twitter"></i></a></span></li>
            <?php } if(get_theme_mod('social_link_linkedin','#')!='') { ?>
            <li><span class="icon-soci"><a href="<?php echo esc_url(get_theme_mod('social_link_linkedin')); ?>" <?php if(get_theme_mod('Social_link_linkedin_tab')==1){ echo "target='_blank'"; } ?> ><i class="fa fa-linkedin"></i></a></span></li>
            <?php } if(get_theme_mod('social_link_google','#')!='') { ?>
            <li><span class="icon-soci"><a href="<?php echo esc_url(get_theme_mod('social_link_google')); ?>" <?php if(get_theme_mod('Social_link_google_tab')==1){ echo "target='_blank'"; } ?> ><i class="fa fa-google-plus"></i></a></span></li>
            <?php } ?>
          </ul>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</footer>
</div>
<!--Scroll To Top--> 
<a href="#" class="ti_scroll bounceInRight  animated"><i class="fa fa-angle-up"></i></a> 
<!--/Scroll To Top-->
<?php wp_footer(); ?>
</body>
</html>