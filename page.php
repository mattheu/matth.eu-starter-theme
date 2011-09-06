<?php get_header();  ?>


<?php if( have_posts() ) : while( have_posts() ) : the_post();  ?>

<section class="main posts">	

<article <?php post_class(); ?>>
    	<h1 class="post_title"><?php the_title(); ?></h1>
    	<?php the_content(); ?>
</article>

</section>

<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>