<?php

/**
 * the template for displaying all posts.
*/

/**
 * Template for displaying content of single course.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

get_header();


$course_style = get_theme_mod( 'course_style', 'standard' );

$course_solid_bg = $course_style == 'course_solid' ? 'grey-bg' : '';

?>

<div id="main-content" class="main-container archive-course-container pt-120 pb-120 <?php echo esc_attr($course_solid_bg); ?>" role="main">
   <div class="container">
   	<?php if ($course_style == 'standard') : ?>
      <?php get_template_part('learnpress/content-archive-course-standard'); ?>
      <?php else : ?>
         <?php get_template_part('learnpress/content-archive-course-advanced'); ?>
         
      <?php endif; ?>
   </div>
</div>

<?php get_footer(); ?>
