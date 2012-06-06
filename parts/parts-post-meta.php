	<p class="entry-meta"><small>

		<span class="entry-date">
			<b>Posted: </b><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
		</span>

		<span class="entry-author">
			by <?php the_author_posts_link(); ?>
		</span>

		<?php if ( comments_open() || ! comments_open() && have_comments() ) : ?>
			<span class="entry-author">
				| <a href="<?php the_permalink(); ?>#comments">
					<?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number() ), number_format_i18n( get_comments_number() ) ); ?>
				</a>
			</span>
		<?php endif; ?>

		<span class="entry-permalink">
			| <a href="<?php the_permalink(); ?>">View Post</a>
		</span>

	</small></p>