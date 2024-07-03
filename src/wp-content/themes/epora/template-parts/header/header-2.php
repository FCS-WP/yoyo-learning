<?php 

	/**
	 * Template part for displaying header layout two
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package epora
	*/

	// info

    $epora_search = get_theme_mod( 'epora_search', false );
    $epora_header_category = get_theme_mod( 'epora_header_category', false );
    
    // header right
    $epora_header_right = get_theme_mod( 'epora_header_right', false );
   
    $epora_menu_col = $epora_header_right ? 'col-xxl-9 col-xl-9 col-lg-6 text-start' : 'col-xxl-12 col-xl-9 col-lg-6 text-start';

?>

   <!-- header area start -->
   <header class="header_white_area d-none d-xl-block">
      <div class="header__area pt-40 pb-5">
         <div class="main-header">
            <div class="container">
               <div class="row align-items-center justify-content-between">
                  <div class="col-xxl-7 col-xl-6 col-lg-6 col-md-5 col-6">
                     <div class="logo-area d-flex align-items-center">
                        <div class="logo">
                           <?php epora_header_logo();?>
                        </div>
                        <?php if ( !empty( $epora_header_category ) ): ?>
                        <div class="header-cat-menu ml-40">
                           <nav>
                              <?php epora_category_menu(); ?>
                           </nav>
                        </div>
                        <?php endif; ?>
                     </div>
                  </div>
                  <?php if ( !empty( $epora_search ) ): ?>
                  <div class="col-xxl-5 col-lg-6 col-md-7">
                     <div class="header-right header-right-box">
                        <div class="header-search-box">
                           <form action="<?php print esc_url( home_url( '/' ) );?>">
                              <div class="search-input">
                                 <input type="email" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'What you want to learn?', 'epora' );?>">
                                 <button type="submit" class="header-search-btn"><i class="fi fi-rs-search mr-5"></i> <?php echo esc_html__('Search Now', 'epora') ?></button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>

      <div class="header-menu-area" id="header-sticky">
         <div class="container">
            <div class="row">
               <div class="<?php echo esc_attr($epora_menu_col); ?>">
                  <div class="main-menu main-menu-white">
                     <nav id="mobile-menu">
                        <?php epora_header_menu(); ?>
                     </nav>
                  </div>
               </div>
               <?php if ( !empty( $epora_header_right ) ): ?>
               <div class="col-xxl-3 col-xl-3 col-lg-6 d-flex align-items-center justify-content-end">
                  <div class="header-meta-green">
                     <ul>
                        <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                        <li><a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>"><i class="fi fi-rr-user"></i></a></li>
                        <?php endif; ?>
                        <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                        <li>
                           <a href="<?php echo wc_get_cart_url(); ?>"><i class="fi fi-rr-shopping-bag"></i>
                              <span id="tp-cart-item" class="cart__count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                           </a>
                           <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>
                        </li>
                        <?php endif; ?>

                        <li><a href="#" class="tp-menu-toggle d-xl-none"><i class="icon_ul"></i></a></li>
                     </ul>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </header>

   <div id="header-mob-sticky" class="mobile-header-area mob-white-sticky d-xl-none">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-md-6 col-5">
               <div class="logo">
                  <?php epora_header_logo();?>
               </div>
            </div>
            <div class="col-md-6 col-7 d-flex align-items-center justify-content-end">
               <?php if ( !empty( $epora_header_right ) ): ?>
               <div class="header-meta-green text-end">
                  <ul>
                     <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                     <li><a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>"><i class="fi fi-rr-user"></i></a></li>
                     <?php endif; ?>
                     <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                     <li><a href="<?php echo wc_get_cart_url(); ?>"><i class="fi fi-rr-shopping-bag"></i></a></li>
                     <?php endif; ?>
                  </ul>
               </div>
               <?php endif; ?>
               <div class="header-meta-green ">
                  <ul>
                     <li><a href="#" class="tp-menu-toggle d-xl-none"><i class="icon_ul"></i></a></li>
                  </ul>
               </div>
            </div>
            
         </div>
      </div>
   </div>
   <!-- header area end -->

<?php get_template_part( 'template-parts/header/header-side-info' ); ?>