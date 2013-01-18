<article <?php post_class( array( 'entry', 'clearfix' ) ); ?>>

	<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <div class="entry-content">
		<?php the_excerpt(); ?>
    </div>

	<?php get_template_part( 'parts/parts-post-meta' ); ?>

</article><!-- / .article -->