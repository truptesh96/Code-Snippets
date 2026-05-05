<?php 

// Add customizer options
function theme_customizer_register($wp_customize) {
    // Add a section for theme options
    $wp_customize->add_section('theme_options', array(
        'title' => __('Theme Options', 'theme_slug'),
        'priority' => 200,
    ));

    // Add settings and controls for theme colors
    $colors = [
        'theme-color1' => ['#F01F6D', 'Primary Color'],
        'theme-color2' => ['#7E38B7', 'Secondary Color'],
        'theme-color3' => ['#FFF5CB', 'Tertiary Color'],
        'theme-color4' => ['#121212', 'Quaternary Color'],
        'button_color' => ['#F01F6D', 'Button Color'],
        'button_hover_color' => ['#7E38B7', 'Button Hover Color'],
        'gradient_color1' => ['#F01F6D', 'Gradient Color1'],
        'gradient_color2' => ['#7E38B7', 'Gradient Color2']
    ];

    foreach ($colors as $color => $settings) {
        $wp_customize->add_setting($color, array(
            'default' => $settings[0],
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $color, array(
            'label' => __($settings[1], 'Proven_Layout_3.0'),
            'section' => 'theme_options',
            'settings' => $color,
        )));
    }

    // Body font family
    $wp_customize->add_setting('body_font_family', array(
        'default' => 'Poppins, sans-serif',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('body_font_family', array(
        'label' => __('Body Font Family', 'Proven_Layout_3.0'),
        'section' => 'theme_options',
        'type' => 'select',
        'choices' => array(
            'Inter, sans-serif' => 'Inter, sans-serif',
            'Poppins, sans-serif' => 'Poppins, sans-serif',
            'Lato, sans-serif' => 'Lato, sans-serif',
            'Open Sans, sans-serif' => 'Open Sans, sans-serif',
            'Work Sans, sans-serif' => 'Work Sans, sans-serif',
            'Montserrat, sans-serif' => 'Montserrat, sans-serif',
            'Nunito, sans-serif' => 'Nunito, sans-serif',
            'PT Sans, sans-serif' => 'PT Sans, sans-serif',
            'Roboto, sans-serif' => 'Roboto, sans-serif',
        ),
    ));

    // Heading font family
    $wp_customize->add_setting('heading_font_family', array(
        'default' => 'Inter, sans-serif',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('heading_font_family', array(
        'label' => __('Heading Font Family', 'Proven_Layout_3.0'),
        'section' => 'theme_options',
        'type' => 'select',
        'choices' => array(
            'Inter, sans-serif' => 'Inter, sans-serif',
            'Poppins, sans-serif' => 'Poppins, sans-serif',
            'Lato, sans-serif' => 'Lato, sans-serif',
            'Open Sans, sans-serif' => 'Open Sans, sans-serif',
            'Work Sans, sans-serif' => 'Work Sans, sans-serif',
            'Montserrat, sans-serif' => 'Montserrat, sans-serif',
            'Inter, sans-serif' => 'Inter, sans-serif',
            'Nunito, sans-serif' => 'Nunito, sans-serif',
            'PT Sans, sans-serif' => 'PT Sans, sans-serif',
            'Roboto, sans-serif' => 'Roboto, sans-serif',
        ),
    ));
}
add_action('customize_register', 'theme_customizer_register');



// Load fonts based on selected option
function load_custom_fonts() {
    $body_font = get_theme_mod('body_font_family');
    $heading_font = get_theme_mod('heading_font_family');
    
    if ($body_font == 'Poppins, sans-serif' || $heading_font == 'Poppins, sans-serif') {
        echo '<style>';
         ?>
        @font-face {
          font-family: 'Poppins';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Black.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Black.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Black.ttf') format('truetype');
          font-weight: 900;
          font-style: normal;
          font-display: swap;
        }

        @font-face {
          font-family: 'Poppins';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Bold.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Bold.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Bold.ttf') format('truetype');
          font-weight: bold;
          font-style: normal;
          font-display: swap;
        }

        @font-face {
          font-family: 'Poppins';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-SemiBold.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-SemiBold.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-SemiBold.ttf') format('truetype');
          font-weight: 600;
          font-style: normal;
          font-display: swap;
        }

        @font-face {
          font-family: 'Poppins';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Light.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Light.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Light.ttf') format('truetype');
          font-weight: 300;
          font-style: normal;
          font-display: swap;
        }

        @font-face {
          font-family: 'Poppins';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Regular.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Regular.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Regular.ttf') format('truetype');
          font-weight: normal;
          font-style: normal;
          font-display: swap;
        }
    
        @font-face {
          font-family: 'Poppins';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Medium.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Medium.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Medium.ttf') format('truetype');
          font-weight: 500;
          font-style: normal;
          font-display: swap;
        }
 
        @font-face {
          font-family: 'Poppins';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Italic.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Italic.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Poppins-Italic.ttf') format('truetype');
          font-weight: normal;
          font-style: italic;
          font-display: swap;
        }
 
        <?php
        echo '</style>';
    }

    if ($body_font == 'Inter, sans-serif' || $heading_font == 'Inter, sans-serif') {
        echo '<style>';
      ?>
        @font-face {
          font-family: 'Inter';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Black.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Black.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Black.ttf') format('truetype');
          font-weight: 900;
          font-style: normal;
          font-display: swap;
        }

        @font-face {
          font-family: 'Inter';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Bold.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Bold.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Bold.ttf') format('truetype');
          font-weight: bold;
          font-style: normal;
          font-display: swap;
        }

        @font-face {
          font-family: 'Inter';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Medium.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Medium.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Medium.ttf') format('truetype');
          font-weight: 500;
          font-style: normal;
          font-display: swap;
        }

        @font-face {
          font-family: 'Inter';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Light.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Light.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Light.ttf') format('truetype');
          font-weight: 300;
          font-style: normal;
          font-display: swap;
        }

        @font-face {
          font-family: 'Inter';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Regular.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Regular.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-Regular.ttf') format('truetype');
          font-weight: normal;
          font-style: normal;
          font-display: swap;
        }

        @font-face {
          font-family: 'Inter';
          src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-SemiBold.woff2') format('woff2'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-SemiBold.woff') format('woff'),
              url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Inter-SemiBold.ttf') format('truetype');
          font-weight: 600;
          font-style: normal;
          font-display: swap;
        }
        <?php
        echo '</style>';
    }

    if ($body_font == 'Lato, sans-serif' || $heading_font == 'Lato, sans-serif') {
        echo '<style>';
       ?>
        @font-face {
            font-family: 'Lato';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Black.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Black.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Black.ttf') format('truetype');
            font-weight: 900;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Lato';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Bold.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Bold.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Lato';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Regular.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Regular.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Lato';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Light.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Light.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Light.ttf') format('truetype');
            font-weight: 300;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Lato';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Italic.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Italic.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Lato-Italic.ttf') format('truetype');
            font-weight: normal;
            font-style: italic;
            font-display: swap;
        }
        <?php
        echo '</style>';
    }


    if ($body_font == 'Open Sans, sans-serif' || $heading_font == 'Open Sans, sans-serif') {
        echo '<style>';
       ?>
        @font-face {
            font-family: 'Open Sans';
            src: url(<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Bold.woff2') format('woff2'),
                url(<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Bold.woff') format('woff'),
                url(<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-SemiBold.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-SemiBold.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-SemiBold.ttf') format('truetype');
            font-weight: 600;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Regular.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Regular.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Medium.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Medium.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Medium.ttf') format('truetype');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Open Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Light.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Light.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/OpenSans-Light.ttf') format('truetype');
            font-weight: 300;
            font-style: normal;
            font-display: swap;
        }


        <?php
        echo '</style>';
    }

    if ($body_font == 'Work Sans, sans-serif' || $heading_font == 'Work Sans, sans-serif') {
        echo '<style>';
       ?>
        
        @font-face {
            font-family: 'Work Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-SemiBold.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-SemiBold.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-SemiBold.ttf') format('truetype');
            font-weight: 600;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Work Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Medium.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Medium.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Medium.ttf') format('truetype');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Work Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Italic.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Italic.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Italic.ttf') format('truetype');
            font-weight: normal;
            font-style: italic;
            font-display: swap;
        }

        @font-face {
            font-family: 'Work Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Black.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Black.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Black.ttf') format('truetype');
            font-weight: 900;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Work Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Regular.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Regular.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Work Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Bold.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Bold.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/WorkSans-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        }


        <?php
        echo '</style>';
    }

    if ($body_font == 'Nunito Sans, sans-serif' || $heading_font == 'Nunito Sans, sans-serif') {
        echo '<style>';
       ?>
        @font-face {
            font-family: 'Nunito Sans 10pt';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Italic.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Italic.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Italic.ttf') format('truetype');
            font-weight: normal;
            font-style: italic;
            font-display: swap;
        }

        @font-face {
            font-family: 'Nunito Sans 10pt';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Black.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Black.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Black.ttf') format('truetype');
            font-weight: 900;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Nunito Sans 10pt';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-SemiBold.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-SemiBold.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-SemiBold.ttf') format('truetype');
            font-weight: 600;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Nunito Sans 10pt';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Medium.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Medium.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Medium.ttf') format('truetype');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Nunito Sans 10pt';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Bold.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Bold.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Nunito Sans 10pt';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Regular.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Regular.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/NunitoSans10pt-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        <?php
        echo '</style>';
    }

    if ($body_font == 'Montserrat, sans-serif' || $heading_font == 'Montserrat, sans-serif') {
        echo '<style>';
       ?>
       
       @font-face {
            font-family: 'Montserrat';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Regular.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Regular.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Medium.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Medium.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Medium.ttf') format('truetype');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Black.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Black.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Black.ttf') format('truetype');
            font-weight: 900;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-SemiBold.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-SemiBold.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-SemiBold.ttf') format('truetype');
            font-weight: 600;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Italic.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Italic.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Italic.ttf') format('truetype');
            font-weight: normal;
            font-style: italic;
            font-display: swap;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Bold.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Bold.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Montserrat-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        }

        <?php
        echo '</style>';
    }

    if ($body_font == 'PT Sans, sans-serif' || $heading_font == 'PT Sans, sans-serif') {
        echo '<style>';
       ?>
        @font-face {
            font-family: 'PT Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/PTSans-BoldItalic.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/PTSans-BoldItalic.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/PTSans-BoldItalic.ttf') format('truetype');
            font-weight: bold;
            font-style: italic;
            font-display: swap;
        }

        @font-face {
            font-family: 'PT Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/PTSans-Italic.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/PTSans-Italic.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/PTSans-Italic.ttf') format('truetype');
            font-weight: normal;
            font-style: italic;
            font-display: swap;
        }

        @font-face {
            font-family: 'PT Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/PTSans-Bold.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/PTSans-Bold.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/PTSans-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'PT Sans';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/PTSans-Regular.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/PTSans-Regular.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/PTSans-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }




        <?php
        echo '</style>';
    }

    if ($body_font == 'Roboto, sans-serif' || $heading_font == 'Roboto, sans-serif') {
        echo '<style>';
       ?>
        @font-face {
            font-family: 'Roboto';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Regular.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Regular.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Roboto';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Black.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Black.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Black.ttf') format('truetype');
            font-weight: 900;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Roboto';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Italic.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Italic.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Italic.ttf') format('truetype');
            font-weight: normal;
            font-style: italic;
            font-display: swap;
        }

        @font-face {
            font-family: 'Roboto';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Bold.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Bold.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Bold.ttf') format('truetype');
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Roboto';
            src: url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Medium.woff2') format('woff2'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Medium.woff') format('woff'),
                url('<?php echo get_template_directory_uri(); ?>/assets/fonts/Roboto-Medium.ttf') format('truetype');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }
        
        <?php
        echo '</style>';
    }




}
add_action('wp_head', 'load_custom_fonts');



