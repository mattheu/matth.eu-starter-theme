<?php get_header();  the_post();  ?>

<section class="primary_content posts">	

	<article <?php post_class(); ?>>
	
    	<h3 class="post_title"><?php the_title(); ?></h3>
    	<?php the_content(); ?>
    	
    	<form id="contact_form" class="clear">
    		<ul>
    			<li>
    				<label for="form_name">Name</label>
    				<span class="input_wrap">
	    				<input id="form_name" name="form_name" type="text" placeholder="Your Name" class="input_medium">
	    			</span>
    			</li>
    			<li>
    				<label for="form_email">Password</label>
    				<span class="input_wrap">
    					<input id="form_email" name="form_email" type="password" placeholder="Password" class="input_medium">
    				</span>
    			</li>
    			<li>
    				<label for="form_location">Location</label>
    				<span class="input_wrap">
    				<select id="form_location" name="form_location" class="input_medium">
    					<option>UK</option>
    					<option>Europe</option>
    					<option>North America</option>
    					<option>Rest of the World</option>
    				</select>
    				</span>
    			</li>
    			<li>
    				<label for="form_gender">Gender</label>
    				<input id="form_gender_m" name="form_gender" type="radio">
    				<label for="form_gender_m" class="secondary">Male</label>
    				<input id="form_gender_f" name="form_gender" type="radio">
    				<label for="form_gender_f" class="secondary">Female</label>
    			</li>
    			<li>
    				<label for="form_age">Date of Birth</label>
    				<span class="input_wrap">
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
	    			</span>
    			</li>
    			<li>
    				<label for="form_message">Message</label>
    				<span class="input_wrap input_full">
    					<textarea id="form_message" class="input_full" name="form_message" placeholder="Enter your message&hellip;"></textarea>
    				</span>
    			</li>
    			<li>
					<span class="input_wrap">
    					<input type="submit" class="primary" value="Submit"/>
    				</span>
    				<span class="input_wrap">
	    				<button>Cancel</button>
	    			</span>
    			</li>
    			<li>
    				<p class="description">Here are some other examples of buttons</p>
	    			<span class="input_wrap">	
	    				<a class="button">Click</a>
	    			</span>    			
		 			<span class="input_wrap">	
	    				<a class="button">1</a>
	    				<a class="button">2</a>
	    				<a class="button">3</a>
	    			</span>
    			</li>
    			<li>
	    			<span class="input_wrap">	
		    			<input type="text" placeholder="Search the site&hellip;" />
		    			<button class="primary search_small" />Search</button>
	    			</span>    			    			
    			</li>
    			<li>
	    			<span class="input_wrap circle">	
		    			<a href="#" class="button primary circle" />Search</a>
	    			</span>    			    			
    			</li>
    		</ul>
    	</form>
    	
	</article>

</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>