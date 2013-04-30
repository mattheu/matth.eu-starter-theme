<?php

// Hook in and add our own gallery output.
add_filter( 'post_gallery', 'mtf_gallery_default', 100, 2 );

/**
 * Output the first gallery in the post content.
 * 
 * @return null
 */
function mph_the_gallery() {
	$pattern = get_shortcode_regex();
	if ( preg_match( "/$pattern/s", get_the_content(), $match ) && 'gallery' == $match[2] ) {

		add_filter( 'shortcode_atts_gallery', 'mph_format_gallery_args' );
		echo do_shortcode_tag( $match );
		remove_filter( 'shortcode_atts_gallery', 'mph_format_gallery_args' );
	
	}
}

function mph_the_gallery_strip( $content ) {
	
	if ( is_single() && has_post_format( 'gallery' ) ) {
		$pattern = get_shortcode_regex();
		if ( preg_match( "/$pattern/s", get_the_content(), $match ) && 'gallery' == $match[2] )
			$content = str_replace( $match[0], '', $content );
	}

	return $content;

}
add_filter( 'the_content', 'mph_the_gallery_strip' );

function mph_format_gallery_args( $attr ) {
	$attr['size'] = 'large';
	return $attr;
}

/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function mtf_gallery_default( $content, $attr ) {

	if ( $content !== '' )
		return $content;

	static $instance = 0;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract( shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => get_the_id(),
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'ids'        => '',
		'include'    => '',
		'exclude'    => ''
	), $attr, 'gallery' ) );

	$id = intval($id);
	
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( ! empty( $ids ) ) {
		// 'ids' is explicitly ordered
		$orderby = 'post__in';
		$include = $ids;
	}

	if ( ! empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	$size_class = sanitize_html_class( $size );
	$gallery_div  = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$gallery_div .= '<div class="row">';
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

		$link = mtf_wp_get_attachment_link($id, $size, false, false );

		$output .= "<{$itemtag} class='gallery-item'>";
		
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		
		$output .= "</{$itemtag}>";
	}

	$output .= "</div>\n";
	$output .= "</div>\n";

	return $output;
}

function mtf_wp_get_attachment_link( $id = 0, $size = 'thumbnail', $permalink = false, $icon = false, $text = false ) {
	$id = intval( $id );
	$_post = get_post( $id );

	if ( empty( $_post ) || ( 'attachment' != $_post->post_type ) || ! $url = wp_get_attachment_url( $_post->ID ) )
		return __( 'Missing Attachment' );

	// Max image size.
	if ( $permalink )
		$url = reset( wp_get_attachment_image_src( $_post->ID, array( 1500, 1500 ) ) );

	$post_title = esc_attr( $_post->post_title );

	if ( $text )
		$link_text = $text;
	elseif ( $size && 'none' != $size )
		$link_text = wp_get_attachment_image( $id, $size, $icon );
	else
		$link_text = '';

	if ( trim( $link_text ) == '' )
		$link_text = $_post->post_title;

	return apply_filters( 'wp_get_attachment_link', "<a href='$url' title='$post_title' rel='mtf-gallery'>$link_text</a>", $id, $size, $permalink, $icon, $text );
}