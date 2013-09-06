<?php if ( is_search() ) : ?>

	<div class="loop-no-results">
		<p class="info"><?php _e( 'There were no results for that search.', 'mtf' ); ?></p>
	</div>

<?php elseif ( is_author() ) : ?>

	<div class="loop-no-results">
		<p><?php printf( __( '%s has not posted anything.', 'mtf' ), get_the_author() ); ?></p>
	</div>

<?php elseif ( is_category() ) : ?>

	<div class="loop-no-results">
		<p><?php printf( __( 'No entries in the category %s.', 'mtf' ), single_cat_title( '', false ) ); ?></p>
	</div>

<?php elseif ( is_tag() ) : ?>

	<div class="loop-no-results">
		<p><?php printf( 'No entries tagged %s.', 'mtf' ), single_tag_title( '', false ) ); ?></p>
	</div>

<?php else : ?>

	<div class="loop-no-results">
		<p><?php ( _e( 'No entries found.', 'mtf' ); ?></p>
	</div>

<?php endif; ?>
