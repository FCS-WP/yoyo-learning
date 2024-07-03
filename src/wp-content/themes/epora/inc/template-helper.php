<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package epora
 */

/** 
 *
 * epora header
 */

function epora_check_header() {
    $epora_header_style = function_exists( 'get_field' ) ? get_field( 'header_style' ) : NULL;
    $epora_default_header_style = get_theme_mod( 'choose_default_header', 'header-style-1' );

    if ( $epora_header_style == 'header-style-1' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-1' );
    } 
    elseif ( $epora_header_style == 'header-style-2' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-2' );
    } 
    elseif ( $epora_header_style == 'header-style-3' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-3' );
    }     
    elseif ( $epora_header_style == 'header-style-4' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-4' );
    } 
    else {

        /** default header style **/
        if ( $epora_default_header_style == 'header-style-2' ) {
            get_template_part( 'template-parts/header/header-2' );
        } 
        elseif ( $epora_default_header_style == 'header-style-3' ) {
            get_template_part( 'template-parts/header/header-3' );
        }
        elseif ( $epora_default_header_style == 'header-style-4' ) {
            get_template_part( 'template-parts/header/header-4' );
        }
        else {
            get_template_part( 'template-parts/header/header-1' );
        }
    }

}
add_action( 'epora_header_style', 'epora_check_header', 10 );


/**
 * [epora_header_lang description]
 * @return [type] [description]
 */
function epora_header_lang_defualt() {
    $epora_header_lang = get_theme_mod( 'epora_header_lang', false );
    if ( $epora_header_lang ): ?>

    <ul>
        <li><a href="javascript:void(0)" class="lang__btn"><?php print esc_html__( 'English', 'epora' );?> <i class="fa-light fa-angle-down"></i></a>
        <?php do_action( 'epora_language' );?>
        </li>
    </ul>

    <?php endif;?>
<?php
}

/**
 * [epora_language_list description]
 * @return [type] [description]
 */
function _epora_language( $mar ) {
    return $mar;
}
function epora_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul>';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul>';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'epora' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Bangla', 'epora' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'epora' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    print _epora_language( $mar );
}
add_action( 'epora_language', 'epora_language_list' );


// header logo
function epora_header_logo() { ?>
      <?php
        $epora_logo_on = function_exists( 'get_field' ) ? get_field( 'is_enable_sec_logo' ) : NULL;
        $epora_logo = get_template_directory_uri() . '/assets/img/logo/logo-black.png';
        $epora_logo_black = get_template_directory_uri() . '/assets/img/logo/logo-white.png';

        $epora_site_logo = get_theme_mod( 'logo', $epora_logo );
        $epora_secondary_logo = get_theme_mod( 'seconday_logo', $epora_logo_black );
      ?>

      <?php if ( !empty( $epora_logo_on ) ) : ?>
         <a class="secondary-logo" href="<?php print esc_url( home_url( '/' ) );?>">
             <img src="<?php print esc_url( $epora_secondary_logo );?>" alt="<?php print esc_attr__( 'logo', 'epora' );?>" />
         </a>
      <?php else : ?>
         <a class="standard-logo" href="<?php print esc_url( home_url( '/' ) );?>">
             <img src="<?php print esc_url( $epora_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'epora' );?>" />
         </a>
      <?php endif; ?>
   <?php
}

// header logo
function epora_header_sticky_logo() {?>
    <?php
        $epora_logo_black = get_template_directory_uri() . '/assets/img/logo/logo-black.png';
        $epora_secondary_logo = get_theme_mod( 'seconday_logo', $epora_logo_black );
    ?>
      <a class="sticky-logo" href="<?php print esc_url( home_url( '/' ) );?>">
          <img src="<?php print esc_url( $epora_secondary_logo );?>" alt="<?php print esc_attr__( 'logo', 'epora' );?>" />
      </a>
    <?php
}

function epora_mobile_logo() {
    // side info
    $epora_mobile_logo_hide = get_theme_mod( 'epora_mobile_logo_hide', false );

    $epora_site_logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/img/logo/logo.png' );

    ?>

    <?php if ( !empty( $epora_mobile_logo_hide ) ): ?>
    <div class="side__logo mb-25">
        <a class="sideinfo-logo" href="<?php print esc_url( home_url( '/' ) );?>">
            <img src="<?php print esc_url( $epora_site_logo );?>" alt="<?php print esc_attr__( 'logo', 'epora' );?>" />
        </a>
    </div>
    <?php endif;?>



<?php }

/**
 * [epora_header_social_profiles description]
 * @return [type] [description]
 */
