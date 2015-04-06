<?php

// Hook in and add our own gallery output.
add_filter( 'post_gallery', 'mtf_gallery_default', 100, 2 );

/**
 * Output the first gallery in the post content.
 *
 * @return null
 */
function mtf_the_gallery() {
	$pattern = get_shortcode_regex();
	if ( preg_match( "/$pattern/s", get_the_content(), $match ) && 'gallery' == $match[2] ) {

		// Do the shortcode.
		// Filter args to set large size.
		add_filter( 'shortcode_atts_gallery', 'mtf_format_gallery_args' );
		echo do_shortcode_tag( $match );
		remove_filter( 'shortcode_atts_gallery', 'mtf_format_gallery_args' );

		// Strip the shortcode from the content.
		add_filter( 'the_content', 'mtf_the_gallery_strip' );

	}

}

function mtf_format_gallery_args( $attr ) {
	$attr['size']    = 'large';
	$attr['columns'] = 1;
	return $attr;
}

/**
 * Strip the first gallery from the post content.
 *
 * @return null
 */
function mtf_the_gallery_strip( $content ) {

	if ( is_single() && has_post_format( 'gallery' ) ) {
		$pattern = get_shortcode_regex();
		if ( preg_match( "/$pattern/s", get_the_content(), $match ) && 'gallery' == $match[2] )
			$content = str_replace( $match[0], '', $content );
	}

	return $content;

}

/**
 * Filter the Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function mtf_gallery_default( $content, $attr ) {

	static $instance = 0;
	$instance++;

	$attr        = mtf_gallery_shortcode_attr( $attr );
	$attachments = mtf_get_gallery_attachments( $attr );

	if ( empty( $attachments ) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag    = tag_escape( $attr['itemtag'] );
	$icontag    = tag_escape( $attr['icontag'] );
	$captiontag = tag_escape( $attr['captiontag'] );
	$columns    = intval( $attr['columns'] );
	$float      = is_rtl() ? 'right' : 'left';
	$id         = $attr['id'];
	$size_class = sanitize_html_class( $attr['size'] );

	$output = "<div id='gallery-{$instance}' class='gallery grid galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output .= '<div class="row">';

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

		$link = mtf_wp_get_attachment_link( $id, $attr['size'], false, false );

		$output .= sprintf( '<%s class="gallery-item">', $itemtag );
		$output .= sprintf( '<%1$s class="gallery-icon">%2$s</%1$s>', $icontag, $link );

		if ( $captiontag && trim( $attachment->post_excerpt ) ) {
			$output .= sprintf(
				'<%1$s class="wp-caption-text gallery-caption">%2$s</%1$s>',
				$captiontag,
				wptexturize( $attachment->post_excerpt )
			);
		}

		$output .= sprintf( '</%s>', $itemtag );

	}

	$output .= '</div>';
	$output .= '</div>';

	return $output;

}

/**
 * Parse Gallery Shortcode Attributes.
 *
 * @param  array gallery shortcode attributes
 * @return array gallery shortcode attributes
 */
function mtf_gallery_shortcode_attr( $attr ) {

	$attr = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => get_the_ID(),
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'ids'        => '',
		'include'    => '',
		'exclude'    => ''
	), $attr, 'gallery' );

	$id = intval( $attr['id'] );

	if ( ! empty( $ids ) ) {
		$attr['orderby'] = 'post__in';
		$attr['include'] = $ids;
	} else {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( 'RAND' == $attr['order'] ) {
			$attr['orderby'] = 'none';
		}
	}

	return $attr;

}

/**
 * Get gallery attachments.
 *
 * @param  array shortcode attributes
 * @return array shortcode attributes
 */
function mtf_get_gallery_attachments( $attr ) {

	if ( ! empty( $attr['include'] ) ) {

		$_attachments = get_posts( array(
			'include'        => $attr['include'],
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $attr['order'],
			'orderby'        => $attr['orderby']
		) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[ $val->ID ] = $_attachments[ $key ];
		}

	} elseif ( ! empty( $attr['exclude'] ) ) {

		$attachments = get_children( array(
			'post_parent'    => $attr['id'],
			'exclude'        => $attr['exclude'],
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $attr['order'],
			'orderby'        => $attr['orderby']
		) );

	} else {

		$attachments = get_children( array(
			'post_parent'    => $attr['id'],
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $attr['order'],
			'orderby'        => $attr['orderby']
		) );

	}

	return $attachments;

}

function mtf_wp_get_attachment_link( $id = 0, $size = 'thumbnail', $permalink = false, $icon = false, $text = false ) {

	$id    = intval( $id );
	$_post = get_post( $id );

	if ( empty( $_post ) || ( 'attachment' != $_post->post_type ) || ! $url = wp_get_attachment_url( $_post->ID ) ) {
		return __( 'Missing Attachment' );
	}

	// Max image size.
	if ( $permalink ) {
		$url = reset( wp_get_attachment_image_src( $_post->ID, array( 1500, 1500 ) ) );
	}

	$post_title = esc_attr( $_post->post_title );

	if ( $text ) {
		$link_text = $text;
	} elseif ( $size && 'none' != $size ) {
		$link_text = wp_get_attachment_image( $id, $size, $icon );
	} else {
		$link_text = '';
	}

	if ( trim( $link_text ) == '' ) {
		$link_text = $_post->post_title;
	}

	return apply_filters( 'wp_get_attachment_link', "<a href='$url' title='$post_title' rel='mtf-gallery'>$link_text</a>", $id, $size, $permalink, $icon, $text );

}
