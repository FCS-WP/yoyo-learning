<?php

/**
 * epora_scripts description
 * @return [type] [description]
 */
function epora_scripts() {

    /**
     * all css files
    */

    wp_enqueue_style( 'epora-fonts', epora_fonts_url(), array(), '1.0.0' );
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', EPORA_THEME_CSS_DIR.'bootstrap.rtl.min.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', EPORA_THEME_CSS_DIR.'bootstrap.css', array() );
    }
    wp_enqueue_style( 'meanmenu', EPORA_THEME_CSS_DIR . 'meanmenu.css', [] );
    wp_enqueue_style( 'animate', EPORA_THEME_CSS_DIR . 'animate.css', [] );
    wp_enqueue_style( 'slick', EPORA_THEME_CSS_DIR . 'slick.css', [] );
    wp_enqueue_style( 'backtotop', EPORA_THEME_CSS_DIR . 'backtotop.css', [] );
    wp_enqueue_style( 'magnific-popup', EPORA_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'nice-select', EPORA_THEME_CSS_DIR . 'nice-select.css', [] );
    wp_enqueue_style( 'ui-icon', EPORA_THEME_CSS_DIR . 'ui-icon.css', [] );
    wp_enqueue_style( 'elegentfonts', EPORA_THEME_CSS_DIR . 'elegentfonts.css', [] );
    wp_enqueue_style( 'font-awesome-pro', EPORA_THEME_CSS_DIR . 'font-awesome-pro.css', [] );
    wp_enqueue_style( 'jquery-fancybox', EPORA_THEME_CSS_DIR . 'spacing.css', [] );
    wp_enqueue_style( 'epora-core', EPORA_THEME_CSS_DIR . 'epora-core.css', [] );
    wp_enqueue_style( 'epora-woo', EPORA_THEME_CSS_DIR . 'woo.css', [] );
    wp_enqueue_style( 'epora-unit', EPORA_THEME_CSS_DIR . 'epora-unit.css', [] );
    wp_enqueue_style( 'epora-custom', EPORA_THEME_CSS_DIR . 'epora-custom.css', [] );
    wp_enqueue_style( 'epora-style', get_stylesheet_uri() );

    // all js
    wp_enqueue_script( 'waypoints', EPORA_THEME_JS_DIR . 'waypoints.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'bootstrap-bundle', EPORA_THEME_JS_DIR . 'bootstrap-bundle.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'meanmenu', EPORA_THEME_JS_DIR . 'meanmenu.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'slick', EPORA_THEME_JS_DIR . 'slick.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'magnific-popup', EPORA_THEME_JS_DIR . 'magnific-popup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'parallax', EPORA_THEME_JS_DIR . 'parallax.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'backtotop', EPORA_THEME_JS_DIR . 'backtotop.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-nice-select', EPORA_THEME_JS_DIR . 'nice-select.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'counterup', EPORA_THEME_JS_DIR . 'counterup.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'wow', EPORA_THEME_JS_DIR . 'wow.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'isotope-pkgd', EPORA_THEME_JS_DIR . 'isotope-pkgd.js', [ 'imagesloaded' ], false, true );
    wp_enqueue_script( 'epora-main', EPORA_THEME_JS_DIR . 'main.js', [ 'jquery' ], false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'epora_scripts' );

/*
Register Fonts
 */
function epora_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'epora' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap';
    }
    return $font_url;
}