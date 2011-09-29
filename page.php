<?php get_header(); the_post();  ?>

<section class="primary_content posts">	

	<article <?php post_class(); ?>>

	   	<h1 class="post_title"><?php the_title(); ?></h1>

	   	<?php the_content(); ?>

	</article>

</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>