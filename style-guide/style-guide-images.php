<?php

/**
 * Style Guide - Images
 * Template Name: Style Guide - Images
 *
 * @package MPH Starter
 * @since 0.1.6
 */

get_header();

have_posts();

the_post();

// 1px black image.
$image = 'data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs=';

?>

<style>

	/* Hacky styles for this page */
	.test-image { height: 1.5rem;  } /* Force test images to 1.5rem as we are really demonstrating widths */
	#test-images [class^="grid"] > .inner { background: rgba(0,0,0,0.1); margin-bottom: 1.5rem; }

</style>

<div id="test-images" class="row">
	
	<div class="grid-12">
	    <h1 class="entry-title beta">Style Guide &ndash; Images</h1>
	    <p>Note that these images have a fixed height for demonstration purposes</p>
	</div>
	
	<div class="grid-12">
		<h1 class="entry-title beta">Fluid images</h1>
		<p>Images within grid elements should be fluid width and fit to the grid.</p>
	</div>

	<div class="grid-12">
		<div class="inner">
		
			<h2>Grid 12</h2>
			
			<img class="size-thumbnail test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-medium test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-large test-image" src="<?php echo $image; ?>" />

		</div>
	</div>

	<div class="grid-8">
		<div class="inner">
		
			<h2>Grid 8</h2>
			
			<img class="size-thumbnail test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-medium test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-large test-image" src="<?php echo $image; ?>" />

		</div>
	</div>

	<div class="grid-4">
		<div class="inner">

			<h2>Grid 4</h2>
			
			<img class="size-thumbnail test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-medium test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-large test-image" src="<?php echo $image; ?>" />

		</div>
	</div>

	<div class="grid-3">
		<div class="inner">

			<h2>Grid 3</h2>
			
			<img class="size-thumbnail test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-medium test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-large test-image" src="<?php echo $image; ?>" />

		</div>
	</div>

	<div class="grid-9">
		<div class="inner">
			
			<h2>Grid 9</h2>
			
			<img class="size-thumbnail test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-medium test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-large test-image" src="<?php echo $image; ?>" />

		</div>
	</div>

	<div class="grid-7">
		<div class="inner">

			<h2>Grid 7</h2>
			
			<img class="size-thumbnail test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-medium test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-large test-image" src="<?php echo $image; ?>" />

		</div>
	</div>

	<div class="grid-5">
		<div class="inner">
			
			<h2>Grid 5</h2>
			
			<img class="size-thumbnail test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-medium test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-large test-image" src="<?php echo $image; ?>" />

		</div>
	</div>

	<div class="grid-6">
		<div class="inner">

			<h2>Grid 6</h2>
			
			<img class="size-thumbnail test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-medium test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-large test-image" src="<?php echo $image; ?>" />

		</div>
	</div>

	<div class="grid-2">
		<div class="inner">
		
			<h2>Grid 2</h2>
			
			<img class="size-thumbnail test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-medium test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-large test-image" src="<?php echo $image; ?>" />

		</div>
	</div>

	<div class="grid-1">
		<div class="inner">
		
			<h2>G1</h2>
			
			<img class="size-thumbnail test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-medium test-image" src="<?php echo $image; ?>" />
			<br/>
			<img class="size-large test-image" src="<?php echo $image; ?>" />

		</div>
	</div>

</div>

<?php get_footer(); ?>