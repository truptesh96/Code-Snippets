{{{ Theme Options }}}
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
{{{ /Theme Options }}}

{{{ ACF Color Picker Options }}}
function lsq_acf_input_admin_footer() { ?>
	<script type="text/javascript">
		(function($) {
			acf.add_filter('color_picker_args', function( args, $field ){
				args.palettes = [
					'#667DB7',
					'#5FB77B',
					'#EC8B6B']
				return args;
			});
		})(jQuery);
	</script><?php 
}
add_action('acf/input/admin_footer', 'lsq_acf_input_admin_footer');
{{{ /ACF Color Picker Options }}}

{{{ Changing Forgot password page Title }}}

function change_forgot_password_title($title,$id=null){
     if ( is_wc_endpoint_url( 'lost-password' ) ) {
        $title = 'Forgot Password';   
     }
     return $title;
}
add_filter( 'the_title', 'change_forgot_password_title', 10, 2 );

{{{ /Changing Forgot password page Title }}}


{{{ Forgot Password Form }}}
function my_custom_password_form() {
		global $post;
		$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
		$output = '
		<div class="boldgrid-section">
			<div class="container">
				<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="form-inline post-password-form" method="post">
					
					<h2 class="font24 head">' . __( 'This content is password protected. <br/>To view it please enter your password below:' ) . '</h2>
					<div class="dflex">
					<input placeholder="Enter Password" name="post_password" id="' . $label . '" type="password" size="20" class="form-control" /><button type="submit" name="Submit" class="btn gformButton">' . esc_attr_x( 'Enter', 'post password form' ) . '</button></div>
					
				</form>
			</div>
		</div>';
	return $output;
}
add_filter('the_password_form', 'my_custom_password_form', 99);
{{{ /Forgot Password Form }}}
 


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



// Hook For converting Gravity Form submit input to Button
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    $formID = 'submitIDarw'.$form['id'];
    $arrowHTML = '<span class="arrowIcon"><svg viewBox="0 0 55 55" version="1.1" height="55" width="55" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g><defs><mask id="'.$formID.'"><path transform="translate(0.000000, -0.805443)" d="M0.61384,1.56259302 C12.8982633,13.7875859 29.147553,30.0329294 49.3617089,50.2986233 C45.2447981,42.1633 42.6012642,35.4055475 41.4311073,30.0253656 C39.6758718,21.9550929 42.3161064,9.11081066 43.556567,4.97518359 C44.7970276,0.83955651 52.7707887,-5.01656182 52.7707887,0.218989163 C52.7707887,3.70935648 52.7401709,21.5496784 52.6789352,53.739955 L0.61384,53.2324435 C-11.6705833,6.56088358 -11.6705833,-10.6623999 0.61384,1.56259302 Z" stroke="#ffffff" stroke-width="4" stroke-linejoin="round" class="mask"></path></mask></defs> <g fill="#fff" fill-rule="nonzero" mask="url(#'.$formID.')" class="arrow-thin"><polygon points="53.67518 0.75715 53.717 53.86178 0.61384 53.81848 0.6149 51.4874 49.73851 51.52698 1.4953 2.9774 3.14855 1.33461 51.38367 49.87752 51.34409 0.75821"></polygon></g></g></g></svg></span>';
    
    return "<button class='button themeButton gformButton' id='gform_submit_button_{$form['id']}'><span class='text upcase'>{$form['button']['text']}</span>".$arrowHTML."</button>";
}
