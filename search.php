<?php 
	get_header();
?>

<section class="primary-content posts">	

	<div class="search-header loop-header">
	
		<h2 class="search-header-title loop-header-title">
			Search results for: <em>"<?php the_search_query(); ?>"</em>
		</h2>
	
	</div>
	
<?php if( ! have_posts() ) : ?>
			
	<article>
		<p class="info">There were no results for that search.</p>
	</article>
	
<?php

	else : 
	
		while ( have_posts() ) {
		
			the_post();
			
			if( $post_format = get_post_format() )
				get_template_part( 'loop/loop', $post_format );

			else
				get_template_part( 'loop/loop', get_post_type() );			
	
		}

		get_template_part( 'nav', 'pagination' ); 

	endif; 
	
?>

</section><!-- / .primary-content -->

<?php

	get_sidebar();
	
	get_footer();

?>