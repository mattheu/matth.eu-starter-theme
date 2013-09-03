<?php 

/**
 * Comments List Template.
 *
 * @package MPH Starter
 * @since 0.1.0
 */

if ( ! comments_open() && ! have_comments() ) 
	return;

?>

<?php if ( post_password_required() ) : ?>
	<div id="comments">
		<p class="nopassword"><?php echo _e( 'This post is password protected. Enter the password to view any comments.' ); ?></p>
	</div><!-- #comments -->
<?php
	return; // Stop the rest of comments.php from being processed.
endif;
?>

<div id="comments">

<?php if ( have_comments() ) : ?>

	<h3 class="comments-title">
		<?php
			printf( 
				_n( 'One response to &ldquo;%2$s&rdquo;', '%1$s resposes  &ldquo;%2$s&rdquo;', get_comments_number(), 'twentyeleven' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' 
			);
		?>
	</h3>

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

	<?php

endif; // end have_comments() ?>

<?php if ( have_comments() && ! comments_open() ) : ?>
	<p class="nocomments info">Comments are now closed.</p>
<?php endif; // end ! comments_open() ?>

<?php comment_form(); ?>

</div><!-- #comments -->
