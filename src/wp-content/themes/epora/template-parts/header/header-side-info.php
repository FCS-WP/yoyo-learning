<?php 

   /**
    * Template part for displaying header side information
    *
    * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
    *
    * @package epora
   */

    $epora_side_hide = get_theme_mod( 'epora_side_hide', false );
    $epora_side_logo = get_theme_mod( 'epora_side_logo', get_template_directory_uri() . '/assets/img/logo/logo-black.png' );

    $epora_contact_title = get_theme_mod( 'epora_contact_title', __( 'Contact Info', 'epora' ) );
    $epora_extra_address = get_theme_mod( 'epora_extra_address', __( '27 Division St, New York', 'epora' ) );
    $epora_extra_phone = get_theme_mod( 'epora_extra_phone', __( '+180012345678', 'epora' ) );
    $epora_extra_email = get_theme_mod( 'epora_extra_email', __( 'epora@example.com', 'epora' ) );

?>

<!-- offcanvas area start -->
<div class="tp-sidebar-menu">
   <button class="sidebar-close"><i class="icon_close"></i></button>
   <div class="side-logo mb-30">
      <a href="<?php print esc_url( home_url( '/' ) );?>">
         <img src="<?php echo esc_url($epora_side_logo); ?>" alt="<?php esc_attr__('Logo', 'epora'); ?>">
      </a>
   </div>

   <div class="mobile-menu"></div>

   <?php if ( !empty( $epora_side_hide ) ): ?>
   <div class="sidebar-info">
      <?php if ( !empty( $epora_contact_title ) ): ?>
         <h4 class="mb-15"><?php echo esc_html($epora_contact_title); ?></h4>
      <?php endif;?>

      <ul class="side_circle">
         <?php if ( !empty( $epora_extra_address ) ): ?>
            <li><?php echo esc_html($epora_extra_address); ?></li>
         <?php endif;?>

         <?php if ( !empty( $epora_extra_phone ) ): ?>
            <li><a href="tel:<?php echo esc_attr($epora_extra_phone); ?>"><?php echo esc_html($epora_extra_phone); ?></a></li>
         <?php endif;?>

         <?php if ( !empty( $epora_extra_email ) ): ?>
            <li><a href="mailto:<?php echo esc_attr($epora_extra_email); ?>"><?php echo esc_html($epora_extra_email); ?></a></li>
         <?php endif;?>
      </ul>

      <div class="side-social">
         <?php epora_header_social_profiles(); ?>
      </div>

   </div>
   <?php endif; ?>

</div>

<div class="body-overlay"></div>
<!-- offcanvas area end -->