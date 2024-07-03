<?php 

	/**
	 * Template part for displaying header layout one
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
    
    $epora_menu_col = $epora_header_right ? 'col-xxl-7 col-xl-7 col-lg-8 d-none d-lg-block' : 'col-xxl-10 col-xl-10 col-lg-9 d-none d-lg-block text-end';

?>


<!-- header area start -->
<header class="header__transparent ">
   <div class="header__area">
      <div class="main-header header-xy-spacing" id="header-sticky">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-xxl-3 col-xl-3 col-lg-5 col-md-6 col-6">
                  <div class="logo-area d-flex align-items-center">
                     <div class="logo">
                        <?php epora_header_logo();?>
                     </div>
                     <?php if ( !empty( $epora_header_category ) ): ?>
                     <div class="header-cat-menu ml-40 d-none d-md-block">
                        <nav>
                           <?php epora_category_menu(); ?>
                        </nav>
                     </div>
                     <?php endif; ?>

                  </div>
               </div>
               <div class="col-xxl-9 col-xl-9 col-lg-7 col-md-6 col-6 d-flex align-items-center justify-content-end">
                  <div class="main-menu d-flex justify-content-end mr-15">
                     <nav id="mobile-menu">
                        <?php epora_header_menu(); ?>
                     </nav>
                  </div>
                  <?php if ( !empty( $epora_header_right ) ): ?>
                  <div class="header-right d-md-flex align-items-center">
                        <?php if ( !empty( $epora_search ) ): ?>
                        <div class="header__search d-none d-lg-block">
                           <form action="<?php print esc_url( home_url( '/' ) );?>">
                              <div class="header__search-input">
                                 <button type="submit" class="header__search-btn">
                                    <i class="fa-regular fa-magnifying-glass"></i>
                                 </button>
                                 <input type="text" name="s" value="<?php print esc_attr( get_search_query() )?>" placeholder="<?php print esc_attr__( 'Search Courses', 'epora' );?>">
                              </div>
                           </form>
                        </div>
                        <?php endif; ?>

                        <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                        <div class="header-meta">
                           <ul>
                              <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                              <li class="d-none d-md-inline-block"><a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>"><i class="fi fi-rr-user"></i></a></li>
                              <?php endif; ?>
                              <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                              <li class="d-none d-md-inline-block">
                                 <a href="<?php echo wc_get_cart_url(); ?>"><i class="fi fi-rr-shopping-bag"></i></a>
                                 <span id="tp-cart-item" class="cart__count"><?php echo esc_html(WC()->cart->cart_contents_count); ?></span>
                                 <div class="mini_shopping_cart_box"><?php woocommerce_mini_cart(); ?></div>
                              </li>
                              <?php endif; ?>
                           </ul>
                           <?php endif; ?>
                           
                        </div>
                     </div>
                  <?php endif; ?>
                  <div class="header-meta">
                     <ul>
                        <li><a href="#" class="tp-menu-toggle d-xl-none"><i class="icon_ul"></i></a></li>
                     </ul>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>
</header>
<!-- header area end -->

<?php get_template_part( 'template-parts/header/header-side-info' ); ?>