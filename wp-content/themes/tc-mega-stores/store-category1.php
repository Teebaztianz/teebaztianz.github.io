<?php 
/**
* Template part for displaying blog.
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package TC Mega Stores
*/
if(tc_mega_stores_is_wc()){ 
$display_col1 = get_theme_mod('tc_mega_stores_display_coll1_setting',0); 
$product_cat1 = get_theme_mod('tc_mega_stores_product_cat1',''); 
if($display_col1==1 && $product_cat1!=''){ ?>
<?php 
  $cat_data1 = get_term_by('slug', $product_cat1, 'product_cat');
  $cat_name1 = $cat_data1->name;
  $cat_id1 = $cat_data1->term_id;
?>
<!-- Collection Mens Start -->
<?php $query_args = array('post_type' => 'product', 'posts_per_page' => -1, 'product_cat' => $product_cat1);
$products = new WP_Query( $query_args ); ?>
<div class="container-fluid bs-margin bs-collection woocommerce">
	<div class="container">
		<div class="row bs-collect">
			<div class="col-md-4 col-sm-4 bs-cat-pics bs-mens">
			<?php $cat_thumb_id1 = get_woocommerce_term_meta( $cat_id1, 'thumbnail_id', true );
					$shop_catalog_img1 = wp_get_attachment_image_src( $cat_thumb_id1, 'shop_catalog' );
					$term_link1 = get_term_link( $product_cat1, 'product_cat' );
					if($shop_catalog_img1!=''){ ?>
				<div class="img-thumbnail">
					<img class="img-responsive" src="<?php echo esc_url($shop_catalog_img1[0]); ?>" alt="<?php echo esc_attr($cat_name1); ?>" />
					<div class="overlay">
						<div class="col-offer">
                                                      <h2 class="col-title"><a href="<?php echo esc_url($term_link1); ?>"> <?php echo esc_attr($cat_name1); ?></a></h2>
                                                      <a class="ms-cat-link" href="<?php echo esc_url($term_link1); ?>">Shop Now</a>
                                                </div>
					</div>
				</div>
					<?php } ?>
				
			</div>
			<div class="col-md-8 col-sm-8 bs-cat-slider">
				<div class="swiper-container collect-products">
					<div class="swiper-wrapper">
					<?php while($products->have_posts()){
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
					<div class="swiper-button-prev home-collect-prev"><i class="fa fa-angle-left"></i></div>
					<div class="swiper-button-next home-collect-next"><i class="fa fa-angle-right"></i></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Collection Mens Start -->
<?php }
$display_col2 = get_theme_mod('tc_mega_stores_display_coll2_setting',0); 
$product_cat2 = get_theme_mod('tc_mega_stores_product_cat2',''); 
if($display_col2==1 && $product_cat2!=''){
  $cat_data2 = get_term_by('slug', $product_cat2, 'product_cat');
  $cat_name2 = $cat_data2->name;
  $cat_id2 = $cat_data2->term_id;
?>
<!-- Collection WoMens Start -->
<?php $query_args = array('post_type' => 'product', 'posts_per_page' => -1, 'product_cat' => $product_cat2);
$products = new WP_Query( $query_args ); ?>
<div class="container-fluid bs-margin bs-collection woocommerce">
	<div class="container">
		<div class="row bs-collect">
			<div class="col-md-4 col-sm-4 bs-cat-pics bs-womens">
			<?php $cat_thumb_id2 = get_woocommerce_term_meta( $cat_id2, 'thumbnail_id', true );
					$shop_catalog_img2 = wp_get_attachment_image_src( $cat_thumb_id2, 'shop_catalog' );
					$term_link2 = get_term_link( $product_cat2, 'product_cat' );
					if($shop_catalog_img2!=''){ ?>
				<div class="img-thumbnail">
					<img class="img-responsive" src="<?php echo esc_url($shop_catalog_img2[0]); ?>" alt="<?php echo esc_attr($cat_name2); ?>" />
					<div class="overlay">
						<div class="col-offer">
                                                  <h2 class="col-title"><a href="<?php echo esc_url($term_link2); ?>"> <?php echo esc_attr($cat_name2); ?></a></h2>
                                                  <a class="ms-cat-link" href="<?php echo esc_url($term_link2); ?>">Shop Now</a>
                                                </div>
					</div>
				</div>
					<?php } ?>
				
			</div>
			<div class="col-md-8 col-sm-8 bs-cat-slider">
				<div class="swiper-container collect-products">
					<div class="swiper-wrapper">
					<?php while($products->have_posts()){
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
					<div class="swiper-button-prev home-collect-prev"><i class="fa fa-angle-left"></i></div>
					<div class="swiper-button-next home-collect-next"><i class="fa fa-angle-right"></i></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Collection WoMens Start -->
<?php } } ?>