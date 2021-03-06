<?php
function mtf_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :

		case '' :

	?>
	<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" data-authorname="<?php echo comment_author(); ?>" class="row">

			<div class="comment-info">
				<?php echo get_avatar( $comment, 50 ); ?>
			</div><!-- .comment-info -->

			<div class="comment-body">

				<div class="comment-header vcard">
					<b class="fn comment-author"><?php comment_author_link(); ?></b> <span class="said"><?php echo _e( 'said' ); ?></span>
					<a class="comment-date" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?>
					</a>
					<?php edit_comment_link( '(Edit)' ); ?>
				</div><!-- .comment_author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<div class="comment_meta commentmetadata">
						<p class="info"><em><?php _e( 'Your comment is awaiting moderation.' ); ?></em></p>
					</div><!-- .comment-meta .commentmetadata -->
				<?php endif; ?>

				<?php comment_text(); ?>

<div class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div><!-- .reply -->

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
