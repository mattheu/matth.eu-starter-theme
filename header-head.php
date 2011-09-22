<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
 
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">
	
	<title><?php
			global $page, $paged;
			wp_title( '|', true, 'right' );
			bloginfo( 'name' );
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";
			if ( $paged >= 2 || $page >= 2 )
				echo ' | ' . sprintf( __( 'Page %s', 'mtf' ), max( $paged, $page ) );
	?></title>

	<?php 
		// Set a blank favicon - both as a reminder & to supress errors.
		// Can be overwritten by placing a file 'favicon.ico' is the images directory. 
		if( !file_exists( $favicon = get_bloginfo( 'stylesheet_directory' ) . 'images/favicon.ico' ) ) 
			$favicon = 'data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQEAYAAABPYyMiAAAABmJLR0T///////8JWPfcAAAACXBIWXMAAABIAAAASABGyWs+AAAAF0lEQVRIx2NgGAWjYBSMglEwCkbBSAcACBAAAeaR9cIAAAAASUVORK5CYII='; 
	?>
	<link rel="icon" type="image/x-icon" href="<?php echo $favicon; ?>" />

	<?php 
		wp_head(); 
	?>

	<!--[if lt IE 9]>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/js/libs/modernizr-1.7.min.js"></script>
	<![endif]-->
 
</head>