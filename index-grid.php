<?php 

	get_header();

	if ( have_posts() ) : 

?>

	<section class="primary-content posts grid no-sidebar">	

		<?php 	

			while ( have_posts() ) {
	
				the_post();
				get_template_part( 'loop/loop-grid');
		
			}
	
			get_template_part( 'nav', 'pagination' ); 

		?>

	</section><!-- / .primary-content -->

<?php 

	endif; 

	get_footer();

?>