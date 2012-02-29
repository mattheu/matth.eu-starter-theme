<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js oldie ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js oldie ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js oldie ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"><!--<![endif]-->
<head>
 
 	<!-- no-js or js class to help prevent FOUC -->
	<script type="text/javascript">(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1">

	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

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