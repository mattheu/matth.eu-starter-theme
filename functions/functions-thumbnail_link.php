<?php

/**
 * Add extended options to the featured image meta box.
 * Should this thumbnail link to the source image ( eg may be displayed in lightbox)
 * 
 * @access public
 * @param mixed $content
 * @return void
 */
function mtf_thumbnail_options( $content ){	

	global $post_ID;

	$link_to_src = get_post_meta( $post_ID, 'mtf_thumbnail_link_to_src', true );
	$content .= '<p><input type="checkbox" name="mtf_thumbnail_link_to_src" id="mtf_thumbnail_link_to_src" value="1" ' . checked( $link_to_src, true, false ) . '> <label for="mtf_thumbnail_link_to_src">Link to larger version if available?</label>';
	return $content; 
	
}
add_filter( 'admin_post_thumbnail_html', 'mtf_thumbnail_options' );


/**
 * Save the thumbnail options. 
 */
function mtf_thumbnail_options_save(){

	if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) )
		return;

	if( ! post_type_supports( get_post_type(),  'post_thumbnail' ) )
		return; 

	if( isset( $_POST['mtf_thumbnail_link_to_src'] ) && $_POST['mtf_thumbnail_link_to_src'] ) {
		update_post_meta( get_the_id(), 'mtf_thumbnail_link_to_src', $_POST['mtf_thumbnail_link_to_src'] );
	} else {
		delete_post_meta( get_the_id(), 'mtf_thumbnail_link_to_src' );
	}
	
}
add_action( 'save_post', 'mtf_thumbnail_options_save' );