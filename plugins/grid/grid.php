<?php

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

	wp_enqueue_script( 'mtf_grid', get_bloginfo( 'template_directory' ) . '/plugins/grid/grid.js', 'jquery', '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'mtf_grid_admin_bar_button', 1000 );


/**
 * The Grid Style
 *
 * Insert the grid style directly in the head.
 * A little hacky I'll admit, but its only for development.
 *
 * @access public
 * @return null
 */
function mtf_grid_admin_bar_style() {

	if ( is_admin() || ! current_user_can( 'manage_options' ) )
		return;

	ob_start();	
	include( 'generator.php' );
	$style = ob_get_contents();
	ob_end_clean();

	echo '<style>' . str_replace( array( "\t", "\n", "\r" ), '', $style ) . '</style>';

}
add_action( 'wp_head', 'mtf_grid_admin_bar_style' );