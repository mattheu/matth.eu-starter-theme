<?php get_header();  ?>


<?php if( have_posts() ) : while( have_posts() ) : the_post();  ?>

<section id="main" class="posts">	

<article <?php post_class(); ?>>
    	
    	<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'mtf_medium' ); } ?>
    	<h3 class="post_title"><?php the_title(); ?></h3>
    	<?php the_content(); ?>

<div class="clear"></div>
<?php comments_template(); ?>

</article>

</section>

<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>