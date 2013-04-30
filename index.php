<?php

get_header();

?>

<section class="primary-content">

	<?php get_template_part( 'river/single-header' ); ?>

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

<?php

get_sidebar();

get_footer();

?>