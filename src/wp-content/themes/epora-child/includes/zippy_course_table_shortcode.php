<?php
add_shortcode('data_course_table', 'data_course_table_callback');

function data_course_table_callback(){
    $post_per_page = 12;
    $lp_year = isset($_GET['lp_year']) ? $_GET['lp_year'] : '';
    $lp_grade = isset($_GET['lp_grade']) ? $_GET['lp_grade'] : '';
    $lp_subject = isset($_GET['lp_subject']) ? $_GET['lp_subject'] : '';
    $array_filter = array(
        'relation' => 'AND',
        
    );

    if(!empty($lp_year)){
      if($lp_year != "all"){
        $array_filter[] = array(
          'taxonomy' => 'lp_year', 
          'field'    => 'slug',
          'terms'    =>  $lp_year,
        );
      }
    }
    if(!empty($lp_grade)){
      if($lp_grade != "all"){
        $array_filter[] = array(
            'taxonomy' => 'lp_grade', 
            'field'    => 'slug',
            'terms'    =>  $lp_grade,
        );
      }
    }
    if(!empty($lp_subject)){
      if($lp_subject != "all"){
        $array_filter[] = array(
            'taxonomy' => 'lp_subject', 
            'field'    => 'slug',
            'terms'    =>  $lp_subject,
        );
      }
    }
    
    $args = array(
        'post_type'     => 'lp_course',
        'orderby'          => isset($_GET['orderby']) ? $_GET['orderby'] : 'title',
        'order'            =>  isset($_GET['order']) ? $_GET['order'] : 'asc',
        'posts_per_page' => $post_per_page,
        'paged' => (get_query_var('paged') ? get_query_var('paged') : 1),
        'tax_query'     => $array_filter,
        
    );

    $courses = new WP_Query($args);

    $max_num_pages = $courses->max_num_pages;

    $count = $courses->found_posts;
?>
    <div class="fees-dataTable table-responsive aos-init aos-animate" data-aos="fade-up">
          <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_length" id="dataTable_length">
                  <label>Show <select name="dataTable_length" aria-controls="dataTable" class="form-select form-select-sm">
                      <option value="10">10</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                    </select> entries</label>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div>
              </div>
            </div>
            <div class="row dt-row">
              <div class="col-sm-12">
                <?php if (isset($courses) && !empty($courses)) : ?>
                  <table id="dataTable" class="table dataTable no-footer" aria-describedby="dataTable_info">
                    <thead>
                      <tr>
                      <th class="sorting disable-sorting<?php if ($_GET['orderby'] == 'lp_subject' && $_GET['order'] == 'asc') echo 'sorting_asc'; ?>" data-col="lp_subject">Subject</th>
                        <th class="sorting disable-sorting<?php if ($_GET['orderby'] == 'lp_grade' && $_GET['order'] == 'asc') echo 'sorting_asc'; ?>" data-col="lp_grade">Grade</th>  
                        <th class="sorting disable-sorting">Day</th>
                        <th class="sorting disable-sorting">Time</th>
                        <th class="sorting disable-sorting<?php if ($_GET['orderby'] == 'lp_year' && $_GET['order'] == 'asc') echo 'sorting_asc'; ?>"  data-col="lp_year">Year</th>
                        <th class="sorting disable-sorting" style="text-align:center">Maximuni No of  students</th>
                        <th class="sorting disable-sorting" style="text-align:center">Fees</th>            
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while ($courses->have_posts()) :  $courses->the_post(); ?>
                        <?php

                        $id_course = get_the_id();
                        $price = get_post_meta($id_course, '_lp_regular_price', true);
                        $max_student = get_post_meta($id_course, '_lp_max_students', true);
                        $start_time_course = get_post_meta($id_course, 'lp_time_start_field_key', true);
                        $end_time_course = get_post_meta($id_course, 'lp_time_end_field_key', true);
                        $day_course = get_post_meta($id_course, 'lp_day_course_field_key', true);
                        $link_course = get_permalink($id_course);
                        ?>
                          <tr class="odd">
                            <td style="white-space: nowrap;"><?php echo display_taxonomy_by_post_id($id_course, 'lp_subject') ?></td>
                            <td style="white-space: nowrap;"><?php echo display_taxonomy_by_post_id($id_course, 'lp_grade') ?></td>
                            <td style="white-space: nowrap;"><?php echo $day_course  ?></td>
                            <td style="white-space: nowrap;"><?php echo $start_time_course . ' - ' . $end_time_course ?></td>
                            <td style="white-space: nowrap;"><?php echo display_taxonomy_by_post_id($id_course, 'lp_year') ?></td>
                            <td style="white-space: nowrap;text-align:center"><?php echo $max_student ?></td>
                            <td style="white-space: nowrap;text-align:center">$<?php if($price != NULL){echo $price;}else{echo '0';} ?></td>
                          </tr>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                <?php endif; ?>
              </div>
            </div>
            <?php pagination_post_author($max_num_pages, $count, $post_per_page); ?>

          </div>
        </div>
<?php   } ?>