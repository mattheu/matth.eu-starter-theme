<?php

if ( ! function_exists( 'the_post_format_image' ) ) {
	get_template_part( 'single/content' );
	return;
}

?>

<div class="entry-post-format entry-thumb">

	<?php the_post_format_image( 'large' ); ?>

</div>

<div class="entry-content">

	<?php the_content(); ?>

	<?php wp_link_pages( array( 'before' => '<div class="singular-pagination pagination-container"><div class="pagination">', 'after' => '</div></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

</div>