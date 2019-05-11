<?php
/**
 * Sauna Lite functions and definitions
 *
 * @package Sauna Lite
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'sauna_lite_setup' ) ) :

/* Theme Setup */
function sauna_lite_setup() {

	$GLOBALS['content_width'] = apply_filters( 'sauna_lite_content_width', 640 );
	
	load_theme_textdomain( 'sauna-lite', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	add_image_size('sauna-lite-homepage-thumb',240,145,true);
	
       register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sauna-lite' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'f1f1f1'
	) );

	/*
	* Enable support for Post Formats.
	*
	* See: https://codex.wordpress.org/Post_Formats
	*/
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	
	add_editor_style( array( 'css/editor-style.css', sauna_lite_font_url() ) );

	// Dashboard Theme Notification
	global $pagenow;
	
	if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
		add_action( 'admin_notices', 'sauna_lite_activation_notice' );
	}	
}
endif;
add_action( 'after_setup_theme', 'sauna_lite_setup' );

// Dashboard Theme Notification
function sauna_lite_activation_notice() {
	echo '<div class="welcome-notice notice notice-success is-dismissible">';
		echo '<h2>'. esc_html__( 'Thank You!!!!!', 'sauna-lite' ) .'</h2>';
		echo '<p>'. esc_html__( 'Much grateful to you for choosing our sauna theme from themescaliber. we praise you for opting our services over others. we are obliged to invite you on our welcome page to render you with our outstanding services.', 'sauna-lite' ) .'</p>';
		echo '<p><a href="'. esc_url( admin_url( 'themes.php?page=sauna_lite_guide' ) ) .'" class="button button-primary">'. esc_html__( 'Click Here...', 'sauna-lite' ) .'</a></p>';
	echo '</div>';
}

