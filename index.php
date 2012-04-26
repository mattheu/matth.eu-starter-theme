<?php 

	get_header();

	if ( have_posts() ) : 

?>

	<section class="primary-content posts">	
	
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