<?php if ( is_search() ) : ?>

	<div class="search-header entries-header clearfix grid-8">

		<h2 class="search-header-title entries-header-title">
			<?php printf( __( 'Search results for: <em>"%s"</em>', 'mtf' ), get_search_query() ); ?>
		</h2>

	</div>

<?php elseif ( is_author() ) : ?>

	<div class="author-header entries-header vcard clearfix has-entries-header-thumb grid-8">

		<div class="row">

			<?php the_post(); // To grab the author from the first post.?>

			<figure class="entries-header-thumb grid-2">
				<?php echo get_avatar( get_queried_object_id(), 130  ); ?>
			</figure>

			<div class="grid-6">

	    		<h2 class="entries-header-title">
	    			<a class="url" href="<?php echo get_author_posts_url( get_the_author_meta( "ID" ) ); ?>" title="<?php echo esc_attr( get_the_author() );?>">
	    				<?php echo esc_html( get_the_author() ); ?>
	    			</a>
	    		</h2>

				<div class="entries-header-description">

					<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>

					<small>
						<?php get_template_part( 'parts/author/contact-methods' ); ?>
					</small>

				</div>

			</div>

			<?php rewind_posts(); // undo calling the_post(). ?>

		</div>

	</div>

<?php elseif ( is_category() || is_tag() || is_tax() ) : ?>

	<?php

	$term        = get_queried_object();
	$tax         = get_taxonomy( $term->taxonomy );
	$title       = single_term_title( '', false );
	$description = term_description();

	?>

    <div class="entries-header tax-header cat-header clearfix grid-8">

    	<h2 class="entries-header-title">
    		<?php printf( __( '%s Archives: <span>%s</span>', 'mtf' ), esc_attr( $tax->labels->name ), esc_attr( $title ) ); ?>
    	</h2>

		<?php if ( ! empty( $description  ) ) : ?>
			<div class="entries-header-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php endif; ?>

    </div>

<?php elseif ( is_date() ) : ?>

    <div class="entries-header tax-header clearfix grid-8">

    	<h2 class="entries-header-title">
			<?php

			if ( is_day() )
				printf( __( 'Daily Archives: <span>%s</span>', 'mtf' ), get_the_date() );
			elseif ( is_month() )
				printf( __( 'Monthly Archives: <span>%s</span>', 'mtf' ), get_the_date( 'F Y' ) );
			elseif ( is_year() )
				printf( __( 'Yearly Archives: <span>%s</span>', 'mtf' ), get_the_date( 'Y' ) );
			else
				_e( 'Date Archives', 'mtf' );

			?>
		</h2>

    </div>

<?php endif; ?>
