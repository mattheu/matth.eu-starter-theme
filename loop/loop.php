<article <?php post_class('clearfix'); ?>>
			
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="post-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</a>
		</figure>
	<?php endif; ?>
	
	<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	
	<?php the_excerpt(); ?>	
	
	<p class="post-meta"><small><b>Posted: </b><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> by <?php the_author_posts_link(); ?></small></p>
		
</article><!-- / .article -->