<?php 

    $related_course = epora_related_posts_by_tags(); 
   
    if(!is_array($related_course)){
  
        return;
    } 
 ?>

<div class="course__sidebar-course ">
      <h3 class="course__sidebar-title"><?php echo esc_html__('Related courses','epora'); ?></h3>
      <ul>
        <?php foreach($related_course as $item): ?>
        <?php 
             $course = LP_Course::get_course( $item->ID ); 
             $currency = learn_press_get_currency_symbol( );
        ?>
         <li>
            <div class="course__sm d-flex align-items-center mb-30">
               <div class="course__sm-thumb mr-20">
                <a href="<?php echo esc_url( get_the_permalink($item->ID)); ?>">
                     <?php echo get_the_post_thumbnail($item->ID,'epora-small'); ?>
               </a>
               </div>
               <div class="course__sm-content">
                  <div class="course__sm-rating">
                      <?php 
                      if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
                      $total_rating = 5;
                      $reviews = leanr_press_get_ratings_result( get_the_ID() ); 
                      $taken_rating = !empty($reviews['rated']) ? $reviews['rated'] : 0;
                      $blank_rating = $total_rating - $taken_rating;
                      ?>
                      <ul>
                            <?php 
                            for ($i=0; $i < intval($taken_rating); $i++) { ?>
                                <li><a href="#"><i class="icon_star"></i></a></li>
                            <?php } ?>
                            <?php for ($j=0; $j < intval($blank_rating); $j++) { ?>
                                <li><a href="#"><i class="icon_star_alt"></i></a></li>
                            <?php } ?>
                      </ul>
                      <?php endif; ?>
                  </div>
                  <h5><a href="<?php echo esc_url( get_the_permalink($item->ID)); ?>"><?php echo get_the_title($item->ID); ?></a></h5>
                  <div class="course__sm-price">
                      <?php if($course->is_free()): ?>
                      <span> <?php echo esc_html__('Free','epora'); ?> </span>
                      <?php else: ?>
                        <span class="blue"><?php echo esc_html($course->get_price_html()); ?> </span>
                        <?php if ( $course->get_origin_price() != $course->get_price() ) : ?>
                        <span class="old-price"><?php echo esc_html($course->get_origin_price_html()); ?></span>
                        <?php endif; ?>
                      <?php endif; ?>
                  </div>
               </div>
            </div>
         </li>
         <?php endforeach; ?>
      </ul>
</div>