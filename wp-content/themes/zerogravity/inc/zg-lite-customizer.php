<?php
/**
 * Register postMessage support.
 *
 * Add postMessage support for site title and description for the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
 
add_action( 'customize_register', 'zerogravity_customize_register' );

function zerogravity_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}

// Enqueue Javascript postMessage handlers for the Customizer.
add_action( 'customize_preview_init', 'zerogravity_customize_preview_js' ); 

function zerogravity_customize_preview_js() {
	wp_enqueue_script( 'zerogravity-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}

/*
 * Sanitize functions.
 */
function zerogravity_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function zerogravity_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

function zerogravity_sanitize_sidebar_position( $input ) {
    $valid = array(
        'izquierda' => 'Left',
        'derecha' => 'Right',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

function zerogravity_sanitize_fonts( $input ) {
    $valid = array(
		'Open Sans' => 'Open Sans',
		'Arimo' => 'Arimo',
		'Bitter' => 'Bitter',
		'Raleway' => 'Raleway',
		'Titillium Web' => 'Titillium Web',
		'Ubuntu' => 'Ubuntu',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

function zerogravity_sanitize_theme_color( $input ) {
    $valid = array(
        '#0098D3' => 'Blue',
        '#82A31D' => 'Green',
		'#FA4C00' => 'Orange',
		'#F882B3' => 'Pink',
		'#BA0000' => 'Red',
		'#F8C300' => 'Yellow',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

/**-------------------------------
 * zerogravity Customizer
 --------------------------------*/
 
add_action('customize_register', 'zerogravity_theme_customizer');

function zerogravity_theme_customizer( $wp_customize ) {
	
// Quitar el control para dar color al texto de cabecera
$wp_customize->remove_control('header_textcolor');

// Add_panel (requiere WP 4.0+)
$wp_customize->add_panel ('zerogravity_panel', array(
	'title' => __('ZeroGravity Options', 'zerogravity'),
	'priority' => '10'));

/**
 * Color de tema, Favicon y Sidebar
 */
 
// Sección
$wp_customize->add_section('zerogravity_color_favicon_sidebar' , array(
	'panel' => 'zerogravity_panel',
	'title' => __('ZG: Color, Favicon and Sidebar','zerogravity'),
	'priority'    => '40',
));
// Color de tema
$wp_customize->add_setting('zerogravity_color_tema', array('default' => '#0098D3', 'sanitize_callback' => 'zerogravity_sanitize_theme_color' ));
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'zerogravity_color_tema',
        array(
            'label'          => __( 'Select theme color', 'zerogravity' ),
            'section'        => 'zerogravity_color_favicon_sidebar',
            'settings'       => 'zerogravity_color_tema',
            'type'           => 'select',
            'choices'        => array(
                '#0098D3'  => __( 'Blue','zerogravity' ),
                '#82A31D'  => __( 'Green','zerogravity' ),
				'#FA4C00'  => __( 'Orange','zerogravity' ),
				'#F882B3'  => __( 'Pink','zerogravity' ),
				'#BA0000'  => __( 'Red','zerogravity' ),
				'#F8C300'  => __( 'Yellow', 'zerogravity'),
            )
        )
    )
);

// Color título de post en extractos
$wp_customize->add_setting('zerogravity_color_excerpt_title', array('default' => '', 'sanitize_callback' => 'zerogravity_sanitize_checkbox',));
$wp_customize->add_control('zerogravity_color_excerpt_title', array(
        'type' => 'checkbox',
        'label' => __('Apply to entry title in excerpts', 'zerogravity'),
        'section' => 'zerogravity_color_favicon_sidebar',
		));


// Color de fondo de encabezado blanco
$wp_customize->add_setting('zerogravity_header_color_white', array('default' => '', 'sanitize_callback' => 'zerogravity_sanitize_checkbox',));
$wp_customize->add_control('zerogravity_header_color_white', array(
        'type' => 'checkbox',
        'label' => __('White header', 'zerogravity'),
        'section' => 'zerogravity_color_favicon_sidebar',
		));
		
// Sidebar 
$wp_customize->add_setting('zerogravity_sidebar_position', array('default' => 'izquierda', 'sanitize_callback' => 'zerogravity_sanitize_sidebar_position' ));
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'zerogravity_sidebar_position',
        array(
            'label'          => __( 'Select sidebar position', 'zerogravity' ),
            'section'        => 'zerogravity_color_favicon_sidebar',
            'settings'       => 'zerogravity_sidebar_position',
            'type'           => 'radio',
            'choices'        => array(
                'izquierda'   => __( 'Left','zerogravity' ),
                'derecha'  => __( 'Right','zerogravity' ),
            )
        )
    )
);

// Favicon
$wp_customize->add_setting( 'zerogravity_favicon' , array('default' => '', 'sanitize_callback' => 'esc_url_raw',));
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'zerogravity_favicon', array(
    'label'    => __( 'Favicon (ico, png or gif)', 'zerogravity' ),
    'section'  => 'zerogravity_color_favicon_sidebar',
    'settings' => 'zerogravity_favicon',
) ) );

/**
 * Fuentes
 */
$wp_customize->add_section('zerogravity_fonts' , array(
	'panel' => 'zerogravity_panel',
	'title' => __('ZG: Fonts', 'zerogravity'),
	'priority'    => 45,
));
$wp_customize->add_setting('zerogravity_fonts', array('default' => 'Open Sans', 'sanitize_callback' => 'zerogravity_sanitize_fonts' ));
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'zerogravity_fonts',
        array(
            'label'          => __( 'Select font', 'zerogravity' ),
            'section'        => 'zerogravity_fonts',
            'settings'       => 'zerogravity_fonts',
            'type'           => 'radio',
            'choices'        => array(
                'Open Sans' => 'Open Sans',
				'Arimo' => 'Arimo',
				'Bitter' => 'Bitter',
				'Raleway' => 'Raleway',
				'Titillium Web' => 'Titillium Web',
				'Ubuntu' => 'Ubuntu',
            )
        )
    )
);

