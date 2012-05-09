
<nav class="pagination">
		
	<?php 

		if( ! function_exists( 'hm_pagination' ) ) :
	
			hm_pagination(); 
	
		else :
	
	?>	
	
		<div class="alignleft"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
		<div class="alignright"><?php next_posts_link('Next Entries &raquo;','') ?></div>	

	<?php
	
		endif; 
	
	?>
	
</nav>