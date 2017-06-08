<?php
/*
Template Name: Contact Page
*/
?>

<?php get_header();

	the_title("<h1>","</h1>");
			    	
	if(have_posts()) : while(have_posts()) : the_post();

	echo '<div class="wrap" id="contactPage">';

		the_content(); ?>

		<form action="" method="post" id="contactfrm">
			
			<section>
				<div>
					<label for="fname" class="control-label"> First Name <span class="required">*</span></label>
					<input type="text" name="fname" id="fname" value="" placeholder="first name" />
				</div>
				<div>
					<label for="lname" class="control-label"> Last Name <span class="required">*</span></label>
					<input type="text" name="lname" id="lname" value="" placeholder="last name" />
				</div>
			</section>

			<section>
		    	<label for="emailaddress" class="control-label"> Email Address  <span class="required">*</span></label>
				<input type="text" name="emailaddress" id="emailaddress" value="" placeholder="email@address..."/> 
			</section>

			<section>
		    	<label for="message" class="control-label"> Message <span class="required">*</span></label>
		    	<textarea name="message" id="message" placeholder="Tell us what you think..."></textarea> 
			</section>

			<button type="submit" class="button btn-submit">Send Message</button>

			<div id="security">
				If you see this, leave this form field blank.
				<input type="text" name="checked" id="checked" value="" />
			</div>
	        
	    </form>

   <?php

   echo '</div>';

   endwhile; endif; ?>

<?php get_footer(); ?>