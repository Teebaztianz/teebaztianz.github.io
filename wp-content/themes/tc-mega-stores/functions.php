<?php
/**
 * Mega Stores functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TC Mega Stores
 */

if ( ! function_exists( 'tc_mega_stores_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function tc_mega_stores_setup() {
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'tc-mega-stores', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support('woocommerce');
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 200,
		'flex-width' => false,
	) );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'tc_mega_stores_primary' => esc_html__( 'Primary', 'tc-mega-stores' ),
		'tc_mega_stores_header' => esc_html__( 'Header', 'tc-mega-stores' ),
	) );
	
	add_image_size( 'tc_mega_stores_slide', 1920, 800, true );
	add_image_size( 'tc_mega_stores_general', 400, 300, true );
	add_image_size( 'tc_mega_stores_thumb', 600, 400, true );
}
endif;
add_action( 'after_setup_theme', 'tc_mega_stores_setup' );


//including customizer
require( get_template_directory().'/customizer.php');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * @global int $content_width
 */
function tc_mega_stores_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tc_mega_stores_content_width', 640 );
}
add_action( 'after_setup_theme', 'tc_mega_stores_content_width', 0 );

/**
 * Register widget area.
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tc_mega_stores_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'tc-mega-stores' ),
		'id'            => 'tc-mega-stores-sidebar',
		'description'   => __( 'Main Sidebar', 'tc-mega-stores' ),
		'before_widget' => '<div id="%1$s" class="row sidebar-widget %2$s"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	
	
	register_sidebar( array(
		'name' => __( 'Footer Widget', 'tc-mega-stores' ),
		'id' => 'tc-mega-stores-footer-widget',
		'description'   => __( 'Footer widget area', 'tc-mega-stores' ),
		'before_widget' => '<div class="col-md-3 col-sm-6 bs-widget"><div class="widget">',
		'after_widget' => "</div></div>",
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'WooCommerce Sidebar', 'tc-mega-stores' ),
		'id'            => 'tc-mega-stores-woocommerce',
		'description'   => __( 'WooCommerce Sidebar', 'tc-mega-stores' ),
		'before_widget' => '<div id="%1$s" class="row sidebar-widget %2$s"><div class="widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'tc_mega_stores_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tc_mega_stores_scripts() {
	
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper.min.js');
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() .'/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.min.css' );
	wp_enqueue_style( 'tc-mega-stores-google-font', 'https://fonts.googleapis.com/css?family=Cinzel+Decorative|Bree+Serif' );
	wp_enqueue_style( 'animate', get_template_directory_uri() .'/css/animate.min.css' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() .'/css/swiper.min.css' );
	wp_enqueue_style('tc-mega-stores-stylesheet', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('tc-mega-stores-media-css', get_template_directory_uri() . '/css/media-screen.css' );
	
}
add_action( 'wp_enqueue_scripts', 'tc_mega_stores_scripts' );

function tc_mega_stores_footer_scripts() {
	
	wp_enqueue_script( 'tc-mega-stores-script', get_template_directory_uri() . '/js/script.js');
	
}
add_action( 'wp_footer', 'tc_mega_stores_footer_scripts' );

//color css 
function tc_mega_stores_color_css(){
	$color= get_theme_mod( 'tc_mega_stores_theme_color_setting', '#fe8bad'); ?>
<style>
.bs-topbar {
    background-color:<?php echo esc_html( $color ); ?>;
}
.error-link{
	color: <?php echo esc_html( $color ); ?>;
	border-bottom:2px solid <?php echo esc_html( $color ); ?>;
}
.slider-heading{
color: <?php echo esc_html( $color ); ?>;
}
.comments-text a{
	color: <?php echo esc_html( $color ); ?>;
} 
.bs-comment-form .comment-link {
   background-color: <?php echo esc_html( $color ); ?>;
}
.pager .previous a, .pager .next a {
    border: 2px solid <?php echo esc_html( $color ); ?>;
    color: <?php echo esc_html( $color ); ?>;
}
.wp-caption-text {
    background-color: <?php echo esc_html( $color ); ?>;
}
.bs-category-detail li a:hover {
    color: <?php echo esc_html( $color ); ?>;
}
.bs-category-detail li i{
	color:<?php echo esc_html( $color ); ?>;
}
.bs-category-detail li i{
	color:<?php echo esc_html( $color ); ?>;
}
.tagcloud a{
	border: 2px solid <?php echo esc_html( $color ); ?>;
	color:<?php echo esc_html( $color ); ?>;
	background-image: linear-gradient(to bottom, transparent 50%, <?php echo esc_html( $color ); ?> 50%);
}
.tagcloud a:hover{
	background-color:<?php echo esc_html( $color ); ?>;
}
#wp-calendar caption {
    background-color: <?php echo esc_html( $color ); ?>;
}
#wp-calendar td  a{
    color: <?php echo esc_html( $color ); ?>;
}
#wp-calendar tfoot {
    border-top: 2px solid <?php echo esc_html( $color ); ?>;
}
#wp-calendar caption {
    border: 2px solid <?php echo esc_html( $color ); ?>;
}
/* .bs-menu {
    background-color: <?php echo esc_html( $color ); ?>;
} */
.bs-menu .navbar-nav .open .dropdown-menu{
	background-color:<?php echo esc_html( $color ); ?>;
}
.slider-link{
	color:<?php echo esc_html( $color ); ?>;
	border:2px solid <?php echo esc_html( $color ); ?>;
	background-image: linear-gradient(to bottom, transparent 50%, <?php echo esc_html( $color ); ?> 50%);
}
.slider-link:hover,
.slider-link:focus{
	background-color:<?php echo esc_html( $color ); ?>;
}
.bs-ser-icon{
    border: 2px solid <?php echo esc_html( $color ); ?>;
    color: <?php echo esc_html( $color ); ?>;
	background-image: linear-gradient(to bottom, transparent 50%, <?php echo esc_html( $color ); ?> 50%);
}
.bs-servs:hover  .bs-ser-icon{
	background-color: <?php echo esc_html( $color ); ?>;
}
.ser-title{
	color:<?php echo esc_html( $color ); ?>;
}
.ser-title a{
	color:<?php echo esc_html( $color ); ?>;
}
.ports  .port-title{
background-color:<?php echo esc_html( $color ); ?>;
}
.blog-detail .entry-title,
.blog-detail .entry-title a{
	color:<?php echo esc_html( $color ); ?>;
}
.bs-author a:hover{
	color:<?php echo esc_html( $color ); ?>;
}
.date,
.month{
	background-color:<?php echo esc_html( $color ); ?>;
}
.bs-comments i,
.bs-author i{
	color:<?php echo esc_html( $color ); ?>;
}
.copyright a{
	color:<?php echo esc_html( $color ); ?>;
}
.footer {
    border-top: 3px solid <?php echo esc_html( $color ); ?>;
}

