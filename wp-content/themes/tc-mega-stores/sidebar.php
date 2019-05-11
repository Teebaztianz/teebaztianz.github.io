<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TC Mega Stores
 */
?>

<div class="col-md-4 left-side">
<?php if ( is_active_sidebar( 'tc-mega-stores-sidebar' ) ){
	dynamic_sidebar( 'tc-mega-stores-sidebar' );
	} ?>
</div>
