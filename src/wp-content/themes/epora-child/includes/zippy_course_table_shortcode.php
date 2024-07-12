<?php
add_shortcode('data_course_table', 'data_course_table_callback');

function data_course_table_callback(){
    $post_per_page = 3;
    $lp_year = isset($_GET['lp_year']) ? $_GET['lp_year'] : '';
    $lp_level = isset($_GET['lp_level']) ? $_GET['lp_level'] : '';
    $lp_subject = isset($_GET['lp_subject']) ? $_GET['lp_subject'] : '';
    $array_filter = array(
        'relation' => 'AND',
    );

    if(!empty($lp_year)){
        $array_filter[] = array(
            'taxonomy' => 'lp_year', 
            'field'    => 'slug',
            'terms'    =>  $lp_year,
        );
    }
    if(!empty($lp_level)){
        $array_filter[] = array(
            'taxonomy' => 'lp_level', 
            'field'    => 'slug',
            'terms'    =>  $lp_level,
        );
    }
    if(!empty($lp_subject)){
        $array_filter[] = array(
            'taxonomy' => 'lp_subject', 
            'field'    => 'slug',
            'terms'    =>  $lp_subject,
        );
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
                        <th class="sorting <?php if ($_GET['orderby'] == 'title' && $_GET['order'] == 'asc') echo 'sorting_asc'; ?>" data-col="title">Course</th>
                        <th class="sorting">Day</th>
                        <th class="sorting">Time</th>
                        <th class="sorting">Sessions</th>
                        <th class="sorting">From</th>
                        <th class="sorting">To</th>
                        <th class="sorting">Fees</th>
                        <th class="sorting">Venue</th>
                        <th class="sorting">No Lesson</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while ($courses->have_posts()) :  $courses->the_post(); ?>
                        <?php

                        $id_course = get_the_id();
                        $price = get_post_meta($id_course, '_lp_regular_price', true);
                        ?>
                        <tr class="odd">
                          <td class="sorting_1"><?php echo get_the_title(); ?></td>
                          <td>Sunday</td>
                          <td>11:00am - 12:45pm</td>
                          <td>18</td>
                          <td>24-Jun-24</td>
                          <td>3-Nov-24</td>
                          <td><?php echo $price; ?></td>
                          <td>Redhill </td>
                          <td>1-Sep-24</td>
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