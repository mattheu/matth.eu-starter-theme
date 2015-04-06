<?php

/**
 * The Default WordPress image caption gets a width applied inline, with 10px of padding.
 * This should really be removed.
 *
 * TODO - would be nice to style it based on the size of image it contains - can I assign it the same class?
 *
 */
function mtf_cleaner_caption( $output, $attr, $content ) {

	if ( is_feed() ) {
		return $output;
	}

	$attr = shortcode_atts(
		array(
			'id' => '',
			'align' => 'alignnone',
			'width' => '',
			'caption' => ''
		),
		$attr
	);

	// If the width is less than 1 or there is no caption,
	// return the content wrapped between the [caption] tags.
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
