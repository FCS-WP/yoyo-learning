<?php

    defined( 'ABSPATH' ) || exit();

    $course          = LP_Global::course();
    $instructor      = $course->get_instructor();
    $user_designation = get_the_author_meta( 'user_designation',$instructor->get_id());
    $instructor_link = $course->get_instructor_html();
    $instructor_id   = $course->get_id();

?>

   <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
      <div class="course__item course__item-2 white-bg mb-30 transition-3">
         <div class="course__thumb fix w-img">
            <a href="<?php the_permalink(); ?>">
              <img src="<?php echo  esc_url(get_the_post_thumbnail_url()); ?>" alt="img">
           </a>
         </div>
         <div class="course__content-2">
            <h3 class="course__title-2"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></h3>
            <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), 13, ''); ?></p>
            <div class="course__bottom d-sm-flex justify-content-between align-items-center">
               <?php 
                   $dir = learn_press_user_profile_picture_upload_dir();
                   $user = get_user_by( 'id', $instructor->get_id());
                   $pro_link = get_user_meta($user->ID,'_lp_profile_picture',true); 
                   $base_url = isset($dir['baseurl'])?$dir['baseurl']:'';
                   $profile_link =  $base_url.'/'.$pro_link;
               ?> 

               <?php if($pro_link !='') : ?>                 
             <div class="course__teacher-2 d-flex align-items-center">
                <div class="course__teacher-thumb-2 mr-20">
                   <img src="<?php echo esc_url($profile_link); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                   <div class="course__teacher-rating">
                      <i class="icon_star"></i>
                   </div>
                </div>
                <div class="course__teacher-info">
                   <h6>
                       <?php  echo wp_kses_post($instructor_link); ?>
                   </h6>
                   
                     <?php if ( !empty($user_designation) ) : ?>
                       <span><?php echo esc_html($user_designation); ?></span>
                      <?php endif; ?>
                   
                </div>
             </div>
             <?php else: ?>
             <div class="course__teacher-2 d-flex align-items-center">
                <div class="course__teacher-thumb-2 mr-20">
                   <img src="<?php echo esc_url( get_avatar_url( $instructor->get_id() ) ); ?>" alt="<?php  echo  esc_attr($user->display_name); ?>">
                   <div class="course__teacher-rating">
                      <i class="icon_star"></i>
                   </div>
                </div>
                <div class="course__teacher-info">
                   <h6>
                       <?php  echo wp_kses_post($instructor_link); ?>
                   </h6>
                   
                     <?php if ( !empty($user_designation) ) : ?>
                       <span><?php echo esc_html($user_designation); ?></span>
                      <?php endif; ?>
                   
                </div>
             </div>
             <?php endif; ?>

               <div class="course__meta">
                  <div class="course__lesson">
                     <span><i class="far fa-book-alt"></i>
                        <?php   
                           $lessons = $course->get_curriculum_items( 'lp_lesson' )? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0; 
                           echo esc_html($lessons). esc_html__(' lessons','epora'); 
                        ?>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

