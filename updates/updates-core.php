<?php

add_action( 'init', 'mtf_upgrade' );
function mtf_upgrade(){

	$old_version = get_option( 'mtf_theme_version' );
	
	$theme_data = get_theme_data( get_stylesheet_uri() );
	$new_version = $theme_data['Version'];

	if( version_compare( $new_version, $old_version ) == 0 )
		return;

	//Make a note that an update is in progress.
	update_option( 'mtf_theme_version', 'UPDATING: ' . $old_version . ' to ' . $new_version );
	
	//Let plugins hook in here.
	do_action( 'mtf_theme_update', $old_version, $new_version ); 

	//Update the current version to the New version.
	update_option( 'mtf_theme_version', $new_version );

}

add_action( 'mtf_theme_update', 'mtf_defaults', 1, 2 );
function mtf_defaults( $new_version, $old_version ){

}
