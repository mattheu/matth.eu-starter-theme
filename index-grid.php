<?php get_header();  ?>

<section class="primary-content posts grid">

	<?php while( have_posts() ) : the_post()  ?>

	<article <?php post_class('clearfix'); ?>>

    	<?php if ( has_post_thumbnail() ) : ?>

	   		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'mtf_small' ); ?></a>
   			<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    	<?php elseif ( get_post_format() == 'quote' ) : ?>

   			<?php the_excerpt(); ?>

    	<?php else : ?>

    		<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
   			<?php the_excerpt(); ?>

    	<?php endif; ?>

	    <p class="post-meta"><small><b>Posted: </b><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?> by <?php the_author_posts_link(); ?></small></p>

	</article>

	<?php endwhile; ?>

	<?php get_template_part( 'nav', 'pagination' ); ?>

</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>