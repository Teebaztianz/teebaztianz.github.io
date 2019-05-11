<form role="search" method="get" class="searchform" action="<?php echo esc_url(home_url( '/' )); ?>"> 	
		<input type="text" placeholder="<?php esc_attr_e( 'What do you want to find?','tc-mega-stores'); ?>" value="<?php the_search_query(); ?>" id="s" name="s" class="form-control" required >
		<span class="input-group-btn">
		<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
	</span>
</form>