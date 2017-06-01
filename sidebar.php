<section id="sidebar">
	<?php 
		if(is_shop() || is_product_category()) {
			echo '<i class="fa fa-sliders"></i>';
			do_action( 'woocommerce_before_shop_loop' );
		    if (function_exists('dynamic_sidebar') && dynamic_sidebar('Shop Widgets'));
		} else {
			$news_image = get_option('news_image');
		    $news_header = get_option('news_header');
		    $news_text = get_option('news_text');
		    $news_button = get_option('news_button');
			
			echo '<section id="Newsletter">';
				if(!empty($news_image)) {
					echo '<img src="'.$news_image.'" alt="" />';
				} else {
					echo '<img class="default" src="'.get_bloginfo('template_directory').'/assets/images/mahi.png" alt="" />';
				}
				echo '<form method="POST" action="https://www.aweber.com/scripts/addlead.pl" id="newsletterFrm">';
					if(!empty($news_header)) {
						echo '<h3>'.$news_header.'</h3>';
					} else {
						echo '<h3>Satisfy Your Salt Craving</h3>';
					}
					if(!empty($news_text)) {
						echo '<p>'.$news_text.'</p>';
					} else {
						echo '<p>Want to receive first dibs on cool salt water gear and special promotions? Join our mailing list.</p>';
					}
					echo '<input type="text" name="name" placeholder="name" />';
					echo '<input type="email" name="email" placeholder="email@address.." />';
					if(!empty($news_button)) {
						echo '<button type="submit" class="btn-submit">'.$news_button.'</button>';
					} else {
						echo '<button type="submit" class="btn-submit">Sign Up</button>';
					}
					echo '<input type="hidden" name="listname" value="awlist3743049" />';
				echo '</form>';
			echo '</section>';
			
			echo do_shortcode('[sale_products per_page="1" columns="1"]');
		}
 	?>
</section>