<?php get_header();

	echo '<section id="videoModal" class="outer">';
		echo '<article class="inner">';
			echo '<i class="closeModal fa fa-times"></i>';
		echo '</article>';
	echo '</section>';

	echo '<h1>Blog</h1>';

	echo '<section class="filters">';
		echo '<i class="fa fa-sliders"></i>';
	    if (function_exists('dynamic_sidebar') && dynamic_sidebar('Blog Widgets'));
	echo '</section>';

	echo '<div class="wrap" id="blogListing">';

		$args = array(
			'post_status' => 'publish'
		);

		query_posts( $args );
		
		if (have_posts()) : while (have_posts()) : the_post();
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
			if(in_category('video')) {
				$vid = get_post_meta($post->ID,'video_link', true);
				echo '<a class="video" href="'.get_the_permalink().'" data-vid="'.$vid.'" data-id="'.$post->ID.'">';
					echo '<article style="background: url('.$image[0].') no-repeat scroll center / cover;"><div class="playwrap outer"><i class="fa fa-play inner"></i></div></article>';
					the_title("<h3>","</h3>");
				echo '</a>';
			} else {
				echo '<a href="'.get_the_permalink().'">';
					echo '<article style="background: url('.$image[0].') no-repeat scroll center / cover;"></article>';
					the_title("<h3>","</h3>");
				echo '</a>';
			}
		endwhile;
		endif;
	echo '</div>';
	
get_footer(); ?>