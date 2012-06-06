<?php 

	get_header();  

	the_post();  
	
?>

<section class="primary-content entries">

	<article <?php post_class( array( 'entry' ) ); ?>>
			    	    
		<header class="entry-header">
		    <h1 class="entry-title"><?php the_title(); ?></h1>
		    <?php get_template_part( 'parts/parts-post-meta' ); ?>
	    </header>
		
		<?php if( has_post_thumbnail() ) : ?>
		    <figure class="entry-thumb">
			    <?php the_post_thumbnail( 'medium' ); ?>
		    </figure>
	    <?php endif; ?>
	    
	    <div class="entry-content">  
		<?php the_content(); ?>
	    </div>
	    
		<?php 
			$args = array(
				'before' => '<div class="entry-taxonomies">',
				'after' => '</div>',
				'template' => '<div class="entry-taxonomy-terms"><strong>%s:</strong> %l.</div>'
			);
			the_taxonomies( $args );
		?>

		<?php comments_template(); ?>
	
	</article><!-- / .article -->
	
</section><!-- / .primary-content -->

<?php 

	get_sidebar();

	get_footer(); 

?>