<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package TC Mega Stores
 */

get_header(); 
?>
<!-- 404 Start -->
<div class="container-fluid bs-margin bs-404">
	<div class="container">
		<div class="row ep-error">
			<div class="col-md-8">
				<h1 class="error-title"><?php esc_html_e('404','tc-mega-stores'); ?> <span> <?php esc_html_e('Error','tc-mega-stores'); ?> </span></h1>
				<h3><?php esc_html_e('Content Not Found','tc-mega-stores'); ?></h3>
				<p><i class="fa fa-info-circle"></i> <?php esc_html_e('Oops! The page you requested was not found.','tc-mega-stores'); ?> </p>
				<a class="error-link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa fa-home"></i> <?php esc_html_e('Go To Home Page','tc-mega-stores'); ?></a>
			</div>
			<?php get_sidebar();?>
		</div>
	</div>
</div>
<!-- 404 End -->
<?php
get_footer();
