<article <?php post_class('clearfix'); ?>>
	    	
	<?php the_content() ;?>
	
	<p class="post-meta"><small><b>Posted: </b><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> by <?php the_author_posts_link(); ?></small></p>
	    
</article><!-- / .article -->