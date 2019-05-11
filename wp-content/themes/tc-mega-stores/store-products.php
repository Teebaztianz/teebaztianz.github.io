<?php 
/**
* Template part for displaying blog.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package TC Mega Stores
*/
$recent_display = get_theme_mod( 'tc_mega_stores_display_recent_setting', 0); 
$recent_heading = get_theme_mod( 'tc_mega_stores_heading_recent');
if($recent_display == 1){ ?>
<!-- Sale Product Start -->
<div class="container-fluid bs-margin ec-sale-products woocommerce">
	<div class="container">
		<div class="row ec-product">
		<?php if(tc_mega_stores_is_wc()){ ?>
			<div class="swiper-container sale-products">
			<?php if($recent_heading!==''){ ?>
				<div class="row section-heading">
					<h1 class="section-head">
						<b></b><span class="section-title"><?php echo esc_attr($recent_heading); ?></span><b></b>
					</h1>
				</div>
			<?php } ?>
				<div class="swiper-wrapper">
				<?php
				$query_args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => -1, 'orderby' =>'date','order' => 'DESC' );
				$products = new WP_Query( $query_args );
				$catorgies = array();
				while($products->have_posts()){
					$products->the_post();
					$cats = get_the_terms(get_the_ID(), 'product_cat');
					if($cats){
						foreach ($cats as $key => $cat) {
							$catorgies[$cat->slug] = $cat->name;
						}
					}
					wc_get_template_part( 'home-carousel-product' ); 
				}
				wp_reset_postdata();
			?>	
				</div>
				<div class="swiper-button-prev home-sale-prev"><i class="fa fa-angle-left"></i></div>
				<div class="swiper-button-next home-sale-next"><i class="fa fa-angle-right"></i></div>
			</div>
		<?php }else{ ?>
			<strong><?php esc_html_e('Please Activate the Woocommrece To display the Content','tc-mega-stores'); ?></strong>
		<?php } ?>
		</div>
	</div>
</div>	
<!-- Sale Product End -->
<?php } ?>