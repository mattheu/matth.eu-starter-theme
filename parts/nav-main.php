<?php if ( has_nav_menu( 'mtf_menu_main' ) ) : ?>

	<nav class="main-menu nav clearfix">
		<?php wp_nav_menu( array(
			'theme_location' => 'mtf_menu_main',
			'container' => '',
			'depth' => 3,
		) ); ?>
	</nav>

<?php endif; ?>