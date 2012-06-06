<?php 

	get_header();

?>

	<section class="primary-content entries">

	<?php get_template_part( 'parts/loop-header' ); ?>
		
	<?php 
	
		if ( have_posts() ) {
	
			while ( have_posts() ) {
			
				the_post();
				
				if( $post_format = get_post_format() )
					get_template_part( 'parts/loop', $post_format );
			
				else
					get_template_part( 'parts/loop', get_post_type() );
			
			}
			
			get_template_part( 'nav', 'pagination' ); 
	
		} else {
		
			get_template_part( 'parts/loop-no-results' );
		
		}
		
	?>
	
	</section><!-- / .primary-content -->

<?php 

	get_sidebar();
	
	get_footer();

?>