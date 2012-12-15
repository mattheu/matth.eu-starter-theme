<article <?php post_class( array( 'entry', 'clearfix' ) ); ?>>

	<h3 class="entry-title link-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

	<?php the_content() ;?>

	<?php get_template_part( 'parts/parts-post-meta' ); ?>

</article><!-- / .article -->