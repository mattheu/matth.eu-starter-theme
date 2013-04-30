<?php

/**
 * List the taxonomies that the current post is assigned to.
 *
 * Probably remove this for your site... 
 * I just don't like it when you can set things in the admin that don't do anything.
 */

$args = array(
	'before' => '<div class="entry-taxonomies">',
	'after' => '</div>',
	'template' => '<div class="entry-taxonomy-terms"><strong>%s:</strong> %l.</div>'
);

the_taxonomies( $args );

?>