/**
 * Posts and footer
 */

$wp_customize->add_section('zerogravity_post_and_footer' , array(
	'panel' => 'zerogravity_panel',
	'title' => __('ZG: Posts and footer text', 'zerogravity'),
	'priority' => 44,
));

$wp_customize->add_setting('zerogravity_thumbnail_rounded', array('default' => 1, 'sanitize_callback' => 'zerogravity_sanitize_checkbox',));
$wp_customize->add_control('zerogravity_thumbnail_rounded', array(
        'type' => 'checkbox',
        'label' => __("Excerpt's thumbnail image rounded", 'zerogravity'),
        'section' => 'zerogravity_post_and_footer',
		));
		
$wp_customize->add_setting('zerogravity_text_justify', array('default' => '', 'sanitize_callback' => 'zerogravity_sanitize_checkbox',));
$wp_customize->add_control('zerogravity_text_justify', array(
        'type' => 'checkbox',
        'label' => __('Entry text justified', 'zerogravity'),
        'section' => 'zerogravity_post_and_footer',
		));

$wp_customize->add_setting('zerogravity_related_posts', array('default' => '', 'sanitize_callback' => 'zerogravity_sanitize_checkbox',));
$wp_customize->add_control('zerogravity_related_posts', array(
        'type' => 'checkbox',
        'label' => __('Display related posts at the end of entries', 'zerogravity'),
        'section' => 'zerogravity_post_and_footer',
		));
		
$wp_customize->add_setting('zerogravity_boton_ir_arriba', array('default' => 1, 'sanitize_callback' => 'zerogravity_sanitize_checkbox',));
$wp_customize->add_control('zerogravity_boton_ir_arriba', array(
        'type' => 'checkbox',
        'label' => __("Display 'Back to top' button", 'zerogravity'),
        'section' => 'zerogravity_post_and_footer',
		));

$wp_customize->add_setting('zerogravity_footer_text_left', array('default' => __('Copyright 2015', 'zerogravity'), 'sanitize_callback' => 'zerogravity_sanitize_text',));
$wp_customize->add_control('zerogravity_footer_text_left', array(
        'type' => 'textarea',
        'label' => __('Footer text left', 'zerogravity'),
        'section' => 'zerogravity_post_and_footer',
		));

$wp_customize->add_setting('zerogravity_footer_text_center', array('default' => __('Footer text center', 'zerogravity'), 'sanitize_callback' => 'zerogravity_sanitize_text',));
$wp_customize->add_control('zerogravity_footer_text_center', array(
        'type' => 'textarea',
        'label' => __('Footer text center', 'zerogravity'),
        'section' => 'zerogravity_post_and_footer',
		));

/**
 * Logo
 */

$wp_customize->add_section('zerogravity_logo_settings' , array(
	'panel' => 'zerogravity_panel',
	'title' => __('ZG: Logo in the header','zerogravity'),
	'priority' => 43,
	'description' => __('If you choose a logo instead of full image for the header, check the option "Header image is a logo" to apply margins.', 'zerogravity'),
));	

// Imagen de cabecera es un logo
$wp_customize->add_setting('zerogravity_logo_active', array('default' => '', 'sanitize_callback' => 'zerogravity_sanitize_checkbox',));
$wp_customize->add_control('zerogravity_logo_active', array(
        'type' => 'checkbox',
        'label' => __('(ZG) Header image is a logo', 'zerogravity'),
        'section' => 'zerogravity_logo_settings',
		));
		
