<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package epora
 */

get_header();
?>
<?php 
   $epora_404_bg = get_theme_mod('epora_404_bg',get_template_directory_uri() . '/assets/img/bg/erroe-bg.png');
   $epora_error_title = get_theme_mod('epora_error_title', __('Page not found', 'epora'));
   $epora_error_link_text = get_theme_mod('epora_error_link_text', __('Back To Home', 'epora'));
   $epora_error_desc = get_theme_mod('epora_error_desc', __('Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'epora'));
?>

<!-- error-area -->
<section class="error-area pt-120 pb-115">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-12 col-lg-8">
            <div class="error-item text-center">
            <?php if ( !empty( $epora_404_bg ) ): ?>
               <div class="error-thumb mb-50">
                  <img src="<?php echo esc_url($epora_404_bg); ?>" alt="<?php print esc_attr__('Error 404','epora'); ?>">
               </div>
               <?php endif; ?>
               <div class="error-content">
                  <?php if ( !empty( $epora_error_title ) ): ?>
                  <h4 class="error-title mb-35"><?php print esc_html($epora_error_title);?></h4>
                  <?php endif; ?>
                  <?php if ( !empty( $epora_error_desc ) ): ?>
                  <p><?php print esc_html($epora_error_desc);?></p>
                  <?php endif; ?>
                  <?php if ( !empty( $epora_error_link_text ) ): ?>
                  <a href="<?php print esc_url(home_url('/'));?>" class="tp-btn"><?php print esc_html($epora_error_link_text);?></a>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- error-area-end -->

<?php
get_footer();
