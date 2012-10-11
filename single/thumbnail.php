 <?php if ( has_post_format( 'image' ) && has_post_thumbnail() ) : ?>

    <figure class="entry-thumb full">
	    <?php the_post_thumbnail( 'large' ); ?>
    </figure>

<?php elseif ( has_post_format( 'gallery' ) && has_post_thumbnail() ) : ?>

	<?php $uri = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>

    <figure class="entry-thumb full">
	    <a href="<?php echo $uri[0]; ?>" rel="mtf-gallery">
	    	<?php the_post_thumbnail( 'large' ); ?>
	    </a>
    </figure>

<?php elseif ( has_post_thumbnail() ) : ?>

    <figure class="entry-thumb">
	    <?php the_post_thumbnail( 'medium' ); ?>
    </figure>

<?php endif; ?>
