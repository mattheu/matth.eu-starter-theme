<div class="entry-content">

	<?php if ( has_post_format( 'audio' ) ) : ?>

	<div class="entry-post-format">
		<?php the_post_format_audio(); ?>
	</div>

	<?php endif; ?>

	<?php the_content(); ?>

	<?php wp_link_pages( array( 'before' => '<div class="singular-pagination pagination-container">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

</div>