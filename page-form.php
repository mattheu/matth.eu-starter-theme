<?php get_header();  ?>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post();  ?>

<section class="primary-content entries">

<article <?php post_class( array( 'entry' ) ); ?>>
    	<h3 class="post-title"><?php the_title(); ?></h3>
    	<?php the_content(); ?>

    	<form id="contact_form" class="clear form-horizontal">
    		<ul>
    			<li class="control-group">
    				<label for="form_name" class="control-label">Name</label>
    				<div class="controls">
		    			<input id="form_name" name="form_name" type="text" placeholder="Your Name" class="input_medium">
	    			</div>
    			</li>
    			<li class="control-group">
    				<label for="form_email" class="control-label">Password</label>
    				<div class="controls">
    						<input id="form_email" name="form_email" type="password" placeholder="Password" class="input_medium">
    				</div>
    			</li>
    			<li class="control-group">
    				<label for="form_location" class="control-label">Location</label>
    				<div class="controls">
    				<select id="form_location" name="form_location" class="input_medium">
    					<option>UK</option>
    					<option>Europe</option>
    					<option>North America</option>
    					<option>Rest of the World</option>
    				</select>
    				</div>
    			</li>
    			<li class="control-group">
    				<label for="form_gender" class="control-label">Gender</label>

    				<div class="controls">
    				<label for="form_gender_m" class="secondary">
    					<input id="form_gender_m" name="form_gender" type="radio">
    					Male
    				</label>
    				<label for="form_gender_f" class="secondary">
    					<input id="form_gender_f" name="form_gender" type="radio">
    					Female
    				</label>
    				</div>
    			</li>
    			<li class="control-group">
    				<label for="form_age" class="control-label">Date of Birth</label>
    				<div class="controls">
	    				<select>
	    					<?php for( $i = 0; $i < 31; $i ++ ) : ?>
	    					<option><?php echo $i; ?></option>
	    					<?php endfor; ?>
	    				</select>
	    				<select>
	    					<option>January</option>
	    					<option>Febuary</option>
	    					<option>March</option>
	    					<option>April</option>
	    					<option>May</option>
	    					<option>June</option>
	    					<option>July</option>
	    					<option>August</option>
	    					<option>September</option>
	    					<option>October</option>
	    					<option>November</option>
	    					<option>December</option>
	    				</select>
						<select>
							<?php for( $i = date('Y') - 100; $i <= date('Y'); $i++ ) : ?>
							<option <?php selected( date('Y') - 50, $i ); ?>><?php echo $i; ?></option>
							<?php endfor; ?>
						</select>
	    			</div>
    			</li>
    			<li class="control-group">
    				<label for="form_message" class="control-label">Message</label>
    				<div class="controls">
    					<textarea id="form_message" class="input_full" name="form_message" placeholder="Enter your message&hellip;"></textarea>
    				</div>
    			</li>
    			<li class="control-group">
					<div class="controls">
    					<p>
    						<input type="submit" class="btn primary" value="Submit"/>
    						<button class="btn btn-primary">Button</button>
		    				<a href="#" class="btn">Link</a>
		    			</p>
		    			<p>
		    				<button class="btn btn-primary" disabled>Primary</button>
		    				<button class="btn btn-info">Info</button>
		    				<button class="btn btn-danger">Danger</button>
		    				<button class="btn btn-success">Success</button>
							<button class="btn btn-warning">Warning</button>
		    			</p>
		    			<p>
		    				<button class="btn btn-small">Primary</button>
		    			</p>

	    			</div>
    			</li>
    		</ul>
    	</form>

</article>

</section>

<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>