<?php
function mtf_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :

		case '' :

	?>
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-info">
				<?php echo get_avatar( $comment, 50 ); ?>
			</div><!-- .comment-info -->

		<div class="comment-body">

			<div class="comment-header vcard">
				<cite class="fn"><?php comment_author_link(); ?></cite> <span class="said"><?php echo _e( 'said' ); ?></span>
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?>
				</a>
				<?php edit_comment_link( '(Edit)' ); ?>
			</div><!-- .comment_author .vcard -->
		
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<div class="comment_meta commentmetadata">				 
					<em><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
				</div><!-- .comment-meta .commentmetadata -->
			<?php endif; ?>
		
			<?php comment_text(); ?>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->

		</div>

	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	
	<li class="post pingback">
		<p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( '(Edit)', ' ' ); ?></p>
	<?php
			break;
	endswitch;
}


function mtf_coment_form_fields( $fields ) {
	$commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' . 
                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    $fields['email']  = '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' . 
                '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    $fields['url']    = '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
                '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
    return $fields; 
}
add_filter('comment_form_default_fields','mtf_coment_form_fields' );

function mtf_coment_form_modifications( $defaults ) {
    $defaults['comment_notes_after'] = ' ';
    return $defaults; 
}
add_filter( 'comment_form_defaults', 'mtf_coment_form_modifications' );

