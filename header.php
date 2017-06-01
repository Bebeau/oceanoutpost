<!DOCTYPE html>

<html <?php language_attributes(); ?> xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope itemtype="http://schema.org/Article">

<head>
	<!-- Basic Page Needs
	================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="google-site-verification" content="" />

	<title><?php wp_title(); ?></title>
	<meta name="keywords" content="" />
	<meta name="author" content="The INiT Group">
	
	<!-- Mobile Specific Metas
  	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon/favicon.ico">
	<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/favicon/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/favicon/apple-touch-icon-114x114.png">
	
	<!-- Facebook open graph tags -->
	<meta property="og:title" content="<?php the_title(); ?>"/>
	<meta property="og:description" content="<?php
	  if ( function_exists('WPSEO_Meta::get_value()') ) {
	    echo WPSEO_Meta::get_value('metadesc');
	  } else {
	    echo $post->post_excerpt;
	  }
	?>"/>

	<?php if (have_posts()):while(have_posts()):the_post(); endwhile; endif;?>
		<meta property="fb:app_id" content="496408310403833" />
	<?php if (is_single()) { ?>
		<!-- Open Graph -->
		<meta property="og:url" content="<?php the_permalink(); ?>"/>
		<meta property="og:title" content="<?php single_post_title(''); ?>" />
		<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt()); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:image" content="<?php if (function_exists('wp_get_attachment_thumb_url')) {
			echo wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'medium', false );
		} ?>" />
		<!-- Schema.org -->
		<meta itemprop="name" content="<?php single_post_title(''); ?>"> 
		<meta itemprop="description" content="<?php echo strip_tags(get_the_excerpt()); ?>"> 
		<meta itemprop="image" content="<?php if (function_exists('wp_get_attachment_thumb_url')) {
			echo wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'medium', false );
		} ?>">
		<!-- Twitter Cards -->
		<meta property="twitter:card" content="summary"> 
		<meta property="twitter:site" content="@oceanoutpost"> 
		<meta property="twitter:title" content="<?php single_post_title(''); ?>"> 
		<meta property="twitter:description" content="<?php echo strip_tags(get_the_excerpt()); ?>"> 
		<meta property="twitter:creator" content="@oceanoutpost"> 
		<meta property="twitter:image" content="<?php if (function_exists('wp_get_attachment_thumb_url')) {
			echo wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'medium', false );
		} ?>">
		<meta property="twitter:url" content="<?php the_permalink(); ?>" />
		<meta property="twitter:domain" content="<?php echo site_url(); ?>">
	<?php } else { ?>
		<!-- Open Graph -->
		<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
		<meta property="og:description" content="<?php bloginfo('description'); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="<?php echo bloginfo('template_directory'); ?>/assets/images/default_facebook.jpg" />
		<!-- Schema.org -->
		<meta itemprop="name" content="<?php bloginfo('name'); ?>"> 
		<meta itemprop="description" content="<?php bloginfo('description'); ?>"> 
		<meta itemprop="image" content="<?php echo bloginfo('template_directory'); ?>/assets/images/default_google.jpg">
		<!-- Twitter Cards -->
		<meta property="twitter:card" content="summary"> 
		<meta property="twitter:site" content="@oceanoutpost"> 
		<meta property="twitter:title" content="<?php bloginfo('name'); ?>"> 
		<meta property="twitter:description" content="<?php bloginfo('description'); ?>"> 
		<meta property="twitter:creator" content="@oceanoutpost"> 
		<meta property="twitter:image" content="<?php echo bloginfo('template_directory'); ?>/assets/images/default_twitter.jpg">
		<meta property="twitter:url" content="<?php the_permalink() ?>" />
		<meta property="twitter:domain" content="<?php echo site_url(); ?>">
	<?php } ?>
    
</head>

<style>
	@import url('https://fonts.googleapis.com/css?family=Shadows+Into+Light');
	#loader{
		position: fixed;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: #00A4E1;
		top: 0;
	}
	#loader i {
		display: block;
		position: fixed;
		font-size: 48pt;
		top: 50%;
		left: 50%;
		margin: -32.5px 0 0 -28px;
		color: white;
	}
</style>

<body <?php body_class(); ?>>
<?php global $woocommerce; ?>

<div id="loader">
	<i class="fa fa-spinner fa-spin"></i>
</div>

<header>
	<div class="nomobile">
		<section id="topbar">
			<article>
				FAST, FREE SHIPPING ON EVERYTHING…EVERYDAY!
			</article>
			<article class="right">
				<?php get_template_part( 'partials/theme/social', 'links' ); ?>
				<a class="cartbutton" href="<?php echo $woocommerce->cart->get_cart_url(); ?>">
					<i class="fa fa-shopping-cart"></i> Cart ( <?php echo $woocommerce->cart->get_cart_contents_count(); ?> ) 
				</a>
			</article>
		</section>
		<section id="subbar">
			<article>
				Customer Care - <?php if( get_option('phone')) { echo '<a href="tel:8039840144" />'.get_option('phone').'</a>'; } ?>
			</article>
			<article class="right">
				<?php
					$menu_args = array(		
			 			'theme_location'  => 'top-menu',		
			 			'menu'            => 'Top Menu',		
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
		</section>
		<section id="mainbar">
			<article>
				<a href="<?php echo site_url(); ?>">
					<img src="<?php bloginfo('template_directory');?>/assets/images/logo.svg" alt="Ocean Outpost" />
				</a>
			</article>
			<article class="right">
				<?php
					$menu_args = array(		
			 			'theme_location'  => 'main-menu',		
			 			'menu'            => 'Main Menu',		
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
		</section>
	</div>
	<div class="showmobile">
		<section id="mobileHeader">
			<a href="<?php echo site_url(); ?>">
				<img class="logo" src="<?php bloginfo('template_directory');?>/assets/images/mobile_logo.svg" alt="Ocean Outpost" />
			</a>
			<article class="right">
				<a class="cartbutton" href="<?php echo $woocommerce->cart->get_cart_url(); ?>">
					<i class="fa fa-shopping-cart"></i> ( <?php echo $woocommerce->cart->get_cart_contents_count(); ?> ) 
				</a>
				<div class="Menu">	
					<span class="bar cross"></span>		
					<span class="bar middle"></span>		
					<span class="bar cross"></span>		
				</div>
			</article>
		</section>
		<?php
		echo '<div class="outer dropdown">';
			$menu_args = array(		
	 			'theme_location'  => 'mobile-menu',		
	 			'menu'            => 'Mobile Menu',		
				'container'       => '',		
				'container_class' => '',		
				'container_id'    => '',		
				'menu_class'      => 'nav inner',		
	 			'menu_id'         => '',		
	 			'echo'            => true,		
	 			'fallback_cb'     => 'wp_page_menu',		
	 			'before'          => '',		
	 			'after'           => '',		
	 			'link_before'     => '',		
	 			'link_after'      => '',		
	 			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',		
	 			'depth'           => 0,		
	 			'walker'          => ''		
	 		);		
	 		wp_nav_menu($menu_args);
	 	echo '</div>';
	 	?>
	</div>
</header>