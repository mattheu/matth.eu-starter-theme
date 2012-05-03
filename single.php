<?php 

	get_header();  

	the_post();  
	
?>

<section class="primary-content posts">	

	<article <?php post_class(); ?>>
			    	    
		<header class="post-header">
		    <h1 class="post-title"><?php the_title(); ?></h1>
		    <p class="post-meta"><small><b>Posted: </b><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> by <?php the_author_posts_link(); ?></small></p>
	    </header>
		
		<?php if( has_post_thumbnail() ) : ?>
		    <figure>
			    <?php the_post_thumbnail( 'medium' ); ?>
		    </figure>
	    <?php endif; ?>
	    
	    <?php the_content(); ?>
	
		<?php comments_template(); ?>
	
	</article><!-- / .article -->
	
</section><!-- / .primary-content -->

<?php 

	get_sidebar();

	get_footer(); 

?>