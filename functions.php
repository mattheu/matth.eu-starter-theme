<?php

//Update Script
require_once( get_template_directory() . '/updates/update.php' );

/**
 *
 * 		== More Functions & Plugins ==
 *
 * 		* Split off some of the more complicated theme functions. 
 * 		* Core Plugins - to be loaded directly the theme. (can't be disabled)
 *
 */
require_once( 'plugins/better_excerpt.php' );
require_once( 'functions-comments.php' );


/**
 *	Enqueue all scripts & styles
 *  Register & Enqueue separately to allow for deregistering them from a child theme.
 */
function mtf_assets(){

	if ( !is_admin() ) { 
		
		//jQuery by google.
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', null, '1.4.2', true );
		wp_enqueue_script( 'jquery' );

		wp_enqueue_style( 'reset' );		
		wp_enqueue_style( 'type' );		
				
		wp_enqueue_script( 'formalize' );
		wp_enqueue_style ( 'formalize' );
						
		wp_enqueue_style( 'mtf_forms' );
		wp_enqueue_style( 'mtf_style' );

		wp_enqueue_script( 'fancybox');
		wp_enqueue_style( 'fancybox');
		
		//Wordpress + Page specific scripts
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}
	
		//My js scripts.
		wp_register_script( 'mtf_scripts', get_bloginfo( 'template_directory' ) . '/js/scripts.js', 'jquery', '1.0.0', true );	
		wp_enqueue_script( 'mtf_scripts' );
			
	}
	
}
add_action( 'wp_enqueue_scripts', 'mtf_assets' );
	

function mtf_remove_default_sizes( $sizes ) {

	unset( $sizes['thumbnail'] );
	unset( $sizes['medium'] );
	unset( $sizes['large'] );
	
	return( $sizes );

}
//add_action( 'intermediate_image_sizes', 'mtf_remove_default_sizes' );

/**
 * mtf_setup.
 * Setup everything this theme needs. 
 */
function mtf_setup() {

	register_nav_menus(
		array(
		  'mtf_menu_main' => 'Main Menu',
		  'mtf_menu_foot' => 'Footer Menu'
		)
	);

	register_sidebar( array(
		'name' => __( 'Main Sidebar Top', 'mtf_secondary_top' ),
		'id' => 'mtf_secondary_top',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Main Sidebar Bottom', 'mtf_secondary_bottom' ),
		'id' => 'mtf_secondary_bottom',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	add_theme_support( 'post-formats', array( 'image', 'link', 'gallery', 'status', 'quote' ) );
	add_theme_support( 'post-thumbnails' );

	if ( function_exists( 'add_image_size' ) ) { 
	
		add_image_size( 'mtf_thumbnail', 140, 140, true );
		add_image_size( 'mtf_small', 220, 165, true ); 
		add_image_size( 'mtf_medium', 380, 999, false ); 
		add_image_size( 'mtf_medium_crop', 380, 285, true ); 
		add_image_size( 'mtf_large', 540, 9999, false ); 
		add_image_size( 'mtf_banner', 960, 350, false ); 
	
	}
	
   	//Load my misc js plugins 		
    wp_register_script( 'mtf_plugins', get_bloginfo( 'template_directory' ) . '/js/plugins.js', 'jquery', '1.0.0', true );	
	wp_enqueue_script( 'mtf_plugins' );
    		
    //Reset/boilerplate and base typography.
    wp_register_style( 'reset', get_bloginfo( 'template_directory' ) . '/css/boilerplate.css' );	
    wp_register_style( 'type', get_bloginfo( 'template_directory' ) . '/css/type_12-18.css' );		

    //Formalize. Fixes everything that is wrong with forms. 
    wp_register_script( 'formalize', get_bloginfo( 'template_directory' ) . '/js/formalize/assets/js/jquery.formalize.min.js', 'jquery', '1.0.0', true );	
    wp_register_style ( 'formalize', get_bloginfo( 'template_directory' ) . '/js/formalize/assets/css/formalize.css' );	
    
    // Enqueue the main style at the end. 
    wp_register_style( 'mtf_forms', get_bloginfo( 'template_directory' ) . '/css/forms.css' );	
    wp_register_style( 'mtf_style', get_bloginfo( 'template_directory' ) . '/style.css' );	

    //Fancybox
    wp_register_script( 'fancybox', get_bloginfo( 'template_directory' ) . '/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.js', 'jquery', '1.3.4', true );	
    wp_register_style ( 'fancybox', get_bloginfo( 'template_directory' ) . '/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css' );			

	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	//Remove some unused stuff from the head.
	remove_action('wp_head', 'wlwmanifest_link');
	
}
add_action( 'after_setup_theme', 'mtf_setup' );

function my_parse_request( $query ) {
	global $wp_query; 
	return $query;
};
//add_action( 'parse_request', 'my_parse_request' );


/**
 * Add extended options to the featured image meta box.
 * Should this thumbnail link to the source image (may be displayed in lightbox)
 * Is this image a banner or standard thumbnail.
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