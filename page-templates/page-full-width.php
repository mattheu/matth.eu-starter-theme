<?php

/**
 * Full Width Page Template (no sidebar)
 * Template Name: Full Width
 *
 * @package MPH Starter
 * @since 0.1.6
 */

get_header();

?>

<div class="row">

	<section class="primary-content grid-12">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class( array( 'entry' ) ); ?>>

				<header class="entry-header">

				    <h1 class="entry-title"><?php the_title(); ?></h1>

				</header>

				<div class="entry-content">

					<?php the_content(); ?>

					<?php wp_link_pages( array( 'before' => '<div class="singular-pagination pagination-container"><div class="pagination">', 'after' => '</div></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

				</div>
			
			</article><!-- / .article -->

		<?php endwhile; ?>

	</section><!-- / .primary-content -->

</div>

<?php get_footer(); ?>