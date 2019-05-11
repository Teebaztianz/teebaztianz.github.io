<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<div class="input-group">
		<input  type="search" name="s" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'shopbiz' ); ?>" class="form-control" value="<?php echo get_search_query(); ?>" title="<?php echo esc_attr_x( 'Search for:', 'label', 'shopbiz' ); ?>" required >
		<span class="input-group-btn">
			<button type="submit" class="btn" ><span class="fa fa-search"></span></button>
		</span> 
		<input type="hidden" name="post_type" value="product" /></div>
</form>