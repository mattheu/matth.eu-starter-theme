<?php if ( is_search() ) : ?>
			
	<div class="loop-no-results">
		<p class="info">There were no results for that search.</p>
	</div>

<?php elseif ( is_author() ) : ?>

	<div class="loop-no-results">
		<p><?php echo get_the_author(); ?> has not posted anything.</p>
	</div>

<?php elseif ( is_category() ) : ?>

	<div class="loop-no-results">
		<p>No entries in the category <?php echo single_cat_title( '', false ); ?>.</p>
	</div>

<?php elseif ( is_tag() ) : ?>

	<div class="loop-no-results">
		<p>No entries tagged <?php echo single_tag_title( '', false ); ?>.</p>
	</div>
	
<?php else : ?>

	<div class="loop-no-results">
		<p>No entries found.</p>
	</div>

<?php endif; ?>