function epora_header_social_profiles() {
    $epora_topbar_fb_url = get_theme_mod( 'epora_topbar_fb_url', __( '#', 'epora' ) );
    $epora_topbar_twitter_url = get_theme_mod( 'epora_topbar_twitter_url', __( '#', 'epora' ) );
    $epora_topbar_instagram_url = get_theme_mod( 'epora_topbar_instagram_url', __( '#', 'epora' ) );
    $epora_topbar_linkedin_url = get_theme_mod( 'epora_topbar_linkedin_url', __( '#', 'epora' ) );
    $epora_topbar_youtube_url = get_theme_mod( 'epora_topbar_youtube_url', __( '#', 'epora' ) );
    ?>
        
            <?php if ( !empty( $epora_topbar_fb_url ) ): ?>
            <a href="<?php print esc_url( $epora_topbar_fb_url );?>"><i class="fab fa-facebook-f"></i></a>
            <?php endif;?>

            <?php if ( !empty( $epora_topbar_twitter_url ) ): ?>
                <a href="<?php print esc_url( $epora_topbar_twitter_url );?>"><i class="fab fa-twitter"></i></a>
            <?php endif;?>

            <?php if ( !empty( $epora_topbar_instagram_url ) ): ?>
                <a href="<?php print esc_url( $epora_topbar_instagram_url );?>"><i class="fab fa-instagram"></i></a>
            <?php endif;?>

            <?php if ( !empty( $epora_topbar_linkedin_url ) ): ?>
                <a href="<?php print esc_url( $epora_topbar_linkedin_url );?>"><i class="fab fa-linkedin"></i></a>
            <?php endif;?>

            <?php if ( !empty( $epora_topbar_youtube_url ) ): ?>
                <a href="<?php print esc_url( $epora_topbar_youtube_url );?>"><i class="fab fa-youtube"></i></a>
            <?php endif;?>
        

<?php
}

function epora_footer_social_profiles() {
    $epora_footer_fb_url = get_theme_mod( 'epora_footer_fb_url', __( '#', 'epora' ) );
    $epora_footer_twitter_url = get_theme_mod( 'epora_footer_twitter_url', __( '#', 'epora' ) );
    $epora_footer_instagram_url = get_theme_mod( 'epora_footer_instagram_url', __( '#', 'epora' ) );
    $epora_footer_linkedin_url = get_theme_mod( 'epora_footer_linkedin_url', __( '#', 'epora' ) );
    $epora_footer_youtube_url = get_theme_mod( 'epora_footer_youtube_url', __( '#', 'epora' ) );
    ?>
        <?php if ( !empty( $epora_footer_fb_url ) ): ?>
            <a href="<?php print esc_url( $epora_footer_fb_url );?>">
                <i class="fab fa-facebook-f"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $epora_footer_twitter_url ) ): ?>
            <a href="<?php print esc_url( $epora_footer_twitter_url );?>">
                <i class="fab fa-twitter"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $epora_footer_instagram_url ) ): ?>
            <a href="<?php print esc_url( $epora_footer_instagram_url );?>">
                <i class="fab fa-instagram"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $epora_footer_linkedin_url ) ): ?>
            <a href="<?php print esc_url( $epora_footer_linkedin_url );?>">
                <i class="fab fa-linkedin"></i>
            </a>
        <?php endif;?>

        <?php if ( !empty( $epora_footer_youtube_url ) ): ?>
            <a href="<?php print esc_url( $epora_footer_youtube_url );?>">
                <i class="fab fa-youtube"></i>
            </a>
        <?php endif;?>
<?php
}

/**
 * [epora_header_menu description]
 * @return [type] [description]
 */
function epora_header_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'epora_Navwalker_Class::fallback',
            'walker'         => new epora_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [epora_header_menu description]
 * @return [type] [description]
 */
function epora_mobile_menu() {
    ?>
    <?php
        $epora_menu = wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'menu_id'        => 'mobile-menu-active',
            'echo'           => false,
        ] );

    $epora_menu = str_replace( "menu-item-has-children", "menu-item-has-children has-children", $epora_menu );
        echo wp_kses_post( $epora_menu );
    ?>
    <?php
}

/**
 * [epora_search_menu description]
 * @return [type] [description]
 */
function epora_header_search_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'header-search-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'epora_Navwalker_Class::fallback',
            'walker'         => new epora_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [epora_footer_menu description]
 * @return [type] [description]
 */
function epora_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'm-0',
        'container'      => '',
        'fallback_cb'    => 'epora_Navwalker_Class::fallback',
        'walker'         => new epora_Navwalker_Class,
    ] );
}


/**
 * [epora_category_menu description]
 * @return [type] [description]
 */
