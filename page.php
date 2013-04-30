<?php

	get_header();

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

			</div>
		
		</article><!-- / .article -->

	</section><!-- / .primary-content -->

	<section class="sidebar grid-4" role="complementary">
		<?php get_sidebar(); ?>
	</section><!-- .secondary-content .widget-area -->

</div>

<?php get_footer(); ?>