<?php

/**
 *
 *	The standard WordPress excerpt is pretty rubbish.
 *
 *	Better control of which tags to filter, and the length of the excerpt.
 *
 */

add_filter( 'mph_get_the_excerpt', 'mph_improved_trim_excerpt', 10, 3 );

function mph_the_excerpt( $length, $read_more = false ) {
	echo mph_get_the_excerpt( $length, $read_more );
}

function mph_get_the_excerpt( $length, $read_more = false ) {
	
	global $post;
	
	$output = $post->post_excerpt;
	if ( post_password_required($post) ) {
		$output = __('There is no excerpt because this is a protected post.');
		return $output;
	}

	return apply_filters( 'mph_get_the_excerpt', $output, $length, $read_more );
	
}

function mph_improved_trim_excerpt( $text, $length = 120, $read_more = false ) { // Fakes an excerpt if needed
  global $post;
    
  if ( '' == $text ) {
    $text = get_the_content('');
    $text = apply_filters('the_content', $text);
    $text = str_replace('\]\]\>', ']]&gt;', $text);
    $allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<span>,<blockquote>,<p>';
    $text = strip_tags($text, $allowed_tags);
    $excerpt_length = $length;
    $words = explode(' ', $text, $excerpt_length + 1);
    if (count($words)> $excerpt_length) {
      array_pop($words);
      array_push($words, '[...]');
      $text = implode(' ', $words);
      if( $read_more ){
 	     $text .= str_replace( '#', get_permalink( $post->ID ), $read_more ); 
      }
    }
   	if( strpos( $post->post_content, '<!--more-->' ) && $read_more )
		return $text . str_replace( '#', get_permalink( $post->ID ), $read_more ); 
  }
return $text;
}

