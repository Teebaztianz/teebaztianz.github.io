<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TC Mega Stores
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if(is_singular() && pings_open()){ ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php }
wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<!-- Wrapper Start -->
<div class="wrapper">
<div class="ms-header">
<header class="header1 bs-header">
<?php $sc_topbar= get_theme_mod( 'tc_mega_stores_display_topbar_setting', 0);
	$sc_topmenu = get_theme_mod( 'tc_mega_stores_display_topmenu_setting', 0);
		if($sc_topbar==1){	?>
	<div class="container-fluid bs-topbar">
		<div class="container">
			<div class="row bs-topbar-detail">
				<div class="col-md-6 col-sm-6 bs-add-info">
				<?php for($i=1; $i<=3; $i++){
				$sc_icon = get_theme_mod('tc_mega_stores_header_icon_'.$i); 
				$sc_icon_data = get_theme_mod('tc_mega_stores_header_heading_'.$i); 
				 ?>
					<ul class="bs-mail">
						<li class="bs-mail-icon">
						<?php if($sc_icon!=''){ ?>
							<i class="<?php echo esc_attr($sc_icon); ?>"></i>
						<?php } if($sc_icon_data!=''){ ?>
							<?php echo esc_attr($sc_icon_data); ?>
						
						<?php } ?>
						</li>
					</ul>
				<?php }  ?>
				</div>
				
				<div class="col-md-4 col-sm-4 bs-top-cart">
					<?php if($sc_topmenu==1){
						wp_nav_menu( array(
						'theme_location' => 'tc_mega_stores_header',
						'menu_class' => 'bs-cart',
						)
					); }	?>
				</div>        
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="container-fluid ms-logo-bar">
		<div class="container">
			<div class="row ms-header-bar">
				<div class="col-md-4 col-sm-12 col-xs-10 bs-logo">
					<?php $tc_mega_stores_logo_id = get_theme_mod( 'custom_logo' );
					$tc_mega_stores_logo_data = wp_get_attachment_image_src( $tc_mega_stores_logo_id , 'full' );
					$tc_mega_stores_logo = $tc_mega_stores_logo_data[0];	?>
					<h1 class="site-title">
					<a class="logo-wrapper" href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php if(isset($tc_mega_stores_logo)){ ?>
					<img src="<?php echo esc_url($tc_mega_stores_logo); ?>" alt="<?php bloginfo( 'name' ); ?>" >
					<?php }else { ?>
					<?php bloginfo( 'name' ); ?>
					<?php } ?></a></h1>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				</div>
				<div class="col-md-8 col-sm-12 col-xs-2 ms-cartbar">
					<?php 
							if(tc_mega_stores_is_wc()){
								get_template_part('searchform-product');
							}
							tc_mega_stores_mini_cart(); ?>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-default bs-menu">
		<div class="container-fluid bs-logo-bar">
			<div class="container">
				<div class="row sc-header-bar">
					<div class="col-md-12 col-sm-12 bs-add-category">
						<div class="row bs-menu-head">
							<div class="navbar-header">
							  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>                        
							  </button>
							  <a class="navbar-brand" href="<?php echo esc_url(home_url( '/' )); ?>"></a>
							</div>
                                                        <div class="collapse navbar-collapse" id="myNavbar">
							<?php wp_nav_menu( array(
									'theme_location' => 'tc_mega_stores_primary',
									'menu_class' => 'nav navbar-nav navbar-right tc-main-menu',
									'fallback_cb' => 'tc_mega_stores_fallback_page_menu',
									'walker' => new tc_mega_stores_nav_walker(),
									)
								);	?>
	
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>
<?php if(!is_front_page()){ ?>
<!-- Breadcum start -->
<div class="container-fluid bs-breadcum">
	<div class="container">
		<div class="row bs-bread">
		<?php if (function_exists('tc_mega_stores_breadcrumbs')){ tc_mega_stores_breadcrumbs(); } ?>
		</div>
	</div>
</div>
<!-- Breadcum End -->
<?php } ?>
</div>