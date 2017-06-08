<?php get_header();
	echo '<div class="wrap" id="singlePage">';
		if (have_posts()) : while (have_posts()) : the_post();
			the_title("<h1>","</h1>");
			echo '<section class="copy">';
				$vid = get_post_meta($post->ID, 'video_link', true);
				if(!empty($vid)) {
					echo '<iframe width="100%" height="480" src="https://www.youtube.com/embed/'.$vid.'" frameborder="0" allowfullscreen showinfo="0"></iframe>';	
				}
				the_content();
				get_template_part( 'partials/theme/social', 'share' );
			echo '</section>';
		endwhile;
		endif;
		get_sidebar();
	echo '</div>';
get_footer(); ?>