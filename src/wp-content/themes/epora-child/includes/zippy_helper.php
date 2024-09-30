<?php
function slugify($string)
{
  // Convert the string to lowercase
  $string = strtolower($string);

  // Replace spaces and special characters with dashes
  $string = preg_replace('/[^a-z0-9]+/', '_', $string);

  // Remove leading and trailing dashes
  $string = trim($string, '_');

  return $string;
}

function pr($data)
{
  echo '<style>
  #debug_wrapper {
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: 999;
    background: #fff;
    color: #000;
    overflow: auto;
    width: 100%;
    height: 100%;
  }</style>';
  echo '<div id="debug_wrapper"><pre>';

  print_r($data); // or var_dump($data);
  echo "</pre></div>";
  die;
}

function pagination_post_author($max_num_pages = 0, $count, $post_per_page)

{

  if ($max_num_pages <= 1)
    return;

  $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;

  $start = ($paged - 1) * $post_per_page + 1;
  $end = min($paged * $post_per_page, $count);
  $display_string = sprintf('Showing %d to %d of %d entries', $start, $end, $count);
  if ($count === 0) {
    $display_string = "No entries found";
  } elseif ($start > $end) {
    // Handle cases where $start is greater than $end (shouldn't happen with correct calculations)
    $display_string = "Invalid page range";
  }
  if ($paged >= 1)
    $links[] = $paged;

  if ($paged >= 3) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
  }

  if (($paged + 2) <= $max_num_pages) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
  }
?>
  <div class="row">
    <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-start">
      <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite"><?php echo $display_string; ?></div>
    </div>
    <div class="col-sm-12 col-md-8">
      <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
        <ul class="pagination">
          <?php if (get_previous_posts_link()) : ?>
            <li class="paginate_button page-item previous" id="dataTable_previous">
              <a href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>" class="page-link">Previous</a>
            </li>
          <?php endif; ?>
          <?php if (!in_array(1, $links)) : ?>

            <?php $class = 1 == $paged ? 'paginate_button page-item active' : 'paginate_button page-item'; ?>
            <li class="<?php echo $class; ?>">
              <a href="<?php echo esc_url(get_pagenum_link(1)) ?>" class="page-link">1</a>
            </li>
            <li class="paginate_button page-item disabled" id="dataTable_ellipsis"><a aria-controls="dataTable" aria-disabled="true" role="link" data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a></li>
          <?php endif; ?>

          <?php

          sort($links);
          foreach ((array) $links as $link) {
            $class = $paged == $link ? 'paginate_button page-item active' : 'paginate_button page-item';
            printf('<li class="%s"><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
          }
          ?>
          <?php
          if (!in_array($max_num_pages, $links)) : ?>
            <li class="paginate_button page-item disabled"><a class="page-link">…</a>
            </li>
          <?php
            if (!in_array($max_num_pages - 1, $links))
              $class = $paged == $max_num_pages ? 'paginate_button page-item' : 'paginate_button page-item';
            printf('<li class="%s"><a class="page-link" href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max_num_pages)), $max_num_pages);

          endif; ?>
          <?php if ($paged < $max_num_pages) : ?>
            <li class="paginate_button page-item next" id="dataTable_next">
              <a href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>" class="page-link">Next</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>

<?php
}


//Get taxonomy course 
function get_taxonomy_terms_via_db($att) {
  global $wpdb;
  $taxonomy = $att;
  $term_query = new WP_Term_Query(array(
    'taxonomy' => $taxonomy,
    'orderby'                => 'name',
    'order'                  => 'ASC',
    'child_of'               => 0,
    'parent' => 0,
    'fields'                 => 'all',
    'hide_empty'             => false,
  ));
  
  $terms = $term_query->terms;
  
  if (!empty($terms)) {
    return $terms;
  }
}

//Display name taxonomy by prdocut posttype lp_course
function display_taxonomy_by_post_id($post_id, $taxonomy) {
  $terms = get_the_terms($post_id, $taxonomy);
  if (!empty($terms)) {
    $term = $terms[0];
    echo '<span>' . esc_html($term->name) . '</span>';
  } else {
    echo 'N/A';
  }
}

//function get quiz by id course
function get_quiz_by_id_course($input_id_course){
  global $wpdb;

  $course_ids = array($input_id_course); 

  $placeholders = implode(',', array_fill(0, count($course_ids), '%d'));
  
  $query = $wpdb->prepare(
     "SELECT section_id 
     FROM fcs_data_learnpress_sections 
     WHERE section_course_id IN ($placeholders)",
     $course_ids
  );

  $section_ids = $wpdb->get_col($query);

  foreach($section_ids as $key => $items){

     $placeholders_section = implode(',', array_fill(0, count($section_ids), '%d'));;
     $query = $wpdb->prepare(
        "SELECT item_id 
        FROM fcs_data_learnpress_section_items 
        WHERE section_id IN ($placeholders_section)
        AND item_type = %s",
        array_merge($section_ids, array('lp_quiz'))

     );

     $item_ids = $wpdb->get_col($query);
  }

  foreach($item_ids as $key => $items){
     $post = get_post($items);
     $quiz_post[] = $post; 
  }
  
  return $quiz_post;

}
