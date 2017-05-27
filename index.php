<?php get_header();
	echo '<h1>Blog</h1>';
	echo '<div class="wrap" id="blogListing">';
		if (have_posts()) : while (have_posts()) : the_post();
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
			echo '<a href="'.get_the_permalink().'">';
				echo '<article style="background: url('.$image[0].') no-repeat scroll center / cover;"></article>';
				the_title("<h3>","</h3>");
			echo '</a>';
		endwhile;
		endif;
	echo '</div>';
get_footer(); ?>