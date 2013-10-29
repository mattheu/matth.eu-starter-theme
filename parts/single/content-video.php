<?php

if ( ! function_exists( 'the_post_format_video' ) ) {
	get_template_part( 'parts/single/content' );
	return;
}

?>

<div class="entry-post-format">

	<?php the_post_format_video(); ?>

</div>

<div class="entry-content">

	<?php the_content(); ?>

	<?php wp_link_pages( array( 'before' => '<div class="singular-pagination pagination-container"><div class="pagination">', 'after' => '</div></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

</div>