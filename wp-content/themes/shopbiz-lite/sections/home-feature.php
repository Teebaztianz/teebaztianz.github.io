<?php
$shopbiz_callout_enable = get_theme_mod('shopbiz_callout_enable',true); 
$shopbiz_callout_background = get_theme_mod('shopbiz_callout_background','');
$shopbiz_overlay_callout_color_control = get_theme_mod('shopbiz_overlay_callout_color_control','');
$shopbiz_callout_button_one_label = get_theme_mod('shopbiz_callout_button_one_label');
$shopbiz_callout_button_one_link = get_theme_mod('shopbiz_callout_button_one_link');
$shopbiz_callout_button_one_target = get_theme_mod('shopbiz_callout_button_one_target');
$shopbiz_callout_button_two_label = get_theme_mod('shopbiz_callout_button_two_label');
$shopbiz_callout_button_two_link = get_theme_mod('shopbiz_callout_button_two_link');
$shopbiz_callout_button_two_target = get_theme_mod('shopbiz_callout_button_two_target');
?>
<!--==================== ta-CALLOUT SECTION ====================-->
<?php 
if($shopbiz_callout_enable) {
if($shopbiz_callout_background != '') { ?>

<section class="ta-callout" style="background-image:url('<?php echo esc_url($shopbiz_callout_background);?>');">
<?php } else { ?>
<section class="ta-callout">
  <?php } ?>
  <div class="overlay" style="background-color:<?php echo esc_attr($shopbiz_overlay_callout_color_control);?>;">
    <div class="container">
      <div class="row">
        <div class="col-md-8  col-md-offset-2 fadeInDown animated">
          <div class="ta-heading">
            <?php $shopbiz_callout_title = esc_attr(get_theme_mod('shopbiz_callout_title'));
          
            if( !empty($shopbiz_callout_title) ):

              echo '<h3>'.$shopbiz_callout_title.'</h3>';

            endif;
             ?>
          </div>
          <?php $shopbiz_callout_description = esc_attr(get_theme_mod('shopbiz_callout_description'));

            if( !empty($shopbiz_callout_description) ):

              echo '<p class="padding-bottom-30">'.$shopbiz_callout_description.'</p>';

            endif; ?>
          <?php if( !empty($shopbiz_callout_button_one_label) ): ?>
      		  <a href="<?php echo $shopbiz_callout_button_one_link; ?>" <?php if( $shopbiz_callout_button_one_target == true) { echo "target='_blank'"; } ?> class="btn btn-theme">
      		<?php echo esc_attr($shopbiz_callout_button_one_label); ?></a>
      		<?php
      		endif;

          if( !empty($shopbiz_callout_button_two_label) ): ?>
      		  <a href="<?php echo $shopbiz_callout_button_two_link; ?>" <?php if( $shopbiz_callout_button_two_target ==true) { echo "target='_blank'"; } ?> class="btn btn-theme-two"><?php echo esc_attr($shopbiz_callout_button_two_label); ?></a>
    		<?php endif; ?>	
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>