// Centrar logo
$wp_customize->add_setting('zerogravity_logo_center', array('default' => '', 'sanitize_callback' => 'zerogravity_sanitize_checkbox',));
$wp_customize->add_control('zerogravity_logo_center', array(
        'type' => 'checkbox',
        'label' => __('(ZG) Center logo (Just if "Header image is a logo" is checked)', 'zerogravity'),
        'section' => 'zerogravity_logo_settings',
		));

/**
 * Top bar
 */

$wp_customize->add_section('zerogravity_top_bar' , array(
	'panel' => 'zerogravity_panel',
	'title' => __('ZG: Top bar and social icons','zerogravity'),
	'description' => __('(Leave blank text boxes to not display icons)', 'zerogravity'),
	'priority'    => 41,
));

// Blog title
$wp_customize->add_setting('zerogravity_blog_title_top_bar', array('default' => 1, 'sanitize_callback' => 'zerogravity_sanitize_checkbox',));
$wp_customize->add_control('zerogravity_blog_title_top_bar', array(
        'type' => 'checkbox',
        'label' => __('Display blog title in top bar', 'zerogravity'),
        'section' => 'zerogravity_top_bar',
		));

// Palabra MENU		
$wp_customize->add_setting('zerogravity_mostrar_menu_junto_icono', array('default' => '', 'sanitize_callback' => 'zerogravity_sanitize_checkbox',));
$wp_customize->add_control('zerogravity_mostrar_menu_junto_icono', array(
        'type' => 'checkbox',
        'label' => __('Show the word menu next to the icon menu on mobile devices.', 'zerogravity'),
        'section' => 'zerogravity_top_bar',
		));

// Social icons 
$wp_customize->add_setting('zerogravity_twitter_url', array('default' => 'https://twitter.com/', 'sanitize_callback' => 'zerogravity_sanitize_text'));
$wp_customize->add_control('zerogravity_twitter_url', array(
        'label' => __('Twitter URL', 'zerogravity'),
        'section' => 'zerogravity_top_bar',
        'type' => 'text',
    ));

$wp_customize->add_setting('zerogravity_facebook_url', array('default' => 'https://facebook.com/', 'sanitize_callback' => 'zerogravity_sanitize_text'));
$wp_customize->add_control('zerogravity_facebook_url', array(
        'label' => __('Facebook URL', 'zerogravity'),
        'section' => 'zerogravity_top_bar',
        'type' => 'text',
    ));
	
$wp_customize->add_setting('zerogravity_googleplus_url', array('default' => 'https://plus.google.com/', 'sanitize_callback' => 'zerogravity_sanitize_text'));
$wp_customize->add_control('zerogravity_googleplus_url', array(
        'label' => __('Google Plus URL', 'zerogravity'),
        'section' => 'zerogravity_top_bar',
        'type' => 'text',
    ));

$wp_customize->add_setting('zerogravity_linkedin_url', array('default' => 'https://linkedin.com', 'sanitize_callback' => 'zerogravity_sanitize_text'));
$wp_customize->add_control('zerogravity_linkedin_url', array(
        'label' => __('LinkedIn URL', 'zerogravity'),
        'section' => 'zerogravity_top_bar',
        'type' => 'text',
    ));

$wp_customize->add_setting('zerogravity_youtube_url', array('default' => 'https://youtube.com', 'sanitize_callback' => 'zerogravity_sanitize_text'));
$wp_customize->add_control('zerogravity_youtube_url', array(
        'label' => __('YouTube URL', 'zerogravity'),
        'section' => 'zerogravity_top_bar',
        'type' => 'text',
    ));

$wp_customize->add_setting('zerogravity_instagram_url', array('default' => 'http://instagram.com', 'sanitize_callback' => 'zerogravity_sanitize_text'));
$wp_customize->add_control('zerogravity_instagram_url', array(
        'label' => __('Instagram URL', 'zerogravity'),
        'section' => 'zerogravity_top_bar',
        'type' => 'text',
    ));
	
$wp_customize->add_setting('zerogravity_pinterest_url', array('default' => 'https://pinterest.com', 'sanitize_callback' => 'zerogravity_sanitize_text'));
$wp_customize->add_control('zerogravity_pinterest_url', array(
        'label' => __('Pinterest URL', 'zerogravity'),
        'section' => 'zerogravity_top_bar',
        'type' => 'text',
    ));

$wp_customize->add_setting('zerogravity_rss_url', array('default' => 'http://wordpress.org/', 'sanitize_callback' => 'zerogravity_sanitize_text'));
$wp_customize->add_control('zerogravity_rss_url', array(
        'label' => __('RSS URL', 'zerogravity'),
        'section' => 'zerogravity_top_bar',
        'type' => 'text',
    ));

}