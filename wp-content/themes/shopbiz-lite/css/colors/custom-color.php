<?php
/*----Custom Header Color----*/ 
function header_color() {
$shopbiz_top_background = get_theme_mod('shopbiz_top_background');
$shopbiz_top_color = get_theme_mod('shopbiz_top_color');	
$shopbiz_site_title_color = get_theme_mod('shopbiz_site_title_color');
$shopbiz_header_background = get_theme_mod('shopbiz_header_background');
$shopbiz_menu_background = get_theme_mod('shopbiz_menu_background');
$shopbiz_menu_background_hover = get_theme_mod('shopbiz_menu_background_hover');
$shopbiz_menu_color = get_theme_mod('shopbiz_menu_color');
$shopbiz_menu_active_color = get_theme_mod('shopbiz_menu_active_color');
$shopbiz_menu_submenu_background = get_theme_mod('shopbiz_menu_submenu_background');
$shopbiz_menu_submenu_background_hover = get_theme_mod('shopbiz_menu_submenu_background_hover');
$shopbiz_menu_submenu_color = get_theme_mod('shopbiz_menu_submenu_color');
$shopbiz_menu_submenu_active_color = get_theme_mod('shopbiz_menu_submenu_active_color');
?>
<style type="text/css">
/*==================== Top Bar color ====================*/
.ta-head-detail {
	background: <?php echo esc_attr( $shopbiz_top_background);?>;
}
.ta-head-detail .info-left li a , .ta-head-detail li a i, .ta-head-detail .info-right li a, .ta-head-detail .info-left li, .ta-head-detail .info-right li {
	color: <?php echo $shopbiz_top_color ?>;
}
.navbar-wp {
	background: <?php echo esc_attr($shopbiz_header_background);?>;
}
.navbar-header .navbar-brand {
	color: <?php echo esc_attr($shopbiz_site_title_color);?>;
}
/*=== navbar hover colors ===*/
.navbar-wp .navbar-nav > li > a {
	background-color: <?php echo esc_attr($shopbiz_menu_background);?>;
	color: <?php echo esc_attr($shopbiz_menu_color);?>;
}
.navbar-wp .navbar-nav > li > a:hover, .navbar-wp .navbar-nav > li > a:focus, .navbar-wp .navbar-nav > .active > a, .navbar-wp .navbar-nav > .active > a:hover, .navbar-wp .navbar-nav > .active > a:focus {
	color: <?php echo esc_attr($shopbiz_menu_active_color);?>;
	background-color: <?php echo esc_attr($shopbiz_menu_background_hover);?>;
}
.navbar-wp .navbar-nav > .open > a, .navbar-wp .navbar-nav > .open > a:hover, .navbar-wp .navbar-nav > .open > a:focus {
	color: <?php echo esc_attr($shopbiz_menu_active_color);?>;
	background-color: <?php echo esc_attr($shopbiz_menu_background_hover);?>;
}
/*=== navbar dropdown colors ===*/ 
.navbar-wp .dropdown-menu {
	background: <?php echo esc_attr($shopbiz_menu_submenu_background);?>;
}
.navbar-wp .dropdown-menu > li > a {
	color: <?php echo esc_attr($shopbiz_menu_submenu_color);?>;
}
.navbar-wp .dropdown-menu > .active > a, .navbar-wp .dropdown-menu > .active > a:hover, .navbar-wp .dropdown-menu > .active > a:focus {
	background: <?php echo esc_attr($shopbiz_menu_submenu_background_hover);?>;
	color: <?php echo esc_attr($shopbiz_menu_submenu_active_color);?>;
}
.navbar-wp .dropdown-menu > li > a:hover {
	background: <?php echo esc_attr($shopbiz_menu_submenu_background_hover);?>;
	color: <?php echo esc_attr($shopbiz_menu_submenu_active_color);?>;
}
.navbar-wp .navbar-nav > .disabled > a {
	color: #ccc;
}
.navbar-wp .navbar-nav > .disabled > a:hover {
	color: #ccc;
}
.navbar-wp .navbar-nav > .disabled > a:focus {
	color: #ccc;
}

.navbar-wp .navbar-toggle:hover, .navbar-wp .navbar-toggle:focus {
	background: <?php echo esc_attr($shopbiz_menu_background_hover);?>;
	border-color: <?php echo esc_attr($shopbiz_menu_background_hover);?>;
	color: <?php echo esc_attr($shopbiz_menu_active_color);?>;
}
/*=== navbar drop down hover color ===*/
.navbar-base .navbar-nav > .open > a, .navbar-base .navbar-nav > .open > a:hover, .navbar-base .navbar-nav > .open > a:focus {
	color: #fff;
}
.navbar-base .navbar-nav > li > a.dropdown-form-toggle {
	color: #fff;
}
/*=== navbar text color ===*/ 
.navbar-default .navbar-toggle {
	background: <?php echo esc_attr($shopbiz_menu_background_hover);?>;
	border-color: <?php echo esc_attr($shopbiz_menu_background_hover);?>;
	color: <?php echo esc_attr($shopbiz_menu_active_color);?>;
}
.navbar-wp .navbar-nav > li > a.dropdown-form-toggle {
	color: #fff;
}
</style>
<?php
} 
function footer_color() {
$shopbiz_footer_background = get_theme_mod('shopbiz_footer_background');
$shopbiz_footer_head_color = get_theme_mod('shopbiz_footer_head_color');
$shopbiz_footer_text_color = get_theme_mod('shopbiz_footer_text_color');
$shopbiz_footer_text_active_color = get_theme_mod('shopbiz_footer_text_active_color');
$shopbiz_footer_copy_background = get_theme_mod('shopbiz_footer_copy_background');
$shopbiz_footer_copy_color = get_theme_mod('shopbiz_footer_copy_color');
?>
<style type="text/css">
/*----Custom Footer Color----*/ 
/*==================== footer background ====================*/
footer {
	background: <?php echo esc_attr($shopbiz_footer_background);?>;
}
footer .ta-footer-copyright {
	background: <?php echo esc_attr($shopbiz_footer_copy_background);?>;
}
footer .ta-footer-copyright p, footer .ta-footer-copyright a {
	color: <?php echo esc_attr($shopbiz_footer_copy_color);?>;
}
footer .ta-footer-copyright a:hover, footer .ta-footer-copyright a:focus {
	color: #fff;
}
footer .ta-footer-widget-area {
	border-top-color: rgba(225,225,225,0.2);
}
/*==================== footer color ====================*/
/*=== footer heading color ===*/
footer .ta-widget h6 {
	color: <?php echo esc_attr($shopbiz_footer_head_color);?>;
}

footer .ta-widget .calendar_wrap table thead th, label, footer p, footer .ta-blog-post span, footer .ta-widget .textwidget, footer a, footer .ta-widget .list-unstyled li a, footer .ta-widget .ta-twitter-feed li, footer .ta-widget .ta-widget-address li, footer .ta-widget .ta-social li span.icon-soci, footer .ta-widget .ta-opening-hours li, footer .ta-widget .ta-widget-tags a ,footer .ta-widget .tagcloud a, footer .ta-widget-quote .form-control, footer .ta-widget-tollfree li a, footer .ta-widget-tollfree li i, footer .ta-widget-payment a, footer .ta-calendar a:hover, footer .ta-calendar thead th, footer .wpcf7-form p, footer .ta-widget .wpcf7-form .wpcf7-form-control {
	color: <?php echo esc_attr($shopbiz_footer_text_color);?>;
}

footer .ta-widget .form-control, footer .ta-widget ul li, footer .ta-widget .list-unstyled li, footer .ta-widget .ta-social li span.icon-soci, footer .calendar_wrap caption, footer .ta-widget .ta-widget-tags a, footer .ta-widget .tagcloud a, footer .calendar_wrap table thead th  {
	border-color: <?php echo esc_attr($shopbiz_footer_text_color);?>;
}
/*==================== footer hover color ====================*/
footer a:hover, footer a:focus, footer .ta-widget .ta-subscribe:hover, footer .ta-widget .ta-subscribe:focus, footer .ta-widget .ta-search-widget .btn:hover, footer .ta-widget .ta-search-widget .btn:focus, footer .ta-widget .list-unstyled li a:hover, footer .ta-widget .ta-opening-hours li:hover, footer .ta-widget .ta-widget-address li span.icon-addr, footer .ta-widget .ta-social li span.icon-soci:hover i, footer .ta-widget .ta-social li span.icon-soci:hover, footer .ta-widget .ta-widget-tags a:hover ,footer .ta-widget .tagcloud a:hover, footer .ta-calendar a, footer .ta-calendar tbody td, footer .ta-calendar tbody #today {
	color: <?php echo esc_attr($shopbiz_footer_text_active_color);?>;
}
footer .ta-calendar tbody #today:hover, footer .ta-calendar tbody td:hover, footer .ta-calendar tfoot, footer .ta-calendar tfoot a {
	color: #333;
}
</style>
<?php
} ?>