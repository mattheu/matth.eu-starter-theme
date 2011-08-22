<?php
if ( ! function_exists( 'mtf_comment' ) ) :
function mtf_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment_info">
				<div class="comment_author vcard">
					<?php 
						echo get_avatar( $comment, 60 ); 
					?>
					<?php printf( __( '%s <span class="says">says:</span>' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment_author .vcard -->
			</div><!-- .comment_info -->

		<div class="comment_body">
		
		<div class="comment_meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php /* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), ' ' );
			
				 if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
				<?php endif; ?>
			</div><!-- .comment-meta .commentmetadata -->
		
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
		<p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;	


function mtf_coment_form_fields($fields) {
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

