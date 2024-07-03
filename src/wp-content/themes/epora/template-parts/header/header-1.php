<?php 

	/**
	 * Template part for displaying header layout three
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package epora
	*/

   // info
   $epora_header_category = get_theme_mod( 'epora_header_category', false );

   // header right
   $epora_header_right = get_theme_mod( 'epora_header_right', false );
   
   $epora_menu_col = $epora_header_right ? 'col-xxl-7 col-xl-7 col-lg-8 d-none d-lg-block' : 'col-xxl-10 col-xl-10 col-lg-9 d-none d-lg-block text-end';

?>

   <!-- header area start -->
   <header class="header_no_transparent">
      <div class="default-main-header" id="header-sticky">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-xxl-3 col-xl-3 col-lg-5 col-md-6 col-6">
                  <div class="logo-area d-flex align-items-center">
                     <div class="logo">
                        <?php epora_header_logo();?>
                     </div>
                  </div>
               </div>
               <div class="col-xxl-9 col-xl-9 col-lg-7 col-md-6 col-6 d-flex align-items-center justify-content-end">
                  <div class="main-menu main-menu-black d-flex justify-content-end">
                     <nav id="mobile-menu">
                        <?php epora_header_menu(); ?>
                     </nav>
                  </div>
                  <?php if ( !empty( $epora_header_right ) ): ?>
                  <div class="header-right d-flex align-items-center">
                     <div class="header-meta header-meta-white">
                        <ul>
                           <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                           <li class="d-none d-md-inline-block"><a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>"><i class="fi fi-rr-user"></i></a></li>
                           <?php endif; ?>
                           <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                           <li class="d-none d-md-inline-block"><a href="<?php echo wc_get_cart_url(); ?>"><i class="fi fi-rr-shopping-bag"></i></a>
                              <span id="tp-cart-item" class="cart__count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                              <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>
                           </li>
                           <?php endif; ?>
                        </ul>
                     </div>
                  </div>
                  <?php endif; ?>
                  <div class="header-meta header-meta-white">
                     <ul>
                        <li><a href="#" class="tp-menu-toggle d-xl-none"><i class="icon_ul"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>
   <!-- header area end -->

<?php get_template_part( 'template-parts/header/header-side-info' ); ?>