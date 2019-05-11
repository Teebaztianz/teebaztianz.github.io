<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package shopbiz
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<div class="wrapper">
<a style="display:none;" class="skip-link screen-reader-text" href="#content">
<?php esc_html_e( 'Skip to content', 'shopbiz' ); ?>
</a>
<header> 
  <!--==================== TOP BAR ====================-->
  <div class="ta-head-detail hidden-xs hidden-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-xs-12 col-sm-6">
          <ul class="info-left">
            <?php 
              $shopbiz_head_info_one = get_theme_mod('shopbiz_head_info_one','<li><a><i class="fa fa-clock-o "></i>Open-Hours:10 am to 7pm</a></li>');
              $shopbiz_head_info_two = get_theme_mod('shopbiz_head_info_two','<li><a href="mailto:info@themeansar.com" title="Mail Me"><i class="fa fa-envelope"></i> info@themeansar.com</a></li>');
            ?>
            <li><?php echo $shopbiz_head_info_one; ?></li>
            <li><?php echo $shopbiz_head_info_two; ?></li>
          </ul>
        </div>
        

      <div class="col-md-6 col-xs-12">
        <?php if ( has_nav_menu( 'social' ) ) : ?>
          <nav class="ta-social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'shopbiz' ); ?>">
            <?php
              wp_nav_menu( array(
                'theme_location' => 'social',
                'menu_class'     => 'social-links-menu info-right',
                'depth'          => 1,
                'link_before'    => '<span class="screen-reader-text">',
                'link_after'     => '</span>' . shopbiz_include_svg_icons( array( 'icon' => 'chain' ) ),
              ) );
            ?>
          </nav><!-- .social-navigation -->
          <?php endif; ?>
       
          </div>

      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <!--==================== Header ====================-->
  <div class="ta-main-nav">
    <nav class="navbar navbar-default navbar-wp">
      <div class="container">
        <div class="navbar-header"> 
			<!-- Logo -->
			<?php
			if(has_custom_logo())
			{
			// Display the Custom Logo
			the_custom_logo();
			}
			 else { ?>
			<a class="navbar-brand" href="<?php echo home_url( '/' ); ?>"><?php bloginfo('name'); ?><br>
			<span class="site-description"><?php echo  get_bloginfo( 'description', 'display' ); ?></span>   
			</a>			
			<?php } ?>
			</h1>
          <!-- navbar-toggle -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only"><?php echo 'Toggle Navigation'; ?></span> <span class="fa fa-ellipsis-v fa-lg"></span> </button>
        </div>
        <!-- /navbar-toggle --> 
        
        <!-- Navigation -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <?php wp_nav_menu( array(  
				'theme_location' => 'primary', 'container'  => '', 'menu_class' => 'nav navbar-nav navbar-right','fallback_cb' => 'shopbiz_fallback_page_menu','walker' => new shopbiz_nav_walker()
				 ) ); ?>
        </div>
        
        <!-- /Navigation --> 
      </div>
    </nav>
  </div>
</header>
<!-- #masthead --> 