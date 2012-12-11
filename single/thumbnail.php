 <?php if ( has_post_thumbnail() && ( has_post_format( 'image' ) || has_post_format( 'gallery' ) ) ) : ?>

    <figure class="entry-thumb full">
	    <?php the_post_thumbnail( 'large' ); ?>
    </figure>

<?php elseif ( has_post_thumbnail() : ?>

    <figure class="entry-thumb">
	    <?php the_post_thumbnail( 'medium' ); ?>
    </figure>

<?php endif; ?>
