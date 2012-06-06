<?php get_header();  ?>

<?php while ( have_posts() ) : the_post();  ?>

<section class="primary-content entries">

	<article <?php post_class( array( 'entry' ) ); ?>>

    	<?php echo wp_get_attachment_image( get_the_id(), 'full' ); ?>

    	<?php the_content(); ?>

	</article>

</section>

<?php endwhile; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>