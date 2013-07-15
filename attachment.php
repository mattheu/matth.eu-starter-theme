<?php

get_header();

have_posts();

the_post();

?>

<div class="row">

	<section class="primary-content grid8">

		<article <?php post_class( array( 'entry' ) ); ?>>

			<?php if ( wp_attachment_is_image( get_the_ID() ) ) : ?>
				<figure class="entry-thumb full">
					<?php echo wp_get_attachment_image( get_the_id(), 'large' ); ?>
				</figure>
			<?php endif; ?>

			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<?php if ( ! wp_attachment_is_image( get_the_ID() ) ) : ?>
				<p class="download-link"><a href="<?php echo wp_get_attachment_url( get_the_id() ); ?>"> Download <?php echo basename( wp_get_attachment_url( get_the_id() ) ) ?></a></p>
			<?php endif; ?>

			<div class="attachment-excerpt lead-text"><?php the_excerpt(); ?></div>

			<div><?php the_content(); ?></div>

		</article>

	</section>

<?php endwhile; ?>

	<section class="secondary-content grid4" role="complementary">
		<?php get_sidebar(); ?>
	</section><!-- .secondary-content .widget-area -->

</div>

<?php get_footer(); ?>