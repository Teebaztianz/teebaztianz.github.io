<?php
/**
 * The template for displaying search results pages.
 *
 * @package shopbiz
 */

get_header(); ?>
<!--==================== Breadcrumb ====================-->
<?php $search_image = get_theme_mod('search_image',get_template_directory_uri() . '/images/callout-back.jpg'); 
	  $search_overlay = get_theme_mod('shopbiz_overlay_search_color_control','');
?>
<div class="ta-breadcrumb-section" style="background:url(<?php echo esc_url($search_image);?>)" >
  <div class="overlay"  style="background-color:<?php echo esc_html($search_overlay);?>"> 
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="ta-breadcrumb-title">
            <h1>
              <?php the_title(); ?>
            </h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<main id="content">
  <div class="container">
    <div class="row">
      <div class="<?php echo ( !is_active_sidebar( 'sidebar_primary' ) ? '12' :'9' ); ?> col-md-9">
          <?php 
		global $i;
		if ( have_posts() ) : ?>
		<h2><?php printf( __( "Search Results for: %s", 'shopbiz' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
		<?php while ( have_posts() ) : the_post();  
		 get_template_part('content','');
		 endwhile; else : ?>
		<h2><?php _e( "Not Found", 'shopbiz' ); ?></h2>
		<div class="">
		<p><?php _e( "Sorry, Do Not match.", 'shopbiz' ); ?>
		</p>
		<?php get_search_form(); ?>
		</div><!-- .blog_con_mn -->
		<?php endif; ?>
      </div>
	  <aside class="col-md-3">
        <?php get_sidebar(); ?>
      </aside>
    </div>
  </div>
</main>
<?php
get_footer();
?>