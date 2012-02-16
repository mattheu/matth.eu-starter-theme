<?php get_header(); the_post();  ?>

<section class="primary-content posts">	

	<article <?php post_class(); ?>>

	   	<h1 class="post-title"><?php the_title(); ?></h1>

	   	<?php the_content(); ?>

	</article>

</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>