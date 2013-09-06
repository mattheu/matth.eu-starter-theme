<?php

/**
 * Default Generic Template File
 *
 * @package MPH Starter
 * @since 0.1.0
 */

get_header(); 

?>

<div class="row">

	<section class="primary-content grid-8">

		<?php get_template_part( 'parts/index/header' ); ?>

		<div class="entries">

			<?php

			if ( have_posts() ) {

				while ( have_posts() ) {

					the_post();
						
					if ( is_search() )
						get_template_part( 'parts/index/search-single' );

					elseif ( $post_format = get_post_format() )
						get_template_part( 'parts/index/single', $post_format );

					else
						get_template_part( 'parts/index/single', get_post_type() );

				}

			} else {

				get_template_part( 'parts/index/single-no-results' );

			}

			?>

		</div>

		<?php get_template_part( 'parts/nav-pagination' ); ?>

	</section><!-- / .primary-content -->

	<section class="sidebar grid-4" role="complementary">
		<?php get_sidebar(); ?>
	</section><!-- .secondary-content .widget-area -->

</div>

<?php get_footer(); ?>