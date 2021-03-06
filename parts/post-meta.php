<p class="entry-meta">

	<small>

		<span class="entry-date">
			<?php
				printf(
					__( '<b class="sep">Posted: </b><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'mtf' ),
					esc_url( get_permalink() ),
					esc_attr( get_the_time() ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( ( get_the_time( 'U' ) < strtotime( '1 month ago' )|| ! is_main_query() || ( is_main_query() && is_singular() ) ) ? get_the_date() : human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago' ),
					esc_html( get_the_date() )
				);
			?>
		</span>

		|

		<span class="entry-author">
			By <?php the_author_posts_link(); ?>
		</span>

		<?php if ( comments_open() || ! comments_open() && have_comments() ) : ?>
			<span class="entry-comments">
				| <a href="<?php the_permalink(); ?>#comments">
					<?php printf( _n( '1&nbsp;Comment', '%1$s&nbsp;Comments', get_comments_number(), 'mtf' ), number_format_i18n( get_comments_number() ) ); ?>
				</a>
			</span>
		<?php endif; ?>

		<?php if ( ! is_main_query() || ( ! is_singular() && is_main_query() ) ) : ?>
			<span class="entry-permalink">
				| <a href="<?php the_permalink(); ?>">
					<?php _e( 'View&nbsp;Post', 'mtf' ); ?>
				</a>
			</span>
		<?php endif; ?>

	</small>

</p>
