<?php

if (!defined('WP_DEBUG')) {
   die('Direct access forbidden.');
}

add_action('wp_enqueue_scripts', 'epora_child_enqueue_styles', 99);

function epora_child_enqueue_styles()
{
   wp_enqueue_style('parent-style', get_stylesheet_directory_uri() . '/style.css');
}


/*
 * Define Variables
 */
if (!defined('THEME_DIR'))
   define('THEME_DIR', get_template_directory());
if (!defined('THEME_URL'))
   define('THEME_URL', get_template_directory_uri());


/*
 * Include framework files
 */
foreach (glob(THEME_DIR . '-child' . "/includes/*.php") as $file_name) {
   require_once($file_name);
}
