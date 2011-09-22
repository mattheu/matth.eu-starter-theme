<?php
if( has_nav_menu( 'mtf_menu_main' ) ) : ?>

	<nav class="nav clearfix">
		<?php wp_nav_menu( array( 
			'theme_location' => 'mtf_menu_main',
			'container' => '',
			'depth' => 5,
		) ); ?>
	</nav>

<?php endif; ?> 