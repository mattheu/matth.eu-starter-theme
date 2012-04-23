<?php

/**
 *
 * 		== More Functions & Plugins ==
 *
 * 		* A collection of useful plugins and functions.
 *		  Split off into separate files for easy removal if they are not required.
 *
 */

// Update Script - stores an option of the version number & gives us an action that allows us to hook in and do stuff.
get_template_part( 'updates/updates', 'core' );

get_template_part( 'functions/functions-comments' );
get_template_part( 'functions/functions-image_caption' );
get_template_part( 'functions/functions-thumbnail_link' );

get_template_part( 'plugins/grid/grid' );

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

	// Use the theme version for theme asset version numbers.
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
    wp_register_style( 'mtf_type', get_bloginfo( 'template_directory' ) . '/css/type_14-21.css' );

    // Enqueue the main style at the end.
    wp_register_style( 'mtf_forms', get_bloginfo( 'template_directory' ) . '/css/forms.css' );
    wp_register_style( 'mtf_style', get_bloginfo( 'template_directory' ) . '/css/theme.css' );

	// Theme behaviour.
	wp_register_script( 'mtf_theme', get_bloginfo( 'template_directory' ) . '/js/theme.js', 'jquery', $theme['Version'], true );

}
add_action( 'init', 'mtf_register_assets' );


/**
 * mtf_enqueue_scripts description
 *
 * @return null
 */
function mtf_enqueue_scripts () {

	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'jquery' );

	// Theme Plugins & Functions
	wp_enqueue_script( 'mtf_functions' );
	wp_enqueue_script( 'comment-reply' );

	// Theme Behaviour.
	wp_enqueue_script( 'mtf_theme' );

	/** Scripts **/
	wp_enqueue_style( 'reset' );
	wp_enqueue_style( 'mtf_type' );
	wp_enqueue_style( 'mtf_forms' );
	wp_enqueue_style( 'mtf_style' );

}
add_action( 'wp_enqueue_scripts', 'mtf_enqueue_scripts' );


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


	add_theme_support( 'post-formats', array( 'quote' ) );
	add_theme_support( 'post-thumbnails' );


	// Image Sizes.
	add_image_size( 'medium-crop', 370, 285, true );


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

	if ( ! is_front_page() || ( is_front_page() && ! is_page() ) )
		return;

	remove_action( 'wp_head', 'feed_links_extra', 3 );

	echo '<link rel="alternate" type="application/rss+xml" title="' . get_bloginfo('name') . ' Feed" href="' . get_bloginfo('url') . '/feed/" />';

}
add_action( 'wp_head', 'mtf_home_feed', 1 );


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

	$favicon = 'data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQEAYAAABPYyMiAAAABmJLR0T///////8JWPfcAAAACXBIWXMAAABIAAAASABGyWs+AAAAF0lEQVRIx2NgGAWjYBSMglEwCkbBSAcACBAAAeaR9cIAAAAASUVORK5CYII=';

	?>

	<link rel="icon" type="image/x-icon" href="<?php echo $favicon; ?>" />

	<?php
	
}
add_action( 'wp_head', 'mtf_favicon' );


/**
 *	Hide update notice if not an admin.
 */
function mtf_remove_update_nag() {

	if ( ! current_user_can( 'manage_options' ) )	
		remove_action( 'admin_notices', 'update_nag', 3 );

}
add_action( 'admin_notices', 'mtf_remove_update_nag', 1 );