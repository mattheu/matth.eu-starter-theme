<?php

/**
 * Style Guide Home Page
 * Template Name: Style Guide - Home
 *
 * @package MPH Starter
 * @since 0.1.6
 */

get_header();

have_posts();

the_post();

?>

<div class="row">

	<section class="primary-content grid-12">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class( array( 'entry' ) ); ?>>

				<header class="entry-header">

				    <h1 class="entry-title"><?php the_title(); ?></h1>

				</header>

				<div class="entry-content">

					<?php wp_list_pages( 'child_of=' . get_the_id() . '&title_li=' ); ?>

				</div>
			
			</article><!-- / .article -->

		<?php endwhile; ?>
		
	</section><!-- / .primary-content -->

</div>

<?php get_footer(); ?>