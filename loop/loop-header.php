<?php if ( is_search() ) : ?>

	<div class="search-header loop-header">
	
		<h2 class="search-header-title loop-header-title">
			Search results for: <em>"<?php the_search_query(); ?>"</em>
		</h2>
	
	</div>

<?php elseif ( is_author() ) : ?>

	<div class="author-header loop-header vcard">
	
		<?php the_post(); ?>
		
		<figure class="loop-header-thumb">	
			<?php echo get_avatar( get_queried_object_id(), 130  ); ?>
		</figure>
		
    	<h2 class="loop-header-title">
    		<a class="url" href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) ); ?>" title="<?php echo esc_attr( get_the_author() );?>"><?php echo get_the_author(); ?></a>
    	</h2>

		<?php 
			$description = get_the_author_meta( 'description' );
			if ( ! empty( $description  ) )
				echo '<div class="loop-header-description"><p>' . $description . '</p></div>';
		?>
	
		<?php rewind_posts(); ?>
	
	</div>

<?php elseif ( is_category() || is_tag() || is_tax() ) : ?>

	<?php
		$term = get_queried_object();
		$tax = get_taxonomy( $term->taxonomy );
		$title = single_term_title( '', false );
		$description = term_description(); 
	?>

    <div class="loop-header tax-header cat-header">
    	
    	<h2 class="loop-header-title"><?php echo esc_attr( $tax->labels->name ); ?> Archives: <span><?php echo esc_attr( $title ); ?></span></h2>

		<?php 
			if ( ! empty( $description  ) )
				echo '<div class="loop-header-description">' . $description . '</div>';
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