function epora_category_menu() {
    wp_nav_menu( [
        'theme_location' => 'category-menu',
        // 'menu_class'     => 'cat-submenu m-0',
        'container'      => '',
        'fallback_cb'    => 'epora_Navwalker_Class::fallback',
        'walker'         => new epora_Navwalker_Class,
    ] );
}

/**
 *
 * epora footer
 */
add_action( 'epora_footer_style', 'epora_check_footer', 10 );

function epora_check_footer() {
    $epora_footer_style = function_exists( 'get_field' ) ? get_field( 'footer_style' ) : NULL;
    $epora_default_footer_style = get_theme_mod( 'choose_default_footer', 'footer-style-1' );

    if ( $epora_footer_style == 'footer-style-1' ) {
        get_template_part( 'template-parts/footer/footer-1' );
    } 
    elseif ( $epora_footer_style == 'footer-style-2' ) {
        get_template_part( 'template-parts/footer/footer-2' );
    } 
    elseif ( $epora_footer_style == 'footer-style-3' ) {
        get_template_part( 'template-parts/footer/footer-3' );
    } else {

        /** default footer style **/
        if ( $epora_default_footer_style == 'footer-style-2' ) {
            get_template_part( 'template-parts/footer/footer-2' );
        } 
        elseif ( $epora_default_footer_style == 'footer-style-3' ) {
            get_template_part( 'template-parts/footer/footer-3' );
        }  
        else {
            get_template_part( 'template-parts/footer/footer-1' );
        }

    }
}

// epora_copyright_text
function epora_copyright_text() {
   print get_theme_mod( 'epora_copyright', esc_html__( '© 2022 epora, All Rights Reserved. Design By Theme Pure', 'epora' ) );
}



/**
 *
 * pagination
 */
if ( !function_exists( 'epora_pagination' ) ) {

    function _epora_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function epora_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul>';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _epora_pagi_callback( $pagi );
    }
}


// header top bg color
function epora_breadcrumb_bg_color() {
    $color_code = get_theme_mod( 'epora_breadcrumb_bg_color', '#222' );
    wp_enqueue_style( 'epora-custom', EPORA_THEME_CSS_DIR . 'epora-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: " . $color_code . "}";

        wp_add_inline_style( 'epora-breadcrumb-bg', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'epora_breadcrumb_bg_color' );

// breadcrumb-spacing top
function epora_breadcrumb_spacing() {
    $padding_px = get_theme_mod( 'epora_breadcrumb_spacing', '160px' );
    wp_enqueue_style( 'epora-custom', EPORA_THEME_CSS_DIR . 'epora-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: " . $padding_px . "}";

        wp_add_inline_style( 'epora-breadcrumb-top-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'epora_breadcrumb_spacing' );

// breadcrumb-spacing bottom
function epora_breadcrumb_bottom_spacing() {
    $padding_px = get_theme_mod( 'epora_breadcrumb_bottom_spacing', '160px' );
    wp_enqueue_style( 'epora-custom', EPORA_THEME_CSS_DIR . 'epora-custom.css', [] );
    if ( $padding_px != '' ) {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: " . $padding_px . "}";

        wp_add_inline_style( 'epora-breadcrumb-bottom-spacing', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'epora_breadcrumb_bottom_spacing' );

// scrollup
function epora_scrollup_switch() {
    $scrollup_switch = get_theme_mod( 'epora_scrollup_switch', false );
    wp_enqueue_style( 'epora-custom', EPORA_THEME_CSS_DIR . 'epora-custom.css', [] );
    if ( $scrollup_switch ) {
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style( 'epora-scrollup-switch', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'epora_scrollup_switch' );

// theme color
function epora_custom_color() {
    $color_code = get_theme_mod( 'epora_color_option', '#ff6652' );
    wp_enqueue_style( 'epora-custom', EPORA_THEME_CSS_DIR . 'epora-custom.css', [] );
    if ( !empty($color_code) ) {
        $custom_css = '';

        $custom_css .= " body .header-cat-menu ul li a, body .header-meta ul li > a:hover, body .tp-btn, body .tpfea:hover .tpfea__icon i { background-color: " . $color_code . "}";

        $custom_css .= " body .header-cat-menu ul li .submenu > li > a:hover, body .main-menu ul > li:hover > a, body .main-menu ul > li:hover > a::after, body .main-menu ul > li .submenu li:hover > a, body .header__search-btn, body .hero-content .hero-title i, body .tp-sub-title, body .tp-cat-item:hover .tp-category-title, body .tpcourse__title a:hover { color: " . $color_code . "}";
        

        wp_add_inline_style( 'epora-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'epora_custom_color' );

// epora_kses_intermediate
function epora_kses_intermediate( $string = '' ) {
    return wp_kses( $string, epora_get_allowed_html_tags( 'intermediate' ) );
}

function epora_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function epora_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}