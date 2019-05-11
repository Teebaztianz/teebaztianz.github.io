<?php
/**
 * The template for displaying author pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TC Mega Stores
 */

get_header();
$sidebar_position_home = get_theme_mod( 'tc_mega_stores_home_layout','right'); ?>
<!-- Blog Start -->
	<div class="container-fluid bs-margin bs-blogs">
		<div class="container">
			<div class="row bs-blog-page">
			<?php if($sidebar_position_home=='left'){
				get_sidebar();
			} ?>
				<div class="<?php if($sidebar_position_home=='full'){ echo 'col-md-12'; }else{ echo 'col-md-8'; } ?> right-side">
				<?php if ( have_posts() ){ ?>
				
				<?php while ( have_posts() ) : the_post();
				get_template_part('post','content');
				endwhile; ?>
				
				<?php }else{
					get_template_part('no','content');
				} 
				mega_stores_navigation(); ?>
				</div>
				<?php if($sidebar_position_home=='right'){
				get_sidebar();
			} ?>
			</div>
		</div>
	</div>
	<!-- Blog End -->
<?php
get_footer();
?>