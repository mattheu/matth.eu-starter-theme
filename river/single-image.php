<article <?php post_class( array( 'entry', 'clearfix' ) ); ?>>

	<figure class="entry-thumb">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large' ); ?>
		</a>
	</figure>	

	<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

	<?php get_template_part( 'parts/parts-post-meta' ); ?>

</article><!-- / .article -->