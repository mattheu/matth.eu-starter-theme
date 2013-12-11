<?php

if ( ! function_exists( 'the_post_format_audio' ) ) {
	get_template_part( 'parts/single/content' );
	return;
}

?>

<div class="entry-content">

	<?php if ( has_post_format( 'audio' ) ) : ?>

	<div class="entry-post-format">
		<?php the_post_format_audio(); ?>
	</div>

	<?php endif; ?>

	<?php the_content(); ?>

	<?php wp_link_pages( array( 'before' => '<div class="singular-pagination pagination-container"><div class="pagination">', 'after' => '</div></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	
</div>