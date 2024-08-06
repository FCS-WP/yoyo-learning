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
    'rewrite'           => array('slug' => 'lp_year'),
  );

  register_taxonomy('lp_year', 'lp_course', $args);

  // Taxonomy Level
  $labels = array(
    'name'              => _x('Grades', 'taxonomy general name', 'textdomain'),
    'singular_name'     => _x('Grade', 'taxonomy singular name', 'textdomain'),
    'search_items'      => __('Search Grades', 'textdomain'),
    'all_items'         => __('All Grades', 'textdomain'),
    'parent_item'       => __('Parent Grade', 'textdomain'),
    'parent_item_colon' => __('Parent Grade:', 'textdomain'),
    'edit_item'         => __('Edit Grade', 'textdomain'),
    'update_item'       => __('Update Grade', 'textdomain'),
    'add_new_item'      => __('Add New Grade', 'textdomain'),
    'new_item_name'     => __('New Grade Name', 'textdomain'),
    'menu_name'         => __('Grade', 'textdomain'),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'lp_grade'),
  );

  register_taxonomy('lp_grade', 'lp_course', $args);

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
    'rewrite'           => array('slug' => 'lp_subject'),
  );

  register_taxonomy('lp_subject', 'lp_course', $args);
}

add_action('init', 'register_custom_taxonomies');

add_action('admin_menu', 'my_admin_menu');
function my_admin_menu()
{
  add_submenu_page('learn_press', 'Year', 'Year', 'manage_options', 'edit-tags.php?taxonomy=lp_year');
  add_submenu_page('learn_press', 'Level', 'Grade', 'manage_options', 'edit-tags.php?taxonomy=lp_grade');
  add_submenu_page('learn_press', 'Subject', 'Subject', 'manage_options', 'edit-tags.php?taxonomy=lp_subject');
}