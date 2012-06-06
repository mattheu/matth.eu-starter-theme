<?php

	get_header();

	the_post();

?>

<section class="primary-content posts">

	<article <?php post_class(); ?>>

		<header class="post-header">
		    <h1 class="post-title"><?php the_title(); ?></h1>
		    <?php get_template_part( 'loop/parts-post-meta' ); ?>
	    </header>

		<?php if ( has_post_thumbnail() ) : ?>
		    <figure class="post-thumb">
			    <?php the_post_thumbnail( 'medium' ); ?>
		    </figure>
	    <?php endif; ?>

	  	<div class="post-content">
		    <?php the_content(); ?>
	  	</div>

		<?php
			$args = array(
				'before' => '<div class="post-taxonomies">',
				'after' => '</div>',
				'template' => '<div class="post-taxonomy-terms"><strong>%s:</strong> %l.</div>'
			);
			the_taxonomies( $args );
		?>

		<?php comments_template(); ?>

	</article><!-- / .article -->

</section><!-- / .primary-content -->

<?php

	get_sidebar();

	get_footer();

?>