.search-btn-bg{
	border:2px solid <?php echo esc_html( $color ); ?>;
	background-color: <?php echo esc_html( $color ); ?>;
}
.bs-shop-cart span i {
    color: <?php echo esc_html( $color ); ?>;
}
.bs-breadc li a{
	 color: <?php echo esc_html( $color ); ?>;
}

.sale-product .img-thumbnail .overlay .ec-quick {
    background-color: #<?php echo esc_html( $color ); ?>;
}
.sale-product .add-to-links .add-cart a,
.sale-product .add-to-links .add-compare a,
.sale-product .add-to-links .add-wishlist a {
    background-color:<?php echo esc_html( $color ); ?>;
}
.sale-product .onsale {
    background-color: <?php echo esc_html( $color ); ?>;
}
.sale-product .onsale:after {
    border-left: 22px solid <?php echo esc_html( $color ); ?>;
}
.home-collect-prev, .home-collect-next {
    background-color: <?php echo esc_html( $color ); ?>;
	border: 1px solid <?php echo esc_html( $color ); ?>;
}
.ms-cat-link{
    color: <?php echo esc_html( $color ); ?>;
}
.logo-wrapper,
.logo-wrapper:hover{
	color: <?php echo esc_html( $color ); ?>;
}
.woocommerce-LoopProduct-link{
	color: <?php echo esc_html( $color ); ?>;
}
.bs-date i{
	color: <?php echo esc_html( $color ); ?>;
}
.bs-author-detail .bs-date a:hover{
    color: <?php echo esc_html( $color ); ?>;
}
.bs-cart-item a.button.wc-forward {
	background-color: <?php echo esc_html( $color ); ?>;
}
.mini_cart_item a{
	color: <?php echo esc_html( $color ); ?>;
}
.bs-date-detail .bs-date a:hover{ 
color: <?php echo esc_html( $color ); ?>;
}
.logged-in-as a{
	color: <?php echo esc_html( $color ); ?>;
}
.sidebar-widget .widget .btn-search{
	background-color: <?php echo esc_html( $color ); ?>;
}
.bs-widget .widget .btn-search{
	background-color: <?php echo esc_html( $color ); ?>;
}
.widget ul li a:hover{
    color: <?php echo esc_html( $color ); ?>;
}
.woocommerce-review-link{
	color: <?php echo esc_html( $color ); ?>;
}
.posted_in a{
	color: <?php echo esc_html( $color ); ?>;
}
.woocommerce div.product form.cart .button {
    background-color: <?php echo esc_html( $color ); ?>;
}
.woocommerce .onsale {
	background-color: <?php echo esc_html( $color ); ?> !important;
}
.woocommerce .onsale:after {
    border-left: 22px solid <?php echo esc_html( $color ); ?> ;
}
.woocommerce div.product .woocommerce-tabs ul.tabs li {
    background-color: <?php echo esc_html( $color ); ?> ;
}
.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover{
	 background-color: <?php echo esc_html( $color ); ?> ;
}
.woocommerce #reviews #comments ol.commentlist li img.avatar {
    border: 2px solid <?php echo esc_html( $color ); ?> ;
}
.related li:hover .woocommerce-LoopProduct-link {
    color: <?php echo esc_html( $color ); ?> !important;
}
.woocommerce ul.products li.product .button {
   background-color: <?php echo esc_html( $color ); ?> ;
}
.blog-more-link {
	 color: <?php echo esc_html( $color ); ?> !important;
    border:2px solid  <?php echo esc_html( $color ); ?> ;
}
.blog-more-link:hover {
    background-color: <?php echo esc_html( $color ); ?> ;
}
.pager .previous a:hover, .pager .next a:hover{
	background-color: <?php echo esc_html( $color ); ?> ;
}
.woocommerce-product-search input[type="submit"] {
    background-color: <?php echo esc_html( $color ); ?> ;
}
.star-rating span:before {
   color: <?php echo esc_html( $color ); ?> ;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
    background-color: <?php echo esc_html( $color ); ?> ;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{
    background-color: <?php echo esc_html( $color ); ?> ;
}
.woocommerce .widget_price_filter .price_slider_amount .button{
background-color: <?php echo esc_html( $color ); ?> ;
}
.woocommerce nav.woocommerce-pagination ul li a:focus,
 .woocommerce nav.woocommerce-pagination ul li a:hover, 
.woocommerce nav.woocommerce-pagination ul li span.current {
    background: <?php echo esc_html( $color ); ?> ;
}
.woocommerce a.button, .woocommerce button.button, .woocommerce input.button{
    background-color: <?php echo esc_html( $color ); ?> ;
}
.woocommerce-MyAccount-navigation ul {
    border: 1px solid <?php echo esc_html( $color ); ?> ;    
}
.woocommerce-MyAccount-navigation ul li a{
    color:<?php echo esc_html( $color ); ?> ;    
} 
.woocommerce-account .woocommerce-MyAccount-content a{
    color:<?php echo esc_html( $color ); ?> ;  
}
.woocommerce-account .woocommerce-MyAccount-content .woocommerce-Button{
background-color: <?php echo esc_html( $color ); ?> ;
}
.bs-menu-head .page_item:hover .dropdown-menu {
    background-color: <?php echo esc_html( $color ); ?> ;
}
.bs-menu-head .page_item:hover .dropdown-menu li a:hover{
    background-color: <?php echo esc_html( $color ); ?> ;
}
.woocommerce .coupon input[type=submit]{
     background-color: <?php echo esc_html( $color ); ?> ;
}
.wc-proceed-to-checkout .checkout-button {
    background-color: <?php echo esc_html( $color ); ?> !important;
}
.woocommerce .place-order .button.alt{
 background-color:  <?php echo esc_html( $color ); ?> !important;
}
.woocommerce-info::before,
.woocommerce-info a{
 color: <?php echo esc_html( $color ); ?> ;
}
.woocommerce-info {
    border-top-color: <?php echo esc_html( $color ); ?> ;
}
.widget .woocommerce-mini-cart__buttons .wc-forward{
background-color:  <?php echo esc_html( $color ); ?> !important;
}
.woocommerce-pagination .page-numbers li a {
    color:<?php echo esc_html( $color ); ?>;
}
.tagged_as a{
 color:<?php echo esc_html( $color ); ?>;
}
.sc-home-category .home-category {
    background-color:<?php echo esc_html( $color ); ?>;
}
.sc-services{
	background-color:<?php echo esc_html( $color ); ?>;
}
.widget div a {
    color:<?php echo esc_html( $color ); ?>;
}
.section-title{
     background-color:<?php echo esc_html( $color ); ?>; 
     border: 2px solid <?php echo esc_html( $color ); ?>;
}
</style>
<?php }

