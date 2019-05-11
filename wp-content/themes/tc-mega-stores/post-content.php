<div class="row bs-blog">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="blog-detail">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="divider"></div>
				<ul class="bs-author-detail">
					<li class="bs-date">
						<?php esc_html_e('POSTED ON -','tc-mega-stores'); ?>  <a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('d'))); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
					</li>
					<li class="bs-author">
						 <?php esc_html_e('BY -','tc-mega-stores'); ?> 
						<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a>
					</li>
				</ul>
			<?php if(has_post_thumbnail()): ?>
				<div class="img-thumbnail">
					<?php $data= array('class' =>'img-responsive post_image'); 
					the_post_thumbnail('tc_mega_stores_thumb', $data); ?>
				</div>
			<?php endif; ?>
			<ul class="bs-category-detail">
			<?php if(get_the_category_list() != '') { ?>
				<li class="bs-category"><i class="fa fa-folder-open"></i> <?php the_category(','); ?> </li>
			<?php }if(get_the_tag_list()) { 
				the_tags('<li class="bs-tags"><i class="fa fa-tags"></i>',', ','</li>');
			} ?>
			</ul>
			<?php the_excerpt();
			if(get_post_type( get_the_ID()) !=='page'){ ?>
			<ul class="bs-author-detail">
				
				<li class="bs-comments">
					<?php $num_comments = get_comments_number(); // get_comments_number returns only a numeric value
					if ( comments_open() ) {
						if ( $num_comments == 0 ) {
							$comments = __('No Comments','tc-mega-stores');
						} elseif ( $num_comments > 1 ) {
							$comments = $num_comments . __(' Comments','tc-mega-stores');
						} else {
							$comments = __('1 Comment','tc-mega-stores');
						} ?>
						<a href="<?php echo esc_url(get_comments_link()); ?>"> <?php echo esc_attr($comments); ?></a>
					<?php } ?>
				</li>
			</ul>
			<a class="btn blog-more-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Continue Reading','tc-mega-stores'); ?> <i class="fa fa-long-arrow-right"></i></a>
			
			<?php } ?>
		</div>
	</div>
</div>
