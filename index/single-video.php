<?php

if ( ! function_exists( 'get_post_format_meta' ) ) {
	get_template_part( 'river/single' );
	return;
}

?>

<article <?php post_class( array( 'entry' ) ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<figure class="entry-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'large' ); ?>
			</a>
		</figure>
	
	<?php elseif ( function_exists( 'get_the_post_format_media' ) && $video = get_the_post_format_media( 'video' ) ) : ?>

		<div class="entry-thumb">
			<?php echo $video; ?>
		</div>

	<?php endif; ?>

	<h3 class="entry-title">
		<a href="<?php the_permalink(); ?>">
			<i class="genericon genericon-<?php echo get_post_format(); ?>"></i>
			<?php the_title(); ?>
		</a>
	</h3>

	<?php get_template_part( 'parts/post-meta' ); ?>

</article><!-- / .article -->