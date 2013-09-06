<?php

/**
 * Standard Page Template
 *
 * @package MPH Starter
 * @since 0.1.0
 */

get_header();

have_posts();

the_post();

?>

<div class="row">

	<section class="primary-content grid-8">

		<article <?php post_class( array( 'entry' ) ); ?>>

			<header class="entry-header">

			    <h1 class="entry-title"><?php the_title(); ?></h1>

			</header>

			<div class="entry-content">

				<?php the_content(); ?>

				<?php wp_link_pages( array( 'before' => '<div class="singular-pagination pagination-container"><div class="pagination">', 'after' => '</div></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

			</div>
		
		</article><!-- / .article -->

	</section><!-- / .primary-content -->

	<section class="sidebar grid-4" role="complementary">
		<?php get_sidebar(); ?>
	</section><!-- .secondary-content .widget-area -->

</div>

<?php get_footer(); ?>