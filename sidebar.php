<section id="sidebar">
	<?php 
		if(is_shop() || is_product_category()) {
			echo '<i class="fa fa-sliders"></i>';
		    if (function_exists('dynamic_sidebar') && dynamic_sidebar('Shop Widgets'));
		} else { ?>
			<section id="Newsletter">
				<img src="<?php echo bloginfo('template_directory');?>/assets/images/mahi.png" alt="" />
				<article>
					<h3>Satisfy Your Salt Craving</h3>
					<p>Want to receive first dibs on cool salt water gear and special promotions? Join our mailing list.</p>
				</article>
				<form method="POST" action="">
					<input type="text" name="fname" placeholder="first name" />
					<input type="text" name="lname" placeholder="last name" />
					<input type="email" name="email" placeholder="email@address.." />
					<button type="submit">Sign Up</button>
				</form>
			</section>
			<?php echo do_shortcode('[sale_products per_page="1" columns="1"]');
		}
 	?>
</section>