<?php

add_action( 'init', 'mtf_upgrade' );
function mtf_upgrade() {

	$old_version = get_option( 'mtf_theme_version' );
	
	$theme_data = get_theme_data( get_stylesheet_uri() );
	$new_version = $theme_data['Version'];

	if ( version_compare( $new_version, $old_version ) == 0 )
		return;

	//Make a note that an update is in progress.
	update_option( 'mtf_theme_version', 'UPDATING: ' . $old_version . ' to ' . $new_version );
	
	//Let plugins hook in here.
	do_action( 'mtf_theme_update', $old_version, $new_version ); 

	//Update the current version to the New version.
	update_option( 'mtf_theme_version', $new_version );

}


/**
 * Default Theme Settings.
 * 
 * Run when on every update to reset default settings. 
 *
 * @access public
 * @return none
 */
function mtf_default_settings( $current_version ){

	// Set Default Image Sizes.
	$image_sizes = array(
		'thumbnail' => array(
			'size_w' =>	210,
			'size_h' => 160
		),
		'medium' => array(
			'size_w' =>	370,
			'size_h' => 340		
		),
		'large' => array( 
			'size_w' =>	690,
			'size_h' => 520
		)
	);
	
	foreach( $image_sizes as $image_size_name => $image_size )
		foreach( $image_size as $dimension_name => $dimension )
			if( $dimension != get_option( $image_size_name . '_' . $dimension_name ) )
				update_option( $image_size_name . '_' . $dimension_name, $dimension );

}
add_action( 'mtf_theme_update', 'mtf_default_settings' );


