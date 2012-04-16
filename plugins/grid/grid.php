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
	wp_enqueue_style( 'mtf_grid', get_bloginfo( 'template_directory' ) . '/plugins/grid/grid.css' );

}
add_action('wp_enqueue_scripts', 'mtf_grid_admin_bar_button', 1000 );