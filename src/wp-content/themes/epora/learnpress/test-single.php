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


$course = LP_Global::course();
$sections = $course->get_sections();
$instructor = $course->get_instructor();
$course_preview_video = function_exists( 'get_field' ) ? get_field( 'course_preview_video' ) : NULL;
$course_language = function_exists( 'get_field' ) ? get_field( 'course_language' ) : 'English';
$user_designation = get_the_author_meta( 'user_designation',$instructor->get_id());
// $epora_user_designation = get_user_meta($instructor->get_id(), 'epora_user_designation', true);
// $preview_video            = epora_meta_option(get_the_id(), 'course_preview_video');
$hide_students_list = get_post_meta($course->get_id(), '_lp_hide_students_list', true);
$questions = $course->get_faqs();

$category = '';
$category = get_the_terms(get_the_id(), 'course_category');

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
            <h5 class="tp-c-details-title mb-20">About This Course</h5>
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
         <div class="cor-details-instructor mb-40">
            <h4 class="tp-c-details-title mb-40">Instructor</h4>
            <div class="course-instructor-details d-flex f-wrap align-items-center">
               <div class="course-avata mr-30 mb-20">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/course/c-details-ava-thumb-01.jpg" alt="avata-thumb">
               </div>
               <div class="course-avatar-details mb-20">
                  <h5 class="c-avata-title mb-10">Hossain Mahmud</h5>
                  <p>Award Winning Chemical & User Interface Design Training</p>
                  <div class="c-details-list mb-5">
                     <ul class="d-flex align-items-center">
                        <li>
                           <div class="rating-gold d-flex align-items-center">
                              <p>4.7</p>
                              <i class="fi fi-ss-star"></i>
                              <i class="fi fi-ss-star"></i>
                              <i class="fi fi-ss-star"></i>
                              <i class="fi fi-ss-star"></i>
                              <i class="fi fi-rs-star"></i>
                              <span>(125)</span>
                           </div>
                        </li>
                        <li><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-details-01.png" alt="meta-icon"><span>35 Classes</span></li>
                     </ul>
                  </div>
                  <div class="c-details-stu">
                     <ul>
                        <li class="d-flex align-items-center"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-details-02.png" alt="meta-icon"> <span>2,35,687 Students</span></li>
                     </ul>
                  </div>
               </div>
            </div>
            <p>Synergistically foster 24/7 leadership rather than scalable platforms. Conveniently visualize installed base products before interactive results. Collaboratively restore corporate experiences and open-source applications. Proactively mesh cooperative growth strategies.</p>
         </div>
         <div class="c-details-review pb-15">
            <div class="c-review-title-wrapper">
               <h5 class="c-review-title mb-40">Review</h5>
            </div>
            <div class="course-reviewer-item-wrapper">
               <div class="course-reviewer-item d-flex mb-25">
                  <div class="course-review-ava">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-details-avata-01.png" alt="details-avata">
                  </div>
                  <div class="course-review-content p-relative">
                     <h5 class="course-ava-title mb-15">Brooklyn Simmons</h5>
                     <div class="tpcourse__rating-icon d-flex align-items-center mb-10">
                        <i class="fi fi-ss-star"></i>
                        <i class="fi fi-ss-star"></i>
                        <i class="fi fi-ss-star"></i>
                        <i class="fi fi-ss-star"></i>
                        <i class="fi fi-rs-star"></i>
                     </div>
                     <p>Synergistically foster 24/7 leadership rather than scalable platforms. Conveniently visualize installed base products before interactive results. Collaboratively restore corporate experiences and open-source applications.</p>
                     <div class="c-reviewer-time">
                        <span>a week ago</span>
                     </div>
                  </div>
               </div>
               <div class="course-reviewer-item-wrapper mb-25">
                  <div class="course-reviewer-item d-flex">
                     <div class="course-review-ava">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-details-avata-02.png" alt="details-avata">
                     </div>
                     <div class="course-review-content p-relative">
                        <h5 class="course-ava-title mb-15">Leslie Alexander</h5>
                        <div class="tpcourse__rating-icon d-flex align-items-center mb-10">
                           <i class="fi fi-ss-star"></i>
                           <i class="fi fi-ss-star"></i>
                           <i class="fi fi-ss-star"></i>
                           <i class="fi fi-ss-star"></i>
                           <i class="fi fi-rs-star"></i>
                        </div>
                        <p>Synergistically foster 24/7 leadership rather than scalable platforms. Conveniently visualize installed base products before interactive results. Collaboratively restore corporate experiences and open-source applications.</p>
                        <div class="c-reviewer-time">
                           <span>a week ago</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="course-reviewer-item-wrapper mb-25">
                  <div class="course-reviewer-item d-flex">
                     <div class="course-review-ava">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/c-details-avata-03.png" alt="details-avata">
                     </div>
                     <div class="course-review-content p-relative">
                        <h5 class="course-ava-title mb-15">Dianne Russell</h5>
                        <div class="tpcourse__rating-icon d-flex align-items-center mb-10">
                           <i class="fi fi-ss-star"></i>
                           <i class="fi fi-ss-star"></i>
                           <i class="fi fi-ss-star"></i>
                           <i class="fi fi-ss-star"></i>
                           <i class="fi fi-rs-star"></i>
                        </div>
                        <p>Synergistically foster 24/7 leadership rather than scalable platforms. Conveniently visualize installed base products before interactive results. Collaboratively restore corporate experiences and open-source applications.</p>
                        <div class="c-reviewer-time">
                           <span>a week ago</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-4 col-md-12">
      <div class="c-details-sidebar">
         <div class="c-video-thumb p-relative mb-25">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg/c-details-video-bg.jpg" alt="video-bg">
            <div class="c-video-icon">
               <a class="popup-video" href="https://youtu.be/W-bgMEvrd2E"><i class="fi fi-sr-play"></i></a>
            </div>
         </div>
         <div class="course-details-widget">
            <div class="cd-video-price">
               <h3 class="pricing-video text-center mb-15">$29.99</h3>
               <div class="cd-pricing-btn text-center mb-30">
                  <a class="tp-vp-btn" href="https://weblearnbd.net/wp/epora/course-details/">Add To Cart</a>
                  <a class="tp-vp-btn-green" href="https://weblearnbd.net/wp/epora/course-details/">Enroll Now</a>
               </div>
            </div>
            <div class="cd-information mb-35">
               <ul>
                  <li><i class="fa-light fa-calendars"></i> <label>Lesson</label> <span>36</span></li>
                  <li><i class="fi fi-rr-chart-pie-alt"></i> <label>Quizess</label> <span>6</span></li>
                  <li><i class="fi fi-rr-user"></i> <label>Students</label> <span>105</span></li>
                  <li><i class="fa-light fa-clock-desk"></i> <label>Duration</label> <span>16 Hours</span></li>
                  <li><i class="fi fi-sr-stats"></i> <label>Skill Level</label> <span>Beginner</span></li>
                  <li><i class="fi fi-rr-comments"></i> <label>Language</label> <span>English</span></li>
                  <li><i class="fi fi-rs-diploma"></i> <label>Certificate</label> <span>Yes</span></li>
               </ul>
            </div>
            <div class="c-details-social">
               <h5 class="cd-social-title mb-25">Share Now:</h5>
               <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
               <a href="#"><i class="fa-brands fa-twitter"></i></a>
               <a href="#"><i class="fa-brands fa-instagram"></i></a>
               <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
         </div>
      </div>
   </div>
