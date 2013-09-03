<div class="entry-post-format">

	<?php mph_the_gallery(); ?>

</div>

<div class="entry-content">

	<?php the_content(); ?>

	<?php wp_link_pages( array( 'before' => '<div class="singular-pagination pagination-container"><div class="pagination">', 'after' => '</div></div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

</div>