<article <?php post_class( array( 'entry' ) ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
	<figure class="entry-thumb">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large' ); ?>
		</a>
	</figure>
	<?php endif; ?>

	<h3 class="entry-title">
		<a href="<?php the_permalink(); ?>">
			<i class="genericon genericon-<?php echo get_post_format(); ?>"></i>
			<?php the_title(); ?>
		</a>
	</h3>

	<?php get_template_part( 'parts/post-meta' ); ?>

</article><!-- / .article -->