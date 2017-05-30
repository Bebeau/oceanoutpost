		<!-- <div data-parallax='{"y" : 230, "smoothness": 1}' class="footerWrap"> -->
			
			<div class="m-scooch m-fluid">
				<i class="arrow left fa fa-angle-left" data-m-slide="prev"></i>
				<i class="arrow right fa fa-angle-right" data-m-slide="next"></i>
				<div id="instafeed" class="m-scooch-inner"></div>
			</div>
			
			<section id="Newsletter">
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

			<footer>
				<article>
					<h4>Community</h4>
					<?php
						$menu_args = array(		
				 			'theme_location'  => 'community-menu',		
				 			'menu'            => 'Community Menu',		
							'container'       => '',		
							'container_class' => '',		
							'container_id'    => '',		
							'menu_class'      => 'nav',		
				 			'menu_id'         => '',		
				 			'echo'            => true,		
				 			'fallback_cb'     => 'wp_page_menu',		
				 			'before'          => '',		
				 			'after'           => '',		
				 			'link_before'     => '',		
				 			'link_after'      => '',		
				 			'items_wrap'      => '<ul id="%1$s" class="%2$s inner">%3$s</ul>',		
				 			'depth'           => 0,		
				 			'walker'          => ''		
				 		);		
				 		wp_nav_menu($menu_args);
				 	?>
				</article>
				<article>
					<h4>Company</h4>
					<?php
						$menu_args = array(		
				 			'theme_location'  => 'company-menu',		
				 			'menu'            => 'Company Menu',		
							'container'       => '',		
							'container_class' => '',		
							'container_id'    => '',		
							'menu_class'      => 'nav',		
				 			'menu_id'         => '',		
				 			'echo'            => true,		
				 			'fallback_cb'     => 'wp_page_menu',		
				 			'before'          => '',		
				 			'after'           => '',		
				 			'link_before'     => '',		
				 			'link_after'      => '',		
				 			'items_wrap'      => '<ul id="%1$s" class="%2$s inner">%3$s</ul>',		
				 			'depth'           => 0,		
				 			'walker'          => ''		
				 		);		
				 		wp_nav_menu($menu_args);
				 	?>
				</article>
				<article>
					<h4>Customer Service</h4>
					<?php
						$menu_args = array(		
				 			'theme_location'  => 'customer-service-menu',		
				 			'menu'            => 'Customer Service Menu',		
							'container'       => '',		
							'container_class' => '',		
							'container_id'    => '',		
							'menu_class'      => 'nav',		
				 			'menu_id'         => '',		
				 			'echo'            => true,		
				 			'fallback_cb'     => 'wp_page_menu',		
				 			'before'          => '',		
				 			'after'           => '',		
				 			'link_before'     => '',		
				 			'link_after'      => '',		
				 			'items_wrap'      => '<ul id="%1$s" class="%2$s inner">%3$s</ul>',		
				 			'depth'           => 0,		
				 			'walker'          => ''		
				 		);		
				 		wp_nav_menu($menu_args);
				 	?>
				</article>
				<article>
					<h4>Secure Shopping Guaranteed</h4>
					<img src="<?php bloginfo('template_directory'); ?>/assets/images/payment.png" alt="" />
					<!-- godaddy seal -->
					<script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=pItXJFWCyHYvgN1n04wXaGJrm0Umh1hvYy4wPG7tX9GZu6vZKYcObSAD"></script>
					<script type="text/javascript" language="javascript">
						var ANS_customer_id="80bf5a55-f6c8-44f3-a96e-75dc1f54f6f3";
					</script>
					<!-- autorize.net seal  -->
					<script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script> 
				</article>
			</footer>

		<!-- </div> -->
    
	</body>
</html>

<?php wp_footer(); ?>  