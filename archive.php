<?php get_header(); ?>
	<h1>Blog - <?php single_cat_title(); ?></h1>
	<?php 
	echo '<section class="filters">';
		echo '<i class="fa fa-sliders"></i>';
	    if (function_exists('dynamic_sidebar') && dynamic_sidebar('Blog Widgets'));
	echo '</section>';
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