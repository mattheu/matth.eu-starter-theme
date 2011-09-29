<?php

//Update Script
get_template_part( 'updates/updates', 'core' );

/**
 *
 * 		== More Functions & Plugins ==
 *
 * 		* Split off some of the more complicated theme functions. 
 * 		* Core Plugins - to be loaded directly the theme. (can't be disabled)
 *
 */

get_template_part( 'functions/functions', 'comments' );
get_template_part( 'functions/functions', 'image_caption' ); 
get_template_part( 'functions/functions', 'thumbnail_link' ); 
get_template_part( 'functions/functions', 'better_excerpt' ); 


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
    wp_register_style( 'mtf_style', get_bloginfo( 'template_directory' ) . '/css/main.css' );	

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