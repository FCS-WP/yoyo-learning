<?php
add_action('wp_enqueue_scripts', 'shin_scripts');
function shin_scripts()
{
  $version = time();

  // Load CSS
  wp_enqueue_style('main-style-css', THEME_URL . '-child' . '/assets/main/main.css', array(), $version, 'all');
  // Load JS
  wp_enqueue_script('main-scripts-js', THEME_URL . '-child' . '/assets/main/main.js', array('jquery'), $version, true);
}

function register_custom_taxonomies() {
  // Taxonomy Year
  $labels = array(
    'name'              => _x('Years', 'taxonomy general name', 'textdomain'),
    'singular_name'     => _x('Year', 'taxonomy singular name', 'textdomain'),
    'search_items'      => __('Search Years', 'textdomain'),
    'all_items'         => __('All Years', 'textdomain'),
    'parent_item'       => __('Parent Year', 'textdomain'),
    'parent_item_colon' => __('Parent Year:', 'textdomain'),
    'edit_item'         => __('Edit Year', 'textdomain'),
    'update_item'       => __('Update Year', 'textdomain'),
    'add_new_item'      => __('Add New Year', 'textdomain'),
    'new_item_name'     => __('New Year Name', 'textdomain'),
    'menu_name'         => __('Year', 'textdomain'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'year'),
  );

  register_taxonomy('year', 'lp_course', $args);

  // Taxonomy Level
  $labels = array(
    'name'              => _x('Levels', 'taxonomy general name', 'textdomain'),
    'singular_name'     => _x('Level', 'taxonomy singular name', 'textdomain'),
    'search_items'      => __('Search Levels', 'textdomain'),
    'all_items'         => __('All Levels', 'textdomain'),
    'parent_item'       => __('Parent Level', 'textdomain'),
    'parent_item_colon' => __('Parent Level:', 'textdomain'),
    'edit_item'         => __('Edit Level', 'textdomain'),
    'update_item'       => __('Update Level', 'textdomain'),
    'add_new_item'      => __('Add New Level', 'textdomain'),
    'new_item_name'     => __('New Level Name', 'textdomain'),
    'menu_name'         => __('Level', 'textdomain'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'level'),
  );

  register_taxonomy('level', 'lp_course', $args);

  // Taxonomy Subject
  $labels = array(
    'name'              => _x('Subjects', 'taxonomy general name', 'textdomain'),
    'singular_name'     => _x('Subject', 'taxonomy singular name', 'textdomain'),
    'search_items'      => __('Search Subjects', 'textdomain'),
    'all_items'         => __('All Subjects', 'textdomain'),
    'parent_item'       => __('Parent Subject', 'textdomain'),
    'parent_item_colon' => __('Parent Subject:', 'textdomain'),
    'edit_item'         => __('Edit Subject', 'textdomain'),
    'update_item'       => __('Update Subject', 'textdomain'),
    'add_new_item'      => __('Add New Subject', 'textdomain'),
    'new_item_name'     => __('New Subject Name', 'textdomain'),
    'menu_name'         => __('Subject', 'textdomain'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'subject'),
  );

  register_taxonomy('subject', 'lp_course', $args);
}

add_action('init', 'register_custom_taxonomies');
