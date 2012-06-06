<?php

	get_header();

	the_post();

?>

<section class="primary-content entries">

	<article <?php post_class( array( 'entry' ) ); ?>>

		<header>
		    <h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

	    <div class="entry-content">
	        <?php the_content(); ?>
	    </div>

	</article><!-- / .article -->

</section><!-- / .primary-content -->

<?php

	get_sidebar();

	get_footer();

?>