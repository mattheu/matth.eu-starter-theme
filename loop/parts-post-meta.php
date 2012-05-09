	<p class="post-meta"><small>
		<span class="post-date">
			<b>Posted: </b><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
		</span>
		<span class="post-author">
			by <?php the_author_posts_link(); ?>
		</span> 
		<span class="post-permalink">
			| <a href="<?php the_permalink(); ?>">View Post</a>
		</span>
	</small></p>