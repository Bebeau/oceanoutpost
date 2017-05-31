<?php

add_action('admin_menu', 'oo_menu');

function oo_menu() {
	add_theme_page(
		'Theme Settings', 
		'Settings', 
		'edit_theme_options', 
		'theme-settings', 
		'oo_settings'
	);
}
function oo_settings() {
	echo '<div class="wrap">';

		echo '<h1>Theme Settings</h1>';
		echo '<p>This page is used to manage general theme settings.</p>';

        // Use nonce for verification
		settings_fields( 'theme_setup_options' );
	    do_settings_sections( 'theme_setup_options' );

	    $banner = get_option('banner_image');
	    $bannerHeader = get_option('banner_header');
	    $bannerCopy = get_option('banner_copy');
	    $buttonCopy = get_option('button_copy');
	    $buttonLink = get_option('button_link');

	    $news_image = get_option('news_image');
	    $news_header = get_option('news_header');
	    $news_text = get_option('news_text');
	    $news_button = get_option('news_button');

	    echo '<section id="HomepageBanner">';
		    echo '<article id="bannerImage">';
		    	echo '<h3>Homepage Banner</h3>';
		    	echo '<p>Upload a homepage banner image and set the copy using the fields below.</p>';
				echo '<div class="image-placeholder bg" style="background:url('.$banner.')no-repeat scroll center / cover;">';
					if ( empty($banner) ) {
				    	echo '<button class="upload-image button button-large button-primary" data-input="banner_image">Upload/Set Banner</button>';
					} else {
						echo '<button class="button remove-image" data-input="banner_image">X</button>';
					}
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
				echo '</div>';
			    echo '<input type="hidden" name="banner_image" id="banner_image" value="'.$banner.'" />';
			echo '</article>';

			echo '<article id="bannerHeader" class="text">';
				echo '<label for="banner_header">Header Text</label>';
				echo '<input type="text" name="banner_header" id="banner_header" placeholder="banner header.." value="'.$bannerHeader.'" data-element="header" />';
			echo '</article>';

			echo '<article id="bannerCopy" class="text">';
				echo '<label for="banner_copy">Sub Text</label>';
				echo '<input type="text" name="banner_copy" id="banner_copy" placeholder="banner text.." value="'.$bannerCopy.'" data-element="copy" />';
			echo '</article>';

			echo '<article id="buttonCopy" class="text">';
				echo '<label for="button_copy">Button Text</label>';
				echo '<input type="text" name="button_copy" id="button_copy" placeholder="button text.." value="'.$buttonCopy.'" data-element="button" />';
			echo '</article>';

			echo '<article id="buttonLink" class="text">';
				echo '<label for="button_link">Button Link</label>';
				echo '<input type="text" name="button_link" id="button_link" placeholder="http://.." value="'.$buttonLink.'" data-element="button" />';
			echo '</article>';
		echo '</section>';

		echo '<section id="NewsletterForm">';
			echo '<h3>Newsletter Form</h3>';
		    echo '<p>Upload an image and manage the message displayed on the newsletter forms.</p>';
			echo '<article id="newsImage">';
		    	echo '<div class="image-placeholder bg">';
					if ( empty($news_image) ) {
				    	echo '<button class="upload-image button button-large button-primary" data-input="news_image">Upload/Set Image</button>';
					} else {
						echo '<img src="'.$news_image.'" alt="" />';
						echo '<button class="button remove-image" data-input="news_image">X</button>';
					}
					echo '<section id="NewsletterCTA">';
						echo '<article>';
							if ( !empty($news_header)) {
								echo '<h1 class="news_header">'.$news_header.'</h1>';
							} else {
								echo '<h1 class="news_header">Satisfy Your Salt Craving</h1>';
							}
							if ( !empty($news_text)) {
								echo '<p class="news_text">'.$news_text.'</p>';
							} else {
								echo '<p class="news_text">Want to receive first dibs on cool salt water gear and special promotions? Join our mailing list.</p>';
							}
							echo '<input type="text" name="name" placeholder="name" />';
							echo '<input type="email" name="email" placeholder="email@address.." />';
							if(!empty($news_button) ) {
								echo '<button type="submit" class="news_button">'.$news_button.'</button>';
							} else {
								echo '<button type="submit" class="news_button">Sign Up</button>';
							}
						echo '</article>';
					echo '</section>';
				echo '</div>';
			    echo '<input type="hidden" name="news_image" id="news_image" value="'.$news_image.'" />';
			echo '</article>';
			echo '<article id="newsHeader" class="text">';
				echo '<label for="news_header">Newsletter Header</label>';
				echo '<input type="text" name="news_header" id="news_header" value="'.$news_header.'" data-element="news_header" />';
			echo '</article>';
			echo '<article id="newsText" class="text">';
				echo '<label for="news_text">Newsletter Text</label>';
				echo '<input type="text" name="news_text" id="news_text" value="'.$news_text.'" data-element="news_text" />';
			echo '</article>';
			echo '<article id="newsButton" class="text">';
				echo '<label for="news_button">Button Text</label>';
				echo '<input type="text" name="news_button" id="news_button" value="'.$news_button.'" data-element="news_button" />';
			echo '</article>';
		echo '</section>';

	echo '</div>';
}
// ajax response to save download track
add_action('wp_ajax_setImage', 'setCustomImage');
add_action('wp_ajax_nopriv_setImage', 'setCustomImage');
function setCustomImage() {
	$imageField = (isset($_GET['imageField'])) ? $_GET['imageField'] : 0;
	$imageURL = (isset($_GET['fieldVal'])) ? $_GET['fieldVal'] : 0;
	if($imageURL !== "") {
        update_option( $imageField, $imageURL);
    } else {
		update_option( $imageField, "");
	}
}
// ajax response to save download track
add_action('wp_ajax_setCopy', 'setCustomCopy');
add_action('wp_ajax_nopriv_setCopy', 'setCustomCopy');
function setCustomCopy() {
	$inputVal = (isset($_GET['inputVal'])) ? $_GET['inputVal'] : 0;
	$input = (isset($_GET['input'])) ? $_GET['input'] : 0;
	if($inputVal !== "") {
        update_option( $input, $inputVal);
    } else {
		update_option( $input, "");
	}
	echo $inputVal;
	die;
}