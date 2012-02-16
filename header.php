<?php get_template_part( 'header', 'head' ); ?>

<body <?php body_class(); ?>>

	<div id="container" class="wrap" >
	
		<header class="site-header">
	
			<h1 class="logo"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('site_name'); ?></a></h1>
			<div class="site-description"><?php bloginfo('description'); ?></div>
	
			<?php get_template_part( 'nav', 'main' ); ?>
	
		</header>