// Add the customizer CSS to the head
function theme_customizer_css() {
?>
    <style type="text/css">
        :root {
            --theme-color1: <?php echo get_theme_mod('theme-color1', '#F01F6D'); ?>;
            --theme-color2: <?php echo get_theme_mod('theme-color2', '#E8A53C'); ?>;
            --theme-color3: <?php echo get_theme_mod('theme-color3', '#FFF5CB'); ?>;
            --theme-color4: <?php echo get_theme_mod('theme-color4', '#5E4960'); ?>;
            --button-color: <?php echo get_theme_mod('button_color', '#E8A53C'); ?>;
            --button-hover-color: <?php echo get_theme_mod('button_hover_color', '#F01F6D'); ?>;
            --gradientcolor1: <?php echo get_theme_mod('gradient_color1', '#f01f6d'); ?>; 
            --gradientcolor2: <?php echo get_theme_mod('gradient_color2', '#e8a53c'); ?>; 
            --body-fonts: <?php echo get_theme_mod('body_font_family', 'Poppins, sans-serif'); ?>;
            --head-fonts: <?php echo get_theme_mod('heading_font_family', 'Inter, sans-serif'); ?>;
        }
    </style>
<?php
}
add_action('wp_head', 'theme_customizer_css');
add_action( 'admin_head', 'theme_customizer_css' );
?>
