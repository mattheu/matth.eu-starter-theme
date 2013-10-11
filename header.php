<?php

/**
 * The template for displaying the header.
 *
 * @package MPH Starter
 * @since 0.1.0
 */

?><!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>

 	<?php // no-js/js class. Help prevent FOUC. Can remove if Modernizr is used. ?>
	<script type="text/javascript">(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<div class="wrap page-wrap" >

		<div class="row">

			<div class="grid-12">

				<header class="site-header">

					<h1 class="logo"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('site_name'); ?></a></h1>
					<div class="site-description"><?php bloginfo('description'); ?></div>

					<?php get_template_part( 'parts/nav-main' ); ?>

				</header>

			</div>

		</div>