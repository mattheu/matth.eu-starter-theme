<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js oldie ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js oldie ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js oldie ie8"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"><!--<![endif]-->
<head>
 
 	<!-- no-js or js class to help prevent FOUC -->
	<script type="text/javascript">(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width">

	<title><?php bloginfo('name'); ?> <?php wp_title( '|' ); ?></title>

	<?php 
		/* Set a default blank favicon - to prevent errors @todo - remove*/
		$favicon = 'data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQEAYAAABPYyMiAAAABmJLR0T///////8JWPfcAAAACXBIWXMAAABIAAAASABGyWs+AAAAF0lEQVRIx2NgGAWjYBSMglEwCkbBSAcACBAAAeaR9cIAAAAASUVORK5CYII='; 
	?>
	<link rel="icon" type="image/x-icon" href="<?php echo $favicon; ?>" />
	
	<?php wp_head(); ?>

</head>