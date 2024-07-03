<?php 

/**
 * Template part for displaying footer layout three
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package epora
*/

    $epora_footer_logo = get_theme_mod( 'epora_footer_logo' );
    $epora_footer_social_switch = get_theme_mod( 'epora_footer_social_switch' );

    if(!empty($epora_footer_logo) && !empty($epora_footer_social_switch)){
        $epora_copyright_center = 'col-xl-6 col-lg-5 text-center';
    }elseif(!empty($epora_footer_logo)){
        $epora_copyright_center = 'col-xl-9 col-lg-9 text-end';
    }elseif(!empty($epora_footer_social_switch)){
        $epora_copyright_center = 'col-xl-9 col-lg-8';
    }else{
        $epora_copyright_center = 'col-xl-12 col-lg-12 text-center';
    }

    // $epora_copyright_center = $epora_footer_logo ? 'col-xl-6 col-lg-5' : 'col-xl-9 col-lg-8';

    $footer_bg_img = get_theme_mod( 'epora_footer_bg' );
    $footer_bg_color = get_theme_mod( 'epora_footer_bg_color' );
    $epora_footer_bg_url_from_page = function_exists( 'get_field' ) ? get_field( 'epora_footer_bg' ) : '';
    $epora_footer_bg_color_from_page = function_exists( 'get_field' ) ? get_field( 'epora_footer_bg_color' ) : '';
    // bg image
    $footer_main_bg_img = !empty( $epora_footer_bg_url_from_page['url'] ) ? $epora_footer_bg_url_from_page['url'] : $footer_bg_img;
    // bg color
    $footer_main_bg_color = !empty( $epora_footer_bg_color_from_page ) ? $epora_footer_bg_color_from_page : $footer_bg_color;

    // footer_columns
    $footer_columns = 0;
    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    for ( $num = 1; $num <= $footer_widgets + 1; $num++ ) {
        if ( is_active_sidebar( 'footer-3-' . $num ) ) {
            $footer_columns++;
        }
    }

    switch ( $footer_columns ) {
    case '1':
        $footer_class[1] = 'col-lg-12';
        break;
    case '2':
        $footer_class[1] = 'col-lg-6 col-md-6';
        $footer_class[2] = 'col-lg-6 col-md-6';
        break;
    case '3':
        $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
        $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
        $footer_class[3] = 'col-xl-4 col-lg-6';
        break;
    case '4':
        $footer_class[1] = 'col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-7';
        $footer_class[2] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5';
        $footer_class[3] = 'col-xxl-3 col-xl-2 col-lg-2 col-md-3 col-sm-5';
        $footer_class[4] = 'col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-7';
        break;
    case '5':
        $footer_class[1] = 'col-xl-2 col-md-4  col-6';
        $footer_class[2] = 'col-xl-3 col-md-4 col-6';
        $footer_class[3] = 'col-xl-3 col-md-4 col-6';
        $footer_class[4] = 'col-xl-2 col-md-4 col-6';
        $footer_class[5] = 'col-xl-2 col-md-4 col-6';
        break;
    default:
        $footer_class = 'col-xl-3 col-lg-3 col-md-6';
        break;
    }

    ?>

<!-- footer-area -->
<footer>
    <div class="footer-bg theme-bg bg-bottom" data-bg-color="<?php echo esc_attr( $footer_main_bg_color );?>"  data-background="<?php echo esc_url($footer_main_bg_img ); ?>">
        <?php if ( is_active_sidebar('footer-3-1') OR is_active_sidebar('footer-3-2') OR is_active_sidebar('footer-3-3') OR is_active_sidebar('footer-3-4') OR is_active_sidebar('footer-3-5') ): ?>
        <div class="f-border pt-115 pb-70">
            <div class="container">
                <div class="row">
                    <?php
                        if ( $footer_columns < 4 ) {
                        print '<div class="col-xl-2 col-md-4  col-6">';
                        dynamic_sidebar( 'footer-3-1' );
                        print '</div>';

                        print '<div class="col-xl-3 col-md-4 col-6">';
                        dynamic_sidebar( 'footer-3-2' );
                        print '</div>';

                        print '<div class="col-xl-3 col-md-4 col-6">';
                        dynamic_sidebar( 'footer-3-3' );
                        print '</div>';

                        print '<div class="col-xl-2 col-md-4 col-6">';
                        dynamic_sidebar( 'footer-3-4' );
                        print '</div>';

                        print '<div class="col-xl-2 col-md-4 col-6">';
                        dynamic_sidebar( 'footer-3-5' );
                        print '</div>';

                        } else {
                            for ( $num = 1; $num <= $footer_columns + 1; $num++ ) {
                                if ( !is_active_sidebar( 'footer-3-' . $num ) ) {
                                    continue;
                                }
                                print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                                dynamic_sidebar( 'footer-3-' . $num );
                                print '</div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="f-copyright pt-60 pb-40">
            <div class="container">
                <div class="row text-center text-lg-start">
                    <?php if(!empty($epora_footer_logo)): ?>
                    <div class="col-xl-3 col-lg-3">
                        <div class="f-copyright__logo mb-30">
                            <a href="#"><img src="<?php echo esc_url($epora_footer_logo); ?>" alt="<?php echo esc_attr__('Footer logo', 'epora') ?>"></a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="<?php echo esc_attr($epora_copyright_center) ?>">
                    <div class="f-copyright__text mb-30">
                        <span><?php print epora_copyright_text(); ?></span>
                    </div>
                    </div>
                    <?php if(!empty($epora_footer_social_switch)): ?>
                    <div class="col-xl-3 col-lg-4">
                        <div class="f-copyright__social-area mb-20 text-lg-end">
                            <?php print epora_footer_social_profiles(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</footer>
<!-- footer-area-end -->