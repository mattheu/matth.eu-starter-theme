
<nav class="pagination-container">
		
	<?php 

		if ( function_exists( 'hm_pagination' ) ) :
				
			echo hm_get_pagination( null, null, null, array( 'prev_text' => '<i alt="f503" class="genericon genericon-leftarrow"></i>', 'next_text' => '<i alt="f503" class="genericon genericon-rightarrow"></i>' ) );
	
		else :
	
	?>	
	
		<div class="alignleft"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
		<div class="alignright"><?php next_posts_link('Next Entries &raquo;','') ?></div>	

	<?php
	
		endif; 
	
	?>
	
</nav>