<?php get_header();  ?>


<?php if( have_posts() ) : while( have_posts() ) : the_post();  ?>

<section class="primary_content posts">	

<article <?php post_class(); ?>>
    	
		    
		<?php if ( has_post_thumbnail() ) {
    		$url = ( get_post_meta( get_the_id(), 'mtf_thumbnail_link_to_src', true ) ) ? wp_get_attachment_url( get_post_thumbnail_id( get_the_id() ) ) : false; 
    		$thumbnail = get_the_post_thumbnail( get_the_id(), 'mtf_medium' ); 
			if( $url ) 
				echo '<a href="' . $url . '">';
			echo $thumbnail;
			if( $url )
				echo '</a>';
    	} ?>
    	
    	<h1 class="post_title"><?php the_title(); ?></h1>
    	
    	<?php the_content(); ?>

<div class="clear"></div>
<?php comments_template(); ?>

</article>

</section>

<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>