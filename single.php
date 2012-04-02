<?php get_header();  ?>


<?php if( have_posts() ) : while( have_posts() ) : the_post();  ?>

<section class="primary-content posts">	

<article <?php post_class(); ?>>
    	    
	<?php the_post_thumbnail( 'mtf_medium' ); ?>

    <h1 class="post-title"><?php the_title(); ?></h1>
    
    <?php the_content(); ?>

	<?php comments_template(); ?>

</article><!-- / .article -->

</section><!-- / .primary-content -->

<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>