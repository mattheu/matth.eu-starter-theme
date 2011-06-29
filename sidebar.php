<div id="secondary" class="widget-area" role="complementary">
	
	<div id="mtf_sidebar_top" class="widget_area">
	
		<?php echo mtf_get_theme_setting( 'dynamic_sidebar_before' ); ?>
									  
		<?php if ( ! dynamic_sidebar( 'mtf_secondary_top' ) ) : ?>	
    		<aside id="archives" class="widget">
    			
    			<h1 class="widget-title"><?php _e( 'Archives', 'mtf' ); ?></h1>
    			<ul>					  
    				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
    			</ul>					  
    		</aside>					  
										  
    		<aside id="meta" class="widget">
    			<h1 class="widget-title"><?php _e( 'Meta', 'mtf' ); ?></h1>
    			<ul>					  
    				<?php wp_register(); ?>
    				<li><?php wp_loginout(); ?></li>
    				<?php wp_meta(); ?>	  
    			</ul>					  
    		</aside>					  
	    <?php endif; // end sidebar widget area ?>
	    <?php echo mtf_get_theme_setting( 'dynamic_sidebar_after' ); ?>
    </div>	  
    	
    <div id="mtf_sidebar_bottom" class="widget_area">
    	<?php echo mtf_get_theme_setting( 'dynamic_sidebar_before' ); ?>
    		<?php dynamic_sidebar( 'mtf_secondary_bottom' ); ?>
    	<?php echo mtf_get_theme_setting( 'dynamic_sidebar_after' ); ?>
    </div>
    
</div><!-- #secondary .widget-area -->