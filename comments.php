	<div id="comments">
		<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php echo _e( 'This post is password protected. Enter the password to view any comments.' ); ?></p>
	</div><!-- #comments -->
	<?php
			return; // Stop the rest of comments.php from being processed.
		endif;
	?>

<?php if ( have_comments() ) : ?>

			<h3 class="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number() ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'mtf_comment', 'max-depth' => 3 ) ); ?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	if ( comments_open() && ! have_comments() ) : ?>
		<!--<h3 class="nocomments"><?php _e( 'Be the first to respond' ); ?></h3>-->
	<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php if ( ! comments_open() ) : ?>
	<p class="nocomments info">Comments are now closed.</p>
<?php endif; // end ! comments_open() ?>


<?php comment_form(); ?>

</div><!-- #comments -->
