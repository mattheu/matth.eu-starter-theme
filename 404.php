<?php get_header();  ?>

<section class="primary-content entries">

	<article class="entry">

		<h1>404</h1>

		<div class="entry-content">

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'twentyeleven' ); ?></p>

			<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>

			<div class="widget">
			    <h2 class="widgettitle"><?php _e( 'Most Used Categories', 'twentyeleven' ); ?></h2>
			    <ul>
			    <?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
			    </ul>
			</div>

		</div>

	</article>

</section>

<?php get_footer(); ?>