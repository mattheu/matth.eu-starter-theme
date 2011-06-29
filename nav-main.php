<?php
if( has_nav_menu( 'mtf_menu_main' ) ) : ?>

	<nav class="nav">
		<?php wp_nav_menu( array( 
			'theme_location' => 'mtf_menu_main',
			'container' => '',
			'depth' => 1,
		) ); ?>
	</nav>

<?php endif; ?> 