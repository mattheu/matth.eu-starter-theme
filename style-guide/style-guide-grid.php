<?php

/**
 * Style Guide - Grid
 * Template Name: Style Guide - Grid
 *
 * @package MPH Starter
 * @since 0.1.6
 */

get_header();

the_post();

?>

<div id="grid-demo">
	
	<div class="row">
		<div class="grid-12">
			<h1 class="entry-title beta">Style Guide &ndash; Grid</h1>
			<p>12 column fluid grid. Columns are fluid width (specified in percentages) but gutters are fixed. This is achieved using <code>padding</code> and <code>display: border-box</code>. 
			<br/>
		</div>
	</div>

	<div class="row">
		
		<div class="grid-12"><h2>Standard Grid</h2></div>

		<div class="grid-1"><div class="grid-content">1</div></div>
		<div class="grid-1"><div class="grid-content">1</div></div>
		<div class="grid-2"><div class="grid-content">2</div></div>
		<div class="grid-2"><div class="grid-content">2</div></div>
		<div class="grid-6"><div class="grid-content">6</div></div>
	
		<div class="grid-3"><div class="grid-content">3</div></div>
		<div class="grid-3"><div class="grid-content">3</div></div>
		<div class="grid-3"><div class="grid-content">3</div></div>
		<div class="grid-3"><div class="grid-content">3</div></div>
	
		<div class="grid-4"><div class="grid-content">4</div></div>
		<div class="grid-4"><div class="grid-content">4</div></div>
		<div class="grid-4"><div class="grid-content">4</div></div>
	
		<div class="grid-9"><div class="grid-content">9</div></div>
		<div class="grid-3"><div class="grid-content">3</div></div>
	
		<div class="grid-4"><div class="grid-content">4</div></div>
		<div class="grid-8"><div class="grid-content">8</div></div>
	
		<div class="grid-12"><div class="grid-content">12</div></div>
	
	</div>



	<div class="row">
		
		<div class="grid-12"><h2>Nested Grids</h2></div>

		<div class="grid-8">
			<div class="grid-content">
				<div class="row">
					<div class="grid-8"><div class="grid-content">8</div></div>
					<div class="grid-4"><div class="grid-content">4</div></div>
					<div class="grid-2"><div class="grid-content">2</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
				</div>
			</div>
		</div>

		<div class="grid-4">
			<div class="grid-content">
				<div class="row">
					<div class="grid-4"><div class="grid-content">4</div></div>
					<div class="grid-2"><div class="grid-content">2</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
				</div>
			</div>
		</div>


		<div class="grid-3">
			<div class="grid-content">
				<div class="row">
					<div class="grid-3"><div class="grid-content">3</div></div>
					<div class="grid-2"><div class="grid-content">2</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
				</div>
			</div>
		</div>


		<div class="grid-9">
			<div class="grid-content">
				<div class="row">
					<div class="grid-9"><div class="grid-content">9</div></div>
					<div class="grid-6"><div class="grid-content">6</div></div>
					<div class="grid-3"><div class="grid-content">3</div></div>
					<div class="grid-5"><div class="grid-content">5</div></div>
					<div class="grid-4"><div class="grid-content">4</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
					<div class="grid-1"><div class="grid-content">1</div></div>
				</div>
			</div>
		</div>


	</div>

	<div class="row">
		
		<div class="grid-12"><h2>2x Nested Grids</h2></div>

		<div class="grid-8">
			<div class="grid-content">
				<div class="row">
					<div class="grid-6"><div class="grid-content">
						<div class="row">
							<div class="grid-4"><div class="grid-content">6</div></div>
							<div class="grid-2"><div class="grid-content">4</div></div>
							<div class="grid-2"><div class="grid-content">2</div></div>
							<div class="grid-2"><div class="grid-content">3</div></div>
							<div class="grid-2"><div class="grid-content">1</div></div>
						</div>
					</div></div>

					<div class="grid-2"><div class="grid-content">
						<div class="row">
							<div class="grid-2"><div class="grid-content">2</div></div>
							<div class="grid-1"><div class="grid-content">1</div></div>
							<div class="grid-1"><div class="grid-content">1</div></div>
						</div>
					</div></div>

				</div>
			</div>
		</div>
			
		<div class="grid-4">
			<div class="grid-content">
				<div class="row">
					<div class="grid-2"><div class="grid-content">
						<div class="row">
							<div class="grid-2"><div class="grid-content">2</div></div>
							<div class="grid-1"><div class="grid-content">1</div></div>
							<div class="grid-1"><div class="grid-content">1</div></div>
						</div>
					</div></div>

					<div class="grid-2"><div class="grid-content">
						<div class="row">
							<div class="grid-2"><div class="grid-content">2</div></div>
							<div class="grid-1"><div class="grid-content">1</div></div>
							<div class="grid-1"><div class="grid-content">1</div></div>
						</div>
					</div></div>
					
				</div>
			</div>
		</div>

	</div>

</div>

<?php get_footer(); ?>