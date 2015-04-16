<?php
/**
 * MPH Starter functions and definitions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * @package MPH Starter
 * @since 0.1.0
 */

/**
 *	More Functions & Plugins.
 */
require_once( 'updates/updates-core.php' );
require_once( 'includes/functions-comments.php' );
require_once( 'includes/functions-image_caption.php' );
require_once( 'includes/functions-user-contact-methods.php' );
require_once( 'includes/widont.php' );
require_once( 'includes/gallery.php' );
require_once( 'includes/widgets/about.php' );
require_once( 'includes/plugins/grid/grid.php' );

if ( ! isset( $content_width ) )
	$content_width = 700;

/**
 * Check whether currently running a live or dev environment.
 *
 * Uses value of HM_DEV.
 */
function mtf_is_dev() {
	return apply_filters( 'mtf_is_dev', defined( 'HM_DEV' ) && true === HM_DEV );
}

/**
 * Get the theme version.
 * Return version defined in style.css
 *
 * @return string version.
 * @since 0.1.0
 */
function mtf_get_theme_version() {

	// wp_get_theme since WordPress 3.4.0
	if ( function_exists( 'wp_get_theme' ) ) {
		$theme = wp_get_theme( basename( get_bloginfo( 'stylesheet_directory' ) ) );
		$version = $theme->version;
	} else {
		$theme = get_theme_data( get_bloginfo( 'stylesheet_directory' ) . '/style.css' );
		$version = $theme['Version'];
	}

	return apply_filters( 'mtf_get_theme_version', $version );

}

/**
 *  Set up theme defaults and register supported WordPress features.
 *
 *  @return null
 */
function mtf_setup() {

	load_theme_textdomain( 'mft', get_template_directory() . '/languages' );

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

	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'mtf_footer' ),
		'id' => 'mtf_footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	add_theme_support( 'structured-post-formats', array(
		'image', 'gallery', 'video', 'audio'
	) );

	add_theme_support( 'post-formats', array(
		'image', 'gallery', 'video', 'audio', 'quote'
	) );

	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	//Remove some unused stuff from the head.
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Remove default gallery styles
	add_filter( 'use_default_gallery_style', '__return_false' );

}
add_action( 'after_setup_theme', 'mtf_setup' );

// WPThumb features. Doesn't work inside setup function.
add_theme_support( 'wpthumb-crop-from-position' );

/**
 *	Register all assets
 *
 *  @return null
 */
function mtf_register_assets() {

	// Use the theme version for theme assets to bust cache when updating.
	$version = mtf_get_theme_version();
	$postfix = ( mtf_is_dev() ) ? '' : '.min';

	wp_deregister_script( 'modernizr' );
	wp_register_script( 'modernizr', get_bloginfo( 'template_directory' ) . '/assets/js/vendor/modernizr-1.7.min.js', null, '1.7' );

	// Scripts. Theme functions and behaviour
	wp_register_script( 'mtf_theme', get_bloginfo( 'template_directory' ) . "/assets/js/theme{$postfix}.js", array( 'modernizr', 'jquery' ), $version, true );

	// Theme CSS
	wp_register_style( 'mtf_genericons', get_bloginfo( 'template_directory' ) . '/assets/fonts/genericons/genericons.css', null, $version, 'all' );
	wp_register_style( 'mtf_theme', get_bloginfo( 'template_directory' ) . "/assets/css/theme{$postfix}.css", null, $version, 'all' );

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
	wp_enqueue_script( 'mtf_theme' );

	// Theme Styles
	wp_enqueue_style( 'mtf_genericons' );
	wp_enqueue_style( 'mtf_theme' );

	// Livereload for use with grunt & grunt watch. To use, grunt watch must be running.
	if ( mtf_is_dev() ) {
		// wp_enqueue_script( 'mtf_livereload', home_url() . ':35729/livereload.js' ); // When running grunt watch inside vagrant.
		wp_enqueue_script( 'mtf_livereload', 'http://localhost:35729/livereload.js' ); // When running grunt watch on your machine.
	}

}
add_action( 'wp_enqueue_scripts', 'mtf_enqueue_assets' );

function mtf_admin_init() {
	add_editor_style( '/assets/css/editor.css' );
}

add_action( 'admin_init', 'mtf_admin_init' );

/**
 * Add humans.txt to the <head> element.
 */
function mtf_header_meta() {

	$humans = '<link type="text/plain" rel="author" href="' . get_template_directory_uri() . '/humans.txt" />';

	echo apply_filters( 'mtf_humans', $humans );

}
add_action( 'wp_head', 'mtf_header_meta' );

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
 * Different lengths are used in different templates
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

	return sprintf(
		' &hellip; <span class="entry-more-link"><a href="%s">%s&hellip;</a></span>',
		__( 'Read more', 'mtf' ),
		get_permalink( get_the_ID() )
	);

}
add_filter( 'excerpt_more', 'mtf_excerpt_more_link' );

/**
 *	Grid view category templates.
 *
 *	@param $template Path of template file
 *  @return null
 *	@todo - use query vars for this, not check get.
 */
function mtf_grid_template ( $template ) {

	global $wp_query;

	// Portfolio category should use the grid template.
	if ( isset( $_GET['view'] ) && 'grid' === $_GET['view'] )
		return locate_template( 'index-grid.php', false );

	return $template;

}
add_filter( 'template_include', 'mtf_grid_template' );

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

/**
 * Hide style guide templates for non admins.
 *
 * @param  array
 * @param  WP_Theme
 * @param  object
 * @return array
 */
function mtf_page_templates( $page_templates, $this, $post ) {

	if (
		( is_multisite() && is_super_admin() )
		|| current_user_can( 'manage_options' )
	) {
		return $page_templates;
	}

	foreach ( $page_templates as $key => $value ) {
		if ( 0 === strpos( $key, 'style-guide/' ) ) {
			unset( $page_templates[$key] );
		}
	}

	return $page_templates;

}
add_filter( 'theme_page_templates', 'mtf_page_templates' );
