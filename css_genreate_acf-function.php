// Hook into post update or publish
add_action('save_post', 'generate_post_css_file');

function generate_post_css_file($post_id) {
    // Ensure it's not an auto-save or a revision
    if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) {
        return;
    } 
	
    // Define the path to save the CSS file
    $upload_dir = wp_upload_dir();
    $css_dir = $upload_dir['basedir'] . '/assets/css/';
    $css_file = $css_dir . 'post' . $post_id . '.css';

    // Create the directory if it doesn't exist
    if (!file_exists($css_dir)) {
        wp_mkdir_p($css_dir);
    }

    // Start CSS output
    $dynamic_css = "";

    // Loop through ACF flexible content fields
    if( have_rows('flexible_sections', $post_id) ):
        while( have_rows('flexible_sections', $post_id) ): the_row();
            
            // Get section ID (assume you have a field or a way to assign it)
            $section_id = 'section_' . get_row_index(); // Can be customized

            // Background color
            if (get_sub_field('section_background')) {
                $section_background = get_sub_field('section_background');
                $dynamic_css .= "
                    #{$section_id} {
                        background: {$section_background};
                    }
                ";
            }

            // Spacing options
            if (have_rows('section_spacing_options')):
                while (have_rows('section_spacing_options')): the_row();

                    // Desktop spacing
                    $desktop_top_space = get_sub_field('desktop_top_space');
                    $desktop_bottom_space = get_sub_field('desktop_bottom_space');
                    if ($desktop_top_space != "" || $desktop_bottom_space != "") {
                        $dynamic_css .= "
                            #{$section_id} {
                                padding-top: {$desktop_top_space}px;
                                padding-bottom: {$desktop_bottom_space}px;
                            }
                        ";
                    }

                    // Laptop spacing
                    $laptop_top_space = get_sub_field('laptop_top_space');
                    $laptop_bottom_space = get_sub_field('laptop_bottom_space');
                    if ($laptop_top_space != "" || $laptop_bottom_space != "") {
                        $dynamic_css .= "
                            @media only screen and (max-width: 1441px) {
                                #{$section_id} {
                                    padding-top: {$laptop_top_space}px;
                                    padding-bottom: {$laptop_bottom_space}px;
                                }
                            }
                        ";
                    }

                    // iPad spacing
                    $ipad_top_space = get_sub_field('ipad_top_space');
                    $ipad_bottom_space = get_sub_field('ipad_bottom_space');
                    if ($ipad_top_space != "" || $ipad_bottom_space != "") {
                        $dynamic_css .= "
                            @media only screen and (max-width: 1200px) {
                                #{$section_id} {
                                    padding-top: {$ipad_top_space}px;
                                    padding-bottom: {$ipad_bottom_space}px;
                                }
                            }
                        ";
                    }

                    // Mobile spacing and background
                    $mobile_top_space = get_sub_field('mobile_top_space');
                    $mobile_bottom_space = get_sub_field('mobile_bottom_space');
                    $mobile_background = get_sub_field('mobile_background'); // Assuming you have this field
                    if ($mobile_top_space != "" || $mobile_bottom_space != "" || $mobile_background != "") {
                        $dynamic_css .= "
                            @media only screen and (max-width: 767px) {
                                #{$section_id} {
                                    padding-top: {$mobile_top_space}px;
                                    padding-bottom: {$mobile_bottom_space}px;
                                    background: {$mobile_background};
                                }
                            }
                        ";
                    }

                endwhile;
            endif;
            
        endwhile;
    endif;

	$dynamic_css = preg_replace('/\s+/', '', $dynamic_css);

    // Save the CSS content to the file
    file_put_contents($css_file, $dynamic_css);

    // Log or handle errors if file creation fails
}

// Enqueue the dynamically generated CSS for a specific post
add_action('wp_enqueue_scripts', 'enqueue_post_css');

function enqueue_post_css() {
   
	global $post;
	$post_id = $post->ID;
	$upload_dir = wp_upload_dir();
	$css_file_url = $upload_dir['baseurl'] . '/assets/css/post' . $post_id . '.css';

	// Only enqueue if the CSS file exists
	if (file_exists($upload_dir['basedir'] . '/assets/css/post' . $post_id . '.css')) {
		wp_enqueue_style('post' . $post_id, $css_file_url);
		wp_enqueue_style('page' . $post_id, $css_file_url);
	}
   
}
