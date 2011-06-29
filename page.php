<?php get_header();  ?>


<?php if( have_posts() ) : while( have_posts() ) : the_post();  ?>

<section id="main" class="posts">	

<article class="post v type-post status-publish format-standard hentry category-uncategorized post clearfix">
    	<h3 class="post_title"><?php the_title(); ?></h3>
    	<?php the_content(); ?>
</article>

</section>

<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>