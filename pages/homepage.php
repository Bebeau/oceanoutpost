<?php
/**
 * Template Name: Home Page
 */ 

get_header();

$banner = get_option('banner_image');
$bannerHeader = get_option('banner_header');
$bannerCopy = get_option('banner_copy');
$buttonCopy = get_option('button_copy');
$buttonLink = get_option('button_link');

if(!empty($banner)) { ?>
	<div data-parallax='{"y" : 230, "smoothness": 1}'>
	<?php echo '<section id="banner" style="background:url('.$banner.')no-repeat scroll center / cover">';
		if ( !empty($bannerHeader) || !empty($bannerCopy) || !empty($buttonCopy) || !empty($buttonLink) ) {
			echo '<section id="BannerCTA">';
				echo '<article>';
					if ( !empty($bannerHeader)) {
						echo '<h1 class="header">'.$bannerHeader.'</h1>';
					} else {
						echo '<h1 class="header">50% off sale</h1>';
					}
					if ( !empty($bannerCopy)) {
						echo '<p class="copy">'.$bannerCopy.'</p>';
					} else {
						echo '<p class="copy">Half off all saltwater performance wear.</p>';
					}
					if(!empty($buttonLink) && !empty($buttonCopy) ) {
						echo '<a class="button" href="'.$buttonLink.'">'.$buttonCopy.'</a>';
					} else {
						echo '<a class="button" href="'.get_permalink(wc_get_page_id( 'shop' )).'">Shop Now</a>';
					}
				echo '</article>';
			echo '</section>';
		}
	echo '</section>'; ?>
	</div>
<?php
}
	
echo '</section>';

echo '<section class="main">';

	echo '<ul id="divider">';
		echo '<li><i class="fa fa-check"></i> Free Shipping</li>';
		echo '<li><i class="fa fa-check"></i> Privacy Valued</li>';
		echo '<li><i class="fa fa-check"></i> 100% Secure Ordering</li>';
		echo '<li><i class="fa fa-check"></i> Trusted Brand</li>';
	echo '</ul>';

	echo '<section class="wrap" id="cats">';
		$terms = get_terms( 
			array(
			    'taxonomy' => 'product_cat',
			    'hide_empty' => false,
			    'include' => array(158,159,42),
			    'orderby' => 'include'
			)
		);
		foreach($terms as $cat) {
			// get the thumbnail id using the queried category term_id
		    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 
		    // get the image URL
		    $image = wp_get_attachment_image_src( $thumbnail_id, 'medium', false );
		    echo '<article>';
		    	echo '<a href="'.get_term_link($cat->term_id).'">';
					echo '<h3>'.$cat->name.'</h3>';
					echo '<img src="'.$image[0].'" alt="" />';
				echo '</a>';
			echo '</article>';
		}
	echo '</section>';

	echo '<div class="nomobile">';

		echo '<section id="tabs">';
			echo '<ul>';
				echo '<li data-tab="1" class="active">Featured</li>';
				echo '<li data-tab="2">Best Sellers</li>';
				echo '<li data-tab="3">On Sale</li>';
			echo '</ul>';
		echo '</section>';

		echo '<section class="wrap" id="tabListing">';

			echo '<article data-tab="1" class="active">';
				echo do_shortcode('[featured_products per_page="4" columns="4"]');
			echo '</article>';

			echo '<article data-tab="2">';
				echo do_shortcode('[best_selling_products per_page="4" columns="4"]');
			echo '</article>';

			echo '<article data-tab="3">';
				echo do_shortcode('[sale_products per_page="4" columns="4"]');
			echo '</article>';

		echo '</section>';

	echo '</div>';

	echo '<div class="showmobile">';
		echo do_shortcode('[featured_products per_page="8"]');
	echo '</div>';

echo '</section>';
			
get_footer(); ?>