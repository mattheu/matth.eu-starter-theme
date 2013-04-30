<?php

define( 'MPH_THEME_NAME', basename( dirname( __FILE__ ) ) );

/**
 *	More Functions & Plugins.
 */
get_template_part( 'updates/updates', 'core' );
get_template_part( 'functions/functions-comments' );
get_template_part( 'functions/functions-image_caption' );
get_template_part( 'functions/functions-thumbnail_link' );
get_template_part( 'functions/functions-user-contact-methods' );
get_template_part( 'functions/gallery' );
get_template_part( 'widgets/about' );
get_template_part( 'plugins/grid/grid' );


/**
 *	Setup
 *
 *  @return null
 */
function mtf_setup() {

	if ( get_option( 'link_manager_enabled' ) )
		update_option( 'link_manager_enabled', false );

	register_nav_menus(
		array(
		  'mtf_menu_main' => 'Main Menu',
		  'mtf_menu_foot' => 'Footer Menu'
		)
	);

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'mtf_secondary' ),
		'id' => 'mtf_secondary',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	add_theme_support( 'structured-post-formats', array(
		'image', 'gallery', 'video', 'audio'
	) );
	
	// 'aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status'
	add_theme_support( 'post-formats', array(
		'image', 'gallery', 'video', 'audio', 'quote'
	) );

	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	//Remove some unused stuff from the head.
	remove_action('wp_head', 'wlwmanifest_link');

	add_filter( 'use_default_gallery_style', '__return_false' );

}
add_action( 'init', 'mtf_setup' );

// WPThumb features
add_theme_support( 'wpthumb-crop-from-position' );

/**
 *	Register all assets
 *
 *  @return null
 */
function mtf_register_assets() {

	if ( is_admin() )
		return;

	// Use the theme version for theme assets to bust cache when updating.

	if ( function_exists( 'wp_get_theme' ) ) {
		$theme = wp_get_theme( MPH_THEME_NAME );
		$version = $theme->version;
	} else {
		$theme = get_theme_data( get_bloginfo( 'stylesheet_directory' ) . '/style.css' );
		$version = $theme['Version'];
	}

	wp_register_script( 'modernizr', get_bloginfo( 'template_directory' ) . '/assets/js/libs/modernizr-1.7.min.js', null, '1.7' );

	// Scripts. Theme functions and behaviour
	wp_register_script( 'mtf_functions', get_bloginfo( 'template_directory' ) . '/assets/js/functions.js', array( 'jquery' ), $version, true );
	wp_register_script( 'mtf_theme', get_bloginfo( 'template_directory' ) . '/assets/js/theme.js', array( 'modernizr', 'jquery' ), $version, true );

	// Theme CSS
	wp_register_style( 'mtf_reset', get_bloginfo( 'template_directory' ) . '/assets/styles/reset.css', null, $version, 'all' );
	wp_register_style( 'genericons', get_bloginfo( 'template_directory' ) . '/assets/fonts/genericons/genericons.css', null, $version, 'all' );
	wp_register_style( 'mtf_theme', get_bloginfo( 'template_directory' ) . '/assets/styles/css/theme.css', array( 'mtf_reset' ), $version, 'all' );
	
	// Flexslider
	wp_register_script( 'flexslider', get_bloginfo( 'template_directory' ) . '/assets/js/flexslider.min.js', array( 'jquery' ), $version, true );
	wp_register_style( 'flexslider', get_bloginfo( 'template_directory' ) . '/assets/styles/flexslider.css', array( 'mtf_reset' ), $version, 'all' );

}
add_action( 'init', 'mtf_register_assets' );

/**
 *	Enqueue all the assets.
 *
 *  @return null
 */
function mtf_enqueue_assets() {

	wp_enqueue_script( 'modernizr' );

	// Theme Scripts
	wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script( 'mtf_functions' );
	wp_enqueue_script( 'mtf_theme' );

	// Theme Styles
	wp_enqueue_style( 'genericons' );
	wp_enqueue_style( 'mtf_theme' );
	
	wp_enqueue_style( 'flexslider' );
	wp_enqueue_script( 'flexslider' );

}
add_action( 'wp_enqueue_scripts', 'mtf_enqueue_assets' );


/**
 * 	Add the Favicon to the head.
 *
 *	Added to theme, admin and login.
 *
 *  @todo Set your own favicon. Default is wordpress logo - to prevent annoying console messages during development.
 */
function mtf_favicon() {
	?>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicon.ico" />

	<?php
}
add_action( 'wp_head', 'mtf_favicon' );
add_action( 'admin_head', 'mtf_favicon' );
add_action( 'login_head', 'mtf_favicon' );


/**
 * Filter the excerpt length.
 * Different lengths can be used in different places.
 *
 * @param int $length
 * @return int
 */
function mtf_excerpt_length( $length ) {

	global $template;

	// Can adjust excerpt based on template file like this.
	if ( in_array( basename( $template ), array( 'index-grid.php' ) ) )
		return 15;

	if ( has_post_thumbnail() )
		return 20;

	return 50;

}
add_filter( 'excerpt_length', 'mtf_excerpt_length' );

/**
 *	Customize the excerpt read more link.
 */
function mtf_excerpt_more_link( $more ) {

	return ' [&hellip;] <span class="entry-more-link"><a href="'. get_permalink( get_the_ID() ) . '">Read the full article&hellip;</a></span>';

}
add_filter( 'excerpt_more', 'mtf_excerpt_more_link' );

/**
 *	Different category templates.
 *
 *	@param $template Path of template file
 *  @return null
 *	@todo - use query vars for this, not check get.
 */
function mtf_grid_template ( $template ) {

	//m( get_query_var( 'hello' ) );
	global $wp_query;

	// Portfolio category should use the grid template.
	if ( isset( $_GET['view'] ) && 'grid' === $_GET['view'] )
		return locate_template( 'index-grid.php', false );

	return $template;

}
add_filter( 'template_include', 'mtf_grid_template' );

/**
 * Add custom query vars.
 * 
 * @param  WP_Query $query
 * @return WP_Query $query
 */
function mtf_grid_query_var( $query ) {

	if ( ! $query-> is_main_query() )
		return;

	if ( isset( $_GET['view'] ) && 'grid' === $_GET['view'] )
		$query->set( 'hello', 'world' );
	
	return $query;

}
add_filter( 'parse_query', 'mtf_grid_query_var' );

/**
 * Add custom post classes.
 * 
 * @param array $classes
 * @return array $classes
 */
function mtf_post_class( $classes ) {

	if ( has_post_thumbnail() )
		$classes[] = 'has-thumbnail';

	return $classes;
	
}
add_filter( 'post_class', 'mtf_post_class' );