add_action( 'wp_head', 'tc_mega_stores_color_css',999);

// menu setup	
function tc_mega_stores_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'tc_mega_stores_page_menu_args' );

 
function tc_mega_stores_fallback_page_menu( $args = array() ) {

	$defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'wp_page_menu_args', $args );

	$menu = '';

	$list_args = $args;

	// Show Home in the menu
	if ( ! empty($args['show_home']) ) {
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = __('Home','tc-mega-stores');
		else
			$text = $args['show_home'];
		$class = '';
		if ( is_front_page() && !is_paged() )
			$class = 'class="current_page_item"';
		$menu .= '<li ' . $class . '><a href="' .   esc_url( home_url('/')) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}

	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$list_args['walker'] = new tc_mega_stores_walker_page_menu;
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );

	if ( $menu )
		$menu = '<ul class="'. esc_attr($args['menu_class']) .'">' . $menu . '</ul>';

	$menu = '<div class="' . esc_attr($args['container_class']) . '">' . $menu . "</div>\n";
	$menu = apply_filters( 'wp_page_menu', $menu, $args );
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
}
class tc_mega_stores_walker_page_menu extends Walker_Page{
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class='dropdown-menu'>\n";
	}
	function start_el( &$output, $page, $depth=0, $args = array(), $current_page = 0 ) {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		extract($args, EXTR_SKIP);
		$css_class = array('page_item', 'page-item-'.$page->ID);
		if ( !empty($current_page) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor';
			if ( $page->ID == $current_page )
				$css_class[] = 'current_page_item';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent';
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}

		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		$output .= $indent . '<li class="' . $css_class . '"><a href="' . esc_url(get_permalink($page->ID)) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';

		if ( !empty($show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;

			$output .= " " . mysql2date($date_format, $time);
		}
	}
}

