<?php
/**
 * @package Rich Store Lite
 */
?>
<div class="richstore_default_poststyle">
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>

     <?php 
        if (has_post_thumbnail() ){
			echo '<div class="thumbnail_box">';
            the_post_thumbnail();
			echo '</div>';
		}
        ?>  
 		   
    <header class="entry-header">        
        <?php the_title( '<h3 class="single-title">', '</h3>' ); ?>
         <div class="postmeta">
            <div class="post-date"><?php the_date(); ?></div><!-- post-date -->                    
        </div><!-- postmeta -->
    </header><!-- .entry-header -->    
      

    <div class="entry-content">		
        <?php the_content(); ?>
        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'rich-store-lite' ),
            'after'  => '</div>',
        ) );
        ?>
        <div class="postmeta">          
            <div class="post-tags"><?php the_tags(); ?> </div>
            <div class="clear"></div>
        </div><!-- postmeta -->
    </div><!-- .entry-content -->
   
    <footer class="entry-meta">
      <?php edit_post_link( __( 'Edit', 'rich-store-lite' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->

</article>
</div><!-- .richstore_default_poststyle-->