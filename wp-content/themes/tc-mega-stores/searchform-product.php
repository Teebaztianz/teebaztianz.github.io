<div class="search-box">
	<form role="search" method="get" id="search_mini_form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php 
					$sc_cat_dropdown_args = array(
						'taxonomy' 		   => 'product_cat',
						'show_option_all'  => esc_html__( 'All', 'tc-mega-stores'),
						'name'             => 'product_cat',
						'class'            => 'bgs-search-cats',
						'value_field'	   => 'slug',
						'selected'         => ( isset( $_GET['product_cat'] ) && $_GET['product_cat'] !== '' ) ? sanitize_text_field( wp_unslash( $_GET['product_cat'] ) ) : false,
					);
					wp_dropdown_categories( $sc_cat_dropdown_args );
				 ?>

		<input id="search" type="text" value="<?php the_search_query(); ?>" name="s" placeholder="<?php esc_attr_e('Search ','tc-mega-stores'); ?>" class="searchbox" maxlength="128">
		<input type="hidden" name="post_type" value="product">
		 <button type="submit" title="<?php esc_html_e('Search','tc-mega-stores'); ?>" class="search-btn-bg" id="submit-button">
			<span><?php esc_attr_e('Search ','tc-mega-stores'); ?></span>
		 </button>
	</form>
</div>