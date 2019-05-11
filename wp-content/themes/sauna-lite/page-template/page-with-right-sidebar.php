<?php
/**
 * Template Name:Page with Right Sidebar
 */

get_header(); ?>

<?php do_action( 'sauna_lite_pageright_header' ); ?>

<div class="container">
    <div class="middle-align row">       
		<div class="col-md-8 col-sm-8" id="content-aa" >
			<?php while ( have_posts() ) : the_post(); ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>">
                <h1><?php the_title();?></h1>			
                <?php the_content();
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'sauna-lite' ),
                    'after'  => '</div>',
                ) );
                
                //If comments are open or we have at least one comment, load up the comment template
                	if ( comments_open() || '0' != get_comments_number() )
                    	comments_template();
                ?>
            <?php endwhile; // end of the loop. ?>
        </div>
        <div class="col-md-4 col-sm-4">
			<?php get_sidebar('page'); ?>
		</div>
        <div class="clear"></div>
    </div>
</div>

<?php do_action( 'sauna_lite_pageright_footer' ); ?>

<?php get_footer(); ?>