<?php

// override-templates
add_filter( 'learn-press/override-templates', function(){ return true; } );

// learnpress
function epora_course_cageory_by_id($post_id = null, $single = true)
{
   $terms = get_the_terms($post_id, 'course_category');
   $cat = '';
   $cat_with_link = '';

   if (is_array($terms)) :

      foreach ($terms as $tkey => $term) :

         $cat .= $term->slug . ' ';

         $cat_with_link .= sprintf("<a class='c-color-red' href='%s'>%s</a>", get_category_link($term->term_id), $term->name);

         if ($single) {
            break;
         }

         if ($tkey == 1) {
            break;
         }

      endforeach;

   endif;
   return $cat_with_link;
}

// epora_filter_archive
function epora_filter_archive($args)
{
   if (!function_exists('learn_press_is_course_archive')) {
      return $template;
   }
   // search
   if (isset($_REQUEST['ref']) && $_REQUEST['ref'] == 'course') {
      $args['s'] = sanitize_text_field($_REQUEST['s']);
   }

   $post_in =  epora_course_popular_ids();

   if (isset($_REQUEST['orderBy'])) {

      if ($_REQUEST['orderBy'] == 'alphabetical') {
         $args['orderby'] = 'title';
         $args['order']   = 'ASC';
      } elseif ($_REQUEST['orderBy'] == 'newly-published') {
         $args['orderby'] = 'post_date';
         $args['order']   = 'DESC';
      } elseif ($_REQUEST['orderBy'] == 'feature') {
         $args['meta_query'] = array(
            array(
               'key' => '_lp_featured',
               'value' =>  'yes',
            )
         );
      } elseif ($_REQUEST['orderBy'] == 'popularity' && is_array($post_in)) {
         $args['post__in'] = $post_in;
         $args['orderby']  = 'post__in';
      }
   }
   //filter 
   $category = get_queried_object();
   if (learn_press_is_course_archive() || (isset($category->taxonomy) && $category->taxonomy == 'ts-skill-label')) {


      if (isset($category->taxonomy) && $category->taxonomy == 'course_category') {

         $args['tax_query'] = array(
            array(
               'taxonomy' => 'course_category',
               'field'    => 'term_id',
               'terms'    => array($category->term_id),
            ),
         );
      } elseif (isset($category->taxonomy) && $category->taxonomy == 'ts-skill-label') {

         $args['tax_query'] = array(
            array(
               'taxonomy' => 'ts-skill-label',
               'field'    => 'term_id',
               'terms'    => array($category->term_id),
            ),
         );
      }
   }

   return $args;
}
add_filter('epora_archive_post_args', 'epora_filter_archive', 99);

function epora_course_popular_ids()
{
   global $wpdb;
   if (!defined('LP_COURSE_CPT')) {
      return;
   }
   $limit = LP()->settings->get('learn_press_archive_course_limit');
   $query = $wpdb->prepare("
      SELECT ID, a+IF(b IS NULL, 0, b) AS students FROM(
         SELECT p.ID as ID, IF(pm.meta_value, pm.meta_value, 0) as a, (
      SELECT COUNT(*)
   FROM (SELECT COUNT(item_id), item_id, user_id FROM {$wpdb->prefix}learnpress_user_items GROUP BY item_id, user_id) AS Y
   GROUP BY item_id
   HAVING item_id = p.ID
   ) AS b
   FROM {$wpdb->posts} p
   LEFT JOIN {$wpdb->postmeta} AS pm ON p.ID = pm.post_id  AND pm.meta_key = %s
   WHERE p.post_type = %s AND p.post_status = %s
   GROUP BY ID
   ) AS Z
   ORDER BY students DESC
      LIMIT 0, $limit
   ", '_lp_students', 'lp_course', 'publish');

   $post_in = $wpdb->get_col($query);
   return $post_in;
}

// epora_course_content
function epora_course_content()
{

   global $post;
   setup_postdata($post);
   the_content();
}

function epora_related_posts_by_tags($post_id = '', $related_count = 4, $feature_image = true)
{

   try {
      if ($post_id == '') {
         $post_id = get_the_ID();
      }
      $tags  =  get_the_terms(get_the_id(), 'course_tag');

      if (!$tags) {
         return [];
      }

      $term_tags = wp_list_pluck($tags, 'term_id');

      $args = array(
         'post_type' => 'lp_course',
         'post__not_in' => array($post_id),
         'posts_per_page' => $related_count,
         'ignore_sticky_posts' => 1,
         'tax_query' => array(
            array(
               'taxonomy' => 'course_tag',
               'terms' => $term_tags,
               'field' => 'id',
               'operator' => 'IN'
            )
         ),
      );
      if ($feature_image) {
         $args["meta_query"] = array(
            array(
               'key' => '_thumbnail_id',
               'compare' => 'EXISTS'
            ),
         );
      }

      return get_posts($args);
   } catch (Exception $e) {

      return [];
   }
}


remove_action( 'learn-press/course-summary-sidebar', LP()->template( 'course' )->func( 'course_sidebar_preview' ), 10 );
remove_action( 'learn-press/course-summary-sidebar', LP()->template( 'course' )->func( 'course_featured_review' ), 20 );


