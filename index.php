<?php get_header();  ?>

<?php if( have_posts() ) : ?>

<section id="main" class="posts">	

<?php while( have_posts() ) : the_post()  ?>

<article <?php post_class('clearfix'); ?>>
    	<?php 
    		if ( has_post_thumbnail() ) {  
    			//Defaults for featured image can be overwritten
    			//defined( 'MTF_FEATURED_IMAGE' ) ? $featured_image = unserialize( MTF_FEATURED_IMAGE ) : $featured_image = array( 'x' => 380, 'y' => 290 ); 
    			if( !isset( $mtf_featured_image_info ) ) $mtf_featured_image_info = array( 'x' => 380, 'y' => 290 );
    		?>
   			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array( $mtf_featured_image_info['x'], $mtf_featured_image_info['y'], 'crop' =>true, ' featured' ) ); ?></a>
   			<h3 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
   			<?php function_exists( 'mph_get_the_excerpt' ) ? mph_the_excerpt( '80', '<p><a href="#">Continue reading...</a></p>' ) : the_excerpt(); ?>
    	<?php } elseif( get_post_format() == 'quote' ) { ?>
    		<?php the_content() ;?>
    	<?php } else { ?>
    		<h3 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>    		
    		<?php function_exists( 'mph_get_the_excerpt' ) ? mph_the_excerpt( '150', '<p><a href="#">Continue reading...</a></p>' ) : the_excerpt(); ?>
    	<?php } ?>
    <p class="post_meta"><small><b>Posted: </b><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?> by <?php the_author_posts_link(); ?></small></p>
    
</article>

<?php endwhile; ?>

<?php 
    if( function_exists( 'hm_pagination' ) ) {
    	hm_pagination(); 
    } else {
    	echo '<p class="pagination">This is pagination</p>';
    }
?>

</section>

<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>