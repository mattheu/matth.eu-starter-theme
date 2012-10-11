<?php

	get_header();

	the_post();

?>

<section class="primary-content">

	<article <?php post_class( array( 'entry' ) ); ?>>

		<header class="entry-header">
		    <h1 class="entry-title"><?php the_title(); ?></h1>
		    <?php get_template_part( 'parts/parts-post-meta' ); ?>
	    </header>

		<?php get_template_part( 'single/thumbnail' ); ?>

	    <div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="singular-pagination pagination-container">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	    </div>

		<?php
			$args = array(
				'before' => '<div class="entry-taxonomies">',
				'after' => '</div>',
				'template' => '<div class="entry-taxonomy-terms"><strong>%s:</strong> %l.</div>'
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