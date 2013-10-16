<?php

/**
 * Template Name: Style Guide - Forms
 */

get_header();

have_posts();

the_post();

?>

<div class="row">

	<section class="primary-content grid-8">

		<article <?php post_class( array( 'entry' ) ); ?>>

		    <?php get_template_part( 'single/header' ); ?>

			<div class="entry-content">
			
				<header class="entry-header">

				    <h1 class="entry-title">Style Guide &ndash; Forms</h1>

				</header>

				<form>

					<div class="form-row">
						<label for="input1">Text</label>
						<input id="input1" type="text" value="Value"/>
					</div>

					<div class="form-row">
						<label for="input2">Email</label>
						<input id="input2" type="email" placeholder="name@example.com"/>
						<p class="description">This is a description</p>
					</div>

					<div class="form-row">
						<label for="input3">Password</label>
						<input id="input3" type="password"/>
					</div>

					<div class="form-row form-row-error">
						<label for="input1">Error</label>
						<input id="input1" type="text"/>
					</div>

					<div class="form-row form-row-success">
						<label for="input1">Success</label>
						<input id="input1" type="text"/>
					</div>

					<div class="form-row">
						<label for="input1">Disabled</label>
						<input id="input1" type="text" value="Disabled" disabled/>
					</div>

					<div class="form-row">
						<label for="input1">Medium Input</label>
						<input id="input1" type="text" value="Medium Size Text" class="medium-text"/>
					</div>

					<div class="form-row">
						<label for="input1">Medium Small</label>
						<input id="input1" type="text" value="Small Txt" class="small-text"/>
					</div>

					<div class="form-row">
						<label for="input1">Medium Tiny</label>
						<input id="input1" type="text" value="3.5" class="tiny-text"/>
					</div>

					<div class="form-row form-row-radio">
						<div class="form-row-label">Radio Label</div>
						<label for="input4a">
							<input name="input4" id="input4a" type="radio" value="option1"/>
							Radio 1
						</label>
						<label for="input4b">
							<input name="input4" id="input4b" type="radio" value="option2"/>
							Radio 2
						</label>
						<label for="input4c">
							<input name="input4" id="input4c" type="radio" value="option3"/>
							Radio 3
						</label>
					</div>

					<div class="form-row form-row-checkbox">
						<label for="input5a">
							<input id="input5a" type="checkbox" value="option1"/>
							Radio 1
						</label>
						<label for="input5b">
							<input id="input5b" type="checkbox" value="option2"/>
							Radio 2
						</label>
						<label for="input5c">
							<input id="input5c" type="checkbox" value="option3"/>
							Radio 3
						</label>
					</div>

					<div class="form-row">
						<label for="input6">Select</label>
						<select id="input6">
							<option>Option 1</option>
							<option>Option 2</option>
							<option>Option 3</option>
						</select>
					</div>

					<div class="form-row">
						<label for="input7">Textarea</label>
						<textarea id="input7" rows="8"></textarea>
					</div>

					<div class="form-row form-footer">
						<input type="submit" value="Submit"/>
						<button type="submit">Button</button>
						<a class="button" href="#">Button</a>
					</div>					

					<div class="form-row form-footer">
						<button type="submit" class="button primary">Button</button>
						<button type="submit" class="button secondary">Button</button>
					</div>					

				</form>

			</div><!-- / .entry-content -->

		</article><!-- / .entry -->

	</section><!-- / .primary-content -->

	<section class="sidebar grid-4" role="complementary">
		
		<?php get_sidebar(); ?>
	
	</section><!-- .secondary-content .widget-area -->

</div>

<?php get_footer(); ?>