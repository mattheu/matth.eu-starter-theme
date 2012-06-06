	<p class="post-meta"><small>

		<span class="post-date">
			<b>Posted: </b><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
		</span>

		<span class="post-author">
			by <?php the_author_posts_link(); ?>
		</span>
		
		<?php if ( comments_open() || ! comments_open() && have_comments() ) : ?>
			<span class="post-author">
				| <a href="<?php the_permalink(); ?>#comments">
					<?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number() ), number_format_i18n( get_comments_number() ) ); ?>
				</a>
			</span> 
		<?php endif; ?>

		<span class="post-permalink">
			| <a href="<?php the_permalink(); ?>">View Post</a>
		</span>

	</small></p>