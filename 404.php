<?php get_header();  ?>


<div class="row">

	<section class="primary-content grid-8">

		<article class="entry">

			<h1>Page not found</h1>

			<div class="entry-content">

				<p>We can&rsquo;t seem to find what you&rsquo;re looking for. Try searching, or maybe one of the links below can&nbsp;help.</p>

				<div class="404-search">
					<?php get_search_form(); ?>
				</div>

				<div class="row sidebar">

					<div class="grid-4">
						<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 5 ), array( 'widget_id' => '404' ) ); ?>
					</div>

					<div class="grid-4">
						<div class="widget">
					    	<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'twentyeleven' ); ?></h2>
						    <ul>
						    	<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 5 ) ); ?>
						    </ul>
						</div>
					</div>

			</div>

		</article>

	</section>

</div>

<?php get_footer(); ?>