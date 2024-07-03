<?php

	/**
	 * Prevent loading this file directly
	 */
   defined( 'ABSPATH' ) || exit();
	$course_order_by = 'DESC';



   $paged    = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
   $args = array( 
		'post_type' => LP_COURSE_CPT,
		'orderby' => 'modified',
		'order' => $course_order_by,
		'posts_per_page' => LP()->settings->get('learn_press_archive_course_limit') ,
		'paged' => $paged 
	);

	$args = apply_filters('epora_archive_post_args',$args);

	$query = new WP_Query($args);
	
	$total = $query->found_posts;
	if ( $total == 0 ) {
		$message = '<p class="message message-error">' . esc_html__( 'No courses found!', 'epora' ) . '</p>';
		$index   = esc_html__( 'There are no available courses!', 'epora' );
	} elseif ( $total == 1 ) {
		$index = esc_html__( 'Showing only one result', 'epora' );
	} else {
		$courses_per_page = absint( LP()->settings->get( 'archive_course_limit' ) );
		
		$from = 1 + ( $paged - 1 ) * $courses_per_page;
		$to   = ( $paged * $courses_per_page > $total ) ? $total : $paged * $courses_per_page;

		if ( $from == $to ) {
			$index = sprintf(
				esc_html__( 'Showing last course of %s results', 'epora' ),
				$total
			);
		} else {
			$index = sprintf(
				esc_html__( 'Showing %s-%s of %s results', 'epora' ),
				$from,
				$to,
				$total
			);
		}
	}


	$course_search_switch = get_theme_mod( 'course_search_switch', true );
	$course_latest_post_switch = get_theme_mod( 'course_latest_post_switch', true );
	$course_category_switch = get_theme_mod( 'course_category_switch', true );
	$course_skill_switch = get_theme_mod( 'course_skill_switch', true );
	
	?>


   <div class="row mb-20">
      <div class="col-xl-4 col-lg-4 col-md-12 courser-list-widths mb-60"> 
         <div class="course-sidebar">

            <?php if(!empty($course_search_switch)): ?>
            <div class="course-sidebar__widget mb-50">
               <?php get_template_part( 'learnpress/search', 'form' ); ?>
            </div>
            <?php endif; ?>

            <?php if(!empty($course_category_switch)): ?>
            <div class="course-sidebar__widget mb-50">
               <div class="course__sidebar-info">
                  <h3 class="course-sidebar__title mb-35"><?php echo esc_html__('All categories', 'epora'); ?></h3>
                  <?php get_template_part('learnpress/filter','category'); ?>
               </div>
            </div>
            <?php endif; ?>

            <?php if(!empty($course_latest_post_switch)): ?>
            <div class="course-sidebar__widget mb-50">
               <div class="course__sidebar-info">
                  <h3 class="course-sidebar__title mb-35"><?php echo esc_html__('Skill level', 'epora'); ?></h3>
                  <?php get_template_part('learnpress/filter','skill'); ?>
               </div>
            </div>
            <?php endif; ?>

            <?php if(!empty($course_skill_switch)): ?>
            <div class="course-sidebar__widget mb-50">
               <div class="course__sidebar-course">
                  <h3 class="course-sidebar__title mb-35"><?php echo esc_html__('Latest posts','epora'); ?></h3>
                  <?php get_template_part('learnpress/latest','post'); ?>
               </div>
            </div>
            <?php endif; ?>
         </div>
      </div>
      <div class="col-xl-8 col-lg-8 col-md-12 course-item-widths">
         <div class="course-main-box pl-30">
            <div class="tp-course-filder mb-20">
               <div class="row">
                  <div class="col-lg-7 col-md-6">
                     <div class="d-flex align-items-center">
                        <div class="tp-grid-list">
                           <nav>
                             <div class="nav nav-tabss" id="nav-tab" role="tablist">
                               <button class="tab-nav-link active" id="nav-grid-tab" data-bs-toggle="tab" data-bs-target="#nav-grid" type="button" role="tab" aria-controls="nav-grid" aria-selected="true"><i class="fal fa-border-all"></i></button>
                               <button class="tab-nav-link" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="false"><i class="fal fa-list-ul"></i></button>
                             </div>
                           </nav>
                        </div>
                        <div class="tp-course-count">
                           <p><?php echo esc_html($index); ?></p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-6 d-flex justify-content-md-end">
                     <div class="tp-course-filter tp-course-filter-adv">
                        <?php get_template_part('learnpress/filter','order'); ?>
                     </div>
                  </div>
               </div>
            </div>  
            <div class="tp-course-tab-content">
               <div class="tab-content" id="nav-tabContent">
                 <div class="tab-pane fade show active" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab">
                    <div class="row">
                        <?php 
                           if($query->have_posts()):
                              while ($query->have_posts()) : $query->the_post();
                                 get_template_part( 'learnpress/content-course', 'advance' ); 
                              endwhile;
                              wp_reset_postdata();
                           endif;
                        ?> 
                    </div>
                 </div>
                 <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                     <?php 
                        if($query->have_posts()):
                           while ($query->have_posts()) : $query->the_post();
                              get_template_part( 'learnpress/content-course-list', 'advance' ); 
                           endwhile;
                           wp_reset_postdata();
                        endif;
                     ?> 
                 </div>
               </div>
                <div class="row">
                  <div class="col-xxl-12">
                     <?php
                        $GLOBALS['wp_query']->max_num_pages = $query->max_num_pages; 
                        get_template_part( 'template-parts/blog/paginations/pagination', 'style1' );
                     ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


	<?php

	