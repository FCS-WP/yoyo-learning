<?php

add_shortcode('course_table', 'course_table_callback');


function course_table_callback()
{
  
?>
  <div class="fees-container">
    <div class="row gx-5">
      <div class="col-lg-3 col-sm-12">
        <?php echo do_shortcode("[filter_course]"); ?> 
      </div>
      <div class="col-lg-9 col-sm-12">
        <?php echo do_shortcode("[data_course_table]"); ?> 
      </div>
    </div>
  </div>
<?php
}