</div>



<div class="row d-none">
  <div class="col-xxl-8 col-xl-8 col-lg-8">
     <div class="course__wrapper">
        <div class="course__meta-2 d-sm-flex mb-25">
           <div class="course__teacher-3 d-flex align-items-center mr-70 mb-30">
              <div class="course__teacher-thumb-3 mr-15">
                 <?php echo epora_kses($instructor->get_profile_picture()); ?>
              </div>
              <div class="course__teacher-info-3">
              	<?php if ( !empty($user_designation) ) : ?>
                 <h5><?php echo esc_html($user_designation); ?></h5>
             	<?php endif; ?>

                 <p><a href="#"><?php echo esc_html($instructor->get_display_name()); ?></a></p>
              </div>
           </div>
           <div class="course__update mr-80 mb-30">
              <h5><?php echo esc_html__('Last Update:','epora'); ?></h5>
              <p><?php the_time( get_option('date_format',$course->get_id()) ); ?></p>
           </div>
           <div class="course__rating-2 mb-30">
              <h5><?php echo esc_html__('Review:','epora'); ?></h5>


              <?php 
              if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
              $total_rating = 5;
              $reviews = leanr_press_get_ratings_result( get_the_ID() ); 
              $taken_rating = !empty($reviews['rated']) ? $reviews['rated'] : 0;
              $blank_rating = $total_rating - $taken_rating;
              ?>
              <div class="course__rating-inner d-flex align-items-center">
                 	<?php 
                    for ($i=0; $i < intval($taken_rating); $i++) { ?>
                        <i class="icon_star"></i>
                    <?php } ?>
                    <?php for ($j=0; $j < intval($blank_rating); $j++) { ?>
                        <i class="icon_star_alt"></i>
                    <?php } ?>
                 <p>(<?php echo esc_html($taken_rating); ?>)</p>
              </div>
              <?php endif; ?>
           </div>
        </div>
		<div class="course-sort-info mb-30">
			<p class="course-intro"><?php echo wp_kses_post(get_the_excerpt()); ?></p>
		</div>
        <div class="course__img w-img mb-30">
           <?php echo wp_kses_post($course->get_image()); ?>
        </div>

        <div class="course__tab-2 mb-45">
            <div id="learn-press-course" class="course-summary learn-press">            
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
  </div>
  <div class="col-xxl-4 col-xl-4 col-lg-4">
     <div class="course__sidebar pl-70 p-relative">
        <div class="course__shape">
           <img class="course-dot" src="<?php print get_template_directory_uri(); ?>/assets/img/course/course-dot.png" alt="image">
        </div>
        <div class="course__sidebar-widget-2 white-bg mb-20">
           <div class="course__video">
              <div class="course__video-thumb w-img mb-25">
                 <?php echo wp_kses_post($course->get_image()); ?>
                 <?php if ( !empty($course_preview_video) ) : ?>
                 <div class="course__video-play"> 
                    <a href="<?php echo esc_url($course_preview_video); ?>" data-fancybox="" class="play-btn"> <i class="fas fa-play"></i> </a>
                 </div>
                 <?php endif; ?>
              </div>
              <div class="course__video-meta mb-25 d-flex align-items-center justify-content-between">
                 <div class="course__video-price">
	                 <?php if($course->is_free()): ?>
	                 <h5> <?php echo esc_html__('Free','epora'); ?> </h5>
	                 <?php else: ?>
	                   <h5><?php echo esc_html($course->get_price_html()); ?> </h5>
	                   <?php if ( $course->get_origin_price() != $course->get_price() ) : ?>
	                   <h5 class="old-price"><?php echo esc_html($course->get_origin_price_html()); ?></h5>
	                   <?php endif; ?>
	                 <?php endif; ?>
                 </div>
                 <div class="course__video-discount">
                    <span> - 68% OFF</span>
                 </div>
              </div>
              <div class="course__video-content mb-35">
                 <ul>
                    <li class="d-flex align-items-center">
                       <div class="course__video-icon">
                          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                             <path class="st0" d="M2,6l6-4.7L14,6v7.3c0,0.7-0.6,1.3-1.3,1.3H3.3c-0.7,0-1.3-0.6-1.3-1.3V6z"/>
                             <polyline class="st0" points="6,14.7 6,8 10,8 10,14.7 "/>
                          </svg>
                       </div>
                       <div class="course__video-info">
                          <h5><span><?php echo esc_html__('Instructor :','epora'); ?></span> <?php echo esc_html($instructor->get_display_name()); ?></h5>
                       </div>
                    </li>
                    <li class="d-flex align-items-center">
                       <div class="course__video-icon">
                          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
                             
                             <path class="st0" d="M4,19.5C4,18.1,5.1,17,6.5,17H20"/>
                             <path class="st0" d="M6.5,2H20v20H6.5C5.1,22,4,20.9,4,19.5v-15C4,3.1,5.1,2,6.5,2z"/>
                          </svg>
                       </div>
                       <div class="course__video-info">
                          <h5><span><?php echo esc_html__('Lectures :','epora'); ?> </span><?php echo esc_html($course->count_items()); ?></h5>
                       </div>
                    </li>
                    <li class="d-flex align-items-center">
                       <div class="course__video-icon">
                          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                             <circle class="st0" cx="8" cy="8" r="6.7"/>
                             <polyline class="st0" points="8,4 8,8 10.7,9.3 "/>
                          </svg>
                       </div>
                       <div class="course__video-info">
                          <h5><span><?php echo esc_html__('Duration :','epora'); ?> </span><?php echo learn_press_get_post_translated_duration( get_the_id()); ?></h5>
                       </div>
                    </li>
                    <li class="d-flex align-items-center">
                       <div class="course__video-icon">
                          <svg>
                             <path class="st0" d="M13.3,14v-1.3c0-1.5-1.2-2.7-2.7-2.7H5.3c-1.5,0-2.7,1.2-2.7,2.7V14"/>
                             <circle class="st0" cx="8" cy="4.7" r="2.7"/>
                          </svg>
                       </div>
                       <div class="course__video-info">
                          <h5><span><?php echo esc_html__('Enrolled :','epora'); ?> </span>
                          	<?php $student = _n('%s  student', '%s students', $course->get_users_enrolled(), 'epora');
							echo sprintf($student, $course->get_users_enrolled());
							?></h5>
                       </div>
                    </li>

                    <?php if ( !empty($course_language) ) : ?>
                    <li class="d-flex align-items-center">
                       <div class="course__video-icon">
                          <svg>
                             <circle class="st0" cx="8" cy="8" r="6.7"/>
                             <line class="st0" x1="1.3" y1="8" x2="14.7" y2="8"/>
                             <path class="st0" d="M8,1.3c1.7,1.8,2.6,4.2,2.7,6.7c-0.1,2.5-1,4.8-2.7,6.7C6.3,12.8,5.4,10.5,5.3,8C5.4,5.5,6.3,3.2,8,1.3z"/>
                          </svg>
                       </div>
                       <div class="course__video-info">
                          <h5><span><?php echo esc_html__('Language:','epora'); ?>  :</span><?php echo esc_html($course_language); ?></h5>
                       </div>
                    </li>
                	<?php endif; ?>
                 </ul>
              </div>
              <div class="course__payment mb-35">
                 <h3><?php echo esc_html__('Payment :','epora'); ?> </h3>
                 <a href="#">
                    <img src="<?php print get_template_directory_uri(); ?>/assets/img/course/payment/payment-1.png" alt="image">
                 </a>
              </div>
              <div class="course__enroll-btn">
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
        </div>
        <div class="course__sidebar-widget-2 white-bg mb-20">
           <?php get_template_part('learnpress/single/related-course'); ?>
        </div>
     </div>
  </div>
</div>