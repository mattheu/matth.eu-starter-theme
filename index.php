<?php get_header(); ?>

<?php if( have_posts() ) : ?>

	<section class="primary-content posts">	
	
	<?php while( have_posts() ) : the_post()  ?>
	
		<article <?php post_class('clearfix'); ?>>
	    	
	    	<?php if ( has_post_thumbnail() ) : ?>

	   			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'mtf_medium_crop' ); ?></a>
	   			
	   			<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	   			
	   			<?php function_exists( 'mph_get_the_excerpt' ) ? mph_the_excerpt( '80', '<p><a href="#">Continue reading...</a></p>' ) : the_excerpt(); ?>

	    	<?php elseif( get_post_format() == 'quote' ) : ?>

	    		<?php the_content() ;?>

	    	<?php else : ?>

	    		<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>    		

	    		<?php function_exists( 'mph_get_the_excerpt' ) ? mph_the_excerpt( '150', '<p><a href="#">Continue reading...</a></p>' ) : the_excerpt(); ?>

	    	<?php endif; ?>

	    	<p class="post-meta"><small><b>Posted: </b><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?> by <?php the_author_posts_link(); ?></small></p>
	    
		</article>
	
	<?php endwhile; ?>
	
	<?php get_template_part( 'nav', 'pagination' ); ?>
	
	</section>

<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
