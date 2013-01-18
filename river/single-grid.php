<article <?php post_class( array( 'entry', 'clearfix' ) ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

   		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'small' ); ?></a>
		<h2 class="entry-title epsilon"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

	<?php else : ?>

		<h2 class="entry-title epsilon"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>

	<?php endif; ?>

</article><!-- / article -->
