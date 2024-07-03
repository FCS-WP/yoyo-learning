<?php
/**
 * epora customizer
 *
 * @package epora
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Added Panels & Sections
 */
function epora_customizer_panels_sections( $wp_customize ) {

    //Add panel
    $wp_customize->add_panel( 'epora_customizer', [
        'priority' => 10,
        'title'    => esc_html__( 'Epora Customizer', 'epora' ),
    ] );

    /**
     * Customizer Section
     */
    $wp_customize->add_section( 'header_top_setting', [
        'title'       => esc_html__( 'Header Info Setting', 'epora' ),
        'description' => '',
        'priority'    => 10,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );

    $wp_customize->add_section( 'header_social', [
        'title'       => esc_html__( 'Header Social', 'epora' ),
        'description' => '',
        'priority'    => 11,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );

    $wp_customize->add_section( 'section_header_logo', [
        'title'       => esc_html__( 'Header Setting', 'epora' ),
        'description' => '',
        'priority'    => 12,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'epora' ),
        'description' => '',
        'priority'    => 13,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );

    $wp_customize->add_section( 'header_side_setting', [
        'title'       => esc_html__( 'Side Info', 'epora' ),
        'description' => '',
        'priority'    => 14,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );

    $wp_customize->add_section( 'breadcrumb_setting', [
        'title'       => esc_html__( 'Breadcrumb Setting', 'epora' ),
        'description' => '',
        'priority'    => 15,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );

    $wp_customize->add_section( 'blog_setting', [
        'title'       => esc_html__( 'Blog Setting', 'epora' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );

    $wp_customize->add_section( 'footer_setting', [
        'title'       => esc_html__( 'Footer Settings', 'epora' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );
    
    $wp_customize->add_section( 'footer_social', [
        'title'       => esc_html__( 'Footer Social', 'epora' ),
        'description' => '',
        'priority'    => 16,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );

    $wp_customize->add_section( 'color_setting', [
        'title'       => esc_html__( 'Color Setting', 'epora' ),
        'description' => '',
        'priority'    => 17,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );

    $wp_customize->add_section( '404_page', [
        'title'       => esc_html__( '404 Page', 'epora' ),
        'description' => '',
        'priority'    => 18,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );

    $wp_customize->add_section( 'course_settings', [
        'title'       => esc_html__( 'Course Settings ', 'epora' ),
        'description' => '',
        'priority'    => 19,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );

    $wp_customize->add_section( 'typo_setting', [
        'title'       => esc_html__( 'Typography Setting', 'epora' ),
        'description' => '',
        'priority'    => 21,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );

    $wp_customize->add_section( 'slug_setting', [
        'title'       => esc_html__( 'Slug Settings', 'epora' ),
        'description' => '',
        'priority'    => 22,
        'capability'  => 'edit_theme_options',
        'panel'       => 'epora_customizer',
    ] );
}

add_action( 'customize_register', 'epora_customizer_panels_sections' );

function _header_top_fields( $fields ) {

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'epora_preloader',
        'label'    => esc_html__( 'Preloader On/Off', 'epora' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];


    $fields[] = [
        'type'     => 'switch',
        'settings' => 'epora_backtotop',
        'label'    => esc_html__( 'Back To Top On/Off', 'epora' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'epora_header_right',
        'label'    => esc_html__( 'Header Right On/Off', 'epora' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'epora_search',
        'label'    => esc_html__( 'Header Search On/Off', 'epora' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'epora_header_category',
        'label'    => esc_html__( 'Category On/Off', 'epora' ),
        'section'  => 'header_top_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];

    return $fields;

}
add_filter( 'kirki/fields', '_header_top_fields' );

/*
Header Social
 */
function _header_social_fields( $fields ) {
    // header section social
    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_topbar_fb_url',
        'label'    => esc_html__( 'Facebook Url', 'epora' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'epora' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_topbar_twitter_url',
        'label'    => esc_html__( 'Twitter Url', 'epora' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'epora' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_topbar_linkedin_url',
        'label'    => esc_html__( 'Linkedin Url', 'epora' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'epora' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_topbar_instagram_url',
        'label'    => esc_html__( 'Instagram Url', 'epora' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'epora' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_topbar_youtube_url',
        'label'    => esc_html__( 'Youtube Url', 'epora' ),
        'section'  => 'header_social',
        'default'  => esc_html__( '#', 'epora' ),
        'priority' => 10,
    ];


    return $fields;
}
add_filter( 'kirki/fields', '_header_social_fields' );

/*
Header Settings
 */
function _header_header_fields( $fields ) {
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_header',
        'label'       => esc_html__( 'Select Header Style', 'epora' ),
        'section'     => 'section_header_logo',
        'placeholder' => esc_html__( 'Select an option...', 'epora' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'header-style-1'   => get_template_directory_uri() . '/inc/img/header/header-1.png',
            'header-style-2' => get_template_directory_uri() . '/inc/img/header/header-2.png',
            'header-style-3'  => get_template_directory_uri() . '/inc/img/header/header-3.png'
        ],
        'default'     => 'header-style-1',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'logo',
        'label'       => esc_html__( 'Header Logo', 'epora' ),
        'description' => esc_html__( 'Upload Your Logo.', 'epora' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'seconday_logo',
        'label'       => esc_html__( 'Header Secondary Logo', 'epora' ),
        'description' => esc_html__( 'Header Logo Black', 'epora' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-white.png',
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'preloader_logo',
        'label'       => esc_html__( 'Preloader Logo', 'epora' ),
        'description' => esc_html__( 'Upload Preloader Logo.', 'epora' ),
        'section'     => 'section_header_logo',
        'default'     => get_template_directory_uri() . '/assets/img/favicon.png',
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_header_fields' );

/*
Header Side Info
 */
function _header_side_fields( $fields ) {
    // side info settings
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'epora_side_hide',
        'label'    => esc_html__( 'Side Info On/Off', 'epora' ),
        'section'  => 'header_side_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];  
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'epora_side_logo',
        'label'       => esc_html__( 'Logo Side', 'epora' ),
        'description' => esc_html__( 'Logo Side', 'epora' ),
        'section'     => 'header_side_setting',
        'default'     => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
    ];

    // contact
    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_contact_title',
        'label'    => esc_html__( 'Contact Title', 'epora' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'Contact Info', 'epora' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'epora_extra_address',
        'label'    => esc_html__( 'Office Address', 'epora' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '27 Division St, New York', 'epora' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_extra_phone',
        'label'    => esc_html__( 'Phone Number', 'epora' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( '+180012345678', 'epora' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_extra_email',
        'label'    => esc_html__( 'Email ID', 'epora' ),
        'section'  => 'header_side_setting',
        'default'  => esc_html__( 'epora@example.com', 'epora' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_side_fields' );

/*
_header_page_title_fields
 */
function _header_page_title_fields( $fields ) {
    // Breadcrumb Setting
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'breadcrumb_bg_img',
        'label'       => esc_html__( 'Breadcrumb Background Image', 'epora' ),
        'description' => esc_html__( 'Breadcrumb Background Image', 'epora' ),
        'section'     => 'breadcrumb_setting',
        'default'     => get_template_directory_uri() . '/assets/img/page-title/page-title.jpg',
    ];
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'epora_breadcrumb_bg_color',
        'label'       => __( 'Breadcrumb BG Color', 'epora' ),
        'description' => esc_html__( 'This is a Breadcrumb bg color control.', 'epora' ),
        'section'     => 'breadcrumb_setting',
        'default'     => '#f4f9fc',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'breadcrumb_info_switch',
        'label'    => esc_html__( 'Breadcrumb Info switch', 'epora' ),
        'section'  => 'breadcrumb_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_page_title_fields' );

/*
Header Social
 */
function _header_blog_fields( $fields ) {
// Blog Setting
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'epora_blog_btn_switch',
        'label'    => esc_html__( 'Blog BTN On/Off', 'epora' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'epora_blog_cat',
        'label'    => esc_html__( 'Blog Category Meta On/Off', 'epora' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'epora_blog_author',
        'label'    => esc_html__( 'Blog Author Meta On/Off', 'epora' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'epora_blog_date',
        'label'    => esc_html__( 'Blog Date Meta On/Off', 'epora' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'epora_blog_comments',
        'label'    => esc_html__( 'Blog Comments Meta On/Off', 'epora' ),
        'section'  => 'blog_setting',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_blog_btn',
        'label'    => esc_html__( 'Blog Button text', 'epora' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Read More', 'epora' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title',
        'label'    => esc_html__( 'Blog Title', 'epora' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog', 'epora' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'breadcrumb_blog_title_details',
        'label'    => esc_html__( 'Blog Details Title', 'epora' ),
        'section'  => 'blog_setting',
        'default'  => esc_html__( 'Blog Details', 'epora' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', '_header_blog_fields' );

/*
Footer
 */
function _header_footer_fields( $fields ) {
    // Footer Setting
    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'choose_default_footer',
        'label'       => esc_html__( 'Choose Footer Style', 'epora' ),
        'section'     => 'footer_setting',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'epora' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'footer-style-1'   => get_template_directory_uri() . '/inc/img/footer/footer-1.png',
            'footer-style-2' => get_template_directory_uri() . '/inc/img/footer/footer-2.png',
            'footer-style-3' => get_template_directory_uri() . '/inc/img/footer/footer-3.png',
        ],
        'default'     => 'footer-style-1',
    ];

    $fields[] = [
        'type'        => 'select',
        'settings'    => 'footer_widget_number',
        'label'       => esc_html__( 'Widget Number', 'epora' ),
        'section'     => 'footer_setting',
        'default'     => '4',
        'placeholder' => esc_html__( 'Select an option...', 'epora' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            '4' => esc_html__( 'Widget Number 4', 'epora' ),
            '3' => esc_html__( 'Widget Number 3', 'epora' ),
            '2' => esc_html__( 'Widget Number 2', 'epora' ),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'epora_footer_bg',
        'label'       => esc_html__( 'Footer Background Image.', 'epora' ),
        'description' => esc_html__( 'Footer Background Image.', 'epora' ),
        'section'     => 'footer_setting',
    ];

    $fields[] = [
        'type'        => 'color',
        'settings'    => 'epora_footer_bg_color',
        'label'       => __( 'Footer BG Color', 'epora' ),
        'description' => esc_html__( 'This is a Footer bg color control..', 'epora' ),
        'section'     => 'footer_setting',
        'default'     => '#245D51',
        'priority'    => 10,
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_2_switch',
        'label'    => esc_html__( 'Footer Style 2 On/Off', 'epora' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'footer_style_3_switch',
        'label'    => esc_html__( 'Footer Style 3 On/Off', 'epora' ),
        'section'  => 'footer_setting',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];

    $fields[] = [
        'type'        => 'image',
        'settings'    => 'epora_footer_logo',
        'label'       => esc_html__( 'Footer Logo', 'epora' ),
        'description' => esc_html__( 'Upload Your Logo.', 'epora' ),
        'section'     => 'footer_setting',
        'default'     => '',
    ];

    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'epora_footer_menu',
        'label'    => esc_html__( 'Footer Menu', 'epora' ),
        'section'  => 'footer_setting',
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_copyright',
        'label'    => esc_html__( 'Copy Right', 'epora' ),
        'section'  => 'footer_setting',
        'default'  => esc_html__( 'Copyright &copy; 2022 Theme_Pure. All Rights Reserved', 'epora' ),
        'priority' => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', '_header_footer_fields' );

/*
Footer Social
 */
function _footer_social_fields( $fields ) {
    // Footer section social
    $fields[] = [
        'type'     => 'switch',
        'settings' => 'epora_footer_social_switch',
        'label'    => esc_html__( 'Footer Social On/Off', 'epora' ),
        'section'  => 'footer_social',
        'default'  => '0',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_footer_fb_url',
        'label'    => esc_html__( 'Facebook Url', 'epora' ),
        'section'  => 'footer_social',
        'default'  => esc_html__( '#', 'epora' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_footer_twitter_url',
        'label'    => esc_html__( 'Twitter Url', 'epora' ),
        'section'  => 'footer_social',
        'default'  => esc_html__( '#', 'epora' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_footer_linkedin_url',
        'label'    => esc_html__( 'Linkedin Url', 'epora' ),
        'section'  => 'footer_social',
        'default'  => esc_html__( '#', 'epora' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_footer_instagram_url',
        'label'    => esc_html__( 'Instagram Url', 'epora' ),
        'section'  => 'footer_social',
        'default'  => esc_html__( '#', 'epora' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_footer_youtube_url',
        'label'    => esc_html__( 'Youtube Url', 'epora' ),
        'section'  => 'footer_social',
        'default'  => esc_html__( '#', 'epora' ),
        'priority' => 10,
    ];


    return $fields;
}
add_filter( 'kirki/fields', '_footer_social_fields' );

// color
function epora_color_fields( $fields ) {
    // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'epora_color_option',
        'label'       => __( 'Theme Color', 'epora' ),
        'description' => esc_html__( 'This is a Theme color control.', 'epora' ),
        'section'     => 'color_setting',
        'default'     => '#ff6652',
        'priority'    => 10,
    ];
     // Color Settings
    $fields[] = [
        'type'        => 'color',
        'settings'    => 'epora_color_scrollup',
        'label'       => __( 'ScrollUp Color', 'epora' ),
        'description' => esc_html__( 'This is a ScrollUp colo control.', 'epora' ),
        'section'     => 'color_setting',
        'default'     => '#2b4eff',
        'priority'    => 10,
    ];

    return $fields;
}
add_filter( 'kirki/fields', 'epora_color_fields' );

// 404
function epora_404_fields( $fields ) {
    // 404 settings
    $fields[] = [
        'type'        => 'image',
        'settings'    => 'epora_404_bg',
        'label'       => esc_html__( '404 Image.', 'epora' ),
        'description' => esc_html__( '404 Image.', 'epora' ),
        'section'     => '404_page',
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_error_title',
        'label'    => esc_html__( 'Not Found Title', 'epora' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Page not found', 'epora' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'textarea',
        'settings' => 'epora_error_desc',
        'label'    => esc_html__( '404 Description Text', 'epora' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Oops! The page you are looking for does not exist. It might have been moved or deleted', 'epora' ),
        'priority' => 10,
    ];
    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_error_link_text',
        'label'    => esc_html__( '404 Link Text', 'epora' ),
        'section'  => '404_page',
        'default'  => esc_html__( 'Back To Home', 'epora' ),
        'priority' => 10,
    ];
    return $fields;
}
add_filter( 'kirki/fields', 'epora_404_fields' );

// course_settings
function epora_course_fields( $fields ) {

    $fields[] = [
        'type'        => 'radio-image',
        'settings'    => 'course_style',
        'label'       => esc_html__( 'Select Course Style', 'epora' ),
        'section'     => 'course_settings',
        'default'     => '5',
        'placeholder' => esc_html__( 'Select an option...', 'epora' ),
        'priority'    => 10,
        'multiple'    => 1,
        'choices'     => [
            'standard'   => get_template_directory_uri() . '/inc/img/course/course-standart.png',
            'course_with_sidebar' => get_template_directory_uri() . '/inc/img/course/course_with_sidebar.png',
        ],
        'default'     => 'course_with_sidebar',
    ];

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_search_switch',
        'label'    => esc_html__( 'Show search?', 'epora' ),
        'section'  => 'course_settings',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_latest_post_switch',
        'label'    => esc_html__( 'Show latest post?', 'epora' ),
        'section'  => 'course_settings',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_category_switch',
        'label'    => esc_html__( 'Show category filter?', 'epora' ),
        'section'  => 'course_settings',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];    

    $fields[] = [
        'type'     => 'switch',
        'settings' => 'course_skill_switch',
        'label'    => esc_html__( 'Show skill filter?', 'epora' ),
        'section'  => 'course_settings',
        'default'  => '1',
        'priority' => 10,
        'choices'  => [
            'on'  => esc_html__( 'Enable', 'epora' ),
            'off' => esc_html__( 'Disable', 'epora' ),
        ],
        'active_callback' => [
            [
                'setting'  => 'course_with_sidebar',
                'operator' => '==',
                'value'    => true,
            ],
        ],
    ];

    return $fields;

}

if ( class_exists( 'LearnPress' ) ) {
add_filter( 'kirki/fields', 'epora_course_fields' );
}


/**
 * Added Fields
 */
function epora_typo_fields( $fields ) {
    // typography settings
    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_body_setting',
        'label'       => esc_html__( 'Body Font', 'epora' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'body',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h_setting',
        'label'       => esc_html__( 'Heading h1 Fonts', 'epora' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h1',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h2_setting',
        'label'       => esc_html__( 'Heading h2 Fonts', 'epora' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h2',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h3_setting',
        'label'       => esc_html__( 'Heading h3 Fonts', 'epora' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h3',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h4_setting',
        'label'       => esc_html__( 'Heading h4 Fonts', 'epora' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h4',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h5_setting',
        'label'       => esc_html__( 'Heading h5 Fonts', 'epora' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h5',
            ],
        ],
    ];

    $fields[] = [
        'type'        => 'typography',
        'settings'    => 'typography_h6_setting',
        'label'       => esc_html__( 'Heading h6 Fonts', 'epora' ),
        'section'     => 'typo_setting',
        'default'     => [
            'font-family'    => '',
            'variant'        => '',
            'font-size'      => '',
            'line-height'    => '',
            'letter-spacing' => '0',
            'color'          => '',
        ],
        'priority'    => 10,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => 'h6',
            ],
        ],
    ];
    return $fields;
}

add_filter( 'kirki/fields', 'epora_typo_fields' );



/**
 * Added Fields
 */
function epora_slug_setting( $fields ) {
    // slug settings
    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_ev_slug',
        'label'    => esc_html__( 'Event Slug', 'epora' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'ourevent', 'epora' ),
        'priority' => 10,
    ];

    $fields[] = [
        'type'     => 'text',
        'settings' => 'epora_port_slug',
        'label'    => esc_html__( 'Portfolio Slug', 'epora' ),
        'section'  => 'slug_setting',
        'default'  => esc_html__( 'ourportfolio', 'epora' ),
        'priority' => 10,
    ];

    return $fields;
}

add_filter( 'kirki/fields', 'epora_slug_setting' );


/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 */
function epora_THEME_option( $name ) {
    $value = '';
    if ( class_exists( 'epora' ) ) {
        $value = Kirki::get_option( epora_get_theme(), $name );
    }

    return apply_filters( 'epora_THEME_option', $value, $name );
}

/**
 * Get config ID
 *
 * @return string
 */
function epora_get_theme() {
    return 'epora';
}