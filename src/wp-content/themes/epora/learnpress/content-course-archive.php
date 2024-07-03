<?php

    defined( 'ABSPATH' ) || exit();

    $course          = LP_Global::course();
    $instructor      = $course->get_instructor();
    $instructor_link = $course->get_instructor_html();
    $instructor_id   = $course->get_id();

?>

<div class="col-xl-4 col-lg-6 col-md-6">
   <div class="tpcourse mb-40 wow fadeInUp">
      <div class="tpcourse__thumb p-relative w-img fix">
           <a href="<?php the_permalink(); ?>">
              <img src="<?php echo  esc_url(get_the_post_thumbnail_url()); ?>" alt="img">
           </a>
         <div class="tpcourse__tag d-none">
            <a href="https://weblearnbd.net/wp/epora/course-details/"><i class="fi fi-rr-heart"></i></a>
         </div>
         <?php 
             $dir = learn_press_user_profile_picture_upload_dir();
             $user = get_user_by( 'id', $instructor->get_id());
             $pro_link = get_user_meta($user->ID,'_lp_profile_picture',true); 
             $base_url = isset($dir['baseurl'])?$dir['baseurl']:'';
             $profile_link =  $base_url.'/'.$pro_link;
         ?>
         <?php if($pro_link !='') : ?>
         <div class="tpcourse__img-icon">
            <img src="<?php echo esc_url($profile_link); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
            <?php  echo wp_kses_post($instructor_link) ?>
         </div>
         <?php else : ?>
         <div class="tpcourse__img-icon">
            <img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
            <?php  echo wp_kses_post($instructor_link) ?>
         </div>
         <?php endif; ?>
      </div>
      <div class="tpcourse__content-2">
         <div class="tpcourse__category mb-10">
            <div class="tpcourse__price-list">
               <?php
                  echo wp_kses_post(epora_course_cageory_by_id(get_the_id()));
               ?>
            </div>
         </div>
         <div class="tpcourse__ava-title mb-15">
            <h4 class="tpcourse__title tp-cours-title-color"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h4>
         </div>
         <div class="tpcourse__meta tpcourse__meta-gap pb-15 mb-15">
            <ul class="d-flex align-items-center">
               <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-01.png" alt="meta-icon"> 
                  <span><?php   
                     $lessons = $course->get_curriculum_items( 'lp_lesson' )? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0; 
                     echo esc_html($lessons). esc_html__(' lessons','epora'); 
                  ?></span>
               </li>

               <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-02.png" alt="meta-icon"> <span><?php $student = _n('%s  Student', '%s Students', $course->get_users_enrolled(), 'epora');
                     echo sprintf($student, $course->get_users_enrolled());
                     ?> 
               </span>
               </li>

            </ul>
         </div>
         <div class="tpcourse__rating d-flex align-items-center justify-content-between">
              <?php 
              if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
              $total_rating = 5;
              $reviews = leanr_press_get_ratings_result( get_the_ID() ); 
              $taken_rating = !empty($reviews['rated']) ? $reviews['rated'] : 0;
              $blank_rating = $total_rating - $taken_rating;
              ?>
            <div class="tpcourse__rating-icon">
               <span><?php echo !empty($reviews['total']) ? $reviews['total'] : 0; ?></span>
               <?php 
                 for ($i=0; $i < intval($taken_rating); $i++) { ?>
                     <i class="fi fi-ss-star"></i>
                 <?php } ?>
                 <?php for ($j=0; $j < intval($blank_rating); $j++) { ?>
                     <i class="fi fi-rs-star"></i>
                 <?php } ?>
               <p>(<?php echo esc_html($taken_rating); ?>)</p>
            </div>
            <?php endif; ?>
            <div class="tpcourse__pricing">
              <?php if($course->is_free()): ?>
              <h5 class="price-title"> <?php echo esc_html__('Free','epora'); ?> </h5>
              <?php else: ?>
                <h5 class="price-title"><?php echo esc_html($course->get_price_html()); ?> </span>
                <?php if ( $course->get_origin_price() != $course->get_price() ) : ?>
                <h5 class="old-price price-title"><?php echo esc_html($course->get_origin_price_html()); ?></h5>
                <?php endif; ?>
              <?php endif; ?>
            </div>
         </div>
      </div>
   </div>
</div>

