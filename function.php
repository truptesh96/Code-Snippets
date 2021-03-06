/* Theme Option */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
		'redirect'		=> false
	));
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Custome Post Settings',
		'menu_title'	=> 'Custome Posts',
		'parent_slug'	=> 'theme-general-settings',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'General Page Settings',
		'menu_title'	=> 'General Page',
		'parent_slug'	=> 'theme-general-settings',
		'redirect'		=> false
	));
}


{{{ Changing Forgot password page Title }}}

function change_forgot_password_title($title,$id=null){
     if ( is_wc_endpoint_url( 'lost-password' ) ) {
        $title = 'Forgot Password';   
     }
     return $title;
}
add_filter( 'the_title', 'change_forgot_password_title', 10, 2 );

{{{ /Changing Forgot password page Title }}}



//Remove Gutenberg Block Library CSS from loading on the frontend
function optLoad(){ 
	
	if( basename(get_page_template()) == 'family-template.php' || basename(get_page_template()) == 'food-drink-menu.php' ||
	basename(get_page_template()) == 'sustainability.php'|| basename(get_page_template()) == 'visit-littleton.php' ||
	 basename(get_page_template()) == 'page-home.php'){
	    wp_dequeue_style( 'wp-block-library' );
	    wp_dequeue_style( 'wp-block-library-theme' );
	    wp_dequeue_style( 'wc-block-style' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );

		/*--- Woocommerce Files --*/
		wp_dequeue_script('zoom');
		wp_dequeue_style( 'select2' );
		wp_dequeue_script( 'select2' );
		wp_dequeue_script( 'wcqi-js' );
		wp_dequeue_script('woocommerce');
		wp_dequeue_script( 'wc-add-to-cart' );
		wp_dequeue_script('wc-single-product');
		wp_dequeue_script( 'wc-address-i18n' );
		wp_dequeue_script( 'wc-cart-fragments' );
		wp_dequeue_script( 'wc-country-select' );
		wp_dequeue_script( 'wc-add-to-cart-variation' );
		wp_dequeue_script('wc-credit-card-form');
		wp_dequeue_script('flexslider');
	}
}
add_action( 'wp_enqueue_scripts', 'optLoad', 10);

/*-------- Replace HTML Comments ----------*/
function callback($buffer) {
    $buffer = preg_replace('/<!--(.|s)*?-->/', '', $buffer);
    return $buffer;
}
function buffer_start() {
    ob_start("callback");
}
function buffer_end() {
    ob_end_flush();
}
add_action('get_header', 'buffer_start');
add_action('wp_footer', 'buffer_end');


/*-- Disable Woocommerce css --*/
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) { return 'full'; } );
add_filter( 'woocommerce_product_description_heading', '__return_null' );
add_filter( 'woocommerce_product_reviews_heading', '__return_null' );
