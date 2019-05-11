<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Rich Store Lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
$rich_store_lite_show_headercontactinfo_part 	  	 = get_theme_mod('rich_store_lite_show_headercontactinfo_part', false);
$rich_store_lite_show_socialsection 	  			 = get_theme_mod('rich_store_lite_show_socialsection', false);
$rich_store_lite_pageforslidershowoption 	  	     = get_theme_mod('rich_store_lite_pageforslidershowoption', false);
?>
<div id="sitelayout_options" <?php if( get_theme_mod( 'rich_store_lite_boxlayout_option' ) ) { echo 'class="boxlayout"'; } ?>>
<?php
if ( is_front_page() && !is_home() ) {
	if( !empty($rich_store_lite_pageforslidershowoption)) {
	 	$inner_cls = '';
	}
	else {
		$inner_cls = 'siteinner';
	}
}
else {
$inner_cls = 'siteinner';
}
?>

<div class="site-header <?php echo $inner_cls; ?>"> 
<div class="topstrip">
  <div class="container">    
  <div class="left">  
   <?php if( $rich_store_lite_show_headercontactinfo_part != ''){ ?> 
             <?php
               $rich_store_lite_contactemail = get_theme_mod('rich_store_lite_contactemail');
               if( !empty($rich_store_lite_contactemail) ){ ?> 
               <div class="infobox">
                 <i class="fas fa-envelope"></i>
                 <a href="<?php echo esc_url('mailto:'.get_theme_mod('rich_store_lite_contactemail')); ?>">
				    <?php echo esc_html(get_theme_mod('rich_store_lite_contactemail')); ?>
                 </a>                
                </div>
               <?php } ?>
               
               <?php 
               $rich_store_lite_header_contactnumber = get_theme_mod('rich_store_lite_header_contactnumber');
               if( !empty($rich_store_lite_header_contactnumber) ){ ?> 
                <div class="infobox">
                 <i class="fas fa-phone fa-rotate-90"></i>
				 <?php echo esc_html($rich_store_lite_header_contactnumber); ?>
                </div>
               <?php } ?>                
     <?php } ?> 
  
  </div>
  <div class="right">
    <?php if( $rich_store_lite_show_socialsection != ''){ ?> 
        <div class="top_socialicons">                                                
                   <?php $rich_store_lite_fb_link = get_theme_mod('rich_store_lite_fb_link');
                    if( !empty($rich_store_lite_fb_link) ){ ?>
                    <a title="facebook" class="fab fa-facebook-f" target="_blank" href="<?php echo esc_url($rich_store_lite_fb_link); ?>"></a>
                   <?php } ?>
                
                   <?php $rich_store_lite_twitt_link = get_theme_mod('rich_store_lite_twitt_link');
                    if( !empty($rich_store_lite_twitt_link) ){ ?>
                    <a title="twitter" class="fab fa-twitter" target="_blank" href="<?php echo esc_url($rich_store_lite_twitt_link); ?>"></a>
                   <?php } ?>
            
                  <?php $rich_store_lite_gplus_link = get_theme_mod('rich_store_lite_gplus_link');
                    if( !empty($rich_store_lite_gplus_link) ){ ?>
                    <a title="google-plus" class="fab fa-google-plus" target="_blank" href="<?php echo esc_url($rich_store_lite_gplus_link); ?>"></a>
                  <?php }?>
            
                  <?php $rich_store_lite_linked_link = get_theme_mod('rich_store_lite_linked_link');
                    if( !empty($rich_store_lite_linked_link) ){ ?>
                    <a title="linkedin" class="fab fa-linkedin" target="_blank" href="<?php echo esc_url($rich_store_lite_linked_link); ?>"></a>
                  <?php } ?>                  
         </div><!--end .top_socialicons--> 
    <?php } ?> 
    </div>
    <div class="clear"></div>  
  </div><!-- container --> 
</div>
<div class="container">    
     <div class="logo">
        <?php rich_store_lite_the_custom_logo(); ?>
        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
                <p><?php echo esc_html($description); ?></p>
            <?php endif; ?>
        </div><!-- logo -->
        <div class="header-cart-search">
	<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
    <?php $count = WC()->cart->cart_contents_count; ?>
    <div class="headercart">
        <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php esc_html_e('View your shopping cart','rich-store-lite'); ?>">
        <?php if ( $count > 0 ) { ?>
        <span class="cart-contents-count"><?php  echo esc_html( $count ); ?></span>
        <?php } ?>
        </a>
    </div> 
    <?php } ?>
</div>
        
     <div class="right_menupart">     
       <div class="toggle">
         <a class="toggleMenu" href="#"><?php esc_html_e('Menu','rich-store-lite'); ?></a>
       </div><!-- toggle --> 
       <div class="sitemenubox">                   
         <?php wp_nav_menu( array('theme_location' => 'primary') ); ?>
       </div><!--.sitemenubox -->
       
     </div><!--.right_menupart -->
<div class="clear"></div>  
</div><!-- container --> 
</div><!--.site-header --> 

<?php 
if ( is_front_page() && !is_home() ) {
if($rich_store_lite_pageforslidershowoption != '') {
	for($i=1; $i<=3; $i++) {
	  if( get_theme_mod('rich_store_lite_pageforslider'.$i,false)) {
		$slider_Arr[] = absint( get_theme_mod('rich_store_lite_pageforslider'.$i,true));
	  }
	}
?> 
<div class="slider_wrapper">                
<?php if(!empty($slider_Arr)){ ?>
<div id="slider" class="nivoSlider">
<?php 
$i=1;
$slidequery = new WP_Query( array( 'post_type' => 'page', 'post__in' => $slider_Arr, 'orderby' => 'post__in' ) );
while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); 
$thumbnail_id = get_post_thumbnail_id( $post->ID );
$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); 
?>
<?php if(!empty($image)){ ?>
<img src="<?php echo esc_url( $image ); ?>" title="#slidecaption<?php echo $i; ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php }else{ ?>
  <img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider-default.jpg" title="#slidecaption<?php echo $i; ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php } ?>
<?php $i++; endwhile; ?>
</div>   

<?php 
$j=1;
$slidequery->rewind_posts();
while( $slidequery->have_posts() ) : $slidequery->the_post(); ?>                 
    <div id="slidecaption<?php echo $j; ?>" class="nivo-html-caption">        
      <div class="captionfix">
        <h2><?php the_title(); ?></h2>
    	<?php the_excerpt(); ?>
		<?php
        $rich_store_lite_pageforslidermore = get_theme_mod('rich_store_lite_pageforslidermore');
        if( !empty($rich_store_lite_pageforslidermore) ){ ?>
            <a class="slider_readmore" href="<?php the_permalink(); ?>"><?php echo esc_html($rich_store_lite_pageforslidermore); ?></a>
        <?php } ?>       
     </div>
    </div>    
<?php $j++; 
endwhile;
wp_reset_postdata(); ?>  
<div class="clear"></div>  
</div><!--end .slider_wrapper -->     
<?php } ?>
<?php } } ?>