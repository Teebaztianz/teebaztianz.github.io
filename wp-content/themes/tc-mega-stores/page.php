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
 * @package TC Mega Stores
 */

get_header(); 
$sidebar_position = get_theme_mod( 'tc_mega_stores_post_layout','right'); ?>
<!-- Blog Start -->
	<div class="container-fluid bs-margin bs-blogs">
		<div class="container">
			<div class="row bs-blog-page">
			<?php if($sidebar_position=='left'){
				get_sidebar();
			} ?>
				<div class="<?php if($sidebar_position=='full'){ echo 'col-md-12'; }else{ echo 'col-md-8'; } ?> right-side">
				<?php if ( have_posts() ) : 
				while ( have_posts() ) : the_post(); ?>
					<div class="row bs-blog">
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="blog-detail">
								<?php if(has_post_thumbnail()): ?>
									<div class="img-thumbnail">
										<?php $data= array('class' =>'img-responsive post_image'); 
										the_post_thumbnail('tc_mega_stores_thumb', $data); ?>
									</div>
								<?php endif; ?>
								<h2 class="entry-title"><?php the_title(); ?></h2>
								<?php the_content();
								tc_mega_stores_link_pages(); ?>
							</div>
							<?php if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif; ?>
						</div>
					</div>
					<?php endwhile;
					endif; ?>
				</div>
				<?php if($sidebar_position=='right'){
				get_sidebar();
			} ?>
			</div>
		</div>
	</div>
	<!-- Blog End -->
<?php
get_footer();
?>