<?php

/**
 * Template for displaying content of single course.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */


defined('ABSPATH') || exit();

if (post_password_required()) {
   echo get_the_password_form();

   return;
}

$quiz   = LP_Global::course_item_quiz();
$quiz   = LP_Global::course_item_quiz();

$course = LP_Global::course();
$sections = $course->get_sections();
$instructor = $course->get_instructor();
$video_image = function_exists( 'get_field' ) ? get_field( 'video_image' ) : NULL;
$video_url = function_exists( 'get_field' ) ? get_field( 'video_url' ) : '';
$course_language = function_exists( 'get_field' ) ? get_field( 'course_language' ) : 'English';
$user_designation = get_the_author_meta( 'user_designation',$instructor->get_id());
$hide_students_list = get_post_meta($course->get_id(), '_lp_hide_students_list', true);
$questions = $course->get_faqs();
$level = learn_press_get_post_level( get_the_ID() );


$category = '';
$category = get_the_terms(get_the_id(), 'course_category');

$quizzes  = $course->count_items( LP_QUIZ_CPT );

// echo '<pre>';
// print_r($quiz);

 // var_dump($course_language);

?>


<div class="row">
   <div class="col-lg-8 col-md-12">
      <div class="c-details-wrapper mr-25">
         <div class="c-details-thumb p-relative mb-40">
            <?php echo wp_kses_post($course->get_image()); ?>
            <div class="c-details-ava d-md-flex align-items-center">
               <?php echo epora_kses($instructor->get_profile_picture()); ?>
               <span><?php echo esc_html__('By','epora'); ?> <?php echo esc_html($instructor->get_display_name()); ?></span>
            </div>
         </div>
         <div class="course-details-content mb-45">
            <div class="tpcourse__category mb-15">
               <div class="tpcourse__price-list d-flex align-items-center">
                  <?php
                     if (is_array($category)) {
                        foreach ($category as $kl => $type) {
                           if ($kl >= 1) {
                              echo ' , ';
                           }
                           echo esc_html($type->name);
                        }
                     }
                  ?>
               </div>
            </div>
            <div class="tpcourse__ava-title mb-25">
               <h4 class="c-details-title"><?php the_title(); ?></h4>
            </div>
            <div class="tpcourse__meta course-details-list">
               <ul class="d-flex align-items-center">
                 <?php 
                 if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
                 $total_rating = 5;
                 $reviews = leanr_press_get_ratings_result( get_the_ID() ); 
                 $taken_rating = !empty($reviews['rated']) ? $reviews['rated'] : 0;
                 $blank_rating = $total_rating - $taken_rating;
                 ?>
                  <li>
                     <div class="rating-gold d-flex align-items-center">
                        <p><?php echo !empty($reviews['total']) ? $reviews['total'] : 0; ?></p>
                        <?php 
                       for ($i=0; $i < intval($taken_rating); $i++) { ?>
                           <i class="fi fi-ss-star"></i>
                       <?php } ?>
                       <?php for ($j=0; $j < intval($blank_rating); $j++) { ?>
                           <i class="fi fi-rs-star"></i>
                       <?php } ?>
                        <span>(<?php echo esc_html($taken_rating); ?>)</span>
                     </div>
                  </li>
                  <?php endif; ?>
                  <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-01.png" alt="meta-icon"> <span><?php   
                     $lessons = $course->get_curriculum_items( 'lp_lesson' )? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0; 
                     echo esc_html($lessons). esc_html__(' Lessons','epora'); 
                  ?></span></li>
                  <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-meta-02.png" alt="meta-icon"> <span><?php $student = _n('%s  Student', '%s Students', $course->get_users_enrolled(), 'epora');
                     echo sprintf($student, $course->get_users_enrolled());
                     ?></span></li>
               </ul>
            </div>
         </div>
         <div class="c-details-about mb-40">
             <div class="course-summary">
                 <?php
                 /**
                  * @since 3.0.0
                  *
                  * @see learn_press_single_course_summary()
                  */
                 do_action( 'learn-press/single-course-summary' );
                 ?>
             </div>  
         </div>
      </div>
   </div>
   <div class="col-lg-4 col-md-12">
      <div class="c-details-sidebar">
         <?php if(!empty($video_image['url'])) : ?>
         <div class="c-video-thumb p-relative mb-25">
            <img src="<?php echo esc_url($video_image['url']); ?>" alt="video-bg">
            <div class="c-video-icon">
               <a class="popup-video" href="<?php echo esc_url($video_url); ?>"><i class="fi fi-sr-play"></i></a>
            </div>
         </div>
         <?php endif; ?>
         <div class="course-details-widget">
            <div class="cd-video-price">
              <?php if($course->is_free()): ?>
              <h3 class="pricing-video text-center mb-15"> <?php echo esc_html__('Free','epora'); ?> </h3>
              <?php else: ?>
                <h3 class="pricing-video text-center mb-15"><?php echo esc_html($course->get_price_html()); ?> </h3>
                <?php if ( $course->get_origin_price() != $course->get_price() ) : ?>
                <h3 class="pricing-video text-center mb-15 old-price"><?php echo esc_html($course->get_origin_price_html()); ?></h3>
                <?php endif; ?>
              <?php endif; ?>


              <div class="cd-pricing-btn text-center mb-30">
               <div class="course-enroll">
                  <?php do_action( 'learn-press/before-course-buttons' ); ?>
                  <?php
                  /**
                   * @see learn_press_course_purchase_button - 10
                   * @see learn_press_course_enroll_button - 10
                   * @see learn_press_course_retake_button - 10
                   */
                  do_action( 'learn-press/course-buttons' );
                  ?>
                  <?php do_action( 'learn-press/after-course-buttons' ); ?>
               </div>
              </div>
            </div>
            <div class="cd-information mb-35">
               <ul>
                  <li><i class="fa-light fa-calendars"></i> <label><?php echo esc_html__('Lesson :','epora'); ?></label> <span><?php echo esc_html($course->count_items()); ?></span></li>
                  <li><i class="fi fi-rr-chart-pie-alt"></i> <label><?php echo esc_html__('Quizess :','epora'); ?></label> <span><?php echo esc_html($quizzes); ?></span></li>
                  <li><i class="fi fi-rr-user"></i> <label><?php echo esc_html__('Students :','epora'); ?></label> <span><?php $student = _n('%s  student', '%s students', $course->get_users_enrolled(), 'epora');
                     echo sprintf($student, $course->get_users_enrolled());
                     ?></span></li>
                  <li><i class="fa-light fa-clock-desk"></i> <label><?php echo esc_html__('Duration :','epora'); ?> </label> <span><?php echo learn_press_get_post_translated_duration( get_the_id()); ?></span></li>
                  <li><i class="fi fi-sr-stats"></i> <label><?php echo esc_html__('Skill Level :','epora'); ?></label> <span><?php echo esc_html($level); ?></span></li>

                  <?php if(!empty($course_language)) : ?>
                  <li><i class="fi fi-rr-comments"></i> <label><?php echo esc_html__('Language :','epora'); ?></label> <span><?php echo esc_html($course_language); ?></span></li>
                  <?php endif; ?>
               </ul>
            </div>
            <div class="c-details-social">
               <h5 class="cd-social-title mb-25"><?php echo esc_html__('Share Now :','epora'); ?> </h5>
                <a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>"><i class="fab fa-facebook-f"></i></a>
                <a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://twitter.com/home?status=<?php echo urlencode( get_the_title() ); ?>-<?php echo esc_url( get_permalink() ); ?>"><i class="fab fa-twitter"></i></a>
            
                <a onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url( get_permalink() ); ?>" target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
         </div>
      </div>
   </div>
</div>
