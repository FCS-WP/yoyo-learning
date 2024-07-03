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
	?>

	   <div class="course__tab-inner bg-white solid-filter-area mb-50">
	      <div class="row align-items-center">
	         <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-4 col-sm-6">
	           <div class="course__view">
	              <h4><?php echo esc_html($index); ?> </h4>
	           </div>
	         </div>
	         <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-sm-6">
	            <div class="course__sort d-flex justify-content-sm-end">
	               <div class="course__sort-inner">
	               	  <?php get_template_part('learnpress/filter','category-dropdown'); ?>
	               	  <?php get_template_part('learnpress/filter','order'); ?>
	               </div>
	            </div>
	         </div>
	      </div>
	   </div>

		<div class="course-archive-list styel3">
			<div class="row" >
				<?php 
					if($query->have_posts()):
						while ($query->have_posts()) : $query->the_post();
							get_template_part( 'learnpress/content-course-archive', 'solid' ); 
						endwhile;
						wp_reset_postdata();
					endif;
		    	?> 
			</div>
			<div class="solid-pagination">
				<?php
					$GLOBALS['wp_query']->max_num_pages = $query->max_num_pages; 
					get_template_part( 'template-parts/blog/paginations/pagination', 'style1' );
				?>
			</div>
		</div>
<?php

	