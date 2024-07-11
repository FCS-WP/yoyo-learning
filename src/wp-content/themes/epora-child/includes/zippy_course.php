<?php
add_shortcode('course_table', 'course_table_callback');


function course_table_callback()
{
  $post_per_page = 3;
  $args = array(
    'post_type'     => 'lp_course',
    'orderby'          => isset($_GET['orderby']) ? $_GET['orderby'] : 'title',
    'order'            =>  isset($_GET['order']) ? $_GET['order'] : 'asc',
    'posts_per_page' => $post_per_page,
    'paged' => (get_query_var('paged') ? get_query_var('paged') : 1),
  );
  $courses = new WP_Query($args);

  $max_num_pages = $courses->max_num_pages;

  $count = $courses->found_posts;
?>
  <div class="fees-container">
    <div class="row gx-5">
      <div class="col-lg-3 col-sm-12">
        <form action="https://sgcocoedu.com/fees-schedule" method="get" id="filter">
          <div class="fees-filter aos-init aos-animate" data-aos="fade-up">
            <h4>Categories</h4>
            <div class="form-group">
              <label class="control-label">Location</label>
              <div class="NiceSelect">
                <select name="location" id="location" style="display: none;">
                  <option value="">
                    Please Select </option>
                  <option value="39">Kovan</option>
                  <option value="37">Redhill</option>
                  <option value="71">Serangoon</option>
                  <option value="38">Zoom Online</option>
                </select>
                <div class="nice-select" tabindex="0"><span class="current">Serangoon</span>
                  <ul class="list">
                    <li data-value="" class="option">
                      Please Select </li>
                    <li data-value="39" class="option">Kovan</li>
                    <li data-value="37" class="option">Redhill</li>
                    <li data-value="71" class="option selected focus">Serangoon</li>
                    <li data-value="38" class="option">Zoom Online</li>
                  </ul>
                </div>

              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Semester</label>
              <div class="NiceSelect">
                <select name="semester" id="semester" style="display: none;">
                  <option value="">
                    Please Select </option>
                  <option value="79">Semester 1</option>
                  <option value="80">March Holiday</option>
                  <option value="81">Mid Year Holiday</option>
                  <option value="82">Semester 2</option>
                  <option value="83">September Holiday</option>
                  <option value="84">Year End Holiday</option>
                </select>
                <div class="nice-select" tabindex="0"><span class="current">Semester 1</span>
                  <ul class="list">
                    <li data-value="" class="option">
                      Please Select </li>
                    <li data-value="79" class="option selected">Semester 1</li>
                    <li data-value="80" class="option">March Holiday</li>
                    <li data-value="81" class="option">Mid Year Holiday</li>
                    <li data-value="82" class="option">Semester 2</li>
                    <li data-value="83" class="option">September Holiday</li>
                    <li data-value="84" class="option">Year End Holiday</li>
                  </ul>
                </div>

              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Level</label>
              <div class="NiceSelect">
                <select name="level" id="level" style="display: none;">
                  <option value="">
                    Please Select </option>
                  <option value="33">Primary 1</option>
                  <option value="34">Primary 2</option>
                  <option value="61">Primary 3</option>
                  <option value="62">Primary 4</option>
                  <option value="63">Primary 5</option>
                  <option value="64">Primary 6</option>
                  <option value="35">Secondary 1</option>
                  <option value="65">Secondary 2</option>
                  <option value="66">Secondary 3</option>
                  <option value="67">Secondary 4</option>
                  <option value="72">SMO Open</option>
                  <option value="36">Junior College 1</option>
                  <option value="68">Junior College 2</option>
                </select>
                <div class="nice-select" tabindex="0"><span class="current">
                    Please Select </span>
                  <ul class="list">
                    <li data-value="" class="option selected">
                      Please Select </li>
                    <li data-value="33" class="option">Primary 1</li>
                    <li data-value="34" class="option">Primary 2</li>
                    <li data-value="61" class="option">Primary 3</li>
                    <li data-value="62" class="option">Primary 4</li>
                    <li data-value="63" class="option">Primary 5</li>
                    <li data-value="64" class="option">Primary 6</li>
                    <li data-value="35" class="option">Secondary 1</li>
                    <li data-value="65" class="option">Secondary 2</li>
                    <li data-value="66" class="option">Secondary 3</li>
                    <li data-value="67" class="option">Secondary 4</li>
                    <li data-value="72" class="option">SMO Open</li>
                    <li data-value="36" class="option">Junior College 1</li>
                    <li data-value="68" class="option">Junior College 2</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Subject </label>
              <div class="NiceSelect">
                <select name="subject" id="subject" style="display: none;">
                  <option value="">
                    Please Select </option>
                  <option value="55">Mathematics</option>
                  <option value="56">Science</option>
                  <option value="57">English</option>
                  <option value="107">Math</option>
                </select>
                <div class="nice-select" tabindex="0"><span class="current">Science</span>
                  <ul class="list">
                    <li data-value="" class="option">
                      Please Select </li>
                    <li data-value="55" class="option">Mathematics</li>
                    <li data-value="56" class="option selected">Science</li>
                    <li data-value="57" class="option">English</li>
                    <li data-value="107" class="option">Math</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" id="submit">Apply Filter</button>
            </div>
            <div class="rest-password"><a href="https://sgcocoedu.com/fees-schedule/" id="reset">RESET FILTER</a></div>
          </div>
        </form>
      </div>
      <div class="col-lg-9 col-sm-12">
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
      </div>
    </div>
  </div>


  </div>
<?php
}
