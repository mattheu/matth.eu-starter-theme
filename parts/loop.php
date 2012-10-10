<article <?php post_class( array( 'entry', 'clearfix' ) ); ?>>

	<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</a>
		</figure>
	<?php endif; ?>

    <div class="entry-content">
		<?php the_excerpt(); ?>
    </div>

	<?php get_template_part( 'parts/parts-post-meta' ); ?>

</article><!-- / .article -->