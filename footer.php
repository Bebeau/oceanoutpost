		<!-- <div data-parallax='{"y" : 230, "smoothness": 1}' class="footerWrap"> -->
			
			<div class="m-scooch m-fluid">
				<i class="arrow left fa fa-angle-left" data-m-slide="prev"></i>
				<i class="arrow right fa fa-angle-right" data-m-slide="next"></i>
				<div id="instafeed" class="m-scooch-inner"></div>
			</div>
			
			<section id="Newsletter">
				<?php 
				$news_image = get_option('news_image');
			    $news_header = get_option('news_header');
			    $news_text = get_option('news_text');
			    $news_button = get_option('news_button');
				if(!empty($news_image)) {
					echo '<div class="news_image"><img src="'.$news_image.'" alt="" /></div>';
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
				?>
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
					<h4>Customer Care</h4>
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
					<!-- <script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=pItXJFWCyHYvgN1n04wXaGJrm0Umh1hvYy4wPG7tX9GZu6vZKYcObSAD"></script>
					<script type="text/javascript" language="javascript">
						var ANS_customer_id="80bf5a55-f6c8-44f3-a96e-75dc1f54f6f3";
					</script> -->
					<!-- autorize.net seal  -->
					<!-- <script type="text/javascript" language="javascript" src="//verify.authorize.net/anetseal/seal.js" ></script> -->
					<p>Your transaction is 100% safe and secure.</p>
				</article>
			</footer>

		<!-- </div> -->
    
	</body>
</html>
<!-- WP Generated Header
================================================== --> 
<?php wp_head(); ?>

<?php wp_footer(); ?>  