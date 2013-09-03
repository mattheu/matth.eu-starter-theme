<?php 

/**
 * Generic Grid Layout Template File
 * 
 * @package MPH Starter
 * @since 0.1.0
 */

global $wp_query;

get_header(); 

?>

<div class="row">

	<section class="primary-content grid-12">

		<?php get_template_part( 'index/single-header' ); ?>

		<div class="entries entries-grid row">

			<?php

			if ( have_posts() ) {

				while ( have_posts() ) {

					the_post();

					if ( $post_format = get_post_format() )
						get_template_part( 'index/single-grid', $post_format );

					else
						get_template_part( 'index/single-grid', get_post_type() );
					
					// Add clear div after every row.
					if ( 0 === ( $wp_query->current_post + 1 ) % 4 )
						echo '<div class="clear"></div>';

				}

			} else {

				get_template_part( 'index/single-no-results' );

			}

			?>

		</div>

		<?php get_template_part( 'parts/nav', 'pagination' ); ?>

	</section><!-- / .primary-content -->

</div>

<?php get_footer(); ?>