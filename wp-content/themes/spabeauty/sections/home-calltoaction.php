<?php $spa_calltoaction_enable = get_theme_mod('spa_calltoaction_enable','true');
if($spa_calltoaction_enable !='false')
{
$spa_calltoaction_background = get_theme_mod('spa_calltoaction_background','');
$spa_calltoaction_button_one_label = get_theme_mod('spa_calltoaction_button_one_label');
$spa_calltoaction_button_one_link = get_theme_mod('spa_calltoaction_button_one_link','#');
$spa_calltoaction_button_one_target = get_theme_mod('spa_calltoaction_button_one_target','true');
$spa_overlay_calltoaction_color_control = get_theme_mod('spa_overlay_calltoaction_color_control','');
$spa_calltoaction_text_color = get_theme_mod('spa_calltoaction_text_color',''); ?>
<style>
.ta-calltoaction-box-icon i, .ta-calltoaction-box-info h5, .ta-calltoaction-box-info p {
color: <?php echo esc_url($spa_calltoaction_text_color);
?>;
}
</style>
<!--==================== CALL TO ACTION SECTION ====================-->
<?php if($spa_calltoaction_background != '') { ?>

<section class="ta-calltoaction wow fadeIn animated" style="background-image:url('<?php echo esc_url($spa_calltoaction_background);?>');">
<?php } else { ?>
<section class="ta-calltoaction wow fadeIn animated">
  <?php } ?>
  <div class="overlay" style="background-color:<?php echo esc_url($spa_overlay_calltoaction_color_control);?>">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="ta-calltoaction-box-info">
            <?php $spa_calltoaction_title = get_theme_mod('spa_calltoaction_title');
          
            
			if( !empty($spa_calltoaction_title ) ):
			
			echo '<h5>'. esc_html($spa_calltoaction_title).'</h5>';

            endif; ?>
            <?php $spa_calltoaction_subtitle = get_theme_mod('spa_calltoaction_subtitle');

            if( !empty($spa_calltoaction_subtitle) ):
			
			echo '<p>'. esc_html($spa_calltoaction_subtitle).'</p>';

            endif; ?>
          </div>
        </div>
        <div class="col-md-2"> <a href="<?php echo esc_url($spa_calltoaction_button_one_link); ?>" <?php if( $spa_calltoaction_button_one_target == true) { echo "target='_blank'"; } ?>  class="btn btn-theme"> <?php echo esc_html($spa_calltoaction_button_one_label); ?> </a> </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>