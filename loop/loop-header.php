<?php if ( is_author() ) : ?>

	<div class="author-header loop-header vcard">
	
		<?php the_post(); ?>
		
		<figure class="loop-header-thumb">	
			<?php echo get_avatar( get_queried_object_id(), 130  ); ?>
		</figure>
		
    	<h2 class="loop-header-title">
    		<a class="url" href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) ); ?>" title="<?php echo esc_attr( get_the_author() );?>"><?php echo get_the_author(); ?></a>
    	</h2>

		<?php 
			$author_description = get_the_author_meta( 'description' );
			if ( ! empty( $author_description  ) )
				echo '<p class="loop-header-description">' . $author_description . '</p>';
		?>
	
		<?php rewind_posts(); ?>
	
	</div>

<?php elseif ( is_category() ) : ?>

    <div class="loop-header tax-header cat-header">
    	
    	<h2 class="loop-header-title">Category Archives: <span><?php echo single_cat_title( '', false ); ?></span></h2>

		<?php 
			$category_description = category_description(); 
			if ( ! empty( $category_description  ) )
				echo '<p class="loop-header-description">' . $category_description . '</p>';
		?>
			
    </div>

<?php elseif ( is_tag() ) : ?>

    <div class="loop-header tax-header tag-header">
    	
    	<h2 class="loop-header-title">Tag Archives: <span><?php echo single_tag_title( '', false ); ?></span></h2>

		<?php 
			$tag_description = tag_description(); 
			if ( ! empty( $tag_description ) )
				echo '<p class="loop-header-description">' . $tag_description . '</p>';
		?>

    </div>

<?php elseif ( is_date() ) : ?>

    <div class="loop-header tax-header">
    	
    	<h2 class="loop-header-title">
			<?php 
				if ( is_day() )
					echo 'Daily Archives: <span>' . get_the_date() . '</span>';
			
				elseif ( is_month() ) 
					echo 'Monthly Archives: <span>' . get_the_date( 'F Y' ) . '</span>';
			
				elseif ( is_year() )
					echo 'Yearly Archives: <span>' . get_the_date( 'Y' ) . '</span>';
			
				else
					echo 'Date Archives';
			?>
		</h2>						
		
    </div>

<?php endif; ?>
