<?php

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
 */
function mtf_assets(){

	if ( !is_admin() ) { 
		
		//jQuery by google.
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', null, '1.4.2', true );
		wp_enqueue_script( 'jquery' );

		//Load my misc js plugins 		
		wp_enqueue_script( 'mtf_plugins', get_bloginfo( 'template_directory' ) . '/js/plugins.js', 'jquery', '1.0.0', true );	
		
		//Reset/boilerplate and base typography.
		wp_enqueue_style( 'mtf_type', get_bloginfo( 'template_directory' ) . '/css/boilerplate.css' );	
		wp_enqueue_style( 'mtf_reset', get_bloginfo( 'template_directory' ) . '/css/type_12-18.css' );		
		
		//Formalize. Fixes everything that is wrong with forms. 
		wp_enqueue_script( 'formalize', get_bloginfo( 'template_directory' ) . '/js/formalize/assets/js/jquery.formalize.min.js', 'jquery', '1.0.0', true );	
		wp_enqueue_style( 'formalize', get_bloginfo( 'template_directory' ) . '/js/formalize/assets/css/formalize.css' );	
				
		// Enqueue the main style at the end. 
		wp_enqueue_style( 'mtf_forms', get_bloginfo( 'template_directory' ) . '/css/forms.css' );	
		wp_enqueue_style( 'mtf_style', get_bloginfo( 'template_directory' ) . '/style.css' );	
		
		//Fancybox
		wp_enqueue_script( 'fancybox', get_bloginfo( 'template_directory' ) . '/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.js', 'jquery', '1.3.4', true );	
		wp_enqueue_style ( 'fancybox', get_bloginfo( 'template_directory' ) . '/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css' );			

		//Wordpress + Page specific scripts
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}
	
		//My js scripts.
		wp_enqueue_script( 'mtf_scripts', get_bloginfo( 'template_directory' ) . '/js/scripts.js', 'jquery', '1.0.0', true );	
			
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

/*
add_action( 'admin_init', 'mtf_admin_init' );
function mtf_admin_init(){

	//Force thumbnail sizes. 
	update_option( 'thumbnail_size_w', 220 );
	update_option( 'thumbnail_size_h', 180 );
	update_option( 'medium_size_w', 380 );
	update_option( 'medium_size_h', 999 );
	update_option( 'large_size_w', 540 );
	update_option( 'large_size_h', 9999 );

}
*/

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
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	//Remove some unused stuff from the head.
	remove_action('wp_head', 'wlwmanifest_link');
	
}
add_action( 'after_setup_theme', 'mtf_setup' );


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

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

	if( isset( $_POST['mtf_thumbnail_link_to_src'] ) && $_POST['mtf_thumbnail_link_to_src'] ) {
		update_post_meta( get_the_id(), 'mtf_thumbnail_link_to_src', $_POST['mtf_thumbnail_link_to_src'] );
	} else {
		delete_post_meta( get_the_id(), 'mtf_thumbnail_link_to_src' );
	}
	
}
add_action( 'save_post', 'mtf_thumbnail_options_save' );

