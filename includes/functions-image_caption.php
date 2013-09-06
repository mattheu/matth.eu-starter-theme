<?php

/**
 * The Default WordPress image caption gets a width applied inline, with 10px of padding.
 * This should really be removed.
 *
 * TODO - would be nice to style it based on the size of image it contains - can I assign it the same class?
 *
 */
function mtf_cleaner_caption( $output, $attr, $content ) {

	//hm( $output );
	//hm( $attr );
	//hm( $content );
	//hm( get_intermediate_image_sizes() );
	//global $_wp_additional_image_sizes;
	//hm( $_wp_additional_image_sizes );
	
	if ( is_feed() )
		return $output;

	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	);
	$attr = shortcode_atts( $defaults, $attr );

	/* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
	if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
		return $content;

	$attributes = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="wp-caption ' . esc_attr( $attr['align'] ) . '"';

	$output = '<div' . $attributes .'>';
	$output .= do_shortcode( $content );
	$output .= '<p class="wp-caption-text">' . $attr['caption'] . '</p>';
	$output .= '</div>';

	return $output;
}
add_filter( 'img_caption_shortcode', 'mtf_cleaner_caption', 10, 3 );