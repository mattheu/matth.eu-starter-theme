<article <?php post_class( array( 'entry' ) ); ?>>

	<h3 class="entry-title">
		<a href="<?php the_permalink(); ?>">
			
			<?php if ( $format = get_post_format( ) ) : ?>
				<i class="genericon genericon-<?php echo $format; ?>"></i>
			<?php endif; ?>
			
			<?php the_title(); ?>
		
		</a>
	</h3>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</a>
		</figure>
	<?php endif; ?>

    <div class="entry-content">
		<?php the_excerpt(); ?>
    </div>

	<?php get_template_part( 'parts/post-meta' ); ?>

</article><!-- / .article -->