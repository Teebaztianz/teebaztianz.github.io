<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'shopbiz' ); ?></p>
<?php return; endif; ?>	
	
	<?php
		// code for comment
		if ( ! function_exists( 'shopbiz_commnet_function' ) ) {
		function shopbiz_commnet_function( $comment, $args, $depth ) 
		{
		$GLOBALS['comment'] = $comment;
		//get theme data
		global $comment_data;
		//translations
		$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : __('Reply','shopbiz');
	?>	
	
		<div <?php comment_class('media comment-box'); ?> id="comment-<?php comment_ID(); ?>">
           <div class="media-left">
			<a href="<?php esc_url(the_author_meta('user_url')); ?>">
				<?php echo get_avatar( get_the_author_meta( 'ID') , 150); ?>
			</a>
		   </div>
			<div class="media-body">
				<h4 class="media-heading"><?php comment_author(); ?></h4>
				<p class="small"><i class="fa fa-calendar"></i> <time datetime="2015-06-22T17:32:06+00:00" pubdate=""><?php echo comment_date('M j, Y') ?></time></a>
				<?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply,'depth' => $depth, 'max_depth' => $args['max_depth'], 'per_page' => $args['per_page']))) ?></p>
				<p><?php comment_text(); ?>&nbsp;</p>
				<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'shopbiz' ); ?></em>
				<br/>
				<?php endif; ?>
			</div>
	  </div>
	<?php } } ?>	
<?php if ( have_comments() ) { ?>
<div class="comment_section col-md-12 ta-comments">
	<div class="comment_title ta-heading-bor-bt"><h5><i class="fa fa-comments-o"></i> <?php comments_number('No Comments', '1 Comment','% Comments'); ?> </h5>
	</div>
	<?php wp_list_comments( array( 'callback' => 'shopbiz_commnet_function' ) ); ?>
</div> <!---comment_section--->

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'shopbiz' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'shopbiz' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'shopbiz' ) ); ?></div>
		</nav>
		<?php } elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) 
		{
        //_e("Comments Are Closed!!!",'shopbiz');
		?>
	<?php } 
	} ?>
	<?php if ('open' == $post->comment_status) { ?>
	<?php if ( get_option('comment_registration') && !$user_ID ) { ?>
<p><?php _e("You must be",'shopbiz'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e("logged in",'shopbiz')?></a> <?php _e("to post a comment",'shopbiz'); ?>
</p>
<?php } else {  ?>

<div class="col-md-12">
	<?php  
	 $fields=array(
		'author' => '<div class="row"><div class="col-md-6"><div class="control-group"><div class="controls"><input class="form-control" name="author" id="author" value="" placeholder="'.__('Name:','shopbiz').'" type="text"/></div></div></div>',
		'email' => '<div class="col-md-6"><div class="control-group"><div class="controls"><input class="form-control" name="email" id="email" value=""   type="email"  placeholder="'.__('Email:','shopbiz').'" ></div></div></div></div>',
		);
		function my_fields($fields) { 
			return $fields;
		}
		add_filter('comment_form_default_fields','my_fields');
			$defaults = array(
			'fields'=> apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'=> '<div class="row">
                  <div class="col-md-12"> 
                    <!-- Textarea -->
                    <div class="control-group">
                      <div class="controls">
			<textarea id="comments" rows="6" class="form-control" name="comment" placeholder="'.__('Message:','shopbiz').'"" type="text"></textarea></div></div></div></div>',		
			'logged_in_as' => '<p class="logged-in-as">' . __( "Logged in as ",'shopbiz' ).'<a href="'. admin_url( 'profile.php' ).'">'.$user_identity.'</a>'. '<a href="'. wp_logout_url( get_permalink() ).'" title="Log out of this account">'.__("Log out?",'shopbiz').'</a>' . '</p>',
			'id_submit'=> 'comment_btn1',
			'label_submit'=>__('Send Message','shopbiz'),
			'comment_notes_after'=> '',
			'comment_notes_before' => '',
			'title_reply'=> '<div class="ta-heading-bor-bt"><h5>'.__('Leave a Reply','shopbiz').'</h5></div>',
			'id_form'=> 'commentform'
			);
		comment_form($defaults);
	?>
</div>	
<?php } } ?>		