<?php

	get_header();

	the_post();

?>

<section class="primary-content posts">

	<article <?php post_class(); ?>>

		<header>
		    <h1 class="post-title"><?php the_title(); ?></h1>
		</header>

	    <div class="post-content">
		    <?php the_content(); ?>
	    </div>

	</article><!-- / .article -->

</section><!-- / .primary-content -->

<?php

	get_sidebar();

	get_footer();

?>