/* Theme Widgets Setup */
function sauna_lite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'sauna-lite' ),
		'description'   => __( 'Appears on blog page sidebar', 'sauna-lite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'sauna-lite' ),
		'description'   => __( 'Appears on page sidebar', 'sauna-lite' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Thrid Column Sidebar', 'sauna-lite' ),
		'description'   => __( 'Appears on page sidebar', 'sauna-lite' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 1', 'sauna-lite' ),
		'description'   => __( 'Appears on footer', 'sauna-lite' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 2', 'sauna-lite' ),
		'description'   => __( 'Appears on footer', 'sauna-lite' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 3', 'sauna-lite' ),
		'description'   => __( 'Appears on footer', 'sauna-lite' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 4', 'sauna-lite' ),
		'description'   => __( 'Appears on footer', 'sauna-lite' ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'sauna_lite_widgets_init' );

function sauna_lite_font_url() {
	$font_url = '';
	$font_family = array();
	$font_family[] = 'PT Sans:300,400,600,700,800,900';
	$font_family[] = 'Roboto:400,700';
	$font_family[] = 'Roboto Condensed:400,700';
	$font_family[] = 'Open Sans';
	$font_family[] = 'Overpass';
	$font_family[] = 'Montserrat:300,400,600,700,800,900';
	$font_family[] = 'Playball:300,400,600,700,800,900';
	$font_family[] = 'Alegreya:300,400,600,700,800,900';
	$font_family[] = 'Julius Sans One';
	$font_family[] = 'Arsenal';
	$font_family[] = 'Slabo';
	$font_family[] = 'Lato';
	$font_family[] = 'Overpass Mono';
	$font_family[] = 'Source Sans Pro';
	$font_family[] = 'Raleway';
	$font_family[] = 'Merriweather';
	$font_family[] = 'Droid Sans';
	$font_family[] = 'Rubik';
	$font_family[] = 'Lora';
	$font_family[] = 'Ubuntu';
	$font_family[] = 'Cabin';
	$font_family[] = 'Arimo';
	$font_family[] = 'Playfair Display';
	$font_family[] = 'Quicksand';
	$font_family[] = 'Padauk';
	$font_family[] = 'Muli';
	$font_family[] = 'Inconsolata';
	$font_family[] = 'Bitter';
	$font_family[] = 'Pacifico';
	$font_family[] = 'Indie Flower';
	$font_family[] = 'VT323';
	$font_family[] = 'Dosis';
	$font_family[] = 'Frank Ruhl Libre';
	$font_family[] = 'Fjalla One';
	$font_family[] = 'Oxygen';
	$font_family[] = 'Arvo';
	$font_family[] = 'Noto Serif';
	$font_family[] = 'Lobster';
	$font_family[] = 'Crimson Text';
	$font_family[] = 'Yanone Kaffeesatz';
	$font_family[] = 'Anton';
	$font_family[] = 'Libre Baskerville';
	$font_family[] = 'Bree Serif';
	$font_family[] = 'Gloria Hallelujah';
	$font_family[] = 'Josefin Sans';
	$font_family[] = 'Abril Fatface';
	$font_family[] = 'Varela Round';
	$font_family[] = 'Vampiro One';
	$font_family[] = 'Shadows Into Light';
	$font_family[] = 'Cuprum';
	$font_family[] = 'Rokkitt';
	$font_family[] = 'Vollkorn';
	$font_family[] = 'Francois One';
	$font_family[] = 'Orbitron';
	$font_family[] = 'Patua One';
	$font_family[] = 'Acme';
	$font_family[] = 'Satisfy';
	$font_family[] = 'Josefin Slab';
	$font_family[] = 'Quattrocento Sans';
	$font_family[] = 'Architects Daughter';
	$font_family[] = 'Russo One';
	$font_family[] = 'Monda';
	$font_family[] = 'Righteous';
	$font_family[] = 'Lobster Two';
	$font_family[] = 'Hammersmith One';
	$font_family[] = 'Courgette';
	$font_family[] = 'Permanent Marker';
	$font_family[] = 'Cherry Swash';
	$font_family[] = 'Cormorant Garamond';
	$font_family[] = 'Poiret One';
	$font_family[] = 'BenchNine';
	$font_family[] = 'Economica';
	$font_family[] = 'Handlee';
	$font_family[] = 'Cardo';
	$font_family[] = 'Alfa Slab One';
	$font_family[] = 'Averia Serif Libre';
	$font_family[] = 'Cookie';
	$font_family[] = 'Chewy';
	$font_family[] = 'Great Vibes';
	$font_family[] = 'Coming Soon';
	$font_family[] = 'Philosopher';
	$font_family[] = 'Days One';
	$font_family[] = 'Kanit';
	$font_family[] = 'Shrikhand';
	$font_family[] = 'Tangerine';
	$font_family[] = 'IM Fell English SC';
	$font_family[] = 'Boogaloo';
	$font_family[] = 'Bangers';
	$font_family[] = 'Fredoka One';
	$font_family[] = 'Bad Script';
	$font_family[] = 'Volkhov';
	$font_family[] = 'Shadows Into Light Two';
	$font_family[] = 'Marck Script';
	$font_family[] = 'Sacramento';
	$font_family[] = 'Unica One';

	$query_args = array(
		'family'	=> urlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}
	
/* Theme enqueue scripts */
function sauna_lite_scripts() {
	wp_enqueue_style( 'sauna-lite-font', sauna_lite_font_url(), array() );	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css' );
	wp_enqueue_style( 'sauna-lite-basic-style', get_stylesheet_uri() );
	wp_style_add_data( 'sauna-lite-style', 'rtl', 'replace' );
	wp_enqueue_style( 'sauna-lite-effect', get_template_directory_uri().'/css/effect.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/fontawesome-all.css' );
	wp_enqueue_style( 'css-nivo-slider', get_template_directory_uri().'/css/nivo-slider.css' );

	// Paragraph
	    $sauna_lite_paragraph_color = get_theme_mod('sauna_lite_paragraph_color', '');
	    $sauna_lite_paragraph_font_family = get_theme_mod('sauna_lite_paragraph_font_family', '');
	    $sauna_lite_paragraph_font_size = get_theme_mod('sauna_lite_paragraph_font_size', '');
	// "a" tag
		$sauna_lite_atag_color = get_theme_mod('sauna_lite_atag_color', '');
	    $sauna_lite_atag_font_family = get_theme_mod('sauna_lite_atag_font_family', '');
	// "li" tag
		$sauna_lite_li_color = get_theme_mod('sauna_lite_li_color', '');
	    $sauna_lite_li_font_family = get_theme_mod('sauna_lite_li_font_family', '');
	// H1
		$sauna_lite_h1_color = get_theme_mod('sauna_lite_h1_color', '');
	    $sauna_lite_h1_font_family = get_theme_mod('sauna_lite_h1_font_family', '');
	    $sauna_lite_h1_font_size = get_theme_mod('sauna_lite_h1_font_size', '');
	// H2
		$sauna_lite_h2_color = get_theme_mod('sauna_lite_h2_color', '');
	    $sauna_lite_h2_font_family = get_theme_mod('sauna_lite_h2_font_family', '');
	    $sauna_lite_h2_font_size = get_theme_mod('sauna_lite_h2_font_size', '');
	// H3
		$sauna_lite_h3_color = get_theme_mod('sauna_lite_h3_color', '');
	    $sauna_lite_h3_font_family = get_theme_mod('sauna_lite_h3_font_family', '');
	    $sauna_lite_h3_font_size = get_theme_mod('sauna_lite_h3_font_size', '');
	// H4
		$sauna_lite_h4_color = get_theme_mod('sauna_lite_h4_color', '');
	    $sauna_lite_h4_font_family = get_theme_mod('sauna_lite_h4_font_family', '');
	    $sauna_lite_h4_font_size = get_theme_mod('sauna_lite_h4_font_size', '');
	// H5
		$sauna_lite_h5_color = get_theme_mod('sauna_lite_h5_color', '');
	    $sauna_lite_h5_font_family = get_theme_mod('sauna_lite_h5_font_family', '');
	    $sauna_lite_h5_font_size = get_theme_mod('sauna_lite_h5_font_size', '');
	// H6
		$sauna_lite_h6_color = get_theme_mod('sauna_lite_h6_color', '');
	    $sauna_lite_h6_font_family = get_theme_mod('sauna_lite_h6_font_family', '');
	    $sauna_lite_h6_font_size = get_theme_mod('sauna_lite_h6_font_size', '');


		$custom_css ='
			p,span{
			    color:'.esc_html($sauna_lite_paragraph_color).'!important;
			    font-family: '.esc_html($sauna_lite_paragraph_font_family).'!important;
			    font-size: '.esc_html($sauna_lite_paragraph_font_size).'!important;
			}
			a{
			    color:'.esc_html($sauna_lite_atag_color).'!important;
			    font-family: '.esc_html($sauna_lite_atag_font_family).';
			}
			li{
			    color:'.esc_html($sauna_lite_li_color).'!important;
			    font-family: '.esc_html($sauna_lite_li_font_family).';
			}
			h1{
			    color:'.esc_html($sauna_lite_h1_color).'!important;
			    font-family: '.esc_html($sauna_lite_h1_font_family).'!important;
			    font-size: '.esc_html($sauna_lite_h1_font_size).'!important;
			}
			h2{
			    color:'.esc_html($sauna_lite_h2_color).'!important;
			    font-family: '.esc_html($sauna_lite_h2_font_family).'!important;
			    font-size: '.esc_html($sauna_lite_h2_font_size).'!important;
			}
			h3{
			    color:'.esc_html($sauna_lite_h3_color).'!important;
			    font-family: '.esc_html($sauna_lite_h3_font_family).'!important;
			    font-size: '.esc_html($sauna_lite_h3_font_size).'!important;
			}
			h4{
			    color:'.esc_html($sauna_lite_h4_color).'!important;
			    font-family: '.esc_html($sauna_lite_h4_font_family).'!important;
			    font-size: '.esc_html($sauna_lite_h4_font_size).'!important;
			}
			h5{
			    color:'.esc_html($sauna_lite_h5_color).'!important;
			    font-family: '.esc_html($sauna_lite_h5_font_family).'!important;
			    font-size: '.esc_html($sauna_lite_h5_font_size).'!important;
			}
			h6{
			    color:'.esc_html($sauna_lite_h6_color).'!important;
			    font-family: '.esc_html($sauna_lite_h6_font_family).'!important;
			    font-size: '.esc_html($sauna_lite_h6_font_size).'!important;
			}

			';
		wp_add_inline_style( 'sauna-lite-basic-style',$custom_css );

	wp_enqueue_script( 'jquery-nivo-slider', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );	
	wp_enqueue_script( 'sauna-lite-customscripts', get_template_directory_uri() . '/js/custom.js', array('jquery') );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/* Enqueue the Dashicons script */
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style('sauna-lite-ie', get_template_directory_uri().'/css/ie.css', array('sauna-lite-basic-style'));
	wp_style_add_data( 'sauna-lite-ie', 'conditional', 'IE' );
}
add_action( 'wp_enqueue_scripts', 'sauna_lite_scripts' );

//Theme Url
define('SAUNA_LITE_FREE_THEME_DOC','https://themescaliber.com/doc/free-tc-sauna/','sauna-lite');
define('SAUNA_LITE_SUPPORT','https://wordpress.org/support/theme/sauna-lite/','sauna-lite');
define('SAUNA_LITE_REVIEW','https://www.themescaliber.com/topic/reviews-and-testimonials','sauna-lite');
define('SAUNA_LITE_BUY_NOW','https://www.themescaliber.com/premium/sauna-spa-wordpress-theme','sauna-lite');
define('SAUNA_LITE_LIVE_DEMO','https://www.themescaliber.com/sauna-theme/','sauna-lite');
define('SAUNA_LITE_PRO_DOC','https://themescaliber.com/doc/tc-sauna-pro/','sauna-lite');
define('SAUNA_LITE_CHILD_THEME','https://developer.wordpress.org/themes/advanced-topics/child-themes/','sauna-lite');
define('SAUNA_LITE_DEMO_DATA','https://www.themescaliber.com/doc/sauna-demo.xml.zip','sauna-lite');
define('SAUNA_LITE_CREDIT','https://www.themescaliber.com','sauna-lite');

if ( ! function_exists( 'sauna_lite_credit' ) ) {
	function sauna_lite_credit(){
		echo "<a href=".esc_url(SAUNA_LITE_CREDIT)." target='_blank'>". esc_html__('ThemesCaliber','sauna-lite'). "</a>";
	}
}

/*radio button sanitization*/
 function sauna_lite_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/* Customizer additions. */
require get_template_directory() . '/inc/customizer.php';

/* Customizer additions. */
require get_template_directory() . '/inc/custom-header.php';

/* Implement the get started page */
require get_template_directory() . '/inc/dashboard/getstart.php';