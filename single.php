<?php get_header();  ?>


<?php if( have_posts() ) : while( have_posts() ) : the_post();  ?>

<section id="main" class="posts">	

<article class="post v type-post status-publish format-standard hentry category-uncategorized post clearfix">
    	
    	<?php if ( has_post_thumbnail() ) {  
    		//Defaults for featured image can be overwritten
    		if( !isset( $mtf_featured_image_info ) ) $mtf_featured_image_info = array( 'x' => 380, 'y' => 290 );
    		the_post_thumbnail( array( $mtf_featured_image_info['x'], $mtf_featured_image_info['y'], 'crop' =>true, ' featured' ) );
    	} ?>
    	<h3 class="post_title"><?php the_title(); ?></h3>
    	<?php the_content(); ?>

<div class="clear"></div>
<?php comments_template(); ?>

</article>

</section>

<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>