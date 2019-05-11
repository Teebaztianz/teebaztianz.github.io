<?php
/**
 * The template for displaying the content.
 * @package shopbiz
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="ta-blog-post-box"> 
		<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="ta-blog-thumb">
		  <?php if(has_post_thumbnail()): ?>
		  <?php $defalt_arg =array('class' => "img-responsive"); ?>
		  <?php the_post_thumbnail('', $defalt_arg); ?>
		  <span class="ta-blog-date"> <span class="h3"><?php echo esc_attr(get_the_date('j')); ?></span> 
			  <span><?php echo esc_attr(get_the_date('M')); ?></span>
		  </span> 
	      <?php endif; ?> 
	    </a>
		<article class="small">
			<h2><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?> </a> </h2>
			<div class="ta-blog-category"> 
				<a href="#"><i class="fa fa-folder"></i>
					<?php   $cat_list = get_the_category_list(); if(!empty($cat_list)) { ?>
					<?php the_category(', '); ?>
				</a> <?php } ?>
				<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><i class="fa fa-user"></i> <?php _e('by','shopbiz'); echo " "; the_author(); ?>
				</a> 
			</div>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="link">' . __('Pages:', 'shopbiz' ), 'after' => '</div>' ) ); ?>
		</article>
	</div>
</div>