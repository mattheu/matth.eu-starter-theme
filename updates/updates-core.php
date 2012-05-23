<?php

/**
 *	Handle Theme Updates
 *
 *	Current theme version is stored in wp_options.
 *	When a new theme version is used, the update action is called.
 *	Default settings and upgrade scripts can hook in here
 *	Remember to bump the version no in style.css
 *
 * @access public
 * @return none
 */
function mtf_upgrade() {

	$current_version = get_option( 'mtf_theme_version' );
	
	if( function_exists( 'wp_get_theme' ) ) {
		$theme = wp_get_theme( MPH_THEME_NAME );
		$new_version = $theme->version;
	} else {
		$theme = get_theme_data( get_bloginfo( 'stylesheet_directory' ) . '/style.css' );
		$new_version = $theme['Version'];
	}

	if ( version_compare( $new_version, $current_version ) == 0 )
		return;
	
	//Make a note that an update is in progress.
	update_option( 'mtf_theme_version', 'UPDATING: ' . $current_version . ' to ' . $new_version );
	
	//Let plugins hook in here.
	do_action( 'mtf_theme_update', $current_version, $new_version ); 

	//Update the current version to the New version.
	update_option( 'mtf_theme_version', $new_version );

}
add_action( 'init', 'mtf_upgrade' );


/**
 * Default Theme Settings.
 * 
 * Run when on every update to reset default settings. 
 *
 * @access public
 * @return none
 */
function mtf_default_settings( $current_version, $new_version ){

	// Set Default Image Sizes.
	$image_sizes = array(
		'thumbnail' => array(
			'size_w' =>	210,
			'size_h' => 160
		),
		'medium' => array(
			'size_w' =>	370,
			'size_h' => 999		
		),
		'large' => array( 
			'size_w' =>	690,
			'size_h' => 999
		)
	);
	
	foreach( $image_sizes as $image_size_name => $image_size )
		foreach( $image_size as $dimension_name => $dimension )
			if( $dimension != get_option( $image_size_name . '_' . $dimension_name ) )
				update_option( $image_size_name . '_' . $dimension_name, $dimension );

}
add_action( 'mtf_theme_update', 'mtf_default_settings', 10, 2 );


