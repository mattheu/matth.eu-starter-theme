<?php if ( is_search() ) : ?>

	<div class="search-header entries-header clearfix grid-8">

		<h2 class="search-header-title entries-header-title">
			Search results for: <em>"<?php the_search_query(); ?>"</em>
		</h2>

	</div>

<?php elseif ( is_author() ) : ?>

	<div class="author-header entries-header vcard clearfix has-entries-header-thumb grid-8">

		<div class="row">

			<?php the_post(); ?>

			<figure class="entries-header-thumb grid-2">
				<?php echo get_avatar( get_queried_object_id(), 130  ); ?>
			</figure>

			<div class="grid-6">

	    		<h2 class="entries-header-title">
	    			<a class="url" href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) ); ?>" title="<?php echo esc_attr( get_the_author() );?>"><?php echo get_the_author(); ?></a>
	    		</h2>

				<?php
					$description = get_the_author_meta( 'description' );
					if ( ! empty( $description  ) )
						echo '<div class="entries-header-description"><p>' . $description . '</p></div>';
				?>

			</div>

			<?php rewind_posts(); ?>

		</div>

	</div>

<?php elseif ( is_category() || is_tag() || is_tax() ) : ?>

	<?php
		$term = get_queried_object();
		$tax = get_taxonomy( $term->taxonomy );
		$title = single_term_title( '', false );
		$description = term_description();
	?>

    <div class="entries-header tax-header cat-header clearfix grid-8">

    	<h2 class="entries-header-title"><?php echo esc_attr( $tax->labels->name ); ?> Archives: <span><?php echo esc_attr( $title ); ?></span></h2>

		<?php
			if ( ! empty( $description  ) )
				echo '<div class="entries-header-description">' . $description . '</div>';
		?>

    </div>

<?php elseif ( is_date() ) : ?>

    <div class="entries-header tax-header clearfix grid-8">

    	<h2 class="entries-header-title">
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
