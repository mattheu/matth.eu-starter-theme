<?php

if ( ! ( get_next_posts_link() || get_previous_posts_link() ) )
	return;

?>

<nav class="pagination-container">
		
	<?php 

	if ( function_exists( 'hm_pagination' ) ) :
	
		echo hm_get_pagination( null, null, null );
	
	else :
	
	?>	
	
		<div class="alignleft"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
		<div class="alignright"><?php next_posts_link('Next Entries &raquo;','') ?></div>	

	<?php
	
	endif; 
	
	?>
	
</nav>