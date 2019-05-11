<?php 
/**
 * Template part for displaying blog.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TC Mega Stores
 */
	$blog_display = get_theme_mod( 'tc_mega_stores_display_blog_setting', 1);
	//query posts
	$blog_args =	array(
		'offset'           => 0,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true
	);

	$blog_posts = new WP_Query( $blog_args );
	if($blog_display == 1){ 
	if($blog_posts->have_posts()) :
	$blog_count= 0; ?> 
<!-- Blog Start -->
<div class="container-fluid bs-margin bs-blogs">
	<div class="container">
		<div class="row section-heading">
			
			<?php if(get_theme_mod( 'tc_mega_stores_heading_blog')!=''){ ?>
			
			<h1 class="section-head"><b></b><span class="section-title"><?php echo esc_attr(get_theme_mod( 'tc_mega_stores_heading_blog')); ?></span><b></b></h1>
			<?php } ?>
		</div>
		<div class="row bs-home-blog">
                     <div id="bc-masonry">
		<?php while($blog_posts->have_posts()) : 
			$blog_posts->the_post();
			$blog_count++; ?>
            <div class="col-md-4 col-sm-4 bs-blog wow fadeInUp">
				<div class="blog-detail">
                                        <?php if ( has_post_thumbnail() ) { ?>
						<div class="img-thumbnail">
							<?php the_post_thumbnail( 'tc_mega_stores_general', array( 'class' => 'img-responsive' ) ); ?>
						</div>
					<?php } ?> 
                                        <div class="ms-home-blog">  
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="divider"></div>
					<ul class="bs-author-detail">
						<li class="bs-date">
							<?php esc_html_e('POSTED ON -','tc-mega-stores'); ?> <a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('d'))); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
						</li>
						<li class="bs-author">
							 <?php esc_html_e('BY -','tc-mega-stores'); ?> 
							<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a>
						</li>
					</ul>
					
					
					<?php the_excerpt(); ?>
					</div>
				</div>
			</div>
                      <?php if($blog_count%3==0){ echo '<div class="col-md-12"></div>'; }
			endwhile; ?>
                       </div>
		</div>
	</div>
</div>
<!-- Blog End -->
<?php endif;
	} ?>