<?php

/**
 * Template Name: Crew
 */

get_header(); 

	echo '<div class="wrap" id="singlePage">';

		if ( have_posts() ) : while ( have_posts() ) : the_post();
			
			the_title("<h1>","</h1>");

			echo '<section class="copy">';
				the_content();
			echo '</section>';

		endwhile; endif;

		get_sidebar();

	echo '</div>';

get_footer();