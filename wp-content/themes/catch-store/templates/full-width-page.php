<?php
/*
 * Template Name: No Sidebar: Full Width
 *
 * Template Post Type: post, page
 *
 * The template for displaying Page/Post with No Sidebar, Full Width
 *
 * @package Catch_Store
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="singular-content-wrap">
            <?php
            // Start the loop.
            while ( have_posts() ) : the_post();
                
                $template = 'single';

                    if ( is_page() ) {
                        $template = 'page';
                    }

                // Include the single post content template.
                get_template_part( 'template-parts/content/content', $template );

                // Comments Templates
                get_template_part( 'template-parts/content/content', 'comment' );

                if ( is_singular( 'attachment' ) ) {
                    // Parent post navigation.
                    the_post_navigation( array(
                        'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'catch-store' ),
                    ) );
                } elseif ( is_singular( 'post' ) ) {
                    // Previous/next post navigation.
                    the_post_navigation( array(
                        'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'catch-store' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'catch-store' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . catch_store_get_svg( array( 'icon' => 'arrow-down' ) ) . '</span>%title</span>',
                        'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'catch-store' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'catch-store' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . catch_store_get_svg( array( 'icon' => 'arrow-down' ) ) . '</span></span>',
                    ) );
                }

                // End of the loop.
            endwhile;
            ?>
        </div><!-- .singular-content-wrap -->
    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
