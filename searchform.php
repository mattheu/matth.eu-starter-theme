<?php

/**
 * Searchform Template
 *
 * @package MPH Starter
 * @since 0.1.0
 */

?>

<form role="search" method="get" class="search-form clearfix" action="<?php bloginfo( 'url' ); ?>">
	<div>
		<label class="screen-reader-text" for="s">
			<?php _e( 'Search for:', 'mtf' ); ?>
		</label>
		<input type="text" class="search-input" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search this site&hellip;', 'mtf' ); ?>">
		<input type="submit" class="search-submit btn" value="<?php _e( 'Search', 'mtf' ); ?>">
	</div>
</form>