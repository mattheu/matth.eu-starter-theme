<?php

// Grid view. - load grid template if grid view is set.
// @todo best to hook in on parse template or something and handle this.
// if ( isset( $_GET['view'] ) && 'grid' === $_GET['view'] ) {
// 	get_template_part( 'index-grid' );
// 	return;
// }

?>


<?php get_header(); ?>

<div class="row">

	<section class="primary-content grid-8">

		<?php get_template_part( 'river/header' ); ?>

		<div class="entries">

			<?php

			if ( have_posts() ) {

				while ( have_posts() ) {

					the_post();
					
					if ( is_search() )
						get_template_part( 'river/river-search' );

					elseif ( $post_format = get_post_format() )
						get_template_part( 'river/single', $post_format );

					else
						get_template_part( 'river/single', get_post_type() );

				}

			} else {

				get_template_part( 'river/single-no-results' );

			}

			?>

		</div>

		<?php get_template_part( 'parts/nav', 'pagination' ); ?>

	</section><!-- / .primary-content -->

	<section class="sidebar grid-4" role="complementary">
		<?php get_sidebar(); ?>
	</section><!-- .secondary-content .widget-area -->

</div>

<?php get_footer(); ?>