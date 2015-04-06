<article <?php post_class( array( 'entry', 'grid-3' ) ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

   		<div class="entry-thumb">
   			<a href="<?php the_permalink(); ?>">
   				<?php the_post_thumbnail( 'thumbnail' ); ?>
   			</a>
   		</div>

	<?php else : ?>

		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php the_excerpt(); ?>

	<?php endif; ?>

</article><!-- / article -->
