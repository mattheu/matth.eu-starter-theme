<?php

	get_header();

	the_post();

?>

<section class="primary-content entries">

	<article <?php post_class( array( 'entry' ) ); ?>>

		<header>
		    <h1 class="post-title"><?php the_title(); ?></h1>
		</header>

	    <?php the_content(); ?>

	</article><!-- / .article -->

</section><!-- / .primary-content -->

<?php

	get_sidebar();

	get_footer();

?>