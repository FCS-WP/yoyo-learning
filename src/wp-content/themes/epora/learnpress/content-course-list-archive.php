<?php

    defined( 'ABSPATH' ) || exit();

    $course          = LP_Global::course();
    $instructor      = $course->get_instructor();
    $instructor_link = $course->get_instructor_html();
    $instructor_id   = $course->get_id();

?>

<div class="col-xxl-12">
   <div class="course__item white-bg mb-30 fix">
      <div class="row gx-0">
         <div class="col-xxl-4 col-xl-4 col-lg-4">
            <div class="course__thumb course__thumb-list w-img p-relative fix">
               <a href="<?php the_permalink(); ?>">
                 <img src="<?php echo  esc_url(get_the_post_thumbnail_url()); ?>" alt="img">
              </a>
               <div class="course__tag">
                  <?php
                     echo wp_kses_post(epora_course_cageory_by_id(get_the_id()));
                  ?>
               </div>
            </div>
         </div>
         <div class="col-xxl-8 col-xl-8 col-lg-8">
            <div class="course__right">
               <div class="course__content course__content-3">
                  <div class="course__meta d-flex align-items-center">
                     <div class="course__lesson mr-20">
                        <span><i class="far fa-book-alt"></i>
                        <?php   
                           $lessons = $course->get_curriculum_items( 'lp_lesson' )? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0; 
                           echo esc_html($lessons). esc_html__(' lessons','epora'); 
                        ?>
                        </span>
                     </div>

                     <?php 
                     if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
                     $total_rating = 5;
                     $reviews = leanr_press_get_ratings_result( get_the_ID() ); 
                     $taken_rating = !empty($reviews['rated']) ? $reviews['rated'] : 0;
                     $blank_rating = $total_rating - $taken_rating;
                     
                     ?>
                    
                     <div class="course__rating">
                        <span>
                           <i class="icon_star"></i><?php echo esc_html($taken_rating); ?> (<?php echo !empty($reviews['total']) ? $reviews['total'] : 0; ?>)</span>
                     </div>
                     <?php endif; ?>
                  </div>
                  <h3 class="course__title course__title-3">
                     <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a>
                  </h3>
                  <div class="course__summary">
                     <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), 18, ''); ?></p>
                  </div>


                  <?php 
                      $dir = learn_press_user_profile_picture_upload_dir();
                      $user = get_user_by( 'id', $instructor->get_id());
                      $pro_link = get_user_meta($user->ID,'_lp_profile_picture',true); 
                      $base_url = isset($dir['baseurl'])?$dir['baseurl']:'';
                      $profile_link =  $base_url.'/'.$pro_link;
                  ?>
                  <?php if($pro_link !='') : ?>
                 <div class="course__teacher d-flex align-items-center">
                    <div class="course__teacher-thumb mr-15">
                       <img src="<?php echo esc_url($profile_link); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                    </div>
                    <h6><?php  echo wp_kses_post($instructor_link) ?></h6>
                 </div>
                  <?php else : ?>
                  <div class="course__teacher d-flex align-items-center">
                    <div class="course__teacher-thumb mr-15">
                       <img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                    </div>
                    <h6><?php  echo wp_kses_post($instructor_link) ?></h6>
                 </div>
                  <?php endif; ?>
               </div>
               <div class="course__more course__more-2 d-flex justify-content-between align-items-center">
                  <div class="course__status">
                 <?php if($course->is_free()): ?>
                 <span> <?php echo esc_html__('Free','epora'); ?> </span>
                 <?php else: ?>
                   <span class="blue"><?php echo esc_html($course->get_price_html()); ?> </span>
                   <?php if ( $course->get_origin_price() != $course->get_price() ) : ?>
                   <span class="old-price"><?php echo esc_html($course->get_origin_price_html()); ?></span>
                   <?php endif; ?>
                 <?php endif; ?>
                  </div>
                  <div class="course__btn">
                     <a href="<?php the_permalink(); ?>" class="link-btn">
                        <?php  echo esc_html__('Know Details','epora'); ?>
                        <i class="far fa-arrow-right"></i>
                        <i class="far fa-arrow-right"></i>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> 


