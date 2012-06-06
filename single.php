<?php

	get_header();

	the_post();

?>

<section class="primary-content entries">

	<article <?php post_class( array( 'entry' ) ); ?>>

		<header class="post-header">
		    <h1 class="post-title"><?php the_title(); ?></h1>
		    <p class="post-meta"><small><b>Posted: </b><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> by <?php the_author_posts_link(); ?></small></p>
	    </header>

		<?php if ( has_post_thumbnail() ) : ?>
		    <figure class="post-thumb">
			    <?php the_post_thumbnail( 'medium' ); ?>
		    </figure>
	    <?php endif; ?>

	    <?php the_content(); ?>

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