class tc_mega_stores_nav_walker extends Walker_Nav_Menu {	
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		if ($args->has_children && $depth > 0) {
			$classes[] = 'dropdown dropdown-submenu';
		} else if($args->has_children && $depth === 0) {
			$classes[] = 'dropdown';
		}
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_url( $item->url        ) .'"' : '';	
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($args->has_children) ? '<i class="fa fa-angle-down"></i></a>' : '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];

		//display this element
		if ( is_array( $args[0] ) )
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		else if ( is_object( $args[0] ) ) 
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'start_el'), $cb_args);

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array($this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array($this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array($this, 'end_el'), $cb_args);
	}
}
function tc_mega_stores_nav_menu_css_class( $classes ) {
	if ( in_array('current-menu-item', $classes ) OR in_array( 'current-menu-ancestor', $classes ) )
		$classes[]	=	'active';

	return $classes;
}
add_filter( 'nav_menu_css_class', 'tc_mega_stores_nav_menu_css_class' );

/****--- Navigation ---***/
	function tc_mega_stores_navigation() { 
?>
	<div class="row navi">
		<ul class="pager">
			<li class="next"><?php next_posts_link(__('Older Entries &raquo;','tc-mega-stores')); ?></li>
			<li class="previous"><?php previous_posts_link(__('&laquo; Newer Entries ','tc-mega-stores')); ?></li>
		</ul>
	</div>
<?php }

// post/page navigation
function tc_mega_stores_link_pages(){
	$defaults = array(
		'before'           => '<p class="link-content">' . __( 'Pages:','tc-mega-stores' ),
		'after'            => '</p>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => __( 'Next page','tc-mega-stores'),
		'previouspagelink' => __( 'Previous page','tc-mega-stores'),
		'pagelink'         => '%',
		'echo'             => 1
	);
				wp_link_pages( $defaults );
}

function tc_mega_stores_post_link(){ 
	global $post; 
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
		<div class="row bs-pager">
		<ul class="pager">
			<li class="previous"><?php next_post_link( '%link', _x( '<i class="fa fa-angle-double-left"></i> New Post', 'Next post link', 'tc-mega-stores' ) ); ?></li>
			<li class="next"><?php previous_post_link( '%link', _x( 'Old Post <i class="fa fa-angle-double-right"></i>', 'Previous post link', 'tc-mega-stores' ) ); ?></li>
		</ul>
	</div>
	<?php }
	

require( get_template_directory() . '/inc/breadcrumbs.php' );

if ( ! function_exists( 'tc_mega_stores_comment' ) ){
require( get_template_directory() . '/comment-function.php' );
}

function tc_mega_stores_is_wc() {

	if (class_exists('WooCommerce')) {
		return true;
	} else {
		return false;
	}
}

function tc_mega_stores_cart_links(){
	?>
	<div class="sc-cart-nav">
	<i class="fa fa-shopping-bag"></i> <?php echo esc_html(number_format_i18n(WC()->cart->get_cart_contents_count())); ?> <span> <?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?></span>
	</div>
	<?php
}

function tc_mega_stores_mini_cart() {
	if (tc_mega_stores_is_wc()): ?>
	<div class="bs-pro-cart">
		<div class="bs-shop-cart">
			<span class="bs-shcrt">
				<?php tc_mega_stores_cart_links(); ?>
				<div class="bs-cart-item">
					<?php the_widget( 'WC_Widget_Cart', array('title' => '') ); ?>
				</div>
			</span>	
		</div>
	</div>
<?php endif;
}

function tc_mega_stores_cart_link_fragment( $fragments ) {
	ob_start();
	tc_mega_stores_cart_links();
	$fragments['div.sc-cart-nav'] = ob_get_clean();
	return $fragments;
}
add_filter('add_to_cart_fragments', 'tc_mega_stores_cart_link_fragment');