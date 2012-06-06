<article <?php post_class( array( 'entry', 'clearfix' ) ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</a>
		</figure>
	<?php endif; ?>

	<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

	<?php the_excerpt(); ?>

	<?php get_template_part( 'parts/parts-post-meta' ); ?>

</article><!-- / .article -->