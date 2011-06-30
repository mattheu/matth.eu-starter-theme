<?php get_template_part( 'header', 'head' ); ?>

<body <?php body_class(); ?>>
<div id="container" class="wrap" >
	
	<header>
		<h1 class="logo"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('site_name'); ?></a></h1>
		<div id="header_description"><?php bloginfo('description'); ?></div>
		<?php get_template_part( 'nav', 'main' ); ?>
	</header>