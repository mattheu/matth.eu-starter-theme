<?php 

	get_header();

	if ( have_posts() ) : 

?>

	<section class="primary-content posts">	

	<div class="author-header loop-header">
	
		<figure class="loop-header-thumb">	
			<?php echo get_avatar( get_queried_object_id(), 130  ); ?>
		</figure>
		
    	<h2 class="loop-header-title">
    		<?php echo get_the_author_meta( 'display_name', get_queried_object_id() ); ?>
    	</h2>

    	<p><?php echo get_the_author_meta( 'description', get_queried_object_id() ); ?></p>

	
	</div>
	
	<?php 
	
		while ( have_posts() ) {
		
			the_post();
			
			if( $post_format = get_post_format() )
				get_template_part( 'loop/loop', $post_format );

			else
				get_template_part( 'loop/loop', get_post_type() );			
	
		}

		get_template_part( 'nav', 'pagination' ); 
		
	?>
	
	</section><!-- / .primary-content -->

<?php 

	endif; 

	get_sidebar();
	
	get_footer();

?>