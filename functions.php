<?php

/**
 *
 * 		== More Functions & Plugins ==
 *
 * 		* Split off some of the more complicated theme functions. 
 * 		* Core Plugins - to be loaded directly the theme. (can't be disabled)
 *
 */

// Update Script - stores an option of the version number & gives us an action that allows us to hook in and do stuff.
get_template_part( 'updates/updates', 'core' );

get_template_part( 'functions/functions-comments' );
get_template_part( 'functions/functions-image_caption' ); 
get_template_part( 'functions/functions-thumbnail_link' ); 


/**
 *	mtf_register_assets function
 *	
 *	Register & Enqueue Styles
 *  Do this separately to allow for deregistering/modifying them from a child theme.
 *  
 *  @return null
 */
function mtf_register_assets() {

	if ( is_admin() )
		return; 

	$theme = get_theme_data( get_bloginfo( 'stylesheet_directory' ) . '/style.css' );

	//Modernizr
	wp_register_script( 'modernizr', get_bloginfo( 'template_directory' ) . '/js/libs/modernizr-1.7.min.js', null, '1.7' );

	//jQuery
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_bloginfo( 'template_directory' ) . '/js/libs/jquery.min.js', null, '1.7.1', true );
	
   	//Register my misc js functions & plugins
    wp_register_script( 'mtf_functions', get_bloginfo( 'template_directory' ) . '/js/functions.js', 'jquery', $theme['Version'], true );	
    		
    //Reset/boilerplate and base typography.
    wp_register_style( 'reset', get_bloginfo( 'template_directory' ) . '/css/boilerplate.css' );	
    wp_register_style( 'mtf_type', get_bloginfo( 'template_directory' ) . '/css/type.css' );
    
    // Enqueue the main style at the end. 
    wp_register_style( 'mtf_forms', get_bloginfo( 'template_directory' ) . '/css/forms.css' );	
    wp_register_style( 'mtf_style', get_bloginfo( 'template_directory' ) . '/css/main.css' );	

    // Fancybox
    // Not included in the framework by default. 
   	// Either include it or modify/delete this. 
    $fancybox_path = '/js/jquery.fancybox.2.0/source/jquery.fancybox.pack.js';
    if ( file_exists( TEMPLATEPATH. $fancybox_path ) ) {
    	wp_register_script( 'fancybox', get_bloginfo( 'template_directory' ) . $fancybox_path, 'jquery', '2.0', true );	
	    wp_register_style ( 'fancybox', get_bloginfo( 'template_directory' ) . '/js/jquery.fancybox.2.0/source/jquery.fancybox.css' );	
    }		

	// Theme behaviour.
	wp_register_script( 'mtf_behaviour', get_bloginfo( 'template_directory' ) . '/js/behaviour.js', 'jquery', $theme['Version'], true );	
		
}
add_action( 'init', 'mtf_register_assets' );


/**
 * mtf_enqueue_scripts description
 * 
 * @return null
 */
function mtf_enqueue_scripts () {

	if ( is_admin() )
		return; 
	
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'jquery' );
	
	// Theme Plugins & Functions
	wp_enqueue_script( 'mtf_functions' );

	wp_enqueue_script( 'fancybox');
	
	wp_enqueue_script( 'comment-reply' );

	// Theme Behaviour.
	wp_enqueue_script( 'mtf_behaviour' );

}
add_action( 'wp_enqueue_scripts', 'mtf_enqueue_scripts' );
	
/**
 * mtf_print_styles
 * 
 * @return null
 */	
function mtf_print_styles () {

	if ( is_admin() )
		return; 

	wp_enqueue_style( 'reset' );		

	wp_enqueue_style( 'mtf_type' );		
	wp_enqueue_style( 'mtf_forms' );
	wp_enqueue_style( 'mtf_style' );

	wp_enqueue_style( 'fancybox');

}
add_action( 'wp_print_styles', 'mtf_print_styles' );


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
 * mtf_home_feed.
 * If home is a page - feed should be a general feed, not just comments for that page. 
 * 
 * @todo is this to specific for this framework?
 */
function mtf_home_feed() {

	if ( ! is_front_page() )
		return;

	if ( is_page() ) 
		remove_action( 'wp_head', 'feed_links_extra', 3 );

	echo '<link rel="alternate" type="application/rss+xml" title="' . get_bloginfo('name') . ' Feed" href="' . get_bloginfo('url') . '/feed/" />';
	
}
add_action( 'wp_head', 'mtf_home_feed', 1 );


/**
 * mtf_grid_admin_bar_button function.
 *
 * Grid Overlay Development Tool
 * Add the show grid button to the menu bar if the current user is admin. 
 * 
 * @access public
 * @return null
 */
function mtf_grid_admin_bar_button() {

	if ( is_admin() || ! current_user_can( 'manage_options' ) )
		return;

	global $wp_admin_bar;
	
    $wp_admin_bar->add_menu( 
    	array(	
    		'id' => 'show-grid',	
			'parent' => 'top-secondary',
    		'title' => 'Show Grid',	
    		'href' => '#',
			'meta'   => array( 'class' => 'hide-no-js' ),
    	) 
    );

}
add_action('admin_bar_menu', 'mtf_grid_admin_bar_button', 1000 );


/**
 * mtf_excerpt_length function.
 * 
 * Filter the excerpt length. 
 * Different lengths can be used in different places.
 *
 * @access public
 * @param int $length
 * @return int
 */
function mtf_excerpt_length( $length ) {

	global $template;

	// Can adjust excerpt based on template file like this.
	if ( in_array( basename( $template ), array( 'index-grid/php', 'category-featured-image.php' ) ) )
		return 25;

	if ( has_post_thumbnail() )
		return 50;

	return 100;
		
}
add_filter( 'excerpt_length', 'mtf_excerpt_length' );


/**
 * Maybe add favicon link to the head.
 * 
 * If one is in the root directory, do nothing.
 * If there is a favicon.ico in the theme images directory, use that.
 * Else set a blank favicon - both as a reminder & to stop the error log filling.
 * 
 * @return null
 */
function mtf_favicon() {

	if ( file_exists( get_bloginfo( 'url' ) . 'favicon.ico' ) ) 
		return;

	// Can be overwritten by placing a file 'favicon.ico' is the images directory. 
	if ( ! file_exists( $favicon = get_bloginfo( 'stylesheet_directory' ) . 'images/favicon.ico' ) ) 
		$favicon = 'data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQEAYAAABPYyMiAAAABmJLR0T///////8JWPfcAAAACXBIWXMAAABIAAAASABGyWs+AAAAF0lEQVRIx2NgGAWjYBSMglEwCkbBSAcACBAAAeaR9cIAAAAASUVORK5CYII='; 

	?>
	
	<link rel="icon" type="image/x-icon" href="<?php echo $favicon; ?>" />

	<?php
}
add_action( 'wp_head', 'mtf_favicon' );