<?php

/**
 *
 *	Plugins to be loaded by the theme. (can't be disabled)
 *
 */
require_once( 'plugins/better_excerpt.php' );
require_once( 'functions-comments.php' );

/**
 *
 *	Set up theme.
 *
 */
 add_action( 'init', 'mtf_init' );
function mtf_init(){

	/**
	 *	Scripts.
	 *	- Use jQuery hosted by google. 
	 */
	if ( !is_admin() ) { 
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js' );
		wp_enqueue_script( 'jquery' );
	}
	
	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'mtf_thumbnail', 220, 180, true );
		add_image_size( 'mtf_medium', 380, 999, false ); 
		add_image_size( 'mtf_medium_crop', 380, 290, true ); 
		add_image_size( 'mtf_medium_crop_v', 380, 495, true ); 
		add_image_size( 'mtf_large', 540, 9999, false ); 
	}
}

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
/*
function my_x( $dimensions, $size ){
	
	switch ( $size ) {
		case 'thumbnail' :
			return array( 10, 10 );
			break;
		case 'medium' :
			return array( 380, 9999 );
			break;
		case 'large' :
			return array( 540, 9999 );
			break;
	}	
	return $dimensions; 
}
add_action( 'editor_max_image_size', 'my_x', 10, 2 );
*/

add_action( 'after_setup_theme', 'mtf_setup' );
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
		
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
}

function mtf_get_theme_setting( $setting ) {
	
	switch( $setting ) {		

		case( 'dynamic_sidebar_before' ) :
			if( defined( 'MTF_DYNAMIC_SIDEBAR_BEFORE' ) )
				$r = MTF_DYNAMIC_SIDEBAR_BEFORE;
			break;
		
		case( 'dynamic_sidebar_after' ) :			
			if( defined( 'MTF_DYNAMIC_SIDEBAR_AFTER' ) )
				$r = MTF_DYNAMIC_SIDEBAR_AFTER;
			break;

	}
		
	if( !isset( $r ) )
		return;
			
	return $r; 
		
	
}



