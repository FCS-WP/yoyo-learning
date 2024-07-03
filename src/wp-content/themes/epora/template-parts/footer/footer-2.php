<?php 

/**
 * Template part for displaying footer layout two
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package epora
*/

$epora_footer_menu = get_theme_mod( 'epora_footer_menu' );
$epora_copyright_center = $epora_footer_menu ? 'col-lg-5 col-md-5 col-12' : 'col-lg-12 col-md-12 col-12  text-center';

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

for ( $num = 1; $num <= $footer_widgets; $num++ ) {
    if ( is_active_sidebar( 'footer-2-' . $num ) ) {
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
    $footer_class[1] = 'col-xl-4 col-lg-4 col-md-6 col-12';
    $footer_class[2] = 'col-xl-3 col-lg-2 col-md-6 col-6';
    $footer_class[3] = 'col-xl-2 col-lg-2 col-md-6 col-6';
    $footer_class[4] = 'col-xl-3 col-lg-4 col-md-6 col-10';
    break;
default:
    $footer_class = 'col-xl-3 col-lg-3 col-md-6';
    break;
}

?>

<!-- footer-area -->
<footer>
    <div class="footer-bg theme-bg-secondary" data-bg-color="<?php echo esc_attr( $footer_main_bg_color );?>" data-background="<?php echo esc_url($footer_main_bg_img ); ?>">
        <?php if ( is_active_sidebar( 'footer-2-1' ) OR is_active_sidebar( 'footer-2-2' ) OR is_active_sidebar( 'footer-2-3' ) OR is_active_sidebar( 'footer-2-4' ) ): ?>
        <div class="f-border-bottom pt-115 pb-60">
            <div class="container">
                <div class="row">
                    <?php
                        if ( $footer_columns < 4 ) {
                        print '<div class="col-xl-4 col-lg-4 col-md-6 col-12">';
                        dynamic_sidebar( 'footer-2-1' );
                        print '</div>';

                        print '<div class="col-xl-3 col-lg-2 col-md-6 col-6">';
                        dynamic_sidebar( 'footer-2-2' );
                        print '</div>';

                        print '<div class="col-xl-2 col-lg-2 col-md-6 col-6">';
                        dynamic_sidebar( 'footer-2-3' );
                        print '</div>';

                        print '<div class="col-xl-3 col-lg-4 col-md-6 col-10">';
                        dynamic_sidebar( 'footer-2-4' );
                        print '</div>';
                        } else {
                            for ( $num = 1; $num <= $footer_columns; $num++ ) {
                                if ( !is_active_sidebar( 'footer-2-' . $num ) ) {
                                    continue;
                                }
                                print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                                dynamic_sidebar( 'footer-2-' . $num );
                                print '</div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="f-copyright pt-60 pb-60">
            <div class="container">
                <div class="row">
                    <div class="<?php echo esc_attr($epora_copyright_center) ?>">
                        <div class="f-copyright__dom">
                        <span><?php print epora_copyright_text(); ?></span>
                        </div>
                    </div>
                    <?php if(!empty($epora_footer_menu)): ?>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="f-copyright__list f-bottom-list">
                            <?php echo epora_kses($epora_footer_menu); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-area-end -->  
