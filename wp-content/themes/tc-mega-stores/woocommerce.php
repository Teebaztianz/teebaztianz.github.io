<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tc-mega-stores
 */
get_header(); ?>
<!-- Blog Start -->
	<div class="container-fluid bs-margin ms-woocommerce">
		<div class="container">
			<div class="row ms-woocommerce-page">
				<div class="col-md-8 right-side">
				<?php 
                    if(is_shop()){
                        get_template_part('slider','shop');
                    }
                ?>
                <?php if ( have_posts() ) : ?>
                    <?php woocommerce_content(); ?>
                <?php endif; ?>
				</div>
			<?php get_sidebar('woocommerce'); ?>
			</div>
		</div>
	</div>
	<!-- Blog End -->
<?php
get_footer();
?>
