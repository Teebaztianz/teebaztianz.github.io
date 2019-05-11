<?php
//about theme info
add_action( 'admin_menu', 'sauna_lite_gettingstarted' );
function sauna_lite_gettingstarted() {    	
	add_theme_page( esc_html__('Get Started', 'sauna-lite'), esc_html__('Get Started', 'sauna-lite'), 'edit_theme_options', 'sauna_lite_guide', 'sauna_lite_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function sauna_lite_admin_theme_style() {
   wp_enqueue_style( 'sauna-lite-font', sauna_lite_admin_font_url(), array() );
   wp_enqueue_style('custom-admin-style', get_template_directory_uri() . '/inc/dashboard/getstart.css');
   wp_enqueue_script('tabs', get_template_directory_uri() . '/inc/dashboard/js/tab.js');
}
add_action('admin_enqueue_scripts', 'sauna_lite_admin_theme_style');

// Theme Font URL
function sauna_lite_admin_font_url() {
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';

	$query_args = array(
		'family'	=> urlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}

//guidline for about theme
function sauna_lite_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'sauna-lite' );
?>

<div class="wrapper-info">  
    <div class="tab-sec">
		<div class="tab">
			<div class="logo">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/dashboard/images/logo.png" alt="" />
			</div>
			<button class="tablinks home" onclick="openCity(event, 'tc_index')"><?php esc_html_e( 'Free Theme Information', 'sauna-lite' ); ?></button>
		  	<button class="tablinks" onclick="openCity(event, 'tc_pro')"><?php esc_html_e( 'Premium Theme Information', 'sauna-lite' ); ?></button>
		  	<button class="tablinks" onclick="openCity(event, 'tc_create')"><?php esc_html_e( 'Theme Support', 'sauna-lite' ); ?></button>				
		</div>

		<div  id="tc_index" class="tabcontent">
			<h2><?php esc_html_e( 'Welcome to Sauna Theme', 'sauna-lite' ); ?> <span class="version">Version: <?php echo esc_html($theme['Version']);?></span></h2>
			<hr>
			<div class="info-link">
				<a href="<?php echo esc_url( SAUNA_LITE_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'sauna-lite' ); ?></a>
				<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'sauna-lite'); ?></a>
				<a href="<?php echo esc_url( SAUNA_LITE_DEMO_DATA ); ?>" target="_blank"><?php esc_html_e('Demo Data', 'sauna-lite'); ?></a>
				<a class="get-pro" href="<?php echo esc_url( SAUNA_LITE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get Pro', 'sauna-lite'); ?></a>
			</div>
			<div class="col-tc-6">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/dashboard/images/screen.png" alt="" />
			</div>
			<div class="col-tc-6">
				<P><?php esc_html_e( 'Sauna is a free WordPress theme for salons, spa, girly, hair, health, hospitality, beauty, care, massage, medical, parlor, physiotherapy, wellness, yoga, health blog and various types of business websites. This is specially built for sauna related websites. This theme is responsive and compatible with the latest version of WordPress.   Sauna Theme is cross browser compatible and performs well with any browser. This theme is well checked and improved for speed and faster page load time. Because of its secure and clean code, it gives a user-friendly customization experience. This translation ready responsive theme is well suited with well-known plugins like Contact form 7 and WooCommerce. Using customizer, it becomes very easy to manage the settings. It is developed keeping in mind the visitors engagement, therefore the Spa and Salon will help you to produce professional looking excellent websites. Comprising of about section, service section, testimonial section as well as the breadcrumbs, header phone number display and social media integration, this theme is unique in its own. Grab away this clean and highly simple Sauna theme for your health facility, health club, and sauna website. This theme is SEO friendly.', 'sauna-lite' ); ?></P>
			</div>
    	</div>

		<div id="tc_pro" class="tabcontent">
			<h3><?php esc_html_e( 'TC Sauna Theme Information', 'sauna-lite' ); ?></h3>
			<hr>
			<div class="pro-image">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/dashboard/images/resize.png" alt="" />
			</div>
			<div class="info-link-pro">
				<p><a href="<?php echo esc_url( SAUNA_LITE_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'Buy Now', 'sauna-lite' ); ?></a></p>
				<p><a href="<?php echo esc_url( SAUNA_LITE_LIVE_DEMO ); ?>" target="_blank"> <?php esc_html_e( 'Live Demo', 'sauna-lite' ); ?></a></p>
				<p><a href="<?php echo esc_url( SAUNA_LITE_PRO_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Pro Documentation', 'sauna-lite' ); ?></a></p>
			</div>
			<div class="col-pro-5">
				<h4><?php esc_html_e( 'TC Sauna Pro Theme', 'sauna-lite' ); ?></h4>
				<P><?php esc_html_e( 'The Sauna Spa WordPress theme is a newly launched, absolutely free theme developed precisely for spa, salon, parlor, wellness, beauty, physiotherapy, massage, health, and other types of hospitality businesses. This Premium Sauna WordPress Theme is entirely mobile responsive and doesnt offer compatibility issues with the latest WordPress versions. Its a cross-browser compatible Premium Spa WordPress Theme which performs excellently on different browsers. It features a variety of sections such as about us section, testimonial and service section. This Beauty WordPress theme has Header Phone number display, breadcrumbs, and social media integration. Also, being WooCommerce compatible, this Premium Spa WP Theme allows you to implement e-commerce functionality to your spa website with a very little effort. It offers faster page load time as it is built using secure and clean code. It allows you to manage the settings very easily using customizer. Grab this Best Sauna Spa WordPress theme now!', 'sauna-lite' ); ?></P>		
			</div>
			<div class="col-pro-6">				
				<h4><?php esc_html_e( 'Product Description', 'sauna-lite' ); ?></h4>
				<ul>
					<li><?php esc_html_e( 'Theme Options using Customizer API', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Responsive design', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Favicon, Logo, title and tagline customization', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Advanced Color options', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( '100+ Font Family Options', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Background Image Option', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Simple and Mega Menu Option', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Enable-Disable options on All sections', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Home Page setting for different sections', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Advance Slider with multiple effects and control options', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Pagination option', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Custom CSS option', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Translations Ready', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Parallax Image-Background Section', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Custom Backgrounds, Colors, Headers, Logo & Menu', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Customizable Home Page', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Full-Width Template', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Footer Widgets & Editor Style', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Gallery, Banner & Post Type Plugin Functionality', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Woo Commerce Compatible', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Multiple Inner Page Templates', 'sauna-lite' ); ?></li>
					<li><?php esc_html_e( 'Advance Social Media Feature', 'sauna-lite' ); ?></li>
				</ul>				
			</div>
		</div>	

		<div id="tc_create" class="tabcontent">
			<h3><?php esc_html_e( 'Support', 'sauna-lite' ); ?></h3>
			<hr>
			<div class="tab-cont">
		  		<h4><?php esc_html_e( 'Need Support?', 'sauna-lite' ); ?></h4>				
				<div class="info-link-support">
					<P><?php esc_html_e( 'Our team is obliged to help you in every way possible whenever you face any type of difficulties and doubts.', 'sauna-lite' ); ?></P>
					<a href="<?php echo esc_url( SAUNA_LITE_SUPPORT ); ?>" target="_blank"> <?php esc_html_e( 'Support Forum', 'sauna-lite' ); ?></a>
				</div>
			</div>
			<div class="tab-cont">	
				<h4><?php esc_html_e('Reviews', 'sauna-lite'); ?></h4>				
				<div class="info-link-support">
					<P><?php esc_html_e( 'It is commendable to have such a theme inculcated with amazing features and robust functionalities. I feel grateful to recommend this theme to one and all.', 'sauna-lite' ); ?></P>
					<a href="<?php echo esc_url( SAUNA_LITE_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'sauna-lite'); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>